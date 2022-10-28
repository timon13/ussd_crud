@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userSession.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-sessions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userSession.fields.id') }}
                        </th>
                        <td>
                            {{ $userSession->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userSession.fields.session') }}
                        </th>
                        <td>
                            {{ $userSession->session }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userSession.fields.service_code') }}
                        </th>
                        <td>
                            {{ $userSession->service_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userSession.fields.msisdn') }}
                        </th>
                        <td>
                            {{ $userSession->msisdn }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-sessions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection