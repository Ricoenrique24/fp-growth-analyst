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

class NewTransactionController extends Controller
{
    /**
     * Display a listing of the App\Models\Transaction.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Mengambil Keseluruhan Data Transaksi (3 Bulan) {10 Data}
        $threeBulan = DB::table('orders')
            ->where('tanggal', '>=', DB::raw("DATE_SUB((SELECT MAX(tanggal) FROM orders), INTERVAL 3 MONTH)"))
            ->orderBy('tanggal', 'DESC')
            ->limit(10)
            ->get();

        // Mengambil Keseluruhan Data Transaksi (1 Tahun) {10 Data}
        $oneYear = DB::table('orders')
            ->orderBy('tanggal', 'DESC')
            ->limit(10)
            ->get();

        // Mengambil Keseluruhan Data Transaksi (3 Bulan) {Data Grafik}
        $threeBulanChart = DB::table('exploded_products')
                    ->select('produk', DB::raw('COUNT(*) AS jumlah_produk'))
                    ->where('tanggal', '>=', DB::raw('DATE_SUB((SELECT MAX(tanggal) FROM exploded_products), INTERVAL 3 MONTH)'))
                    ->groupBy('produk')
                    ->orderByDesc('jumlah_produk')
                    ->limit(10)
                    ->get();

        // Mengambil Keseluruhan Data Transaksi (1 Tahun) {Data Grafik}
        $oneYearChart = DB::table('exploded_products')
                    ->select('produk', DB::raw('COUNT(*) AS jumlah_produk'))
                    ->groupBy('produk')
                    ->orderByDesc('jumlah_produk')
                    ->limit(10)
                    ->get();

        // Mengambil jumlah produk
        $count_produk = DB::table('exploded_products')
            ->distinct('produk')
            ->count('produk');

        // Mengambil jumlah transaksi
        $count_order = DB::table('orders')
            ->count('produk');


        return view('transactions.index')
            ->with('month_data', $threeBulan)
            ->with('month_chart', $threeBulanChart)
            ->with('year_data', $oneYear)
            ->with('year_chart', $oneYearChart)
            ->with('count_product', $count_produk)
            ->with('count_order', $count_order);
    }

}

// Note: 
// Sintaks untuk generate exploded item
// -- Buat tabel sementara untuk menyimpan hasil eksploitasi
// CREATE TEMPORARY TABLE exploded_products (
//     no_transaksi VARCHAR(255),
//     tanggal DATE,
//     produk VARCHAR(255)
// );

// -- Menggunakan perulangan numerik untuk memecah string produk menjadi elemen individual dari tabel orders
// INSERT INTO exploded_products (no_transaksi, tanggal, produk)
// SELECT 
//     o.no_transaksi,
//     DATE(o.tanggal) AS tanggal,
//     TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(o.produk, ',', numbers.n), ',', -1)) AS produk
// FROM 
//     orders o
// CROSS JOIN (
//     SELECT 1 n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL 
//     SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL 
//     SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL 
//     SELECT 10
// ) numbers
// WHERE 
//     CHAR_LENGTH(o.produk) - CHAR_LENGTH(REPLACE(o.produk, ',', '')) >= numbers.n - 1;

// -- Tampilkan hasil
// SELECT * FROM exploded_products;

