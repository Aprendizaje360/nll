@extends('enterprise.layouts.app')

@section('content')

@include('admin.partials.errors')

<div class="container--modal">
    <div class="create-clerk">
        <h1 class="title">Formulario Agregar un Clerk</h1>

        <form role="form" class="ng-pristine ng-valid" method="POST" action="{{ route('enterprise.store.clerk', $enterprise) }}">
            {{csrf_field()}}
            <div class="create-clerk__inputs">
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
           
            <div class="create-clerk__options">
                <button class="btn--red" type="submit">
                	Crear
                </button>
                <a href="/enterprise_home" class="btn--red">
                    Volver
                </a>
            </div>
        </form>
    </div>
</div>

@endsection