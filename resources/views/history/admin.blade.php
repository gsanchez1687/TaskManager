@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('Historyhousehold chores') }}</h1>
@stop

@section('content')


@if( Auth::user()->hasRole('Admin'))

<div class="card">
  <div class="card-header">
    {{ __('Historyhousehold chores') }}
  </div>
  <div class="card-body">
        <table id="history-table" class="table table-striped table-bordered">
          <thead>
              <th>ID</th>
              <th>TaskUser</th>
              <th>Status</th>
              <th>Observation</th>
          </thead>
          <tbody>
            @foreach ($history as $item)
                  <tr>
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->tasks_users_id }}</td>
                      <td>{{ $item->statu->name }}</td>
                      <td>{{ $item->observation }}</td>
                  </tr>
              @endforeach
          </tbody>
        </table>
        <div class="mt-3">
          {{ $history->links() }}
        </div>
  </div>
</div>
@endif
@stop

@section('css')
  <link href="https://cdn.datatables.net/v/bs5/dt-2.1.8/datatables.min.css" rel="stylesheet">
@stop

@section('js')
  <script src="https://cdn.datatables.net/v/bs5/dt-2.1.8/datatables.min.js"></script>
  <script>
    
    $(document).ready( function () {
      $('#history-table').DataTable({
         paging: false
      });
    } );
  </script>
@stop

