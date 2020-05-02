<?php

namespace App\Exports;

use App\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PembayaranReport implements FromView
{
    public function view(): View
    {
        return view('excel.pembayaran', [
            'nomor' => 1,
            'orders' => Order::with('students')->get()
        ]);
    }
}
