@extends('layouts.element.kasir_main')

@section('title', 'Cashier - Pembayaran')

@php
    $session = Session::get('user');
@endphp

@section('content')

@include('layouts.element.navkasir2')
<div class="container">

    @if (session('danger'))
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
            <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-inner--text">
                    {{session('danger')}}
            </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif    


    <div class="row">
        <div class="col-sm-8 col-md-8">
            <div class="container bg-broken-white pt-50 pb-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="border-radius: 22px 0 0 22px; border: none;"><i class="ni ni-zoom-split-in"></i></span>
                                </div>
                                <input style="border-radius: 0 22px 22px 0; border: none;" class="form-control" placeholder="Search" type="text">
                            </div>
                            <div class="text-right">
                                <h4 class="text-primary">View Payment History</h4>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="container">
                                <div class="row">
                                    @foreach ($orders as $o)
                                    @if ($o->id == $id)
                                        <div class="col-md-3 p-2">
                                            <a href="{{ route('kasir.process', $o->id) }}">
                                            <div class="card shadow bg-primary">
                                                <div class="card-body">
                                                    <h5 class="f-broken-white">
                                                        {{ $o->code }}
                                                    </h5>
                                                    <h5 class="f-broken-white">
                                                        <span class="text-white">
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
                                            </div>
                                            </a>
                                        </div>
                                    @else
                                        <div class="col-md-3 p-2">
                                            <a href="{{ route('kasir.process', $o->id) }}">
                                            <div class="card shadow">
                                                <div class="card-body">
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
                                            </div>
                                            </a>
                                        </div>

                                    @endif

                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-4 bg-black">
            {{-- @include('layouts.element.nav_kasir') --}}
            <div class="container bg-broken-white p-5">
                <div class="row" style="border-bottom: 1px #3d3d3d solid;">
                    <div class="col-md-4">
                        <p class="text-sm font-weight-bold">
                            <span>Number</span>
                        </p>
                        <p class="text-sm">
                            <span>{{ $order->code }}</span>
                            <br>
                            <span>Get In</span>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-sm font-weight-bold">
                            <span>Name</span>
                        </p>
                        <p class="text-sm">
                            <span>{{ $order->name }}</span>
                            <br>
                            <span>Customer</span>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-sm font-weight-bold">
                            <span>Table</span>
                        </p>
                        <p class="text-sm">
                            <span>

                                @if ($order->booking == null)
                                    Take Away
                                @else
                                    {{ $order->booking->table }}
                                @endif
                            </span>
                            <br>
                            <span>Set Up</span>
                        </p>
                    </div>
                </div>
                
                <form action="{{ route('kasir.order.process') }}" method="POST">
                @csrf

                @foreach ($orderDetails as $od)
                <div class="row mt-3 pb-3" style="border-bottom: 1px #3d3d3d solid;">
                    <div class="col-md-6">
                        <p class="text-sm">
                            <span class="font-weight-bold">{{ $od->product->name }}</span>
                            <br>
                            Rp. {{ number_format($od->product->sell_price) }}
                        </p>
                    </div>
                    <div class="col-md-2">
                        <span class="text-sm font-weight-bold">
                            {{ $od->qty }}
                        </span>
                    </div>
                    <div class="col-md-4">
                        <span class="text-sm font-weight-bold">
                            Rp. {{ number_format($od->qty * $od->product->sell_price) }}
                        </span>
                    </div>
                    <div class="text-left font-weight-regular text-sm">
                        <i class="far fa-smile"></i>
                        @if ($od->description == null)
                            Tidak ada catatan...
                        @else
                            {{ $od->description }}
                        @endif

                    </div>
                </div>
                @endforeach

                <div class="row mt-3">
                    <div class="col-md-6">
                       <h4 class="text-dark">
                            <span class="font-weight-bold">Total</span>
                        </h4>
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-dark text-right">
                            <span class="font-weight-bold">
                                Rp. {{ number_format($order->total_price) }}
                            </span>
                            <input type="hidden" name="total" value="{{ $order->total_price }}">
                        </h3>
                    </div>
                    <div class="col-md-7">
                        <h4 class="text-dark">
                             <span class="font-weight-bold">
                                 Uang
                             </span>
                         </h4>
                     </div>
                     <div class="col-md-5">

                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <input style="height: 30px;" type="text" required autofocus autocomplete="off" name="duit" class="text-right form-control">
                     </div>
                </div>

                <div class="text-center pt-50">
                    <button type="submit" class="btn btn-secondary btn-block">
                        <span class="text-sm">Bayar</span>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


