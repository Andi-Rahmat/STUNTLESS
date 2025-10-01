@extends('backend.layouts.app')

@section('title','dashboard')
@section('content')

<?php 

use Carbon\Carbon;

if($dataSekarang != null) {
    $tglSekarang = Carbon::parse($dataSekarang->tglPengukuran);
    $tglSebelum = $dataSebelum != null ? Carbon::parse($dataSebelum->tglPengukuran) : null;
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

    function getDataGrafikWHO($indikator, $sd, $kelamin, $dataWHO, $months = 0) {
        $dataGrafik = [];
        $dataList = [];
        if ($indikator == 'berat/tinggi') {
            $dataList = $dataWHO[$indikator][$kelamin][$months >= 24 ? 1 : 0];
        } else {
            $dataList = $dataWHO[$indikator][$kelamin];
        }
        foreach ($dataList as $key) {
            $dataGrafik[] = $key[$sd];
        }
        return $dataGrafik;
    }

    function getHasilUkurBalita($pengukuran, $indikator,$count = 61) {
        $dataList = array_fill(0, $count, 0);

        foreach ($pengukuran as $key) {
            $months = (int) floor(Carbon::parse($key->balita->tglLahir)->diffInMonths(Carbon::parse($key->tglPengukuran)));
            if($indikator == 'berat/tinggi') {
                if($dataList[$months] == 0) {
                $dataList[$months] = $key->berat;
                }
            }
            if($dataList[$months] == 0) {
                $dataList[$months] = $key->$indikator;
            }
        }
        return $dataList;
    }
    $interpretasi = getInterpretasi($indikator, $dataSekarang->zScore->$indikator);
}
?>

