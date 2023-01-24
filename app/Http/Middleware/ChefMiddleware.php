<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChefMiddleware
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
        if(Auth::user()->role_id == 2){
            return $next($request);
        }
        if(Auth::user()->role_id == 1){
            return redirect('admin/dashboard')->with('message','Cannot access as you are not chef');
        }
        if(Auth::user()->role_id == 3){
            return redirect('cashier/orders')->with('message','Cannot access as you are not chef');
        }
        if(Auth::user()->role_id == 4){
            return redirect('waiter/dashboard')->with('message','Cannot access as you are not chef');
        }
    }
}
