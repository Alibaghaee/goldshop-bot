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
        $data = json_encode($this->settingBot->main);

        $header = ['X-SHOP-SECRET'=>env('SHOP_SECRET')];

        Http::withHeaders($header)->post(env('SETTING_SHOP_API_URL') . '/settings/bots', $data);
    }
}
