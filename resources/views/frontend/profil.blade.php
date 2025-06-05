@extends('templates.penumpang')
@section('content')
    <!-- start hero section -->
    <section class="section nft-hero">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-sm-10">
                    <div class="text-center">
                        <h1 class="display-4 fw-medium mb-4 lh-base text-white">Profil </h1>
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
                        <h2 class="mb-3 fw-semibold lh-base">Profil Saya</h2>
                        <p class="text-muted"></p>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row g-1">

                <div class="col-lg-12">
                    <div class="card border shadow-none">
                        <div class="card-body py-5 px-4">
                            <div class="dashboard-title mb-3">
                                <h3>Data Diri</h3>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Nama Lengkap :</td>
                                        <td>{{ $user->penumpang->nama_penumpang }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin :</td>
                                        <td>{{ $user->penumpang->jk_penumpang }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Telp. :</td>
                                        <td>
                                            {{ $user->penumpang->no_hp }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Alamat :</td>
                                        <td>{{ $user->penumpang->alamat_penumpang }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="text-end">
                                <a href="javascript:void(0)" class="badge bg-primary"><span data-bs-toggle="modal"
                                        data-bs-target="#editProfile">Edit</span>
                                </a>
                            </div>
                            <div class="dashboard-title mb-3">
                                <h3>Login Details</h3>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Email :</td>
                                            <td>
                                                <a href="javascript:void(0)">{{ $user->email }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" class="badge bg-primary" data-bs-toggle="modal"
                                                    data-bs-target="#gantiPassword">
                                                    <span>Ganti
                                                        Password</span></a>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end wallet -->

    <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row g-sm-4 g-2">

                        <div class="right-sidebar-modal">
                            <form action="{{ route('profil.update') }}" class="row g-4" method="post">
                                @csrf
                                <input type="hidden" name="penumpang_id" value="{{ $user->penumpang->penumpang_id }}">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label">Nama Lengkap</label>
                                        <input type="text"
                                            class="form-control @error('nama_penumpang') is-invalid @enderror"
                                            placeholder="Nama Lengkap" name="nama_penumpang" id="firstNameinput"
                                            value="{{ $user->penumpang->nama_penumpang }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label">Jenis
                                            Kelamin</label>
                                        <select class="form-select @error('jk_penumpang') is-invalid @enderror"
                                            placeholder="Jenis Kelamin" name="jk_penumpang" id="firstNameinput">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L" @selected($user->penumpang->jk_penumpang == 'L')>L</option>
                                            <option value="P" @selected($user->penumpang->jk_penumpang == 'P')>P</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label">Alamat</label>
                                        <input type="text"
                                            class="form-control @error('alamat_penumpang') is-invalid @enderror"
                                            placeholder="Alamat" name="alamat_penumpang" id="firstNameinput"
                                            value="{{ $user->penumpang->alamat_penumpang }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="firstNameinput" class="form-label">No Hp</label>
                                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                            placeholder="No Hp" name="no_hp" id="firstNameinput"
                                            value="{{ $user->penumpang->no_hp }}">
                                    </div>
                                </div>

                                <div class="modal-button">
                                    <button class="btn btn-md btn-primary" type="submit">Update Profil</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="gantiPassword" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row g-sm-4 g-2">

                        <div class="right-sidebar-modal">
                            <form action="{{ route('profil.ganti-password') }}" class="row g-4" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">Password Sekarang</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" name="current_password"
                                                class="form-control pe-5 password-input" placeholder="Password Sekarang"
                                                @error('current_password') is-invalid @enderror" id="password-input">
                                            <button
                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                type="button" id="password-addon"><i
                                                    class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">Password Baru</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" name="user_password"
                                                class="form-control pe-5 password-input" placeholder="Password Baru"
                                                @error('user_password') is-invalid @enderror" id="password-input">
                                            <button
                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                type="button" id="password-addon"><i
                                                    class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">Konfirmasi Password Baru</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" name="password_confirmation"
                                                class="form-control pe-5 password-input"
                                                placeholder="Konfirmasi Password Baru"
                                                @error('password_confirmation') is-invalid @enderror" id="password-input">
                                            <button
                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                type="button" id="password-addon"><i
                                                    class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-button">
                                    <button class="btn btn-md btn-primary" type="submit">Ganti Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
