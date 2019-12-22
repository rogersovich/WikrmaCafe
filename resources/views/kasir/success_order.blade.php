@extends('layouts.element.custom_main')

@section('title', 'Struk')

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 20%;">
            <div class="col-md-2 col-sm-2">
            </div>
            <div class="col-md-8 col-sm-2">
                <div class="card bg-gradient-success">
                    <div class="card-body text-center">
                        <h1 class="card-title">Terima Kasih Anda Telah Memesan</h1>
                        <a href="{{ route('welcome') }}" class="btn btn-sm btn-secondary text-dark">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-2">
            </div>
        </div>
    </div>
@endsection