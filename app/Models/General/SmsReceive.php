<?php

namespace App\Models\General;

use App\Jobs\SendSmsJob;
use App\Traits\Models\Uri;
use App\Filters\Filterable;
use App\Traits\Models\View;
use Illuminate\Support\Arr;
use Morilog\Jalali\Jalalian;
use App\Models\General\Member;
use App\Models\General\SmsSend;
use App\Models\General\TabiatCode;
use App\Models\General\LotteryZojino;
use App\Models\General\TabiatProduct;
use Jenssegers\Mongodb\Eloquent\Model;

class SmsReceive extends Model
{
    use Uri, View, Filterable;

    protected $connection = 'mongodb';

    protected $collection = 'sms_receives';

    // protected $primaryKey = 'id';

    protected $route_name = 'sms_receives';

    protected $guarded = [];

    public function getCreatedAtFaAttribute()
    {
        return $this->created_at ? Jalalian::fromDateTime($this->created_at)->format('Y/m/d H:i:s') : '';
    }

    public function getUpdatedAtFaAttribute()
    {
        return $this->updated_at ? Jalalian::fromDateTime($this->updated_at)->format('Y/m/d H:i:s') : '';
    }

    public function process()
    {
        $id_value = 0;

        $valid_codes = TabiatCode::query()
            ->where('code', $this->note)
            ->where('status', 0);

        // add new memebr if not exist before
        $member = Member::firstOrCreate(['mobile' => $this->sender]);

        // valid code exists
        if ($valid_codes->count() >= 1) {
            $id_value = LotteryZojino::count();

            $valid_codes->update([
                'status'           => 1,
                'member_id'        => $member->id,
                'row_id'           => ++$id_value,
                'utilization_date' => mongoNow(),
            ]);

            $this->markCodeIsValid();
            $this->setProductId();
            $sendable_sms_note_id = 1;
            $this->addRecordToJojinoLotteryData($id_value);

            // valid code not extist
        } else {
            $code_is_used_before = TabiatCode::isUsedBefore($this->note);

            if ($code_is_used_before) {
                $this->markCodeIsReplicate();

                if (TabiatCode::isUsedBeforeBy($this->note, $member)) {
                    $sendable_sms_note_id = 2;
                } else {
                    $sendable_sms_note_id = 3;
                }
            } else {
                $this->markCodeIsNotValid();
                $sendable_sms_note_id = 4;
            }
        }

        $sms_send = SmsSend::create([
            'member_id' => $member->id,
            'mobile'    => $member->mobile,
            'note'      => $this->smsNotes($sendable_sms_note_id, $id_value),
            'sender'    => env('SMS_SENDER_NUMBER'),
            'status'    => 0,
        ]);

        SendSmsJob::dispatch($sms_send);

        $this->markIsProcessed();
    }

    public static function addReceivedSms($receive_sms)
    {
        return static::create([
            'sender'     => Arr::get($receive_sms, 'from'),
            'receiver'   => Arr::get($receive_sms, 'to'),
            'note'       => toLatinDigits(Arr::get($receive_sms, 'content')),
            'sms_id'     => Arr::get($receive_sms, 'id'),
            'status'     => 0,
            'code_state' => 0,

            // 'sender'     => Arr::get($receive_sms, 'sender_number'),
            // 'receiver'   => Arr::get($receive_sms, 'receiver_number'),
            // 'note'       => toLatinDigits(Arr::get($receive_sms, 'note')),
            // 'sms_id'     => Arr::get($receive_sms, 'id'),
            // 'status'     => 0,
            // 'code_state' => 0,
        ]);
    }

    public function markCodeIsValid()
    {
        return $this->update([
            'code_state' => 1, // is valid
        ]);
    }

    public function markCodeIsReplicate()
    {
        return $this->update([
            'code_state' => 3, // is replicate code
        ]);
    }

    public function markCodeIsNotValid()
    {
        return $this->update([
            'code_state' => 2, // is not valid
        ]);
    }

    public function markIsProcessed()
    {
        return $this->update([
            'status' => 1, // is processed
        ]);
    }

    public function setProductId()
    {
        $tabiat_code = TabiatCode::where('code', $this->note)->first();
        if ($tabiat_code) {
            $this->update([
                'tabiat_product_id' => $tabiat_code->tabiat_product_id
            ]);
        }
    }

    public function smsNotes($sendable_sms_note_id, $id_value = 0)
    {
        $notes = [
            '1' => setting(48) . $id_value,
            '2' => setting(50),
            '3' => setting(51),
            '4' => setting(49),
        ];

        return Arr::get($notes, $sendable_sms_note_id);
    }

    public function getStatusTitleAttribute()
    {
        return collect(config('portal.sms_receive.status'))->where('id', $this->status)->first()['name'] ?? '';
    }

    public function getCodeStateTitleAttribute()
    {
        return collect(config('portal.sms_receive.code_state'))->where('id', $this->code_state)->first()['name'] ?? '';
    }

    public function tabiat_product()
    {
        return $this->belongsTo(TabiatProduct::class, 'tabiat_product_id', 'id');
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

    protected function addRecordToJojinoLotteryData($id)
    {
        LotteryZojino::create([
            'mobile'   => $this->sender,
            'code'     => $this->note,
            'total_id' => $id,
        ]);
    }

    // {{dont_delete_this_comment}}
}
