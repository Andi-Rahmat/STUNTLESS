@extends('backend.layouts.app')

@section('title','dashboard')
@section('content')

<div class="pagetitle">
    <h1>Daftar Balita</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Daftar Balita</li>
        </ol>
    </nav>
</div>
<section class="section dashboard">
    <!-- TABLE Daftat Balita -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Daftar Balita</h5>
                        <a href="{{route('registrasi.balita')}}" class="btn btn-success"><i class="bi bi-person-plus"></i> Tambahkan Data</a>
                    </div>

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">NIK</th>
                                <th scope="col">Nama Balita</th>
                                <th scope="col">Nama Ibu</th>
                                <th scope="col">Usia</th>
                                <th scope="col">Anak ke</th>
                                <th scope="col">Golongan Darah</th>
                                <th scope="col" colspan="2">Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($data['balita']))
                            @foreach($data['balita'] as $dataBalita )
                            <tr>
                                <td>{{$dataBalita->nik}}</td>
                                <td>{{$dataBalita->namaLengkap}}</td>
                                <td>{{$dataBalita->orangTua->namaLengkap}}</td>
                                <td>{{hitungUsia($dataBalita->tglLahir)}}</td>
                                <td>{{$dataBalita->anak_ke}}</td>
                                <td>{{$dataBalita->golongan_darah}}</td>
                                <td>
                                    <a href="{{ route('detail_balita',['id' => $dataBalita->id]) }}" class="btn btn-info"><i class="bi bi-info-circle"></i>
                                        <span class="info-text">Info Detail!</span>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('hapus.balita',$dataBalita->id)}}" class="btn btn-danger" onclick="return confirm('Anda Yakin Ingin Menghapus Data {{$dataBalita->namaLengkap}} ?');"><i class="bi bi-exclamation-octagon"></i>
                                        <span class="info-text">Hapus Data Balita!</span>
                                    </a>
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