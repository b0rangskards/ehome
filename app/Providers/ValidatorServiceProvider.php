<?php  namespace App\Providers; 

use App\User;
use Illuminate\Support\ServiceProvider;
use Input;
use Validator;

class ValidatorServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{

		/*
		 * Custom Validation
		 * The field under validation must be empty when these fields aren't.
		 *
		 * empty_when:field,field2,...
		 */
		Validator::extend('empty_when', 'App\Validators\EmptyWhenValidator@validate');
		/* Error Message Variable Replacer */
		Validator::replacer('empty_when', function ($message, $attribute, $rule, $parameters) {
			return str_replace(':other', str_replace('_', ' ', $parameters[0]), $message);
		});

		Validator::extend('members_exists', 'App\Validators\HouseholdMembersValidator@validateMembersExistence');

		Validator::extend('coordinates', 'App\Validators\CoordinatesValidator@validate');

	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
	}
}