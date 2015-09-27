<?php  namespace App\Sms; 

use Illuminate\Support\Facades\Facade;

class Sms {

	protected $sms;

	function __construct(SmsInterface $sms)
	{
		$this->sms = $sms;
	}

	public function send($message, $mobile_no)
	{
		$mobile_no = $this->_cleanMobileNo($mobile_no);

		return $this->sms->send($message, $mobile_no);
	}

	protected function _cleanMobileNo($mobile_no)
	{
		return str_replace('+', '', $mobile_no);
	}
}