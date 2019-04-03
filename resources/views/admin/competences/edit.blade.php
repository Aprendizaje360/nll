@extends('admin.layouts.app')

@section('content')

<br>
@include('admin.partials.errors')
<div class="row">
        
        <div class="col-lg-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Editar Competencia </h5><a href="{{route('admin.modelCompetences.show', $competence->modelCompetence)}}">volver</a>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12"> 
                            <form role="form" class="ng-pristine ng-valid" method="POST" action="{{ route('admin.competence.update', $competence) }}">
                            {{ method_field("PUT") }}
                            {{csrf_field()}}
                                <input type="hidden" name="model_competences_id" value='{{$competence->modelCompetence->id}}'>
                                <div class="form-group">
                                    <label>Nombre</label> 
                                    <input type="text" name="label" placeholder="Ingrese un nombre" class="form-control" value="{{ $competence->label }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Description</label> 
                                    <input type="text" name="description" placeholder="Ingrese una descripción" class="form-control" value="{{ $competence->description }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <br> 
                                    <select class="select" id="category-select" name="competence_type_id">
                                        @foreach($competenceTypes as $competenceType)
                                            <option value="{{$competenceType->id}}"
                                            @if ($competenceType->id == $competence->competence_type_id) selected @endif>
                                                {{$competenceType->label}}
                                            </option>
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
                                            <td>{{ $competence->levels()->get()[0]->level}}</td>
                                            <td><input type="text" name="description_m_1" placeholder="Descripción máquina" class="form-control" value="{{ $competence->levels()->get()[0]->technical_description }}" required></td>
                                            <td><input type="text" name="description_h_1" placeholder="Descripción humana" class="form-control" value="{{ $competence->levels()->get()[0]->amicable_description }}" required></td>
                                            <td><input type="text" name="description_r_1" placeholder="Descripción reporte" class="form-control" value="{{ $competence->levels()->get()[0]->report_description }}" required></td>
                                        </tr>
                                        <tr class="gradeA odd" role="row">
                                            <td>{{ $competence->levels()->get()[1]->level}}</td>
                                            <td><input type="text" name="description_m_2" placeholder="Descripción máquina" class="form-control" value="{{ $competence->levels()->get()[1]->technical_description }}" required></td>
                                            <td><input type="text" name="description_h_2" placeholder="Descripción humana" class="form-control" value="{{ $competence->levels()->get()[1]->amicable_description }}" required></td>
                                            <td><input type="text" name="description_r_2" placeholder="Descripción reporte" class="form-control" value="{{ $competence->levels()->get()[1]->report_description }}" required></td>
                                        </tr>
                                        <tr class="gradeA odd" role="row">
                                            <td>{{ $competence->levels()->get()[2]->level}}</td>
                                            <td><input type="text" name="description_m_3" placeholder="Descripción máquina" class="form-control" value="{{ $competence->levels()->get()[2]->technical_description }}" required></td>
                                            <td><input type="text" name="description_h_3" placeholder="Descripción humana" class="form-control" value="{{ $competence->levels()->get()[2]->amicable_description }}" required></td>
                                            <td><input type="text" name="description_r_3" placeholder="Descripción reporte" class="form-control" value="{{ $competence->levels()->get()[2]->report_description }}" required></td>
                                        </tr>
                                        <tr class="gradeA odd" role="row">
                                            <td>{{ $competence->levels()->get()[3]->level}}</td>
                                            <td><input type="text" name="description_m_4" placeholder="Descripción máquina" class="form-control" value="{{ $competence->levels()->get()[3]->technical_description }}" required></td>
                                            <td><input type="text" name="description_h_4" placeholder="Descripción humana" class="form-control" value="{{ $competence->levels()->get()[3]->amicable_description }}" required></td>
                                            <td><input type="text" name="description_r_4" placeholder="Descripción reporte" class="form-control" value="{{ $competence->levels()->get()[3]->report_description }}" required></td>
                                        </tr>
                                    </tbody>
                                </table>

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