<?php $this->load->view('vheader'); ?>

<div class="row">
        <div class="col-xs-12">
            <h3 class="header smaller lighter blue">Daftar Pegawai</h3>

            <div class="table-header">
                Daftar Seluruh Pegawai
                <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#editdata" style="float: right; margin: 5px;">
                               <span class="icon-plus"> Tambah Pegawai
                </button>
            </div>

            <div class="table-responsive">
                <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">
                            <label>
                                <input type="checkbox" class="ace"/>
                                <span class="lbl"></span>
                            </label>
                        </th>
                        <th>NIP</th>
                        <th>NAMA</th>
                        <th class="hidden-480">Jenis Kelamin</th>

                        <th>
                            <i class="icon-time bigger-110 hidden-480"></i>
                            Golongan
                        </th>
                        <th class="hidden-480">Status</th>

                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td class="center">
                            <label>
                                <input type="checkbox" class="ace"/>
                                <span class="lbl"></span>
                            </label>
                        </td>

                        <td>
                            196809011987031001
                        </td>
                        <td>SUDIRO</td>
                        <td class="hidden-480">Laki-laki</td>
                        <td>III/d</td>

                        <td class="hidden-480">
                            <span class="label label-sm label-success">Aktif</span>
                        </td>

                        <td>
                            <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                                <a class="blue" href="#">
                                    <i class="icon-zoom-in bigger-130"></i>
                                </a>

                                <a class="green" href="<?php echo site_url('datapegawai') ?>">
                                    <i class="icon-pencil bigger-130"></i>
                                </a>

                                <a class="red" href="#">
                                    <i class="icon-trash bigger-130"></i>
                                </a>
                            </div>

                            <div class="visible-xs visible-sm hidden-md hidden-lg">
                                <div class="inline position-relative">
                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-caret-down icon-only bigger-120"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
                                        <li>
                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                    <span class="blue">
                                                                                        <i class="icon-zoom-in bigger-120"></i>
                                                                                    </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                    <span class="green">
                                                                                        <i class="icon-edit bigger-120"></i>
                                                                                    </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                    <span class="red">
                                                                                        <i class="icon-trash bigger-120"></i>
                                                                                    </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>