@extends('layouts.admin.app')

@section('title', 'Empresas')

@section('title-header', 'Crear Empresa')

@section('content')
  @include('companies._form', ['method' => 'POST', 'action' => 'store'])
@endsection
