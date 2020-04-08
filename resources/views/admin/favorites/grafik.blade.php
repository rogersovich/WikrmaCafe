@extends('layouts.element.main')

@section('title', 'Laporan')

@section('custom-css')
    <style>
        .breadcrumb-item + .breadcrumb-item::before{
            content: '-';
            color: #5e72e4;
        }

        #chartDessert{
            cursor: pointer;
        }

        #chartMakanan{
            cursor: pointer;
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
</div>
<div class="container-fluid mt--7">

    @if (session('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-inner--text">
                    {{session('danger')}}
            </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
          <!-- Table -->
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-1">
            <div class="row">
                <div class="col-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-links" style="background:none;">
                            <li class="breadcrumb-item">
                                <a href="javascript:;">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Grafik
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-4 text-right">
                   
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('reports.store') }}" method="POST">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="nav-wrapper">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fa fa-star mr-2"></i>Favorit</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fa fa-money-bill-wave mr-2"></i>Keuangan</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                 <canvas id="chartDessert" width="600" height="250"></canvas>
                                            </div>
                                            <div class="col-md-6">
                                                 <canvas id="chartMakanan" width="600" height="250">
                                                 </canvas>
                                             </div>
                                         </div>
                                    </div>
                                    <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Uang Masuk</label>
                                                    <h1 class="text-dark">
                                                        Rp. {{ number_format($total_jual) }}
                                                    </h1>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Uang Keluar</label>
                                                    <h1 class="text-dark">
                                                        Rp. {{ number_format($total_beli) }}
                                                    </h1>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Untung</label>
                                                    <h1 class="text-dark">
                                                        Rp. {{ number_format($untung) }}
                                                    </h1>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Rugi</label>
                                                    <h1 class="text-dark">
                                                        Rp. {{ number_format($rugi) }}
                                                    </h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

    $(document).ready( function () {

        Chart.defaults.global.defaultFontColor = 'black';
        Chart.defaults.global.defaultFontSize = 16;

        var dessert = <?php echo json_encode($dessert, JSON_HEX_TAG); ?>;
        var labelDessert = <?php echo json_encode($labelDessert, JSON_HEX_TAG); ?>;
        var makanan = <?php echo json_encode($makanan, JSON_HEX_TAG); ?>;
        var labelMakanan = <?php echo json_encode($labelMakanan, JSON_HEX_TAG); ?>;
        

        var ctx = document.getElementById("chartDessert").getContext('2d');
        var chartDessert = new Chart(ctx, {
			type: 'pie',
			data: {
				labels: labelDessert,
                datasets: [{
                    label: "Population (millions)",
                    data: dessert,
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    fill: true
                }]
			},
			options: {
				title: {
                    display: true,
                    text: 'Makanan Favorit Kategori Dessert',
                    position: 'top',
                },
                rotation: -0.7 * Math.PI,
			}
		});

        var ctx = document.getElementById("chartMakanan").getContext('2d');
        var chartMakanan = new Chart(ctx, {
			type: 'pie',
			data: {
				labels: labelMakanan,
                datasets: [{
                    label: "Population (millions)",
                    data: makanan,
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    fill: true
                }]
			},
			options: {
				title: {
                    display: true,
                    text: 'Makanan Favorit Kategori Makanan',
                    position: 'top',
                },
                rotation: -0.7 * Math.PI,
			}
		});

    } );

</script>
