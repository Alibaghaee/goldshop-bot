<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\Lottery;
use App\Models\General\LotteryZojino;
use DateTime;
use Illuminate\Http\Request;
use MongoDB\BSON\UTCDateTime;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = [
            [
                'id'   => 21,
                'date' => '1401/04/22',
            ],
            [
                'id'   => 20,
                'date' => '1401/04/12',
            ],
            [
                'id'   => 19,
                'date' => '1401/04/09',
            ],
            [
                'id'   => 18,
                'date' => '1401/04/05',
            ],
            [
                'id'   => 17,
                'date' => '1401/04/02',
            ],
            [
                'id'   => 16,
                'date' => '1401/03/31',
            ],
            [
                'id'   => 15,
                'date' => '1401/03/30',
            ],
            [
                'id'   => 14,
                'date' => '1401/03/29',
            ],
            [
                'id'   => 13,
                'date' => '1401/03/26',
            ],
            [
                'id'   => 12,
                'date' => '1401/03/25',
            ],
            [
                'id'   => 11,
                'date' => '1401/03/24',
            ],
            [
                'id'   => 10,
                'date' => '1401/03/22',
            ],
            [
                'id'   => 9,
                'date' => '1401/03/16',
            ],

        ];
        return view('admin.modules.home.index', compact('records'));
    }

    public function lottery(Request $request)
    {
        // TV Khandevaneh - 5 X 50 million
        // $winner = Lottery::query()
        //     ->where('total_id', intval($request->winner_id))
        //     ->first();

        // return $winners = Lottery::where('group_id', $winner->group_id)->get();

        // TV Zojino

        $dateTime  = new DateTime('2022-08-23 18:30:00');
        $timestamp = $dateTime->format('U');

        return $winner = LotteryZojino::query()
            ->where('created_at', '<', new UTCDateTime($timestamp * 1000))
            ->where('total_id', intval($request->winner_id))
            ->first();

        // TV Khandevaneh - docharkhe
        // $winner = Lottery::query()
        //     ->where('total_id', intval($request->winner_id))
        //     ->first();

        // $id = 1;

        // // $winners = Lottery::take(100, 100)->get();
        // $winners = Lottery::where('group_id', $winner->group_id)->get();
        // if ($winners->count() > 100) {
        //     $winners = Lottery::where('group_id', $winner->group_id)
        //         ->where('group', '!=', $winner->group - 1)
        //         ->get();
        // }

        // foreach ($winners as $item) {
        //     $item['id'] = $id++;
        // }

        return $winners;
    }
}
