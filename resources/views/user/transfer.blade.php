@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('Transfer') }} - {{ $user->name }} </h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
      {{ __('Transfer Credit') }}
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
        <form action="{{ route('transferstore') }}" method="POST">
            @csrf
            <div class="form-group row">
                <label for="current_amount_total_credit"  class="col-sm-2 col-form-label">{{ __('Credit') }}</label>
                <div class="col-sm-10">
                  <input type="number" required class="form-control" name="current_amount_total_credit" id="current_amount_total_credit">
                </div>
            </div>
            <div class="form-group row">
                <label for="credit"  class="col-sm-2 col-form-label">{{ __('Credit Total') }}</label>
                <div class="col-sm-10">
                    <button type="button" class="btn btn-primary">
                        Current amount: <span class="badge badge-light">{{ Helpers::getCreditByUser($user->id); }}</span>
                      </button>
                    
                </div>
            </div>
          <input type="hidden" name="id" value="{{ $user->id }}">
          <a href="/user/admin"><input type="button" class="btn btn-primary" value="Back"></a>
          <button type="submit" class="btn btn-primary">Transfer</button>
        </form>
    </div>
</div>
@stop