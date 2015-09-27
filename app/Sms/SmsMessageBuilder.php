<?php  namespace App\Sms; 

class SmsMessageBuilder {

	public static function newTask($householdHeadName, $taskName)
	{
		return "You have a new task from {$householdHeadName}.
			   ----------------
	           {$taskName}
	           ----------------
	           Reply YES to accept task and NO to decline.";
	}

} 