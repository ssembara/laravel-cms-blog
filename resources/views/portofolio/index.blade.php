@extends('layouts.begin_back')

@section('title') Portofolio @endsection

@section('portofolio') active @endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><span class="pr-2 fas fa-file-alt"></span> Portofolio</h4>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('portofolio.create') }}" class="btn bg-gradient-indigo float-right"><i
                            class="fas fa-plus pr-2"></i> Tambah
                        Portofolio</a>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Stats Box -->
            <div class="row">
                <div class="col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fas fa-external-link-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Status Aktif</span>
                            <span class="info-box-number">{{ $activeCount }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-teal"><i class="fas fa-file-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Portofolio</span>
                            <span class="info-box-number">{{ $portofolioCount }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- /Stats Box -->

            <!-- Main row -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Daftar Portofolio
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="dataTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th width="10%">Status</th>
                                        <th width="15%">Dibuat pada</th>
                                        <th width="15%">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($portofolio as $item)
                                        <td>{{ $item->title }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                            <span class="badge badge-success">Aktif</span>
                                            @else
                                            <span class="badge badge-secondary">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at->format('d M Y') }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-secondary"><i
                                                        class="fas fa-eye"></i></button>
                                            </div>
                                            <div class="btn-group">
                                                <a href="{{ route('portofolio.edit', $item->id) }}"
                                                    class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                            </div>
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-danger"
                                                    data-target="#deleteModal{{ $item->id }}" data-toggle="modal"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteModal{{ $item->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Portofolio</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('portofolio.destroy', $item->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin ingin menghapus
                                                            <strong>{{ $item->title }}</strong>
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                        <button type="button" class="btn btn-link text-secondary"
                                                            data-dismiss="modal">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('footer-script')
<script type="text/javascript">
    $(function () {
        $("#dataTable").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>
@endsection