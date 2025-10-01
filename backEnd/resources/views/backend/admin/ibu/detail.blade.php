@extends('backend.layouts.app')

@section('title','dashboard')
@section('content')
<div class="pagetitle">
    <h1>Detail Ibu</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/{{cekRole()}}/dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('daftar_ibu')}}">Daftar Ibu</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
</div>
<section class="section dashboard">
    <!-- INFO Dashboard -->
    <div class="row">
        <!-- card1 -->
        <div class="col-lg-6 col-md-12 d-flex align-items-stretch">
            <div class="card info-card revenue-card w-100">
                <div class="card-body">
                    <h5 class="card-title"><span></span></h5>
                    <div class="d-flex align-items-center">
                        <div class="ps-3 w-100">
                            <table>
                                <tr>
                                    <td><b>NIK</b></td>
                                    <td width="20%" class="text-center">:</td>
                                    <td width="auto">{{$orangTua->nik}}</td>
                                </tr>
                                <tr>
                                    <td><b>Nama</b></td>
                                    <td width="20%" class="text-center">:</td>
                                    <td width="auto">{{$orangTua->namaLengkap}}</td>
                                </tr>
                                <tr>
                                    <td><b>Usia</b></td>
                                    <td width="20%" class="text-center">:</td>
                                    <td width="auto">{{hitungUsia($orangTua->tglLahir)}}</td>
                                </tr>
                                <tr>
                                    <td><b>No. Telp</b></td>
                                    <td width="20%" class="text-center">:</td>
                                    <td width="auto">{{$orangTua->user->noTelp}}</td>
                                </tr>
                                <tr>
                                    <td><b>Alamat</b></td>
                                    <td width="20%" class="text-center">:</td>
                                    <td width="auto">{{$orangTua->alamat}}</td>
                                </tr>
                                <tr>
                                    <td><b>Jumlah Anak</b></td>
                                    <td width="20%" class="text-center">:</td>
                                    <td width="auto">{{$orangTua->jumlahAnak}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- card2 -->
        <div class="col-lg-6 col-md-12 d-flex align-items-stretch">
            <div class="card info-card customers-card w-100">
                <div class="card-body">
                    <h5 class="card-title">Data Balita <span></span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <img src="{{asset('assets/icon/baby.png')}}" alt="" width="40">
                        </div>
                        <div class="ps-3">
                            <h6>{{$orangTua->balita->count()}} <span class="text-muted small pt-2 ps-1">Balita</span> </h6>
                        </div>
                    </div>
                    <!-- Accordion without outline borders -->
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Show!
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @if($orangTua->balita->count() == 0)
                                    <div class="text-center">
                                        <p class="text-muted">Tidak ada data balita</p>
                                    </div>
                                    @else
                                    @foreach($orangTua->balita as $balita)
                                    <div class="d-flex align-items-center mt-3" style=" cursor: pointer;"  onclick="window.location.href='/admin/detail-balita/{{$balita->id}}'">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <img src="{{asset('assets/icon/baby.png')}}" alt="" width="40">
                                        </div>
                                        <div class="ps-3">
                                            <h5 class="fw-bold">{{$balita->namaLengkap}} <br> <span class="text-muted small pt-2 ps-1">{{hitungUsia($balita->tglLahir)}}</span></h5>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div><!-- End Accordion without outline borders -->
                </div>
            </div>
        </div>
    </div>

    <!-- TABLE Kunjungan -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <h5 class="card-title">Data Pengukuran</h5>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">Kode Balita</th>
                                <th scope="col">Nama Balita</th>
                                <th scope="col">zscore-berat</th>
                                <th scope="col">zscore-tinggi</th>
                                <th scope="col">zscore-berat/tinggi</th>
                                <th scope="col">Usia Balita</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orangTua->balita as $balita)
                            @foreach($balita->pengukuran as $pengukuran)
                            <tr>
                                <th scope="row">{{$pengukuran->balita->nik}}</th>
                                <td>{{$pengukuran->balita->namaLengkap}}</td>
                                <td>{{checkIndikator(number_format($pengukuran->zScore != null ? $pengukuran->zScore->berat : 0,3),'berat')}}</td>
                                <td>{{checkIndikator(number_format($pengukuran->zScore != null ? $pengukuran->zScore->tinggi : 0,3),'tinggi')}}</td>
                                <td>{{checkIndikator(number_format($pengukuran->zScore != null ? $pengukuran->zScore->beratTinggi : 0,3),'berat/tinggi')}}</td>
                                <td>{{hitungUsia($pengukuran->balita->tglLahir,$pengukuran->tglPengukuran)}}</td>
                                <td>{{$pengukuran->tglPengukuran}}</td>
                                <td>
                                    <a href="{{route('detail_balita_pengukuran',['role' => cekRole() ,'id' => $pengukuran->idBalita, 'idPengukuran' => $pengukuran->id ])}}" class="btn btn-info"><i class="bi bi-info-circle"></i>
                                        <span class="info-text">Info Detail!</span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>


</section>
@endsection