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
                    <h5 class="card-title mb-0">Data Bus</h5>
                </div>
                <div class="card-body">
                    @if (Session::get('type') == 'admin')
                        <div class="text-end mb-4">
                            <a href="{{ route('bus.tambah') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Tambah
                                Bus</a>
                        </div>
                    @endif
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th>Nomor Plat</th>
                                <th>Nama Bus</th>
                                <th>Jumlah Kursi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($bus as $r)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $r->no_plat }}</td>
                                    <td>{{ $r->nama_bus }}</td>
                                    <td>{{ $r->jumlah_kursi }}</td>
                                    <td>
                                        @if (Session::get('type') == 'admin')
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" data-bs-toggle="modal"
                                                            data-bs-target="#edit" data-id="{{ $r->bus_id }}"
                                                            data-plat="{{ $r->no_plat }}" data-nama="{{ $r->nama_bus }}"
                                                            data-kursi="{{ $r->jumlah_kursi }}"><i
                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit</a></li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn" data-bs-toggle="modal"
                                                            data-bs-target="#hapus" data-id="{{ $r->bus_id }}">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn"
                                                            href="{{ route('jadwal.index', $r->bus_id) }}">
                                                            <i class="ri-time-line align-bottom me-2 text-muted"></i>
                                                            Jadwal
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
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

    {{-- Delete Modal --}}
    <div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form" action="{{ route('bus.delete') }}" method="post">
                    @csrf
                    <input type="hidden" name="bus_id" id="kodeitemhapus" value="">
                    <div class="modal-body">
                        <h5>Yakin ingin mengapus bus ?</h5>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-danger" type="submit">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Delete Modal --}}


    {{-- Edit Modal --}}
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form" action="{{ route('bus.update') }}" method="post">
                    @csrf
                    <input type="hidden" name="bus_id" id="kodeitemedit" value="">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="plat" class="form-label">No Plat</label>
                                <input type="text" class="form-control @error('no_plat') is-invalid @enderror"
                                    placeholder="No Plat" name="no_plat" id="plat" value="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Bus</label>
                                <input type="text" class="form-control @error('nama_bus') is-invalid @enderror"
                                    placeholder="Nama Bus" name="nama_bus" id="nama" value="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="kursi" class="form-label">Jumlah Kursi</label>
                                <input type="number" class="form-control @error('jumlah_kursi') is-invalid @enderror"
                                    placeholder="Nomor Plat" name="jumlah_kursi" id="kursi" value="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Edit Modl --}}
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
            var nama = $(event.relatedTarget).data('nama');
            var plat = $(event.relatedTarget).data('plat');
            var kursi = $(event.relatedTarget).data('kursi');
            console.log(nama);

            $(this).find('#kodeitemedit').attr("value", id);
            $(this).find('#nama').attr("value", nama);
            $(this).find('#plat').attr("value", plat);
            $(this).find('#kursi').attr("value", kursi);
        });
    </script>
@endsection
