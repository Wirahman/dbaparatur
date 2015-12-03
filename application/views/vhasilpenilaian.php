<?php $this->load->view('vheader'); ?>
<style>
    .panel-default {
        border-color: transparent;
    }
</style>
<div class="widget-header"><h5> <i class="icon-user"></i>HASIL PENILAIAN Prestasi Kerja Tahun <?php echo $tahunyangdinilaisaatini; ?></h5></div>
<div class="widget-body">
    <span id="form_error" style="color:red;"></span>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default col-sm-12 width-100">
                <div class="panel-body">
                    <form id="tampil" method="POST" action="<?php echo site_url().'/hasilpenilaian'; ?>">
                        <select name="tahun" class="select2style">
                            <?php foreach($availableYYYY as $ay):?>
                                <option value="<?php echo $ay->tahun; ?>" <?php if ($tahunyangdinilaisaatini == $ay->tahun): echo 'selected="selected"'; endif; ?>><?php echo $ay->tahun; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="space-30"></span>
                        <button id="tampilkan" class="btn btn-primary btn-xs padding-20" rel="tooltip" title="Tampilkan Hasil Penilaian SKP" data-placement="bottom">
                            <i class="icon-ok"></i>
                            Tampilkan
                        </button>
                    </form>
                    <hr>
                    <div class="table-responsive overflow-auto">

                        <table id="realisasitable" class="table table-bordered table-striped table-hover">
                            <tbody>
                                <tr>
                                    <td>No.</td>
                                    <td>Awal Penilaian</td>
                                    <td>Akhir Penilaian</td>
                                    <td>Pejabat Penilai</td>
                                    <td>Atasan Pejabat Penilai</td>
                                    <td>Nilai</td>
                                    <td>Keterangan</td>
                                    <td>Aksi</td>
                                </tr>
                                <tr>
                                    <td>1.</td>
                                    <td>01 Januari 2015</td>
                                    <td>30 Mei 2015</td>
                                    <td>Pejabat Penilai</td>
                                    <td>Atasan Pejabat Penilai</td>
                                    <td>98</td>
                                    <td>SANGAT BAIK</td>
                                    <td>
                                        <button id="detailpenilaian" class="btn btn-primary btn-xs padding-20" rel="tooltip" title="Lihat Detail Penilaian" data-placement="bottom">
                                            <i class="icon-eye-open"></i>
                                            Detail Penilaian
                                        </button>
                                        <button id="unduh_excel" class="btn btn-primary btn-xs padding-20" rel="tooltip" title="Unduh ke Dalam Format Excel" data-placement="bottom">
                                            <i class="icon-download-alt"></i>
                                            Unduh ke dalam Format Excel
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>01 Juni 2015</td>
                                    <td>30 Desember 2015</td>
                                    <td>Pejabat Penilai</td>
                                    <td>Atasan Pejabat Penilai</td>
                                    <td>87</td>
                                    <td>BAIK</td>
                                    <td>
                                        <button id="detailpenilaian" class="btn btn-primary btn-xs padding-20" rel="tooltip" title="Lihat Detail Penilaian" data-placement="bottom">
                                            <i class="icon-eye-open"></i>
                                            Detail Penilaian
                                        </button>
                                        <button id="unduh_excel" class="btn btn-primary btn-xs padding-20" rel="tooltip" title="Unduh ke Dalam Format Excel" data-placement="bottom">
                                            <i class="icon-download-alt"></i>
                                            Unduh ke dalam Format Excel
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery(document).on('click','#detailpenilaian', function(e){
           window.location.href=siteUrl+'/detailpenilaian'; 
        });
    </script>
      <script>
        jQuery(document).on('click','#unduh_excel', function(e){
           window.location.href=siteUrl+'/hasilpenilaian/unduhexcel'; 
        });
    </script>
    <?php $this->load->view('vfooter'); ?>