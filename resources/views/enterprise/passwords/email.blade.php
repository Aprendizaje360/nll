{{-- email.blade.php --}}

@extends('enterprise.layouts.auth')

<!-- Main Content -->
@section('content')


<div class="login-box">
    <div class="login-box__header">Reset Password</div>
    <div class="panel-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/enterprise_password/email') }}">
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

            <br><br>

            <button type="submit" class="btn--blue">
                Send Password Reset Link
            </button>
        </form>
    </div>
</div>


@endsection