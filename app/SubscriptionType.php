<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionType extends Model
{
    protected $table = 'subscription_types';

	protected $fillable  = ['type', 'no_of_days', 'amount'];
}
