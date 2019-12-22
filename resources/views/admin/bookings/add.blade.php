@extends('layouts.element.main')

@section('title', 'Booking - Add')

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
    <!-- Form -->
    
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
                                <a href="{{ route('bookings.index') }}">
                                    Booking
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
            <form action="{{ route('bookings.store') }}" id="formTable" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 p-1">
                    <div class="form-group">
                        <label class="form-control-label">
                            Floor
                        </label>
                        <select name="floor_id" class="form-control form-control-alternative">
                            <option value="">Pilih Floor</option>
                            @foreach ($floors as $f)
                            <option value="{{ $f->id }}">{{ 'Floor - '.$f->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6 p-1">
                    <div class="form-group">
                        <label class="form-control-label">
                            Table
                        </label>
                        <input type="text" name="table" class="form-control form-control-alternative" placeholder="Nomer Table">
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
{!! JsValidator::formRequest('App\Http\Requests\FormTableRequest', '#formTable') !!}
