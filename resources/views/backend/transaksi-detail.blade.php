@extends('templates.' . Session::get('type'))
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ $title }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route(Session::get('type') . '.transaksi') }}">Transaksi</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-lg-3">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Data Transaksi</h5>
                        </div>
                        <div class="card-body">
                            <table class="table borderless">
                                <tr>
                                    <th>Tanggal Transaksi</th>
                                    <td>{{ $transaksi->tgl_pesan }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $transaksi->status }}</td>
                                </tr>
                                <tr>
                                    <th>Jadwal</th>
                                    <td>{{ $transaksi->jadwal->jam_jalan }} - {{ $transaksi->jadwal->jam_sampai }}</td>
                                </tr>
                                <tr>
                                    <th>Rute</th>
                                    <td>{{ $transaksi->jadwal->rute->asal }} - {{ $transaksi->jadwal->rute->tujuan }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Tiket</th>
                                    <td>{{ $transaksi->jumlah_tiket }}</td>
                                </tr>
                                <tr>
                                    <th>Total Bayar</th>
                                    <td>Rp{{ number_format($transaksi->total) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Data Pemesan</h5>
                        </div>
                        <div class="card-body">
                            <table class="table borderless">
                                <tr>
                                    <th>Nama Pemesan</th>
                                    <td>{{ $transaksi->penumpang->nama_penumpang }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $transaksi->penumpang->jk_penumpang }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor HP</th>
                                    <td>{{ $transaksi->penumpang->no_hp }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $transaksi->penumpang->alamat_penumpang }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $transaksi->penumpang->user->email }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detail Transaksi</h5>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th>Kode Booking</th>
                                <th>Nomor Kursi</th>
                                <th>Status Checkin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($tiket as $r)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $r->kode_booking }}</td>
                                    <td>{{ $r->no_kursi }}</td>
                                    <td>
                                        @if ($r->status_checkin)
                                            Sudah Checkin
                                        @else
                                            Belum Checkin
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <a href="{{ route('tiket.cetak', $transaksi->transaksi_id) }}" target="_blank"
                class="btn btn-warning px-4">Cetak Tiket</a>
        </div>
    </div>
    <!-- end page title -->
@endsection
@section('cssplugin')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection
@section('jsplugin')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="{{ asset('/') }}js/pages/datatables.init.js"></script>
@endsection
@section('scripts')
    <script>
        $('#hapus').on('show.bs.modal', function(event) {

            var kode = $(event.relatedTarget).data('id');
            $(this).find('#kodeitemhapus').attr("value", kode);
        });
        $('#edit').on('show.bs.modal', function(event) {
            var id = $(event.relatedTarget).data('id');
            var tanggal = $(event.relatedTarget).data('tanggal');
            var jalan = $(event.relatedTarget).data('jalan');
            var sampai = $(event.relatedTarget).data('sampai');
            var rute = $(event.relatedTarget).data('rute');
            console.log(tanggal);

            $(this).find('#kodeitemedit').attr("value", id);
            $(this).find('#tanggal').attr("value", tanggal);
            $(this).find('#jalan').attr("value", jalan);
            $(this).find('#sampai').attr("value", sampai);
            $(this).find('#rute option[value="' + rute + '"]').attr("selected", 'selected');
        });
    </script>
@endsection
