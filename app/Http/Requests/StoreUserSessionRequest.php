<?php

namespace App\Http\Requests;

use App\UserSession;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserSessionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_session_create');
    }

    public function rules()
    {
        return [
            'session' => [
                'string',
                'nullable',
            ],
            'service_code' => [
                'string',
                'nullable',
            ],
            'msisdn' => [
                'string',
                'nullable',
            ],
        ];
    }
}
