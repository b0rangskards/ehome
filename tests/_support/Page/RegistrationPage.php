<?php
namespace Page;

class RegistrationPage
{
    // include url of current page
    public static $URL = '/';

	public static $firstnameField = 'input[name=firstname]';

	public static $lastnameField = 'input[name=lastname]';

	public static $middleinitialField = 'input[name=middleinitial]';

	public static $genderOption = 'input[name=gender]';

	public static $mobilenoField = 'input[name=mobile_no]';

	public static $emailField = 'input[name=email]';

	public static $passwordField = 'input[name=password]';

	public static $signupButton = 'SIGN UP NOW!';

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
