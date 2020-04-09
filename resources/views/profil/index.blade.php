@extends('layouts.begin_back')

@section('title') Profil @endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <!-- .card -->
                    <div class="card card-primary">
                        <!-- .card-header -->
                        <div class="card-header">
                            <h3 class="card-title">Profil</h3>
                        </div>
                        <!-- /.card-header -->
                        <form role="form">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="InputName">Nama</label>
                                    <input type="nama" class="form-control" id="InputName" placeholder="Masukkan nama">
                                </div>
                                <div class="form-group">
                                    <label for="InputEmail">Email</label>
                                    <input type="email" class="form-control" id="InputEmail"
                                        placeholder="Masukkan email">
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="image">
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="{{ asset('img/user4-128x128.jpg') }}" alt="User profile picture">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="InputFile">Avatar</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="InputFile">
                                                    <label class="custom-file-label" for="InputFile">Pilih file</label>
                                                </div>
                                            </div>
                                            <small id="avatarHelp" class="form-text text-muted">Format yang didukung
                                                jpg, png.
                                                Maksimum 2Mb</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <!-- .card -->
                    <div class="card card-primary">
                        <!-- .card-header -->
                        <div class="card-header">
                            <h3 class="card-title">Ganti Password</h3>
                        </div>
                        <!-- /.card-header -->
                        <form role="form">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="InputOldPassword">Sandi lama</label>
                                    <input type="password" class="form-control" id="InputOldPassword"
                                        placeholder="Masukkan sandi lama" name="old-password">
                                </div>
                                <div class="form-group">
                                    <label for="InputNewPassword">Sandi baru</label>
                                    <input type="password" class="form-control" id="InputNewPassword"
                                        placeholder="Masukkan sandi baru" name="new-password">
                                </div>
                                <div class="form-group">
                                    <label for="InputRepeatNewPassword">Ketik Ulang Sandi baru</label>
                                    <input type="password" class="form-control" id="InputRepeatNewPassword"
                                        placeholder="Ketik ulang sandi baru" name="repeat-new-password">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><span><i
                                            class="fas fa-key"></i></span>&nbsp; Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>

@endsection