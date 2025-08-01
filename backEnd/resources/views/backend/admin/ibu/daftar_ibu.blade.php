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
                        <a href="{{route('registrasi.ibu')}}" class="btn btn-success"><i class="bi bi-person-plus"></i> Tambahkan Data</a>
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
                                <th scope="col">Action</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($data['ibu']) && $data['ibu']->count() > 0)
                            @foreach($data['ibu'] as $dataIbu)
                            <tr>
                                <th scope="row">{{ $dataIbu->nik }}</th> <!-- use scope="row" for the first column -->
                                <td>{{ $dataIbu->namaLengkap }}</td>
                                <td>{{ hitungUsia($dataIbu->tglLahir) }}</td>
                                <td>{{ $dataIbu->jumlahAnak }}</td>
                                <td>{{ $dataIbu->alamat }}</td>
                                <td>{{ $dataIbu->user->noTelp }}</td>
                                <td>
                                    <a href="{{ route('detail_ibu', ['id' => $dataIbu->id]) }}" class="btn btn-info">
                                        <i class="bi bi-info-circle"></i>
                                        <span class="info-text">Info Detail!</span>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('hapus.ibu', ['id' => $dataIbu->id]) }}" method="GET" onsubmit="return confirm('Anda Yakin Ingin Menghapus Data {{$dataIbu->namaLengkap}} ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-exclamation-octagon"></i>
                                            <span class="info-text">Hapus Data Ibu!</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="8" class="text-center">No data available</td>
                            </tr>
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