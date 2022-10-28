@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.userSession.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-sessions.update", [$userSession->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="session">{{ trans('cruds.userSession.fields.session') }}</label>
                <input class="form-control {{ $errors->has('session') ? 'is-invalid' : '' }}" type="text" name="session" id="session" value="{{ old('session', $userSession->session) }}">
                @if($errors->has('session'))
                    <div class="invalid-feedback">
                        {{ $errors->first('session') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userSession.fields.session_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="service_code">{{ trans('cruds.userSession.fields.service_code') }}</label>
                <input class="form-control {{ $errors->has('service_code') ? 'is-invalid' : '' }}" type="text" name="service_code" id="service_code" value="{{ old('service_code', $userSession->service_code) }}">
                @if($errors->has('service_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('service_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userSession.fields.service_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="msisdn">{{ trans('cruds.userSession.fields.msisdn') }}</label>
                <input class="form-control {{ $errors->has('msisdn') ? 'is-invalid' : '' }}" type="text" name="msisdn" id="msisdn" value="{{ old('msisdn', $userSession->msisdn) }}">
                @if($errors->has('msisdn'))
                    <div class="invalid-feedback">
                        {{ $errors->first('msisdn') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userSession.fields.msisdn_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection