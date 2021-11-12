@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('title-header', 'Dashboard')

@section('content')
<div class="container-fluid">
    
    <div class="row">

        {{-- Users Count --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">

                <div class="inner">
                    <h3>{{ $usersCount }}</h3>

                    <p>Usuarios registrados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>

                <a href="{{ route('users.index') }}" class="small-box-footer">
                    Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        {{-- ./Users Count --}}

        {{-- Companies Count --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">

                <div class="inner">
                    <h3>{{ $companiesCount }}</h3>

                    <p>Empresas registradas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-building"></i>
                </div>

                <a href="{{ route('companies.index') }}" class="small-box-footer">
                    Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        {{-- ./Companies Count --}}

        {{-- Collaborators Count --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">

                <div class="inner">
                    <h3>{{ $collaboratorsCount }}</h3>

                    <p>Colaboradores registrados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-tie"></i>
                </div>

                <a href="{{ route('collaborators.index') }}" class="small-box-footer">
                    Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        {{-- ./Collaborators Count --}}

    </div>

</div>
@endsection
