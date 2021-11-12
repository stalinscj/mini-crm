@extends('layouts.admin.app')

@section('title', 'Empresas')

@section('title-header', 'Editar Empresa')

@section('content')
  @include('companies._form', ['method' => 'PUT', 'action' => 'update'])
@endsection
