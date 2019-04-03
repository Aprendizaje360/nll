@extends('enterprise.layouts.app')

@section('theme-skin')hello @stop

@section('css')
    @parent
    
@stop

@section('content')

@include('enterprise.partials.errors')

<?php
    $clerk = null;
    if ($enterprise->parent_enterprise_id)
    {
        $clerk = $enterprise;
        $enterprise = $enterprise->parent();
    } 
?>

<div>
    {{-- <div class="notification">
        <img src="/images/001-sound.svg" alt="campana">
        <span>Área de ventas está por vencer</span>
        <span style="float: right"><i class="fa fa-times" aria-hidden="true"></i></span>
    </div> --}}
    <div class="instructions">
        <div class="container">
            <img src="/images/003-interface.svg" alt="files">
            <h1 class="title">
                Instrucciones
            </h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae dicta perferendis quae incidunt ab sit, fugit, neque adipisci at dolor!</p>
        </div>
    </div>
    <div class="interventions">
        <div class="container">
            <h2 class="sub-title">Intervenciones</h2>
            <table class="table table--alpha">
                <thead>
                    <tr>
                        <th>Intervención</th>
                        <th>Inscritos/Usos/Total</th>
                        <th>Expira</th>
                        <th>Contact Sales</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enterprise->interventions as $intervention)
                        <tr>
                            <td><a class="btn--red" href="{{route('enterprise.intervention.show', ['enterprise' => $enterprise, 'intervention' => $intervention])}}">{{ $intervention->title }}</a></td>
                            <?php $license = $intervention->getLicenseFromEnterprise($enterprise);?>
                            <td>{{$license->currently_enrolled . '/' . $license->uses . '/' . $license->total_uses}}</td>
                            <td>{{$license->getExpirationDateAsFormat('d \d\e F \d\e\l Y')}}</td>
                            <td><a class="btn--red" href="mailto:{{$intervention->support_mail}}">Enviar Correo</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if (!$clerk)
    </div>
    <div class="container">
        <div class="clerks">
            <div class="clerks__left">
                <h2 class="sub-title">Lista de Clerks</h2>
                <table class="table table--beta">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo electrónico</th>
                            <th>Intervenciones</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enterprise->getClerks() as $clerk)
                        <tr>
                            <td>{{$clerk->name}}</td>
                            <td>{{$clerk->email}}</td>
                            <td>
                            @foreach ($clerk->getPermittedInterventions()->get() as $index=>$int)
                                @if ($index > 2)
                                    @break
                                @endif
                                {{$int->title }},
                            @endforeach
                            etc.
                            </td>
                            <td class="table__edit"> 
                                <form action="{{ route('enterprise.clerk.edit', $clerk)}}" method="GET">
                                    {{ csrf_field() }}
                                    <button type='submit' class="btn--blue-small">
                                        <i class="fa fa-wrench"></i>
                                    </button>
                                </form>
                                <form action="{{route('enterprise.clerk.delete', $clerk)}}" method="POST">
                                  {{ method_field('DELETE') }}
                                  {{ csrf_field() }}
                                      <button type='submit' value="DELETE" class="btn--blue-small">
                                        <i class="fa fa-times" aria-hidden="true"  ></i>
                                      </button>  
                                </form>          
                            </td>           
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="clerks__right">
                <div>
                    <h2>Agregar clerks</h2>
                    <button type="submit" class="btn--blue" id="addClerk">Agregar Clerk</button>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="modal" id="modal">
    <div class="clerk--modal">
        <h1 class="title">Formulario Agregar un Clerk</h1>

        <form role="form" class="ng-pristine ng-valid" method="POST" action="{{ route('enterprise.store.clerk', $enterprise) }}">
            {{csrf_field()}}
            <div class="clerk__inputs">
                <div>
                   <input type="text" name="name" placeholder="Nombre *" class="input" required> 
                </div>
                <div>
                   <input type="email" name="email" placeholder="Correo *" class="input" required> 
                </div>
            </div>
            <br>
            <br>
            <h2 class="sub-title--beta">Asignar permisos</h2>
            <ul>
                @foreach ($enterprise->interventions as $index=>$intervention)
                    <li>
                        <input type="checkbox" id="perm{{$index}}" name="int{{$intervention->id}}">
                        <label for="perm{{$index}}"> Permiso {{$intervention->title}}</label>
                    </li>
                @endforeach
            </ul>
           
            <div class="clerk__options">
                <button class="btn--red">
                    Crear
                </button>
                <button class="btn--red" id="cancel">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<script src="{{asset('enterprise/js/addClerks.min.js') }}" type="text/javascript"></script>


@endsection