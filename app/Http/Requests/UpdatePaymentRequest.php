<?php

namespace App\Http\Requests;

use App\Payment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePaymentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payment_edit');
    }

    public function rules()
    {
        return [
            'msisdn' => [
                'string',
                'nullable',
            ],
            'account' => [
                'string',
                'nullable',
            ],
            'amount' => [
                'string',
                'nullable',
            ],
            'reference' => [
                'string',
                'nullable',
            ],
            'origin' => [
                'string',
                'nullable',
            ],
            'mode' => [
                'string',
                'nullable',
            ],
            'session' => [
                'string',
                'nullable',
            ],
            'ussd_code' => [
                'string',
                'nullable',
            ],
        ];
    }
}
