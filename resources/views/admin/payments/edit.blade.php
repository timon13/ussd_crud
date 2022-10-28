@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.payment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.payments.update", [$payment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="msisdn">{{ trans('cruds.payment.fields.msisdn') }}</label>
                <input class="form-control {{ $errors->has('msisdn') ? 'is-invalid' : '' }}" type="text" name="msisdn" id="msisdn" value="{{ old('msisdn', $payment->msisdn) }}">
                @if($errors->has('msisdn'))
                    <div class="invalid-feedback">
                        {{ $errors->first('msisdn') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.msisdn_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="account">{{ trans('cruds.payment.fields.account') }}</label>
                <input class="form-control {{ $errors->has('account') ? 'is-invalid' : '' }}" type="text" name="account" id="account" value="{{ old('account', $payment->account) }}">
                @if($errors->has('account'))
                    <div class="invalid-feedback">
                        {{ $errors->first('account') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.account_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount">{{ trans('cruds.payment.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="text" name="amount" id="amount" value="{{ old('amount', $payment->amount) }}">
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reference">{{ trans('cruds.payment.fields.reference') }}</label>
                <input class="form-control {{ $errors->has('reference') ? 'is-invalid' : '' }}" type="text" name="reference" id="reference" value="{{ old('reference', $payment->reference) }}">
                @if($errors->has('reference'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reference') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.reference_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="origin">{{ trans('cruds.payment.fields.origin') }}</label>
                <input class="form-control {{ $errors->has('origin') ? 'is-invalid' : '' }}" type="text" name="origin" id="origin" value="{{ old('origin', $payment->origin) }}">
                @if($errors->has('origin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('origin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.origin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mode">{{ trans('cruds.payment.fields.mode') }}</label>
                <input class="form-control {{ $errors->has('mode') ? 'is-invalid' : '' }}" type="text" name="mode" id="mode" value="{{ old('mode', $payment->mode) }}">
                @if($errors->has('mode'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mode') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.mode_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="session">{{ trans('cruds.payment.fields.session') }}</label>
                <input class="form-control {{ $errors->has('session') ? 'is-invalid' : '' }}" type="text" name="session" id="session" value="{{ old('session', $payment->session) }}">
                @if($errors->has('session'))
                    <div class="invalid-feedback">
                        {{ $errors->first('session') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.session_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ussd_code">{{ trans('cruds.payment.fields.ussd_code') }}</label>
                <input class="form-control {{ $errors->has('ussd_code') ? 'is-invalid' : '' }}" type="text" name="ussd_code" id="ussd_code" value="{{ old('ussd_code', $payment->ussd_code) }}">
                @if($errors->has('ussd_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ussd_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.ussd_code_helper') }}</span>
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