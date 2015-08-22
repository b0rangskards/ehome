<?php
use App\User;
use \FunctionalTester;
use Page\MemberDashboardPage;
use Page\RegistrationPage;
use Page\SignInPage;

class SignUpCest
{
	private $user;

    public function _before(FunctionalTester $I)
    {
	    $this->user = $I->haveUserData(['password' => '1234']);
    }

    // tests
    public function try_to_sign_up_with_valid_information(FunctionalTester $I)
    {
	    $I->am('a Guest');
	    $I->wantTo('Sign Up for ehome Account');

	    $I->amOnPage(RegistrationPage::$URL);
	    $I->fillField(RegistrationPage::$firstnameField, $this->user->firstname);
	    $I->fillField(RegistrationPage::$lastnameField, $this->user->lastname);
	    $I->fillField(RegistrationPage::$middleinitialField, $this->user->middleinitial);
		$I->selectOption(RegistrationPage::$genderOption, $this->user->gender);
	    $I->fillField(RegistrationPage::$mobilenoField, $this->user->mobile_no);
	    $I->fillField(RegistrationPage::$emailField, $this->user->email);
	    $I->fillField(RegistrationPage::$passwordField, 'password1234');
	    $I->click(RegistrationPage::$signupButton);

	    $I->seeRecord('users', [
		   'firstname' => $this->user->firstname,
		   'lastname' => $this->user->lastname,
		   'middleinitial' => $this->user->middleinitial,
		   'gender' => $this->user->gender,
		   'mobile_no' => $this->user->mobile_no,
		   'email' => $this->user->email,
		   'role' => Config::get('enums.roles.hh_head')
	    ]);
    }

	public function try_to_register_with_invalid_data(FunctionalTester $I)
	{
		$I->am('a Guest');
		$I->wantTo('Sign Up for ehome Account with invalid data');
		$I->expectTo('see an error');

		$I->amOnPage(RegistrationPage::$URL);
		$I->fillField(RegistrationPage::$firstnameField, $this->user->firstname);
		$I->fillField(RegistrationPage::$lastnameField, $this->user->lastname);
		$I->fillField(RegistrationPage::$middleinitialField, $this->user->middleinitial);
		$I->click(RegistrationPage::$signupButton);

		$I->dontSeeRecord('users', [
			'firstname' => $this->user->firstname,
			'lastname' => $this->user->lastname,
			'middleinitial' => $this->user->middleinitial,
			'gender' => $this->user->gender,
			'mobile_no' => $this->user->mobile_no,
			'email' => $this->user->email,
			'role' => Config::get('enums.roles.hh_head')
		]);
	}
}
