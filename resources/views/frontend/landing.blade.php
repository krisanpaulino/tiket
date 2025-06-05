@extends('templates.penumpang')
@section('content')
    <!-- start hero section -->
    <section class="section nft-hero" id="hero">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-sm-10">
                    <div class="text-center">
                        <h1 class="display-4 fw-medium mb-4 lh-base text-white">Paris <span class="text-success">Indah</span>
                        </h1>
                        <p class="lead text-white-50 lh-base mb-4 pb-2">Lebih mudah booking tiket!</p>

                        <div class="hstack gap-2 justify-content-center">
                            @if (!Session::has('login_penumpang'))
                                <a href="/login" class="btn btn-primary">Login <i
                                        class="ri-arrow-right-line align-middle ms-1"></i></a>
                                <a href="/registrasi" class="btn btn-danger">Daftar <i
                                        class="ri-arrow-right-line align-middle ms-1"></i></a>
                            @else
                                <a href="{{ route('pesan.page') }}" class="btn btn-danger">Pesan Tiket Bus Sekarang <i
                                        class="ri-arrow-right-line align-middle ms-1"></i></a>
                            @endif
                        </div>
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
                        <h2 class="mb-3 fw-semibold lh-base">Paris Indah</h2>
                        <p class="text-muted">Paris Indo Sistem Penjualan Tiket Bus Digital yang modern, praktis, dan
                            efisien. Sistem
                            ini dirancang khusus untuk memenuhi kebutuhan mobilitas masyarakat perkotaan yang menginginkan
                            solusi transportasi yang lebih cepat, mudah, dan terjangkau.

                            Dengan sistem ini, masyarakat tidak perlu lagi antre panjang di loket atau khawatir kehabisan
                            tiket. Semua proses pemesanan dapat dilakukan langsung melalui aplikasi atau website resmi,
                            cukup dari ponsel atau komputer Anda.</p>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card text-center border shadow-none">
                        <div class="card-body py-5 px-4">
                            <img src="{{ asset('/') }}images/nft/wallet/metamask.png" alt="" height="55"
                                class="mb-3 pb-2">
                            <h5>Kecepatan</h5>
                            <p class="text-muted pb-1">Proses pemesanan berlangsung cepat, hanya dalam hitungan menit.</p>
                        </div>
                    </div>
                </div><!-- end col -->
                <div class="col-lg-4">
                    <div class="card text-center border shadow-none">
                        <div class="card-body py-5 px-4">
                            <img src="{{ asset('/') }}images/nft/wallet/coinbase.png" alt="" height="55"
                                class="mb-3 pb-2">
                            <h5>Kemudahan</h5>
                            <p class="text-muted pb-1">Pengguna dapat dengan mudah mencari jadwal, memilih rute, dan memesan
                                tiket hanya dalam beberapa langkah. </p>
                        </div>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-4">
                    <div class="card text-center border shadow-none">
                        <div class="card-body py-5 px-4">
                            <img src="{{ asset('/') }}images/nft/wallet/binance.png" alt="" height="55"
                                class="mb-3 pb-2">
                            <h5>Tanpa Ribet</h5>
                            <p class="text-muted pb-1">Nikmati pengalaman bepergian tanpa kerepotan.</p>
                        </div>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end wallet -->
@endsection
