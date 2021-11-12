@extends('layouts.admin.app')

@section('title', 'Colaboradores')

@section('title-header', 'Editar Colaborador')

@section('content')
  @include('collaborators._form', ['method' => 'PUT', 'action' => 'update'])
@endsection
