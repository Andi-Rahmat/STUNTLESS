@extends('backend.layouts.app')

@section('title','dashboard')
@section('content')


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
            <div class="d-flex justify-content-around position-relative align-items-end mt-4">
                <p style="background-color:#faf9ee; color:#F564A9; border-radius:0 10px 0 0;" class=" z-3 fw-bold position-absolute bottom-0 start-0 m-0 p-2 px-5 rounded-start-2">Grafik</p>
                <p style="background-color:#d9d9d9; color:grey;  border-radius:0 10px 0 0;" class=" z-3 fw-bold position-absolute bottom-0 start-10 m-0 p-2 px-5 rounded-end-2">Riwayat</p>
            </div>
            <div class="card" style="background-color:#faf9ee;">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-around">
                        <button type="button" class="btn btn-outline-info">Berat</button>
                        <button type="button" class="btn btn-outline-info">Tinggi</button>
                        <button type="button" class="btn btn-outline-info">Berat/Tinggi</button>
                        <button type="button" class="btn btn-outline-info">Lingkar Kepala</button>
                    </div>
                    <div class="row text-center bg-white mx-5 border border-0.5 py-2 rounded-3 mb-4 shadow-sm">
                        <div class="col-4">
                            <span>Date: 9 Juli 2025</span>
                            <h3>50 cm</h3>
                        </div>
                        <div class="col-4">
                            <span>Date: 9 Juli 2025</span>
                            <h3>50 cm</h3>
                        </div>
                        <div class="col-4">
                            <span>Date: 9 Juli 2025</span>
                            <h3>50 cm</h3>
                        </div>
                    </div>
                    <div class="card mx-5 py-2">
                        <div class="card-body text-center" style="height: 50vh;">
                            <p><b>Tinggi badan tergolong</b></p>
                            <p style="padding: 3px 20px ; background-color:#ec7fa9; width:min-content; margin:auto; color:white; border-radius:12px;"><b>normal</b></p>
                            <p>Data Terakhir : 9 Agust 2025</p>
                        <div id="container" style="height: 100%"></div>
                        </div>
                    </div>
                    <script type="text/javascript" src="https://fastly.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
                    <script type="text/javascript">
                        var dom = document.getElementById('container');
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
                                center: ['50%', '50%'],
                                radius: '85%',
                                min: 0,
                                max: 1,
                                splitNumber: 8,
                                axisLine: {
                                    lineStyle: {
                                        width: 6,
                                        color: [
                                            [0.25, '#FF6E76'],
                                            [0.5, '#FDDD60'],
                                            [0.75, '#58D9F9'],
                                            [1, '#7CFFB2']
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
                                        if (value === 0.875) {
                                            // return 'Grade A';
                                        } else if (value === 0.625) {
                                            // return 'Grade B';
                                        } else if (value === 0.375) {
                                            // return 'Grade C';
                                        } else if (value === 0.125) {
                                            // return 'Grade D';
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
                                        return Math.round(value * 100) + '';
                                    },
                                    color: 'inherit'
                                },
                                data: [{
                                    value: 0.7,
                                    name: 'Grade Rating'
                                }]
                            }]
                        };

                        if (option && typeof option === 'object') {
                            myChart.setOption(option);
                        }

                        window.addEventListener('resize', myChart.resize);
                    </script>
                </div>
            </div>

        </div>
    </div>

</section>
@endsection