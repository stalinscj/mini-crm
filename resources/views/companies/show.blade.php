@extends('layouts.admin.app')

@section('title', 'Empresas')

@section('page-title', 'Empresas')

@section('content')

<div class="row container">
    <div class="col-xl-6">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Empresa {{ $company->name }}</h3>
                <a href="{{ URL::previous() }}" class="btn btn-sm btn-secondary float-right">Regresar</a>
            </div>

            <div class="card-body">
                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                <p class="text-muted">
                    {{ $company->email }}
                </p>
                <hr>
                <strong><i class="fas fa-globe mr-1"></i> Sitio Web</strong>
                <p class="text-muted">
                    {{ $company->website }}
                </p>
                <hr>
                <strong><i class="fas fa-clock mr-1"></i> Fecha de creación</strong>
                <p class="text-muted">
                    {{ $company->created_at }}
                </p>
                <hr>
                <strong><i class="fas fa-clock mr-1"></i> Fecha de última actualización</strong>
                <p class="text-muted">
                    {{ $company->updated_at }}
                </p>
                <hr>
            </div>

        </div>
    </div>
</div>

@endsection
