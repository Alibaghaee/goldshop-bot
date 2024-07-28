<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class OrdersExport implements FromView, WithEvents,ShouldAutoSize,WithColumnWidths
{
    use Exportable ;

    public  $orders;

    public function __construct($orders)
    {
        $this->orders = $orders;
    }



    public function view(): View
    {
        return view('excel_exports.orders', [
            'orders' => $this->orders,
        ]);
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
            },

        ];
    }

    public function columnWidths():array
    {
        return [
            'A' => 20,
            'B' => 30,
            'C' => 40,
            'D' => 20,
            'E' => 20,
            'F' => 30,
            'G' => 30,
            'H' => 30,
            'I' => 30,
        ];
    }
}
