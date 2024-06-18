<?php

/**
  * Copyright © Luxodev Indonesia. All Rights Reserved.
  */

namespace App\Http\Controllers;

use App\Models\FpGrowth;
use Auth;
use DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FpGrowthController extends Controller
{
    /**
     * Display a listing of the App\Models\FpGrowth.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fp_growths = FpGrowth::query();
        $filter = [];
        if(isset($request->filter)) {
            $filter = $request->filter;
            foreach ($filter as $key => $value) {
                if(!empty($value)) {

                    if( $key == 'sort') {
                        $sort = explode('|', $value);
                        $fp_growths = $fp_growths->orderBy($sort[0], $sort[1]);
                        continue;
                    }

                    // if($key == 'dummy') {

                    // } else {
                        $fp_growths = $fp_growths->where($key, 'like', '%'.$value.'%');
                    // }
                }
            }
        }
        $fp_growths = $fp_growths->paginate(50);
        //
        return view('fp_growths.index')
                    ->with('fp_growths', $fp_growths)
                    ->with('filter', $filter);
    }

    /**
     * Show the form for creating a new App\Models\FpGrowth.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fp_growth = new FpGrowth;
        // $fp_growth->active = 1;
        return view('fp_growths.form')
                    ->with('fp_growth', $fp_growth);
    }

    /**
     * Store a newly created App\Models\FpGrowth in storage.
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
        //         Rule::unique('fp_growths'),
        //     ],
        //     'relations' => 'nullable|array'
        // ]);

        try {
            DB::beginTransaction();
                $fp_growth = new FpGrowth;
                $fp_growth->fill($request->except([]));
                // $fp_growth->active = $request->active == 'on';
                $fp_growth->save();
                // $fp_growth->relations()->sync($request->relations);
                //
            DB::commit();
            toastr()->success('Fp Growth Created!', 'Congratulations');
        } catch(QueryException $ex){
            DB::rollBack();
            toastr()->error('Failed!', substr($ex->getMessage(), 0, 30));
        }

        return redirect()->route('fp_growths.index');
    }

    /**
     * Display the specified App\Models\FpGrowth.
     *
     * @param  \App\Models\FpGrowth  $fp_growth
     * @return \Illuminate\Http\Response
     */
    public function show(FpGrowth $fp_growth)
    {
        //
        return view('fp_growths.show')
                    ->with('fp_growth', $fp_growth);
    }

    /**
     * Show the form for editing the specified App\Models\FpGrowth.
     *
     * @param  \App\Models\FpGrowth  $fp_growth
     * @return \Illuminate\Http\Response
     */
    public function edit(FpGrowth $fp_growth)
    {
        //
        return view('fp_growths.form')
                    ->with('fp_growth', $fp_growth);
    }

    /**
     * Update the specified App\Models\FpGrowth in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FpGrowth  $fp_growth
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FpGrowth $fp_growth)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => [
        //         'required',
        //         Rule::unique('fp_growths')->ignore($fp_growth->id),
        //     ],
        //     'relations' => 'nullable|array'
        // ]);

        try {
            DB::beginTransaction();
            $fp_growth->fill($request->except([]));
            // $fp_growth->active = $request->active == 'on';
            $fp_growth->save();
            // $fp_growth->relations()->sync($request->relations);
            DB::commit();
            toastr()->success('User Updated!', 'Congratulations');
        } catch(QueryException $ex){
            DB::rollBack();
            toastr()->error('Failed!', substr($ex->getMessage(), 0, 30));
        }

        return redirect()->route('fp_growths.index');
    }

    /**
     * Remove the specified App\Models\FpGrowth from storage.
     *
     * @param  \App\Models\FpGrowth  $fp_growth
     * @return \Illuminate\Http\Response
     */
    public function destroy(FpGrowth $fp_growth, Request $request)
    {
        try {
            //
            $fp_growth->delete();
            toastr()->success('User Deleted!', 'Congratulations');
        } catch(QueryException $ex){
            toastr()->error('Failed!', substr($ex->getMessage(), 0, 30));
        }

        return redirect()->route('fp_growths.index');
    }
}
