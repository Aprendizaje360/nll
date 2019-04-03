@extends('admin.layouts.app')

@section('content')

<br>
@include('admin.partials.errors')
<div class="row">
        <?php $currentAdmin = \Auth::guard('web_admin')->user() ?> 
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Lista de Administradores</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
		                <thead>
		                	<tr role="row">
		                    	<th style="width: 50px;">#</th>
		                    	<th style="width: 100px;">Nombre</th>
                                <th style="width: 100px;">Apellidos</th>
		                    	<th style="width: 224px;">Email</th>
                                <th style="width: 224px;">Rol</th>
		                    	<th style="width: 80px;">Acción</th>
		                    </tr>
		                </thead>
		                <tbody>   
		                @foreach ($admins as $admin)
	                	<tr class="gradeA odd" role="row">
				            <td class="sorting_1">{{$admin->id}}</td>
				            <td>{{$admin->name}}</td>
                            <td>{{$admin->lastName}}</td>
				            <td>{{$admin->email}}</td>
                            <td>{{$admin->roles->first()->label}}</td>
				            <td class="center">
				            	
                                  @if ($currentAdmin->hasRole('superadmin'))
                                      @if ($admin->hasRole('superclerk'))
                                      <form class="formAction" action="{{route('admin.delete', $admin)}}" method="POST">
                                  {{ method_field('DELETE') }}
                                  {{ csrf_field() }}
                                      <button type='submit' class="btn btn-danger btn-circle" value="DELETE"><i class="fa fa-times" aria-hidden="true"  ></i></button>  
                                                                    </form>

                                      @else 
                                        @if (!$admin->isLastOfRole('superadmin'))
                                            <form class="formAction" action="{{route('admin.delete', $admin)}}" method="POST">
                                  {{ method_field('DELETE') }}
                                  {{ csrf_field() }}
                                      <button type='submit' class="btn btn-danger btn-circle" value="DELETE"><i class="fa fa-times" aria-hidden="true"  ></i></button>  
                                                                    </form>
                                        @endif
                                      @endif
                                  @else
                                     @if (!$admin->hasRole('superadmin'))
                                        <form class="formAction" action="{{route('admin.delete', $admin)}}" method="POST">
                                  {{ method_field('DELETE') }}
                                  {{ csrf_field() }}
                                      <button type='submit' class="btn btn-danger btn-circle" value="DELETE"><i class="fa fa-times" aria-hidden="true"  ></i></button>  
                                                                    </form>
                                     @endif
                                  @endif
			                    @if ($currentAdmin->hasRole('superadmin'))
                                <form class="formAction" action="{{ route('admin.edit', $admin)}}" method="GET">
                                    {{ csrf_field() }}
                                    <button class="btn btn-warning btn-circle" type='submit' >
                                        <i class="fa fa-wrench"></i>
                                    </button>
                                </form>
                                @else
                                    @if (!$admin->hasRole('superadmin'))
                                        <form class="formAction" action="{{ route('admin.edit', $admin)}}" method="GET">
                                    {{ csrf_field() }}
                                    <button class="btn btn-warning btn-circle" type='submit' >
                                        <i class="fa fa-wrench"></i>
                                    </button>
                                </form>
                                    @endif
                                @endif

                                
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
                    <h5>Crear Administrador</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12"> 
                            <form role="form" class="ng-pristine ng-valid" method="POST" action="{{ route('admin.store') }}">
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
                                @if ($currentAdmin->hasRole('superadmin'))
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <br> 
                                    <select class="select" id="category-select" name="admin_role">
                                        @foreach($adminRoles as $role)
                                        <option value="{{$role->id}}">{{$role->label}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Enviar Correo con Información</label>
                                     <input name="send_email" id="send_email" type="checkbox"> 
                                </div>
                                @endif
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