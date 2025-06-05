<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {{-- <title>Bus Tickets - Transaction Summary</title> --}}
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f2f4f7;
            padding: 30px;
        }

        .transaction {
            max-width: 800px;
            margin: auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            padding: 30px;
        }

        .transaction-header h2 {
            margin: 0 0 20px;
            color: #2e86de;
        }

        table.info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 14px;
        }

        table.info-table td {
            padding: 5px 5px;
            vertical-align: top;
        }

        table.info-table td.label {
            font-weight: bold;
            color: #444;
            width: 30%;
        }

        .paid {
            color: green;
            font-weight: bold;
        }

        .ticket {
            border: 1px solid #ddd;
            border-left: 5px solid #2e86de;
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 15px;
            background: #fafafa;
        }

        .ticket-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            font-size: 13px;
        }

        .ticket-grid div {
            min-width: 120px;
        }

        .ticket-grid label {
            font-weight: bold;
            display: block;
            margin-bottom: 4px;
            color: #444;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #777;
            margin-top: 30px;
            border-top: 1px dashed #ccc;
            padding-top: 15px;
        }
    </style>
</head>

<body>

    <div class="transaction">
        <div class="transaction-header">
            <h2>{{ $transaksi->jadwal->bus->nama_bus }}</h2>
        </div>
        <table class="info-table">
            <tr>
                <td class="label">Order ID</td>
                <td>{{ $transaksi->order_id }}</td>
                <td class="label">Route</td>
                <td>{{ $transaksi->jadwal->rute->asal }} - {{ $transaksi->jadwal->rute->tujuan }}</td>
            </tr>
            <tr>
                <td class="label">Transaction Date</td>
                <td>{{ $transaksi->tgl_pesan }}</td>
                <td class="label">Departure</td>
                <td>{{ $transaksi->jadwal->jam_jalan }}</td>
            </tr>
            <tr>
                <td class="label">Nama</td>
                <td>{{ $transaksi->penumpang->nama_penumpang }}</td>
                <td class="label">Arrival</td>
                <td>{{ $transaksi->jadwal->jam_sampai }}</td>
            </tr>
            <tr>
                <td class="label">Buyer Email</td>
                <td>{{ $transaksi->penumpang->user->email }}</td>
                <td class="label">Total Amount</td>
                Rp {{ number_format($transaksi->total) }}
            </tr>
            <tr>
                <td class="label">Payment Status</td>
                <td><span class="paid">Paid</span></td>
                <td></td>
                <td></td>
            </tr>
        </table>


    </div>

    <div class="tickets">
        <!-- Ticket 1 -->
        @foreach ($tiket as $item)
            <div class="ticket">
                <div class="ticket-grid">
                    <div>
                        <label>Seat</label>
                        {{ $item->no_kursi }}
                    </div>
                    <div>
                        <label>Booking</label>
                        {{ $item->kode_booking }}
                    </div>
                </div>
            </div>
        @endforeach


    </div>

    <div class="footer">
        Thank you for choosing Bus Kupang — Safe travels!
    </div>
    </div>

</body>

</html>
