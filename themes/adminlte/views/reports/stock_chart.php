<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script src="<?= $assets ?>plugins/chart.js/Chart.min.js"></script>
<script type="text/javascript">
  $(function () {
    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#stock-chart').get(0).getContext('2d')
    var donutData        = {
      labels: [
        "<?= lang("stock_value_by_price"); ?>", 
        "<?= lang("stock_value_by_cost"); ?>",
        "<?= lang("profit_estimate"); ?>",
      ],
      datasets: [
        {
          data: [<?php echo($stock->stock_by_price) ? $stock->stock_by_price : 0; ?>,<?php echo($stock->stock_by_cost) ? $stock->stock_by_cost : 0; ?>,<?php echo($stock->stock_by_price - $stock->stock_by_cost); ?>],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })
});

</script>

<div class="row">
  <div class="col-12">
    <div class="card">

    
      <div class="card-body">
          <?php if ($totals) { ?>
                            <div class="row">
                        <div class="col-lg-6 col-xs-12">
                          <!-- small box -->
                          <div class="small-box bg-aqua">
                            <div class="inner">
                              <h3><?= $this->repairer->formatQuantity($totals->total_items) ?></h3>
                              <p><?= lang('total_items') ?></p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-bag"></i>
                            </div>
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-6 col-xs-12">
                          <!-- small box -->
                          <div class="small-box bg-green">
                            <div class="inner">
                              <h3><?= $this->repairer->formatQuantity($totals->total_quantity) ?></h3>
                              <p><?= lang('total_quantity') ?></p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-stats-bars"></i>
                            </div>
                          </div>
                        </div>
                        <div class="clearfix" style="margin-top:20px;"></div>
                </div>
                        
                    <?php } ?>
                    <canvas id="stock-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
      </div>
  </div>
</div>
