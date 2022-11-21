<?php

namespace App\Http\Requests;

use App\Ussd;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyUssdRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ussd_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:ussds,id',
        ];
    }
}
