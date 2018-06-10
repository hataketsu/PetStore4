<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Product;
use ClassesWithParents\F;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ProcessImage;

    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        return view('product.list', ['items' => Product::all(), 'title' => 'Manage products']);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.edit',['title' => "Add new product"]);
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();

        return $this->process($request, $product);
    }

    /**
     * Display the specified product.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $liked = null;
        $is_bought = false;
        if (\Auth::check()) {
            $mycomment = $this->get_my_comment($product->id);
            $mycomment->fill_olds();
            $is_bought = $this->is_bought_this_product($product->id);
        }
        $product->views += 1;
        $product->increaseView();
        $product->save();

        $related = $product->category->products->random(min(4,$product->category->products->count()));
        return view('product.detail', ['item' => $product,
            'is_bought' => $is_bought,
            'liked' => $liked,
            'title' => $product->name,
            'related' => $related
        ]);
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if (null == \Session::get('errors'))
            $product->fill_olds();

        return view('product.edit', ['item' => $product,'title' => "Edit old product"]);
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        return $this->process($request, $product);
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect('/manage/products');
    }


    //this process step is same for store new product and save old edited product
    protected function process(Request $request, Product $product)
    {
        //first we need to validate all inputs
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required',
            'short_detail' => 'required',
            'full_html_detail' => 'required',
            'price' => 'required|numeric|min:0',
            'sale_off' => 'required|numeric|min:0|max:' . $request->get('price'), //tha sale-off must be <= price
        ]);
        $product->fill($request->all()); //fill all inputs to model

        if ($request->files->has('image')) { //save uploaded images
            $urls = '';
            foreach ($request->files->get('image') as $file) {
                $path = $this->process_image($file);
                $urls .= $path . ';';
            }
            $product->image_urls = $urls;
        } else if (is_null($product->image_urls)) {
            $product->image_url = 'no-thumbnail.png' ; //there's no image, we will use default image
        }
        $product->save(); //save model to database

        return redirect('/manage/products');
    }

    //save user's review comment
    public function save_comment(Request $request, $product_id)
    {
        $request->validate([
            'content' => 'required|string',
            'score' => 'required|numeric'
        ]);
        $comment = $this->get_my_comment($product_id);
        $comment->user_id = \Auth::id();
        $comment->product_id = $product_id;
        $comment->fill($request->all());
        $comment->save();

        return redirect('/products/' . $product_id);
    }

    //get user's review comment in this product
    protected function get_my_comment($product_id)
    {
        $query = Comment::whereUserId(\Auth::id())->whereProductId($product_id);
        if ($query->count() > 0) //there's existed comment
            return $query->get()[0]; //take the first
        return new Comment(); //return new comment
    }

    //like this product
    public function like_product(Request $request, $product_id)
    {
        \Auth::user()->liked_products()->attach($product_id);

        return redirect('/products/' . $product_id);
    }

    //dislike this product
    public function dislike_product(Request $request, $product_id)
    {
        \Auth::user()->liked_products()->detach($product_id);

        return redirect('/products/' . $product_id);
    }

    //check if the user has boudgt this product before?
    private function is_bought_this_product($product_id)
    {
        foreach (\Auth::user()->orders()->whereStatus('done')->get() as $order) {

            foreach ($order->items as $item) {
                if ($item->product_id == $product_id)
                    return true;
            }
        }
        return false;
    }

    public function add_to_wishlist(Product $product){
        \Auth::user()->liked_products()->attach($product);
        \Session::flash('message',$product->name.' is added to your wishlist.');
    }

    public function remove_from_wishlist(Product $product){
        \Auth::user()->liked_products()->detach($product);
        \Session::flash('message',$product->name.' is removed from your wishlist.');
    }

}
