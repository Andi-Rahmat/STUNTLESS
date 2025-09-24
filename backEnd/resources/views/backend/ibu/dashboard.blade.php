@extends('backend.layouts.app')

@section('title','dashboard')
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/{{cekRole()}}/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div>
<section class="section dashboard">

    <!-- INFO Dashboard -->
    <div class="row">
        <div class=" col-lg-4 col-md-12 align-items-stretch d-flex">
            <div class="card info-card sales-card w-100">
                <div class="card-body">
                    <h5 class="card-title"><span>Kunjungan</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{$pengukuranList->count()}}<span class="text-muted small pt-2 ps-1"></span></h6>
                        </div>
                    </div>
                    <h5 class="card-title m-0 p-0"><span style="font-size: 10px;">Ayo Timbanglah anak Anda setiap bulan. Anak sehat, tambah umur, tambah berat, tambah pandai.</span></h5>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12 align-items-stretch d-flex">
            <div class="card info-card customers-card w-100">
                <div class="card-body">
                    <h5 class="card-title">Balita<span></span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <img src="{{asset('assets/icon/baby.png')}}" alt="" width="40">
                            <!-- <i class="bi bi-clipboard-x"></i> -->
                        </div>
                        <div class="ps-3">
                            <h6>{{$balitaList->count()}} <span class="text-muted small pt-2 ps-1"></span> </h6>
                        </div>
                    </div>
                                        <!-- Accordion without outline borders -->
                    <div class=" accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Detail!
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @if($balitaList->count() == 0)
                                    <div class="text-center">
                                        <p class="text-muted">Tidak ada data balita</p>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center w-100 mb-3">
                                        <a href="{{route('registrasi.balita',['role' => cekRole()])}}" class="btn btn-sm btn-success"><i class="bi bi-person-plus"></i> Tambahkan Data</a>
                                    </div>
                                    @else
                                   
                                    @foreach($balitaList as $balita)
                                    <div class="d-flex align-items-center mt-3" style=" cursor: pointer;"  onclick="window.location.href='/ibu/detail-balita/{{$balita->id}}'">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <img src="{{asset('assets/icon/baby.png')}}" alt="" width="40">
                                        </div>
                                        <div class="ps-3">
                                            <h5 class="fw-bold">{{$balita->namaLengkap}} <br> <span class="text-muted small pt-2 ps-1">{{hitungUsia($balita->tglLahir)}}</span></h5>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="d-flex justify-content-end align-items-center w-100 mt-3">
                                        <a href="{{route('registrasi.balita',['role' => cekRole()])}}" class="btn btn-sm btn-success"><i class="bi bi-person-plus"></i> Tambahkan Data</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div><!-- End Accordion without outline borders -->
                </div>
            </div>
        </div>
    </div>
    <!-- TABLE Dashboard -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Kunjungan <span></span></h5>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">Nama Balita</th>
                                <th scope="col">J. Kelamin</th>
                                <th scope="col">Umur</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($pengukuranList))
                            @foreach($pengukuranList as $dataPengukuran )
                            <tr>
                                <td>{{$dataPengukuran->balita->namaLengkap}}</td>
                                <td>{{checkKelamin($dataPengukuran->balita->jenisKelamin)}}</td>
                                <td>{{hitungUsia($dataPengukuran->balita->tglLahir)}}</td>
                                <td>{{Carbon\Carbon::parse($dataPengukuran->tglPengukuran)->translatedFormat('d F Y')}}</td>
                                <td>
                                    <a href="{{route('detail_balita_pengukuran',['role' => 'ibu','id' => $dataPengukuran->idBalita, 'idPengukuran' => $dataPengukuran->id ])}}" class="btn btn-info btn-sm"><i class="bi bi-info-circle"></i>
                                        <span class="info-text">Info Detail!</span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            <!-- <tr>
                                <th scope="row">1</th>
                                <td>Brandon Jacob</td>
                                <td>Designer</td>
                                <td>laki-laki</td>
                                <td>28</td>
                                <td>2016-05-25</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Bridie Kessler</td>
                                <td>Developer</td>
                                <td>laki-laki</td>
                                <td>35</td>
                                <td>2014-12-05</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Ashleigh Langosh</td>
                                <td>Finance</td>
                                <td>laki-laki</td>
                                <td>45</td>
                                <td>2011-08-12</td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Angus Grady</td>
                                <td>HR</td>
                                <td>laki-laki</td>
                                <td>34</td>
                                <td>2012-06-11</td>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <td>Raheem Lehner</td>
                                <td>Dynamic Division Officer</td>
                                <td>laki-laki</td>
                                <td>47</td>
                                <td>2011-04-19</td>
                            </tr> -->
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
    <!-- INFO GRAFI -->


</section>
@endsection