@extends('layouts.admin.app')

@section('title', 'Empresas')

@section('title-header', 'Empresas')

@push('css')
  {!! Helper::dataTablesCSS() !!}
@endpush

@section('content')
<!-- Default box -->
<div class="card">

  <div class="card-header">
    <h3 class="card-title">Empresas</h3>
    <a href="{{ route('companies.create') }}" class="btn btn-primary btn-sm float-right">Crear</a>
  </div>

  <div class="card-body">
    <table id="table" class="table table-sm table-bordered table-hover w-100">

      <thead>
        <tr>
          <th>Nombre</th>
          <th>Email</th>
          <th>Sitio Web</th>
          <th>Activo</th>
          <th data-sortable="false">Acciones</th>
        </tr>
      </thead>

      <tbody>
        @foreach($companies as $company)
          <tr>
            <td><a href="{{ route('companies.show', $company->id) }}">{{ $company->name }}</a></td>
            <td>{{ $company->email }}</td>
            <td>{{ $company->website }}</td>
            <td>{{ $company->trashed() ? 'No' : 'Sí' }}</td>
            <td>@include('companies._actions')</td>
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
