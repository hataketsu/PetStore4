<?php

namespace App;

use App\Http\Controllers\FlashToOld;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Product
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $image_urls
 * @property string $short_detail
 * @property string $full_html_detail
 * @property float $price
 * @property float $sale_off
 * @property int|null $category_id
 * @property int $instock
 * @property int $sold
 * @property int $views
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereFullHtmlDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereImageUrls($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereInstock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereSaleOff($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereShortDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereSold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereViews($value)
 */
class Product extends Model
{
    use \App\CanFillOld;
    protected $fillable = [
        'name',
        'short_detail',
        'full_html_detail',
        'price',
        'in_stock',
        'sale_off',
        'category_id'
    ];
    protected $attributes = [
        'image_urls' => 'no-thumbnail.png',
        'short_detail' => '_',
        'sold' => 0,
        'views' => 0,
        'category_id'=>1
    ];


    //get how many products are sold
    public static function get_sold()
    {
        $total_sold = 0;
        $total_revenue = 0;
        foreach (Order::whereStatus('done')->get() as $order) {
            foreach ($order->items as $item) {
                $total_sold += $item->quantity;
                $total_revenue += $item->quantity * $item->final_price;
            }
        }

        return ['total_sold' => $total_sold, 'total_revenue' => $total_revenue];
    }

    //get images from packed image_urls;
    //image_urls is a string of images' paths separated by ;
    public function all_images()
    {
        return array_filter(explode(";", $this->image_urls));
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany('App\\Order');
    }

    public function comments()
    {
        return $this->hasMany('App\\Comment');
    }

    public function getCost()
    {
        return min($this->price, $this->sale_off);
    }

    public function getScore()
    {
        return round($this->comments->avg('score'), 1);
    }

    public static function searchByName($name)
    {
        return Product::query()->where('name', 'LIKE', '%' . $name . '%');
    }


    public function solds()
    {
        return $this->hasMany(LogProductSold::class);
    }

    public function views()
    {
        return $this->hasMany(LogProductView::class);
    }

    //increase today's view in log
    public function increaseView()
    {
        $log_view = $this->views()->firstOrNew(['day' => Carbon::today()->timestamp]);
        $log_view->views += 1;
        $log_view->save();
    }
}
