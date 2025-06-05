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
        @if (Session::get('type') == 'admin')
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Data Bus</h5>
                    </div>
                    <div class="card-body">
                        <p>Plat : {{ $bus->no_plat }}</p>
                        <p>Nama Bus : {{ $bus->nama_bus }}</p>
                        <p>Jumlah Kursi : {{ $bus->jumlah_kursi }}</p>
                        {{-- <p>Owner : {{ $bus->owner->nama_owner }}</p> --}}
                    </div>
                </div>
            </div>
        @endif
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Data Jadwal</h5>
                </div>
                <div class="card-body">
                    @if (Session::get('type') == 'admin')
                        <div class="text-end mb-4">
                            <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#tambah"
                                class="btn btn-primary"><i class="bx bx-plus"></i> Tambah
                                Jadwal</a>
                        </div>
                    @endif
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th>Nomor Plat/Bus</th>
                                <th>Tanggal Keberangkatan</th>
                                <th>Rute</th>
                                <th>Jam Berangkat</th>
                                <th>Jam Sampai</th>
                                @if (Session::get('type') == 'admin')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($jadwal as $r)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $r->bus->no_plat }} ({{ $r->bus->nama_bus }})</td>
                                    <td>{{ $r->tgl_jalan }}</td>
                                    <td>{{ $r->rute->asal }} - {{ $r->rute->tujuan }}</td>
                                    <td>{{ $r->jam_jalan }}</td>
                                    <td>{{ $r->jam_sampai }}</td>
                                    @if (Session::get('type') == 'admin')
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-item-btn" data-bs-toggle="modal"
                                                            data-bs-target="#edit" data-id="{{ $r->jadwal_id }}"
                                                            data-tanggal="{{ $r->tgl_jalan }}"
                                                            data-jalan="{{ $r->jam_jalan }}"
                                                            data-sampai="{{ $r->jam_sampai }}"
                                                            data-asal="{{ $r->rute_asal }}"
                                                            data-tujuan="{{ $r->rute_tujuan }}"><i
                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit</a></li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn" data-bs-toggle="modal"
                                                            data-bs-target="#hapus" data-id="{{ $r->bus_id }}">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- end page title -->
    @if (Session::get('type') == 'admin')
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form class="form" action="{{ route('jadwal.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="jadwal_id" id="kodeitemtambah" value="">
                        <input type="hidden" name="bus_id" value="{{ $bus->bus_id }}">
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="plat" class="form-label">Tanggal Berangkat</label>
                                    <input type="date" class="form-control @error('tgl_jalan') is-invalid @enderror"
                                        placeholder="Tanggal Keberangkatan" name="tgl_jalan"
                                        value="{{ old('tgl_jalan') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="rute" class="form-label">Rute</label>
                                    <select class="form-select @error('rute_id') is-invalid @enderror" placeholder="Rute"
                                        name="rute_id" id="firstNameinput">
                                        <option value="">Pilih Rute</option>
                                        @foreach ($rute as $item)
                                            <option value="{{ $item->rute_id }}">
                                                {{ $item->asal }} - {{ $item->tujuan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Jam Jalan</label>
                                    <input type="time" class="form-control @error('jam_jalan') is-invalid @enderror"
                                        placeholder="Jam Jalan" name="jam_jalan" value="{{ old('jam_jalan') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Jam Tiba</label>
                                    <input type="time" class="form-control @error('jam_sampai') is-invalid @enderror"
                                        placeholder="Jam Tiba" name="jam_sampai" value="{{ old('jam_sampai') }}">
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
                    <form class="form" action="{{ route('jadwal.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="jadwal_id" id="kodeitemhapus" value="">
                        <div class="modal-body">
                            <h5>Yakin ingin mengapus jadwal ?</h5>
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
                    <form class="form" action="{{ route('jadwal.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="jadwal_id" id="kodeitemedit" value="">
                        <input type="hidden" name="bus_id" value="{{ $bus->bus_id }}">
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="plat" class="form-label">Tanggal Berangkat</label>
                                    <input type="date" class="form-control @error('tgl_jalan') is-invalid @enderror"
                                        placeholder="Tanggal Keberangkatan" name="tgl_jalan" id="tanggal">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="rute" class="form-label">Rute</label>
                                    <select class="form-select @error('rute_id') is-invalid @enderror" placeholder="Rute"
                                        name="rute_id" id="firstNameinput">
                                        <option value="">Pilih Rute</option>
                                        @foreach ($rute as $item)
                                            <option value="{{ $item->rute_id }}">
                                                {{ $item->asal }} - {{ $item->tujuan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Jam Jalan</label>
                                    <input type="time" class="form-control @error('jam_jalan') is-invalid @enderror"
                                        placeholder="Jam Jalan" name="jam_jalan" id="jalan">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Jam Tiba</label>
                                    <input type="time" class="form-control @error('jam_sampai') is-invalid @enderror"
                                        placeholder="Jam Tiba" name="jam_sampai" id="sampai">
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
    @endif
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
