<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Verified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
 public function handle($request, Closure $next, $guard = null)
    {
		if(Auth::guard($guard)->check() && Auth::user()->active == 1 && Auth::user()->role != 3){
			return $next($request);
        }
 
        
        else{
            if(Auth::user()->role == 3){
                return redirect("admin/dashboard");
            }else{
            Auth::logout();
            echo "<script>alert('You are not yet verified')</script>";
            return redirect()->route('landing')->withInfo('Your Account is not yet verified.');
            }
		}
    }
}
