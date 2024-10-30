@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('Change Password') }}</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
      {{ __('Change Password') }}
    </div>
    <div class="card-body">
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
        <form action="{{ route('changePasswordStore') }}" method="POST">
            @csrf
            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Change Password</label>
                <div class="col-sm-10">
                  <input type="password" required class="form-control" id="password" name="password">
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-10">
                  <input type="password" required class="form-control" id="confirmPassword" name="confirmPassword">
                </div>
              </div>
              <a href="/task/admin" class="btn btn-primary" role="button">{{ __('Back') }}</a>
            <button type="submit" class="btn btn-primary">Change</button>
        </form>
    </div>
</div>
@stop