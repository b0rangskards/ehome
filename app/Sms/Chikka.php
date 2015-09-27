<?php  namespace App\Sms;

define('MESSAGE_TYPE_INCOMING', 'INCOMING');
define('MESSAGE_TYPE_REPLY', 'REPLY');
define('MESSAGE_TYPE_SEND', 'SEND');
define('MESSAGE_TYPE_OUTGOING', 'OUTGOING');
define('MESSAGE_ID_LENGTH', 32);
define('DELIVERY_STATUS_1', 'ACCEPTED');
define('DELIVERY_STATUS_2', 'SENT');
define('DELIVERY_STATUS_3', 'FAILED');

class Chikka implements SmsInterface {

	protected $url;

	protected $client_id;

	protected $secret_key;

	protected $short_code;

	function __construct()
	{
		$this->url = env('CHIKKA_URL');
		$this->client_id = env('CHIKKA_CLIENT_ID');
		$this->secret_key = env('CHIKKA_SECRET_KEY');
		$this->short_code = env('CHIKKA_SHORT_CODE');
	}

	public function _generateMessageId()
	{
		return str_pad(rand(), MESSAGE_ID_LENGTH, '0', STR_PAD_LEFT);
	}

	public function send($message, $mobile_no, $message_id = null)
	{
		$message_id = is_null($message_id) ? $this->_generateMessageId() : $message_id;

		$params = array(
			'message_type' => MESSAGE_TYPE_SEND,
			'mobile_number' => $mobile_no,
			'shortcode' => $this->short_code,
			'message_id' => $message_id,
			'message' => $message,
			'client_id' => $this->client_id,
			'secret_key' => $this->secret_key,
		);

		$query = http_build_query($params);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_POST, count($params));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);

		// Add the message_id in the response.
		$response = json_decode($response, true);
		$response['message_id'] = $message_id;
		$response = json_encode($response);

		return $response;
	}


} 