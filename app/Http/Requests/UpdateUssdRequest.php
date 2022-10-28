<?php

namespace App\Http\Requests;

use App\Ussd;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUssdRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ussd_edit');
    }

    public function rules()
    {
        return [
            'ussd_code' => [
                'string',
                'required',
                'unique:ussds,ussd_code,' . request()->route('ussd')->id,
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
