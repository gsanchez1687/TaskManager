@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('Household chores') }}</h1>
@stop

@section('content')


@if( Auth::user()->hasRole('Admin'))

<div class="card">
  <div class="card-header">
    {{ __('My household chores') }}
  </div>

  <div class="row ml-2">
    <div class="col-md-12 ">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ __('Statistics') }}</h5>
          <p class="card-text">
            <span class="badge badge-primary">Active: {{ Helpers::getActiveAll() }} </span>
            <span class="badge badge-warning">Pending: {{ Helpers::getPendingAll() }} </span>
            <span class="badge badge-success">Completed:{{ Helpers::getCompletionAll() }} </span>
            <span class="badge badge-success">Credit Paid: {{ Helpers::getCreditPayAll(1) }}</span>
            <span class="badge badge-warning">Credit No Paid: {{ Helpers::getCreditPayAll(0) }}</span>
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="card-body">
        <div class="mb-3">
          <a class="btn btn-primary" href="{{ route('create') }}">{{ __('New Household chores') }}</a>
        </div>
        <table id="tasks-table" class="table table-striped table-bordered">
          <thead>
              <th>ID</th>
              <th>Title</th>
              <th>Description</th>
              <th>Credit Value</th>
              <th>Credit Paid</th>
              <th>Expedition Date</th>
              <th>Status</th>
              <th>Days Passed</th>
              <th>Assigned Task</th>
              <th>Actions</th>
          </thead>
          <tbody>
            @foreach ($tasks as $item)
                  <tr>
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->title }}</td>
                      <td>{{ $item->description }}</td>
                      <td>{{ $item->credit_for_task }}</td>
                      <td> {!!  Helpers::getCreditPaid($item->credit_paid) !!}</td>
                      <td>{{ $item->expiration_date }}</td>
                      <td class="{{ $item->statu->style }}">{{ $item->statu->name }}</td>
                      <td>{{ Helpers::getHoursPassed($item->hours_passed, ['format' => 'full','locale'=>'en']) }}</td>
                      <td>{!! Helpers::getAssignedTask($item->id) !!}</td>
                      <td>
                          <a class="btn btn-primary btn-block" href="{{ route('view', $item->id) }}">Show</a>
                          <a class="btn btn-primary btn-block" href="{{ route('task.update', $item->id) }}">Update</a>
                      </td>
                  </tr>
              @endforeach
          </tbody>
        </table>
        <div class="mt-3">
          {{ $tasks->links() }}
        </div>
  </div>
</div>

@else
<div class="card">
  <div class="card-header">
    {{ __('My household chores') }}
  </div>
  <div class="row ml-2">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ __('Credit Total: ') }}</h5>
          <p class="card-text">
            <span class="badge badge-primary">Credits : {{ Helpers::getCreditTotal(Auth::user()->id) }}</span>
          </p>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ __('Statistics') }}</h5>
          <p class="card-text">
            <span class="badge badge-primary">Active: {{ Helpers::getActive(Auth::user()->id) }}</span>
            <span class="badge badge-warning">Pending: {{ Helpers::getPending(Auth::user()->id) }}</span>
            <span class="badge badge-success">Completed: {{ Helpers::getCompletion(Auth::user()->id) }}</span>
          </p>
        </div>
      </div>
    </div>

  </div>
  <div class="card-body">
        <table id="tasks-table" class="table table-striped table-bordered">
          <thead>
              <th>ID</th>
              <th>Title</th>
              <th>Description</th>
              <th>Credit Value</th>
              <th>Expedition Date</th>
              <th>Status</th>
              <th>Days Passed</th>
              <th>Actions</th>
          </thead>
          <tbody>
            @foreach ($taskUser as $item)
            <tr>
                <td>{{ $item->task->id }}</td>
                <td>{{ $item->task->title }}</td>
                <td>{{ $item->task->description }}</td>
                <td>{{ $item->task->credit_for_task }}</td>
                <td>{{ $item->task->expiration_date }}</td>
                <td class="{{ $item->task->statu->style }}">{{ $item->task->statu->name }}</td>
                <td>{{ Helpers::getHoursPassed($item->task->hours_passed, ['format' => 'full','locale'=>'en']) }}</td>
                <td>
                    <a class="btn btn-primary btn-block" href="{{ route('view', $item->task->id) }}">Show</a>
                    <a class="btn btn-primary btn-block" href="{{ route('task.update', $item->task->id) }}">Update</a>
                </td>
            </tr>
        @endforeach
          </tbody>
        </table>
        <div class='mt-3'>
          {{ $taskUser->links() }}
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
      $('#tasks-table').DataTable({
         paging: false
      });
    } );
  </script>
@stop

