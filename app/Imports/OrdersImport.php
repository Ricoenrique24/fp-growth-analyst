<?php

// app/Imports/OrdersImport.php

namespace App\Imports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class OrdersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Konversi tanggal menggunakan fungsi transformDate
        $tanggal = $this->transformDate($row['tanggal']);
        $tglTerakhirDibayar = $this->transformDate($row['tgl_terakhir_dibayar']);

        // Menggunakan firstOrCreate untuk menghindari duplikasi data
        return Order::firstOrCreate(
            [
                'no_transaksi' => $row['no_transaksi'],
            ],
            [
                'tanggal' => $tanggal,
                'outlet' => $row['outlet'],
                'nomor_ref' => $row['nomor_ref'],
                'pelanggan' => $row['pelanggan'],
                'produk' => $row['produk'],
                'qty' => (int) $row['qty'],
                'subtotal' => (float) $row['subtotal'],
                'pajak' => (float) $row['pajak'],
                'service_charge' => (float) $row['service_charge'],
                'total' => (float) $row['total'],
                'dibayar' => (float) $row['dibayar'],
                'tgl_terakhir_dibayar' => $tglTerakhirDibayar,
                'sisa_tagihan' => (float) $row['sisa_tagihan'],
                'status' => $row['status'],
            ]
        );
    }

    private function transformDate($date)
    {
        // Jika date adalah numerik, konversi menggunakan excelToDateTimeObject
        if (is_numeric($date)) {
            return Date::excelToDateTimeObject($date);
        }
        // Jika date adalah string, konversi menggunakan format yang sesuai
        return \DateTime::createFromFormat('d/m/Y H:i', $date) ?: null;
    }
}
