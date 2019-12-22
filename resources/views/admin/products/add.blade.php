@extends('layouts.element.main')

@section('title', 'Products - Add')

@section('custom-css')
    <style>
        .breadcrumb-item + .breadcrumb-item::before{
            content: '-';
            color: #5e72e4;
        }
    </style>
@endsection

@section('content')

<!-- Navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
  <div class="container-fluid">
    <!-- Brand -->
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index.html">Dashboard</a>
    
  </div>
</nav>
<!-- End Navbar -->
<!-- Header -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<div class="container-fluid mt--7">
          <!-- Table -->
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-bottom-1">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-links" style="background:none;">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('products.index') }}">
                                    Products
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Add
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto text-right">

                </div>
            </div>
        </div>
        <div class="card-body" style="background: #f7f8f9;">
            <form action="{{ route('products.store') }}" id="formProduct" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 p-1">
                    <div class="form-group">
                        <label class="form-control-label">
                            Menu Category
                        </label>
                        <select name="menu_category_id" class="form-control form-control-alternative">
                            <option value="">Pilih Category</option>
                            @foreach ($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6 p-1">
                    <div class="form-group">
                        <label class="form-control-label">
                            Name Product
                        </label>
                        <input type="text" name="name" class="form-control form-control-alternative" placeholder="Name Product">
                    </div>
                </div>
                <div class="col-md-6 p-1">
                    <div class="form-group">
                        <label class="form-control-label">
                            Stok
                        </label>
                        <input type="text" name="stok" class="form-control form-control-alternative" placeholder="Stok">
                    </div>
                </div>
                <div class="col-md-6 p-1">
                    <div class="form-group">
                        <label class="form-control-label">
                            Harga Beli
                        </label>
                        <input type="text" id="input-hargaBeli" name="purchase_price" class="form-control form-control-alternative" placeholder="Harga Beli">
                    </div>
                </div>
                <div class="col-md-6 p-1">
                    <div class="form-group">
                        <label class="form-control-label">
                            Harga Jual
                        </label>
                        <input type="text" id="input-hargaJual" name="sell_price" class="form-control form-control-alternative" placeholder="Harga Jual">
                    </div>
                </div>
                <div class="col-md-6 p-1">
                    <div class="form-group">
                        <label class="form-control-label">
                            Gambar
                        </label>
                        <input type="file" name="picture" class="form-control form-control-alternative">
                    </div>
                </div>
                <div class="col-md-6 p-1">
                    <div class="form-group">
                        <label class="form-control-label">
                            Waktu Penyajian
                        </label>
                        <input type="text" name="time" id="time-pick" class="form-control form-control-alternative js-time-picker">
                    </div>
                </div>
                <div class="col-md-8"></div>
                <div class="col text-right">
                    <button type="submit" class="btn btn-icon btn-primary" style="border-radius: 22px;">
                        <span class="btn-inner--text">Submit</span>
                    </button>
                </div>
            </div>
            </form>
        </div>
        <div class="card-footer py-4">

        </div>
      </div>
    </div>
  </div>
</div>

@endsection

<script src="{{ asset('/assets/js/jquery-3.4.1.min.js') }}"></script>

<script>
    $(document).ready(function () {

        var input = document.getElementById('time-pick');
        var picker = new Picker(input, {
            format: 'HH:mm:ss',
            rows: 3,
            headers: true,
            text: {
                title: 'Pilih Waktu Penyajian',
                cancel: 'Batal',
                confirm: 'Selesai',
                minute: 'Menit',
                hour: 'Jam',
                second: 'Detik'
            },
        });

        // $("#input-hargaBeli").on('keyup', function(){
        //     var n = parseInt($(this).val().replace(/\D/g,''),10);
        //     $(this).val(n.toLocaleString());
        // });

        // $("#input-hargaJual").on('keyup', function(){
        //     var n = parseInt($(this).val().replace(/\D/g,''),10);
        //     $(this).val(n.toLocaleString());
        // });

    });
</script>
{!! JsValidator::formRequest('App\Http\Requests\FormProductRequest', '#formProduct') !!}


