@extends('layouts.admin.app')

@section('title', 'Colaboradores')

@section('title-header', 'Crear Colaborador')

@section('content')
  @include('collaborators._form', ['method' => 'POST', 'action' => 'store'])
@endsection
