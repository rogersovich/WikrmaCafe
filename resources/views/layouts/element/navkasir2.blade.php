<nav style="border-bottom: 1px #dedede solid;" class="navbar nav-custom-1 navbar-horizontal navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="font-weight-bold text-white" href="{{ route('kasir.home') }}">
            <span class="f-yellow">Wikrama</span>Cafe
        </a>

        <button class="navbar-toggler fa-white text-white" type="button" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars fa-white"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-default">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="javascript:;">
                            <img src="{{ asset('assets/img/blue.png') }}">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            <ul class="navbar-nav ml-lg-auto">

                 <li class="nav-item pt-2">
                    @if ($session)
                        <a class="nav-link nav-link-icon" href="{{ route('kasir.table') }}">
                            Table
                        </a>
                    @else
                        <a class="nav-link nav-link-icon" href="javascript:;">
                            Table
                        </a>
                    @endif
                </li>
                <li class="nav-item pt-2">
                    @if ($session)
                        <a class="nav-link nav-link-icon" href="{{ route('kasir.menu') }}">
                            Menu
                        </a>
                    @else
                        <a class="nav-link nav-link-icon" href="javascript:;">
                            Menu
                        </a>
                    @endif
                </li>

                @if ($session)
            
                <li class="nav-item pt-2">
                    
                    <a class="nav-link nav-link-icon" href="{{ route('kasir.order') }}">
                        Order Status
                        
                    </a>
                </li>
                <li class="nav-item pt-2">
                    <a class="nav-link nav-link-icon" href="javascript:;">
                        Payment
                    </a>
                </li>

                @else
                
                @endif

                @if ($count == 0)
                    
                @else
                    
                
                <li class="nav-item dropdown pt-2">
                    <a class="nav-link pb-3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ni ni-cart text-lg"></i>
                        <span class="text-white text-lg font-weight-bold">
                            {{ @$count }}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right dropdown-menu-xl " style="right: 20px !important;">
                        <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <!-- Dropdown header -->
                        <div class="px-3 py-3">
                            <h1 class="text-muted">
                            <strong class="text-primary">
                                Keranjang
                            </strong>
                            </h1>
                        </div>
                        <!-- List group -->
                        <div class="list-group list-group-flush">
                            @foreach (@$cart as $c)
                            <a href="javascript:;" class="list-group-item list-group-item-action">
                            <div class="row align-items-center">

                                <div class="col ml--2 px-4">

                                    <input type="hidden" name="Order[{{ $c->product->id }}][product_id]" value="{{ $c->product->id }}">
                                    <input type="hidden" name="Order[{{ $c->product->id }}][qty]" value="{{ $c->qty }}">
                                    <input type="hidden" name="Order[{{ $c->product->id }}][desc]" value="{{ $c->description }}">

                                    <div class="d-flex justify-content-between align-items-center" id="section-cancel">
                                        <div>
                                            <h1 class="mb-0 text-lg text-dark">
                                                {{ ucwords($c->product->name) }}
                                            </h1> 
                                        </div>
                                        <div class="text-right text-muted">
                                            <small id="cancel-{{$c->id}}" data-id="{{ route('carts.destroy', $c->id) }}" class="btn-danger btn-cancel badge badge-pill badge-danger">
                                                x
                                            </small>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-sm mb-0">
                                                {{ $c->qty}} &#10005; Rp {{ number_format($c->product->sell_price) }}
                                            </p>
                                        </div>
                                        <div class="text-right text-muted">
                                            <small>
                                                Rp. {{ number_format( $c->qty * $c->product->sell_price ) }}
                                            </small>
                                        </div>
                                    </div>

                                    <div class="pt-3 d-flex justify-content-between align-items-center">
                                        <div class="text-left font-weight-regular text-sm">
                                            <i class="far fa-smile"></i>

                                            @if ($c->description == '-')
                                                Tidak ada catatan...
                                            @else
                                                {{ $c->description }}
                                            @endif
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            </a>
                            @endforeach
                        </div>
                        <div class="pl-4 pr-4 pt-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h2 class="text-primary">
                                        <strong>
                                            Subtotal
                                        </strong>
                                    </h2>
                                </div>
                                <div class="text-right">
                                    <h2 class="text-muted">
                                        <strong>
                                            Rp. {{ number_format( $total ) }}
                                        </strong>
                                        <input type="hidden" name="total" value="{{ $total }}">
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="pl-4 pr-4 pt-3">
                            <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                                <input class="custom-control-input check-class" id="check-id" name="check" type="checkbox">
                                <label class="custom-control-label text-primary font-weight-bold pt-1" for="check-id">
                                    Selesai
                                </label>
                            </div>
                
                            <div class="form-group" id="nama-pelanggan">
                                <label class="form-control-label">
                                    Nama Pelanggan
                                </label>
                                <input style="height: 35px;" required type="text" autocomplete="off" name="name" class="form-control form-control-alternative">
                            </div>
                        </div>
                        <div class="px-3 py-3">
                           
                            <button type="submit" class="btn btn-primary btn-block">
                                <span class="text-lg">Finish</span>
                            </button>
                        </div>

                    </div>
                    </form>
                </li>
                @endif
               
                <li class="nav-item">
                    <a class="nav-link nav-link-icon font-weight-bold text-sm text-white" href="javascript:;">
                        <img class="mb-1" width="40" height="40" src="{{ asset('assets/img/time3.png') }}">
                        {{-- {{ date('h:i A') }} --}}
                        <span class="text-lg" id="time"></span>
                    </a>
                </li>
                @if ($session)


                <li class="nav-item">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                <img alt="Image placeholder" src="{{asset('assets/img/man-1.png')}}">
                            </span>
                            <span class="nav-link-inner--text pl-1 d-lg-none font-weight-bold text-default">
                                Kasir
                            </span>
                            <div class="media-body ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm text-white font-weight-bold">
                                    Kasir
                                </span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right-custom" style="margin-right: 20px;">
                        <div class="dropdown-header noti-title">
                          <h6 class="text-overflow text-dark m-0">Welcome!</h6>
                        </div>
                        <a href="javascript:;" class="dropdown-item">
                          <i class="ni ni-single-02"></i>
                          <span>My profile</span>
                        </a>
                        <div class="dropdown-divider"></div>
                          <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item">
                              <i class="ni ni-user-run"></i>
                              <span>Logout</span>
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                    </div>
                </li>
                @else

                @endif
            </ul>
            

        </div>
    </div>
</nav>

<script src="{{ asset('/assets/js/jquery-3.4.1.min.js') }}"></script>
<script>
    $(document).ready(function () {

        $('.btn-cancel').on('click', function(){
            var id = $(this).attr('id');
            
            var data = $(this).data('id')
            window.location = data;
        })

        function addZero(i) {
            if (i < 10) {
                i = "0" + i;
            }

            return i;
        }

        setInterval(function startTime(){

            var time = new Date();

            var h = time.getHours();
            var m = addZero(time.getMinutes());
            var s = addZero(time.getSeconds());

            $('#time').html(h+':'+m+':'+s);
            
        }, 100);

        


    });
</script>
