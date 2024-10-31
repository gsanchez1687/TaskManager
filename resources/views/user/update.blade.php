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
            <tr>
              <td>{{ __('Type:') }}</td>
              <td>
                <select class="form-control" name="type" id="type">
                  @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ $user->type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                  @endforeach
                </select>
                <a href="" data-toggle="modal" data-target="#familyNucleusModal">
                   <p>New Type</p>
                  <div id="mensaje"></div>
                </a>
              </td>
            </tr>
            <tr>
                <td>{{ __('Roles:') }}</td>
                <td>
                  <select class="form-control" name="roles" id="roles">
                    @foreach ($roles as $role)
                      <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                  </select>
                </td>
            </tr>
            </form>
          </table>
          <input type="hidden" name="id" value="{{ $user->id }}">
          <a href="/user/admin"><input type="button" class="btn btn-primary" value="Back"></a>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="familyNucleusModal" tabindex="-1" aria-labelledby="familyNucleusModal" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Family nucleus</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
              <form id="familyNucleusForm">
                @csrf
                  <label for="name">Name:</label>
                  <input type="text" name="name" id="name" class="form-control" required>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="saveChangesBtn">Save changes</button>
          </div>
      </div>
  </div>
</div>

@stop

@section('js')
    <script>
        document.getElementById('saveChangesBtn').addEventListener('click', function() {
        // Obtenemos el formulario y el valor del campo de nombre
        const form = document.getElementById('familyNucleusForm');
        const formData = new FormData(form);

        // Enviamos el formulario con fetch
        fetch('/familynucleus', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                $('#mensaje').text('Type saved successfully!');
                location.reload();
                // Cerrar el modal y limpiar el formulario si es necesario
                $('#familyNucleusModal').modal('hide');
                form.reset();
            } else {
              $('#mensaje').text('There was an error saving the Type.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
    </script>
@stop