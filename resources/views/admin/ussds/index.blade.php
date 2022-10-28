@extends('layouts.admin')
@section('content')
@can('ussd_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.ussds.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.ussd.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.ussd.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Ussd">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.ussd.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.ussd.fields.ussd_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.ussd.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.ussd.fields.user') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ussds as $key => $ussd)
                        <tr data-entry-id="{{ $ussd->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $ussd->id ?? '' }}
                            </td>
                            <td>
                                {{ $ussd->ussd_code ?? '' }}
                            </td>
                            <td>
                                {{ $ussd->name ?? '' }}
                            </td>
                            <td>
                                @foreach($ussd->users as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('ussd_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.ussds.show', $ussd->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('ussd_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.ussds.edit', $ussd->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('ussd_delete')
                                    <form action="{{ route('admin.ussds.destroy', $ussd->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
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
@can('ussd_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.ussds.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  });
  let table = $('.datatable-Ussd:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection