<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class CheckHouseholdSetup
{

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * @param Guard $auth
	 */
	function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
	    if($this->auth->user()->isHead() && is_null($this->auth->user()->household)) {
		    return redirect(route('household.create'));
	    }

        return $next($request);
    }
}
