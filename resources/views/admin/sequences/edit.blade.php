@extends('admin.layouts.app')

@section('content')

<br>
@include('admin.partials.errors')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Editar Secuencia</h5> <a href="{{route('admin.intervention.show', $intervention)}}">volver</a>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12"> 
                        <form role="form" class="ng-pristine ng-valid" method="POST" action="{{ route('admin.sequence.update', $sequence) }}" enctype="multipart/form-data">
                        {{ method_field("PUT") }}
                        {{csrf_field()}}
                        <h3>Campos Generales</h3>
                            <div class="form-group">
                                <label>Número de secuencias disponibles</label>
                                <br> 
                                <select class="select" id="category-select" name="order">
                                    @foreach ($intervention->getRemainingSequencesAndCurrent($sequence) as $index )
                                        <option value="{{$index}}" @if ($index == $sequence->order) selected @endif >{{$index}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                    <label>Título</label>  
                                    <input type="text" name="title" placeholder="Ingrese un titulo" class="form-control" required value="{{$sequence->title}}">
                            </div>

                            <div class="form-group">
                                    <label>Descripcion</label> 
                                    <input type="text" name="description" placeholder="Ingrese una Descripcion" class="form-control" required value="{{$sequence->description}}">
                            </div>
                            <div class="form-group">
                                    <label>Imagen de Fondo</label> 
                                    <input type="file" name="background_image" placeholder="Ingrese una Descripcion" class="form-control" >
                            </div>
                            <h3>Primiera Parte</h3>
                            <div class="form-group">
                                <label>Elige la Competencia Transversal</label>
                                <br> 
                                <select class="select" id="transversalSelect" name="transversal_competence_id">
                                    @foreach($transversalCompetences as $competence)
                                        <option @if ($competence->id == $sequence->retrieveTransversalCompetence()->id) selected @endif value="{{$competence->id}}">{{$competence->label}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ingrese el primer video</label>
                                <input type="text" name="video_1" class="form-control" required value="{{ $sequence->retrieveTransversalVideo()->video_path }}">
                            </div>
                            <div class="form-group">
                                <label>Pregunta</label> 
                                <input type="text" name="transversal_question" placeholder="Ingrese una pregunta" class="form-control" value="{{$sequence->transversal_question}}" required>
                            </div>
                            <div class="form-group">
                                <label>Alternativas</label>
                                <br> 
                                <table class="table table-striped table-bordered table-hover dataTables-example dataTable">
                                <thead>
                                    <tr role="row">
                                        <th style="width: 30px;">Alternativa</th>
                                        <th style="width: 30px;">Nivel</th>
                                        <th style="width: 100px;">Descripción máquina</th>
                                        <th style="width: 100px;">Descripción humana</th>
                                    </tr>
                                </thead>
                                <tbody>   
                                    <tr class="gradeA odd" role="row">
                                        <td><input type="text" name="transversal_alt_level_1" class="form-control" value="{{$transversalAlternatives[0]->text}}"></td>
                                        <td>1</td>
                                        <td><input type="text" disabled id="trans_description_m_1" name="trans_description_m_1" placeholder="Descripción máquina" class="form-control" required></td>
                                        <td><input type="text" disabled id="trans_description_h_1" name="trans_description_h_1" placeholder="Descripción humana" class="form-control" required></td>
                                    </tr>
                                    <tr class="gradeA odd" role="row">
                                        <td><input type="text" name="transversal_alt_level_2" class="form-control" value="{{$transversalAlternatives[1]->text}}"></td>
                                        <td>2</td>
                                        <td><input type="text" disabled id="trans_description_m_2" name="trans_description_m_2" placeholder="Descripción máquina" class="form-control" required></td>
                                        <td><input type="text" disabled id="trans_description_h_2" name="trans_description_h_2" placeholder="Descripción humana" class="form-control" required></td>
                                    </tr>
                                    <tr class="gradeA odd" role="row">
                                        <td><input type="text"  name="transversal_alt_level_3" class="form-control" value="{{$transversalAlternatives[2]->text}}"></td>
                                        <td>3</td>
                                        <td><input type="text" disabled id="trans_description_m_3" name="trans_description_m_3" placeholder="Descripción máquina" class="form-control" required></td>
                                        <td><input type="text" disabled id="trans_description_h_3" name="trans_description_h_3" placeholder="Descripción humana" class="form-control" required></td>
                                    </tr>
                                    <tr class="gradeA odd" role="row">
                                        <td><input type="text" name="transversal_alt_level_4" class="form-control" value="{{$transversalAlternatives[3]->text}}"></td>
                                        <td>4</td>
                                        <td><input type="text" disabled id="trans_description_m_4" name="trans_description_m_4" placeholder="Descripción máquina" class="form-control" required></td>
                                        <td><input type="text" disabled id="trans_description_h_4" name="trans_description_h_4" placeholder="Descripción humana" class="form-control" required></td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                            <h3>Segunda Parte</h3>
                            <div class="form-group">
                                <label>Elige la Competencia Funcional</label>
                                <br> 
                                <select class="select" id="functionalSelect" name="functional_competence_id">
                                    @foreach($functionalCompetences as $competence)
                                        <option @if ($competence->id == $sequence->retrieveFunctionalCompetence()->id) selected @endif value="{{$competence->id}}">{{$competence->label}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ingrese el segundo video</label>
                                <input type="text" name="video_2" class="form-control" required value="{{ $sequence->retrieveFunctionalVideo()->video_path }}">
                            </div>
                            <div class="form-group">
                                <label>Pregunta</label> 
                                <input type="text" name="functional_question" placeholder="Ingrese una pregunta" class="form-control" value="{{$sequence->functional_question}}" required>
                            </div>
                            <div class="form-group">
                                <label>Texto de Reflexión</label> 
                                <input type="text" name="reflexive_text" value="{{$sequence->reflexive_text}}"" placeholder="Ingrese un texto" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <br> 
                                <h4>Alternativas</h4>
                                <div class="form-group">
                                        <label>Categoria Asociada al grupo</label> 
                                        <input type="text" name="functional_category_1" placeholder="Ingrese un texto" class="form-control" value="{{$functionalCategories[0]->label}}" required>
                                    </div>
                                <table class="table table-striped table-bordered table-hover dataTables-example dataTable">
                                <thead>
                                    <tr role="row">
                                        <th style="width: 30px;">Alternativa</th>
                                        <th style="width: 30px;">Nivel</th>
                                        <th style="width: 100px;">Descripción máquina</th>
                                        <th style="width: 100px;">Descripción humana</th>
                                    </tr>
                                </thead>
                                <tbody>   
                                    <tr class="gradeA odd" role="row">
                                        <td><input type="text" name="functional_alt_level_1_1" class="form-control" value="{{$functionalCategories[0]->alternatives[0]->text}}"></td>
                                        <td>1</td>
                                        <td><input type="text" disabled class="func_description_m_1 form-control" placeholder="Descripción máquina" class="form-control" required></td>
                                        <td><input type="text" disabled class="func_description_h_1 form-control" placeholder="Descripción humana" class="form-control" required></td>
                                    </tr>
                                    <tr class="gradeA odd" role="row">
                                        <td><input type="text" name="functional_alt_level_1_2" class="form-control" value="{{$functionalCategories[0]->alternatives[1]->text}}"></td>
                                        <td>2</td>
                                        <td><input type="text" disabled class="func_description_m_2 form-control" placeholder="Descripción máquina" class="form-control" required></td>
                                        <td><input type="text" disabled class="func_description_h_2 form-control" placeholder="Descripción humana" class="form-control" required></td>
                                    </tr>
                                    <tr class="gradeA odd" role="row">
                                        <td><input type="text" name="functional_alt_level_1_3" class="form-control" value="{{$functionalCategories[0]->alternatives[2]->text}}"></td>
                                        <td>3</td>
                                        <td><input type="text" disabled class="func_description_m_3 form-control" placeholder="Descripción máquina" class="form-control" required></td>
                                        <td><input type="text" disabled class="func_description_h_3 form-control" placeholder="Descripción humana" class="form-control" required></td>
                                    </tr>
                                    <tr class="gradeA odd" role="row">
                                        <td><input type="text" name="functional_alt_level_1_4" class="form-control" value="{{$functionalCategories[0]->alternatives[3]->text}}"></td>
                                        <td>4</td>
                                        <td><input type="text" disabled class="func_description_m_4 form-control" placeholder="Descripción máquina" class="form-control" required></td>
                                        <td><input type="text" disabled class="func_description_h_4 form-control" placeholder="Descripción humana" class="form-control" required></td>
                                    </tr>
                                </tbody>
                                </table>
            
                                <br> 
                                <div class="form-group">
                                        <label>Categoria Asociada al grupo</label> 
                                        <input type="text" name="functional_category_2" placeholder="Ingrese un texto" class="form-control" value="{{$functionalCategories[1]->label}}" required>
                                    </div>
                                <table class="table table-striped table-bordered table-hover dataTables-example dataTable">
                                <thead>
                                    <tr role="row">
                                        <th style="width: 30px;">Alternativa</th>
                                        <th style="width: 30px;">Nivel</th>
                                        <th style="width: 100px;">Descripción máquina</th>
                                        <th style="width: 100px;">Descripción humana</th>
                                    </tr>
                                </thead>
                                <tbody>   
                                    <tr class="gradeA odd" role="row">
                                        <td><input type="text" name="functional_alt_level_2_1" class="form-control" value="{{$functionalCategories[1]->alternatives[0]->text}}"></td>
                                        <td>1</td>
                                        <td><input type="text" disabled class="func_description_m_1 form-control" placeholder="Descripción máquina" class="form-control" required></td>
                                        <td><input type="text" disabled class="func_description_h_1 form-control" placeholder="Descripción humana" class="form-control" required></td>
                                    </tr>
                                    <tr class="gradeA odd" role="row">
                                        <td><input type="text" name="functional_alt_level_2_2" class="form-control" value="{{$functionalCategories[1]->alternatives[1]->text}}"></td>
                                        <td>2</td>
                                        <td><input type="text" disabled class="func_description_m_2 form-control" placeholder="Descripción máquina" class="form-control" required></td>
                                        <td><input type="text" disabled class="func_description_h_2 form-control" placeholder="Descripción humana" class="form-control" required></td>
                                    </tr>
                                    <tr class="gradeA odd" role="row">
                                        <td><input type="text" name="functional_alt_level_2_3" class="form-control" value="{{$functionalCategories[1]->alternatives[2]->text}}"></td>
                                        <td>3</td>
                                        <td><input type="text" disabled class="func_description_m_3 form-control" placeholder="Descripción máquina" class="form-control" required></td>
                                        <td><input type="text" disabled class="func_description_h_3 form-control" placeholder="Descripción humana" class="form-control" required></td>
                                    </tr>
                                    <tr class="gradeA odd" role="row">
                                        <td><input type="text" name="functional_alt_level_2_4" class="form-control" value="{{$functionalCategories[1]->alternatives[3]->text}}"></td>
                                        <td>4</td>
                                        <td><input type="text" disabled class="func_description_m_4 form-control" placeholder="Descripción máquina" class="form-control" required></td>
                                        <td><input type="text" disabled class="func_description_h_4 form-control" placeholder="Descripción humana" class="form-control" required></td>
                                    </tr>
                                </tbody>
                                </table>
                                
                                <br> 
                                <div class="form-group">
                                        <label>Categoria Asociada al grupo</label> 
                                        <input type="text" name="functional_category_3" placeholder="Ingrese un texto" class="form-control" value="{{$functionalCategories[2]->label}}" required>
                                    </div>
                                <table class="table table-striped table-bordered table-hover dataTables-example dataTable">
                                <thead>
                                    <tr role="row">
                                        <th style="width: 30px;">Alternativa</th>
                                        <th style="width: 30px;">Nivel</th>
                                        <th style="width: 100px;">Descripción máquina</th>
                                        <th style="width: 100px;">Descripción humana</th>
                                    </tr>
                                </thead>
                                <tbody>   
                                    <tr class="gradeA odd" role="row">
                                        <td><input type="text" name="functional_alt_level_3_1" class="form-control" value="{{$functionalCategories[2]->alternatives[0]->text}}"></td>
                                        <td>1</td>
                                        <td><input type="text" disabled class="func_description_m_1 form-control" placeholder="Descripción máquina" class="form-control" required></td>
                                        <td><input type="text" disabled class="func_description_h_1 form-control" placeholder="Descripción humana" class="form-control" required></td>
                                    </tr>
                                    <tr class="gradeA odd" role="row">
                                        <td><input type="text" name="functional_alt_level_3_2" class="form-control" value="{{$functionalCategories[2]->alternatives[1]->text}}"></td>
                                        <td>2</td>
                                        <td><input type="text" disabled class="func_description_m_2 form-control" placeholder="Descripción máquina" class="form-control" required></td>
                                        <td><input type="text" disabled class="func_description_h_2 form-control" placeholder="Descripción humana" class="form-control" required></td>
                                    </tr>
                                    <tr class="gradeA odd" role="row">
                                        <td><input type="text" name="functional_alt_level_3_3" class="form-control" value="{{$functionalCategories[2]->alternatives[2]->text}}"></td>
                                        <td>3</td>
                                        <td><input type="text" disabled class="func_description_m_3 form-control" placeholder="Descripción máquina" class="form-control" required></td>
                                        <td><input type="text" disabled class="func_description_h_3 form-control" placeholder="Descripción humana" class="form-control" required></td>
                                    </tr>
                                    <tr class="gradeA odd" role="row">
                                        <td><input type="text" name="functional_alt_level_3_4" class="form-control" value="{{$functionalCategories[2]->alternatives[3]->text}}"></td>
                                        <td>4</td>
                                        <td><input type="text" disabled class="func_description_m_4 form-control" placeholder="Descripción máquina" class="form-control" required></td>
                                        <td><input type="text" disabled class="func_description_h_4 form-control" placeholder="Descripción humana" class="form-control" required></td>
                                    </tr>
                                </tbody>
                                </table>
                                    
                                <br> 
                                <div class="form-group">
                                        <label>Categoria Asociada al grupo</label> 
                                        <input type="text" name="functional_category_4" placeholder="Ingrese un texto" class="form-control" value="{{$functionalCategories[3]->label}}" required>
                                    </div>
                                <table class="table table-striped table-bordered table-hover dataTables-example dataTable">
                                <thead>
                                    <tr role="row">
                                        <th style="width: 30px;">Alternativa</th>
                                        <th style="width: 30px;">Nivel</th>
                                        <th style="width: 100px;">Descripción máquina</th>
                                        <th style="width: 100px;">Descripción humana</th>
                                    </tr>
                                </thead>
                                <tbody>   
                                    <tr class="gradeA odd" role="row">
                                        <td><input type="text" name="functional_alt_level_4_1" class="form-control" value="{{$functionalCategories[3]->alternatives[0]->text}}"></td>
                                        <td>1</td>
                                        <td><input type="text" disabled class="func_description_m_1 form-control" placeholder="Descripción máquina" class="form-control" required></td>
                                        <td><input type="text" disabled class="func_description_h_1 form-control" placeholder="Descripción humana" class="form-control" required></td>
                                    </tr>
                                    <tr class="gradeA odd" role="row">
                                        <td><input type="text" name="functional_alt_level_4_2" class="form-control" value="{{$functionalCategories[3]->alternatives[1]->text}}"></td>
                                        <td>2</td>
                                        <td><input type="text" disabled class="func_description_m_2 form-control" placeholder="Descripción máquina" class="form-control" required></td>
                                        <td><input type="text" disabled class="func_description_h_2 form-control" placeholder="Descripción humana" class="form-control" required></td>
                                    </tr>
                                    <tr class="gradeA odd" role="row">
                                        <td><input type="text" name="functional_alt_level_4_3" class="form-control" value="{{$functionalCategories[3]->alternatives[2]->text}}"></td>
                                        <td>3</td>
                                        <td><input type="text" disabled class="func_description_m_3 form-control" placeholder="Descripción máquina" class="form-control" required></td>
                                        <td><input type="text" disabled class="func_description_h_3 form-control" placeholder="Descripción humana" class="form-control" required></td>
                                    </tr>
                                    <tr class="gradeA odd" role="row">
                                        <td><input type="text" name="functional_alt_level_4_4" class="form-control" value="{{$functionalCategories[3]->alternatives[3]->text}}"></td>
                                        <td>4</td>
                                        <td><input type="text" disabled class="func_description_m_4 form-control" placeholder="Descripción máquina" class="form-control" required></td>
                                        <td><input type="text" disabled class="func_description_h_4 form-control" placeholder="Descripción humana" class="form-control" required></td>
                                    </tr>
                                </tbody>
                                </table>
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


@section('footer_scripts')

@parent

<!-- Axios is not Needed because we have windows.axios -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.1/axios.min.js" type="text/javascript"></script>

<script src="{{asset('admin/js/sequence_create.min.js') }}" type="text/javascript"></script>
@stop