@extends('layouts.element.kasir_main')

@section('title', 'Cashier - Order')

@php
    $session = Session::get('user');
@endphp

@section('content')

@include('layouts.element.navkasir2')
<div class="container">
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="container bg-broken-white pt-50 pb-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            {{-- <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="border-radius: 22px 0 0 22px; border: none;"><i class="ni ni-zoom-split-in"></i></span>
                                </div>
                                <input style="border-radius: 0 22px 22px 0; border: none;" class="form-control" placeholder="Search" type="text">
                            </div> --}}
                            @if ($progressCount == 0)
                                
                            @else    
                            <div>
                                <h4 class="text-warning">
                                    Progress ({{ $progressCount }})
                                </h4>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="container">
                                <div class="row">
                                
                                @if ($progress == null)
                                    
                                @else
                                    @foreach ($progress as $o)

                                    <div class="col-md-3 p-2">
                                        <div class="card shadow">
                                            <div class="card-header pb-0">
                                                <h5 class="text-muted">
                                                    {{ $o->code }}
                                                </h5>
                                                <h5 class="text-muted">
                                                    <span class="text-dark">
                                                        @if ($o->booking == null)
                                                            Take Away
                                                        @else
                                                            {{ $o->booking->table }}
                                                        @endif
                                                    </span>
                                                    <br>
                                                    {{ $o->name }}
                                                </h5>
                                            </div>
                                            <div class="card-body pt-3 pb-0">
                                                <ul class="list-inline">
                                                    @foreach ($o->OrderDetails as $od)
                                                    <div>
                                                        <li class="list-inline-item">
                                                            <h5 class="text-dark">
                                                                {{ ucwords($od->Product->name) }}
                                                            </h5>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <h5 class="text-dark">
                                                                {{ $od->qty }}
                                                            </h5>
                                                        </li>
                                                    </div>
                                                    @endforeach

                                                </ul>
                                                <div class="pb-3">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4">
                                                            <h5>
                                                                <a class="badge badge-pill badge-info" href="{{ route('kasir.process', $o->id) }}">                                                   
                                                                    Process               
                                                                </a>
                                                            </h5>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4">
                                                            <h5>
                                                                <a class="badge badge-pill badge-danger" href="{{ route('kasir.cancelProcess', $o->id) }}">                                                   
                                                                    Cancel               
                                                                </a>
                                                            </h5>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            @if ($completeCount == 0)
                                
                            @else
                            <div>
                                <h4 class="text-success">Completed ({{ $completeCount }})</h4>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="container">
                                <div class="row">
                                    @if ($complete == null)
                                    
                                    @else
                                    @foreach ($complete as $c)
                                    <div class="col-md-3 p-2">
                                        <div class="card shadow">
                                            <div class="card-header pb-0">
                                                <h5 class="text-muted">
                                                    {{ $c->code }}
                                                </h5>
                                                <h5 class="text-muted">
                                                    <span class="text-dark">
                                                        @if ($c->booking == null)
                                                            Take Away
                                                        @else
                                                            {{ $c->booking->table }}
                                                        @endif
                                                    </span>
                                                    <br>
                                                    {{ $c->name }}
                                                </h5>
                                            </div>
                                            <div class="card-body pt-3 pb-0">
                                                <ul class="list-inline">
                                                    @foreach ($c->OrderDetails as $od)
                                                    <div>
                                                        <li class="list-inline-item">
                                                            <h5 class="text-dark">
                                                                {{ ucwords($od->Product->name) }}
                                                            </h5>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <h5 class="text-dark">
                                                               <i class="fa fa-check text-success"></i>
                                                            </h5>
                                                        </li>
                                                    </div>
                                                    @endforeach
                                                </ul>
                                                {{-- <div class="pb-3">
                                                    <a href="">
                                                        <h5 class="text-info">
                                                            + Show Detail
                                                        </h5>
                                                    </a>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-3 col-md-3">
            <div class="container bg-broken-white">
                <div class="container">
                    <div class="text-center pt-200">
                        <h3 class="font-weight-light f-black">Hello Wikrama Cafe</h3>
                        <h3 class="font-weight-light f-black">Lets Eat Some Food Today</h3>
                    </div>
                    <div class="text-center p-4">
                        <button type="button" class="btn btn-primary btn-block">
                            <span class="text-lg">Eat In</span>
                        </button>
                        <button type="button" class="btn btns-dark btn-block">
                            <span class="text-lg text-white">Take Away</span>
                        </button>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>

@endsection


