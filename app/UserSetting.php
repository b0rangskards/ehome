<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $table = 'user_settings';

	protected $fillable = ['user_id', 'task_reminder_minutes_before', 'receive_sms', 'receive_notifications_mobile'];

	public $timestamps = false;

	public static function initialize($user_id)
	{
		return static::create(compact('user_id'));
	}
}
