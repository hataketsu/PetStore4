<?php

namespace App\Http\Controllers;

use App\Log;
use App\Order;
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
        Log::logInc(Log::ORDER_DISPOSE);
        if (\Auth::id() == $order->user_id || \Auth::user()->is_admin) {
            $order->status = 'disposed';
            $order->save();

            if (env('SEND_EMAIL'))
                Mail::to($order->email)->queue(new \App\Mail\OrderShipped($order));

        }
        return redirect('/orders/' . $id);
    }

    //confirm this order
    //only admin can do this
    public function confirm($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'confirmed';
        $order->save();
        if (env('SEND_EMAIL'))
            Mail::to($order->email)->queue(new \App\Mail\OrderShipped($order));

        Log::logInc(Log::ORDER_CONFIRMED);

        return redirect('/orders/' . $id);
    }

    //confirm shipping this order
    //only admin can do this
    public function ship($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'shipped';
        $order->save();
        if (env('SEND_EMAIL'))
            Mail::to($order->email)->queue(new \App\Mail\OrderShipped($order));
        Log::logInc(Log::ORDER_SHIP);

        return redirect('/orders/' . $id);
    }

    //confirm done this order
    public function done($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'done';
        $order->save();
        $this->log_sold($order);
        if (env('SEND_EMAIL'))
            Mail::to($order->email)->queue(new \App\Mail\OrderShipped($order));

        foreach ($order->items as $item) {
            $item->product->in_stock -= $item->quantity;
            $item->product->save();
        }
        Log::logInc(Log::ORDER_DONE);


        return redirect('/orders/' . $id);
    }

    //log this to sold
    private function log_sold(Order $order)
    {
        Log::logInc(Log::REVENUE, $order->getFinalTotal());

        foreach ($order->items as $item) {
            Log::logInc(Log::SELL, $item->quantity);
        }
    }


}
