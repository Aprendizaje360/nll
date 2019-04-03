<?php $admin = Auth::guard('web_admin')->user();?>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{$admin->name}} {{$admin->lastName}}</strong>
                            </span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{route('admin.logout')}}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            @if( Auth::guard('web_admin')->user()->hasRole('superadmin') )
                <li class="">
                    <a href="{{route('admin.dashboard')}}"><i class="fa fa-male"></i> <span class="nav-label">Administradores</span> </a>
                </li>
                <li class="">
                    <a href="#"><i class="fa fa-building"></i> <span class="nav-label">Clientes</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse ">
                        <li><a href="{{route('admin.enterprise.dashboard')}}" >Empresa</a></li>
                    </ul>
                </li>
            @endif
            <li class="">
                <a href="{{route('admin.modelCompetences.dashboard')}}"><i class="fa fa-male"></i> <span class="nav-label">Modelo De Competencias</span> </a>
            </li>
             <li class="">
                <a href="{{route('admin.intervention.dashboard')}}"><i class="fa fa-male"></i> <span class="nav-label">Intervenciones</span> </a>
            </li>
        </ul>

    </div>
</nav>
