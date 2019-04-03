
@extends('admin.layouts.app')

@section('content')
<br>
@include('admin.partials.errors')
<div class="row">
    <div class="col-lg-7">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Historial de Licencia </h5> <a href="{{route('admin.enterprise.show',$license->enterprise)}}">volver</a>
            </div>
            <div class="ibox-content">
                <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
                    <thead>
                        <tr role="row">
                            <th style="width: 50px;">#</th>
                            <th style="width: 100px;">Intervención</th>
                            <th style="width: 100px;">Cambio en Usos Totales</th>
                            <th style="width: 224px;">Nueva Fecha Expiración</th>
                            <th style="width: 100px;">Fecha de Creación</th>
                            <th style="width: 100px;">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>   
                    @foreach ($license->licenseOrders as $licenseOrder)
                    <tr class="gradeA odd" role="row">
                        <td class="sorting_1">{{$licenseOrder->id}}</td>
                        <td>{{$licenseOrder->license->intervention->title}}</td>
                        <td>{{$licenseOrder->uses_added}}</td>
                        <td>{{$licenseOrder->new_expiration_date}}</td>
                        <td>{{$licenseOrder->created_at}}</td>
                        <td>{{$licenseOrder->observations}}</td>
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
                <h5>Editar Licencia</h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12"> 
                        <form role="form" class="ng-pristine ng-valid" method="POST" action="{{ route('admin.license.update', $license) }}">
                            {{ method_field("PUT") }}
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Intervencion</label> 
                                <p>Nota: Editar la intervencion mientras este en uso puede traer errores</p>
                                <select name="intervention_id" class="form-control" required>
                                    @foreach($interventions as $intervention)
                                        <option @if ($intervention->id == $license->intervention->id) selected @endif value="{{$intervention->id}}"> {{$intervention->title}} </option>
                                        option
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                            	<label>Nuevo Total de Usos (No se suma)</label> 
                            	<input type="text" name="total_uses" placeholder="Ingrese una cantidad de usos" class="form-control" value="{{$license->total_uses}}" required>
                            </div>
                            <div class="form-group">
                            	<label>Nueva Fecha de Expiración</label> 
                            	<input type="date" name="expiration_date" placeholder="Ingrese una Fecha de Expiración" class="form-control" value="{{$license->expiration_date}}" required>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit">
                                	<strong>Editar</strong>
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