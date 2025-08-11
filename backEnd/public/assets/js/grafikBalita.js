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