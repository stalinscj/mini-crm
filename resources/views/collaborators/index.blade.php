@extends('layouts.admin.app')

@section('title', 'Colaboradores')

@section('title-header', 'Colaboradores')

@push('css')
  {!! Helper::dataTablesCSS() !!}
@endpush

@section('content')
<!-- Default box -->
<div class="card">

  <div class="card-header">
    <h3 class="card-title">Colaboradores</h3>
    <a href="{{ route('collaborators.create') }}" class="btn btn-primary btn-sm float-right">Crear</a>
  </div>

  <div class="card-body">
    <table id="table" class="table table-sm table-bordered table-hover w-100" data-order='[[0,"asc"], [1,"asc"]]'>

      <thead>
        <tr>
          <th>Empresa</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Email</th>
          <th>Activo</th>
          <th data-sortable="false">Acciones</th>
        </tr>
      </thead>

      <tbody>
        @foreach($collaborators as $collaborator)
          <tr>
            <td>{{ $collaborator->company->name }}</td>
            <td><a href="{{ route('collaborators.show', $collaborator->id) }}">{{ $collaborator->name }}</a></td>
            <td>{{ $collaborator->last_name }}</td>
            <td>{{ $collaborator->email }}</td>
            <td>{{ $collaborator->trashed() ? 'No' : 'Sí' }}</td>
            <td>@include('collaborators._actions')</td>
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
