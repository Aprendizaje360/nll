<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

{{-- This is a basic theme template --}}
@include('admin/partials/head')
<body class="@yield("body-classes") @yield('theme-skin')">

  <!-- Wrapper-->
    <div id="wrapper">


     <!-- Navigation -->
        @include('client.partials.navigation')

        <!-- Page wraper -->
        <div id="page-wrapper" class="">

            

            <!-- Main view  -->
            @yield('content')

            

        </div>
        <!-- End page wrapper-->
         <!-- Footer -->
            @include('client.partials.footer')
    </div>
    <!-- End wrapper-->



@section('footer_scripts')
     
     <script src="{{asset('client/js/main.min.js') }}" type="text/javascript"></script>
    
@show

</body>
</html>