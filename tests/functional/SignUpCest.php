<?php
use App\User;
use \FunctionalTester;
use Page\MemberDashboardPage;
use Page\RegistrationPage;

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
	    $I->am('a guest');
	    $I->wantTo('sign up for ehome account');

	    $I->amOnPage(RegistrationPage::$URL);
	    $I->fillField(RegistrationPage::$firstnameField, $this->user->firstname);
	    $I->fillField(RegistrationPage::$lastnameField, $this->user->lastname);
	    $I->fillField(RegistrationPage::$middleinitialField, $this->user->middleinitial);
		$I->selectOption(RegistrationPage::$genderOption, $this->user->gender);
	    $I->fillField(RegistrationPage::$mobilenoField, $this->user->mobile_no);
	    $I->fillField(RegistrationPage::$emailField, $this->user->email);
	    $I->fillField(RegistrationPage::$passwordField, 'password1234');
	    $I->click(RegistrationPage::$signupButton);

	    $I->seeCurrentUrlEquals(MemberDashboardPage::$URL);
	    $I->see(MemberDashboardPage::$welcomeMessage);

	    $I->seeRecord('users', [
		   'firstname' => $this->user->firstname,
		   'lastname' => $this->user->lastname,
		   'email' => $this->user->email
	    ]);

	    $I->assertTrue(Auth::check());
    }
}
