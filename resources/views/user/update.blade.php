@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('Update User') }} - {{ $user->name }} </h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
      {{ __('Update User') }}
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
        <form action="{{ route('updatestore', $user->id) }}" method="POST">
            @csrf
          <table class="table">
            <tr>
                <td>{{ __('Name:') }}</td>  
                <td><input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}"></td>
            </tr>
            <tr>
                <td>{{ __('Email:') }}</td>
                <td><input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}"></td>
            </tr>
            <tr>
                <td>{{ __('Password:') }}</td>
                <td><input type="password" class="form-control" name="password" id="password"></td>
            </tr>
            </form>
          </table>
          <input type="hidden" name="id" value="{{ $user->id }}">
          <a href="/user/admin"><input type="button" class="btn btn-primary" value="Back"></a>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
  </div>
@stop