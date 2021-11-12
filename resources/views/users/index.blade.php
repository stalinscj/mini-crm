@extends('layouts.admin.app')

@section('title', 'Usuarios')

@section('title-header', 'Usuarios')

@push('css')
  {!! Helper::dataTablesCSS() !!}
@endpush

@section('content')
<!-- Default box -->
<div class="card">

  <div class="card-header">
    <h3 class="card-title">Usuarios</h3>
    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">Crear</a>
  </div>

  <div class="card-body">
    <table id="table" class="table table-sm table-bordered table-hover w-100">

      <thead>
        <tr>
          <th>Nombre</th>
          <th>Email</th>
          <th>Fecha de creación</th>
          <th>Activo</th>
          <th data-sortable="false">Acciones</th>
        </tr>
      </thead>

      <tbody>
        @foreach($users as $user)
          <tr>
            <td><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></td>
            <td>{{ $user->email }}</td>
            <td data-order="{{ $user->created_at->timestamp }}">{{ $user->created_at }}</td>
            <td>{{ $user->trashed() ? 'No' : 'Sí' }}</td>
            <td>@include('users._actions')</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

</div>
@endsection

@push('js')
  {!! Helper::dataTablesJS() !!}

  {!! Helper::dataTables('#table') !!}

  {!! Helper::swalConfirm('.confirm-delete') !!}
@endpush
