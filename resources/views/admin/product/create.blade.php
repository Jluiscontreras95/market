@extends('layouts.admin')
@section('title','Registro de productos')
@section('styles')
@endsection
@section('create')
@endsection
@section('preference')
@endsection
@section('content')

    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Registro de productos</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{route('products.index')}}">Productos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Registro de productos</li>
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
                        <hr>
                        {!! Form::open(['route'=>'products.store', 'method' => 'POST', 'files' => true]) !!}
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
                                            <label for="name">Nombre del producto</label>
                                            <div class="input-group flex-nowrap">
                                                <span class="input-group-text" id="addon-wrapping">
                                                    <i class="fa fa-bold menu-icon"></i>
                                                </span>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Nombre del producto" aria-describedby="addon-wrapping" required>
                                            </div>
                                            <small id="helpId" class="text-muted">Campo obligatorio.</small>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="code">Código del producto</label>
                                            <div class="input-group flex-nowrap">
                                                <span class="input-group-text" >
                                                    <i class="fa fa-barcode menu-icon"></i>
                                                </span>
                                                <input type="text" name="code" id="code" class="form-control" placeholder="Código de barras ">
                                            </div>
                                            <small id="helpId" class="text-muted">(Campo opcional) Este campo se auto-genera si no tiene codigos establecidos.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="cost_price" class="label">Precio de costo</label>
                                            <div class="input-group flex-nowrap">
                                                <span class="input-group-text" id="addon-wrapping"><strong>Bs.</strong></span>
                                                <input type="number" class="form-control" name="cost_price" id="cost_price" placeholder="Precio de costo" aria-describedby="addon-wrapping" require>
                                            </div>
                                            <small id="helpId" class="text-muted">Campo obligatorio.</small>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="utility" class="label">(%) Utilidad.</label>
                                            <div class="input-group flex-nowrap">
                                                <span class="input-group-text" id="addon-wrapping"><strong>%</strong></span>
                                                <input type="number" class="form-control" name="utility" id="utility" placeholder="Utilidad" aria-describedby="addon-wrapping" require>
                                            </div>
                                            <small id="helpId" class="text-muted">Campo obligatorio.</small>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="sell_price">Precio para la venta</label>
                                            <div class="input-group flex-nowrap">
                                                <span class="input-group-text">Bs.</span>
                                                <input type="number" step="any" name="sell_price" id="sell_price" class="form-control" aria-describedby="helpId" placeholder="Precio para a venta" required>   
                                            </div>
                                            <small id="helpId" class="text-muted">Campo obligatorio.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="category_id">Categoría</label>
                                            <select class="form-control selectpicker" name="category_id" id="category_id" data-live-search="true" required>
                                                <option value="" disabled selected>Seleccionar categoría</option>
                                                    @foreach ($categories as $category)   
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        <small id="helpId" class="text-muted">Campo obligatorio.</small>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="providers">Provedor(es)</label>
                                            <select class="form-control js-example-basic-multiple" name="providers[]" id="providers"  multiple="multiple" required>
                                                <option disabled selected>Seleccionar el proveedor</option>
                                                    @foreach ($providers as $provider)   
                                                        <option value="{{$provider->id}}">{{$provider->name}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        <small id="helpId" class="text-muted">Campo obligatorio.</small>
                                    </div>
                                </div>
                                <div class="row pt-5">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="measure">El producto será comprado/vendido en:</label>
                                            <select class="form-control selectpicker" name="measure" id="measure" data-live-search="true" title="Este producto será comprado en....." required>
                                                <option value="" disabled selected>Seleccionar medida</option>
                                                <option value="KG">KG</option>
                                                <option value="UND">UND</option> 
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
                                            <input type="file" name="picture" id="picture" class="dropify" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Registrar</button>
                            <a href="{{route('products.index')}}" class="btn btn-light">Cancelar</a>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

<script>


var cost_price = $('#cost_price');
var utility = $('#utility');


$('#cost_price, #utility').keyup(function(){

    if (isNaN(parseFloat($('#cost_price').val())) &&  isNaN(parseFloat($('#utility').val()))) {
        total += 0;
    } else {
        total = parseFloat($('#cost_price').val()) * parseFloat($('#utility').val());
    }
    $("#sell_price").val(total);
    
});


</script>


@endsection