<?php $this->load->view('vheader'); ?>
<style>
    .panel-default {
        border-color: transparent;
    }
</style>
<div class="widget-header"><h5> <i class="icon-user"></i>HASIL PENILAIAN PERILAKU KERJA</h5></div>
<div class="widget-body">
    <span id="form_error" style="color:red;"></span>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default col-sm-12 width-100">
                <div class="panel-body">
                    <form id="tampil" method="POST" action="<?php echo site_url().'/penilaianPerilakuKerja'; ?>">
                        <select name="tahun" class="select2style">
                            <?php foreach($availableYYYY as $ay):?>
                                <option value="<?php echo $ay->tahun; ?>" <?php if ($tahunyangdinilaisaatini == $ay->tahun): echo 'selected="selected"'; endif; ?>><?php echo $ay->tahun; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="space-30"></span>
                        <button id="tampilkan" class="btn btn-primary btn-xs padding-20" rel="tooltip" title="Tampilkan" data-placement="bottom">
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
                        <div class="align-right col-sm-12 row">
                            Pembaruan terakhir : 
                                <?php 
                                    if (isset($penilaianperilakukerja->last_update)):
                                        echo $penilaianperilakukerja->last_update; 
                                    elseif(isset($penilaianperilakukerja->created_on)):
                                        echo $penilaianperilakukerja->created_on;
                                    else:
                                        echo "-"; 
                                    endif; 
                                ?> 
                        </div>
                        <br>
                        <hr>
                        <table id="realisasitable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Unsur yang dinilai</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Orientasi Pelayanan</td>
                                    <td><?php if (isset($penilaianperilakukerja->orientasi_pelayanan)): echo $penilaianperilakukerja->orientasi_pelayanan; else: echo "0"; endif; ?></td>
                                </tr>
                                <tr>
                                    <td>Integritas</td>
                                    <td><?php if (isset($penilaianperilakukerja->integritas)): echo $penilaianperilakukerja->integritas; else: echo "0"; endif; ?></td>
                                </tr>
                                <tr>
                                    <td>Komitmen</td>
                                    <td><?php if (isset($penilaianperilakukerja->komitmen)): echo $penilaianperilakukerja->komitmen; else: echo "0"; endif; ?></td>
                                </tr>
                                <tr>
                                    <td>Disiplin</td>
                                    <td><?php if (isset($penilaianperilakukerja->disiplin)): echo $penilaianperilakukerja->disiplin; else: echo "0"; endif; ?></td>
                                </tr>
                                <tr>
                                    <td>Kerjasama</td>
                                    <td><?php if (isset($penilaianperilakukerja->kerjasama)): echo $penilaianperilakukerja->kerjasama; else: echo "0"; endif; ?></td>
                                </tr>
                                <tr>
                                    <td>Kepemimpinan</td>
                                    <td><?php if (isset($penilaianperilakukerja->kepemimpinan)): echo $penilaianperilakukerja->kepemimpinan; else: echo "0"; endif; ?></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="align-center">Jumlah</td>
                                    <td><?php if (isset($penilaianperilakukerja->jumlah)): echo $penilaianperilakukerja->jumlah; else: echo "0"; endif; ?></td>
                                </tr>
                                <tr>
                                    <td class="align-center">Nilai rata-rata</td>
                                    <td><?php if (isset($penilaianperilakukerja->nilai_rata_rata)): echo $penilaianperilakukerja->nilai_rata_rata; else: echo "0"; endif; ?></td>
                                </tr>
                                <tr>
                                    <td class="align-center">Nilai Perilaku Kerja</td>
                                    <td><?php if (isset($penilaianperilakukerja->nilai_perilaku_kerja)): echo $penilaianperilakukerja->nilai_perilaku_kerja; else: echo "0"; endif; ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('vfooter'); ?>