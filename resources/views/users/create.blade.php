@extends('layouts.admin.app')

@section('title', 'Usuarios')

@section('title-header', 'Crear Usuario')

@section('content')
  @include('users._form', ['method' => 'POST', 'action' => 'store'])
@endsection
