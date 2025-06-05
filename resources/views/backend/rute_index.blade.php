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
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Data Rute</h5>
                </div>
                <div class="card-body">
                    <div class="text-end mb-4">
                        <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#tambah"
                            class="btn btn-primary"><i class="bx bx-plus"></i> Tambah
                            Rute</a>
                    </div>
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th>Asal</th>
                                <th>Tujuan</th>
                                <th>Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($rute as $r)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $r->asal }}</td>
                                    <td>{{ $r->tujuan }}</td>
                                    <td>Rp{{ number_format($r->harga) }}</td>

                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item edit-item-btn" data-bs-toggle="modal"
                                                        data-bs-target="#edit" data-id="{{ $r->jadwal_id }}"
                                                        data-asal="{{ $r->asal }}" data-tujuan="{{ $r->tujuan }}"
                                                        data-harga="{{ $r->harga }}"><i
                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Edit</a></li>
                                                <li>
                                                    <a class="dropdown-item remove-item-btn" data-bs-toggle="modal"
                                                        data-bs-target="#hapus" data-id="{{ $r->rute_id }}">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                        Delete
                                                    </a>
                                                </li>
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
    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form" action="{{ route('rute.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Rute Asal</label>
                                <input type="text" class="form-control @error('asal') is-invalid @enderror"
                                    placeholder="Rute Asal" name="asal" value="{{ old('asal') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Rute Tujuan</label>
                                <input type="text" class="form-control @error('tujuan') is-invalid @enderror"
                                    placeholder="Rute Tujuan" name="tujuan" value="{{ old('tujuan') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Harga</label>
                                <input type="text" class="form-control @error('harga') is-invalid @enderror"
                                    placeholder="Harga" name="harga" value="{{ old('harga') }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form" action="{{ route('rute.delete') }}" method="post">
                    @csrf
                    <input type="hidden" name="rute_id" id="kodeitemhapus" value="">
                    <div class="modal-body">
                        <h5>Yakin ingin mengapus rute ?</h5>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-danger" type="submit">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form" action="{{ route('rute.update') }}" method="post">
                    @csrf
                    <input type="hidden" name="rute_id" id="kodeitemedit" value="">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Rute Asal</label>
                                <input type="text" class="form-control @error('asal') is-invalid @enderror"
                                    placeholder="Rute Asal" name="asal" id="asal">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Rute Tujuan</label>
                                <input type="text" class="form-control @error('tujuan') is-invalid @enderror"
                                    placeholder="Rute Tujuan" name="tujuan" id="tujuan" }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Harga</label>
                                <input type="text" class="form-control @error('harga') is-invalid @enderror"
                                    placeholder="Harga" name="harga" id="harga">
                            </div>
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
            var asal = $(event.relatedTarget).data('asal');
            var tujuan = $(event.relatedTarget).data('tujuan');
            var harga = $(event.relatedTarget).data('harga');

            $(this).find('#kodeitemedit').attr("value", id);
            $(this).find('#asal').attr("value", asal);
            $(this).find('#tujuan').attr("value", tujuan);
            $(this).find('#harga').attr("value", harga);
        });
    </script>
@endsection
