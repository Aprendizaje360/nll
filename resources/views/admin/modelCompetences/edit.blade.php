@extends('admin.layouts.app')

@section('content')

<br>
@include('admin.partials.errors')
<div class="row">
        
        <div class="col-lg-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Editar Modelo de Competencias</h5><a href="{{route('admin.modelCompetences.dashboard')}}">volver</a>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12"> 
                            <form method='POST' enctype="multipart/form-data" action="{{ route('admin.modelCompetences.update', $modelCompetences)}}">
                            {{ method_field("PUT") }}
                            {{csrf_field()}}
                                <div class="form-group">
                                	<label>Nombre</label> 
                                	<input type="text" name="name" placeholder="Ingrese un nombre" class="form-control" value="{{$modelCompetences->name}}" required>
                                </div>
                                <div class="form-group">
                                	<label>Descripción</label> 
                                	<input type="text" name="description" placeholder="Ingrese una descripción" class="form-control" value="{{$modelCompetences->description}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Subir PDF</label> 
                                    <input type="file" name="pdf" placeholder="Ingrese un PDF descriptivo" class="form-control">
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit">
                                    	<strong>Guardar</strong>
                                    </button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection