<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


//searching products controller
class SearchController extends Controller
{
    //search products by name
    public function search(Request $request)
    {
        $query = $request->get('query');
        $products = Product::query()->where('name', 'LIKE', '%' . $query . '%');
        $title = 'Results of searching for "' . $query . '"';
        return $this->process($request, $products, $title);
    }

    //show all products availble
    public function all(Request $request)
    {
        $products = Product::query();
        $title = 'All products availble';
        return $this->process($request, $products, $title);
    }

    //show products in this category
    public function category(Request $request, $category_id)
    {
        $products = Product::whereCategoryId($category_id);
        $title = Category::findOrFail($category_id)->name . ' category';
        return $this->process($request, $products, $title);
    }

    //show sale-off products
    public function sale_off(Request $request)
    {
        $products = Product::whereRaw('price > sale_off');
        $title = 'Sale off';
        return $this->process($request, $products, $title);
    }

    //show sale-off products
    public function wish_list(Request $request)
    {
        $products = \Auth::user()->liked_products();
        $title = 'My wishlist';
        return $this->process($request, $products, $title);
    }

    //same step for all search
    protected function process(Request $request, $products, $title)
    {
        //if they are searching for product's name
        if ($request->has('query')) {
            $query = $request->get('query');
            $products = $products->where('name', 'LIKE', '%' . $query . '%');
        }

        //filter by price
        if ($request->has('lower_price'))
            $products = $products->where('sale_off', '>=', $request->get('lower_price'));
        if ($request->has('higher_price'))
            $products = $products->where('sale_off', '<=', $request->get('higher_price'));

        //sort products
        $orderby = 'asc';
        if ($request->has('orderby')) {
            $orderby = $request->get('orderby');
        }

        if ($request->has('sortby')) {
            $sortby = $request->get('sortby');
            if ($sortby == 'price')
                $products = $products->orderBy('sale_off', $orderby);
            elseif ($sortby == 'time')
                $products = $products->orderBy('updated_at', $orderby);
        }
        Input::flash(); //save all current inputs

        return view('search.index',
            ['products' => $products->paginate(12)->appends(Input::except('page')), //show 12 products each page
                'title' => $title]);
    }
}
