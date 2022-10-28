<?php

namespace App\Http\Requests;

use App\Ussd;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUssdRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ussd_create');
    }

    public function rules()
    {
        return [
            'ussd_code' => [
                'string',
                'required',
                'unique:ussds',
            ],
            'name' => [
                'string',
                'min:5',
                'required',
            ],
            'users.*' => [
                'integer',
            ],
            'users' => [
                'array',
            ],
        ];
    }
}
