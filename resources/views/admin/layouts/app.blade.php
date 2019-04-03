<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

{{-- This is a basic theme template --}}
@include('admin/partials/head')
<body class="@yield("body-classes") @yield('theme-skin', 'md-skin')">

  <!-- Wrapper-->
    <div id="wrapper">

        @if (Auth::guard('web_admin')->check())
        <!-- Navigation -->
          @include('admin.partials.navigation')

          <!-- Page wraper -->
          <div id="page-wrapper" class="gray-bg">

              <!-- Page wrapper -->
              @include('admin.partials.topnavbar')

              <!-- Main view  -->
              @yield('content')

              <!-- Footer -->
              @include('admin.partials.footer')

          </div>
          <!-- End page wrapper-->
        @else

          @yield('content')

        @endif
    </div>
    <!-- End wrapper-->



@section('footer_scripts')
    <script src="{{asset('admin/vendor/js/jquery-3.1.1.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('admin/vendor/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('admin/vendor/js/inspinia.min.js') }}" type="text/javascript"></script>


    
@show

</body>
</html>
