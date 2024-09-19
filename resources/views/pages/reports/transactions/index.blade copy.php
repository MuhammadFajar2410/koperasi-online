<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('partials.inc_top')
    <title>Report Transaksi</title>
</head>
<body>
    <style>
        .table td {
            padding: .7vh 1vw;
        }
        .table .narrow {
            width: 1%;
            white-space: nowrap;
        }
        .table .wide {
            width: 15vw;
        }
        .container {
            margin-bottom: 2vh;
        }
    </style>
    <div class="container table-container">
        <table class="table
        {{-- table-borderless --}}
        table-bordered
        "
        >
            <tr>
                <td class="top wide">Nama</td>
                <td class="narrow">:</td>
                <td class="top"></td>
            </tr>
            <tr>
                <td class="top wide">Alamat</td>
                <td class="narrow">:</td>
                <td class="top"></td>
            </tr>
            <tr>
                <td class="top wide">Status</td>
                <td class="narrow">:</td>
                <td class="top"></td>
            </tr>
            <tr>
                <td class="top wide">Tanggal Bergabung</td>
                <td class="narrow">:</td>
                <td class="top"></td>
            </tr>
            <tr>
                <td class="top wide">Tanggal Keluar</td>
                <td class="narrow">:</td>
                <td class="top"></td>
            </tr>
            <tr>
                <td class="top wide">Alasan Keluar</td>
                <td class="narrow">:</td>
                <td class="top"></td>
            </tr>
        </table>

    </div>
    <div class="container table-container">
        <table class="table
        {{-- table-borderless --}}
        table-bordered
        ">
            <thead>
                <tr>
                    <th>Jenis Transaksi</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                </tr>
            </thead>
        </table>
    </div>

    @include('partials.inc_bottom')
</body>
</html>
