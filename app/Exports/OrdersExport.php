<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrdersExport implements FromView
{
    public function __construct(public $oid){}
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection($id)
    // {
    //     return Order::where('id', $id)->get();
    // }

    public function view(): View
    {
        return view('exports.order', [
            'orders' => Order::where('id', $this->oid)->get()
        ]);
    }

    // public function map($order): array
    // {
    //     return [
    //         $order->id,
    //         $invoice->user->name,
    //         Date::dateTimeToExcel($invoice->created_at),
    //     ];
    // }
}
