@extends('admin.layouts.app')

@section('content')

<br>
@include('admin.partials.errors')
<div class="row">
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Lista de Empresas</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
		                <thead>
		                	<tr role="row">
		                    	<th style="width: 50px;">#</th>
		                    	<th style="width: 100px;">Nombre</th>
		                    	<th style="width: 224px;">Email</th>
                                <th style="width: 224px;">Tipo Identificación</th>
                                <th style="width: 100px;">Número de Identificación</th>
		                    	<th style="width: 80px;">Acción</th>
		                    </tr>
		                </thead>
		                <tbody>   
		                @foreach ($enterprises as $enterprise)
	                	<tr class="gradeA odd" role="row">
				            <td class="sorting_1">{{$enterprise->id}}</td>
				            <td>{{$enterprise->name}}</td>
				            <td>{{$enterprise->email}}</td>
                            <td>{{$enterprise->identificationType->label}}</td>
                            <td>{{$enterprise->identification_number}}</td>
				            <td class="center">  
                                <form class="formAction" action="{{ route('admin.enterprise.show', $enterprise)}}" method="GET">
                                    {{ csrf_field() }}
                                    <button class="btn btn-success btn-circle" type='submit' >
                                        <i class="fa fa-search"></i>
                                    </button>
                                </form>
                                <form class="formAction" action="{{route('admin.enterprise.delete', $enterprise)}}" method="POST">
                                  {{ method_field('DELETE') }}
                                  {{ csrf_field() }}
                                      <button type='submit' class="btn btn-danger btn-circle" value="DELETE"><i class="fa fa-times" aria-hidden="true"  ></i></button>  
                                </form>          
                                <form class="formAction" action="{{ route('admin.enterprise.edit', $enterprise)}}" method="GET">
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
                    <h5>Crear Empresa</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12"> 
                            <form role="form" class="ng-pristine ng-valid" method="POST" action="{{ route('admin.enterprise.store') }}">
                            {{csrf_field()}}
                                <div class="form-group">
                                	<label>Nombre</label> 
                                	<input type="text" name="name" placeholder="Ingrese un nombre" class="form-control" required>
                                </div>
                                <div class="form-group">
                                	<label>Email</label> 
                                	<input type="email" name="email" placeholder="Ingrese un Correo" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Tipo de Identificación</label> 
                                    <select name="identification_type_id" class="form-control" required>
                                        @foreach($identificationTypes as $identificationType)
                                            <option value="{{$identificationType->id}}"> {{$identificationType->label}} </option>
                                            option
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Número de Identificación</label> 
                                    <input type="number" name="identification_number" placeholder="Ingrese un Número de Identificación" class="form-control" required>
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
                                    <label>¿Habilitada?</label>
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