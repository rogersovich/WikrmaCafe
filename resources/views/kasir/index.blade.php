@extends('layouts.element.kasir_main')

@section('title', 'Cashier - Home')

@php
    $session = Session::get('user');
    $name = '';
@endphp

@section('content')

<div class="bg-broken-white">
    @include('layouts.element.navkasir2')
    <div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-3">
            <div class="container bg-broken-white pt-50">
                <img class="bg-img" src="{{ asset("assets/img/work1.png") }}" alt="">
            </div>
        </div>
        @if ($user)

        @else

        <div class="col-md-3 col-sm-3">
            <div class="container bg-broken-white">
                <div class="container">
                    <div class="text-center pt-200">
                        <h2 class="font-weight-light f-black">Hello Wikrama Cafe</h2>
                        <h3 class="font-weight-light f-black">Mari makan sesuatu hari ini!</h3>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 pb-1">
                            <a href="javascript:;" data-id="{{ route('kasir.table', $name) }}" class="btn btn-primary btn-block">
                                <span class="text-lg">
                                    Makan Disini
                                </span>
                            </a>
                        </div>
                        <div class="col-md-12">
                            <a href="javascript:;" data-id="{{ route('kasir.takeaway', $name) }}" class="btn btns-dark btn-block">
                                <span class="text-lg text-white">
                                    Bungkussss
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    </div>
</div>

@endsection

<script src="{{ asset('/assets/js/jquery-3.4.1.min.js') }}"></script>
<script>
    $(document).ready(function () {


        $('.btn-primary').on('click', function() {

            Swal.fire({
            title: 'Pilih Yang Mana ?',
            input: 'text',
            inputPlaceholder: 'Masukan Nama',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1aae6f',
            cancelButtonColor: '#f80031',
            confirmButtonText: 'Booking',
            cancelButtonText: 'Engga'   
            }).then((result) => {
                if (result.value) {
                    var data = $(this).data('id')+'/'+result.value
                    window.location = data;

                }else if(result.value == ""){
                    Swal.fire(
                    'Tidak Berhasil!',
                    'Masukan nama terlebih dahulu',
                    'error'
                    )
                }else{
                    
                    Swal.fire(
                    'Tidak Berhasil!',
                    'Your file has been cancel.',
                    'error'
                    )
                }
            })
        });

        $('.btns-dark').on('click', function() {

            Swal.fire({
            title: 'Pilih Yang Mana ?',
            input: 'text',
            inputPlaceholder: 'Masukan Nama',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1aae6f',
            cancelButtonColor: '#f80031',
            confirmButtonText: 'Bungkus',
            cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    var data = $(this).data('id')+'/'+result.value
                    window.location = data;
                }else if(result.value == ""){
                    Swal.fire(
                    'Tidak Berhasil!',
                    'Masukan nama terlebih dahulu',
                    'error'
                    )
                }else{
                    Swal.fire(
                    'Cancelled!',
                    'Your file has been cancel.',
                    'error'
                    )
                }
            })
        });

    });
</script>


