@extends('layouts.element.kasir_main')

@section('title', 'User Interface')


@section('content')

<div class="container-cus">
    <div class="row" style="position: relative;">
        <div class="col-9 col-md-9">
            <nav class="navbar nav-custom-1 navbar-horizontal navbar-expand-lg navbar-dark">
                <div class="container">
                    <a class="font-weight-bold text-white" href="{{ route('kasir.home') }}">
                        <span class="f-yellow">Wikrama</span>Cafe
                    </a>

                    <button class="navbar-toggler fa-white" type="button" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="fa fa-bars fa-white"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar-default">
                        <div class="navbar-collapse-header">
                            <div class="row">
                                <div class="col-6 collapse-brand">
                                    <a href="javascript:;">
                                        <img src="{{ asset('assets/img/blue.png') }}">
                                    </a>
                                </div>
                                <div class="col-6 collapse-close">
                                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                                        <span></span>
                                        <span></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav ml-lg-auto">
                            <li class="nav-item">
                                <a class="nav-link nav-link-icon" href="{{ route('kasir.table') }}">
                                    Table
                                    <span class="nav-link-inner--text d-lg-none f-black">Discover</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link-icon" href="{{ route('kasir.menu') }}">
                                    Menu
                                    <span class="nav-link-inner--text d-lg-none f-black">Profile</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link-icon" href="{{ route('kasir.order') }}">
                                    Order Status
                                    <span class="nav-link-inner--text d-lg-none f-black">Profile</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link-icon" href="{{ route('kasir.payment') }}">
                                    Payment
                                    <span class="nav-link-inner--text d-lg-none f-black">Profile</span>
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
            <div class="container bg-yellow pt-50" style="height: 100vh;">
                <img class="bg-img" src="{{ asset("assets/img/work1.png") }}" alt="">
            </div>
        </div>
        <div class="col-3 col-md-3 bg-black">
            <nav class="navbar nav-custom-2 navbar-horizontal navbar-expand-lg navbar-dark">
                <div class="container">
                    <a class="font-weight-light text-sm text-white" href="#">
                        <span class="far fa-smile pr-1"></span>
                        Wed, Jul 22 2018 | 08.30
                    </a>
                    <button class="navbar-toggler fa-white" type="button" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="fa fa-bars fa-white"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar-default">
                        <div class="navbar-collapse-header">
                            <div class="row">
                                <div class="col-6 collapse-brand">
                                    <a href="javascript:;">
                                        <img src="{{ asset('assets/img/blue.png') }}">
                                    </a>
                                </div>
                                <div class="col-6 collapse-close">
                                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                                        <span></span>
                                        <span></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav ml-lg-auto">
                            <li class="nav-item">
                                <a class="nav-link nav-link-icon text-sm font-weight-bold" href="#">
                                    <span class="fa fa-user"></span>
                                    Kasir
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container bg-silver" style="height: 100vh;">
                <div class="container">
                    <div class="text-center pt-200">
                        <h3 class="font-weight-light f-black">Hello Wikrama Cafe</h3>
                        <h3 class="font-weight-light f-black">Lets Eat Some Food Today</h3>
                    </div>
                    <div class="text-center p-4">
                        <a href="{{ route('kasir.table') }}" class="btn btn-primary btn-block">
                            <span class="text-lg">Eat In</span>
                        </a>
                        <a href="{{ route('kasir.menu') }}" class="btn btns-dark btn-block">
                            <span class="text-lg text-white">Take Away</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


