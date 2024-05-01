<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class PaysExport implements FromView, WithEvents
{
    use Exportable;

    public function __construct($pays)
    {
        $this->pays = $pays;
    }

    public function collection()
    {
        return $this->pays;
    }

    public function view(): View
    {
        return view('excel_exports.pays', [
            'pays' => $this->pays,
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
