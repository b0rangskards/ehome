<?php  namespace App\Billing;

use Log;
use Omnipay\Omnipay;
use Session;

class PaypalBilling implements BillingInterface{

	private $gateway;

	public $params;

	function __construct()
	{
		$this->gateway = Omnipay::create('PayPal_Express');

		$this->gateway->setUsername(env('PAYPAL_USERNAME'));
		$this->gateway->setPassword(env('PAYPAL_PASSWORD'));
		$this->gateway->setSignature(env('PAYPAL_SIGNATURE'));
		$this->gateway->setTestMode(env('PAYPAL_TESTMODE', true));

		$this->params['currency'] = env('PAYPAL_CURRENCY', 'USD');
	}

	public function setParams($name, $description, $amount, $cancelUrl, $returnUrl)
	{
		$this->params = array_merge($this->params, compact('name', 'description', 'amount', 'cancelUrl', 'returnUrl'));

		Session::put('params', $this->params);
		Session::save();

//		$this->gateway->purchase($this->params);

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function checkout()
	{
		Log::info('checking out');
		$response = $this->gateway
						 ->purchase($this->params)
						 ->send();
		Log::info('sending params');

		if($response->isSuccessful()) {
			Log::info('billing successful');

			dd($response);
		}elseif($response->isRedirect()) {
			Log::info('redirecting');

			$response->redirect();
		}else {
			Log::info('get message');

			dd($response->getMessage());
		}
	}

	public function completePurchase()
	{
		$params = Session::get('params');

		$response = $this->gateway
						 ->completePurchase($params)
						 ->send();

		$paypalResponse = $response->getData();

		// Return amount
		if( isset($paypalResponse['PAYMENTINFO_0_ACK']) && $paypalResponse['PAYMENTINFO_0_ACK'] === 'Success') {
			 return $paypalResponse['PAYMENTINFO_0_AMT'];
		}

		return false;
	}

}