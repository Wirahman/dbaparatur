<?php $this->load->view('vheader'); ?>
<script src="<?= base_url() ?>assets/Highcharts-3.0.7/js/highcharts.js"></script>
<script src="<?= base_url() ?>assets/Highcharts-3.0.7/js/highcharts-more.js"></script>
<script src="<?= base_url() ?>assets/Highcharts-3.0.7/js/drilldown.js"></script>
<script src="<?= base_url() ?>assets/Highcharts-3.0.7/js/data.js"></script>
<script src="<?= base_url() ?>assets/liscroll/jquery.li-scroller.1.0.js"></script>
<link rel="stylesheet" href="<?= base_url(); ?>assets/liscroll/li-scroller.css"/>
<style>
    .widget-header > .widget-caption, .widget-header > :first-child {
        display: block;
    }

    .widget-box.transparent > .widget-header {
        border: transparent;
    }
</style>

<div class="row">
    <div class="widget-header">
        <h5 class="lighter align-center">Realisasi Pencapaian Kegiatan Tugas Jabatan Tahun <?php echo $currentYYYY; ?></h5>
    </div>
</div>

<?php if ($this->session->userdata('role') == 1)://admin/personalia? ?>
    <div class="row">
        <div class="widget-body">
            <div class="widget-main">
                <div>
                    <label for="form-field-select-1">Pilih:</label>

                    <select class="form-control" id="form-field-select-1">
                        <option value="">Semua Provinsi</option>
                        <option value="AL">Aceh</option>
                        <option value="AK">Bali</option>
                        <option value="AZ">Banten</option>
                        <option value="AR">Bengkulu</option>
                        <option value="CA">Gorontalo</option>
                        <option value="CO">Jakarta</option>
                        <option value="CT">Jambi</option>
                        <option value="DE">Jawa Barat</option>
                        <option value="FL">Jawa Tengah</option>
                        <option value="GA">Jawa Timur</option>
                        <option value="HI">Kalimantan Barat</option>
                        <option value="ID">Kalimantan Selatan</option>
                        <option value="IL">Kalimantan Tengah</option>
                        <option value="IN">Kalimantan Timur</option>
                        <option value="IA">Kalimantan Utara</option>
                        <option value="NC">Kepulauan Bangka Belitung</option>
                        <option value="ND">Kepulauan Riau</option>
                        <option value="OH">Lampung</option>
                        <option value="OK">Maluku</option>
                        <option value="OR">Maluku Utara</option>
                        <option value="PA">Nusa Tenggara Barat</option>
                        <option value="RI">Nusa Tenggara Timur</option>
                        <option value="SC">Papua</option>
                        <option value="SD">Papuan Barat</option>
                        <option value="TN">Riau</option>
                        <option value="TX">Sulawesi Barat</option>
                        <option value="UT">Sulawesi Selatan</option>
                        <option value="VT">Sulawesi Tengah</option>
                        <option value="VA">Sulawesi Tenggara</option>
                        <option value="WA">Sulawesi Utara</option>
                        <option value="WV">Sumatera Barat</option>
                        <option value="WI">Sumatera Selatan</option>
                        <option value="WY">Sumatera Utara</option>
                        <option value="WY">Daerah Istimewa Yogyakarta</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="row">
    <div class="widget-box transparent col-sm-3">
        <div class="widget-header widget-header-flat">
            <div class="widget-body">
                <div class="widget-main no-padding no-border-bottom">
                    <div id="gauge" style="height: 200px;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="widget-box transparent col-sm-9">
        <div class="widget-header widget-header-flat">
            <div class="widget-body">
                <div class="widget-main no-padding">
                    <div id="column" style="height: 425px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <?php if ($this->session->userdata('role') == 1)://admin/personalia? ?>
        <div class="widget-box transparent col-sm-12">
            <div class="widget-header widget-header-flat">
                <div class="widget-body">
                    <div class="widget-main no-padding">
                        <div id="gender" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<hr>
