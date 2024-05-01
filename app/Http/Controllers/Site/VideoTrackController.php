<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoTrackController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'duration'               => 'nullable|numeric',
            'current_time'           => 'nullable|numeric',
            'state'                  => 'nullable|in:play,pause',
            'remaining_time_display' => 'nullable|numeric',
        ]);

        return auth()->user()->tracks()->syncWithoutDetaching([$request->product_item_id => $data]);
    }
}
