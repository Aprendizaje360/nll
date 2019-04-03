<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

@include('enterprise/partials/head')

<body>

  <!-- Wrapper-->
    <div>

    @include('enterprise/partials/navigation')

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

    </div><!-- End wrapper-->


@section('footer_scripts')

{{--      <script src="{{asset('admin/vendor/js/jquery-3.1.1.min.js') }}" type="text/javascript"></script>
     <script src="{{asset('admin/vendor/js/bootstrap.min.js') }}" type="text/javascript"></script>
     <script src="{{asset('admin/vendor/js/inspinia.min.js') }}" type="text/javascript"></script>
     <script src="{{asset('admin/js/main.min.js') }}" type="text/javascript"></script> --}}
    
<script src="{{asset('enterprise/js/enterprise.min.js') }}" type="text/javascript"></script>

@show

</body>
</html>
