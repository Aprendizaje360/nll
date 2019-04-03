@extends('admin.layouts.app')

@section('content')

<br>
@include('admin.partials.errors')
<div class="row">
    <div class="col-lg-7">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Lista de Licencias</h5> <a href="{{route('admin.enterprise.dashboard')}}">volver</a>
            </div>
            <div class="ibox-content">
                <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
	                <thead>
	                	<tr role="row">
	                    	<th style="width: 50px;">#</th>
	                    	<th style="width: 100px;">Intervencion</th>
                            <th style="width: 224px;">Fecha Expiración</th>
                            <th style="width: 100px;">Inscritos</th>
                            <th style="width: 100px;">Cantidad Usos</th>
                            <th style="width: 100px;">Total Usos</th>
	                    	<th style="width: 80px;">Acción</th>
	                    </tr>
	                </thead>
	                <tbody>   
	                @foreach ($licenses as $license)
                	<tr class="gradeA odd" role="row">
			            <td class="sorting_1">{{$license->id}}</td>
			            <td>{{$license->intervention->title}}</td>
                        <td>{{$license->expiration_date}}</td>
                        <td>{{$license->currently_enrolled}}</td>
                        <td>{{$license->uses}}</td>
                        <td>{{$license->total_uses}}</td>
			            <td class="center">       
                            <form class="formAction" action="{{ route('admin.license.edit', $license)}}" method="GET">
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
                <h5>Añadir Licencia</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12"> 
                        <form role="form" class="ng-pristine ng-valid" method="POST" action="{{ route('admin.license.store') }}">
                        {{csrf_field()}}
                            <input type="hidden" name="enterprise_id" value={{$enterprise->id}}>
                            <div class="form-group">
                                <label>Intervencion</label> 
                                <select name="intervention_id" class="form-control" required>
                                    @foreach($interventions as $intervention)
                                        <option @if (old('intervention_id') == $intervention->id) selected  @endif value="{{$intervention->id}}" > {{$intervention->title}} </option>
                                        option
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                            	<label>Usos</label> 
                            	<input type="number" name="total_uses" placeholder="Ingrese una cantidad de usos" class="form-control" value={{old('total_uses')}} required>
                            </div>
                            <div class="form-group">
                            	<label>Fecha de Expiración</label> 
                            	<input type="date" name="expiration_date" placeholder="Ingrese una Fecha de Expiración" class="form-control" value={{old('expiration_date')}}  required>
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