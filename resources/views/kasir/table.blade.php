@extends('layouts.element.kasir_main')

@section('title', 'Cashier - Booking')

@php
    $session = Session::get('user');
@endphp

@section('content')

@include('layouts.element.navkasir2')
<div class="container">
    <div class="row" style="position: relative;">
        <div class="col-12 col-md-12">
            
            <div class="container bg-broken-white pt-50">
                <div class="container">
                    <div class="row">
                        {{-- <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <form action="{{ route('kasir.tableSearch') }}" method="GET">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="border-radius: 22px 0 0 22px; border: none;"><i class="ni ni-zoom-split-in"></i></span>
                                </div>
                                    <input name="search" style="border-radius: 0 22px 22px 0; border: none;" class="form-control" placeholder="Search" type="text">
                                    <input type="hidden" name="floor_id" id="floor_id">
                                </div> 
                            </div>
                        </form>
                        <div class="col-md-1"></div> --}}
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <div class="pt-2">

                                @foreach ($floors as $f)
                                @if ($f->name == 1)
                                    <a href="javascript:;" id="{{ $f->id }}" style="border-radius: 22px;" class="btn floor-active floor-btn btn-primary btn-block text-left">
                                        <span class="text-sm">
                                            Lantai {{ $f->name }}
                                        </span>    
                                        <input type="hidden" class="getfloor_id" value="{{ $f->id }}">
                                    </a>
                                @else
                                    <a href="javascript:;" id="{{ $f->id }}" style="border-radius: 22px;" class="btn floor-isactive floor-btn btn-broken-white btn-block text-left">
                                        <span class="text-sm">
                                            Lantai {{ $f->name }}
                                        </span>
                                        <input type="hidden" class="getfloor_id" value="{{ $f->id }}">
                                    </a>
                                @endif
                                


                                @endforeach

                            </div>
                        </div>
                        
                        @if (@$tables == null)
                        
                        <div class="col-md-7">
                            <div class="container pl-4">
                                <div class="row table-all">
                                    
                                </div>
                            </div>
                        </div>

                        @else
                        
                        <div class="col-md-7">
                            <div class="container pl-4">
                                <div class="row">
                                    @foreach ($tables as $t)
                                    @if ($t->status == 0)    
                                        <div class="col p-2">
                                            <div class="card">
                                                <a href="javascript:;" data-toggle="modal" data-target="#exampleModal`+i.id+`">
                                                    <div class="card-body bg-table-isactive">
                                                        <h4 class="card-title text-dark text-center mb-2">
                                                            {{ $t->table }}
                                                        </h4>
        
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        @else
                                        <div class="col p-2">
                                            <div class="card">
                                                <a href="javascript:;" data-toggle="modal" data-target="#exampleModal`+i.id+`">
                                                    <div class="card-body bg-gradient-primary">
                                                        <h4 class="card-title text-white text-center mb-2">
                                                            {{ $t->table }}
                                                        </h4>
        
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        @endif
                                    
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
        {{-- <div class="col-3 col-md-3 bg-black">
            <div class="container bg-silver" style="height: 100vh;">
                <div class="container">

                </div>
            </div>
        </div> --}}
    </div>
</div>

@endsection

