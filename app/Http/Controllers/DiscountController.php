<?php

namespace App\Http\Controllers;

use App\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    private $validator_rule = [
        'name' => 'required|unique:discounts',
        'code' => 'required|unique:discounts',
        'type' => 'required',
        'discount' => 'required|numeric|min:0'

    ];

    /**
     * Display a listing of the code.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        return view('discount.list', ['items' => Discount::all(), 'title' => 'Quản lý mã giảm giá']);
    }

    /**
     * Show the form for creating a new code.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        (new Discount())->fill_olds();

        return view('discount.edit', ['title' => 'Tạo mã giảm giá mới']);
    }

    /**
     * Store a newly created code in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            $this->validator_rule
        );
        $discount = new Discount();
        $discount->fill($request->all());
        $discount->save();

        return redirect('/manage/discounts');

    }


    /**
     * Show the form for editing the specified code.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        $discount->fill_olds();

        return view('discount.edit', ['item' => $discount, 'title' => 'Chỉnh sửa mã giảm giá']);
    }

    /**
     * Update the specified code in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        $request->validate(
            $this->validator_rule
        );
        $discount->fill($request->all());
        $discount->save();

        return redirect('/manage/discounts');
    }

    /**
     * Remove the specified code from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function delete($id)
    {
        Discount::destroy($id);
        return redirect('/manage/discounts');
    }
}
