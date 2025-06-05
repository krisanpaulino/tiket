<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Sign In | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('/') }}images/favicon.ico">

    <!-- Layout config Js -->
    <script src="{{ asset('/') }}js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('/') }}css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('/') }}css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('/') }}css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('/') }}css/custom.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper auth-bg-cover d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="card overflow-hidden">
                            <div class="row g-0">

                                <div class="p-lg-5 p-4">
                                    <div>
                                        <h5 class="text-primary">Sistem Penjualan Tiket !</h5>
                                        <p class="text-muted">Registrasi.</p>
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
                                    <div class="mt-4">
                                        <form action="{{ route('registrasi.post') }}" method="POST">
                                            @csrf
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="firstNameinput" class="form-label">Nama Lengkap</label>
                                                    <input type="text"
                                                        class="form-control @error('nama_penumpang') is-invalid @enderror"
                                                        placeholder="Nama Lengkap" name="nama_penumpang"
                                                        id="firstNameinput" value="<?= old('nama_penumpang') ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="firstNameinput" class="form-label">Jenis
                                                        Kelamin</label>
                                                    <select
                                                        class="form-select @error('jk_penumpang') is-invalid @enderror"
                                                        placeholder="Jenis Kelamin" name="jk_penumpang"
                                                        id="firstNameinput">
                                                        <option value="">Pilih Jenis Kelamin</option>
                                                        <option value="L" @selected(old('jk_penumpang') == 'L')>L</option>
                                                        <option value="P" @selected(old('jk_penumpang') == 'P')>P</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="firstNameinput" class="form-label">Alamat</label>
                                                    <input type="text"
                                                        class="form-control @error('alamat_penumpang') is-invalid @enderror"
                                                        placeholder="Alamat" name="alamat_penumpang" id="firstNameinput"
                                                        value="<?= old('alamat_penumpang') ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="firstNameinput" class="form-label">No Hp</label>
                                                    <input type="text"
                                                        class="form-control @error('no_hp') is-invalid @enderror"
                                                        placeholder="No Hp" name="no_hp" id="firstNameinput"
                                                        value="<?= old('no_hp') ?>">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="text" name="email" class="form-control"
                                                    @error('email') is-invalid @enderror" id="email"
                                                    placeholder="Enter email">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="password-input">Password</label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password" name="user_password"
                                                        class="form-control pe-5 password-input"
                                                        placeholder="Enter password"
                                                        @error('user_password') is-invalid @enderror"
                                                        id="password-input">
                                                    <button
                                                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                        type="button" id="password-addon"><i
                                                            class="ri-eye-fill align-middle"></i></button>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="password-input">Konfirmasi
                                                    Password</label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password" name="password_confirmation"
                                                        class="form-control pe-5 password-input"
                                                        placeholder="Konfirmasi Password"
                                                        @error('password') is-invalid @enderror" id="password-input">
                                                    <button
                                                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                        type="button" id="password-addon"><i
                                                            class="ri-eye-fill align-middle"></i></button>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-success w-100"
                                                    type="submit">Registrasi</button>
                                            </div>


                                        </form>
                                    </div>

                                    {{-- <div class="mt-5 text-center">
                                            <p class="mb-0">Don't have an account ? <a href="auth-signup-cover.html"
                                                    class="fw-semibold text-primary text-decoration-underline">
                                                    Signup</a> </p>
                                        </div> --}}
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Velzon. Crafted with <i class="mdi mdi-heart text-danger"></i>
                                by Themesbrand
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('/') }}libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/') }}libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('/') }}libs/node-waves/waves.min.js"></script>
    <script src="{{ asset('/') }}libs/feather-icons/feather.min.js"></script>
    <script src="{{ asset('/') }}js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="{{ asset('/') }}js/plugins.js"></script>

    <!-- password-addon init -->
    <script src="{{ asset('/') }}js/pages/password-addon.init.js"></script>
</body>

</html>
