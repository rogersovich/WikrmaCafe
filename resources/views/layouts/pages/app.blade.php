@extends('layouts.element.main')

@section('title', 'Admin')

@section('custom-css')
    <style>
        .breadcrumb-item + .breadcrumb-item::before{
            content: '-';
            color: #5e72e4;
        }
    </style>
@endsection

@section('content')

@php
    $session = Session::get('user');
@endphp


@include('layouts.element.navbar')

    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
              
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            
            <div class="col-xl-4 p-2">
              <div class="jumbotron jumbotron-fluid bg-white shadow">
                <div class="container">
                  <h1 class="display-5 text-primary">Dashboard</h1>
                  <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
                </div>
              </div>             
            </div>
            <div class="col-xl-8 p-2">
              <div class="jumbotron jumbotron-fluid bg-white shadow">
                <div class="container ">
                  <h1 class="display-3 text-primary">Wikrama Untuk Indonesia</h1>
                  <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
                </div>
              </div>             
            </div>
        </div>
    </div>

@endsection
