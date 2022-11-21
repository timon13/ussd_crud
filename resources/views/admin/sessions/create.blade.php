@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.session.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sessions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="session">{{ trans('cruds.session.fields.session') }}</label>
                <input class="form-control {{ $errors->has('session') ? 'is-invalid' : '' }}" type="text" name="session" id="session" value="{{ old('session', '') }}">
                @if($errors->has('session'))
                    <div class="invalid-feedback">
                        {{ $errors->first('session') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.session.fields.session_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="service_code">{{ trans('cruds.session.fields.service_code') }}</label>
                <input class="form-control {{ $errors->has('service_code') ? 'is-invalid' : '' }}" type="text" name="service_code" id="service_code" value="{{ old('service_code', '') }}">
                @if($errors->has('service_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('service_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.session.fields.service_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="msisdn">{{ trans('cruds.session.fields.msisdn') }}</label>
                <input class="form-control {{ $errors->has('msisdn') ? 'is-invalid' : '' }}" type="text" name="msisdn" id="msisdn" value="{{ old('msisdn', '') }}">
                @if($errors->has('msisdn'))
                    <div class="invalid-feedback">
                        {{ $errors->first('msisdn') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.session.fields.msisdn_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ussd_string">{{ trans('cruds.session.fields.ussd_string') }}</label>
                <input class="form-control {{ $errors->has('ussd_string') ? 'is-invalid' : '' }}" type="text" name="ussd_string" id="ussd_string" value="{{ old('ussd_string', '') }}">
                @if($errors->has('ussd_string'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ussd_string') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.session.fields.ussd_string_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="level">{{ trans('cruds.session.fields.level') }}</label>
                <input class="form-control {{ $errors->has('level') ? 'is-invalid' : '' }}" type="text" name="level" id="level" value="{{ old('level', '') }}">
                @if($errors->has('level'))
                    <div class="invalid-feedback">
                        {{ $errors->first('level') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.session.fields.level_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="title">{{ trans('cruds.session.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}">
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.session.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="menu">{{ trans('cruds.session.fields.menu') }}</label>
                <input class="form-control {{ $errors->has('menu') ? 'is-invalid' : '' }}" type="text" name="menu" id="menu" value="{{ old('menu', '') }}">
                @if($errors->has('menu'))
                    <div class="invalid-feedback">
                        {{ $errors->first('menu') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.session.fields.menu_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="selection">{{ trans('cruds.session.fields.selection') }}</label>
                <input class="form-control {{ $errors->has('selection') ? 'is-invalid' : '' }}" type="text" name="selection" id="selection" value="{{ old('selection', '') }}">
                @if($errors->has('selection'))
                    <div class="invalid-feedback">
                        {{ $errors->first('selection') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.session.fields.selection_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="min_val">{{ trans('cruds.session.fields.min_val') }}</label>
                <input class="form-control {{ $errors->has('min_val') ? 'is-invalid' : '' }}" type="text" name="min_val" id="min_val" value="{{ old('min_val', '') }}">
                @if($errors->has('min_val'))
                    <div class="invalid-feedback">
                        {{ $errors->first('min_val') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.session.fields.min_val_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="max_val">{{ trans('cruds.session.fields.max_val') }}</label>
                <input class="form-control {{ $errors->has('max_val') ? 'is-invalid' : '' }}" type="text" name="max_val" id="max_val" value="{{ old('max_val', '') }}">
                @if($errors->has('max_val'))
                    <div class="invalid-feedback">
                        {{ $errors->first('max_val') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.session.fields.max_val_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="session_date">{{ trans('cruds.session.fields.session_date') }}</label>
                <input class="form-control {{ $errors->has('session_date') ? 'is-invalid' : '' }}" type="text" name="session_date" id="session_date" value="{{ old('session_date', '') }}">
                @if($errors->has('session_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('session_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.session.fields.session_date_helper') }}</span>
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