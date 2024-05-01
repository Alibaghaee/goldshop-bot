<?php

namespace App\Exports;



use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class TravelsExport implements FromView, WithEvents
{
    use Exportable;

    public function __construct($travels)
    {
        $this->travels = $travels;
    }

    public function collection()
    {
        return $this->travels;
    }

    public function view(): View
    {
         $travels = $this->travels;

        return view('excel_exports.travels',
            compact(
                'travels'
            )
        );
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
