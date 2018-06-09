<?php

namespace App\Http\Controllers;

use App\LogProductSold;
use App\LogRevenue;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;

class OrderController extends Controller
{

    //show all current user's orders
    public function all()
    {
        $orders = \Auth::user()->orders;

        return view('order.all', ['items' => $orders]);
    }

    //show all orders
    //only admin can do this
    public function manage()
    {
        $orders = Order::all();

        return view('order.manage.all', ['items' => $orders]);
    }


    //show specified order
    public function show(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        return view('order.detail', [
            'order' => $order,
            'items' => $order->items,
            'total' => $order->getFinalTotal()
        ]);
    }

    //cancel this order
    public function dispose($id)
    {
        $order = Order::findOrFail($id);
        if (\Auth::id() == $order->user_id || \Auth::user()->is_admin) {
            $order->status = 'disposed';
            $order->save();

            return redirect('/orders/' . $id);
        }

        Mail::to($order->email)->queue(new \App\Mail\OrderShipped($order));

        return redirect('/' . $id);
    }

    //confirm this order
    //only admin can do this
    public function confirm($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'confirmed';
        $order->save();

        Mail::to($order->email)->queue(new \App\Mail\OrderShipped($order));

        return redirect('/orders/' . $id);
    }

    //confirm shipping this order
    //only admin can do this
    public function ship($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'shipped';
        $order->save();
        Mail::to($order->email)->queue(new \App\Mail\OrderShipped($order));

        return redirect('/orders/' . $id);
    }

    //confirm done this order
    public function done($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'done';
        $order->save();
        $this->log_sold($order);
        Mail::to($order->email)->queue(new \App\Mail\OrderShipped($order));

        return redirect('/orders/' . $id);
    }

    //log this to sold
    private function log_sold($order)
    {
        $revenue = LogRevenue::firstOrNew(['day' => Carbon::today()->timestamp]);
        $revenue->total += $order->getFinalTotal();
        $revenue->save();

        foreach ($order->items as $item) {
            $sold = LogProductSold::firstOrNew(['day' => Carbon::today()->timestamp, 'product_id' => $item->product_id]);
            $sold->solds += $item->quantity;
            $sold->save();
        }
    }


}
