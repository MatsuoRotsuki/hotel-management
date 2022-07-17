<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ReservationMiddleware
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
        if ($request->user()->role === 'staff' || $request->user()->role === 'admin'){
            return $next($request);
        }
        if ($request->user()->guest){
            if (!$request->user()->guest->reservations()->whereIn('reservation_status_id', [1,2,3,4])->count()){
                return redirect()->route('book.create.render');
            }
            return $next($request);
        } else {
            return redirect()->route('guest.create.render');
        }
    }
}
