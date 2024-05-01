<?php

use App\Http\Controllers\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\General\AdminController;
use App\Http\Controllers\General\LevelController;
use App\Jobs\SendSmsJob;
use App\Jobs\SmsReceiveProcessJob;
use App\Models\General\Lottery;
use App\Models\General\LotteryZojino;
use App\Models\General\Member;
use App\Models\General\Setting;
use App\Models\General\SmsReceive;
use App\Models\General\SmsSend;
use App\Models\General\TabiatCode;
use App\Repository\SmsReceiveRepository;
use Illuminate\Support\Arr;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::group(['prefix' => '', 'middleware' => ['auth:admin']], function () {



    Route::any('editor-files-upload', 'Uploader\AttachmentController@editorUpload')->name('editor.files.upload');


    Route::post('delete-locale-files', 'Uploader\AttachmentController@destroyFile')->name('main.destroy.file');

});


Route::get('/files/{path}', 'General\FilesController@getJozveh');
Route::get('/files/{id}/{type}/{path}', 'General\FilesController@getFile');

Route::prefix('admin')->group(function () {
    // admin login routes
    Route::get('login', [AdminLoginController::class,'showAdminLoginForm']);
    Route::post('login', [AdminLoginController::class,'adminLogin'])->name('admin.login');
    //admin password reset routes
    Route::post('password/email', [AdminForgotPasswordController::class,'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('password/reset', [AdminForgotPasswordController::class,'showLinkRequestForm'])->name('admin.password.request');
    // Route::post('password/reset', 'Auth\AdminResetPasswordController@reset');
    // Route::get('password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});

Route::middleware(['auth:admin', \App\Http\Middleware\PermissionMiddleware::class])->group(function () {
     Route::get('dashboard', [\App\Http\Controllers\General\HomeController::class,'index'])->name('dashboard');
    Route::get('dashboard/report', [\App\Http\Controllers\General\HomeController::class,'report'])->name('report');
    Route::post('lottery', [\App\Http\Controllers\General\HomeController::class,'lottery'])->name('lottery');
    Route::resource('admins/admins', \App\Http\Controllers\General\AdminController::class);
    Route::get('users/users/export', [\App\Http\Controllers\General\UserController::class,'export'])->name('users.export');
    Route::resource('users/users', \App\Http\Controllers\General\UserController::class);
    Route::resource('levels/levels', \App\Http\Controllers\General\LevelController::class);
    Route::resource('facilities/facilities', \App\Http\Controllers\General\FacilityController::class);
    Route::resource('settings/settings', \App\Http\Controllers\General\SettingController::class);

    Route::resource('categories/categories', \App\Http\Controllers\General\CategoryController::class);
    Route::resource('categories.categoryitems', \App\Http\Controllers\General\CategoryItemController::class);
    Route::resource('categories.order', \App\Http\Controllers\General\CategoryItemOrderController::class)->only(['index', 'store']);


    Route::resource('menus/menus', \App\Http\Controllers\General\MenuController::class);
    Route::resource('menus.menu_items', \App\Http\Controllers\General\MenuItemController::class);
    Route::resource('menus.order', \App\Http\Controllers\General\MenuItemOrderController::class)->only(['index', 'store']);

    Route::resource('contents/contents', \App\Http\Controllers\General\ContentController::class);

    Route::resource('profiles/profiles', \App\Http\Controllers\General\ProfileController::class)->only(['edit', 'update']);

    Route::resource('products/products', \App\Http\Controllers\General\ProductController::class);
    Route::resource('tags/tags', \App\Http\Controllers\General\TagController::class);
    Route::resource('products.product_items', \App\Http\Controllers\General\ProductItemController::class);
    Route::resource('products.order', \App\Http\Controllers\General\ProductItemOrderController::class)->only(['index', 'store']);
    Route::get('purchases/purchases/export', [\App\Http\Controllers\General\PurchaseController::class,'export'])->name('purchases.export');
    Route::resource('purchases/purchases', \App\Http\Controllers\General\PurchaseController::class);
    Route::resource('contacts/contacts', \App\Http\Controllers\General\ContactController::class);
    Route::resource('discounts/discounts', \App\Http\Controllers\General\DiscountController::class);
    Route::get('discounts/{discount}/discount_items/export', [\App\Http\Controllers\General\DiscountItemController::class,'export'])->name('discounts.discount_items.export');
    Route::resource('discounts.discount_items', \App\Http\Controllers\General\DiscountItemController::class);
    Route::resource('packages/packages', \App\Http\Controllers\General\PackageController::class);
    Route::resource('forms/forms', \App\Http\Controllers\General\FormController::class);
    Route::resource('forms/fields', \App\Http\Controllers\General\FieldController::class);
    Route::resource('notifies/notifies', \App\Http\Controllers\General\NotifyController::class);
    Route::resource('prizes/prizes', \App\Http\Controllers\General\PrizeController::class);
    Route::resource('members/members', \App\Http\Controllers\General\MemberController::class);
    Route::resource('sms_sends/sms_sends', \App\Http\Controllers\General\SmsSendController::class);
    Route::get('sms_receives/sms_receives/export', [\App\Http\Controllers\General\SmsReceiveController::class,'export']);
    Route::resource('sms_receives/sms_receives', \App\Http\Controllers\General\SmsReceiveController::class);
    Route::resource('tabiat_product_categories/tabiat_product_categories', \App\Http\Controllers\General\TabiatProductCategoryController::class);
    Route::resource('tabiat_products/tabiat_products', \App\Http\Controllers\General\TabiatProductController::class);
    Route::get('tabiat_codes/tabiat_codes/export', [\App\Http\Controllers\General\TabiatCodeController::class,'export']);
    Route::get('tabiat_codes/tabiat_codes/insert', [\App\Http\Controllers\General\TabiatCodeController::class,'insertForm'])->name('tabiat_codes.insert_form');
    Route::post('tabiat_codes/tabiat_codes/insert', [\App\Http\Controllers\General\TabiatCodeController::class,'insert'])->name('tabiat_codes.insert');
    Route::resource('tabiat_codes/tabiat_codes', \App\Http\Controllers\General\TabiatCodeController::class);
    Route::resource('reports/reports', \App\Http\Controllers\General\ReportController::class);
    Route::get('reports/reports/get_file/{report}', [\App\Http\Controllers\General\ReportController::class,'getFile'])->name('reports.get_file');
    Route::resource('lottery_ones/lottery_ones', \App\Http\Controllers\General\LotteryOneController::class);
    Route::post('lottery_ones/lottery_ones/run_lottery/{lottery_one}', [\App\Http\Controllers\General\LotteryOneController::class,'runLottery'])->name('lottery_ones.run_lottery');
    Route::get('lottery_ones/lottery_ones/get_file/{lottery_one}', [\App\Http\Controllers\General\LotteryOneController::class,'getFile'])->name('lottery_ones.get_file');
    Route::resource('selected_customers/selected_customers', \App\Http\Controllers\General\SelectedCustomerController::class);


    Route::get('maps/maps/maps_clone/{mapClone}', [\App\Http\Controllers\General\MapController::class,'showClone'])->name('maps.showClone');
    Route::put('maps/maps/send_location/{map}', [\App\Http\Controllers\General\MapController::class,'sendLocation'])->name('maps.sendLocation');
    Route::delete('maps/maps/force_delete/{map}', [\App\Http\Controllers\General\MapController::class,'forceDelete'])->name('maps.forceDelete');
    Route::get('maps/maps/restore/{map}', [\App\Http\Controllers\General\MapController::class,'restore'])->name('maps.restore');
    Route::get('maps/maps/index_clone/{map}', [\App\Http\Controllers\General\MapController::class,'indexClone'])->name('maps.indexClone');

    Route::resource('maps/maps', \App\Http\Controllers\General\MapController::class);
    Route::resource('admin_profiles/admin_profiles', \App\Http\Controllers\General\AdminProfileController::class);

    Route::get('travels/travels/export', [\App\Http\Controllers\General\TravelController::class,'export'])->name('travels.export');
    Route::put('travels/travels/verify/{travel}', [\App\Http\Controllers\General\TravelController::class,'verify'])->name('travels.verify');

    Route::resource('travels/travels', \App\Http\Controllers\General\TravelController::class);
    Route::get('/drivers/drivers/show_travels/{driver}', [\App\Http\Controllers\General\DriverController::class,'showTravels'])->name('drivers.showTravels');
    Route::get('/drivers/drivers/index-as-option', [\App\Http\Controllers\General\DriverController::class,'indexAsOption'])->name('drivers.indexAsOption');
    Route::resource('drivers/drivers', \App\Http\Controllers\General\DriverController::class);

    Route::post('news_letters/news_letters/store-driver', [\App\Http\Controllers\General\NewsLetterController::class,'storeForDrivers'])->name('news_letters.driversStore');
    Route::get('news_letters/news_letters/driversCreate', [\App\Http\Controllers\General\NewsLetterController::class,'createForDrivers'])->name('news_letters.driversCreate');

    Route::resource('news_letters/news_letters', \App\Http\Controllers\General\NewsLetterController::class);
    Route::resource('sms_templates/sms_templates', \App\Http\Controllers\General\SmsTemplateController::class);
    Route::resource('contact_numbers/contact_numbers', \App\Http\Controllers\General\ContactNumberController::class);
    Route::resource('contact_categories/contact_categories', \App\Http\Controllers\General\ContactCategoryController::class);

    Route::post('single_sms_senders/single_sms_senders/getBalance', [\App\Http\Controllers\General\SingleSmsSenderController::class,'getBalance'])->name('single_sms_senders.getBalance');
    Route::resource('single_sms_senders/single_sms_senders', \App\Http\Controllers\General\SingleSmsSenderController::class);
    Route::resource('sender_numbers/sender_numbers', \App\Http\Controllers\General\SenderNumberController::class);
    Route::resource('panel_sms/panel_sms', \App\Http\Controllers\General\PanelSmsController::class);

    Route::post('group_sms_senders/group_sms_senders/getBalance', [\App\Http\Controllers\General\GroupSmsSenderController::class,'getBalance'])->name('group_sms_senders.getBalance');
    Route::resource('group_sms_senders/group_sms_senders', \App\Http\Controllers\General\GroupSmsSenderController::class);

    Route::resource('comments/comments', \App\Http\Controllers\General\CommentController::class);

     Route::resource('invoice_portals/invoice_portals', \App\Http\Controllers\General\InvoicePortalController::class);
    Route::resource('invoice_portals.invoice_body_portals', 'InvoiceBodyPortalController');
    // {{dont_delete_this_comment}}





});

Route::get('/',function (){


    return redirect()->route('dashboard');
});

//Route::prefix('{locale?}')->middleware([\App\Http\Middleware\Locale::class])->group(function () {
//    Auth::routes();
//    Route::post('/postal_code', [\App\Http\Controllers\Site\HomeController::class,'postalCode'])->name('home.postal_code');
//
//    Route::put('/post/comment/guest-store/{content}', 'Site\ContentController@storeGuestComment')
//        ->name('guest.content.comment.store');
//
//    // for Entekhab-Reshte
//    Route::get('/bank/request', 'Site\BankController@request');
//    Route::any('/bank/response', 'Site\BankController@response');
//
//    Route::middleware(['auth:web'])->group(function () {
//        Route::get('pay_page/', 'Site\PayPageController@index')->name('pay_page.index');
//        Route::get('pay_page/{package}', 'Site\PayPageController@show')->name('pay_page.show');
//        Route::post('pay_page/{package}', 'Site\PayPageController@pay')->name('pay_page.pay');
//        Route::resource('profile', 'Site\ProfileController')->only(['edit', 'update']);
//        Route::get('registration/receipt/{purchase}', 'Site\ReceiptController@receipt')->name('registration.receipt');
//        Route::get('registration/pdf/{purchase}', 'Site\ReceiptController@pdf')->name('registration.pdf');
//        Route::get('fill_out_profile/{package}', 'Site\FillOutProfileController@edit')->name('fill_out_profile.edit');
//        Route::post('fill_out_profile/{package}', 'Site\FillOutProfileController@update')->name('fill_out_profile.update');
//        Route::post('fill_out_profile/confirm/{package}', 'Site\FillOutProfileController@confirm')->name('fill_out_profile.confirm');
//        Route::post('video_track', 'Site\VideoTrackController@store')->name('video_track.store');
//    });
//
//    Route::group([], function () { //middleware(['auth:web', 'active.mobile', 'payed'])->
//        Route::get('', [\App\Http\Controllers\Site\HomeController::class,'index'])->name('home.index');
//
//        Route::post('search', [\App\Http\Controllers\Site\HomeController::class,'search']);
//        Route::get('search/index', [\App\Http\Controllers\Site\HomeController::class,'searchIndex'])->name('search.index');
//
//        Route::post('contact-us', [\App\Http\Controllers\Site\HomeController::class,'contactUs'])->middleware('throttle:10,60');
//        Route::get('menu/{content}', [\App\Http\Controllers\Site\HomeController::class,'showMenuItem'])->name('home.showMenuItem');
//
//
//
//        Route::resource('/content', 'Site\ContentController')->only(['index', 'show']);
//
//        Route::middleware(['guest'])->group(function () {
//            Route::get('/content/menu/{content}', 'Site\ContentController@showMenu');
//
//            Route::get('c/{content}', 'Site\ContentController@show')->name('content.short_link_show');
//        });
//    });
//
//    Route::middleware(['guest'])->group(function () {
//
//        Route::get('registration/{package}', 'Site\RegistrationController@index')->name('registration.index');
//        Route::post('registration/check_national_code', 'Site\RegistrationController@check_national_code')->name('registration.check_national_code');
//        Route::post('registration/confirm/{package}', 'Site\RegistrationController@confirm')->name('registration.confirm');
//        Route::post('registration/{package}', 'Site\RegistrationController@store')->name('registration.store');
//     });
//
//    // Route::resource('refund', 'Site\RefundController');
//
//    // Route::get('/faq', 'Site\FaqController@index');
//    // Route::get('/pages/{category_id}/{category_item_id?}', 'Site\ContentController@index');
//    Route::resource('/page', 'Site\ContentController')->only(['index', 'show']);
//    // Route::resource('/gallery', 'Site\GalleryController');
//    // Route::resource('/order', 'Site\OrderController');
//
//    Route::get('/tag/content/{slug}', 'Site\TagController@searchContents');
//    Route::get('/tag/{slug}', 'Site\TagController@search');
//
//    Route::get('/otp/request', 'Site\OtpController@showRequestForm')->name('otp.request');
//    Route::get('/otp/login', 'Site\OtpController@showOtpLoginForm')->name('otp.login');
//
//
//    Route::get('/otp/request/active-mobile', 'Site\OtpController@showRequestActiveMobileForm')
//        ->name('otp.request.active.mobile')->middleware('auth:web');
//    Route::post('/otp/active-mobile', 'Site\OtpController@otpActiveMobile')
//        ->name('otp.login.active.mobile')->middleware('auth:web');
//
//
//    Route::middleware('throttle:6,2')->group(function () {
//        Route::post('/otp/request', 'Site\OtpController@sendOtp');
//        Route::post('/otp/login', 'Site\OtpController@otpLogin');
//    });
//});
//
//
//Route::get('/get_image/{width}/{height}/{type}/{filepath}', 'Site\ResizeImageController@resize')
//    ->where(['filepath' => '[ \w\\.\\/\\-\\@\(\)]+']);
//
//Route::get('/get_captcha/{config?}', function (\Mews\Captcha\Captcha $captcha, $config = 'default') {
//    return $captcha->src($config);
//});


//Route::get('fa/users/users/wallet/receipt/error', 'WalletController@receiptError')->name('wallet.receipt.error');
//Route::get('fa/users/users/wallet/receipt/{purchase}', 'WalletController@receipt')->name('wallet.receipt.success');
//
//Route::any('/bank/response/wallet', 'WalletController@response');
//
//Route::get('users/users/wallet/{uuid}', 'WalletController@getPurchase')->name('wallet.charge');
//
//Route::get('users/users/wallet/purchase/{wallet}', 'WalletController@purchase')->name('wallet.charge.purchase');
//
//Route::get('guide-info/download', 'Site\GuideInfoController@exportPdf')
//    ->name('guide.info.pdf');


Route::get('/storage/link', function () {
    \Artisan::call('storage:link');
    \Artisan::call('cache:clear');
});





