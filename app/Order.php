<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Order
 *
 * @property int $id
 * @property int $user_id
 * @property string $phone
 * @property string $address
 * @property string $note
 * @property string $status
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUserId($value)
 * @mixin \Eloquent
 */
class Order extends Model
{

    //all kinds of orders' statuses
    public static $ORDER_STATUS = [
        'wait_confirm' => 'Chờ xử lý',  //waiting for admin confirms
        'confirmed' => 'Đã xác nhận',            //admin confirmed
        'shipped' => 'Đã vận chuyển',                //on shipping
        'done' => 'Đã hoàn thành',                       //shipped to user
        'disposed' => 'Đã hủy bỏ'                //the user or admin cancel this order
    ];


    //default values
    protected $attributes = [
        'status' => 'wait_confirm',
        'phone' => "00",
        'address' => "none",
        'note' => 'none',
        'name' => 'nope',
        'email' => 'nope',
        'used_discount_code' => '',
        'discounted_price' => 0
    ];

    protected $fillable = ['status', 'name', 'address', 'phone', 'note','email'];

    //get all items in this order
    public function items()
    {
        return $this->hasMany('App\\OrderItem');
    }

    //who made this order
    public function user()
    {
        return $this->belongsTo('App\\User');
    }

    //get currrent total price of this order
    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->product->getCost() * $item->quantity;
        }

        return $total;
    }

    //get final price because the product's price may be changed so final_price is saved at checkout time.
    public function getFinalTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->final_price * $item->quantity;
        }

        return $total;
    }

    //get status by human-readable form
    public function getStatus()
    {
        return Order::$ORDER_STATUS[$this->status];
    }

}
