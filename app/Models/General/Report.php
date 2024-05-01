<?php

namespace App\Models\General;

use App\Filters\Filterable;
use App\Models\General\TabiatProduct;
use App\Models\General\TabiatProductCategory;
use App\Repository\SmsReceiveRepository;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use MongoDB\BSON\UTCDateTime;
use Morilog\Jalali\Jalalian;

class Report extends Model
{
    use Uri, View, Filterable;

    protected $route_name = 'reports';

    protected $guarded = [];

    protected $casts = [
        'result'              => 'array',
        'criteria'            => 'array',
        'product_category_id' => 'integer',
        'product_id'          => 'integer',
        'sms_status'          => 'integer',
        'sms_code_state'      => 'integer',
    ];

    protected $dates = ['date_from', 'date_to'];

    // for csv export
    protected $export_headers = ['mobile', 'note', 'status', 'code_state', 'created_at'];
    protected $export_fields  = ['sender', 'note', 'status', 'code_state', 'created_at'];
    protected $export_take    = 50000;
    protected $export_skip    = 0;

    public function getChartTypeTitleAttribute()
    {
        return collect(config('portal.report.chart_types'))->where('id', $this->chart_type)->first()['name'] ?? '';
    }

    public function getStatusTitleAttribute()
    {
        return collect(config('portal.report.status'))->where('id', $this->status)->first()['name'] ?? '';
    }

    public function getDateFromFaAttribute()
    {
        return $this->date_from ? Jalalian::fromDateTime($this->date_from)->format('Y/m/d H:i:s') : '';
    }

    public function getDateToFaAttribute()
    {
        return $this->date_to ? Jalalian::fromDateTime($this->date_to)->format('Y/m/d H:i:s') : '';
    }

    public function getCreatedAtFaAttribute()
    {
        return $this->created_at ? Jalalian::fromDateTime($this->created_at)->format('Y/m/d H:i:s') : '';
    }

    public function getUpdatedAtFaAttribute()
    {
        return $this->updated_at ? Jalalian::fromDateTime($this->updated_at)->format('Y/m/d H:i:s') : '';
    }

    public function getSmsStatusTitleAttribute()
    {
        return collect(config('portal.sms_receive.status'))->where('id', $this->status)->first()['name'] ?? '';
    }

    public function getSmsCodeStateTitleAttribute()
    {
        return collect(config('portal.sms_receive.code_state'))->where('id', $this->code_state)->first()['name'] ?? '';
    }

    public function tabiat_product()
    {
        return $this->belongsTo(TabiatProduct::class, 'product_id', 'id');
    }

    public function getTabiatProductTitleAttribute()
    {
        return optional($this->tabiat_product)->title ?? '';
    }

    public function tabiat_product_category()
    {
        return $this->belongsTo(TabiatProductCategory::class, 'tabiat_product_category_id', 'id');
    }

    public function getTabiatProductCategoryTitleAttribute()
    {
        return optional($this->tabiat_product)->tabiat_product_category_title ?? '';
    }

    public function getCriteriaAttribute()
    {
        $criteria = [];

        if (!blank($this->note)) {
            $criteria['note'] = ['$in' => $this->parsed_note];
        }

        if (!blank($this->sms_status)) {
            $criteria['status'] = $this->sms_status;
        }

        if (!blank($this->sms_code_state)) {
            $criteria['code_state'] = $this->sms_code_state;
        }

        if (!blank($this->product_id)) {
            $criteria['tabiat_product_id'] = ['$in' => [$this->product_id]];
        }

        if (!blank($this->product_category_id)) {
            $tabiat_products_id = TabiatProduct::where('tabiat_product_category_id', $this->product_category_id)->pluck('id')->toArray();

            $criteria['tabiat_product_id'] = ['$in' => $tabiat_products_id];
        }

        if (!blank($this->date_from)) {
            $criteria['created_at']['$gt'] = new UTCDateTime($this->date_from->timestamp * 1000);
        }

        if (!blank($this->date_to)) {
            $criteria['created_at']['$lt'] = new UTCDateTime($this->date_to->timestamp * 1000);
        }

        return ['$match' => $criteria];
    }

    public function getParsedNoteAttribute()
    {
        return array_map('trim', explode(PHP_EOL, $this->note));
    }

    public function getGetFileUriAttribute()
    {
        return route('reports.get_file', [$this->id]);
    }

    /**
     * generat export file in memory optimized mode
     *
     * @return void
     */
    public function exportCsv()
    {
        // set count
        $this->update(['count' => SmsReceiveRepository::getCountByCriteria($this->criteria)]);

        $this->runningExport();

        $filename = 'report_exports/' . $this->id . '_' . $this->getDateFaDashed() . '_' . $this->count . '.csv';
        $chunks   = (int) ceil($this->count / $this->export_take);

        // set csv headers
        if (!Storage::disk('files')->put($filename, implode(',', $this->export_headers))) {
            $this->unsuccessfulExport();
        }

        // insert data in file
        for ($i = 0; $i <= $chunks; $i++) {
            $records = $this->getReportDataStringFormat();

            if (!Storage::disk('files')->append($filename, $records)) {
                $this->unsuccessfulExport();
            }
            $this->updatePercent();

            $this->export_skip += $this->export_take;
        }

        $this->update(['file' => $filename]);
        $this->successfulExport();
    }

    protected function getLotteryDataCount()
    {
        return SmsReceive::inDate($this->date)->count();
    }

    public function runningExport()
    {
        return $this->update(['file_status' => 1]);
    }

    public function successfulExport()
    {
        return $this->update(['file_status' => 2]);
    }

    public function unsuccessfulExport()
    {
        return $this->update(['file_status' => 3]);
    }

    protected function getReportData()
    {
        return SmsReceiveRepository::getDataByCriteria(
            $this->criteria,
            $this->export_skip,
            $this->export_take
        );
    }

    protected function getReportDataStringFormat()
    {
        $records = [];

        foreach ($this->getReportData() as $record) {
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

    protected function getDateFaDashed()
    {
        return $this->date ? Jalalian::fromDateTime($this->created_at)->format('Y-m-d') : '';
    }

    // {{dont_delete_this_comment}}
}
