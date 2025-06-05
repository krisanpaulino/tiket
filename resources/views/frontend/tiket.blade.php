@extends('templates.penumpang')
@section('content')
    <!-- start hero section -->
    <section class="section nft-hero">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-sm-10">
                    <div class="text-center">
                        <h1 class="display-4 fw-medium mb-4 lh-base text-white">Detail Tiket </h1>
                        {{-- <p class="lead text-white-50 lh-base mb-4 pb-2">Lebih mudah booking tiket!</p> --}}

                    </div>
                </div><!--end col-->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end hero section -->
    <!-- start wallet -->
    <section class="section" id="wallet">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h2 class="mb-3 fw-semibold lh-base">Detail Tiket</h2>
                        <p class="text-muted"></p>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card text-center border shadow-none">
                        <div class="card-body py-5 px-4">
                            <h5>Detail Order</h5>
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

                <div class="col-lg-8">
                    <div class="card text-center border shadow-none">
                        <div class="card-body py-5 px-4">
                            <h5>Tiket</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <th>No</th>
                                    <th>Kode Booking</th>
                                    <th>Nomor Kursi</th>
                                    <th>Status Checkin</th>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($transaksi->tiket as $tiket)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $tiket->kode_booking }}</td>
                                            <td>{{ $tiket->no_kursi }}</td>
                                            <td>
                                                @if ($tiket->status_checkin)
                                                    Sudah Checkin
                                                @else
                                                    Belum Checkin
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <a href="{{ route('tiket.cetak', $transaksi->transaksi_id) }}" target="_blank"
                                class="btn btn-warning px-4">Cetak Tiket</a>
                        </div>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end wallet -->
@endsection
@section('jsplugins')
@endsection
@section('scripts')
@endsection
