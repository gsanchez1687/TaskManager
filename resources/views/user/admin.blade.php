@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('Admin Daughter') }}</h1>
@stop

@section('content')


@if( Auth::user()->hasRole('Admin'))

<div class="card">
  <div class="card-header">
    {{ __('Admin Daughter') }}
  </div>

  <div class="card-body">
    <div class="mb-3">
      <a href="{{ route('user.create') }}" class="btn btn-primary">{{ __('New user son') }}</a>
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
        <table id="users-table" class="table table-striped table-bordered">
          <thead>
              <th>ID</th>
              <th>name</th>
              <th>email</th>
              <th>Type</th>
              <th>Credits</th>
              <th>Google</th>
              <th>Rol</th>
              <th>Created</th>
              <th>Updated</th>
              <th>Actions</th>
          </thead>
          <tbody>
            @foreach ($users as $item)
                  <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->type->name }}</td>
                    <td>{{ Helpers::getCreditByUser($item->id); }}</td>
                    <td>{{ $item->google_id ? 'Yes' : 'No' }}</td>
                    <td>{{ $item->getRoleNames()->implode(', ') }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>
                        <a href="{{ route('update', $item->id) }}" class="btn btn-primary btn-block" href="">Update</a>
                        <a href="{{ route('transfer', $item->id) }}" class="btn btn-primary btn-block" href="">Tranfer credit</a>
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

@section('css')
  <link href="https://cdn.datatables.net/v/bs5/dt-2.1.8/datatables.min.css" rel="stylesheet">
@stop

@section('js')
  <script src="https://cdn.datatables.net/v/bs5/dt-2.1.8/datatables.min.js"></script>
  <script>
    
    $(document).ready( function () {
      $('#users-table').DataTable({
         paging: false
      });
    } );
  </script>
@stop