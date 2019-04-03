@extends('enterprise.layouts.app')

@section('css')
    @parent  
@stop

@section('content')

@include('enterprise.partials.errors')


<div class="reports">

    <section class="report-graph">
        <div class="container">
            <h2 class="title">Reporte Global</h2>
            <table class="table table--alpha">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Correo Compañia</th>
                        <th>Puntaje</th>
                        <th>Estado<s</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enterprise->employees()->fromIntervention($intervention)->get() as $employee)
                    <tr>
                        <td>{{$employee->name }}</td>
                        <td>{{$employee->lastName}}</td>
                        <td>{{$employee->email_company}}</td>
                        <td>{{$employee->get}}</td>
                    </tr> 
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

</div>

<script src="{{asset('enterprise/js/uploadFile.min.js') }}" type="text/javascript"></script>

@endsection