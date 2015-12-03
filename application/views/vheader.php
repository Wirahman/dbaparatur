<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Database Aparatur Dukcapil Daerah <?php (isset($title) ? $title : (isset($subtitle) ? " - $subtitle" : '')); ?></title>
    <link rel="shortcut icon"
          href="<?php echo base_url() ?>assets/img/logo_main.png"/>
    <meta name="description" content="Pusdiklat Migas - Sasaran Kerja Pegawai"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/pace.css"/>
    <script src="<?= base_url() ?>assets/js/pace.min.js"></script>
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.animated-icons-demo.css"/>
    <!--[if IE 7]>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/font-awesome-ie7.min.css"/>
    <![endif]-->
    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/jquery-ui-1.10.3.full.min.css"/>
    <!-- fonts -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/ace-fonts.css"/>
    <!-- ace styles -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/ace.min.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/ace-rtl.min.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/ace-skins.min.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/custom.css"/>
    <script src="<?= base_url() ?>assets/js/ace-extra.min.js"></script>

    <!--[if lte IE 8]>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/ace-ie.min.css"/>
    <![endif]-->
    <!-- inline styles related to this page -->
    <!-- ace settings handler -->
    <script src="<?= base_url() ?>assets/js/ace-extra.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?= base_url() ?>assets/js/html5shiv.js"></script>
    <script src="<?= base_url() ?>assets/js/respond.min.js"></script>
    <![endif]-->
    <!-- basic scripts -->
    <!--[if !IE]> -->
    <script type="text/javascript">
        window.jQuery || document.write("<script src='<?= base_url() ?>assets/js/jquery-2.0.3.min.js'>" + "<" + "/script>");
    </script>
    <!-- <![endif]-->
    <!--[if IE]>
    <script type="text/javascript">
        window.jQuery || document.write("<script src='<?= base_url() ?>assets/js/jquery-1.10.2.min.js'>" + "<" + "/script>");
    </script>
    <![endif]-->
    <script type="text/javascript">
        if ("ontouchend" in document)
            document.write("<script src='<?= base_url() ?>assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
    </script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/typeahead-bs2.min.js"></script>
    <!-- page specific plugin scripts -->
    <!--[if lte IE 8]>
    <script src="<?= base_url() ?>assets/js/excanvas.min.js"></script>
    <![endif]-->
    <script src="<?= base_url() ?>assets/js/jquery-ui-1.10.3.full.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.ui.touch-punch.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootbox.min.js"></script>
    <!-- ace scripts -->
    <script src="<?= base_url() ?>assets/js/ace-elements.min.js"></script>
    <script src="<?= base_url() ?>assets/js/ace.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.blockUI.js"></script>


    <!-- begin colorbox -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/colorbox.css"/>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.colorbox-min.js"></script>
    <!-- end colorbox -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/dani.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.css"/>

    <!-- begin colorbox -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/colorbox.css"/>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.colorbox-min.js"></script>
    <!-- end colorbox -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/dani.css"/>
    <script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('body').show();
            $('.pace').fadeOut('slow');
            $('#whitebg').fadeOut('slow');
            $('.select2style').select2();
        });
        var baseUrl = "<?= base_url() ?>";
        var siteUrl = "<?= site_url() ?>";
        function blockUI() {
            $.blockUI({
                css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000', '-webkit-border-radius': '10px', '-moz-border-radius': '10px',
                    opacity: .5,
                    color: '#fff'
                }
            });
        }
        function unblockUI() {
            $.unblockUI();
        }


        function sync() {
            blockUI();
            $.post(siteUrl + "/ws/", {
                //year: $("#processing_year").val()
            }, function (resp) {
                unblockUI();
                if (resp == 'Sync finished') {
                    alert('Sinkronisasi Sukses');
                }
                else {
                    alert('Sinkronisasi Gagal');
                }
            });
        }
    </script>
</head>
<body style="display: none;">
<div id="whitebg"></div>
<div class="navbar navbar-default" id="navbar">
    <script type="text/javascript">
        try {
            ace.settings.check('navbar', 'fixed')
        } catch (e) {
        }
    </script>
    <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="#" class="navbar-brand">
                <img style="min-width: 170%" src="<?php echo base_url() ?>assets/img/logo.png" width="225"/>
            </a><!-- /.brand -->
        </div>
        <!-- /.navbar-header -->
        <div class="navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <div class="brackets">
                                    <span class="user-info">
                                        Selamat Datang, <?= $this->session->userdata('nama_pegawai'); ?>
                                        <i class="icon-caret-down"></i>
                                    </span>
                        </div>

                    </a>
                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="<?= site_url() ?>/profil">
                                <i class="icon-user"></i>
                                <?php if ($this->session->userdata('role') == 1) { ?>
                                    <span class="menu-text"> Profil</span>
                                <?php } else { ?>
                                    <span class="menu-text"> Data Pegawai</span>
                                <?php }; ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?= site_url() ?>/user/aktifitas">
                                <i class="icon-time"></i>
                                <span class="menu-text"> Riwayat Aktifitas</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= site_url() ?>/user/password/">
                                <i class="icon-lock"></i>
                                Ubah Password
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?= site_url() ?>/auth/logout/">
                                <i class="icon-off"></i>
                                Keluar
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- /.ace-nav -->
        </div>
        <!-- /.navbar-header -->
    </div>
    <!-- /.container -->
