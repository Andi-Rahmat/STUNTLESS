@extends('backend.layouts.app')

@section('title','dashboard')
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div>
<section class="section dashboard">

    <!-- INFO Dashboard -->
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Kunjungan<span> / hari ini</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6>145 <span class="text-muted small pt-2 ps-1"></span> </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title">Data Ibu<span></span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <img src="{{asset('assets/icon/mother.png')}}" alt="" width="40">
                            <!-- <i class="bi bi-cash-coin"></i> -->
                        </div>
                        <div class="ps-3">
                            <h6>145 <span class="text-muted small pt-2 ps-1">Ibu</span> </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Data Balita <span></span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <img src="{{asset('assets/icon/baby.png')}}" alt="" width="40">
                            <!-- <i class="bi bi-clipboard-x"></i> -->
                        </div>
                        <div class="ps-3">
                            <h6>145 <span class="text-muted small pt-2 ps-1">Balita</span> </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- TABLE Dashboard -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Kunjungan <span>hari ini</span></h5>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">Kode Balita</th>
                                <th scope="col">Nama Ibu</th>
                                <th scope="col">Nama Balita</th>
                                <th scope="col">J. Kelamin</th>
                                <th scope="col">Umur</th>
                                <th scope="col">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
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
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
    <!-- INFO GRAFI -->
    <div class="row">
        <div class="col-12">
            <!-- <div class="card">
            <div class="card-body pb-0">
                <h5 class="card-title">Cabang Lomba</h5>
                <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        echarts.init(document.querySelector("#trafficChart")).setOption({
                            tooltip: {
                                trigger: 'item'
                            },
                            legend: {
                                top: '5%',
                                left: 'center'
                            },
                            series: [{
                                name: 'Access From',
                                type: 'pie',
                                radius: ['40%', '70%'],
                                avoidLabelOverlap: false,
                                label: {
                                    show: false,
                                    position: 'center'
                                },
                                emphasis: {
                                    label: {
                                        show: true,
                                        fontSize: '18',
                                        fontWeight: 'bold'
                                    }
                                },
                                labelLine: {
                                    show: false
                                },
                                data: [{
                                        value: 1048,
                                        name: 'IoT'
                                    },
                                    {
                                        value: 735,
                                        name: 'Networking'
                                    },
                                    {
                                        value: 580,
                                        name: 'CyberSecurity'
                                    }
                                ]
                            }]
                        });
                    });
                </script>
            </div>
        </div> -->
            <div class="row flex justify-content-between">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Grafik Kunjungan <span>- tahun</span></h5>

                            <!-- Line Chart -->
                            <div id="lineChart"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#lineChart"), {
                                        series: [{
                                            name: "Kunjungan",
                                            data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
                                        }],
                                        chart: {
                                            height: 350,
                                            type: 'line',
                                            zoom: {
                                                enabled: false
                                            }
                                        },
                                        dataLabels: {
                                            enabled: false
                                        },
                                        stroke: {
                                            curve: 'straight'
                                        },
                                        grid: {
                                            row: {
                                                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                                opacity: 0.5
                                            },
                                        },
                                        xaxis: {
                                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                                        }
                                    }).render();
                                });
                            </script>
                            <!-- End Line Chart -->

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Grafik Pertumbuhan Balita <span>- kunjungan</span></h5>

                            <!-- Line Chart -->
                            <div id="lineChart1"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#lineChart1"), {
                                        series: [{
                                            name: "Balita",
                                            data: [10, 41, 35, 51, 49]
                                        }],
                                        chart: {
                                            height: 350,
                                            type: 'line',
                                            zoom: {
                                                enabled: false
                                            }
                                        },
                                        dataLabels: {
                                            enabled: false
                                        },
                                        stroke: {
                                            curve: 'straight'
                                        },
                                        grid: {
                                            row: {
                                                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                                opacity: 0.5
                                            },
                                        },
                                        xaxis: {
                                            categories: ['Gizi Buruk', 'Gizi Kurang', 'Normal', 'Gizi Lebih', 'Obesitas'],
                                        }
                                    }).render();
                                });
                            </script>
                            <!-- End Line Chart -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection