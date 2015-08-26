<?php namespace App\Http\ViewComposers;

use Auth;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

	/**
	 * Register bindings in the container.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Using Closure based composers...
		view()->composer('*', function ($view) {
			$view->with('currentUser', Auth::user());
		});

		view()->composer('members.partials._household-nav', function ($view) {
			$view->with('household', Auth::user()->household);
		});

		view()->composer([
			'members.households.index',
			'members.household-members.*'
		], function($view) {
			$view->with('householdMembers', Auth::user()->household->members()->with('user')->get());
		});

	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// TODO: Implement register() method.
	}
}