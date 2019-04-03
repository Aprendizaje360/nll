@extends('admin.layouts.app')

<br>
@include('admin.partials.errors')

@section('content')

<?php $admin = Auth::guard('web_admin')->user();?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-success">
                <div class="panel-heading">admin's Dashboard</div>
                <div class="panel-body">
                    Bienvenido {{$admin->name}} !!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection