<?php

/**
  * Copyright © Luxodev Indonesia. All Rights Reserved.
  */

namespace App\Http\Controllers;

use DB;
use Auth;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Models\Order;
use App\Models\Bundling;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class BundlingController extends Controller
{
    /**
     * Display a listing of the App\Models\Bundling.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orderItems = DB::table('orders')
            ->select(DB::raw("no_transaksi, TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(produk, ',', numbers.n), ',', -1)) AS produk"))
            ->crossJoin(DB::raw("
                (SELECT 1 n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL 
                SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL 
                SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL 
                SELECT 10) numbers"))
            ->whereRaw("CHAR_LENGTH(produk) - CHAR_LENGTH(REPLACE(produk, ',', '')) >= numbers.n - 1")
            ->get();
    
        // Convert to Collection
        $orderItems = collect($orderItems);
    
        // Convert produk to array
        $orderItems = $orderItems->map(function ($item) {
            $item->produk = explode(',', $item->produk);
            return $item;
        });
    
        // Frequent Itemsets
        $itemsetCounts = $orderItems->pluck('produk')->flatten()->countBy()->filter(function ($count) {
            return $count >= 3; // Adjust the support threshold as needed
        });
    
        // Association Rules Calculation
        $associationRules = [];
        foreach ($itemsetCounts as $antecedent => $antecedentCount) {
            $antecedentSupport = $antecedentCount / $orderItems->count();
    
            foreach ($itemsetCounts as $consequent => $consequentCount) {
                if ($antecedent !== $consequent) {
                    $consequentSupport = $consequentCount / $orderItems->count();
    
                    $bothSupportCount = $orderItems->filter(function ($item) use ($antecedent, $consequent) {
                        return in_array($antecedent, $item->produk) && in_array($consequent, $item->produk);
                    })->count();
    
                    $bothSupport = $bothSupportCount / $orderItems->count();
                    $confidence = $bothSupport / $antecedentSupport;
                    $lift = $confidence / $consequentSupport;
                    $leverage = $bothSupport - ($antecedentSupport * $consequentSupport);
                    $conviction = (1 - $consequentSupport) / (1 - $confidence);
                    $zhangsMetric = $leverage / max($antecedentSupport * (1 - $consequentSupport), $consequentSupport * (1 - $antecedentSupport));
    
                    $associationRules[] = [
                        'antecedent' => $antecedent,
                        'consequent' => $consequent,
                        'antecedent_support' => $antecedentSupport,
                        'consequent_support' => $consequentSupport,
                        'support' => $bothSupport,
                        'confidence' => $confidence,
                        'lift' => $lift,
                        'leverage' => $leverage,
                        'conviction' => $conviction,
                        'zhangs_metric' => $zhangsMetric,
                    ];
                }
            }
        }
    
        // Remove duplicate antecedent or consequent
        $uniqueAssociationRules = [];
        $uniqueProducts = [];
    
        foreach ($associationRules as $rule) {
            if (!in_array($rule['antecedent'], $uniqueProducts) && !in_array($rule['consequent'], $uniqueProducts)) {
                $uniqueAssociationRules[] = $rule;
                $uniqueProducts[] = $rule['antecedent'];
                $uniqueProducts[] = $rule['consequent'];
            }
        }
    
        // Sort and limit the results to top 10 based on confidence
        $associationRulesDescending = $uniqueAssociationRules;
        usort($associationRulesDescending, function($a, $b) {
            return $b['confidence'] <=> $a['confidence'];
        });
        $associationRulesDescending = array_slice($associationRulesDescending, 0, 10);
    
        // Sort and limit the results to bottom 10 based on confidence
        $associationRulesAscending = $uniqueAssociationRules;
        usort($associationRulesAscending, function($a, $b) {
            return $a['confidence'] <=> $b['confidence'];
        });
        $associationRulesAscending = array_slice($associationRulesAscending, 0, 10);

        dd($associationRulesDescending, $associationRulesAscending);
    
        return view('bundlings.index', compact('associationRulesDescending', 'associationRulesAscending'));
    }
    

    /**
     * Show the form for creating a new App\Models\Bundling.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bundling = new Bundling;
        // $bundling->active = 1;
        return view('bundlings.form')
                    ->with('bundling', $bundling);
    }

    /**
     * Store a newly created App\Models\Bundling in storage.
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
        //         Rule::unique('bundlings'),
        //     ],
        //     'relations' => 'nullable|array'
        // ]);

        try {
            DB::beginTransaction();
                $bundling = new Bundling;
                $bundling->fill($request->except([]));
                // $bundling->active = $request->active == 'on';
                $bundling->save();
                // $bundling->relations()->sync($request->relations);
                //
            DB::commit();
            toastr()->success('Bundling Created!', 'Congratulations');
        } catch(QueryException $ex){
            DB::rollBack();
            toastr()->error('Failed!', substr($ex->getMessage(), 0, 30));
        }

        return redirect()->route('bundlings.index');
    }

    /**
     * Display the specified App\Models\Bundling.
     *
     * @param  \App\Models\Bundling  $bundling
     * @return \Illuminate\Http\Response
     */
    public function show(Bundling $bundling)
    {
        //
        return view('bundlings.show')
                    ->with('bundling', $bundling);
    }

    /**
     * Show the form for editing the specified App\Models\Bundling.
     *
     * @param  \App\Models\Bundling  $bundling
     * @return \Illuminate\Http\Response
     */
    public function edit(Bundling $bundling)
    {
        //
        return view('bundlings.form')
                    ->with('bundling', $bundling);
    }

    /**
     * Update the specified App\Models\Bundling in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bundling  $bundling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bundling $bundling)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => [
        //         'required',
        //         Rule::unique('bundlings')->ignore($bundling->id),
        //     ],
        //     'relations' => 'nullable|array'
        // ]);

        try {
            DB::beginTransaction();
            $bundling->fill($request->except([]));
            // $bundling->active = $request->active == 'on';
            $bundling->save();
            // $bundling->relations()->sync($request->relations);
            DB::commit();
            toastr()->success('User Updated!', 'Congratulations');
        } catch(QueryException $ex){
            DB::rollBack();
            toastr()->error('Failed!', substr($ex->getMessage(), 0, 30));
        }

        return redirect()->route('bundlings.index');
    }

    /**
     * Remove the specified App\Models\Bundling from storage.
     *
     * @param  \App\Models\Bundling  $bundling
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bundling $bundling, Request $request)
    {
        try {
            //
            $bundling->delete();
            toastr()->success('User Deleted!', 'Congratulations');
        } catch(QueryException $ex){
            toastr()->error('Failed!', substr($ex->getMessage(), 0, 30));
        }

        return redirect()->route('bundlings.index');
    }
}
