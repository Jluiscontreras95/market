@extends('layouts.admin')
@section('title','Registro de ventas')
@section('styles')
@endsection

@section('create')
<!-- <li class="nav-item d-none d-lg-flex">
    <a class="nav-link" href="{{route('sales.create')}}">
        <span class="btn btn-primary">+ Crear nueva</span>
    </a>
</li> -->
@endsection
@section('preference')
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        Registro de ventas
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{route('sales.index')}}">Ventas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registro de ventas</li>
            </ol>
        </nav>
    
    
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                {!! Form::open(['route'=>'sales.store', 'method' => 'POST']) !!}
                    <div class="card-body">
                        <div class="d-flex justify-content-end">
                            <a class="nav-link" href="{{route('clients.create')}}">
                                <span class="btn btn-primary">+ Registrar Cliente</span>
                            </a>
                        </div>

                    
                         @include('admin.sale._form')
                    
                    </div>

                    <div class="card-footer text-muted">
                        <button type="submit" id="guardar" class="btn btn-primary float-right">Registrar</button>
                        <a href="{{route('sales.index')}}" class="btn btn-light">Cancelar</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')

<script>

$('#product').change(function (){
    $.ajax({
        url: "{{route('get_products_by_id')}}",
        method: 'GET',
        data:{
            product_id: $('#product').val()
        },
        dataType: 'json',
        success: function(data){
            $("#price").val(data.sell_price);
            $("#stock").val(data.stock);
            $("#code").val(data.code);
            $("#measure").html(data.measure);
            $("#measure_stock").html(data.measure);
            $("#tax_product").val(data.tax);
        }
    });
});



$("#guardar").hide();
$("#product").change(mostrarValores);

function mostrarValores(){
    datosProducto =document.getElementById('product').value.split('_');
    $("#price").val(datosProducto[2]);
    $("#stock").val(datosProducto[1]);
}

$(obtener_registro());
function obtener_registro(code){
    $.ajax({
        url: "{{route('get_products_by_barcode')}}",
        type: 'GET',
        data:{
            code: code
        },
        dataType: 'json',
        success:function(data){
            $("#price").val(data.sell_price);
            $("#stock").val(data.stock);
            $("#product").val(data.id);
            $("#tax_product").val(data.tax);
        }
    });
}

$(document).on('keyup', '#code', function(){
    var valorResultado = $(this).val();
    if(valorResultado!=""){
        obtener_registro(valorResultado);
    }else{
        obtener_registro();
    }
})

$(document).ready(function (){
    $("#agregar").click(function (){
        agregar();
    });
});


var cont = 0;
total = 0;
total_exento = [];
base_imponible = [];
subtotal = [];

function agregar(){
    datosProducto =document.getElementById('product').value.split('_');
    product_id = datosProducto[0]; 
    product = $("#product option:selected").text();
    quantity = $("#quantity").val();
    discount = $("#discount").val();
    price = $("#price").val();
    stock = $("#stock").val();
    tax = $("#tax_product").val();

    if (product_id != "" && quantity !="" && quantity > 0 &&  price != "" &&  tax != "") {

        if(discount === ""){
            discount = 0;
        }
        if(parseInt(stock) >= parseInt(quantity)){
            subtotal[cont] = (quantity * price) - (quantity * price * discount / 100);
            total = subtotal[cont]+(subtotal[cont] * tax /100);

            if (tax == 0) {

                total_exento[cont] = subtotal[cont]; 
                base_imponible[cont] = 0;
                iva = 0;

            }else{
                total_exento[cont] = 0;
                base_imponible[cont] = subtotal[cont];
                iva = base_imponible * tax /100;

                console.log({total_exento}, {base_imponible}, {iva});

            };
             
            
            var fila ='<tr class="selected" id="fila' + cont + '"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont + ');"><i class="fa fa-times"></i></button></td><td><input type="hidden" id="product_id[]" name="product_id[]" value="' + product_id +'"/>' + product + '</td><td><input type="hidden" id="price[]" name="price[]" value="' + price + '"/><input class="form-control" type="number"  value="' + parseFloat(price).toFixed(2) + '" disabled/></td><td><input type="hidden" id="discount[]" name="discount[]" value="' + parseFloat(discount).toFixed(2) + '"/><input class="form-control" type="number" value="' + parseFloat(discount).toFixed(2) + '" disabled/></td><td><input type="hidden" id="quantity[]" name="quantity[]" value="' + quantity + '"/><input class="form-control" type="number" value="' + quantity + '" disabled/></td><td><input type="hidden" id="tax[]" name="tax[]" onload="myScript()" value="' + tax + '"/><input class="form-control" type="number" value="' + parseFloat(tax).toFixed(2) + '" disabled/></td><td align="right">' + parseFloat(subtotal[cont]).toFixed(2) + '<td align="right">' + parseFloat(total).toFixed(2) + '</td></td><td align="right">' + parseFloat(total_exento[cont]).toFixed(2) + '</td><td align="right">' + parseFloat(base_imponible[cont]).toFixed(2) + '</td><td align="right">' + parseFloat(iva).toFixed(2) + '</td></tr>';
           



            // // const initialValue = 0;
            // // const suma = total_exento.reduce((total_exento, elem) => total_exento + elem, initialValue);

            // // const suma2 = base_imponible.reduce((base_imponible, elem) => base_imponible + elem, initialValue);
            
                
            // // console.log(suma2);
            // // $("#total_exento").html("Bs. " + suma);
            





            cont++;
            
            limpiar();
            totales();
            evaluar();
            $('#detalles').append(fila);
        }else{
            Swal.fire({
                type: 'error',
                text: 'La cantidad a vender supera el stock.',
            })
        }
    }else{
        Swal.fire({
            type: 'error',
            text: 'Rellene todos los campos del detalle de la venta.',
        })
    }
}

