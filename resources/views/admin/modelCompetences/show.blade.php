@extends('admin.layouts.app')

@section('content')

<br>
@include('admin.partials.errors')
<div class="row">
        <?php $currentAdmin = \Auth::guard('web_admin')->user(); ?> 
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h4>Modelo de competencia: {{ $modelCompetences->name }}</h4>
                    <h5>Lista de Competencias</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
		                <thead>
		                	<tr role="row">
		                    	<th style="width: 50px;">#</th>
		                    	<th style="width: 100px;">Nombre</th>
                                <th style="width: 100px;">Descripcion</th>
                                <th style="width: 100px;">Tipo</th>
		                    	<th style="width: 80px;">Acción</th>
		                    </tr>
		                </thead>
		                <tbody>   
		                @foreach ($competences as $competence)
	                	<tr class="gradeA odd" role="row">
				            <td class="sorting_1">{{$competence->id}}</td>
				            <td>{{$competence->label}}</td>
                            <td>{{$competence->description}}</td>
                            <td>{{$competence->competenceType->label}}</td>
				            <td class="center">		               	                        
                                <form class="formAction" action="{{ route('admin.competence.edit', $competence)}}" method="GET">
                                    {{ csrf_field() }}
                                    <button class="btn btn-warning btn-circle" type='submit' >
                                        <i class="fa fa-wrench"></i>
                                    </button>
                                </form> 
                                <form class="formAction" action="{{route('admin.competence.delete', $competence)}}" method="POST">
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
                    <h5>Crear Competencia</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12"> 
                            <form role="form" class="ng-pristine ng-valid" method="POST" action="{{ route('admin.competence.store') }}">
                            {{csrf_field()}}
                                <input type="hidden" name="model_competences_id" value='{{$modelCompetences->id}}'>
                                <div class="form-group">
                                	<label>Nombre</label> 
                                	<input type="text" name="label" placeholder="Ingrese un nombre" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Description</label> 
                                    <input type="text" name="description" placeholder="Ingrese una descripción" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <br> 
                                    <select class="select" id="category-select" name="competence_type_id">
                                        @foreach($competenceTypes as $competenceType)
                                        <option value="{{$competenceType->id}}">{{$competenceType->label}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <table class="table table-striped table-bordered table-hover dataTables-example dataTable">
                                    <thead>
                                        <tr role="row">
                                            <th style="width: 30px;">Nivel</th>
                                            <th style="width: 100px;">Descripción máquina</th>
                                            <th style="width: 100px;">Descripción humana</th>
                                            <th style="width: 100px;">Descripción reporte</th>
                                        </tr>
                                    </thead>
                                    <tbody>   
                                        <tr class="gradeA odd" role="row">
                                            <td>1</td>
                                            <td><input type="text" name="description_m_1" placeholder="Descripción máquina" class="form-control" required></td>
                                            <td><input type="text" name="description_h_1" placeholder="Descripción humana" class="form-control" required></td>
                                            <td><input type="text" name="description_r_1" placeholder="Descripción reporte" class="form-control" required></td>
                                        </tr>
                                        <tr class="gradeA odd" role="row">
                                            <td>2</td>
                                            <td><input type="text" name="description_m_2" placeholder="Descripción máquina" class="form-control" required></td>
                                            <td><input type="text" name="description_h_2" placeholder="Descripción humana" class="form-control" required></td>
                                            <td><input type="text" name="description_r_2" placeholder="Descripción humana" class="form-control" required></td>
                                        </tr>
                                        <tr class="gradeA odd" role="row">
                                            <td>3</td>
                                            <td><input type="text" name="description_m_3" placeholder="Descripción máquina" class="form-control" required></td>
                                            <td><input type="text" name="description_h_3" placeholder="Descripción humana" class="form-control" required></td>
                                            <td><input type="text" name="description_r_3" placeholder="Descripción reporte" class="form-control" required></td>
                                        </tr>
                                        <tr class="gradeA odd" role="row">
                                            <td>4</td>
                                            <td><input type="text" name="description_m_4" placeholder="Descripción máquina" class="form-control" required></td>
                                            <td><input type="text" name="description_h_4" placeholder="Descripción humana" class="form-control" required></td>
                                            <td><input type="text" name="description_r_4" placeholder="Descripción reporte" class="form-control" required></td>
                                        </tr>
                                    </tbody>
                                </table>

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