@extends('enterprise.layouts.app')

@section('content')

@include('enterprise.partials.errors')
<br>

<div class="container--modal">
    <div class="create-clerk">
        <h1 class="title">Formulario Editar Usuario</h1>

        <form method='POST' action="{{ route('enterprise.users.update', $user)}}">
            {{ method_field("PUT") }}
            {{ csrf_field() }}

            <div class="create-clerk__inputs">
                <div>
                   <input type="text" name="name" placeholder="Nombre *" class="input" value="{{$user->name}}" required> 
                </div>
                <div>
                   <input type="text" name="lastName" placeholder="Apellidos *" class="input"  value="{{$user->lastName}}" required> 
                </div>
            </div>
            <br>
            <div class="create-clerk__inputs">
                <div>
                   <input type="date" name="birth_date" placeholder="Ingrese una Fecha de Nacimiento" class="input" value="{{$user->birth_datel}}"> 
                </div>
                <div>
                    <input type="radio" class="o-radio" name="gender" id="gender1" value="0" @if (!$user->gender) checked @endif>
                    <label for="gender1" class="o-label o-label--radio">Femenino</label>

                    <input type="radio" class="o-radio" name="gender" id="gender2" value="1"  @if ($user->gender) checked @endif>               
                    <label for="gender2" class="o-label o-label--radio"> Masculino</label>
                </div>
            </div>
            <br>
            <div class="create-clerk__inputs">
                <div>
                   <input type="text" name="area" placeholder="Area" class="input" value="{{$user->area}}"> 
                </div>
                <div>
                   <input type="text" name="sector" placeholder="Sector" class="input"  value="{{$user->sector}}"> 
                </div>
            </div>
            <br>
            <div class="create-clerk__inputs">
                <div>
                   <input type="text" name="work_position" placeholder="Puesto de Trabajo" class="input" value="{{$user->work_position}}"> 
                </div>
                <div>
                   <input type="text" name="year_experience" placeholder="Años de Trabajo" class="input"  value="{{$user->year_experience}}"> 
                </div>
            </div>
            <br>
            <div class="create-clerk__inputs">
                <div>
                   <input type="text" name="academic_degree" placeholder="Grado Académico" class="input" value="{{$user->academic_degree}}"> 
                </div>
                <div>
                   <input type="text" name="academic_field" placeholder="Campo Académico" class="input"  value="{{$user->academic_field}}"> 
                </div>
            </div>
            <br>
            <div class="create-clerk__inputs">
                <div>
                   <input type="text" name="country_residence" placeholder="País de Residencia" class="input" value="{{$user->country_residence}}"> 
                </div>
                <div>
                   <input type="text" name="city_residence" placeholder="Ciudad de Residencia" class="input"  value="{{$user->city_residence}}"> 
                </div>
            </div>
            <br>
            <div class="create-clerk__inputs">
                <div>
                   <input type="text" name="coutry_birth" placeholder="País de Nacimiento" class="input" value="{{$user->coutry_birth}}"> 
                </div>
                <div>
                   <input type="text" name="city_birth" placeholder="Ciudad de Nacimiento" class="input"  value="{{$user->city_birth}}"> 
                </div>
            </div>
            <br>
            <div class="create-clerk__inputs">
                <div>
                   <input type="text" name="email_company" placeholder="Correo Compañia" class="input" value="{{$user->email_company}}"> 
                </div>
                <div>
                   <input type="text" name="email" placeholder="Correo Personal" class="input"  value="{{$user->email}}"> 
                </div>
            </div>
            <br>

            <div class="create-clerk__options">
                <button class="btn--red" type="submit">
                    Editar
                </button>
                <a href="{{route('enterprise.intervention.show', ['enterprise' => $enterprise, 'intervention' => $intervention])}}" class="btn--red">
                    Volver
                </a>
            </div>
            <br>
            <br>
        </form>
                            
    </div>
</div>

@endsection