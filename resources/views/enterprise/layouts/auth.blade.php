<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

@include('enterprise/partials/auth_head')

<body>

  <!-- Wrapper-->
    <div id="wrapper">

      <div class="login">
        <div class="login__header">
            <img src="/images/Vector-Smart-Object.png" alt="centrum">
            <img src="/images/muse_logo.png" alt="muse">
        </div>
        <div class="login__body">

          @if (Auth::guard('web_enterprise')->check())

            <!-- Page wraper -->
            <div>
            

                <!-- Main view  -->
                @yield('content')

            
            </div>
            <!-- End page wrapper-->

          @else

            @yield('content')

          @endif

        </div>
      </div>

    </div><!-- End wrapper-->


@section('footer_scripts')

     <script src="{{asset('admin/vendor/js/jquery-3.1.1.min.js') }}" type="text/javascript"></script>
     <script src="{{asset('admin/vendor/js/bootstrap.min.js') }}" type="text/javascript"></script>
     <script src="{{asset('admin/vendor/js/inspinia.min.js') }}" type="text/javascript"></script>
     <script src="{{asset('admin/js/main.min.js') }}" type="text/javascript"></script>
    
@show

</body>
</html>
