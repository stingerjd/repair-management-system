<!-- ChartJS -->
<script src="<?= $assets ?>plugins/chart.js/Chart.min.js"></script>

<!-- FLOT CHARTS -->
<script src="<?= $assets ?>plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?= $assets ?>plugins/flot/plugins/jquery.flot.resize.js"></script>
<?php 
	$total = 0;
	for ($i = 1; $i <= 30; ++$i) {
	    $total += $list[$i];
	}
?>




<div class="row">
  <div class="col-12">
    <div class="card">

    
      <div class="card-body">
          
			<div class="row">
				<div class="col-lg-12">
					<section class="panel">
						<header class="panel-heading">
				            <h3 class="pull-left"><?=$this->lang->line('months_earning_report');?>: <i><?=$list[32].'/'.$list[33]; ?></h3>
				            <h3 class="pull-right"><?=$this->lang->line('gross_revenue');?>: <?= ($total); ?></h3>
						</header>
						<div class="panel-body">
                  			<div id="area-chart" style="height: 338px;" class="full-width-chart"></div>
						</div>
					</section>
				</div>
			</div>
			<br>
			<br>

			<div class="row">
				<div class="col-lg-8 col-sm-6">
	                <div class="form-group">
	                    <?=lang('choose_month', 'choose_month');?>
	                    <div class="input-group" id="datetimepicker1" data-target-input="nearest">
		                     <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
		                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
		                    </div>
		                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
		                   
		                    <a class="submit_date btn btn-primary input-group-addon"><i class="fa fa-refresh"></i> <?=$this->lang->line('update');?></a> 
		                </div>
		            </div>
				</div>
				<div class="col-lg-4 col-xs-6">
		          <!-- small box -->
		          <div class="small-box bg-red">
		            <div class="inner">
		              <h3><?= $currency; ?> <?=($total);?></h3>
		              <p><?=$this->lang->line('this_month');?></p>
		            </div>
		            <div class="icon">
		              <i class="ion ion-pie-graph"></i>
		            </div>
		          </div>
		        </div>
			</div>
      </div>
  </div>
</div>

<script>
	$(function () {
    	var areaData =  [ <?php if (count($list) <= 1): ?> 
              ['01', 0]
            <?php else: ?>
            <?php for ($i = 1; $i <= 30; ++$i): ?> 
              [(<?=strtotime($list[33].'-'.$list[32].'-'.$i);?> ), "<?= $list[$i]; ?>"],
             <?php endfor; ?>

        <?php endif; ?>]
		$.plot('#area-chart', [areaData], {
		  grid  : {
		    borderWidth: 0
		  },
		  series: {
		    shadowSize: 0, // Drawing is faster without shadows
		    color     : '#00c0ef',
		    lines : {
		      fill: true //Converts the line chart to area chart
		    },
		  },
		  yaxis : {
		    show: true
		  },
		  xaxis: {
		      mode: "time"
		  }
		})
	});

	
	jQuery(document).ready(function () {
		jQuery('.submit_date').click(function (e) {
			var url = jQuery("#datetimepicker1 .datetimepicker-input").val();
			window.location = base_url+"panel/reports/finance/" + url;
		});
	});


    $(function () {
        $('#datetimepicker1').datetimepicker({
            viewMode: 'years',
            format: 'MM/YYYY'
        });
    });


</script>