<?php

namespace App\Http\Requests;

use App\UssdMenu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUssdMenuRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ussd_menu_create');
    }

    public function rules()
    {
        return [];
    }
}
