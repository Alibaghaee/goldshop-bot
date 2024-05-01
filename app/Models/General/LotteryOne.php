<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Models\General\LotteryZojino;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Morilog\Jalali\Jalalian;

class LotteryOne extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'lottery_ones';

    protected $guarded = [];

    protected $dates = ['date'];

    protected $appends = ['run_lottery_uri', 'get_file_uri'];

    protected $casts = ['winner_data' => 'array'];

    // for csv export
    protected $export_headers = ['mobile', 'code', 'row_id'];
    protected $export_fields  = ['mobile', 'code', 'total_id'];
    protected $export_take    = 50000;
    protected $export_skip    = 0;

    public function getCreatedAtFaAttribute()
    {
        return $this->created_at ? Jalalian::fromDateTime($this->created_at)->format('Y/m/d H:i:s') : '';
    }

    public function getDateFaAttribute()
    {
        return $this->date ? Jalalian::fromDateTime($this->date)->format('Y/m/d H:i:s') : '';
    }

    protected function getDateFaDashed()
    {
        return $this->date ? Jalalian::fromDateTime($this->date)->format('Y-m-d') : '';
    }

    public function getStatusTitleAttribute()
    {
        return collect(config('portal.lottery_one.status'))->where('id', $this->status)->first()['name'] ?? '';
    }

    public function getRunLotteryUriAttribute()
    {
        return route('lottery_ones.run_lottery', [$this->id]);
    }

    public function getGetFileUriAttribute()
    {
        return route('lottery_ones.get_file', [$this->id]);
    }

    public function runningExport()
    {
        return $this->update(['status' => 1]);
    }

    public function successfulExport()
    {
        return $this->update(['status' => 2]);
    }

    public function unsuccessfulExport()
    {
        return $this->update(['status' => 3]);
    }

    /**
     * generat export file in memory optimized mode
     *
     * @return void
     */
    public function exportCsv()
    {
        // set count
        $this->update(['count' => $this->getLotteryDataCount()]);

        $this->runningExport();

        $filename = 'lottert_one_exports/' . $this->id . '_' . $this->getDateFaDashed() . '_' . $this->count . '.csv';
        $chunks   = (int) ceil($this->count / $this->export_take);

        // set csv headers
        if (!Storage::disk('files')->put($filename, implode(',', $this->export_headers))) {
            $this->unsuccessfulExport();
        }

        // insert data in file
        for ($i = 0; $i <= $chunks; $i++) {
            $records = $this->getLotteryDataStringFormat();

            if (!Storage::disk('files')->append($filename, $records)) {
                $this->unsuccessfulExport();
            }
            $this->updatePercent();

            $this->export_skip += $this->export_take;
        }

        $this->update(['file' => $filename]);
        $this->successfulExport();
    }

    protected function getLotteryData()
    {
        return LotteryZojino::inDate($this->date)
            ->orderBy('_id', 'asc')
            ->skip($this->export_skip)
            ->take($this->export_take)
            ->get();
    }

    protected function getLotteryDataCount()
    {
        return LotteryZojino::inDate($this->date)->count();
    }

    protected function getLotteryDataStringFormat()
    {
        $records = [];

        foreach ($this->getLotteryData() as $record) {
            $records[] = implode(',', $record->only($this->export_fields));
        }

        return implode(PHP_EOL, $records);
    }

    protected function updatePercent()
    {
        $calc    = ($this->export_skip + $this->export_take) / $this->count;
        $percent = $calc > 1 ? 100 : ceil($calc * 100);

        $this->update(['percent' => $percent]);
    }

    // {{dont_delete_this_comment}}
}
