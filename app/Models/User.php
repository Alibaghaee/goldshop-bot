<?php

namespace App\Models;

use App\Events\SendPurchaseLinkEvent;
use App\Filters\Filterable;
use App\Models\General\Travel;
use App\ModelsScope\Traits\DomainScopeTrait;
use App\Models\General\Field;
use App\Models\General\Form;
use App\Models\General\Package;
use App\Models\General\ProductItem;
use App\Models\General\Purchase;
use App\Models\General\PurchaseDetail;
use App\Traits\Models\Uri;
use App\Traits\Models\View;
use App\Traits\NewsLetter\HasNewsLetter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Morilog\Jalali\Jalalian;

class User extends Authenticatable
{
    use Notifiable, Uri, View, Filterable, HasNewsLetter;

    protected $route_name = 'users';

    protected $guarded = [];

    protected $appends = [
        'gender_title',
        'field_title',
        'grade_title',
        'field_of_study_title',
        'city_title',
        'province_title',
        'total_verified_travel',
        'fullname',
    ];

    protected $casts = [
        'iban_meta' => 'array',
        'active_mobile' => 'boolean'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullnameAttribute()
    {
        return $this->name . ' ' . $this->family;
    }

    public function getSuccessLoginMessageAttribute()
    {
        return 'کاربر گرامی : ' . $this->fullname . ' ورود شما با موفقیت انجام شد.';
    }

    /**
     * upload file
     *
     * @param Illuminate\Http\UploadedFile $file request file
     * @param string $store_path
     * @param boolean $hashed_filename
     * if set to True a random hashed file name will be generate (the file path will like /$store_path/haeshed_file_name)
     * if Not the file name will be the user id (the file path will like /$store_path/user_id.file_extension)
     * @return array return file_path in an array
     */
    public function uploadFile(UploadedFile $file, $store_path = null, $hashed_filename = false, $disk = 'public')
    {
        if (!$store_path) {
            $store_path = $this->id;
        }
        if ($hashed_filename) {
            $file_path = $file->store($store_path, ['disk' => $disk]);
        } else {
            $filename = $file->getClientOriginalName();
            $file_path = $file->storeAs($store_path, $filename, ['disk' => $disk]);
        }
        $file_path = '/storage/' . $file_path;
        return [['path' => $file_path]];
    }

    public function updateUser($data)
    {
        $data = multiselect_adapter($data);
        if (!empty(array_get($data, 'password', ''))) {
            $data['password'] = bcrypt($data['password']);
        }
        $this->update($data);
    }

    public function province()
    {
        return $this->belongsTo('App\Models\General\Province');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\General\City');
    }

    public function getGenderTitleAttribute()
    {
        return Arr::get(collect(config('portal.genders'))->firstWhere('id', $this->gender), 'name');
    }

    public function getFieldTitleAttribute()
    {
        return Arr::get(collect(config('portal.fields'))->firstWhere('id', $this->field), 'name');
    }

    public function getCreatedAtFaAttribute()
    {
        return Jalalian::fromDateTime($this->created_at)->format('Y/m/d H:i');
    }

    public function getUpdatedAtFaAttribute()
    {
        return Jalalian::fromDateTime($this->updated_at)->format('Y/m/d H:i');
    }

    public static function scopeAsOption($query)
    {

        return $query->select('id', \DB::raw("CONCAT(name, ' ', family, ' - کد اشتراک: ', subscrip_code) as name"))->get();
    }

    public function purchases()
    {
        return $this->hasMany('App\Models\General\Purchase');
    }

    public function purchase_details()
    {
        return $this->hasManyThrough(PurchaseDetail::class, Purchase::class)->where('Payed', true);
    }

    public function successful_purchases()
    {
        return $this->hasMany('App\Models\General\Purchase')->where('payed', true)->latest();
    }

    public function getTotalPurchasesPriceAttribute()
    {
        return $this->purchases->where('payed', true)->sum('price');
    }

    public function totalPurchasesPrice($package_id)
    {
        return $this->purchases->where('package_id', $package_id)->where('payed', true)->sum('price');
    }

    public function totalPurchasesDiscountPrice($package_id)
    {
        return $this->purchases->where('package_id', $package_id)->where('payed', true)->sum('discount_price');
    }

    public function getLastSuccessfulTrackingCodeAttribute()
    {
        return optional($this->purchases->where('payed', true)->sortByDesc('created_at')->first())->tracking_code;
    }

    public function payablePrice($package_id)
    {
        $package = Package::findOrFail($package_id);
        return $package->price - $this->totalPurchasesPrice($package_id) - $this->totalPurchasesDiscountPrice($package_id);
    }

    public function hasSuccessfulPurchase($package_id)
    {
        return boolval($this->purchases()->where('package_id', $package_id)->payed()->count());
    }

    public function getPurchasesListUriAttribute()
    {
        return '/purchases/purchases?user={"id":' . $this->id . '}';
    }

    /**
     * get the users registrations count in the given fields
     * @param integer $filed_id the userd field id
     * @return integer total count of users regisrations in the field
     */
    public static function fieldRegistrationsCount($field_id)
    {
        $total_price = setting(config('portal.setting_id.total_purchase_price'));

        return static::where('field', $field_id)->whereHas('purchases', function (Builder $query) use ($total_price) {
            $query->where('payed', true)
                ->groupBy('user_id')
                ->havingRaw('sum(price) >= ' . $total_price);
        })->count();
    }

    public static function allowedToRegisterByCheckingFieldId($field_id)
    {

        $field_registrations_count = static::fieldRegistrationsCount($field_id);
        $field_limit_count = setting(config('portal.fields_limit_setting_id.' . $field_id));

        if ($field_registrations_count >= $field_limit_count) {
            return false;
        }

        return true;
    }

    public static function allowedToRegisterInfo()
    {
        $fields = config('portal.fields');

        foreach ($fields as $key => $field) {
            $field_registrations_count = static::fieldRegistrationsCount($field['id']);
            $field_limit_count = setting(config('portal.fields_limit_setting_id.' . $field['id']));
            $fields[$key]['capacity'] = $field_limit_count;
            $fields[$key]['used'] = $field_registrations_count;
            $fields[$key]['percent'] = floor($field_registrations_count / $field_limit_count * 100);
        }

        return $fields;
    }

    public static function allowedToRegisterByCheckingNationalCode($national_code)
    {
        $user = static::where('national_code', $national_code)->first();

        if ($user) {
            return static::allowedToRegisterByCheckingFieldId($user->field);
        }

        return true;
    }

    public function refunds()
    {
        return $this->hasMany('App\Models\General\Refund');
    }

    public static function isAllowedToUpdateIban($national_code)
    {
        return static::where('national_code', $national_code)
            ->doesntHave('refunds')
            ->where(function ($query) {
                return $query->whereNull('iban')
                    ->orWhere('iban', '');
            })
            ->whereHas('purchases', function ($query) {
                $total_price = setting(config('portal.setting_id.total_purchase_price'));
                $query->where('payed', true)
                    ->groupBy('user_id')
                    ->havingRaw('sum(price) < ' . $total_price);
            })
            ->first();
    }

    public static function isRegisteredIban($national_code)
    {
        return static::where('national_code', $national_code)
            ->where(function ($query) {
                return $query->whereNull('iban')
                    ->orWhere('iban', '');
            })
            ->first();
    }

    public static function hasNotPurchase($national_code)
    {
        return static::where('national_code', $national_code)
            ->whereHas('purchases', function ($query) {
                $query->whereRaw('user_id not in (select user_id from purchases where payed = ?)', [true]);
            })
            ->first();
    }

    public static function isSupplementary($national_code)
    {
        return static::where('national_code', $national_code)
            ->whereHas('purchases', function ($query) {
                $total_price = setting(config('portal.setting_id.total_purchase_price'));
                $pre_price = setting(config('portal.setting_id.pre_purchase_price'));
                $supplementary_price = $total_price - $pre_price;

                $query->where('payed', true)
                    ->groupBy('user_id')
                    ->where(
                        function ($query) use ($total_price, $supplementary_price) {
                            return $query
                                ->where('price', $total_price)
                                ->orWhere('price', $supplementary_price);
                        });
            })
            ->first();
    }

    public function getGradeTitleAttribute()
    {
        return Arr::get(collect(config('portal.grades'))->firstWhere('id', $this->grade), 'name');
    }

    public function getFieldOfStudyTitleAttribute()
    {
        return Arr::get(collect(config('portal.fields_of_study'))->firstWhere('id', $this->field_of_study), 'name');
    }

    public function getFullnamePrependAttribute()
    {
        if ($this->gender == 0) {
            return 'خانم';
        }
        return 'آقای';
    }

    public function lastPurchase()
    {
        return $this->purchases()->latest()->first();
    }

    public function getPurchaseLinkAttribute()
    {
        return '/' . app()->getLocale() . '/bank/request?id=' . $this->lastPurchase()->id;
    }

    public function getCityTitleAttribute()
    {
        return optional($this->city)->name;
    }

    public function getProvinceTitleAttribute()
    {
        return optional($this->province)->name;
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class)->withTimestamps();
    }

