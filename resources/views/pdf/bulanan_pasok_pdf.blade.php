
<title>Laporan Pasok Bulanan</title>

<style>

    .container {
        width: 100%;
        margin-right: auto;
        margin-left: auto;
    }

    .table {
        font-family: sans-serif;
        color: #232323;
        margin-left: 70px;
        border-collapse: collapse;

    }

    .table, th, td {
        font-weight: 300;
        font-size: 15px;
        padding: 2px 10px;
        text-align: center;
        border: 1px solid #999;
    }

    .table-none{
        font-family: sans-serif;
        color: #232323;
        border-collapse: collapse;
    }

    .table-none, .th, .td {
        font-weight: 300;
        font-size: 15px;
        padding: 2px 10px;
        text-align: center;
        border: none!important;
    }

    .bg-red{
        background: red;
    }

    .bg-blue{
        background: blue;
    }

    .text-center{
        text-align: center!important;
    }

    .text-right{
        text-align: right!important;
    }

    .text-left{
        text-align: left!important;
    }

    .wt-10{
        width: 10px;
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

    .f-20{
        font-size: 20px;
    }

</style>

@php
    $session = Session::get('user');
@endphp

<body class="pt-50 pb-50">
    <div class="">
        <h1 style="margin-left: 100px;">
            Laporan Pasok Bulanan
            <span class="f-20">
                2019 11 08
            </span>
        </h1>
        <table class="table">
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2" class="wt-150">Nama Barang</th>
                <th rowspan="2">Harga Beli</th>
                <th rowspan="2" class="">Harga Jual</th>
                <th colspan="2">Pesedian Awal</th>
                <th colspan="2" class="">Barang Masuk</th>
                <th colspan="2">Persediaan Akhir</th>
                {{-- <th colspan="2" class="">Keterangan</th> --}}
            </tr>
            <tr>
                <th class="">Jumlah</th>
                <th class="">Harga</th>
                <th class="">Jumlah</th>
                <th class="">Harga</th>
                <th class="">Jumlah</th>
                <th class="">Harga</th>
                {{-- <th class="" style="border-right: none;">Jumlah Beli</th>
                <th class="" style="border-left: none;">Jumlah Jual</th> --}}
            </tr>
            @php
                $no = 1;
            @endphp
            @foreach ($reports as $r)

                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $r->Product->name }}</td>
                    <td>{{ $r->Product->purchase_price }}</td>
                    <td>{{ $r->Product->sell_price }}</td>
                    <td>{{ $r->jumlah_awal }}</td>
                    <td>{{ $r->jumlah_awal * $r->harga }}</td>
                    <td>{{ $r->bm_jumlah }}</td>
                    <td>{{ $r->bm_jumlah * $r->harga }}</td>
                    <td>{{ $r->jumlah_awal + $r->bm_jumlah }}</td>
                    <td>{{ $r->jumlah_akhir * $r->harga }}</td>
                    {{-- <td>
                        {{ $r->Product->Supplier['harga_beli'] * $r->jumlah_awal }}
                    </td>
                    <td>
                        {{ $r->Product->harga_jual * $r->jumlah_awal }}
                    </td> --}}
                </tr>
            @endforeach
        </table>
    </div>

</body>

