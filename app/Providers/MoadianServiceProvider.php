<?php

namespace App\Providers;

use App\Service\Moadian\InvoiceServiceController;
use App\Service\Moadian\SendServiceController;
use Illuminate\Support\ServiceProvider;
use SnappMarketPro\Moadian\Moadian;

class MoadianServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    public function boot():void
    {
//        if (auth()->check() && auth()->user()) {
//
//
//            try {
//                $account = auth()->user()?->account;
////                $moadian = new Moadian(
////                    $account->publicKey,
////                    $account->privateKey,
////                    (string)Str::uuid(),
////                    $account->username
////                );
//                $username = 'A29W6F';
//                $orgKeyId = Str::uuid();
//                $privateKey = file_get_contents(storage_path() . '/app/moadian_secret/rahrayan_private_key.key');
//                $publicKey = file_get_contents(storage_path() . '/app/moadian_secret/rahrayan_public_key.txt'); // this is the public key of tax org, not you!
//
//                $moadian = new Moadian(
//                    $publicKey,
//                    $privateKey,
//                    $orgKeyId,
//                    $username
//                );
//                $this->app->bind(InvoiceServiceController::class, function ($app) use ($moadian) {
//
//
//                    return new InvoiceServiceController($moadian);
//                });
//
//                $this->app->bind(SendServiceController::class, function ($app) use ($moadian) {
//
//                    return new SendServiceController($moadian);
//                });
//
//            } catch (\Illuminate\Contracts\Container\BindingResolutionException $ex) {
//
//                return throw new MoadianServiceInjectException('Not found user credentials!!');
//            }
//
//        }
        $username = 'A29W6F';//'A29W6F';
        $orgKeyId = '6a2bcd88-a871-4245-a393-2843eafe6e02';//(string)Uuid::uuid4();
        $privateKey = file_get_contents(storage_path() . '/app/moadian_secret/rahrayan_private_key.key');

        $publicKey = 'MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAxdzREOEfk3vBQogDPGTMqdDQ7t0oDhuKMZkA+Wm1lhzjjhAGfSUOuDvOKRoUEQwP8oUcXRmYzcvCUgcfoRT5iz7HbovqH+bIeJwT4rmLmFcbfPke+E3DLUxOtIZifEXrKXWgSVPkRnhMgym6UiAtnzwA1rmKstJoWpk9Nv34CYgTk8DKQN5jQJqb9L/Ng0zOEEtI3zA424tsd9zv/kP4/SaSnbbnj0evqsZ29X6aBypvnTnwH9t3gbWM4I9eAVQhPYClawHTqvdaz/O/feqfm06QBFnCgL+CBdjLs30xQSLsPICjnlV1jMzoTZnAabWP6FRzzj6C2sxw9a/WwlXrKn3gldZ7Ctv6Jso72cEeCeUI1tzHMDJPU3Qy12RQzaXujpMhCz1DVa47RvqiumpTNyK9HfFIdhgoupFkxT14XLDl65S55MF6HuQvo/RHSbBJ93FQ+2/x/Q2MNGB3BXOjNwM2pj3ojbDv3pj9CHzvaYQUYM1yOcFmIJqJ72uvVf9Jx9iTObaNNF6pl52ADmh85GTAH1hz+4pR/E9IAXUIl/YiUneYu0G4tiDY4ZXykYNknNfhSgxmn/gPHT+7kL31nyxgjiEEhK0B0vagWvdRCNJSNGWpLtlq4FlCWTAnPI5ctiFgq925e+sySjNaORCoHraBXNEwyiHT2hu5ZipIW2cCAwEAAQ==';

        $moadian = new Moadian(
            $publicKey,
            $privateKey,
            $orgKeyId,
            $username,
//            'https://sandboxrc.tax.gov.ir'
        );
        $this->app->bind(InvoiceServiceController::class, function ($app) use ($moadian) {


            return new InvoiceServiceController($moadian);
        });

        $this->app->bind(SendServiceController::class, function ($app) use ($moadian) {

            return new SendServiceController($moadian);
        });

    }

}
