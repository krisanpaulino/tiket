@extends('templates.penumpang')
@section('content')
    <!-- start hero section -->
    <section class="section nft-hero">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-sm-10">
                    <div class="text-center">
                        <h1 class="display-4 fw-medium mb-4 lh-base text-white">Halaman Pemesanan Tiket </h1>
                        {{-- <p class="lead text-white-50 lh-base mb-4 pb-2">Lebih mudah booking tiket!</p> --}}

                    </div>
                </div><!--end col-->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <!-- start wallet -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h2 class="mb-3 fw-semibold lh-base">Pemesanan Tiket Bus</h2>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row g-4 justify-content-center">
                <div class="col-lg-8">
                    <div class="card text-center border shadow-none">
                        <div class="card-body py-5 px-4">
                            <h5>Pesan Tiket</h5>
                            <p class="text-muted pb-1">Isi data di bawah untuk memesan tiket!</p>
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('pesan.post') }}" method="post">
                                @csrf
                                <input type="hidden" name="jadwal_id" id="jadwal">
                                {{-- Pilih Rute --}}
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="rute" class="form-label">Rute</label>
                                        <select class="form-select @error('rute_id') is-invalid @enderror"
                                            placeholder="Rute" name="rute_id" id="rute">
                                            <option value="">Pilih Rute</option>
                                            @foreach ($rute as $item)
                                                <option value="{{ $item->rute_id }}">
                                                    {{ $item->asal }} - {{ $item->tujuan }}
                                                    (Rp{{ number_format($item->harga) }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Tanggal Keberangkatan</label>
                                        <select name="tgl_jalan" class="form-select" id="tanggal"></select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="jam" class="form-label">Waktu Keberangkatan</label>
                                        <select name="jam_jalan" class="form-select" id="jam"></select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="bus" class="form-label">Bus</label>
                                        <select name="bus_id" class="form-select" id="bus"></select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="kursi" class="form-label">Jumlah Tiket</label>
                                        <input type="number"
                                            class="form-control @error('jumlah_kursi') is-invalid @enderror"
                                            placeholder="Jumlah Tiket" name="jumlah_tiket" id="kursi"
                                            value="<?= old('jumlah_tiket') ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="text-end">
                                            <span class="text-primary" id="available"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="text-end">
                                            <span id="total"></span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="total" value>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Pesan - Lanjut
                                                Pembayaran</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end wallet -->
@endsection
@section('scripts')
    <script>
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
