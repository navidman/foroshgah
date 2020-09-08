<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::query();

        if ($search = request('search')) {
            $orders->where('id' , $search)->orWhere('tracking_serial' , $search);
        }

        $orders = $orders->where('status' , request('type'))->latest()->paginate(20);
        return view('admin.orders.all', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $products = $order->products()->paginate(20);
        return view('admin.orders.details' , compact('products' , 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $data = $this->validate($request , [
            'status' => ['required',Rule::in(['unpaid', 'paid', 'preparation', 'posted', 'recieved'])],
            'tracking_serial' => 'required'
        ]);
        $order->update($data);
        alert()->success('سفارش مورد نظر با موفقیت ویرایش شد.');
        return redirect(route('admin.orders.index') . "?type=$order->status");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        alert()->success('سفارش مورد نظر با موفقیت حذف شد.');
        return back();
    }

    public function payment(Order $order) 
    {
        $payments = $order->payments()->latest()->paginate(20);
        return view('admin.orders.payments' , compact('payments' , 'order')); 
    }
}
