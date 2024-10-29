@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('Update Task') }} - {{ $task->title }} </h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
      {{ __('Update Task') }}
    </div>
    <div>
      @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
      @endif
      @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
      @endif
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
            <form action="{{ route('updateStatus', $task->id) }}" method="POST">
            @csrf
              <tr>
                  <td>Status</td>
                  <td>
                      <select class="form-control" name="status" id="status">
                          @foreach ($status as $item)
                              <option value="{{ $item->id }}">{{ $item->name }}</option>
                          @endforeach
                      </select>
                  </td>
              </tr>
              @if( Auth::user()->hasRole('Admin'))
                <tr>
                  <td>{{ __('Select user') }}</td>
                  <td>
                    <select class="form-control" name="nonAdminUsers" id="nonAdminUsers">
                        @foreach ($nonAdminUsers as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                  </td>
                </tr>
              @endif
              <tr>
                <td>
                  <a class="btn btn-primary" href="{{ route('admin') }}">{{ __('Back') }}</a>
                  <button type="submit" class="btn btn-primary">Update</button>
                </td>
              </tr>
            </form>
          </table>
    </div>
  </div>
@stop