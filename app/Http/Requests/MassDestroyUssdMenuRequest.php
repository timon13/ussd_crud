<?php

namespace App\Http\Requests;

use App\UssdMenu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyUssdMenuRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ussd_menu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:ussd_menus,id',
        ];
    }
}
