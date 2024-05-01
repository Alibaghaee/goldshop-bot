<?php

namespace App\Jobs;

use App\Repository\SmsReceiveRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 1800;

    protected $report;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($report)
    {
        $this->report = $report;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->report->update(['status' => 1]);

        if ($this->report->chart_type == 1) {
            $result = SmsReceiveRepository::reportByDayGroupMonthly($this->report->criteria);
        } else if ($this->report->chart_type == 2) {
            $result = SmsReceiveRepository::reportIn24Hour($this->report->criteria);
        } else if ($this->report->chart_type == 3) {
            $result = SmsReceiveRepository::reportByProduct($this->report->criteria);
        }

        $this->report->update([
            'result' => $result,
            'status' => 2,
        ]);
    }
}
