
<title>Laporan</title>

<style>

    body{
        font-family: sans-serif;
        color: #3b3b3b;
        font-size: 12px;
    }

    .container {
        width: 100%;
        margin-right: auto;
        margin-left: auto;
    }

    .table {
        font-family: sans-serif;
        color: #232323;
        border-collapse: collapse;
    }

    th, td {
        font-weight: 300;
        font-size: 13px;
    }

    .text-center{
        text-align: center;
    }

    .wt-50{
        width: 50px;
    }

    .wt-70{
        width: 70px;
    }

    .wt-100{
        width: 100px;
    }

    .wt-150{
        width: 150px;
    }

    .wt-200{
        width: 200px;
    }

    .wt-250{
        width: 250px;
    }

    .wt-300{
        width: 300px;
    }

    .wt-350{
        width: 350px;
    }

    .wt-550{
        width: 550px;
    }

    .wt-555{
        width: 555px;
    }

    .pl-150{
        padding-left: 150px;
    }

    .pr-150{
        padding-right: 150px;
    }

    .pb-50{
        padding-bottom: 50px;
    }

    .pt-50{
        padding-top: 50px;
    }

    .p-0{
        padding: 0px;
    }

</style>

@php
    $session = Session::get('user');
@endphp

<body class="pt-50 pb-50">

    <div class="container">
        <div>
        <p class="mt-3">
            Wikrama Cafe
            <br>
            Jl. Raya Wangun No.21, RT.01/RW.06, Sindangsari, Kec. Bogor Tim, Kota Bogor, Jawa Barat 16146
            <br>
            Telp (0251)8242411
            <br>
            No Pemesanan:  {{ $data->code }}
            <br>
            Nama: {{ $data->name }}
            <br>
            Kasir : {{ $user->name }}
        </p>
        <span>
            ----------------------------------------------------------------------------------------------------------
        </span>
        <table class="table">
            <tr>
                <th class="wt-150">Nama Barang</th>
                <th class="wt-100">Jumlah</th>
                <th class="wt-100">Harga</th>
                <th class="wt-100">Subtotal</th>
            </tr>
        </table>
        <span>
            ----------------------------------------------------------------------------------------------------------
        </span>
        <table class="table">
            @foreach ($order_details as $od)
            <tr>
                <td class="wt-150">{{ ucwords($od->product->name.' - '.$od->product->menuCategory->name) }}</td>
                <td class="wt-100">{{ $od->qty }}</td>
                <td class="wt-100">{{ $od->product->sell_price }}</td>
                <td class="wt-100">{{ $od->product->sell_price * $od->qty }}</td>
            </tr>
            @endforeach
        </table>
        <span>
            ----------------------------------------------------------------------------------------------------------
        </span>
        <table class="table">
            <tr>
                <td class="wt-350">Total</td>
                <td class="wt-100">
                   Rp {{ number_format($data->total_price) }}
                </td>
            </tr>
            <tr>
                <td class="wt-350">Tunai</td>
                <td class="wt-100">
                    Rp {{ number_format($data->total_price + $data->change_money ) }}
                </td>
            </tr>
            <tr>
                <td class="wt-350">Kembali</td>
                <td class="wt-100">
                    Rp {{ number_format($data->change_money) }}
                </td>
            </tr>
        </table>
        <span>
            ----------------------------------------------------------------------------------------------------------
        </span>
        </div>
        <div class="container text-center pr-150 pl-150" style="margin-top: 100px;">
            <p>
                Terima Kasih Ya Gaiss
                <br>
                Pembeli Adalah Raja
            </p>
        </div>
    </div>

</body>

