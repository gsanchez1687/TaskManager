@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('New Household chores') }}</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
      {{ __('New Household chores') }}
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
      <form action="{{ route('store') }}" method="POST">
        @csrf
        <div class="form-group row">
          <label for="title" class="col-sm-2 col-form-label">{{ __('Title') }}</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="title" id="title"  >
          </div>
        </div>
        <div class="form-group row">
          <label for="description" class="col-sm-2 col-form-label">{{ __('Description') }}</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="description" id="description">
          </div>
        </div>

        <div class="form-group row">
          <label for="credit_for_task" class="col-sm-2 col-form-label">{{ __('Credit value') }}</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" name="credit_for_task" id="credit_for_task">
          </div>
        </div>

        <div class="form-group row">
          <label for="expiration_date" class="col-sm-2 col-form-label">{{ __('Expiration Date') }}</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" name="expiration_date" id="expiration_date">
          </div>
        </div>
        <a class="btn btn-primary" href="/task/admin">{{ __('Back') }}</a>
        <input type="submit" class="btn btn-primary" name="save" value="Save" id="save">
      </form>
    </div>
  </div>
@stop