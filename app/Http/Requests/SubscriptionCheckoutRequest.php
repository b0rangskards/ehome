<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SubscriptionCheckoutRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subscription_type' => 'required|exists:subscription_types,id'
        ];
    }
}
