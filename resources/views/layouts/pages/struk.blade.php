@extends('layouts.element.custom_main')

@section('title', 'Struk')

@section('custom-css')
    <style>
        .breadcrumb-item + .breadcrumb-item::before{
            content: '-';
            color: #5e72e4;
        }

        .pr-50{
            padding-right: 50px;
        }

        .pr-150{
            padding-right: 150px;
        }

        .pr-100{
            padding-right: 100px;
        }

        .pl-50{
            padding-left: 50px;
        }

        .pl-150{
            padding-left: 150px;
        }

        .pl-100{
            padding-left: 100px;
        }
    </style>
@endsection

@section('content')

@php
    $session = Session::get('user');
@endphp


<!-- Header -->
    <div class="header bg-gradient-warning py-7 py-lg-8">

    </div>

<!-- Page content -->
<div class="container mt--8 pb-5">
        <div class="row justify-content-center">
          <div class="col-10 col-md-10">
            <div class="card bg-gradient-white shadow border-0">
              <div class="card-body px-lg-5 py-lg-5">
                  <div class="jumbotron jumbotron-fluid px-3 py-3 bg-gradient-white">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('kasir.struk.print', $report->id) }}" class="btn btn-warning btn-sm" target="_blank">
                                    CETAK PDF
                                </a>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('kasir.home') }}" class="btn btn-warning btn-sm">
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <p class="mt-3">
                            Wikrama Cafe
                            <br>
                            Jl. Raya Wangun No.21, RT.01/RW.06, Sindangsari, Kec. Bogor Tim, Kota Bogor, Jawa Barat 16146
                            <br>
                            Telp (0251)8242411
                            <br>
                            No Pemesanan: {{ $report->code }}
                            <br>
                            Nama: {{ $report->name }}
                            <br>
                            Kasir : {{ $user->name }}
                        </p>
                        <p>
                            --------------------------------------------------------------------------------------------------------------------------------------------------
                        </p>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">Nama Barang</div>
                                <div class="col-md-2">Jumlah</div>
                                <div class="col-md-2">Harga</div>
                                <div class="col-md-2">Subtotal</div>
                            </div>
                        </div>
                        <p>
                            --------------------------------------------------------------------------------------------------------------------------------------------------
                        </p>
                        <div class="container">
                            <div class="row">
                                @foreach ($data as $od)
                                <div class="col-md-6">{{ ucwords($od->product->name.' - '.$od->product->menuCategory->name) }}</div>
                                <div class="col-md-2">{{ $od->qty }}</div>
                                <div class="col-md-2">{{ number_format($od->product->sell_price) }}</div>
                                <div class="col-md-2">{{ number_format($od->product->sell_price * $od->qty) }}</div>
                                @endforeach
                            </div>
                        </div>
                        <p>
                            --------------------------------------------------------------------------------------------------------------------------------------------------
                        </p>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">Total</div>
                                <div class="col-md-2"></div>
                                <div class="col-md-2"></div>
                                <div class="col-md-2">

                                    Rp {{ number_format($report->total_price) }}

                                </div>

                                <div class="col-md-6">Tunai</div>
                                <div class="col-md-2"></div>
                                <div class="col-md-2"></div>
                                <div class="col-md-2">
                                    Rp {{ number_format($report->total_price + $report->change_money ) }}
                                </div>

                                <div class="col-md-6">Kembalian</div>
                                <div class="col-md-2"></div>
                                <div class="col-md-2"></div>
                                <div class="col-md-2">
                                    Rp {{ number_format($report->change_money) }}
                                </div>
                            </div>
                        </div>
                        <p>
                            --------------------------------------------------------------------------------------------------------------------------------------------------
                        </p>
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <p class="text-center font-weight-bold">
                                        Terima Kasih Ya Gaiss
                                        <br>
                                        Pembeli Adalah Raja
                                    </p>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
            </div>

          </div>
        </div>
      </div>

@endsection

@section('scripts')

<script>

    $(document).ready( function () {

    } );

</script>

@endsection
