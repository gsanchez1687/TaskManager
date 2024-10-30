@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('My Profile') }}</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
      {{ __('My Profile') }}
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <tr>
                <td>{{ __('Google:') }}</td>
                <td>{{ $user->google_id ? 'Yes' : 'No' }}</td>
            </tr>
            <tr>
                <td>{{ __('Name:') }}</td>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <td>{{ __('Email:') }}</td>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <td>{{ __('Total Credit:') }}</td>
                <td>{{ $credit }}</td>
            </tr>
        </table>
    </div>
</div>
@if( !Auth::user()->hasRole('Admin'))
    <div class="card">
        <div class="card-header">
        {{ __('My List household chores') }}
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Credit Value</th>
                    <th>Expedition Date</th>
                    <th>Time Total</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    @foreach ($tasks as $item)
                        <tr>
                            <td>{{ $item->task->id }}</td>
                            <td>{{ $item->task->title }}</td>
                            <td>{{ $item->task->description }}</td>
                            <td>{{ $item->task->credit_for_task }}</td>
                            <td>{{ $item->task->expiration_date }}</td>
                            <td>{{ Helpers::getHoursPassed($item->task->hours_passed, ['format' => 'full','locale'=>'en']) }}</td>
                            <td class="{{ $item->task->statu->style }}">{{ $item->task->statu->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@stop