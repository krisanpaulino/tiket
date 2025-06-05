@extends('templates.penumpang')
@section('content')
    <!-- start hero section -->
    <section class="section nft-hero">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-sm-10">
                    <div class="text-center">
                        <h1 class="display-4 fw-medium mb-4 lh-base text-white">Daftar Transaksi </h1>
                        {{-- <p class="lead text-white-50 lh-base mb-4 pb-2">Lebih mudah booking tiket!</p> --}}

                    </div>
                </div><!--end col-->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end hero section -->
    <!-- start wallet -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h2 class="mb-3 fw-semibold lh-base">Daftar Transaksi</h2>
                        <p class="text-muted"></p>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row g-1">

                <div class="col-lg-12">
                    <div class="card text-center border shadow-none">
                        <div class="card-body py-5 px-4">
                            <h5>Tiket</h5>
                            <table id="example"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                                <thead>
                                    <th>No</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Rute</th>
                                    <th>Tgl Keberangkatan</th>
                                    <th>Jam Keberangkatan</th>
                                    <th>Jumlah Tiket</th>
                                    <th>Total</th>
                                    <th>Status Bayar</th>
                                    <th>Action</th>
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
                                            <td>{{ $r->jadwal->tgl_jalan }}</td>
                                            <td>{{ $r->jadwal->jam_jalan }} - {{ $r->jadwal->jam_sampai }}</td>
                                            <td>{{ $r->jumlah_tiket }}</td>
                                            <td>Rp{{ number_format($r->total) }}</td>
                                            <td>
                                                {{ $r->status }}
                                            </td>
                                            @if ($r->status == 'paid')
                                                <td><a href="{{ route('tiket', $r->order_id) }}" class="text-primary">Lihat
                                                        Detail</a></td>
                                            @else
                                                <td><a href="{{ route('pembayaran', $r->transaksi_id) }}"
                                                        class="text-primary">Pembayaran</a></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end wallet -->
@endsection
@section('jsplugins')
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
@section('cssplugins')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection
@section('scripts')
@endsection