<div class="pagetitle">
    <h1>Detail Balita</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/{{cekRole()}}/dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('daftar_balita',['role' => cekRole()])}}">Daftar Balita</a></li>
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
            <div class="d-flex flex-wrap justify-content-around align-items-end mt-4">
                <a href="?page=grafik" 
                   style="background-color:{{ request('page') != 'riwayat' && request('page') != 'perkembangan' ? '#faf9ee' : '#d9d9d9' }}; color:{{ request('page') != 'riwayat' && request('page') != 'perkembangan' ? '#F564A9' : 'grey' }}; border-radius:10px 0 0 0; text-decoration:none;" 
                   class="fw-bold m-0 p-2 px-3 px-md-5 text-center flex-grow-1 flex-md-grow-0">
                   Grafik
                </a>
                <a href="?page=riwayat" 
                   style="background-color:{{ request('page') == 'riwayat' ? '#faf9ee' : '#d9d9d9' }}; color:{{ request('page') == 'riwayat' ? '#F564A9' : 'grey' }}; border-radius:0 0 0 0; text-decoration:none;" 
                   class="fw-bold m-0 p-2 px-3 px-md-5 text-center flex-grow-1 flex-md-grow-0">
                   Riwayat
                </a>
                <a href="?page=perkembangan" 
                   style="background-color:{{ request('page') == 'perkembangan' ? '#faf9ee' : '#d9d9d9' }}; color:{{ request('page') == 'perkembangan' ? '#F564A9' : 'grey' }}; border-radius:0 10px 0 0; text-decoration:none;" 
                   class="fw-bold m-0 p-2 px-3 px-md-5 text-center flex-grow-1 flex-md-grow-0">
                   Perkembangan
                </a>
            </div>
            <div class="card" style="background-color:#faf9ee;">
                @if(request('page') != 'riwayat' && request('page') != 'perkembangan')
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between gap-3 overflow-scroll mx-3 hide-scrollbar">
                        <a href="?indikator=berat" class="btn flex-shrink-0 btnKlasifikasi {{$indikator == 'berat' ? 'active' : '' }} ">Berat</a>
                        <a href="?indikator=tinggi" class="btn flex-shrink-0 btnKlasifikasi {{$indikator == 'tinggi' ? 'active' : '' }} ">Tinggi</a>
                        <a href="?indikator=berat/tinggi" class="btn flex-shrink-0 btnKlasifikasi {{$indikator == 'berat/tinggi' ? 'active' : '' }} ">Berat / Tinggi</a>
                        <a href="?indikator=lingkarKepala" class="btn flex-shrink-0 btnKlasifikasi {{$indikator == 'lingkarKepala' ? 'active' : '' }} ">Lingkar Kepala</a>
                        <a href="?indikator=imt" class="btn flex-shrink-0 btnKlasifikasi {{$indikator == 'imt' ? 'active' : '' }} ">IMT</a>
                    </div>
                    @if($indikator == 'berat/tinggi' || $indikator == 'imt')
                    <div class="row text-center bg-white mx-3 border border-0.5 py-2 rounded-3 mb-4 shadow-sm">
                        <div class="col-4">
                            @if($dataSebelum != null)
                            <span>Date: {{$tglSebelum->translatedFormat('d F Y'); }}</span>
                            <h3>{{number_format($dataSebelum->zScore->$indikator,3)}} {{$satuan}}</h3>
                            @endif
                        </div>
                        <div class="col-4">
                            <span>Date: {{$tglSekarang->translatedFormat('d F Y'); }}</span>
                            <h3>{{number_format($dataSekarang->zScore->$indikator,3)}} {{$satuan}}</h3>
                        </div>
                        <div class="col-4">
                            @if($dataSebelum != null)
                            <span>
                                Selisih:
                                {{round($tglSebelum->diffInMonths($tglSekarang))}} bulan
                                {{$tglSebelum->diffInDays($tglSekarang)}} hari
                            </span>
                            <h3>{{number_format($dataSekarang->zScore->$indikator,3) - number_format($dataSebelum->zScore->$indikator,3)}} {{$satuan}}</h3>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="row text-center bg-white mx-3 border border-0.5 py-2 rounded-3 mb-4 shadow-sm">
                        <div class="col-4">
                            @if($dataSebelum != null)
                            <span>Date: {{$tglSebelum->translatedFormat('d F Y'); }}</span>
                            <h3>{{$dataSebelum->$indikator}} {{$satuan}}</h3>
                            @endif
                        </div>
                        <div class="col-4">
                            <span>Date: {{$tglSekarang->translatedFormat('d F Y'); }}</span>
                            <h3>{{$dataSekarang->$indikator}} {{$satuan}}</h3>
                        </div>
                        <div class="col-4">
                            @if($dataSebelum != null)
                            <span>
                                Selisih:
                                {{round($tglSebelum->diffInMonths($tglSekarang))}} bulan
                                {{$tglSebelum->diffInDays($tglSekarang)}} hari
                            </span>
                            <h3>{{$dataSekarang->$indikator - $dataSebelum->$indikator}} {{$satuan}}</h3>
                            @endif
                        </div>
                    </div>
                    @endif
                    <div class="card mx-3 py-2">
                        <div class="card-body text-center">
                            <p><b>Z-score : <?= number_format($dataSekarang->zScore->$indikator, 3); ?> </b></p>
                            <p><b>SD :
                                    <?= $dataSekarang->zScore->{$indikator . 'Sd'};  ?>
                                </b></p>
                            <div id="spedo" style="height: 250px"></div>
                            <p
                                style="padding: 3px 20px ; background-color:{{$interpretasi['color']}}; width:max-content; margin:auto; color:white; border-radius:12px;">
                                <b>{{$interpretasi['status']}}</b>
                            </p>
                            <p>Data Terakhir : {{$tglSekarang->translatedFormat('l, d F Y');}}</p>
                        </div>
                    </div>
                    <div class="card mx-3 py-2">
                        <div class="card-body table-responsive">
                            <h5 class="card-title">Interpretasi {{$indikator}}</h5>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th width="30%">Status</th>
                                        <td width="10%" class="text-center">:</td>
                                        <td><span class="badge" style="background-color: {{$interpretasi['color']}}">{{ $interpretasi['status'] }}</span></td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Interpretasi</th>
                                        <td width="10%" class="text-center">:</td>
                                        <td>{{$interpretasi['interpretasi']}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Saran</th>
                                        <td width="10%" class="text-center">:</td>
                                        <td>
                                            @foreach($interpretasi['saran'] as $saran)
                                            <p>{{$saran}}</p>
                                            @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card mx-3 py-2">
                        <div class="card-body">
                            <h5 class="card-title">Riwayat {{$indikator}}</h5>
                            <div style="height: 400px; width: 100%;">
                                <div id="containerTinggi" style="height: 100%"></div>
                                <script type="text/javascript" src="https://fastly.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
                                <script type="text/javascript">
                                    <?php 
                                    
                                    if($indikator == 'berat/tinggi'){
                                        // Array dari 45 hingga 110
                                        $arrBeratTinggi = hitungUsiaBulan($balita->tglLahir) >= 24 ? range(65,119) : range(45,110);  // Membuat array [45, 46, ..., 110]

                                        // Variabel tinggi dan berat
                                        $tinggi = $dataSekarang->tinggi;  
                                        $berat = $dataSekarang->berat;   
                                        // Mencari indeks nilai yang paling mendekati tinggi
                                        $closestIndex = array_reduce(array_keys($arrBeratTinggi), function ($prev, $curr) use ($arrBeratTinggi, $tinggi) {
                                            return abs($arrBeratTinggi[$curr] - $tinggi) < abs($arrBeratTinggi[$prev] - $tinggi) ? $curr : $prev;
                                        }, 0);

                                        // Membuat array baru berdasarkan indeks yang didapatkan
                                        $newArray = array_map(function ($value, $index) use ($closestIndex, $berat) {
                                            return $index === $closestIndex ? $berat : null;
                                        }, $arrBeratTinggi, array_keys($arrBeratTinggi));
                                    };
                                    ?>
                                    var dom = document.getElementById('containerTinggi');
                                    var myChart = echarts.init(dom, null, {
                                        renderer: 'canvas',
                                        useDirtyRect: false
                                    });
                                    var app = {};
                                    
                                    var option;

                                    option = {
                                        color: [
                                            '#FF6E76',  // -SD3 color
                                            '#FDDD60',  // -SD2 color
                                            '#7CFFB2',  // -SD1 color 
                                            '#58D9F9',  // SD0 color
                                            '#7CFFB2',  // SD1 color
                                            '#FDDD60',  // SD2 color
                                            '#FF6E76',   // SD3 color
                                            '#1f1f1f',  // BALITA color

                                        ],
                                        title: {
                                            text: ''
                                        },
                                        tooltip: {
                                            trigger: 'axis'
                                        },
                                        legend: {
                                            data: ['-SD3', '-SD2', '-SD1', 'SD0', 'SD1', 'SD2', 'SD3','<?= $balita->namaLengkap ;?>']
                                        },
                                        
                                        grid: {
                                            left: '3%',
                                            right: '4%',
                                            bottom: '3%',
                                            containLabel: true
                                        },
                                        toolbox: {
                                            feature: {
                                                saveAsImage: {}
                                            }
                                        },
                                        xAxis: {
                                            type: 'category',
                                            boundaryGap: false,
                                            data: <?= $indikator != "berat/tinggi" ? 'Array.from({length: 61}, (_, i) => i)' : json_encode($arrBeratTinggi); ?>,
                                            name: 'Usia',
                                        },
                                        yAxis: {
                                            type: 'value',
                                            name: '{{$indikator}}',

                                        },
                                        series: [
                                            {
                                                name: '-SD3',
                                                type: 'line',
                                                data: <?= json_encode(getDataGrafikWHO($indikator,'SD3neg', checkKelamin($balita->jenisKelamin),$dataListWHO, hitungUsiaBulan($balita->tglLahir))); ?>

                                            },
                                            {
                                                name: '-SD2',
                                                type: 'line', 
                                                data: <?= json_encode(getDataGrafikWHO($indikator,'SD2neg', checkKelamin($balita->jenisKelamin),$dataListWHO, hitungUsiaBulan($balita->tglLahir))); ?>
                                            },
                                            {
                                                name: '-SD1',
                                                type: 'line',
                                                data: <?= json_encode(getDataGrafikWHO($indikator,'SD1neg', checkKelamin($balita->jenisKelamin),$dataListWHO, hitungUsiaBulan($balita->tglLahir))); ?>

                                            },
                                            {
                                                name: 'SD0',
                                                type: 'line',
                                                data: <?= json_encode(getDataGrafikWHO($indikator,'SD0', checkKelamin($balita->jenisKelamin),$dataListWHO, hitungUsiaBulan($balita->tglLahir))); ?>

                                            },
                                            {
                                                name: 'SD1',
                                                type: 'line',
                                                data: <?= json_encode(getDataGrafikWHO($indikator,'SD1', checkKelamin($balita->jenisKelamin),$dataListWHO, hitungUsiaBulan($balita->tglLahir))); ?>

                                            },
                                            {
                                                name: 'SD2',
                                                type: 'line',
                                                data: <?= json_encode(getDataGrafikWHO($indikator,'SD2', checkKelamin($balita->jenisKelamin),$dataListWHO, hitungUsiaBulan($balita->tglLahir))); ?>
                                            },
                                            {
                                                name: 'SD3',
                                                type: 'line',
                                                data: <?= json_encode(getDataGrafikWHO($indikator,'SD3', checkKelamin($balita->jenisKelamin),$dataListWHO, hitungUsiaBulan($balita->tglLahir))); ?>
                                            },
                                            {
                                                name: '<?= $balita->namaLengkap ;?>',
                                                type: 'line',
                                                data: <?= $indikator != "berat/tinggi" ? json_encode(getHasilUkurBalita($riwayatPengukuran,$indikator)) : json_encode($newArray) ; ?>

                                            },
                                        ]
                                    };

                                    if (option && typeof option === 'object') {
                                        myChart.setOption(option);
                                    }

                                    window.addEventListener('resize', myChart.resize);
                                </script>
                            </div>
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
                @elseif(request('page') == 'riwayat')
                <!-- riwayat -->
                <div class="card-body">
                    @if(cekRole() == 'admin')
                    <div class="text-end mt-4 mx-3">
                        <a href="{{route('pengukuran',['balita' => $balita->id])}}" class="btn btn-primary" style="background-color: #ec7fa9; border: none;">
                            <strong>Tambah Data Pengukuran</strong>
                        </a>
                    </div>
                    @endif
                    <div class="card mt-4 mx-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Usia</th>
                                            <th>Berat (kg)</th>
                                            <th>Tinggi (cm)</th>
                                            <th>Lingkar Kepala (cm)</th>
                                            <th>IMT</th>
                                            <th>Status</th>
                                            <th>aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($riwayatPengukuran as $riwayat)
                                        <tr>
                                            <td>{{ Carbon::parse($riwayat->tglPengukuran)->translatedFormat('d F Y') }}</td>
                                            <td>{{ hitungUsia($riwayat->balita->tglLahir,$riwayat->tglPengukuran) }}</td>
                                            <td>{{ $riwayat->berat }}</td>
                                            <td>{{ $riwayat->tinggi }}</td>
                                            <td>{{ $riwayat->lingkarKepala }}</td>
                                            <td>{{ $riwayat->imt }}</td>
                                            <td>{{ checkIndikator($riwayat->zScore->berat, 'berat') }}</td>
                                            <td>
                                                <button data-bs-toggle="modal" data-bs-target="#detailPengukuran" data-link="/modal/pengukuran/{{$riwayat->id}}" class="btn btn-sm btn-info">
                                                    <i class="bi bi-info-circle"></i>
                                                    <span class="info-text">Info Detail!</span>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                @else
                <!-- perkembangan -->
                 <div class="card-body">
                    <div class="text-end mt-4 mx-3">
                        <select name="" id="tahapPerkembangan" class="form-select w-auto d-inline"  style="background-color: #ec7fa9; border: none; color:white; font-weight:600;">
                            <option value="">Tahap Perkembangan</option>
                            <option {{hitungUsiaBulan($balita->tglLahir) >= 0 && hitungUsiaBulan($balita->tglLahir) <= 3 ? 'selected' : ''}} value="0-3" >0-3 Bulan</option>
                            <option {{hitungUsiaBulan($balita->tglLahir) >= 4 && hitungUsiaBulan($balita->tglLahir) <= 6 ? 'selected' : ''}} value="4-6" >4-6 Bulan</option>
                            <option {{hitungUsiaBulan($balita->tglLahir) >= 7 && hitungUsiaBulan($balita->tglLahir) <= 9 ? 'selected' : ''}} value="7-9" >7-9 Bulan</option>
                            <option {{hitungUsiaBulan($balita->tglLahir) >= 10 && hitungUsiaBulan($balita->tglLahir) <= 12 ? 'selected' : ''}} value="10-12" >10-12 Bulan</option>
                            <option {{hitungUsiaBulan($balita->tglLahir) >= 13 && hitungUsiaBulan($balita->tglLahir) <= 18 ? 'selected' : ''}} value="13-18" >13-18 Bulan</option>
                            <option {{hitungUsiaBulan($balita->tglLahir) >= 19 && hitungUsiaBulan($balita->tglLahir) <= 24 ? 'selected' : ''}} value="19-24" >19-24 Bulan</option>
                            <option {{hitungUsiaBulan($balita->tglLahir) >= 25 && hitungUsiaBulan($balita->tglLahir) <= 36 ? 'selected' : ''}} value="25-36" >25-36 Bulan</option>
                            <option {{hitungUsiaBulan($balita->tglLahir) >= 37 && hitungUsiaBulan($balita->tglLahir) <= 48 ? 'selected' : ''}} value="37-48" >37-48 Bulan</option>
                            <option {{hitungUsiaBulan($balita->tglLahir) >= 49 && hitungUsiaBulan($balita->tglLahir) <= 60 ? 'selected' : ''}} value="49-60" >49-60 Bulan</option>
                        </select>
                    </div>  
                    <div class="card mt-4 mx-3">
                        <div class="card-body">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered --flex-column flex-sm-row">

                                <li class="nav-item flex-fill text-sm-center">
                                    <button class="nav-link active w-100" data-bs-toggle="tab" data-bs-target="#motorik">
                                        <span class="--d-none d-sm-block">Motorik</span>
                                    </button>
                                </li>

                                <li class="nav-item flex-fill text-sm-center">
                                    <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#kognitif">
                                        <span class="--d-none d-sm-block">Kognitif</span>
                                    </button>
                                </li>

                                <li class="nav-item flex-fill text-sm-center">
                                    <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#sosial">
                                        <span class="d-none d-sm-block">Sosial dan Emosional</span>
                                        <span class="d-sm-none">Sosial</span>
                                    </button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active motorik" id="motorik">

                                </div>

                                <div class="tab-pane fade kognitif pt-3" id="kognitif">
                                </div>

                                <div class="tab-pane fade pt-3 sosial" id="sosial">

                                </div>

                            </div>
                            <!-- End Bordered Tabs -->
                        </div>
                    </div>
                 </div>
                @endif
                </div>
                <!-- belum ada pengukuran -->
                @else
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center text-danger">
                            belum ada data pengukuran
                        </h3>

                        <p class="text-center mb-4">Silahkan lakukan pengukuran terlebih dahulu</p>
                        @if(cekRole() == 'admin')
                        <div class="text-center">
                            <a href="{{route('pengukuran',['balita' => $balita->id])}}" class="btn btn-primary" style="background-color: #ec7fa9; border: none;">
                                <strong>Tambah Data Pengukuran</strong>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>

        @if(request('page') == 'riwayat' )
        <!-- Modal -->
        <div class="modal fade" id="detailPengukuran" tabindex="-1" aria-labelledby="detailPengukuranLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailPengukuranLabel">Detail Hasil Pengukuran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <thead>
                                <th>Parameter</th>
                                <th>Pengukuran</th>
                                <th>Z-score</th>
                            </thead>
                            <tr>
                                <th>Berat Badan</th>
                                <td><span id="berat"></span> kg</td>
                                <td><span id="beratZscore"></span> </td>
                            </tr>
                            <tr>
                                <th>Tinggi Badan</th>
                                <td><span id="tinggi"></span> cm</td>
                                <td><span id="tinggiZscore"></span> </td>
                            </tr>
                            <tr>
                                <th>Suhu Badan</th>
                                <td><span id="suhu"></span> °C</td>
                                <td><span id="suhuZscore"></span> </td>
                            </tr>
                            <tr>
                                <th>Lingkar Kepala</th>
                                <td><span id="lingkarKepala"></span> cm</td>
                                <td><span id="lingkarKepalaZscore"></span> </td>
                            </tr>
                            <tr>
                                <th>Indeks Massa Tubuh</th>
                                <td><span id="imt"></span> kg/m²</td>
                                <td><span id="imtZscore"></span></td>
                            </tr>
                        </table>
                        <div class="mt-4">
                            <h6>Status Gizi:</h6>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge" style="background-color: #FF6E76">Gizi Buruk</span>
                                <span class="badge" style="background-color: #FDDD60">Gizi Kurang</span>
                                <span class="badge" style="background-color: #7CFFB2">Gizi Baik</span>
                                <span class="badge" style="background-color: #FDDD60">Gizi Lebih</span>
                                <span class="badge" style="background-color: #FF6E76">Obesitas</span>
                            </div>
                            <div class="alert alert-info mt-2">
                                Status gizi saat ini:
                                <strong>
                                    <span class="badge" style="background-color: 
                                    {{ in_array(checkIndikator($riwayat->zScore->berat, 'berat'), ['Gizi Buruk', 'Obesitas']) ? '#FF6E76' : 
                                       (in_array(checkIndikator($riwayat->zScore->berat, 'berat'), ['Gizi Kurang', 'Gizi Lebih']) ? '#FDDD60' : '#7CFFB2') }}">
                                        {{ checkIndikator($riwayat->zScore->imt, 'imt') }}
                                    </span>
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if(CekRole() == 'admin')
                        <form action="{{ route('hapus.pengukuran', ['id' => $dataSekarang->id]) }}" method="GET" style="display: inline;" onsubmit="return confirm('Anda Yakin Ingin Menghapus Data ini ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-exclamation-octagon"></i>
                                Hapus Data
                            </button>
                        </form>
                        @endif
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(request('page') == 'perkembangan')
        <script>
            
            document.addEventListener('DOMContentLoaded', function () {
            // Fungsi untuk memuat data berdasarkan tahap
            const loadDevelopmentData = (tahap = '') => {
                const motorikDiv = document.querySelector('.motorik');
                const kognitifDiv = document.querySelector('.kognitif');
                const sosialDiv = document.querySelector('.sosial');

                if (tahap) {
                    fetch(`/modal/perkembangan/${tahap}`)
                        .then(response => response.json())
                        .then(data => {
                            motorikDiv.innerHTML = data.motorik || '<p>Tidak ada data untuk tahap ini.</p>';
                            kognitifDiv.innerHTML = data.kognitif || '<p>Tidak ada data untuk tahap ini.</p>';
                            sosialDiv.innerHTML = data.sosial || '<p>Tidak ada data untuk tahap ini.</p>';
                        })
                        .catch(error => {
                            console.error('Error fetching development data:', error);
                            motorikDiv.innerHTML = '<p>Terjadi kesalahan saat memuat data.</p>';
                            kognitifDiv.innerHTML = '<p>Terjadi kesalahan saat memuat data.</p>';
                            sosialDiv.innerHTML = '<p>Terjadi kesalahan saat memuat data.</p>';
                        });
                } else {
                    motorikDiv.innerHTML = '<h5 class="card-title text-center">Pilih Tahap Perkembangan terlebih dahulu</h5>';
                    kognitifDiv.innerHTML = '<h5 class="card-title text-center">Pilih Tahap Perkembangan terlebih dahulu</h5>';
                    sosialDiv.innerHTML = '<h5 class="card-title text-center">Pilih Tahap Perkembangan terlebih dahulu</h5>';
                }
            };

            // Jalankan loadDevelopmentData pertama kali dengan tahap yang dipilih (jika ada)
            const tahap = document.getElementById('tahapPerkembangan').value;
            loadDevelopmentData(tahap);

            // Tambahkan event listener untuk perubahan pada select
            document.getElementById('tahapPerkembangan').addEventListener('change', function () {
                const tahap = this.value;
                loadDevelopmentData(tahap);
    });
});

        </script>
        @endif

        <script>
            document.querySelectorAll('[data-bs-target="#detailPengukuran"]').forEach(button => {
                button.addEventListener('click', function() {
                    const url = this.getAttribute('data-link');
                    console.log(url);
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('berat').textContent = data.data.berat;
                            document.getElementById('tinggi').textContent = data.data.tinggi;
                            document.getElementById('suhu').textContent = data.data.suhu;
                            document.getElementById('lingkarKepala').textContent = data.data.lingkarKepala;
                            document.getElementById('imt').textContent = data.data.imt;
                            document.getElementById('beratZscore').textContent = data.data.zscore.berat;
                            document.getElementById('tinggiZscore').textContent = data.data.zscore.tinggi;
                            document.getElementById('suhuZscore').textContent = data.data.zscore.suhu;
                            document.getElementById('lingkarKepalaZscore').textContent = data.data.zscore.lingkarKepala;
                            document.getElementById('imtZscore').textContent = data.data.zscore.imt;
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        </script>
</section>
@endsection