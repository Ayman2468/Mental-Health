<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class mainadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('admindata')) {
            $admindata = request()->session()->get('admindata');
            $adminpos = $admindata->position;
            if ($adminpos == 'master') {
                return $next($request);
            } else {
                $message = __('msg.you are not allowed to enter this page');
                session()->flash('message', $message);
                return redirect(url('admin/display'));
            }
        } else {
            $message = __('msg.you are not logged in as admin to enter this page');
            session()->flash('message', $message);
            return redirect(url('admin/display'));
        }
    }
}
