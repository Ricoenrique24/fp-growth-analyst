<?php

/**
  * Copyright © Luxodev Indonesia. All Rights Reserved.
  */

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\Order;
use App\Models\FpGrowth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class NewFpGrowthController extends Controller
{
    public function index()
    {
        // Query untuk mengambil data dari tabel 'result_frequent_itemsets'
        $supportData = DB::table('result_frequent_itemsets')
                                    ->orderByDesc('support')
                                    ->limit(10)
                                    ->get();

         // Query untuk mengambil data dari tabel 'association_rules'
        $produkLaku = DB::table('association_rules')
                                ->orderByDesc('confidence')
                                ->limit(5)
                                ->get();

        $produkRugi = DB::table('association_rules')
                                ->orderBy('confidence', 'asc')
                                ->limit(5)
                                ->get();
                        
        // Mengirimkan data ke view 'beranda'
        return view('fp_growths.index', compact('supportData', 'produkLaku', 'produkRugi'));
    }
}
