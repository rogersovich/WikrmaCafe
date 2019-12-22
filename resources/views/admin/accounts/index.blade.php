@extends('layouts.element.main')

@section('title', 'Accounts')

@section('custom-css')
    <style>
        .breadcrumb-item + .breadcrumb-item::before{
            content: '-';
            color: #5e72e4;
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
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-inner--text">
                    {{session('success')}}
            </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-1">
            <div class="row">
                <div class="col-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-links" style="background:none;">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Accounts
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-4 text-right">

                </div>
            </div>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush" id="table-account">
            <thead class="thead-light">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Role</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($accounts as $d)
                <tr>
                    <td>
                        {{ $no++ }}
                    </td>
                    <td>
                        {{ $d->name }}
                    </td>
                    <td>
                        {{ $d->Roles[0]->name }}
                    </td>
                    <td>
                        @if ($d->status == 0)
                            <span class="badge badge-pill badge-warning">
                                Pending
                            </span>
                        @else
                            <span class="badge badge-pill badge-success">
                                Aktif
                            </span>
                        @endif
                    </td>
                    <td>
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light pt-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div style="min-width: 6rem;" class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">
                            <div class="dropdown-item">
                                <a href="{{ route('accounts.edit', $d->id) }}" class="badge badge-pill badge-success">
                                    Edit
                                </a>
                            </div>
                            <div class="dropdown-item">
                                <a href="#" data-id="{{ route('accounts.destroy', $d->id) }}" class="btn-danger badge badge-pill badge-danger">
                                    Delete
                                </a>
                            </div>
                            @if ($d->status == 0)
                            <div class="dropdown-item">
                                <a href="{{ route('accounts.accept', $d->id) }}" class="badge badge-pill badge-primary">
                                    Terima Akun
                                </a>
                            </div>
                            @else
                            @endif
                        </div>
                      </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer py-4">
          {{ $accounts->render() }}
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

<script src="{{ asset('/assets/js/jquery-3.4.1.min.js') }}"></script>
<script>
    $(document).ready(function () {

        $('#table-account').DataTable({
            paging: false,
        });

        $('.btn-danger').on('click', function() {

            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1aae6f',
            cancelButtonColor: '#f80031',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.value) {
                    var data = $(this).data('id')
                    console.log(data)
                    window.location = data;
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