<?php if ($this->session->userdata('role') == 1)://admin/personalia? ?>
    <div class="row">
        <div class="widget-box transparent col-sm-12">
            <div class="widget-header widget-header-flat">
                <div class="widget-body">
                    <div class="widget-main no-padding">
                        <div id="chart1" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="widget-box transparent col-sm-6">
            <div class="widget-header widget-header-flat">
                <div class="widget-body">
                    <div class="widget-main no-padding">
                        <div id="chart2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="widget-box transparent col-sm-6">
            <div class="widget-header widget-header-flat">
                <div class="widget-body">
                    <div class="widget-main no-padding">
                        <div id="chart3" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<script>
    $(function () {
        $('#gauge').highcharts({
            chart: {
                type: 'gauge',
                plotBackgroundColor: null,
                plotBackgroundImage: null,
                plotBorderWidth: 0,
                plotShadow: false
            },

            title: {
                text: ''
            },

            pane: {
                startAngle: -150,
                endAngle: 150,
                background: [{
                    backgroundColor: {
                        linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                        stops: [
                            [0, '#FFF'],
                            [1, '#333']
                        ]
                    },
                    borderWidth: 0,
                    outerRadius: '80%'
                }, {
                    backgroundColor: {
                        linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                        stops: [
                            [0, '#333'],
                            [1, '#FFF']
                        ]
                    },
                    borderWidth: 1,
                    outerRadius: '80%'
                }, {
                    // default background
                }, {
                    backgroundColor: '#DDD',
                    borderWidth: 0,
                    outerRadius: '80%',
                    innerRadius: '79%'
                }]
            },

            // the value axis
            yAxis: {
                min: 0,
                max: <?php if (isset($total_kuantitas->sum_target_kuantitas)): echo $total_kuantitas->sum_target_kuantitas; else: echo 0; endif; ?>,

                minorTickInterval: 'auto',
                minorTickWidth: 1,
                minorTickLength: 10,
                minorTickPosition: 'inside',
                minorTickColor: '#667',

                tickPixelInterval: 30,
                tickWidth: 2,
                tickPosition: 'inside',
                tickLength: 10,
                tickColor: '#667',
                labels: {
                    step: 1,
                    rotation: 'auto',
                    formatter: function () {
                        this.hasData = this.visible;
                    }
                },
                plotBands: [{
                    from: 0,
                    to: 120,
                    color: '#55BF3B' // green
                }, {
                    from: 120,
                    to: 160,
                    color: '#DDDF0D' // yellow
                }, {
                    from: 160,
                    to: 200,
                    color: '#DF5353' // red
                }]
            },

            series: [{
                name: 'Realisasi',
                data: <?php if (isset($total_kuantitas->sum_realisasi_kuantitas)): echo '['.$total_kuantitas->sum_realisasi_kuantitas.']'; else: echo '[0]'; endif; ?>,
                tooltip: {
                    valueSuffix: ''
                }
            }]

        });
        //menggunakan penilaian terbaru
        $('#column').highcharts({
            chart: {
                type: 'column',
                zoomType: 'xy'
            },
            title: {
                text: 'Nilai Prestasi Kerja Pegawai'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [
                    <?php echo $daftar_tahun; ?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Kegiatan Tugas Jabatan'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            scrollbar: {
                enabled: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Perencanaan',
                data: [<?php echo $column_data_target; ?>]

            }, {
                name: 'Realisasi',
                data: [<?php echo $column_data_realisasi; ?>]

            }]
        });

        $('#gender').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Jumlah Pegawai Berdasarkan Gender'
            },
            subtitle: {
                text: 'Sumber: <a href="http://netmarketshare.com">Kementrian Dalam Negeri</a>.'
            },
            xAxis: {
                type: 'category',
                title: {
                    text: 'Jenis Kelamin'
                }
            },
            yAxis: {
                title: {
                    text: 'Total (persen)'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.1f}%'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },

            series: [{
                name: "Gender",
                colorByPoint: true,
                data: [{
                    name: "Pria",
                    y: 56.33,
                    drilldown: "Pria"
                }, {
                    name: "Wanita",
                    y: 24.03,
                    drilldown: "Wanita"
                }]
            }],
            drilldown: {
                series: [{
                    name: "Pria",
                    id: "Pria",
                    data: [
                        [
                            "v11.0",
                            24.13
                        ],
                        [
                            "v8.0",
                            17.2
                        ],
                        [
                            "v9.0",
                            8.11
                        ],
                        [
                            "v10.0",
                            5.33
                        ],
                        [
                            "v6.0",
                            1.06
                        ],
                        [
                            "v7.0",
                            0.5
                        ]
                    ]
                }, {
                    name: "Wanita",
                    id: "Wanita",
                    data: [
                        [
                            "v40.0",
                            5
                        ],
                        [
                            "v41.0",
                            4.32
                        ],
                        [
                            "v42.0",
                            3.68
                        ],
                        [
                            "v39.0",
                            2.96
                        ],
                        [
                            "v36.0",
                            2.53
                        ],
                        [
                            "v43.0",
                            1.45
                        ],
                        [
                            "v31.0",
                            1.24
                        ],
                        [
                            "v35.0",
                            0.85
                        ],
                        [
                            "v38.0",
                            0.6
                        ],
                        [
                            "v32.0",
                            0.55
                        ],
                        [
                            "v37.0",
                            0.38
                        ],
                        [
                            "v33.0",
                            0.19
                        ],
                        [
                            "v34.0",
                            0.14
                        ],
                        [
                            "v30.0",
                            0.14
                        ]
                    ]
                }]
            }
        });


        /* Begin Handler Chart 1 */
        $('#chart1').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Jumlah Pegawai Berdasarkan Wilayah'
            },
            subtitle: {
                text: 'Sumber: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Kementrian Dalam Negeri</a>'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Pegawai (juta)'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: 'Jumlah Pegawai di Tahun 2015: <b>{point.y:.1f} juta</b>'
            },
            series: [{
                name: 'Population',
                data: [
                    ['DKI Jakarta', 33.7],
                    ['Banten', 16.1],
                    ['Jawa Barat', 14.2],
                    ['Jawa Tengah', 14.0],
                    ['Jawa Timur', 12.5],
                    ['Daerah Istimewa Yogyakarta', 12.1],
                    ['Kalimantan Barat', 11.8],
                    ['Kalimantan Selatan', 11.7],
                    ['Kalimantan Tengah', 11.1],
                    ['Kalimantan Timur', 11.1],
                    ['Kalimantan Utara', 10.5],
                    ['Maluku', 10.4],
                    ['Maluku Utara', 10.0],
                    ['Bali', 9.3],
                    ['Nusa Tenggara Barat', 9.3],
                    ['Nusa Tenggara Timur', 9.0],
                    ['Papua', 8.9],
                    ['Papua Barat', 8.9],
                    ['Gorontalo', 8.9],
                    ['Sulawesi Barat', 28.9],
                    ['Sulawesi Selatan', 8.9],
                    ['Sulawesi Tengah', 8.9],
                    ['Sulawesi Tenggara', 8.9],
                    ['Sulawesi Utara', 28.9],
                    ['Aceh', 8.9],
                    ['Bengkulu', 8.9],
                    ['Jambi', 8.9],
                    ['Kep. Bangka Belitung', 8.9],
                    ['Kep. Riau', 18.9],
                    ['Lampung', 8.9],
                    ['Riau', 8.9],
                    ['Sumatera Barat', 28.9],
                    ['Sumatera Selatan', 28.9],
                    ['Sumatera Utara', 18.9]
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format: '{point.y:.1f}', // one decimal
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '10px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
        /* End Of Handler Chart 1 */

        /* Begin Handler Chart 2 */
        $('#chart2').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Jumlah Pegawai Berdasarkan Usia'
            },
            subtitle: {
                text: 'Sumber: <a href="http://netmarketshare.com">Kementrian Dalam Negeri</a>.'
            },
            xAxis: {
                type: 'category',
                title: {
                    text: 'Usia (tahun)'
                }
            },
            yAxis: {
                title: {
                    text: 'Total (persen)'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.1f}%'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },

            series: [{
                name: "Gender",
                colorByPoint: true,
                data: [{
                    name: "21 - 40",
                    y: 56.33,
                    drilldown: "21 - 40"
                }, {
                    name: "41 - 60",
                    y: 24.03,
                    drilldown: "41 - 60"
                }, {
                    name: "61 - 80",
                    y: 24.03,
                    drilldown: "61 - 80"
                }, {
                    name: "81 - 100",
                    y: 24.03,
                    drilldown: "81 - 100"
                }]
            }],
            drilldown: {
                series: [{
                    name: "21 - 40",
                    id: "21 - 40",
                    data: [
                        [
                            "v11.0",
                            24.13
                        ],
                        [
                            "v8.0",
                            17.2
                        ],
                        [
                            "v9.0",
                            8.11
                        ],
                        [
                            "v10.0",
                            5.33
                        ],
                        [
                            "v6.0",
                            1.06
                        ],
                        [
                            "v7.0",
                            0.5
                        ]
                    ]
                }, {
                    name: "41 - 60",
                    id: "41 - 60",
                    data: [
                        [
                            "v40.0",
                            5
                        ],
                        [
                            "v41.0",
                            4.32
                        ],
                        [
                            "v42.0",
                            3.68
                        ],
                        [
                            "v39.0",
                            2.96
                        ],
                        [
                            "v36.0",
                            2.53
                        ],
                        [
                            "v43.0",
                            1.45
                        ],
                        [
                            "v31.0",
                            1.24
                        ],
                        [
                            "v35.0",
                            0.85
                        ],
                        [
                            "v38.0",
                            0.6
                        ],
                        [
                            "v32.0",
                            0.55
                        ],
                        [
                            "v37.0",
                            0.38
                        ],
                        [
                            "v33.0",
                            0.19
                        ],
                        [
                            "v34.0",
                            0.14
                        ],
                        [
                            "v30.0",
                            0.14
                        ]
                    ]
                }, {
                    name: "61 - 80",
                    id: "61 - 80",
                    data: [
                        [
                            "v40.0",
                            5
                        ],
                        [
                            "v41.0",
                            4.32
                        ],
                        [
                            "v42.0",
                            3.68
                        ],
                        [
                            "v39.0",
                            2.96
                        ],
                        [
                            "v36.0",
                            2.53
                        ],
                        [
                            "v43.0",
                            1.45
                        ],
                        [
                            "v31.0",
                            1.24
                        ],
                        [
                            "v35.0",
                            0.85
                        ],
                        [
                            "v38.0",
                            0.6
                        ],
                        [
                            "v32.0",
                            0.55
                        ],
                        [
                            "v37.0",
                            0.38
                        ],
                        [
                            "v33.0",
                            0.19
                        ],
                        [
                            "v34.0",
                            0.14
                        ],
                        [
                            "v30.0",
                            0.14
                        ]
                    ]
                }, {
                    name: "81 - 100",
                    id: "81 - 100",
                    data: [
                        [
                            "v40.0",
                            5
                        ],
                        [
                            "v41.0",
                            4.32
                        ],
                        [
                            "v42.0",
                            3.68
                        ],
                        [
                            "v39.0",
                            2.96
                        ],
                        [
                            "v36.0",
                            2.53
                        ],
                        [
                            "v43.0",
                            1.45
                        ],
                        [
                            "v31.0",
                            1.24
                        ],
                        [
                            "v35.0",
                            0.85
                        ],
                        [
                            "v38.0",
                            0.6
                        ],
                        [
                            "v32.0",
                            0.55
                        ],
                        [
                            "v37.0",
                            0.38
                        ],
                        [
                            "v33.0",
                            0.19
                        ],
                        [
                            "v34.0",
                            0.14
                        ],
                        [
                            "v30.0",
                            0.14
                        ]
                    ]
                }]
            }
        });
        /* End Of Handler Chart 2 */

        /* Begin Handler Chart 3 */
        $('#chart3').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Jumlah Pegawai Berdasarkan Pendidikan'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: "Jumlah",
                colorByPoint: true,
                data: [{
                    name: "S3",
                    y: 56.33
                }, {
                    name: "S2",
                    y: 24.03,
                    sliced: true,
                    selected: true
                }, {
                    name: "S1",
                    y: 10.38
                }, {
                    name: "D3",
                    y: 4.77
                }, {
                    name: "SMA",
                    y: 0.91
                }, {
                    name: "SMP",
                    y: 0.2
                }]
            }]
        });
        /* End Of Handler Chart 3 */

        /* Begin Handler Chart 4 */
        /* End Of Handler Chart 4 */

        /* Begin Handler Chart 5 */
        /* End Of Handler Chart 5 */


    });
</script>
<?php $this->load->view('vfooter'); ?>
