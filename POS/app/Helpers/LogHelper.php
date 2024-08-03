<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogHelper
{
    public static function user(Request $request, $activity = '')
    {
        if ($activity == '') {
            $activity = $request->route()->getName();
            $activity = str_replace('.', ' ', $activity);
            $activity = ucwords($activity);
        }

        Log::info($activity, [
            'user' =>  [
                'id' => Auth::user()->id ?? 'guestId',
                'name' => Auth::user()->name ?? 'guestName',
                'ip' => $request->ip(),
                'request' => [
                    'id' => $request->user()->id ?? 'guestId',
                    'name' => $request->user()->name ?? 'guestName',
                ]
            ],
            'route' => [
                'route' => $request->route()->getName() ?? 'undefined',
                'method' => $request->method(),
                'url' => $request->fullUrl(),
            ],
            'input' => $request->all(),
            'session' => $request->session()->all(),
            'ua' => [
                'user_agent' => $request->header('sec-ch-ua'),
                'mobile' => $request->header('sec-ch-ua-mobile'),
                'platform' => $request->header('sec-ch-ua-platform'),
            ],
        ]);
    }
}
