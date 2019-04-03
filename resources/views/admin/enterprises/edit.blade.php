@extends('admin.layouts.app')

@section('content')

<br>
@include('admin.partials.errors')
<div class="row">
        
        <div class="col-lg-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Editar Empresa</h5><a href="{{route('admin.enterprise.dashboard')}}">volver</a>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12"> 
                            <form method='POST' action="{{ route('admin.enterprise.update', $enterprise)}}">
                            {{ method_field("PUT") }}
                            {{csrf_field()}}
                                <div class="form-group">
                                	<label>Nombre</label> 
                                	<input type="text" name="name" placeholder="Ingrese un nombre" class="form-control" value="{{$enterprise->name}}" required>
                                </div>
                                <div class="form-group">
                                	<label>Email</label> 
                                	<input type="email" name="email" placeholder="Ingrese un Correo" class="form-control" value="{{$enterprise->email}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Número de Identificación</label> 
                                    <input type="number" name="identification_number" placeholder="Ingrese un RUC" class="form-control" value="{{$enterprise->identification_number}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Tipo de Identificación</label> 
                                    <select name="identification_type_id" class="form-control" required>
                                        @foreach($identificationTypes as $identificationType)
                                            <option 
                                            @if ($identificationType == $enterprise->identificationType) 
                                                selectsed 
                                            @endif 
                                            value="{{$identificationType->id}}"> {{$identificationType->label}} </option>
                                            option
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                	<label>Password</label> 
                                	<input type="password" name="password" placeholder="Ingrese Contraseña" class="form-control" >
                                </div>
                                <div class="form-group">
                                	<label>Confirmar Password</label> 
                                	<input type="password" name="password_confirmation" placeholder="Confirme Contraseña" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label>¿Habilitada?</label>
                                     <input name="enabled" id="enabled" @if($enterprise->enabled) checked @endif type="checkbox"> 
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