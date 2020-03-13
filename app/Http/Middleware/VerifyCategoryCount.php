<?php

namespace App\Http\Middleware;

use App\Category;
use Closure;

class VerifyCategoryCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Category::all()->count()== 0){
            session()->flash('error', 'You need to add Category In order to be able to add Post!');
            return redirect(route('categories.create'));
        }
        return $next($request);
    }
}