<script src="{{ asset('/assets/js/jquery-3.4.1.min.js') }}"></script>
<script>

    $( document ).ready(function() {

        
        var floor_id = $('.floor-active .getfloor_id').val();
        $('#floor_id').val(floor_id);

        $(".floor-btn").on("click",function(e){
            var thisId = $(this).attr('id');

            $('.floor-btn').removeClass('btn-primary');
            $('.floor-btn').removeClass('floor-active');
            $(this).removeClass('btn-broken-white');

            $(this).addClass('floor-active');
            $(this).addClass('btn-primary')
            $('.floor-btn').not('.floot-active').addClass('floor-isactive');
            $(this).removeClass('floor-isactive');

            var floor_id = $('.floor-active .getfloor_id').val();
            $('#floor_id').val(floor_id);

            $.ajax({
                url : "{{ url('getTables') }}/" +thisId,
                dataType : 'json',
                type : 'get',
                beforeSend : function(e){
                    $(".table-all").first().html('Sedang memuat...');
                },
                success : function(response){
                    console.log(response)
                    $(".table-all").html($(""))
                    $.each(response.results,function(e,i){
                        $(".table-all").append($(`
                            `
                            +
                                (
                                    i.status == 0
                                ?
                                `
                                <div class="col p-2">
                                    <div class="card">
                                        <a href="javascript:;" data-toggle="modal" data-target="#exampleModal`+i.id+`">
                                            <div class="card-body bg-table-isactive">
                                                <h4 class="card-title text-dark text-center mb-2">
                                                    `+i.table+`
                                                </h4>

                                            </div>
                                        </a>
                                    </div>
                                </div>
                                `
                                :
                                `
                                <div class="col p-2">
                                    <div class="card">
                                        <a href="javascript:;" data-toggle="modal" data-target="#exampleModal`+i.id+`">
                                            <div class="card-body bg-gradient-primary">
                                                <h4 class="card-title text-white text-center mb-2">
                                                    `+i.table+`
                                                </h4>

                                            </div>
                                        </a>
                                    </div>
                                </div>
                                `
                                )
                            +
                            `


                            <div class="modal fade" id="exampleModal`+i.id+`" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content" style="width: 80%;">
                                        <div class="modal-header">
                                            <h2 class="modal-title text-dark text-center" id="modal-title-default">
                                                Meja-`+i.table+` Lantai `+i.floor.name+`
                                            </h2>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">

                                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                Cancel
                                            </button>
                                            `
                                            +
                                                (
                                                    i.status == 0
                                                    ?
                                                    `
                                                        <a href="../bookTable/`+i.id+` " class="btn btn-primary">
                                                            Booking Meja
                                                        </a>
                                                    `
                                                    :
                                                    `
                                                        <a href="javascript:;" class="btn btn-primary">
                                                            Sudah Di Booking
                                                        </a>
                                                    `
                                                )
                                            +
                                            `
                                        </div>
                                    </div>
                                </div>
                            </div>

                        `))
                    })
                }
            })

            var cek = $(this).attr('class');

        });

        var floor_id = $('.floor-active').attr('id');


        $.ajax({
            url : "{{ url('getTables') }}/" +floor_id,
            dataType : 'json',
            type : 'get',
            beforeSend : function(e){
                $(".table-all").first().html('Sedang memuat...');
            },
            success : function(response){
                console.log(response)
                $(".table-all").html($(""))
                $.each(response.results,function(e,i){
                    $(".table-all").append($(`

                        `
                        +
                            (
                                i.status == 0
                            ?
                            `
                            <div class="col p-2">
                                <div class="card">
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal`+i.id+`">
                                        <div class="card-body bg-table-isactive">
                                            <h4 class="card-title text-dark text-center mb-2">
                                                `+i.table+`
                                            </h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            `
                            :
                            `
                            <div class="col p-2">
                                <div class="card">
                                    <a href="javascript:;" data-toggle="modal" data-target="#exampleModal`+i.id+`">
                                        <div class="card-body bg-gradient-primary">
                                            <h4 class="card-title text-white text-center mb-2">
                                                `+i.table+`
                                            </h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            `
                            )
                        +
                        `

                        <div class="modal fade" id="exampleModal`+i.id+`" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content" style="width: 80%;">
                                    <div class="modal-header">
                                        <h2 class="modal-title text-dark text-center" id="modal-title-default">
                                            Meja-`+i.table+` Lantai `+i.floor.name+`
                                        </h2>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">

                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                            Cancel
                                        </button>
                                        `
                                        +
                                            (
                                                i.status == 0
                                                ?
                                                `
                                                    <a href="../bookTable/`+i.id+` " class="btn btn-primary">
                                                        Booking Meja
                                                    </a>
                                                `
                                                :
                                                `
                                                    <a href="javascript:;" class="btn btn-primary">
                                                        Sudah Di Booking
                                                    </a>
                                                `
                                            )
                                        +
                                        `
                                    </div>
                                </div>
                            </div>
                        </div>

                    `))
                })
            }
        })

        //BATAS

        console.log(floor_id);

    });

</script>


