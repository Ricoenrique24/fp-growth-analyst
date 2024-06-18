<?php

/**
  * Copyright © Luxodev Indonesia. All Rights Reserved.
  */

namespace App\Http\Controllers;

use DB;
use Auth;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class TransactionController extends Controller
{
    /**
     * Display a listing of the App\Models\Transaction.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transactions = Order::query();
        $filter = [];
        if(isset($request->filter)) {
            $filter = $request->filter;
            foreach ($filter as $key => $value) {
                if(!empty($value)) {

                    if( $key == 'sort') {
                        $sort = explode('|', $value);
                        $transactions = $transactions->orderBy($sort[0], $sort[1]);
                        continue;
                    }

                    // if($key == 'dummy') {

                    // } else {
                        $transactions = $transactions->where($key, 'like', '%'.$value.'%');
                    // }
                }
            }
        }
        $count = $transactions->count();
        $transactions = $transactions->paginate(10);

        $latestDate = Order::max('tanggal');
        $latestDate = Carbon::parse($latestDate);
        $threeMonthsAgo = $latestDate->subMonths(3);
        $three_bulan = Order::where('tanggal', '>=', $threeMonthsAgo);
        $three_bulan = $three_bulan->paginate(10);

        $oneYearAgo = $latestDate->subYear();
        $one_year = Order::where('tanggal', '>=', $oneYearAgo);
        $one_year = $one_year->paginate(10);
        return view('transactions.index')
                    ->with('transactions', $transactions)
                    ->with('three_bulan', $three_bulan)
                    ->with('count', $count)
                    ->with('one_year', $one_year)
                    ->with('filter', $filter);
    }

    /**
     * Show the form for creating a new App\Models\Transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transaction = new Transaction;
        // $transaction->active = 1;
        return view('transactions.form')
                    ->with('transaction', $transaction);
    }

    /**
     * Store a newly created App\Models\Transaction in storage.
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
        //         Rule::unique('transactions'),
        //     ],
        //     'relations' => 'nullable|array'
        // ]);

        try {
            DB::beginTransaction();
                $transaction = new Transaction;
                $transaction->fill($request->except([]));
                // $transaction->active = $request->active == 'on';
                $transaction->save();
                // $transaction->relations()->sync($request->relations);
                //
            DB::commit();
            toastr()->success('Transaction Created!', 'Congratulations');
        } catch(QueryException $ex){
            DB::rollBack();
            toastr()->error('Failed!', substr($ex->getMessage(), 0, 30));
        }

        return redirect()->route('transactions.index');
    }

    /**
     * Display the specified App\Models\Transaction.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
        return view('transactions.show')
                    ->with('transaction', $transaction);
    }

    /**
     * Show the form for editing the specified App\Models\Transaction.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
        return view('transactions.form')
                    ->with('transaction', $transaction);
    }

    /**
     * Update the specified App\Models\Transaction in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => [
        //         'required',
        //         Rule::unique('transactions')->ignore($transaction->id),
        //     ],
        //     'relations' => 'nullable|array'
        // ]);

        try {
            DB::beginTransaction();
            $transaction->fill($request->except([]));
            // $transaction->active = $request->active == 'on';
            $transaction->save();
            // $transaction->relations()->sync($request->relations);
            DB::commit();
            toastr()->success('User Updated!', 'Congratulations');
        } catch(QueryException $ex){
            DB::rollBack();
            toastr()->error('Failed!', substr($ex->getMessage(), 0, 30));
        }

        return redirect()->route('transactions.index');
    }

    /**
     * Remove the specified App\Models\Transaction from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction, Request $request)
    {
        try {
            //
            $transaction->delete();
            toastr()->success('User Deleted!', 'Congratulations');
        } catch(QueryException $ex){
            toastr()->error('Failed!', substr($ex->getMessage(), 0, 30));
        }

        return redirect()->route('transactions.index');
    }
}
