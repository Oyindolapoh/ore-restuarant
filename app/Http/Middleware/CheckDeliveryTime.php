<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckDeliveryTime
{
    public function handle(Request $request, Closure $next)
    {
        $now = Carbon::now();
        if ($now->hour < 10 || $now->hour > 18) {
            return response()->json(['error' => 'Delivery/Carryout only runs from 10AM to 6PM'], 403);
        }

        return $next($request);
    }
}

