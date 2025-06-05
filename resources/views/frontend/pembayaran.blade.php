@extends('templates.penumpang')
@section('content')
    <!-- start hero section -->
    <section class="section nft-hero">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-sm-10">
                    <div class="text-center">
                        <h1 class="display-4 fw-medium mb-4 lh-base text-white">Halaman Pembayaran</h1>
                        {{-- <p class="lead text-white-50 lh-base mb-4 pb-2">Lebih mudah booking tiket!</p> --}}

                    </div>
                </div><!--end col-->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <!-- start wallet -->
    <section class="section" id="wallet">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h2 class="mb-3 fw-semibold lh-base">Halaman Pembayaran</h2>
                        <p class="text-muted"></p>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="card text-center border shadow-none">
                        <div class="card-body py-5 px-4">
                            <h5>Order Summary</h5>
                            <table class="table borderless">
                                <tr>
                                    <td>Tanggal Transaksi</td>
                                    <td>{{ $transaksi->tgl_pesan }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>{{ $transaksi->status }}</td>
                                </tr>
                                <tr>
                                    <td>Jadwal</td>
                                    <td>{{ $transaksi->jadwal->jam_jalan }} - {{ $transaksi->jadwal->jam_sampai }}</td>
                                </tr>
                                <tr>
                                    <td>Rute</td>
                                    <td>{{ $transaksi->jadwal->rute->asal }} - {{ $transaksi->jadwal->rute->tujuan }}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah Tiket</td>
                                    <td>{{ $transaksi->jumlah_tiket }}</td>
                                </tr>
                                <tr>
                                    <td>Total Bayar</td>
                                    <td>Rp{{ number_format($transaksi->total) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-7">
                    <div class="card text-center border shadow-none">
                        <div class="card-body py-5 px-4">
                            <h5>Pembayaran</h5>
                            <div id="snap-container"></div>
                        </div>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end wallet -->
@endsection
@section('jsplugins')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-zn-rP3sVpOj3qa5f"></script>
@endsection
@section('scripts')
    <script>
        window.snap.embed('{{ $transaksi->token }}', {
            embedId: 'snap-container'
        });

        $('#rute').on('change', function(e) {
            var rute = $('#rute').val()
            $('#tanggal').empty();
            $('#jam').empty();
            $('#bus').empty();

            $.ajax({
                url: "{{ route('ajax.getTanggal') }}",
                type: 'GET',
                data: {
                    rute: rute
                },
                success: function(data) {
                    $('#tanggal').append($('<option>', {
                        text: 'Pilih Tanggal'
                    }));
                    $.each(data, function(i, item) {
                        $('#tanggal').append($('<option>', {
                            value: item.tgl_jalan,
                            text: item.tgl_jalan
                        }));
                    });
                },
                error: function(e) {
                    console.log(e);

                },
                dataType: "json"
            });
        })

        $('#tanggal').on('change', function(e) {
            var tanggal = $('#tanggal').val()
            $('#jam').empty();
            $('#bus').empty();

            $.ajax({
                url: "{{ route('ajax.getJam') }}",
                type: 'GET',
                data: {
                    tanggal: tanggal
                },
                success: function(data) {
                    // console.log(data);

                    $('#jam').append($('<option>', {
                        text: 'Pilih Jam'
                    }));
                    $.each(data, function(i, item) {
                        $('#jam').append($('<option>', {
                            value: item.jam_jalan,
                            text: item.jam_jalan
                        }));
                    });
                },
                error: function(e) {
                    console.log(e);

                },
                dataType: "json"
            });
        })

        $('#jam').on('change', function(e) {
            var tanggal = $('#tanggal').val()
            var jam = $('#jam').val()
            $('#bus').empty();

            $.ajax({
                url: "{{ route('ajax.getBus') }}",
                type: 'GET',
                data: {
                    jam: jam,
                    tanggal: tanggal
                },
                success: function(data) {
                    // console.log(data);

                    $('#bus').append($('<option>', {
                        text: 'Pilih Bus'
                    }));
                    $.each(data, function(i, item) {
                        $('#bus').append($('<option>', {
                            value: item.bus_id,
                            text: item.bus.nama_bus
                        }));
                    });
                },
                error: function(e) {
                    console.log(e);

                },
                dataType: "json"
            });
        })
        $('#bus').on('change', function(e) {
            getHarga()
            cekKursi()
        })
        $('#kursi').on('change', function(e) {
            getHarga()
        })


        function getHarga() {
            var rute = $('#rute').val();
            var kursi = $('#kursi').val();
            $('#total').text('Total : Rp 0');

            $.ajax({
                url: "{{ route('ajax.getHarga') }}",
                type: 'GET',
                data: {
                    rute: rute,
                    kursi: kursi
                },
                success: function(data) {
                    console.log(data);

                    $('#total').text('Total : Rp' + data.total);
                    $('#totalinput').val(data.totalinput);
                },
                error: function(e) {
                    console.log(e);

                },
                dataType: "json"
            });
        }

        function cekKursi() {
            var rute = $('#rute').val();
            var tanggal = $('#tanggal').val();
            var jam = $('#jam').val();
            var bus = $('#bus').val();
            $('#available').text('Kursi Tersedia : -');

            $.ajax({
                url: "{{ route('ajax.cekKursi') }}",
                type: 'GET',
                data: {
                    rute: rute,
                    tanggal: tanggal,
                    bus: bus,
                    jam: jam
                },
                success: function(data) {
                    // console.log(data);

                    $('#available').text('Kursi Tersedia : ' + data.available);
                    $('#kursi').attr('max', data.available);
                    $('#jadwal').val(data.jadwal_id);

                },
                error: function(e) {
                    console.log(e);

                },
                dataType: "json"
            });
        }
    </script>
@endsection
