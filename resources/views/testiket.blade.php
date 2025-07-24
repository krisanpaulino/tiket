<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Paris Indah Bus Tickets</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        .page {
            width: 100%;
            padding: 20px;
        }

        .ticket {
            width: 100%;
            border-top: 2px solid #2e86de;
            border-bottom: 2px solid #2e86de;
            margin-bottom: 15px;
            background-color: #f0f8ff;
        }

        table.ticket-layout {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .left,
        .right {
            vertical-align: top;
            padding: 10px;
        }

        .left {
            width: 75%;
            border-right: 1px dashed #2e86de;
            background-color: #ffffff;
        }

        .right {
            width: 25%;
            background-color: #e6f0fa;
        }

        .agency-name {
            font-size: 14px;
            font-weight: bold;
            color: #2e86de;
            margin-bottom: 6px;
        }

        .passenger-name {
            font-weight: bold;
            margin-bottom: 6px;
            color: #003366;
        }

        .info-table {
            width: 100%;
        }

        .info-table td {
            padding: 3px 0;
            vertical-align: top;
        }

        .label {
            font-weight: bold;
            width: 40%;
            color: #1a3d7c;
        }

        .footer {
            text-align: center;
            font-size: 11px;
            color: #666;
            margin-top: 20px;
            border-top: 1px dashed #ccc;
            padding-top: 10px;
        }
    </style>

</head>

<body>
    <div class="page">
        <!-- Ticket 1 -->
        <div class="ticket">
            <table class="ticket-layout">
                <tr>
                    <td class="left">
                        <div class="agency-name">Paris Indah</div>
                        <div class="passenger-name">Passenger: {{ $transaksi->penumpang->nama_penumpang }} | Seat:
                            @foreach ($tiket as $item)
                                {{ $item->no_kursi }},
                            @endforeach
                        </div>
                        <table class="info-table">
                            <tr>
                                <td class="label">Rute</td>
                                <td>{{ $transaksi->jadwal->rute->asal }} → {{ $transaksi->jadwal->rute->tujuan }}</td>
                            </tr>
                            <tr>
                                <td class="label">Tanggal</td>
                                <td>{{ $item->transaksi->jadwal->tgl_jalan }}</td>
                            </tr>
                            <tr>
                                <td class="label">Departure</td>
                                <td>{{ $item->transaksi->jadwal->jam_jalan }}</td>
                            </tr>
                            <tr>
                                <td class="label">Arrival</td>
                                <td>{{ $item->transaksi->jadwal->jam_sampai }}</td>
                            </tr>
                            <tr>
                                <td class="label">BUS</td>
                                <td>{{ $item->transaksi->jadwal->bus->no_plat }}</td>
                            </tr>
                        </table>
                    </td>
                    <td class="right">
                        <div class="agency-name">Paris Indah</div>
                        <div class="passenger-name">{{ $transaksi->penumpang->nama_penumpang }} | Seat:
                            @foreach ($tiket as $item)
                                {{ $item->no_kursi }},
                            @endforeach
                        </div>
                        <table class="info-table">
                            <tr>
                                <td class="label">Rute</td>
                                <td>{{ $transaksi->jadwal->rute->asal }} → {{ $transaksi->jadwal->rute->tujuan }}</td>
                            </tr>
                            <tr>
                                <td class="label">Tanggal</td>
                                <td>{{ $item->transaksi->jadwal->tgl_jalan }}</td>
                            </tr>
                            <tr>
                                <td class="label">Departure</td>
                                <td>{{ $item->transaksi->jadwal->jam_jalan }}</td>
                            </tr>
                            <tr>
                                <td class="label">Arrival</td>
                                <td>{{ $item->transaksi->jadwal->jam_sampai }}</td>
                            </tr>
                            <tr>
                                <td class="label">BUS</td>
                                <td>{{ $item->transaksi->jadwal->bus->no_plat }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Repeat ticket block for other passengers... -->
    </div>

    <div class="footer">
        Please tear off the stub and present it to the bus conductor. Thank you for choosing Paris Indah.
    </div>
</body>

</html>
