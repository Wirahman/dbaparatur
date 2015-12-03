<?php $this->load->view('vheader'); ?>
<script src="<?=base_url()?>assets/Highcharts-3.0.7/js/highcharts.js"></script>
<script src="<?=base_url()?>assets/Highcharts-3.0.7/js/highcharts-more.js"></script>
<script src="<?=base_url()?>assets/Highcharts-3.0.7/js/drilldown.js"></script>
<script src="<?=base_url()?>assets/Highcharts-3.0.7/js/data.js"></script>
<script src="<?=base_url()?>assets/liscroll/jquery.li-scroller.1.0.js"></script>
<link rel="stylesheet" href="<?= base_url();?>assets/liscroll/li-scroller.css" />
<script>
   $(function () {
       $('#container').highcharts({
   	
   	    chart: {
               events: {
                   click: function(event) {
                       window.open('<?php echo site_url()?>/chart/popup','destination','width=250,height=150,left=250,top=200');
                   }
               },
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
   	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
   	                stops: [
   	                    [0, '#FFF'],
   	                    [1, '#333']
   	                ]
   	            },
   	            borderWidth: 0,
   	            outerRadius: '109%'
   	        }, {
   	            backgroundColor: {
   	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
   	                stops: [
   	                    [0, '#333'],
   	                    [1, '#FFF']
   	                ]
   	            },
   	            borderWidth: 1,
   	            outerRadius: '107%'
   	        }, {
   	            // default background
   	        }, {
   	            backgroundColor: '#DDD',
   	            borderWidth: 0,
   	            outerRadius: '105%',
   	            innerRadius: '103%'
   	        }]
   	    },
   	       
   	    // the value axis
   	    yAxis: {
   	        min: 0,
   	        max: 500,
   	        
   	        minorTickInterval: 'auto',
   	        minorTickWidth: 1,
   	        minorTickLength: 10,
   	        minorTickPosition: 'inside',
   	        minorTickColor: '#666',
   	
   	        tickPixelInterval: 30,
   	        tickWidth: 2,
   	        tickPosition: 'inside',
   	        tickLength: 10,
   	        tickColor: '#666',
   	        labels: {
   	            step: 2,
   	            rotation: 'auto'
   	        },
   	        title: {
   				useHTML: true,
   	            text: ''
   	        },
   	        plotBands: [{
   	            from: 0,
   	            to: 200,
   	            color: '#55BF3B' // green
   	        }, {
   	            from: 200,
   	            to: 400,
   	            color: '#DDDF0D' // yellow
   	        }, {
   	            from: 400,
   	            to: 500,
   	            color: '#DF5353' // red
   	        }]        
   	    },
   	
   	    series: [{
   	        name: 'volume',
   	        data: [<?php echo $sum_daily; ?>],
   	        tooltip: {
   				useHTML: true,
   	            valueSuffix: ' x 1000 m<sup>3</sup>'
   	        }
   	    }]
   	
   	}, 
   	// Add some life
   	function (chart) {
   	});
   });
   
   

   
   $(function(){
       $("ul#ticker01").liScroll();
   });
   
   function pindah_not_send_sbu(url){
       window.location = url;
   }
</script>
<div class="row">
   <div class="col-sm-4">
      <div class="widget-box">
         <div class="widget-header widget-header-flat widget-header-small">
            <h5>	
               <i class="icon-signal"></i>
                Data Pegawai
            </h5>
         </div>
         <div class="widget-body">
            <div class="widget-main">
               <div class="row">
                  <div class="col-sm-12 center">
                     <div id="container" style="min-width: 300px; max-width: 300px; height: 300px; margin: 0 auto"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   
</div>
<div class="hr hr32 hr-dotted"></div>



<script type="text/javascript">
    /*
   function pindah(url)
   {
   window.location = url;
   }*/
</script>
<?php $this->load->view('vfooter'); ?>