    public function hasPackage($package_id = null)
    {
        if ($package_id) {
            return !!$this->packages()->where('packages.id', $package_id)->count();
        }
        return !!$this->packages()->count();
    }

    public function generateLoginInfoMessage()
    {
        return "نام کاربری و رمز عبور جهت ورود به بخش کاربری:\n لینک ورود:"
            . "\n"
            . route('login', app()->getLocale())
            . "\n"
            . "نام کاربری: " . $this->national_code
            . "\n"
            . "رمز عبور: " . $this->setRandomPassword()
            . "\n"
            . "بنیاد علمی و آموزشی شفیعی";
    }

    public function setRandomPassword()
    {
        $password = random_int(100000, 999999);
        $this->update('password', bcrypt($password));

        return $password;
    }

    protected function sendLoginInfoMessage()
    {
        $message = $this->generateLoginInfoMessage();

        sms($this->mobile, $message);
        sms($this->emergency_mobile, $message);
    }

    public function sendPaymentLinkMessage($payment)
    {
        $message = $this->paymentLinkMessage($payment);

        sms($this->mobile, $message);
        sms($this->emergency_mobile, $message);
    }

    public function paymentLinkMessage($payment)
    {
        return "لینک پرداخت فاکتور\n" . request()->getHttpHost() . $payment->payment_link;
    }

