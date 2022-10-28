@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ussd.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ussds.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ussd.fields.id') }}
                        </th>
                        <td>
                            {{ $ussd->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ussd.fields.ussd_code') }}
                        </th>
                        <td>
                            {{ $ussd->ussd_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ussd.fields.name') }}
                        </th>
                        <td>
                            {{ $ussd->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ussd.fields.user') }}
                        </th>
                        <td>
                            @foreach($ussd->users as $key => $user)
                                <span class="label label-info">{{ $user->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ussds.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#ussd_ussd_menus" role="tab" data-toggle="tab">
                {{ trans('cruds.ussdMenu.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="ussd_ussd_menus">
            @includeIf('admin.ussds.relationships.ussdUssdMenus', ['ussdMenus' => $ussd->ussdUssdMenus])
        </div>
    </div>
</div>

@endsection