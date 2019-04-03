@extends('admin.layouts.app')

@section('content')

<br>
@include('admin.partials.errors')
<div class="row">
        <?php $currentAdmin = \Auth::guard('web_admin')->user(); ?> 
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Lista de Intervenciones</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
		                <thead>
		                	<tr role="row">
		                    	<th style="width: 50px;">#</th>
		                    	<th style="width: 100px;">Titulo</th>
                                <th style="width: 100px;">Descripcion</th>
                                <th style="width: 100px;">Modelo de Competencias</th>
                                <th style="width: 100px;">Acciones</th>
		                    </tr>
		                </thead>
		                <tbody>   
		                @foreach ($interventions as $intervention)
	                	<tr class="gradeA odd" role="row">
				            <td class="sorting_1">{{$intervention->id}}</td>
				            <td>{{$intervention->title}}</td>
                            <td>{{$intervention->description}}</td>
                            <td>{{$intervention->modelCompetences->name}}</td>
				            <td class="center">       
                                <form class="formAction" action="{{route('admin.intervention.show', $intervention)}}" method="GET">
                                  {{ csrf_field() }}
                                      <button type='submit' class="btn btn-success btn-circle" value="DELETE"><i class="fa fa-search" aria-hidden="true"  ></i></button>  
                                </form>                                         
                                <form class="formAction" action="{{ route('admin.intervention.edit', $intervention)}}" method="GET">
                                    {{ csrf_field() }}
                                    <button class="btn btn-warning btn-circle" type='submit' >
                                        <i class="fa fa-wrench"></i>
                                    </button>
                                </form> 
                                <form class="formAction" action="{{route('admin.intervention.delete', $intervention)}}" method="POST">
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
                    <h5>Crear Intervención</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12"> 
                            <form role="form" class="ng-pristine ng-valid" method="POST" action="{{ route('admin.intervention.store') }}">
                            {{csrf_field()}}
                                <div class="form-group">
                                	<label>Título</label> 
                                	<input type="text" name="title" placeholder="Ingrese un titulo" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Descripcion</label> 
                                    <input type="text" name="description" placeholder="Ingrese una Descripcion" class="form-control" required>
                                </div>

                               <div class="form-group">
                                    <label>Modelo De Competencias</label>
                                    <br> 
                                    <select class="select" id="category-select" name="model_competences_id">
                                        @foreach($modelsCompetences as $modelCompetences)
                                        <option value="{{$modelCompetences->id}}">{{$modelCompetences->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Texto de bienvenida</label> 
                                    <textarea name="welcome_text" id="" cols="30" rows="5" class="form-control" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Introducción</label> 
                                    <textarea name="introduction" id="" cols="30" rows="5" class="form-control" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Introducción al caso específico</label> 
                                    <textarea name="case_introduction" id="" cols="30" rows="5" class="form-control" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Texto Final</label> 
                                    <textarea name="final_text" id="" cols="30" rows="5" class="form-control" required></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label>Mail de Soporte</label> 
                                    <input type="email" name="support_mail" id="" cols="30" rows="5" class="form-control" required>
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