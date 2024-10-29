@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('Admin Users') }}</h1>
@stop

@section('content')


@if( Auth::user()->hasRole('Admin'))

<div class="card">
  <div class="card-header">
    {{ __('Admin Users') }}
  </div>
  
  <div class="card-body">
        <table class="table table-striped table-bordered">
          <thead>
              <th>ID</th>
              <th>name</th>
              <th>email</th>
              <th>Google</th>
              <th>Rol</th>
              <th>Created</th>
              <th>Actions</th>
          </thead>
          <tbody></tbody>
              @foreach ($users as $item)
                  <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->google_id ? 'Yes' : 'No' }}</td>
                    <td>{{ $item->getRoleNames()->implode(', ') }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <a class="btn btn-primary btn-block" href="">Update</a>
                    </td>
                  </tr>
              @endforeach
          </tbody>
        </table>
        <div class="mt-3">
          {{ $users->links() }}
        </div>
  </div>
</div>
@endif
@stop