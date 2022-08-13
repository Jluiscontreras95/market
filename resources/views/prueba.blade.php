@extends('layouts.admin')
@section('title','Gestión de categorías')
@section('styles')

@endsection
@section('options')
@endsection
@section('preference')
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Categorías
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categorías</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    


                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Categorías</h4>
                        <i class="fas faellipsis-v"></i>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="products_listing" class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->id }}</th>
                                    <td>
                                        <a href="{{route('categories.show')}}">{{ $category->name }}</a>
                                    </td>
                                    <td>{{ $category->description }}</td>
                                    <td style="width: 50px;">
                                       < {!! Form::open( ['route'=>['categories.destroy', $category], 'method'=>'DELETE'] ) !!} 

                                        <a class="jsgrid-button jsgrid-edit-button" href="{{route('categories.edit', $category)}}" title="Editar">
                                            <li class="far fa-edit"></li>
                                        </a>

                                        <a class="jsgrid-button jsgrid-delete-button" type="submit" title="Eliminar">
                                            <li class="far fa-trash-alt"></li>
                                        </a>

                                        {{!! From::close() !!}}
                                    </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')

@endsection