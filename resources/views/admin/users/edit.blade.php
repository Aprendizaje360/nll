@extends('admin.layouts.app')

@section('content')

<br>
@include('admin.partials.errors')
<div class="row">
        
        <div class="col-lg-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Editar Usuario</h5><a href="{{route('admin.user.dashboard')}}">volver</a>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12"> 
                            <form method='POST' action="{{ route('admin.user.update', $user)}}">
                            {{ method_field("PUT") }}
                            {{csrf_field()}}
                                <div class="form-group">
                                	<label>Nombre</label> 
                                	<input type="text" name="name" placeholder="Ingrese un nombre" class="form-control" value="{{$user->name}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Apellidos</label> 
                                    <input type="text" name="lastName" placeholder="Ingrese un apellido"  class="form-control" value="{{$user->lastName}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Teléfono</label> 
                                    <input type="number" name="telephone" placeholder="Ingrese un Teléfono" class="form-control" value="{{$user->telephone}}" required>
                                </div>
                                <div class="form-group">
                                	<label>Email</label> 
                                	<input type="email" name="email" placeholder="Ingrese un Correo" class="form-control" value="{{$user->email}}" required>
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
                                    <label>¿Habilitado?</label>
                                     <input name="enabled" id="enabled" @if($user->enabled) checked @endif type="checkbox"> 
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