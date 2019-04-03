@extends('admin.layouts.app')

@section('content')

<br>
@include('admin.partials.errors')
<div class="row">
        
        <div class="col-lg-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title row">
                    <div class="col-md-10">
                        <h5>Editar Administrador</h5>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('admin.dashboard')}}">volver</a>
                    </div>
                    <br>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12"> 
                            <form method='POST' action="{{ route('admin.profile.update', $admin)}}">
                            {{ method_field("PUT") }}
                            {{csrf_field()}}
                                <div class="form-group">
                                	<label>Nombre</label> 
                                	<input type="text" name="name" placeholder="Ingrese un nombre" class="form-control" value="{{$admin->name}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Apellidos</label> 
                                    <input type="text" name="lastName" placeholder="Ingrese un apellido" class="form-control" value="{{$admin->lastName}}" required>
                                </div>
                                <div class="form-group">
                                	<label>Email</label> 
                                	<input type="text" name="email" placeholder="Ingrese un Correo" class="form-control" value="{{$admin->email}}" required>
                                </div>
                                <div class="form-group">
                                	<label>Password</label> 
                                	<input type="password" name="password" placeholder="Ingrese Contraseña" class="form-control" >
                                </div>
                                <div class="form-group">
                                	<label>Confirmar Password</label> 
                                	<input type="password" name="password_confirmation" placeholder="Confirme Contraseña" class="form-control" >
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