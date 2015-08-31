<?php

namespace App\Http\Controllers;

use App\Billing\BillingInterface;
use App\Http\Requests\SubscriptionCheckoutRequest;
use App\Jobs\AuditBillingSubscriptionJob;
use App\Jobs\CheckoutSubscriptionJob;
use App\SubscriptionType;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;

class UserSubscriptionsController extends Controller
{

	function __construct()
	{
		$this->middleware('auth');

		$this->middleware('must.be.head');

		parent::__construct();
	}

	public function index()
    {
	    $subscription = $this->user->subscription;

        return view('members.subscriptions.index', compact('subscription'));
    }

	public function getExtension($user)
	{
		$subscriptions = SubscriptionType::getPaidSubscriptions();

		return view('members.subscriptions.create', compact('user', 'subscriptions'));
	}

	public function postExtension(SubscriptionCheckoutRequest $request, $user)
	{
		$request->merge(['user_id' => $user->id]);

		$this->dispatchFrom(CheckoutSubscriptionJob::class, $request);
	}

	public function getSuccessSubscription($user, $subscription_type, BillingInterface $billing)
	{
		$response = $billing->completePurchase();

		$successMessage = 'You have successfully extended your subscription.';

		if($response !== false)
		{
			$subscription = $this->dispatch(new AuditBillingSubscriptionJob($user, $subscription_type));

			return view('members.subscriptions.success', compact('subscription_type', 'successMessage', 'subscription'));
		}

		Flash::error('Theres a problem billing the subscription.');

		return redirect(url(route('subscriptions.extend', Auth::user()->id)));
	}

	public function getHistory($user)
	{
		$subscriptionsHistory = $user->subscriptions()->latest()->get();

		return view('members.subscriptions.history', compact('subscriptionsHistory'));
	}


}
