<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class DiscountItemsExport implements FromView, WithEvents
{
    use Exportable;

    public function __construct($discount_items)
    {
        $this->discount_items = $discount_items;
    }

    public function collection()
    {
        return $this->discount_items;
    }

    public function view(): View
    {
        return view('excel_exports.discount_items', [
            'discount_items' => $this->discount_items,
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
}
