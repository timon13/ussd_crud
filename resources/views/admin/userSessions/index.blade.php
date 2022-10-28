@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.userSession.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-UserSession">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.userSession.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.userSession.fields.session') }}
                        </th>
                        <th>
                            {{ trans('cruds.userSession.fields.service_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.userSession.fields.msisdn') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userSessions as $key => $userSession)
                        <tr data-entry-id="{{ $userSession->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $userSession->id ?? '' }}
                            </td>
                            <td>
                                {{ $userSession->session ?? '' }}
                            </td>
                            <td>
                                {{ $userSession->service_code ?? '' }}
                            </td>
                            <td>
                                {{ $userSession->msisdn ?? '' }}
                            </td>
                            <td>
                                @can('user_session_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.user-sessions.show', $userSession->id) }}">
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
  let table = $('.datatable-UserSession:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection