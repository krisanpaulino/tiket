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


    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Data Transaksi</h5>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th>Tanggal Transaksi</th>
                                <th>Rute</th>
                                <th>Bus</th>
                                <th>Tgl Keberangkatan</th>
                                <th>Jam Keberangkatan</th>
                                <th>Jumlah Tiket</th>
                                <th>Total</th>
                                <th>Status Bayar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($transaksi as $r)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $r->tgl_pesan }}</td>
                                    <td>{{ $r->jadwal->rute->asal }} - {{ $r->jadwal->rute->tujuan }}</td>
                                    <td>{{ $r->jadwal->bus->nama_bus }}</td>
                                    <td>{{ $r->jadwal->tgl_jalan }}</td>
                                    <td>{{ $r->jadwal->jam_jalan }} - {{ $r->jadwal->jam_sampai }}</td>
                                    <td>{{ $r->jumlah_tiket }}</td>
                                    <td>Rp{{ number_format($r->total) }}</td>
                                    <td>
                                        {{ $r->status }}
                                    </td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item edit-item-btn"
                                                        href="{{ route(Session::get('type') . '.transaksi.detail', $r->transaksi_id) }}"><i
                                                            class="ri-pencil-eye align-bottom me-2 text-muted"></i>
                                                        Detail</a></li>

                                            </ul>
                                        </div>
                                    </td>
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
