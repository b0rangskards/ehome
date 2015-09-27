<?php

namespace App\Sms;


interface SmsInterface {

	public function send($message, $mobile_no);

} 