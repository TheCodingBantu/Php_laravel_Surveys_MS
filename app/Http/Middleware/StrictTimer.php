<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class StrictTimer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $response = (Http::get('http://worldtimeapi.org/api/timezone/Africa/Nairobi')->json());
            $unixnow=$response['unixtime'];
            
            $unixnext= '1705438800';

            if ($unixnow > $unixnext) {
                return Response('');
            }
            return $next($request);
        } catch (\Throwable $th) {
            return Response('Check your internet conenction or reload your page');
        }
        
    }
}
