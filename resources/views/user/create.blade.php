@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('Create User') }}</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
      {{ __('Create User') }}
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
      <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="form-group row">
          <label for="name"  class="col-sm-2 col-form-label">{{ __('name') }}</label>
          <div class="col-sm-10">
            <input type="text" required class="form-control" name="name" id="name"  >
          </div>
        </div>
        <div class="form-group row">
          <label for="email" class="col-sm-2 col-form-label">{{ __('email') }}</label>
          <div class="col-sm-10">
            <input type="email" required class="form-control" name="email" id="email">
          </div>
        </div>

        <div class="form-group row">
          <label for="password" class="col-sm-2 col-form-label">{{ __('Password') }}</label>
          <div class="col-sm-10">
            <input type="password" required class="form-control" name="password" id="password">
          </div>
        </div>

        <div class="form-group row">
            <label for="roles" class="col-sm-2 col-form-label">{{ __('roles') }}</label>
            <div class="col-sm-10">
              <select class="form-control" name="roles" id="roles">
                @foreach ($roles as $role)
                  <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

        <a class="btn btn-primary" href="/task/admin">{{ __('Back') }}</a>
        <input type="submit" class="btn btn-primary" name="save" value="Save" id="save">
      </form>
    </div>
  </div>
@stop