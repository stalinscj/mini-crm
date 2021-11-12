@extends('layouts.admin.app')

@section('title', 'Usuarios')

@section('title-header', 'Editar Usuario')

@section('content')
  @include('users._form', ['method' => 'PUT', 'action' => 'update'])
@endsection
