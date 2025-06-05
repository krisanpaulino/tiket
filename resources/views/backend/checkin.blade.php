@extends('templates.admin')
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
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Form Check In</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('checkin.post') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="plat" class="form-label">Kode Tiket</label>
                                    <input type="text" class="form-control @error('kode_booking') is-invalid @enderror"
                                        placeholder="Kode Tiket" name="kode_booking" id="plat"
                                        value="<?= old('kode_booking') ?>">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">CheckIn</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        @isset($tiket)
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Data Tiket</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Kode Tiket</th>
                                <td>{{ $tiket->kode_booking }}</td>
                            </tr>
                            <tr>
                                <th>Rute</th>
                                <td>{{ $tiket->transaksi->jadwal->rute->asal }} - {{ $tiket->transaksi->jadwal->rute->tujuan }}
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>{{ $tiket->transaksi->jadwal->tgl_jalan }}</td>
                            </tr>
                            <tr>
                                <th>Jam</th>
                                <td>{{ $tiket->transaksi->jadwal->jam_jalan }}</td>
                            </tr>
                            <tr>
                                <th>Bus</th>
                                <td>{{ $tiket->transaksi->jadwal->bus->nama_bus }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        @endisset
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
