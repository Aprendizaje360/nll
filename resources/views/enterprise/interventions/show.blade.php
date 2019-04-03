@extends('enterprise.layouts.app')
<style>
.pagination {
    float: right;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    padding-left: 0;
    list-style: none;
    border-radius: .25rem
}
.pagination li.active {
    font-weight: bold;
    color: #fff;
    background: #104275;
    width: auto;
    text-align: center;
    padding: 4px 4px;
    border-radius: 2px;
}

.pagination li {
    width: auto;
    text-align: center;
    padding: 4px 4px;
    border-radius: 2px;
    margin-left: 2px;
}
.badge {
    width: 100%;
    display: block;
    text-align: center;
    padding: 4px;
    background: #eee;
    color: #888;
    border-radius: 3px;
    margin-bottom: 10px;
    font-size: 18px;
}

.alert {
    background: green;
    padding: 40px;
    color: #fff;
    font-size: 20px;
    max-width: 100%;
}
</style>

@section('content')

@include('enterprise.partials.errors')

@if(session()->has('message'))
<div class="alert">
    <div class="container">
        {{ session('message') }}    
        @php
            session()->forget('message')
        @endphp
    </div>
</div>
@endif

<div class="sales">

    <section class="desc">
        <div class="container">
            <div class="desc__top">
                <div>
                    <img src="/images/002-worker.svg" alt="person working">
                    <h1 class="title">{{$intervention->title}}</h1>
                </div>
                <table class="lisences">
                    <tr>
                        <th></th>
                        <th>Usuarios</th>
                        <th>Fecha límite</th>
                    </tr>
                    <tr>
                        @php
                            $license = $intervention->getLicenseFromEnterprise($enterprise);
                        @endphp
                        
                        <td>Licencia</td>
                        <td><div class="users">{{$license->currently_enrolled}}</div></td>
                        <td class="date"><div>{{$license->getExpirationDateAsFormat('d m Y')}}</div></td>
                    </tr>
                </table>
            </div>
            <div class="desc__bottom">
                <div>
                    <p>{{$intervention->description}}</p>
                </div>
                <div>
                    <h2 class="sub-title">Modelo de competencias</h2>
                    <a href="{{route('enterprise.intervention.pdf', ['enterprise' => $enterprise, 'intervention' => $intervention])}}"><button class="btn--red"><i class="fa fa-download" aria-hidden="true"></i>&nbsp Descargar PDF</button></a>
                    <p>{{$intervention->modelCompetences->description}}</p>
                    <div style="display:flex; justify-content: flex-end;">
                        <a href="{{route('enterprise.intervention.report', ['enterprise' => $enterprise, 'intervention' => $intervention])}}"><button class="btn--blue">reporter global</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="add-users">
        <div class="container">
            <h2 class="sub-title">Agregar usuarios</h2>
            <p>Instrucciones de descarga de excel y subida de users</p>
            <div class="add-users__head"  style="text-align: right; padding-bottom: 15px;">
                <a href="{{route('enterprise.users.download', ['enterprise' => $enterprise, 'intervention' => $intervention] )}}">Link de descarga de Excel</a>
                <form id="excel-form" method="POST" action="{{route('enterprise.users.upload', ['enteprise' => $enterprise, 'intervention' => $intervention])}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <label for="excel" class="btn--red"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp subir archivo</label>
                    <input type="file" id='excel' name='excel' class="hidden">
                    <!-- <button type="submit" class="btn--red"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp subir archivo</button> -->
                </form>
            </div>
            <div class="add-users__head"  style="text-align: right; padding-bottom: 15px;">
                <form method="GET" action="{{route('enterprise.intervention.show', ['enteprise' => $enterprise, 'intervention' => $intervention])}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <label for="excel" class="btn--red">Buscar:</label>
                    <input type="text" name='q'
                    @if (isset($_GET['q']))
                        value="{{$_GET['q']}}"
                    @else
                        value=""
                    @endif
                    >
                    <button type="submit" class="btn--red"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
            {{ $employees->links() }}
            <table class="table table--alpha" style="width: 100% !important">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo Compañia</th>
                        <th>Estado</th>
                        <th>Token</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                    <tr>
                        <td>{{$employee->name }}</td>
                        <td>{{$employee->email_company}}</td>
                        @if ($employee->getInterventionResult($intervention))
                            <td><a href="{{route('enterprise.users.getResults', ['user' => $employee, 'intervention' => $intervention])}}">Ver resultados</a></td>
                        @else
                            <td>Prueba Pendiente</td>
                        @endif
                        <td style="text-align: center">
                            <span class="badge">
                                {{ $employee->getTokenFromIntervention($intervention) }} 
                            </span>
                            <a class="btn--red" href="{{route('enterprise.users.sendToken', ['user' => $employee, 'intervention' => $intervention])}}" style="padding: 0">Enviar token</a></td>
                        <td class="table__edit">
                            <form class="formAction" action="{{ route('enterprise.users.sendResults', ['user' => $employee, 'intervention' => $intervention])}}" method="POST">
                                {{ csrf_field() }}
                                <button class="btn--blue-small" type='submit' >
                                    <i class="fa fa-envelope"></i>
                                </button>
                            </form>
                            <form class="formAction" action="{{ route('enterprise.users.edit', ['enterprise' => $enterprise, 'intervention' => $intervention, 'user' => $employee])}}" method="GET">
                                {{ csrf_field() }}
                                <button class="btn--blue-small" type='submit' >
                                    <i class="fa fa-wrench"></i>
                                </button>
                            </form>
                            <form class="formAction" action="{{route('enterprise.users.delete', ['intervention' => $intervention, 'user' => $employee])}}" method="POST">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type='submit' class="btn--blue-small" value="DELETE"><i class="fa fa-times" aria-hidden="true"></i></button>  
                            </form>          
                        </td>
                    </tr> 
                @endforeach
                </tbody>
            </table>
            <br>
            <br>
            {{ $employees->links() }}
            <div>
                <a href="{{ route('enterprise.home')}}"><button class="btn--red">Volver</button></a>
            </div>
        </div>
    </section>


</div>

<script src="{{asset('enterprise/js/uploadFile.min.js') }}" type="text/javascript"></script>

@endsection