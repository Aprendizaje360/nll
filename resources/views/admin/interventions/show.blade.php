@extends('admin.layouts.app')

@section('content')

<br>
@include('admin.partials.errors')
<div class="row">
        <?php $currentAdmin = \Auth::guard('web_admin')->user(); ?> 
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h4>Intervencion: {{ $intervention->title }}</h4>
                    <a href="{{route('admin.intervention.dashboard', $intervention)}}">volver</a>
                    <h5>Lista de Secuencias</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
		                <thead>
		                	<tr role="row">
		                    	<th style="width: 50px;">Orden</th>
		                    	<th style="width: 100px;">Titulo</th>
                                <th style="width: 100px;">Descripcion</th>
                                <th style="width: 100px;">Acciones</th>
		                    </tr>
		                </thead>
		                <tbody>   
		                @foreach ($sequences as $sequence)
	                	<tr class="gradeA odd" role="row">
				            <td class="sorting_1">{{$sequence->order}}</td>
				            <td>{{$sequence->title}}</td>
                            <td>{{$sequence->description}}</td>
				            <td class="center">		             	                        
                                <form class="formAction" action="{{ route('admin.sequence.edit', $sequence)}}" method="GET">
                                    {{ csrf_field() }}
                                    <button class="btn btn-warning btn-circle" type='submit' >
                                        <i class="fa fa-wrench"></i>
                                    </button>
                                </form> 
                                <form class="formAction" action="{{route('admin.sequence.delete', $sequence)}}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type='submit' class="btn btn-danger btn-circle" value="DELETE"><i class="fa fa-times" aria-hidden="true"  ></i></button>  
                                </form>
				            </td>
				        </tr>
		                @endforeach
					    </tbody>
		            </table>
                    <form role="form" class="ng-pristine ng-valid" method="GET" action="{{ route('admin.sequence.create', $intervention) }}">
                        {{csrf_field()}}
                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit">
                        <strong>Crear</strong>
                    </button>
                    </form>
		        </div>
            </div>
        </div>
          
    </div>

@endsection