</div>
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }
    </script>
    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>

        <div class="sidebar" id="sidebar">
            <script type="text/javascript">
                try {
                    ace.settings.check('sidebar', 'fixed')
                } catch (e) {
                }
            </script>
            <ul class="nav nav-list">
                <li <?php if ((isset($menu)) && ($menu == "beranda")): echo 'class="active"'; endif; ?> >
                    <a href="<?= site_url() ?>/dashboard/">
                        <i class="icon-home"></i>
                        <span class="menu-text"> Beranda</span>
                    </a>
                </li>
                <li <?php if ((isset($submenu)) && ($submenu == "perencanaan")): echo 'class="active"'; endif; ?> >
                    <a href="<?= site_url() ?>/skp/perencanaan">
                        <i class="icon-book"></i>
                        Perencanaan
                    </a>
                </li>
                <li <?php if ((isset($submenu)) && ($submenu == "realisasi")): echo 'class="active"'; endif; ?> >
                    <a href="<?= site_url() ?>/skp/realisasi">
                        <i class="icon-edit"></i>
                        Pelaporan Realisasi
                    </a>
                </li>
                <li <?php if ((isset($submenu)) && ($submenu == "hasil")): echo 'class="active"'; endif; ?> >
                    <a href="<?= site_url() ?>/skp/hasil_penilaian">
                        <i class="icon-certificate"></i>
                        Hasil Penilaian
                    </a>
                </li>
                <?php if ($this->session->userdata('existonanotherdb') != 0): ?>
                    <li <?php if ((isset($menu)) && ($menu == "tim")): echo 'class="active"'; endif; ?> >
                        <a href="#" class="dropdown-toggle">
                            <i class="icon-group icon-animated-flip-horizontal"></i>
                            Penilaian Bawahan
                            <b class="arrow icon-angle-down"></b>
                        </a>

                        <ul class="submenu">
                            <?php
                            $temp_currentnip = $this->session->userdata('nip');
                            $temp_bawahan_level_1 = GetBawahan::get_list($temp_currentnip);
                            foreach ($temp_bawahan_level_1 as $tbl1):
                                $temp_index_nip1 = $tbl1->peg_nip;
                                ?>
                                <li class="dropdown newdropdown-li <?php if ((isset($submenu)) && ($submenu == "lvl1_" . $temp_index_nip1)): echo 'active'; endif; ?>">
                                    <a class="newdropdown-link" href="<?php echo site_url() . '/skp/penilaian_bawahan/' . $temp_index_nip1; ?>">
                                        <i class="icon-user"></i>
                                        <span class="uppercase"><?php echo $tbl1->peg_nm . " - (" . $temp_index_nip1 . ")"; ?></span>
                                        <?php
                                        $temp_bawahan_level_2 = GetBawahan::get_list($temp_index_nip1);
                                        $count_level_2 = count($temp_bawahan_level_2);
                                        ?>
                                    </a>

                                    <?php if ($count_level_2 > 0): ?>
                                        <a class="newdropdown-caret dropdown-toggle">--Bawahan--<b class="arrow icon-angle-down"></b></a>
                                    <?php endif; ?>
                                    <ul class="submenu">
                                        <?php
                                        foreach ($temp_bawahan_level_2 as $tbl2):
                                            $temp_index_nip2 = $tbl2->peg_nip;
                                            ?>
                                            <li class="<?php if (((isset($submenu)) && ($submenu == "lvl1_" . $temp_index_nip1)) && ((isset($submenu1)) && ($submenu1 == "lvl2_" . $temp_index_nip2))) : echo 'active'; endif; ?>">
                                                <a href="<?php echo site_url() . '/skp/penilaian_bawahan2/' . $temp_index_nip2; ?>" class="no-underline">
                                                    <i class="icon-user"></i>
                                                    <span class="uppercase"><?php echo $tbl2->peg_nm . " - (" . $temp_index_nip2 . ")"; ?></span>
                                                </a>
                                            </li>
                                            <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if ($this->session->userdata('role') == 1)://admin/personalia? ?>
                    <!--                            <li <?php if ((isset($menu)) && ($menu == "skpreferensi")): echo 'class="active"'; endif; ?>>
                                <a  class="dropdown-toggle">
                                    <i class="icon-list-alt icon-animated-flip-horizontal"></i>
                                    <span class="menu-text">
                                        Referensi
                                    </span>
                                <b class="arrow icon-angle-down"></b>
                                </a>
                                <ul class="submenu">                                                                      
                                    <li <?php if ((isset($submenu)) && ($submenu == "jabatan")): echo 'class="active"'; endif; ?>>
                                        <a href="<?php echo site_url(); ?>/referensi/jabatan">
                                            <i class="icon-double-angle-right"></i>
                                            Jabatan 
                                        </a>
                                    </li>
                                    <li  <?php if ((isset($submenu1)) && ($submenu1 == "kegiatan")): echo 'class="active"'; endif; ?>>
                                        <a href="<?php echo site_url(); ?>/referensi/kegiatan">
                                            <i class="icon-double-angle-right"></i>
                                            Tugas Kegiatan 
                                        </a>
                                    </li>          
                                </ul>	
                            </li>-->
                    <li <?php if ((isset($menu)) && ($menu == "beranda")): echo 'class="active"'; endif; ?> >
                        <a href="#">
                            <i class="icon-table"></i>
                            <span class="menu-text"> Master Data</span>
                        </a>
                    </li>
                    <li <?php if ((isset($menu)) && ($menu == "beranda")): echo 'class="active"'; endif; ?> >
                        <a href="<?php echo site_url('daftarpegawai'); ?>">
                            <i class="icon-user"></i>
                            <span class="menu-text"> Data Pegawai</span>
                        </a>
                    </li>
                    <li <?php if ((isset($menu)) && ($menu == "beranda")): echo 'class="active"'; endif; ?> >
                        <a href="#">
                            <i class="icon-group"></i>
                            <span class="menu-text"> User Management</span>
                        </a>
                    </li>
                    <li <?php if ((isset($menu)) && ($menu == "beranda")): echo 'class="active"'; endif; ?> >
                        <a href="#">
                            <i class="icon-list"></i>
                            <span class="menu-text"> Pengalaman</span>
                        </a>
                    </li>
                    <!--<li <?php /*if ((isset($menu)) && ($menu == "")): echo 'class="active"'; endif; */ ?>>
                        <a class="dropdown-toggle">
                            <i class="icon-list-alt icon-animated-flip-horizontal"></i>
                                    <span class="menu-text">
                                        Data
                                    </span>
                            <b class="arrow icon-angle-down"></b>
                        </a>
                        <ul class="submenu">
                            <li <?php /*if ((isset($submenu)) && ($submenu == "")): echo 'class="active"'; endif; */ ?>>
                                <a href="<?php /*echo site_url(); */ ?>/jabatan">
                                    <i class="icon-double-angle-right"></i>
                                    Jabatan
                                </a>
                            </li>
                            <li <?php /*if ((isset($submenu1)) && ($submenu1 == "")): echo 'class="active"'; endif; */ ?>>
                                <a href="<?php /*echo site_url(); */ ?>/data/tugaskegiatan">
                                    <i class="icon-double-angle-right"></i>
                                    Kegiatan Tugas Kegiatan
                                </a>
                            </li>
                            <li <?php /*if ((isset($submenu1)) && ($submenu1 == "")): echo 'class="active"'; endif; */ ?>>
                                <a href="<?php /*echo site_url(); */ ?>/pegawai">
                                    <i class="icon-double-angle-right"></i>
                                    Pegawai
                                </a>
                            </li>
                            <li>
                                <a href="<?php /*echo site_url(); */ ?>/user/role">
                                    <i class="icon-double-angle-right"></i>
                                    <span class="menu-text">Pengaturan </span>
                                </a>
                            </li>
                        </ul>
                    </li>-->

                    <!--                         <li>
                                <a href="<?php echo site_url(); ?>/user/index">
                                    <i class="icon-list-alt"></i>
                                    <span class="menu-text"> Daftar Pengguna </span>
                                </a>
                            </li>-->
                    <!--                            <li>
                                <a href="<?php echo site_url(); ?>/user/role">
                                    <i class="icon-list-alt"></i>
                                    <span class="menu-text">Daftar Akses </span>
                                </a>
                            </li>-->
                <?php endif; ?>
                <li>
                    <a href="<?= site_url() ?>/auth/logout/">
                        <i class="icon-off"></i>
                        <span class="menu-text"> Keluar </span>
                    </a>
                </li>
            </ul>
            <!-- /.nav-list -->
            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
            </div>
            <script type="text/javascript">
                try {
                    ace.settings.check('sidebar', 'collapsed')
                } catch (e) {
                }
            </script>
        </div>
        <div class="main-content">
            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try {
                        ace.settings.check('breadcrumbs', 'fixed')
                    } catch (e) {
                    }
                </script>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home home-icon"></i>
                    </li>
                    <?php
                    if (isset($title))
                        echo '<li class="active">' . $title . '</li>';
                    ?>
                </ul>
                <!-- .breadcrumb -->
            </div>
            <div class="page-content">
                <!-- <div class="page-header"><h1>xx</h1></div>-->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->