<?php $this->load->view('vheader'); ?>
<style>
    .panel-default {
        border-color: transparent;
    }
</style>
<div class="widget-header"><h5> <i class="icon-user"></i>HASIL PENILAIAN SKP</h5></div>
<div class="widget-body">
    <span id="form_error" style="color:red;"></span>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default col-sm-12 width-100">
                <div class="panel-body">
                    <form id="tampil" method="POST" action="<?php echo site_url().'/penilaianSKP'; ?>">
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

                        <h5 class="lighter">PEJABAT PENILAI</h5>
                        <table id="realisasitable">
                            <tbody>
                                <tr>
                                    <td class="col-sm-4">Nama</td>
                                    <td>:</td>
                                    <td><?php echo $pejabat_penilai_nama; ?></td>
                                </tr>
                                <tr>
                                    <td class="col-sm-4">NIP</td>
                                    <td>:</td>
                                    <td><?php echo $pejabat_penilai_nip; ?></td>
                                </tr>
                                <tr>
                                    <td class="col-sm-4">Pangkat, Golongan Ruang</td>
                                    <td>:</td>
                                    <td><?php echo $pejabat_penilai_pangkat; ?></td>
                                </tr>
                                <tr>
                                    <td class="col-sm-4">Jabatan / Pekerjaan</td>
                                    <td>:</td>
                                    <td><?php if(isset($pejabat_penilai_unit_organisasi)): echo $pejabat_penilai_unit_organisasi; else: echo "-"; endif;  ?></td>
                                </tr>
                                <tr>
                                    <td class="col-sm-4">Unit Organisasi</td>
                                    <td>:</td>
                                    <td><?php if(isset($pejabat_penilai_desc_jabatan)): echo $pejabat_penilai_desc_jabatan; else: echo "-"; endif;  ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <table id="realisasitable" class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Sasaran Kerja Pegawai/Nilai Prestasi Akademik (Nilai Capaian SKP X 60%)</td>
                                    <td><?php echo $nilai_capaian_skp." X 60%"; ?></td>
                                    <td><?php echo $nilai_prestasi_akademik; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('vfooter'); ?>