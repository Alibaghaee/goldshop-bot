<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class SmsReceivesExport implements FromView, WithEvents
{
    use Exportable;

    public function __construct($sms_receives)
    {
        $this->sms_receives = $sms_receives;
    }

    public function collection()
    {
        return $this->sms_receives;
    }

    public function view(): View
    {
        return view('excel_exports.sms_receives', [
            'sms_receives' => $this->sms_receives,
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
