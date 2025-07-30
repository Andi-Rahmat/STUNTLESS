@extends('backend.layouts.app')

@section('title','dashboard')
@section('content')
<div class="pagetitle">
    <h1>Daftar Ibu</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Daftar Ibu</li>
        </ol>
    </nav>
</div>
<section class="section dashboard">
    <!-- TABLE Daftat Ibu -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Daftar Ibu</h5>
                        <a href="{{route('registrasi.index')}}" class="btn btn-success"><i class="bi bi-person-plus"></i> Tambahkan Data</a>
                    </div>

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">NIK</th>
                                <th scope="col">Nama Ibu</th>
                                <th scope="col">Usia</th>
                                <th scope="col">Jumlah Anak</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">No. Telp</th>
                                <th scope="col" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($data['ibu']))
                                @foreach($data['ibu'] as $dataIbu )
                                <tr>
                                    <td>{{$dataIbu->nik}}</td>
                                    <td>{{$dataIbu->namaLengkap}}</td>
                                    <td>{{hitungUsia($dataIbu->tglLahir)}}</td>
                                    <td>{{$dataIbu->jumlahAnak}}</td>
                                    <td>{{$dataIbu->alamat}}</td>
                                    <td>{{$dataIbu->user->noTelp}}</td>
                                    <td>
                                        <button type="button" class="btn btn-info"><i class="bi bi-info-circle"></i>
                                            <span class="info-text">Info Detail!</span>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="return confirm('Anda Yakin Ingin Menghapus Data {{$dataIbu->namaLengkap}} ?');"><i class="bi bi-exclamation-octagon"></i>
                                            <span class="info-text">Hapus Data Ibu!</span>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>
        </div>
    </div>

</section>
@endsection