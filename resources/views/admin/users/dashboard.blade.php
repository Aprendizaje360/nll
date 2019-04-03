@extends('admin.layouts.app')

@section('content')

<br>
@include('admin.partials.errors')
<div class="row">
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Lista de Clientes-Usuarios</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
		                <thead>
		                	<tr role="row">
		                    	<th style="width: 50px;">#</th>
		                    	<th style="width: 100px;">Nombre</th>
                                <th style="width: 100px;">Apellidos</th>
                                <th style="width: 100px;">Teléfono</th>
		                    	<th style="width: 224px;">Email</th>
		                    	<th style="width: 80px;">Acción</th>
		                    </tr>
		                </thead>
		                <tbody>   
		                @foreach ($users as $user)
	                	<tr class="gradeA odd" role="row">
				            <td class="sorting_1">{{$user->id}}</td>
				            <td>{{$user->name}}</td>
                            <td>{{$user->lastName}}</td>
                            <td>{{$user->telephone}}</td>
				            <td>{{$user->email}}</td>
				            <td class="center">                
                                <form class="formAction" action="{{route('admin.user.delete', $user)}}" method="POST">
                                  {{ method_field('DELETE') }}
                                  {{ csrf_field() }}
                                      <button type='submit' class="btn btn-danger btn-circle" value="DELETE"><i class="fa fa-times" aria-hidden="true"  ></i></button>  
                                </form>
                                <form class="formAction" action="{{ route('admin.user.edit', $user)}}" method="GET">
                                    {{ csrf_field() }}
                                    <button class="btn btn-warning btn-circle" type='submit' >
                                        <i class="fa fa-wrench"></i>
                                    </button>
                                </form>                    
				            </td>
				        </tr>
		                @endforeach
					    </tbody>
		            </table>
		        </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Crear Persona Cliente</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12"> 
                            <form role="form" class="ng-pristine ng-valid" method="POST" action="{{ route('admin.user.store') }}">
                            {{csrf_field()}}
                                <div class="form-group">
                                	<label>Nombre</label> 
                                	<input type="text" name="name" placeholder="Ingrese un nombre" class="form-control" required>
                                </div>
                                 <div class="form-group">
                                    <label>Apellidos</label> 
                                    <input type="text" name="lastName" placeholder="Ingrese un apellido" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Telefono</label> 
                                    <input type="number" name="telephone" placeholder="Ingrese un teléfono" class="form-control" required>
                                </div>
                                <div class="form-group">
                                	<label>Email</label> 
                                	<input type="email" name="email" placeholder="Ingrese un Correo" class="form-control" required>
                                </div>
                                <div class="form-group">
                                	<label>Password</label> 
                                	<input type="password" name="password" placeholder="Ingrese Contraseña" class="form-control" required>
                                </div>
                                <div class="form-group">
                                	<label>Confirmar Password</label> 
                                	<input type="password" name="password_confirmation" placeholder="Confirme Contraseña" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label> ¿Habilitado? </label>
                                     <input name="enabled" id="enabled" type="checkbox"> 
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit">
                                    	<strong>Crear</strong>
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