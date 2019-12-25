@extends('layouts.element.kasir_main')

@section('title', 'Cashier - Menu')

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

    <div class="row" style="position: relative;">
        <div class="col-sm-12 col-md-12">
            <div class="container bg-broken-white pt-50">
                <div class="container">
                    <div class="row">
                        
                        {{-- <div class="col-md-11">
                            <form action="{{ route('kasir.menuSearch') }}" method="GET">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="border-radius: 22px 0 0 22px; border: none;">
                                        <i class="ni ni-zoom-split-in"></i>
                                    </span>
                                </div>
                                <input name="search" style="border-radius: 0 22px 22px 0; border: none;" class="form-control" placeholder="Search" type="text">
                                <input type="hidden" name="menu_id" id="menu_id">
                            </div>
                            </form>
                        </div>
                        <div class="col-md-1"></div> --}}

                    </div>
                    <div class="row">
                        {{-- <div class="col-md-1"></div> --}}
                        <div class="col-md-3 col-sm-3 p-2">
                            <div class="pt-4">
                                @foreach ($menus as $m)
                                @if ($m->id == 1)

                                    <a href="javascript:;" id="{{ $m->id }}" style="border-radius: 22px;" class="btn menu-active menu-btn btn-primary btn-block text-left">
                                        <span class="text-sm">
                                            {{ $m->name }}
                                        </span>
                                        <input type="hidden" class="getMenu_id" value="{{ $m->id }}">
                                    </a>
                                @else
                                    <a href="javascript:;" id="{{ $m->id }}" style="border-radius: 22px;" class="btn menu-isactive menu-btn btn-broken-white btn-block text-left">
                                        <span class="text-sm">
                                            {{ $m->name }}
                                        </span>
                                        <input type="hidden" class="getMenu_id" value="{{ $m->id }}">
                                    </a>
                                @endif
                                @endforeach
                            </div>
                        </div>

                        
                        @if (@$products == null)
                        
                        <div class="col-md-8">
                            <div class="container pl-4">
                                <div class="row menu-all">

                                </div>
                                
                            </div>
                        </div>
                            
                        @else
                        
                        <div class="col-md-8">
                            <div class="container pl-4">
                                <div class="row">
                                    @foreach (@$products as $r)
                                        <div class="col-md-4 p-1">
                                            <div class="card shadow" style="height: 320px !important;">
                                                <img style="height: 130px;" src="{{asset('upload/products/'.$r->picture)}}" class="card-img-top">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="pl-2 col-md-8 col-sm-8">
                                                            <span class="card-text font-weight-bold text-left">
                                                                {{ $r->name }}
                                                            </span> 
                                                        </div>
                                                        <div class="pl-2 pr-2 col-md-4 col-sm-4 text-right">
                                                            
                                                            <span class="text-sm font-weight-light">
                                                                {{ $r->stok }}
                                                            </span>
                                                        </div>
                                                    </div>
            
                                                    <div class="row pt-1">
                                                        <div class="pl-2 col-md-12 col-sm-12">
                                                            <span class="text-sm font-weight-light">
                                                                {{ $r->MenuCategory->name }}
                                                            </span>
                                                        </div>                                        
                                                    </div>
            
                                                    <div class="row">
                                                        <div class="pl-2 col-md-12 col-sm-12">
                                                            <h3 class="card-text pb-3 mt-3 text-left text-dark font-weight-light">
                                                                Rp {{ number_format($r->sell_price) }}
                                                            </h3>
                                                        </div>                                        
                                                    </div>
                                                    <button data-toggle="modal" data-target="#menuModal{{$r->id}}" type="button" class="btn mt-2 btn-pesan btn-sm btn-primary btn-block">
                                                        <span class="text-sm">Pesan</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        
                                    @endforeach
                                </div> 
                            </div>
                        </div>
                            
                        @endif

                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script src="{{ asset('/assets/js/jquery-3.4.1.min.js') }}"></script>
