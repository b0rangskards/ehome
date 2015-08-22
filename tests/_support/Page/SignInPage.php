<?php
namespace Page;

class SignInPage
{
    // include url of current page
    public static $URL = '/auth/login';

	public static $headerMessage = 'Sign In to Continue';

	public static $emailField = 'input[name=email]';

	public static $passwordField = 'input[name=password]';

	public static $loginButton = 'Login';

	/**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL.$param;
    }


}
