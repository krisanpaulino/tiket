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
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <form class="row row-cols-1 g-3 mb-4 row-cols-lg-auto align-items-center">
        <div class="col">
            <input type="date" class="form-control" id="input51" name="dari" value="{{ $dari }}"
                placeholder="Dari Tanggal">
        </div>
        <div class="col">
            <input type="date" class="form-control" id="input51" name="sampai" value="{{ $sampai }}"
                placeholder="Sampai Tanggal">
        </div>
        <div class="col">
            <button type="submit" class="btn btn-primary px-4">Filter</button>
        </div>
        <div class="col">
            <a href="<?= url('/' . Session::get('type') . '/laporan/cetak?dari' . $dari . '&sampai=' . $sampai) ?>"
                target="_blank" class="btn btn-warning px-4">Cetak</a>
        </div>
    </form>

    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Laporan</h5>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th>Tanggal Transaksi</th>
                                <th>Penumpang</th>
                                <th>Rute</th>
                                <th>Bus</th>
                                <th>Jadwal</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($laporan as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->tgl_pesan }}</td>
                                    <td>{{ $row->penumpang->nama_penumpang }}</td>
                                    <td>{{ $row->jadwal->rute->asal }} - {{ $row->jadwal->rute->tujuan }}</td>
                                    <td>{{ $row->jadwal->bus->nama_bus }}</td>
                                    <td>{{ $row->jadwal->tgl_jalan }} | {{ $row->jadwal->jam_jalan }} -
                                        {{ $row->jadwal->jam_sampai }}</td>
                                    <td>{{ $row->jumlah_tiket }}</td>
                                    <td>Rp{{ number_format($row->total) }}</td>
                                    <td>{{ $row->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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
