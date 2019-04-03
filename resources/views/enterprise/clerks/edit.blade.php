@extends('enterprise.layouts.app')

@section('content')

@include('enterprise.partials.errors')

<div class="container--modal">
    <div class="clerk">
        <h1 class="title">Formulario Editar Clerk</h1>

        <form role="form" class="ng-pristine ng-valid" method="POST" action="{{ route('enterprise.update.clerk', $clerk) }}">
            {{ method_field("PUT") }}
            {{csrf_field()}}
            <div class="clerk__inputs">
                <div>
                   <input type="text" name="name" placeholder="Nombre *" class="input" value="{{$clerk->name}}" required> 
                </div>
                <div>
                   <input type="email" name="email" placeholder="Correo *" class="input"  value="{{$clerk->email}}" required> 
                </div>
            </div>
            <br>
            <div class="clerk__inputs">
                <div>
                    <input type="password" name="password" placeholder="Contraseña" class="input"> 
                </div>
                <div>
                    <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña" class="input"> 
                </div>
            </div>
            <br>
            <br>
            <h2 class="sub-title--beta">Asignar permisos</h2>
            <ul>
                @foreach ($enterprise->interventions as $index=>$intervention)
                    <li>
                        <input type="checkbox" @if ($clerk->hasPermission($intervention)) checked @endif name="int{{$intervention->id}}">
                        <label for="int{{$intervention->id}}">{{$intervention->title}}</label>
                    </li>
                @endforeach
            </ul>
            <div class="clerk__options">
                <button class="btn--red" type="submit">
                    Editar
                </button>
                <a href="/enterprise_home" class="btn--red">
                    Volver
                </a>
            </div>
        </form>
               
    </div>
</div>

@endsection