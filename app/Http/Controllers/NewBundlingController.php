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

class NewBundlingController extends Controller
{
    /**
     * Display a listing of the App\Models\Bundling.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
  {
      // Query untuk BundlingLaku (Top 10 berdasarkan confidence descending)
      $bundlingLaku = DB::table('association_rules')
                      ->select('antecedent', 'consequent', 'confidence')
                      ->orderBy('confidence', 'desc')
                      ->limit(5)
                      ->get();

      // Query untuk BundlingRugi (Bottom 10 berdasarkan confidence ascending)
      $bundlingRugi = DB::table('association_rules')
                      ->select('antecedent', 'consequent', 'confidence')
                      ->orderBy('confidence', 'asc')
                      ->limit(5)
                      ->get();
                      
      // Mengirimkan data ke view 'beranda'
      return view('bundlings.index', compact('bundlingLaku', 'bundlingRugi'));
  }

}
