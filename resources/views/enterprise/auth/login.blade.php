@extends('enterprise.layouts.auth')

@section('content')


<div class="login-box">
    <div class="login-box__header">Login de Empresa</div>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/enterprise_login') }}">
        {{ csrf_field() }}

        <div>
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Correo Electrónico" class="input" required autofocus>
        </div>

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        
        <br>

        <div>
            <i class="fa fa-lock" aria-hidden="true"></i>
            <input type="password" name="password" placeholder="Contraseña" class="input" required>
        </div>

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
        <br>
        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
        <br><br>

        <button type="submit" class="btn--blue">Ingresar</button>

        <a href="{{ url('/enterprise_password/reset') }}">&nbsp Forgot Your Password?</a>
    </form>
</div>

@endsection