<script>

    $( document ).ready(function() {

        $('#nama-pelanggan').hide();

        // $('.btn-pesan').on('click', function(){
        //     var id = $(this).data(id);
        //     console.log(id.id);
            
        //     $('#menuModal5').modal('show');
        // })

        var menu_id = $('.menu-active .getMenu_id').val();
        $('#menu_id').val(menu_id);

        $('.check-class').on('change', function(){
            var check = $(this).prop('checked');
            var val = $(this).val()

            if (check == true) {
                $('#nama-pelanggan').show();
            } else {
                $('#nama-pelanggan').hide();
            }
        })

        $(".menu-btn").on("click",function(e){
            var thisId = $(this).attr('id');

            $('.menu-btn').removeClass('btn-primary');
            $('.menu-btn').removeClass('menu-active');
            $(this).removeClass('btn-broken-white');

            $(this).addClass('menu-active');
            $(this).addClass('btn-primary')
            $('.menu-btn').not('.menu-active').addClass('menu-isactive');
            $(this).removeClass('menu-isactive');

            var menu_id = $('.menu-active .getMenu_id').val();
            $('#menu_id').val(menu_id);

            $.ajax({
                url : "{{ url('getProducts') }}/" +thisId,
                dataType : 'json',
                type : 'get',
                beforeSend : function(e){
                    $(".menu-all").first().html('Sedang memuat ...');
                },
                success : function(response){
                    // console.log(response)
                    $(".menu-all").html($(""))
                    $.each(response.results,function(e,i){
                        $(".menu-all").append($(`

                            <div class="col-md-4 p-1">
                                <div class="card shadow" style="height: 320px !important;">
                                    <img style="height: 130px;" src="{{asset('upload/products/`+i.picture+`')}}" class="card-img-top">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="pl-2 col-md-8 col-sm-8">
                                                <span class="card-text font-weight-bold text-left">
                                                    `+i.name+`
                                                </span> 
                                            </div>
                                            <div class="pl-2 pr-2 col-md-4 col-sm-4 text-right">
                                                
                                                <span class="text-sm font-weight-light">
                                                    `+i.stok+`
                                                </span>
                                            </div>
                                        </div>

                                        <div class="row pt-1">
                                            <div class="pl-2 col-md-12 col-sm-12">
                                                <span class="text-sm font-weight-light">
                                                    `+i.menu_category.name+`
                                                </span>
                                            </div>                                        
                                        </div>

                                        <div class="row">
                                            <div class="pl-2 col-md-12 col-sm-12">
                                                <h3 class="card-text pb-3 mt-3 text-left text-dark font-weight-light">
                                                    Rp `+i.sell_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+`
                                                </h3>
                                            </div>                                        
                                        </div>
                                        <button data-toggle="modal" data-target="#menuModal`+i.id+`" type="button" class="btn mt-2 btn-pesan btn-sm btn-primary btn-block">
                                            <span class="text-sm">Pesan</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="menuModal`+i.id+`" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title text-dark text-center" id="modal-title-default">
                                                `+i.name+`
                                            </h2>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-right">
                                            <form action="{{ route('kasir.pesenMenu') }}" method="POST">
                                                @csrf
                                                <label class="form-control-label">
                                                    Jumlah
                                                </label>
                                                <input type="number" autofocus id="jumlah-`+i.id+`" required name="jumlah" autocomplete="off" class="form-control form-control-alternative" placeholder="Masukan Jumlah">
                                                <input type="text" name="description" autocomplete="off" class="mt-2 form-control form-control-alternative" placeholder="Tambahkan Pesan">
                                                <input type="hidden" name="product_id" value="`+ i.id +`">
                                                <input type="hidden" name="harga" value="`+ i.sell_price +`">
                                                <button type="button" class="btn btn-danger text-left mt-3" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <button type="submit" class="btn btn-info mt-3">
                                                    Finish
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        `))
                    })
                }
            })

        });

        var menu_id = $('.menu-active').attr('id');

        $.ajax({
            url : "{{ url('getProducts') }}/" +menu_id,
            dataType : 'json',
            type : 'get',
            beforeSend : function(e){
                $(".menu-all").first().html('Sedang memuat...');
            },
            success : function(response){
                // console.log(response)
                $(".menu-all").html($(""))
                $.each(response.results,function(e,i){
                    $(".menu-all").append($(`

                        <div class="col-md-4 p-1">
                            <div class="card shadow" style="height: 350px !important;">
                                <img style="height: 130px;" src="{{asset('upload/products/`+i.picture+`')}}" class="card-img-top">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="pl-2 col-md-8 col-sm-8">
                                            <span class="card-text font-weight-bold text-left">
                                                `+i.name+`
                                            </span> 
                                        </div>
                                        <div class="pl-2 pr-2 col-md-4 col-sm-4 text-right">
                                            
                                            <span class="text-sm font-weight-light">
                                                `+i.stok+`
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row pt-1">
                                        <div class="pl-2 col-md-12 col-sm-12">
                                            <span class="text-sm font-weight-light">
                                                `+i.menu_category.name+`
                                            </span>
                                        </div>                                        
                                    </div>

                                    <div class="row">
                                        <div class="pl-2 col-md-12 col-sm-12">
                                            <h3 class="card-text pb-3 mt-3 text-left text-dark font-weight-light">
                                                Rp `+i.sell_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+`
                                            </h3>
                                        </div>                                        
                                    </div>
                                    
                                    
                                    <button data-toggle="modal" data-target="#menuModal`+i.id+`" type="button" class="btn mt-2 btn-pesan btn-sm btn-primary btn-block">
                                        <span class="text-sm">Pesan</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="menuModal`+i.id+`" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title text-dark text-center" id="modal-title-default">
                                            `+i.name+`
                                        </h2>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-right">
                                        <form action="{{ route('kasir.pesenMenu') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 text-left">
                                                    <div class="form-group">
                                                        <label for="jumlah-`+ i.id +`" class="form-control-label">
                                                            Jumlah
                                                        </label>
                                                        <input type="number" autofocus id="jumlah-`+i.id+`" required name="jumlah" autocomplete="off" class="form-control form-control-alternative" placeholder="Masukan Jumlah">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 text-left">
                                                    <div class="form-group">
                                                        <label for="pesen-`+ i.id +`" class="form-control-label">
                                                            Pesan
                                                        </label>
                                                        <input type="text" id="pesen-`+ i.id +`" name="description" autocomplete="off" class="mt-2 form-control form-control-alternative" placeholder="Tambahkan Pesan">
                                                    </div>
                                                </div>
                                            

                            
                                            <input type="hidden" name="product_id" value="`+ i.id +`">
                                            <input type="hidden" name="harga" value="`+ i.sell_price +`">
                                            <button type="button" class="btn btn-danger mt-3" data-dismiss="modal">
                                                Cancel
                                            </button>
                                            <button type="submit" class="btn btn-info mt-3">
                                                Finish
                                            </button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    `))
                })
            }
        })

    });

</script>

