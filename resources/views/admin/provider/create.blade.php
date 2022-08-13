@extends('layouts.admin')
@section('title','Registro de categorías')
@section('styles')
@endsection
@section('create')
<!-- <li class="nav-item d-none d-lg-flex">
    <a class="nav-link" href="{{route('providers.create')}}">
        <span class="btn btn-primary">+ Crear nuevo</span>
    </a>
</li> -->
@endsection
@section('preference')
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        Registro de proveedores
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{route('providers.index')}}">Proveedores</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registro de proveedores</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Registro de proveedores</h4>
                    </div>
                    <hr>
                    
                    {!! Form::open(['route'=>'providers.store', 'method' => 'POST']) !!}

                   <div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping">
                                            <i class="far fa-user menu-icon"></i>
                                        </span>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Nombre y apellido del proveedor" aria-describedby="addon-wrapping" required>
                                    </div>
                                    <small id="helpId" class="text-muted">Campo obligatorio.</small>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping">
                                            <i class="far fa-address-book menu-icon"></i>
                                        </span>
                                        <input type="number" class="form-control" name="rif_number" id="rif_number" placeholder="Cédula del proveedor" aria-describedby="addon-wrapping" required>
                                    </div>
                                    <small id="helpId" class="text-muted">Campo obligatorio.</small>
                                </div>
                            </div>
                        
                            <div class="col">
                                <div class="form-group">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping">
                                            <i class="fa fa-university menu-icon"></i>
                                        </span>
                                        <input type="number" class="form-control" name="account_bank" id="account_bank" placeholder="Número de cuenta bancaria del proveedor" aria-describedby="addon-wrapping" required>
                                    </div>
                                    <small id="helpId" class="text-muted">Campo obligatorio.</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text">
                                            <i class="far fa-paper-plane menu-icon"></i>
                                        </span>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Correo" data-inputmask="'alias': 'email'" >
                                    </div>
                                    <small id="helpId" class="text-muted">Campo opcional.</small>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping">
                                            <i class="fa fa-phone menu-icon"></i>
                                        </span>
                                        <input type="number" class="form-control" name="phone" id="phone" placeholder="Número de teléfono del proveedor" aria-describedby="addon-wrapping" required>
                                    </div>
                                    <small id="helpId" class="text-muted">Campo obligatorio.</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <textarea name="address" id="maxlength-textarea" class="form-control" placeholder="Dirección del proveedor." rows="5" maxlength="100"></textarea>
                                    <small id="helpId" class="text-muted">Campo obligatorio.</small>
                                </div>
                            </div>
                        </div>
                   </div>

                    <button type="submit" class="btn btn-primary mr-2">Registrar</button>
                    <a href="{{route('providers.index')}}" class="btn btn-light">Cancelar</a>
                    
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')

@endsection