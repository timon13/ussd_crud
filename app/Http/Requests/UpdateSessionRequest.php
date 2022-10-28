<?php

namespace App\Http\Requests;

use App\Session;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSessionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('session_edit');
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
            'ussd_string' => [
                'string',
                'nullable',
            ],
            'title' => [
                'string',
                'nullable',
            ],
            'menu' => [
                'string',
                'nullable',
            ],
            'selection' => [
                'string',
                'nullable',
            ],
            'min_val' => [
                'string',
                'nullable',
            ],
            'max_val' => [
                'string',
                'nullable',
            ],
            'session_date' => [
                'string',
                'nullable',
            ],
        ];
    }
}
