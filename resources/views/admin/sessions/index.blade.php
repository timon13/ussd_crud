@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.session.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Session">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.session.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.session.fields.session') }}
                        </th>
                        <th>
                            {{ trans('cruds.session.fields.service_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.session.fields.msisdn') }}
                        </th>
                        <th>
                            {{ trans('cruds.session.fields.ussd_string') }}
                        </th>
                        <th>
                            {{ trans('cruds.session.fields.level') }}
                        </th>
                        <th>
                            {{ trans('cruds.session.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.session.fields.menu') }}
                        </th>
                        <th>
                            {{ trans('cruds.session.fields.selection') }}
                        </th>
                        <th>
                            {{ trans('cruds.session.fields.min_val') }}
                        </th>
                        <th>
                            {{ trans('cruds.session.fields.max_val') }}
                        </th>
                        <th>
                            {{ trans('cruds.session.fields.session_date') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sessions as $key => $session)
                        <tr data-entry-id="{{ $session->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $session->id ?? '' }}
                            </td>
                            <td>
                                {{ $session->session ?? '' }}
                            </td>
                            <td>
                                {{ $session->service_code ?? '' }}
                            </td>
                            <td>
                                {{ $session->msisdn ?? '' }}
                            </td>
                            <td>
                                {{ $session->ussd_string ?? '' }}
                            </td>
                            <td>
                                {{ $session->level ?? '' }}
                            </td>
                            <td>
                                {{ $session->title ?? '' }}
                            </td>
                            <td>
                                {{ $session->menu ?? '' }}
                            </td>
                            <td>
                                {{ $session->selection ?? '' }}
                            </td>
                            <td>
                                {{ $session->min_val ?? '' }}
                            </td>
                            <td>
                                {{ $session->max_val ?? '' }}
                            </td>
                            <td>
                                {{ $session->session_date ?? '' }}
                            </td>
                            <td>
                                @can('session_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.sessions.show', $session->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan



                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Session:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection