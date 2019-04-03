@extends('admin.layouts.app')

@section('content')

<br>
@include('admin.partials.errors')
<div class="row">
        
        <div class="col-lg-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Editar Intervención</h5><a href="{{route('admin.intervention.dashboard')}}">volver</a>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12"> 
                            <form method='POST' action="{{ route('admin.intervention.update', $intervention)}}">
                            {{ method_field("PUT") }}
                            {{csrf_field()}}

                                <div class="form-group">
                                	<label>Titulo</label> 
                                	<input type="text" name="title" placeholder="Ingrese un nombre" class="form-control" value="{{$intervention->title}}" required>
                                </div>

                                <div class="form-group">
                                	<label>Descripción</label> 
                                	<input type="text" name="description" placeholder="Ingrese una descripción" class="form-control" value="{{$intervention->description}}" required>
                                </div>

                                <div class="form-group">
                                    <label>Modelo De Competencias</label>
                                    <br> 
                                    <select class="select" id="category-select" name="model_competences_id">
                                        @foreach($modelsCompetences as $modelCompetences)
                                            <option value="{{$modelCompetences->id}}"
                                            @if ($modelCompetences->id == $intervention->model_competences_id) selected @endif>
                                                {{$modelCompetences->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Texto de bienvenida</label> 
                                    <textarea name="welcome_text" id="" cols="30" rows="5" class="form-control"  required>{{$intervention->welcome_text}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Introducción</label> 
                                    <textarea name="introduction" id="" cols="30" rows="5" class="form-control"  required>{{$intervention->introduction}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Introducción al caso específico</label> 
                                    <textarea name="case_introduction" id="" cols="30" rows="5" class="form-control"  required>{{$intervention->case_introduction}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Texto Final</label> 
                                    <textarea name="final_text" id="" cols="30" rows="5" class="form-control"  required>{{$intervention->final_text}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Texto Final</label> 
                                    <textarea name="support_mail" id="" cols="30" rows="5" class="form-control"  required>{{$intervention->support_mail}}</textarea>
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