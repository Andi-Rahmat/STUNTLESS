@extends('backend.layouts.app')

@section('title','dashboard')
@section('content')

@php
use Carbon\Carbon;
if($dataSekarang != null){
$tglSekarang = Carbon::parse($dataSekarang->tglPengukuran);
$tglSebelum = Carbon::parse($dataSebelum->tglPengukuran);
$satuan = '';
switch ($indikator) {
case "berat":
$satuan = 'Kg';
break;
case "tinggi":
$satuan = 'cm';
break;
case "imt":
$satuan = 'kg/m²';
break;
}
}
@endphp


<div class="pagetitle">
    <h1>Detail Balita</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('daftar_balita')}}">Daftar Balita</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
</div>
<section class="section dashboard">
    <!-- INFO Dashboard -->
    <div class="row">
        <div class="col-lg-12 col-md-12">

            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title"><span></span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <img src="{{asset('assets/icon/baby.png')}}" alt="" width="40">
                            <!-- <i class="bi bi-clipboard-x"></i> -->
                        </div>
                        <div class="ps-3">
                            <h6>{{$balita->namaLengkap}}<span class="text-muted d-block small pt-2 ps-1">{{hitungUsia($balita->tglLahir)}}</span> </h6>
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
                                    <table>
                                        <tr>
                                            <td><b>Nama Ibu</b></td>
                                            <td width="20%" class="text-center">:</td>
                                            <td width="auto">{{$balita->orangTua->namaLengkap}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>NIK Balita</b></td>
                                            <td width="20%" class="text-center">:</td>
                                            <td width="auto">{{$balita->nik}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Anaka Ke</b></td>
                                            <td width="20%" class="text-center">:</td>
                                            <td width="auto">{{$balita->anak_ke}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Golongan Darah</b></td>
                                            <td width="20%" class="text-center">:</td>
                                            <td width="auto">{{$balita->golongan_darah}}</td>
                                        </tr>
                                    </table>
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
            @if($dataSekarang != null)
            <div class="d-flex justify-content-around position-relative align-items-end mt-4">
                <a href="?page=grafik" style="background-color:{{ request('page') != 'riwayat' ? '#faf9ee' : '#d9d9d9' }}; color:{{ request('page') != 'riwayat' ? '#F564A9' : 'grey' }}; border-radius:0 10px 0 0; text-decoration:none;" class="z-3 fw-bold position-absolute bottom-0 start-0 m-0 p-2 px-5 rounded-start-2">Grafik</a>
                <a href="?page=riwayat" style="background-color:{{ request('page') == 'riwayat' ? '#faf9ee' : '#d9d9d9' }}; color:{{ request('page') == 'riwayat' ? '#F564A9' : 'grey' }}; border-radius:0 10px 0 0; text-decoration:none;" class="z-3 fw-bold position-absolute bottom-0 start-10 m-0 p-2 px-5 rounded-end-2">Riwayat</a>
            </div>
            <div class="card" style="background-color:#faf9ee;">
                @if(request('page') != 'riwayat')
                <div class="card-body">
                    <div class="card-title d-flex justify-content-around">
                        <a href="?indikator=berat" class="btn btnKlasifikasi {{$indikator == 'berat' ? 'active' : '' }} ">Berat</a>
                        <a href="?indikator=tinggi" class="btn btnKlasifikasi {{$indikator == 'tinggi' ? 'active' : '' }} ">Tinggi</a>
                        <a href="?indikator=berat/tinggi" class="btn btnKlasifikasi {{$indikator == 'berat/tinggi' ? 'active' : '' }} ">Berat / Tinggi</a>
                        <a href="?indikator=lingkarKepala" class="btn btnKlasifikasi {{$indikator == 'lingkarKepala' ? 'active' : '' }} ">Lingkar Kepala</a>
                        <a href="?indikator=imt" class="btn btnKlasifikasi {{$indikator == 'imt' ? 'active' : '' }} ">IMT</a>
                    </div>
                    @if($indikator == 'berat/tinggi' || $indikator == 'imt')
                    <div class="row text-center bg-white mx-5 border border-0.5 py-2 rounded-3 mb-4 shadow-sm">
                        <div class="col-4">
                            <span>Date: {{$tglSebelum->translatedFormat('d F Y'); }}</span>
                            <h3>{{number_format($dataSebelum->zScore->$indikator,3)}} {{$satuan}}</h3>
                        </div>
                        <div class="col-4">
                            <span>Date: {{$tglSekarang->translatedFormat('d F Y'); }}</span>
                            <h3>{{number_format($dataSekarang->zScore->$indikator,3)}} {{$satuan}}</h3>
                        </div>
                        <div class="col-4">
                            <span>
                                Selisih:
                                {{round($tglSebelum->diffInMonths($tglSekarang))}} bulan
                                {{$tglSebelum->diffInDays($tglSekarang)}} hari
                            </span>
                            <h3>{{number_format($dataSekarang->zScore->$indikator,3) - number_format($dataSebelum->zScore->$indikator,3)}} {{$satuan}}</h3>
                        </div>
                    </div>
                    @else
                    <div class="row text-center bg-white mx-5 border border-0.5 py-2 rounded-3 mb-4 shadow-sm">
                        <div class="col-4">
                            <span>Date: {{$tglSebelum->translatedFormat('d F Y'); }}</span>
                            <h3>{{$dataSebelum->$indikator}} {{$satuan}}</h3>
                        </div>
                        <div class="col-4">
                            <span>Date: {{$tglSekarang->translatedFormat('d F Y'); }}</span>
                            <h3>{{$dataSekarang->$indikator}} {{$satuan}}</h3>
                        </div>
                        <div class="col-4">
                            <span>
                                Selisih:
                                {{round($tglSebelum->diffInMonths($tglSekarang))}} bulan
                                {{$tglSebelum->diffInDays($tglSekarang)}} hari
                            </span>
                            <h3>{{$dataSekarang->$indikator - $dataSebelum->$indikator}} {{$satuan}}</h3>
                        </div>
                    </div>
                    @endif
                    <div class="card mx-5 py-2">
                        <div class="card-body text-center">
                            <p><b>Z-score : <?= number_format($dataSekarang->zScore->$indikator, 3); ?> </b></p>
                            <p><b>SD :
                                    <?= $dataSekarang->zScore->{$indikator.'Sd'};  ?>
                                </b></p>
                            <div id="spedo" style="height: 250px"></div>
                            <p
                                style="padding: 3px 20px ; background-color:#ec7fa9; width:max-content; margin:auto; color:white; border-radius:12px;">
                                <b>{{checkIndikator($dataSekarang->zScore->$indikator,$indikator)}}</b>
                            </p>
                            <p>Data Terakhir : {{$tglSekarang->translatedFormat('l, d F Y');}}</p>
                        </div>
                    </div>
                    <script type="text/javascript" src="https://fastly.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
                    <script type="text/javascript">
                        var dom = document.getElementById('spedo');
                        var myChart = echarts.init(dom, null, {
                            renderer: 'canvas',
                            useDirtyRect: false
                        });
                        var app = {};
                        var option;
                        option = {
                            series: [{
                                type: 'gauge',
                                startAngle: 180,
                                endAngle: 0,
                                center: ['50%', '70%'],
                                radius: '100%',
                                min: {{$dataWHO['SD3neg']}},
                                max: {{$dataWHO['SD3']}},
                                splitNumber: 10,
                                axisLine: {
                                    lineStyle: {
                                        width: 6,
                                        color: [
                                            [{{($dataWHO['SD2neg'] - $dataWHO['SD3neg']) / ($dataWHO['SD3'] - $dataWHO['SD3neg'])}}, '#FF6E76'],
                                            [{{($dataWHO['SD1neg'] - $dataWHO['SD3neg']) / ($dataWHO['SD3'] - $dataWHO['SD3neg'])}}, '#FDDD60'],
                                            [{{($dataWHO['SD0'] - $dataWHO['SD3neg']) / ($dataWHO['SD3'] - $dataWHO['SD3neg'])}}, '#7CFFB2'],
                                            [{{($dataWHO['SD1'] - $dataWHO['SD3neg']) / ($dataWHO['SD3'] - $dataWHO['SD3neg'])}}, '#7CFFB2'],
                                            [{{($dataWHO['SD2'] - $dataWHO['SD3neg']) / ($dataWHO['SD3'] - $dataWHO['SD3neg'])}}, '#FDDD60'],
                                            [{{($dataWHO['SD3'] - $dataWHO['SD3neg']) / ($dataWHO['SD3'] - $dataWHO['SD3neg'])}}, '#FF6E76'],
                                        ]
                                    }
                                },
                                pointer: {
                                    icon: 'path://M12.8,0.7l12,40.1H0.7L12.8,0.7z',
                                    length: '12%',
                                    width: 20,
                                    offsetCenter: [0, '-60%'],
                                    itemStyle: {
                                        color: 'auto'
                                    }
                                },
                                axisTick: {
                                    length: 12,
                                    lineStyle: {
                                        color: 'auto',
                                        width: 2
                                    }
                                },
                                splitLine: {
                                    length: 20,
                                    lineStyle: {
                                        color: 'auto',
                                        width: 5
                                    }
                                },
                                axisLabel: {
                                    color: '#464646',
                                    fontSize: 20,
                                    distance: -60,
                                    rotate: 'tangential',
                                    formatter: function(value) {
                                        if (value === 0.8) {
                                            return 'Grade A';
                                        } else if (value === 0.6) {
                                            return 'Grade B';
                                        } else if (value === 0.3) {
                                            return 'Grade C';
                                        } else if (value === 0.1) {
                                            return 'Grade D';
                                        }
                                        return '';
                                    }
                                },
                                title: {
                                    offsetCenter: [0, '-10%'],
                                    fontSize: 20
                                },
                                detail: {
                                    fontSize: 30,
                                    offsetCenter: [0, '-35%'],
                                    valueAnimation: true,
                                    formatter: function(value) {
                                        return value + ' ' + '{{$satuan}}';
                                    },
                                    color: 'inherit'
                                },
                                data: [{
                                    value: {{$indikator == 'berat/tinggi' ? $dataSekarang->berat : $dataSekarang->$indikator}},
                                    name: '{{$indikator}}'
                                }]
                            }]
                        };

                        if (option && typeof option === 'object') {
                            myChart.setOption(option);
                        }
                        window.addEventListener('resize', myChart.resize);
                    </script>
                </div>
                @else
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Berat (kg)</th>
                                    <th>Tinggi (cm)</th>
                                    <th>Lingkar Kepala (cm)</th>
                                    <th>IMT</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($riwayatPengukuran as $riwayat)
                                <tr>
                                    <td>{{ Carbon::parse($riwayat->tglPengukuran)->translatedFormat('d F Y') }}</td>
                                    <td>{{ $riwayat->berat }}</td>
                                    <td>{{ $riwayat->tinggi }}</td>
                                    <td>{{ $riwayat->lingkarKepala }}</td>
                                    <td>{{ $riwayat->imt }}</td>
                                    <td>{{ checkIndikator($riwayat->zScore->berat, 'berat') }}</td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
                @endif
            </div>
            @else
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center text-danger">
                        belum ada data pengukuran
                    </h3>

                    <p class="text-center mb-4">Silahkan lakukan pengukuran terlebih dahulu</p>
                    <div class="text-center">
                        <a href="{{route('pengukuran',['balita' => $balita->id])}}" class="btn btn-primary" style="background-color: #ec7fa9; border: none;">
                            <strong>Tambah Data Pengukuran</strong>
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

</section>
@endsection