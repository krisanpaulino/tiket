@extends('templates.owner')
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

        @if (Session::get('type') == 'owner')
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profil</h5>
                    </div>
                    <div class="card-body">
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
                                    <td>{{ $user->owner->nama_owner }}</td>
                                </tr>
                                <tr>
                                    <td>Nomor Telp. :</td>
                                    <td>
                                        {{ $user->owner->hp_owner }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alamat :</td>
                                    <td>{{ $user->owner->alamat_owner }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-2 text-end">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfile">Edit
                                Profil</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">User</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Email :</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-2 text-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#gantiPassword">Ganti
                            Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (Session::get('type') == 'owner')
        <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row g-sm-4 g-2">

                            <div class="right-sidebar-modal">
                                <form action="{{ route('profil.owner.update') }}" class="row g-4" method="post">
                                    @csrf
                                    <input type="hidden" name="owner_id" value="{{ $user->owner->owner_id }}">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">Nama Lengkap</label>
                                            <input type="text"
                                                class="form-control @error('nama_owner') is-invalid @enderror"
                                                placeholder="Nama Lengkap" name="nama_owner" id="firstNameinput"
                                                value="{{ $user->owner->nama_owner }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">Alamat</label>
                                            <input type="text"
                                                class="form-control @error('alamat_owner') is-invalid @enderror"
                                                placeholder="Alamat" name="alamat_owner" id="firstNameinput"
                                                value="{{ $user->owner->alamat_owner }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">No Hp</label>
                                            <input type="text"
                                                class="form-control @error('hp_owner') is-invalid @enderror"
                                                placeholder="No Hp" name="hp_owner" id="firstNameinput"
                                                value="{{ $user->owner->hp_owner }}">
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
    @endif
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
