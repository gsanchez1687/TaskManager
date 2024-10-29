@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('View Task') }} - {{ $task->title }} </h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
      {{ __('Detail Task') }}
    </div>
    <div class="card-body">
          <table class="table">
            <tr>
              <td>ID</td>
              <td>{{ $task->id }}</td>
            </tr>
            <tr>
              <td>{{ __('Title:') }}</td>
              <td>{{ $task->title }}</td>
            </tr>
            <tr>
              <td>{{ __('Description:') }}</td>
              <td>{{ $task->description }}</td>
            </tr>
            <tr>
              <td>{{ __('Credit Value:') }}</td>
              <td>{{ $task->credit_for_task }}</td>
            </tr>
            <tr>
              <td>{{ __('Expedition Date:') }}</td>
              <td>{{ $task->expiration_date }}</td>
            </tr>
            <tr>
              <td>{{ __('Days Left:') }}</td>
              <td>{{ Helpers::getHoursPassed($task->hours_passed, ['format' => 'full','locale'=>'en']) }}</td>
            </tr>
            <tr>
              <td>{{ __('Status:') }}</td>
              <td class="{{ $task->statu->style }}">{{ $task->statu->name }}</td>
            </tr>
          </table>
          <div>
            <a class="btn btn-primary" href="{{ route('admin') }}">{{ __('Back') }}</a>
          </div>
    </div>
  </div>
@stop