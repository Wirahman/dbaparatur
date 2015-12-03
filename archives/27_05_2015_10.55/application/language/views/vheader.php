<!DOCTYPE html>
<html lang="en"><head>
        <meta charset="utf-8" />
        <title>Pusdiklat<?= (isset($title) ? " - $title" : (isset($subtitle) ? " - $subtitle" : '')) ?></title>
        <title>AMR DASHBOARD<?= (isset($title) ? " - $title" : (isset($subtitle) ? " - $subtitle" : '')) ?></title>
        <link rel="shortcut icon" href="<?= base_url() ?>assets/img/dashboard.png" />
        <meta name="description" content="admin home" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
         <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.animated-icons-demo.css" />
        <!--[if IE 7]>
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/font-awesome-ie7.min.css" />
        <![endif]-->
        <!-- page specific plugin styles -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/jquery-ui-1.10.3.full.min.css" />
        
	

       
    <a href="vhome.php"></a>
        <!-- fonts -->
        
        
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/ace-fonts.css" />
        <!-- ace styles -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/ace.min.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/ace-skins.min.css" />
        <script src="<?= base_url() ?>assets/js/ace-extra.min.js"></script>

        <!--[if lte IE 8]>
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/ace-ie.min.css" />
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
           window.jQuery || document.write("<script src='<?= base_url() ?>assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
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
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/colorbox.css" />
        <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.colorbox-min.js"></script>
        <!-- end colorbox -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/dani.css" />
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.css" />
        
        <script type="text/javascript" src="<?= base_url() ?>assets/js/numeric.js"></script>
        
        <!-- begin colorbox -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/colorbox.css" />
        <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.colorbox-min.js"></script>
        <!-- end colorbox -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/dani.css" />
        <script type="text/javascript">
			var baseUrl="<?=base_url()?>";
			var siteUrl="<?=site_url()?>";
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
			$.post(siteUrl+"/ws/", {
				//year: $("#processing_year").val()
			}, function(resp) {
				unblockUI();
				if(resp == 'Sync finished'){
					alert('Sinkronisasi Sukses');
				}
				else{
					alert('Sinkronisasi Gagal');
				}
			});		
		}	        
        </script>
    </head>
    <body>
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
                        <small>
                            <img src="<?php echo base_url()?>assets/img/logo-pusdiklat.png" width="270" height="70" />
                            
                        </small>
                    </a><!-- /.brand -->
                </div>
                <!-- /.navbar-header -->
                <div class="navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <li class="light-blue">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <span class="user-info">
                                    <small>Welcome,</small>
                                     <?= $this->session->userdata('nip') ?>
                                </span>
                                <i class="icon-caret-down"></i>
                            </a>
                            <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
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
                                        Logout
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
								
                        <li>
                            <a href="<?= site_url() ?>/dashboard/">
                                <i class="icon-dashboard"></i>
                                <span class="menu-text"> Dashboard</span>
                            </a>
                        </li>
												
                        <li>
                                    <a  class="dropdown-toggle">
                                        <i class="icon-sitemap icon-animated-flip-horizontal"></i>
                                        <span class="menu-text">
                                           SKP
                                        </span>
                                        <b class="arrow icon-angle-down"></b>
                                    </a>
                                 
                                    <ul class="submenu">
                                        <!--<li>
                                            <a href="<?= site_url() ?>/home">
                                                <i class="icon-double-angle-right"></i>
                                               ALL
                                            </a>
                                        </li>-->

                                        <li>
                                            <a href="<?= site_url() ?>/skp/perencanaanSkp">
                                                <i class="icon-double-angle-right"></i>
                                               Perencanaan SKP
                                            </a>
                                        </li>

                                        <li>
                                            <a href="<?= site_url() ?>/skp/realisasiSkp">
                                                <i class="icon-double-angle-right"></i>
                                                Realisasi SKP
                                            </a>
                                        </li>

                                        <li>
                                            <a href="<?= site_url() ?>/skp/penilaianSkp">
                                                <i class="icon-double-angle-right"></i>
                                               Penilaian SKP
                                            </a>
                                        </li>
                               
                         </ul>
                         </li>
                         
								
				
                        <li>
                            <a href="<?= site_url() ?>/profile/">
                                <i class="icon-user-md"></i>
                                <span class="menu-text"> Profile</span>
                            </a>
                        </li>
                        <li>
                            <a  class="dropdown-toggle">
                                        <i class="icon-list-alt icon-animated-flip-horizontal"></i>
                                        <span class="menu-text">
                                            Referensi
                                        </span>
                                        <b class="arrow icon-angle-down"></b>
                            </a>
                            <ul class="submenu">                                                                      
                                                 <li>
                                                     <a href="<?= site_url() ?>/referensi/jabatan">
                                                         <i class="icon-double-angle-right"></i>
                                                          Nama Jabatan 
                                                     </a>
                                                 </li>
                                                 <li>
                                                     <a href="<?= site_url() ?>/referensi/kegiatan">
                                                         <i class="icon-double-angle-right"></i>
                                                          Tugas Kegiatan 
                                                     </a>
                                                 </li>          
                            </ul>	
                        </li>
																		
                        <li>
                            <a href="<?= site_url() ?>/help/">
                                <i class="icon-bookmark"></i>
                                <span class="menu-text"> Help</span>
                            </a>
                        </li>
								
							
                        <li>
                            <a href="<?= site_url() ?>/user/index">
                                <i class="icon-user"></i>
                                <span class="menu-text"> User </span>
                            </a>
                        </li>
								
								
                        <li>
                            <a href="<?= site_url() ?>/user/role">
                                <i class="icon-user"></i>
                                <span class="menu-text"> Role </span>
                            </a>
                        </li>
								
                        <li>
                            <a href="<?= site_url() ?>/auth/logout/">
                                <i class="icon-off"></i>
                                <span class="menu-text"> Logout </span>
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
                                <a href="<?= site_url() ?>">Home</a>
                            </li>
<?php
if (isset($title))
    echo '<li class="active">' . $title . '</li>';
?>
                        </ul>
                        <!-- .breadcrumb -->
                        <div class="nav-search" id="nav-search">
                            <form class="form-search">
                                <span class="input-icon">
                                    <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                                    <i class="icon-search nav-search-icon"></i>
                                </span>
                            </form>
                        </div>
                        <!-- #nav-search -->
                    </div>
                    <div class="page-content">
                        <!-- <div class="page-header"><h1>xx</h1></div>-->
                        <div class="row">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->