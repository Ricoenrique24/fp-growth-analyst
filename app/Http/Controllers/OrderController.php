<?php

/**
  * Copyright © Luxodev Indonesia. All Rights Reserved.
  */

namespace App\Http\Controllers;

use App\Models\Order;
use Auth;
use DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    /**
     * Display a listing of the App\Models\Order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::query();
        $filter = [];
        if(isset($request->filter)) {
            $filter = $request->filter;
            foreach ($filter as $key => $value) {
                if(!empty($value)) {

                    if( $key == 'sort') {
                        $sort = explode('|', $value);
                        $orders = $orders->orderBy($sort[0], $sort[1]);
                        continue;
                    }

                    // if($key == 'dummy') {

                    // } else {
                        $orders = $orders->where($key, 'like', '%'.$value.'%');
                    // }
                }
            }
        }
        $orders = $orders->paginate(10);
        //
        return view('orders.index')
                    ->with('orders', $orders)
                    ->with('filter', $filter);
    }

    /**
     * Show the form for creating a new App\Models\Order.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $order = new Order;
        // $order->active = 1;
        return view('orders.form')
                    ->with('order', $order);
    }

    /**
     * Store a newly created App\Models\Order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => [
        //         'required',
        //         Rule::unique('orders'),
        //     ],
        //     'relations' => 'nullable|array'
        // ]);

        try {
            DB::beginTransaction();
                $order = new Order;
                $order->fill($request->except([]));
                // $order->active = $request->active == 'on';
                $order->save();
                // $order->relations()->sync($request->relations);
                //
            DB::commit();
            toastr()->success('Order Created!', 'Congratulations');
        } catch(QueryException $ex){
            DB::rollBack();
            toastr()->error('Failed!', substr($ex->getMessage(), 0, 30));
        }

        return redirect()->route('orders.index');
    }

    /**
     * Display the specified App\Models\Order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
        return view('orders.show')
                    ->with('order', $order);
    }

    /**
     * Show the form for editing the specified App\Models\Order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
        return view('orders.form')
                    ->with('order', $order);
    }

    /**
     * Update the specified App\Models\Order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => [
        //         'required',
        //         Rule::unique('orders')->ignore($order->id),
        //     ],
        //     'relations' => 'nullable|array'
        // ]);

        try {
            DB::beginTransaction();
            $order->fill($request->except([]));
            // $order->active = $request->active == 'on';
            $order->save();
            // $order->relations()->sync($request->relations);
            DB::commit();
            toastr()->success('User Updated!', 'Congratulations');
        } catch(QueryException $ex){
            DB::rollBack();
            toastr()->error('Failed!', substr($ex->getMessage(), 0, 30));
        }

        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified App\Models\Order from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order, Request $request)
    {
        try {
            //
            $order->delete();
            toastr()->success('User Deleted!', 'Congratulations');
        } catch(QueryException $ex){
            toastr()->error('Failed!', substr($ex->getMessage(), 0, 30));
        }

        return redirect()->route('orders.index');
    }
}
