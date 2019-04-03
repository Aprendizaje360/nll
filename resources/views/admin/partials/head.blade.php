<head>
    {{-- Head Partial Defines this subsections --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="theme-color" content="@yield('theme_color', '#000000')" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'NML Admin') </title>

    {{-- This is so we can separate vendor from custom css, still we need to be sure if the server uses HTTP/1 or HTTP/2
    And separate CSS per page --}}
    @section('css')
        <link rel="stylesheet" href="{{asset('admin/vendor/css/bootstrap.css') }}" />
        <link rel="stylesheet" href="{{asset('admin/font-awesome/css/font-awesome.min.css') }}" />
        <link rel="stylesheet" href="{{asset('admin/css/style.css')}}" />
    @show

    @section('head_scripts')
    @show

    @include('common/partials/favicons')

</head>