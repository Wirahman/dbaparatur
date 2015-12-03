<?php $this->load->view('vheader'); ?>

<?php
$pesan = $this->session->flashdata('message');
if (!empty($pesan)) {
    ?>

    <div class="alert alert-info">
        <button class="close" data-dismiss="alert" type="button">
            <i class="icon-remove"></i>
        </button>
        <center><strong>
                <?php echo $this->session->flashdata('message'); ?>
            </strong>
            <br></center>
    </div>

    <?php
}
?>

<!--<div class="widget-header"><h5> <i class="icon-user"></i> &nbsp; &nbsp;Riwayat Aktifitas</h5></div>-->
<!--<div class="widget-body">
    <span id="form_error" style="color:red;"></span>

    <div class="row">
        <div class="col-xs-12">

            <div class="table-header">
                <br>

            </div>

            <div class="table-responsive">
                <table id="histroy_aktifitas" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="nomor">No</th>
                            <th class="name">NIP</th>
                            <th class="name">Controller</th>
                            <th class="name">Data</th>
                            <th class="name">Tanggal</th>
                            <th class="name">IP Aktifitas</th>
                        </tr>
                    </thead>

                    <tbody>
<?php
// $i = 1;
// foreach ($query->result() as $aktifitas) {
?> 
                            <tr class="record">
                                <td align="center">
                                    <a href="#"><?php // echo $i;     ?> </a>
                                </td>
                                <td><?php // echo ucfirst($aktifitas->nip);     ?> </td> 
                                <td><?php // echo ucfirst($aktifitas->controller);     ?> </td> 
                                <td><?php // echo ucfirst($aktifitas->data);     ?> </td> 
                                <td><?php // echo ucfirst($aktifitas->tanggal_aktifitas);     ?> </td> 
                                <td><?php // echo ucfirst($aktifitas->ip_aktifitas);     ?> </td> 


                                <td>

                                </td>
                            </tr>
<?php // $i++; ?> 
<?php // } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>-->


<div class="row">
    <div class="col-xs-12">
        <div class="table-header">
            Riwayat Aktifitas
        </div>

        <div class="table-responsive">
            <table id="histroy_aktifitas" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">
                            No.
                        </th>
                        <th>NIP</th>
                        <th>Controller</th>
                        <th class="hidden-480">Data</th>

                        <th>
                            <i class="icon-time bigger-110 hidden-480"></i>
                            Waktu
                        </th>
                        <th class="hidden-480">IP Address</th>
                        <th class="hidden-480"></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $nomer = 1;
                    foreach ($query->result() as $aktifitas):
                        ?>
                        <tr>
                            <td class="center"><?php echo $nomer; ?></td>
                            <td><?php echo ucfirst($aktifitas->nip); ?></td>
                            <td><?php echo ucfirst($aktifitas->controller); ?></td>
                            <td class="hidden-480"><?php echo ucfirst($aktifitas->data); ?></td>
                            <td><?php echo ucfirst($aktifitas->tanggal_aktifitas); ?></td>
                            <td class="hidden-480"><?php echo ucfirst($aktifitas->ip_aktifitas); ?></td>
                            <td></td>
                        </tr>
                    <?php 
                        $nomer++;
                        endforeach; 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->load->view('vfooter'); ?>

<!-- basic scripts -->

<!--[if !IE]> -->

<!-- page specific plugin scripts -->
<script src="<?= base_url() ?>/assets/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/js/jquery.dataTables.bootstrap.js"></script>


<!--<script type="text/javascript">
    jQuery(function($) {        
        var oTable1 = $('#histroy_aktifitas').dataTable({
            "fnDrawCallback": function(oSettings) {
                /* Need to redo the counters if filtered or sorted */
                if (oSettings.bSorted || oSettings.bFiltered)
                {
                    for (var i = 0, iLen = oSettings.aiDisplay.length; i < iLen; i++)
                    {
                        $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr).html(i + 1);
                    }
                }
            },
            "aoColumnDefs": [
                {"bSortable": true, "aTargets": [6]}
            ],
            "aSorting": [[1, 'asc', 'desc']]
            
        });

        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table');
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            var w2 = $source.width();

            if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2))
                return 'right';
            return 'left';
        }
    });
//    $(document).ready(function() {
//        var a = $('[name=histroy_aktifitas_length]').find(":selected").val(); 
//        alert(a);
//        $('input[name=histroy_aktifitas_length] > label > select')
//                .removeAttr('selected')
//                .filter('[value=25]')
//                .attr('selected', true);        
//    });
</script>-->
<script type="text/javascript">
    jQuery(function($) {
        var oTable1 = $('#histroy_aktifitas').dataTable({
            "aoColumns": [
                {"bSortable": false},
                null, null, null, null, null,
                {"bSortable": false}
            ]});


        $('table th input:checkbox').on('click', function() {
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                    .each(function() {
                        this.checked = that.checked;
                        $(this).closest('tr').toggleClass('selected');
                    });

        });


        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table');
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            var w2 = $source.width();

            if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2))
                return 'right';
            return 'left';
        }
    });
</script>



