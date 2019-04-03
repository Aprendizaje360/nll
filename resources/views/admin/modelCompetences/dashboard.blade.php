@extends('admin.layouts.app')

@section('content')

<br>
@include('admin.partials.errors')
<div class="row">
        <?php $currentAdmin = \Auth::guard('web_admin')->user() ?> 
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Lista de Modelos de Competencia</h5>
                </div>
                <div class="ibox-content">
                    <p>* Necesita 2 competencias como minimo para ser usable</p>
                    <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
		                <thead>
		                	<tr role="row">
		                    	<th style="width: 50px;">#</th>
		                    	<th style="width: 100px;">Nombre</th>
                                <th style="width: 100px;">Descripcion</th>
                                <th style="width: 100px;">Usable?</th>
		                    	<th style="width: 80px;">Acción</th>
		                    </tr>
		                </thead>
		                <tbody>   
		                @foreach ($modelsCompetences as $modelCompetences)
	                	<tr class="gradeA odd" role="row">
				            <td class="sorting_1">{{$modelCompetences->id}}</td>
				            <td>{{$modelCompetences->name}}</td>
                            <td>{{$modelCompetences->description}}</td>
				            <td>@if ($modelCompetences->isComplete()) Usable @else No Usable @endif</td>
				            <td class="center">		  
                                <form class="formAction" action="{{route('admin.modelCompetences.show', $modelCompetences)}}" method="GET">
                                  {{ csrf_field() }}
                                      <button type='submit' class="btn btn-success btn-circle" value="DELETE"><i class="fa fa-search" aria-hidden="true"  ></i></button>  
                                </form>                	                        
                                <form class="formAction" action="{{ route('admin.modelCompetences.edit', $modelCompetences)}}" method="GET">
                                    {{ csrf_field() }}
                                    <button class="btn btn-warning btn-circle" type='submit' >
                                        <i class="fa fa-wrench"></i>
                                    </button>
                                </form> 
                                <form class="formAction" action="{{route('admin.modelCompetences.delete', $modelCompetences)}}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type='submit' class="btn btn-danger btn-circle" value="DELETE"><i class="fa fa-times" aria-hidden="true"  ></i></button>  
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
                    <h5>Crear Modelo de Competencias</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12"> 
                            <form role="form" class="ng-pristine ng-valid" method="POST" enctype="multipart/form-data" action="{{ route('admin.modelCompetences.store') }}">
                            {{csrf_field()}}
                                <div class="form-group">
                                	<label>Nombre</label> 
                                	<input type="text" name="name" placeholder="Ingrese un nombre" class="form-control" required>
                                </div>
                                 <div class="form-group">
                                    <label>Descripcion</label> 
                                    <input type="text" name="description" placeholder="Ingrese una descripcion" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Subir PDF</label> 
                                    <input type="file" name="pdf" placeholder="Ingrese un PDF descriptivo" class="form-control" required>
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