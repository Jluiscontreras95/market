@extends('layouts.admin')
@section('title','Edición de productos')
@section('styles')

@endsection
@section('create')
@endsection
@section('preference')
@endsection
@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Editar productos</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{route('products.index')}}">Productos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edición de productos</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Registro de productos</h4>
                    </div>
                    {!! Form::model($product, ['route'=>['products.update',$product], 'method' => 'PUT', 'files' => true]) !!}
                        <div>
                            <div class="row pb-3">
                                <div class="col">
                                    <label for="">Producto con impuesto</label>
                                    <div class="form-inline">
                                    <div class="form-check mr-3 ">
                                        <label class="form-check-label">{!! Form::radio('taxproduct', 'SI') !!} Si</label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">{!! Form::radio('taxproduct', 'NO') !!} No</label>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text" id="addon-wrapping">
                                                <i class="fa fa-bold menu-icon"></i>
                                            </span>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Nombre del producto" aria-describedby="addon-wrapping" value="{{$product->name}}" required>
                                        </div>
                                        <small id="helpId" class="text-muted">Campo obligatorio.</small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text" >
                                                <i class="fa fa-barcode menu-icon"></i>
                                            </span>
                                            <input type="text" name="code" id="code" class="form-control" placeholder="Código de barras" value="{{$product->code}}">
                                        </div>
                                        <small id="helpId" class="text-muted">(Campo opcional) Este campo se auto-genera si no tiene codigos establecidos.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text">Bs.</span>
                                            <input type="text" name="sell_price" id="sell_price" class="form-control" aria-describedby="helpId" placeholder="Precio para a venta" value="{{$product->sell_price}}" required>          
                                        </div>
                                        <small id="helpId" class="text-muted">Campo obligatorio.</small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <select class="form-control selectpicker" name="category_id" id="category_id" data-live-search="true" required>
                                            <option value="" disabled selected>Seleccionar categoría</option>
                                                @foreach ($categories as $category)   
                                                    <option value="{{$category->id}}"
                                                    @if ($category->id == $product->category_id)
                                                        selected
                                                    @endif
                                                    >{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <small id="helpId" class="text-muted">Campo obligatorio.</small>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <select class="form-control js-example-basic-multiple" name="providers[]" id="providers"  multiple="multiple">
                                            <option disabled>Seleccionar el proveedor</option>
                                            @foreach ($providers as $item)
                                                <option value="{{ $item->id }}" @if($product->providers->containsStrict('id', $item->id)) selected="selected" @endif>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <small id="helpId" class="text-muted">Campo obligatorio.</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="card-body">
                                        <h5 class="card-title d-flex">Imagen del producto
                                            <small class="ml-auto align-self-end">
                                            <small id="helpId" class="text-muted">Campo opcional.</small>
                                            </small>
                                        </h5>
                                        <input type="file" name="picture" id="picture" class="dropify" value="{{$product->image}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Actualizar</button>
                        <a href="{{route('products.index')}}" class="btn btn-light">Cancelar</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')

@endsection