function limpiar(){
    $("#quantity").val("");
    $("#price").val("");
    $("#discount").val("");
    $("#code").val("");
    $("#measure_stock").val("");
    $("#stock").val("");
    $("#measure").val("");
    $('#product').val('default');
    $('#product').selectpicker('render');
    $('#product').selectpicker('refresh');
    $('#tax_product').val("");
}

function totales(){


    $('#tax').onload = function(){
        var elemt = [];
        numero = 0;     
    };
    
    $("#total").html("Bs. " + total.toFixed(2));

    
   


    exchange = '{{$exchange->description}}';
    total_impuesto = total * tax / 100;
    base_imponible= total + (total * tax  / 100);
    total_pagar = total + total_impuesto;
    total_divisas = total_pagar / exchange;




    
    $("#cuenta_total").val(total_pagar.toFixed(2));   
    $("#total_impuesto").html("Bs. " + total_impuesto.toFixed(2));
    $("#total_tax").val(total_impuesto.toFixed(2));
    $("#total_pagar_html").html("Bs. " + total_pagar.toFixed(2));
    $("#total_pagar").val(total_pagar.toFixed(2));
    $("#total_pagar_divisas_html").html("$. "+total_divisas.toFixed(2));
    $("#total_pagar_divisas").val(total_divisas.toFixed(2));

    $("#base_imponible").html("Bs. " + base_imponible.toFixed(2));
}

function evaluar() {

    let total = document.getElementById("cuenta_total").value;
	let lleva = document.getElementById("cuenta_lleva").value;

    if (total > 0){
        $("#guardar").show();
    }else{
        $("#guardar").hide();
    }
}

function eliminar(index){
    exchange = '{{$exchange->description}}';

    total = total - subtotal[index]/total_tax[index];
    total_impuesto = total * total_impuesto / 100;
    total_pagar_html = total + total_impuesto;
    total_divisas = total_pagar / exchange;
    $("#total").html("Bs. " + total);
    $("#total_impuesto").html("Bs. " + total_impuesto.toFixed(2));
    $("#total_tax").val(total_impuesto.toFixed(2));
    $("#total_pagar_html").html("Bs. " + total_pagar_html.toFixed(2));
    $("#total_pagar").val(total_pagar_html.toFixed(2));
    $("#total_pagar_divisas_html").html("$. "+total_divisas.toFixed(2));
    $("#total_pagar_divisas").val(total_divisas.toFixed(2));
    $("#cuenta_total").val(total_pagar_html.toFixed(2));
    $("#fila" + index).remove();
    evaluar();

}

$(obtener_registro_clientes());
function obtener_registro_clientes(dni){
    $.ajax({
        url: "{{route('get_Clients_by_dni')}}",
        type: 'GET',
        data:{
            dni: dni
        },
        dataType: 'json',
        success:function(data){
            console.log(data);
            $("#client_name").val(data.name);
            $("#client_id").val(data.id);
            console.log(data.id);
        }
    });
}

$(document).on('keyup', '#dni', function(){
    var valorResultado = $(this).val();
    if(valorResultado!=""){
        obtener_registro_clientes(valorResultado);
    }else{
        obtener_registro_clientes();
    }
});


var vuelto = 0;
var falta = 0;

$(".vuelto").on("focusout", event => {
    let field_id = "#"+event.target.id;
    vuelto += parseFloat($(field_id).val());
    parseFloat($("#cuenta_lleva").val(vuelto).toFixed(2));
   
});

$("#dollar").on("focusout", event => {

    exchange = '{{$exchange->description}}';
    vuelto += parseFloat($("#dollar").val() * exchange );
    parseFloat($("#cuenta_lleva").val(vuelto).toFixed(2));
   
});

$(".vuelto").on("click", event => {
    if (event.target.value == 0) {
        return false;
    }
    vuelto -= parseFloat(event.target.value);
    let field_id = "#"+event.target.id;
    parseFloat($("#cuenta_lleva").val(vuelto).toFixed(2));
    $(field_id).val(0);

});

$("#dollar").on("click", event => {
    if (event.target.value == 0) {
        return false;
    }
    exchange = '{{$exchange->description}}';
    vuelto -= parseFloat($("#dollar").val() * exchange );
    parseFloat($("#cuenta_lleva").val(vuelto).toFixed(2));
    $(field_id).val(0);

});

$("#cuenta_falta").on("click", event => {
    falta = parseFloat($("#cuenta_total").val()) - parseFloat($("#cuenta_lleva").val());
    parseFloat($("#cuenta_falta").val(falta).toFixed(2));
});


// $("#cuenta_lleva").on("change", event => {
    
//     var lleva = $("#total_lleva").val();
//     var total = $("#cuenta_total").val()
//     if ( total == lleva) {
//         $("#guardar").show();
//     }
//         $("#guardar").hide();
    

// });



</script>


@endsection





