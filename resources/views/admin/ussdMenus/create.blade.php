@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.ussdMenu.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ussd-menus.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="ussd_id">{{ trans('cruds.ussdMenu.fields.ussd') }}</label>
                <select class="form-control select2 {{ $errors->has('ussd') ? 'is-invalid' : '' }}" name="ussd_id" id="ussd_id">
                    @foreach($ussds as $id => $entry)
                        <option value="{{ $id }}" {{ old('ussd_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ussd'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ussd') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ussdMenu.fields.ussd_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="main_menu">{{ trans('cruds.ussdMenu.fields.main_menu') }}</label>
                <div class="needsclick dropzone {{ $errors->has('main_menu') ? 'is-invalid' : '' }}" id="main_menu-dropzone">
                </div>
                @if($errors->has('main_menu'))
                    <div class="invalid-feedback">
                        {{ $errors->first('main_menu') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ussdMenu.fields.main_menu_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="initiate_request">{{ trans('cruds.ussdMenu.fields.initiate_request') }}</label>
                <div class="needsclick dropzone {{ $errors->has('initiate_request') ? 'is-invalid' : '' }}" id="initiate_request-dropzone">
                </div>
                @if($errors->has('initiate_request'))
                    <div class="invalid-feedback">
                        {{ $errors->first('initiate_request') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ussdMenu.fields.initiate_request_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.mainMenuDropzone = {
    url: '{{ route('admin.ussd-menus.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="main_menu"]').remove()
      $('form').append('<input type="hidden" name="main_menu" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="main_menu"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($ussdMenu) && $ussdMenu->main_menu)
      var file = {!! json_encode($ussdMenu->main_menu) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="main_menu" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    Dropzone.options.initiateRequestDropzone = {
    url: '{{ route('admin.ussd-menus.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="initiate_request"]').remove()
      $('form').append('<input type="hidden" name="initiate_request" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="initiate_request"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($ussdMenu) && $ussdMenu->initiate_request)
      var file = {!! json_encode($ussdMenu->initiate_request) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="initiate_request" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection