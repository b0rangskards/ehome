<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class CheckSubscription
{
	protected $auth;

	function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}


	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
    public function handle($request, Closure $next)
    {
	    $currentUser = $this->auth->user();

	    if ($currentUser->isHead() && $currentUser->subscription->isExpired())
	    {
			return redirect(route('subscriptions.extend', $currentUser->id));
	    }

        return $next($request);
    }
}
