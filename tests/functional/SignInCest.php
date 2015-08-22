<?php
use \FunctionalTester;
use Page\MemberDashboardPage;
use Page\SignInPage;

class SignInCest
{
	private $user;
	private $password;

    public function _before(FunctionalTester $I)
    {
	    $this->user = factory(App\User::class)->create([
		    'password' => $this->password = 'mypassword1234',
		    'role' => Config::get('enums.roles.hh_head')
	    ]);
    }

    // tests
    public function try_to_sign_in_with_valid_credentials(FunctionalTester $I)
    {
	    $I->am('a registered user');
	    $I->wantTo('Sign In to my account');

	    $I->amOnPage(SignInPage::$URL);
	    $I->fillField(SignInPage::$emailField, $this->user->email);
	    $I->fillField(SignInPage::$passwordField, $this->password);
	    $I->click(SignInPage::$loginButton);

	    $I->seeAuthentication();
	    $I->seeCurrentUrlEquals(MemberDashboardPage::$URL);
    }

//	public function try_to_sign_in_with_invalid_credentials(FunctionalTester $I)
//	{
//		$I->am('a registered user');
//		$I->wantTo('Sign In to my account with invalid credentials');
//		$I->expectTo('see an error');
//
//		$I->amOnPage(SignInPage::$URL);
//		$I->fillField(SignInPage::$emailField, $this->user->email);
//		$I->fillField(SignInPage::$passwordField, 'invalidpassword');
//		$I->click(SignInPage::$loginButton);
//
//		$I->dontSeeAuthentication();
//		$I->seeCurrentUrlEquals(SignInPage::$URL);
//	}


}
