<?php

namespace App\Jobs;

use App\Models\SettingBot;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendSettingBotUpdated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected SettingBot $settingBot;

    /**
     * Create a new job instance.
     */
    public function __construct(SettingBot $settingBot)
    {
        $this->settingBot = $settingBot;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = $this->settingBot->main;

        $header = ['X-SHOP-SECRET' => env('SHOP_SECRET')];

        $response = Http::withHeaders($header)->post(env('SETTING_SHOP_API_URL') . '/settings/bots', $data);

        if ($response->successful()) {


            info($response->json());
            info( $response->status());
            // Process the data
        } else {
            // Handle the error
            $status = $response->status();
            $error = $response->body();

            info("Error: $status");
            info("Error: $error");
        }
    }
}