    public function fields()
    {
        return $this->belongsToMany(Field::class);
    }

    public function uncompleteFields(Form $form)
    {
        return $form->fields->diff($this->fields->where('name', '!=', 'description'));
    }

    public function canPrePayment(Package $package)
    {
        return !$this->hasSuccessfulPurchase($package->id) && $package->allow_installment;
    }

    public function canFullPayment(Package $package)
    {
        return !$this->hasSuccessfulPurchase($package->id);
    }

    public function canSupplementaryPayment(Package $package)
    {
        return $this->hasSuccessfulPurchase($package->id) && $this->payablePrice($package->id) > 0;
    }

    public function tracks()
    {
        return $this->belongsToMany(ProductItem::class, 'video_user', 'user_id', 'video_id')
            ->withTimestamps()
            ->withPivot('duration', 'current_time', 'state', 'remaining_time_display');
    }

    public function videoTrackPercent($product_item_id)
    {
        return auth()->guard('web')->check()
            ? auth()->user()->tracks()->where('product_items.id', $product_item_id)->first()->pivot->remaining_time_display
            / auth()->user()->tracks()->where('product_items.id', $product_item_id)->first()->pivot->duration
            * 100
            : 0;
    }

    public function scopeFindWithNumber($query, $number)
    {
        return $query->where('mobile', $number)->orWhere('second_mobile', $number);
    }

    public function scopeFindWithSubscripCode($query, $code)
    {
        return $query->where('subscrip_code', $code);
    }


    public function depositWallet(int $amount)
    {
        $this->increment('wallet', $amount);
    }

    public function withdrawalWallet(int $amount)
    {
        $this->decrement('wallet', $amount);
    }

    public function sendPurchaseLink($item)
    {

        event(new SendPurchaseLinkEvent($this, $item));
    }

    /**
     * Define a one-to-many relationship to Travel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function travels()
    {
        return $this->hasMany(Travel::class);
    }

    public function getTotalVerifiedTravelAttribute()
    {
        return $this->travels()->where('status', Travel::$VERIFY)->count();
    }

    public static function accompanyingPersonCond(string $string)
    {
        if ($string === "دارد" || $string === "ندارد") {

            return true;
        }
        return false;
    }


    public function tryActiveMobile()
    {
        $this->active_mobile = true;
        $this->save();
    }
}
