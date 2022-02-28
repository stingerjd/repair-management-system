<!-- ChartJS -->
<script src="<?= $assets ?>plugins/chart.js/Chart.min.js"></script>

<!-- FLOT CHARTS -->
<script src="<?= $assets ?>plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?= $assets ?>plugins/flot/plugins/jquery.flot.resize.js"></script>

<!-- fullCalendar -->
<link rel="stylesheet" href="<?= $assets ?>plugins/fullcalendar/main.css">
<script src="<?= $assets ?>plugins/fullcalendar/main.js"></script>

<script src='<?= $assets ?>plugins/fullcalendar/locales-all.js'></script>
<script>
  $(function () {
    var currentLangCode = '<?= $this->repairer->get_cal_lang(); ?>';

 
    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var calendarEl = document.getElementById('calendar');

    var calendar = new Calendar(calendarEl, {
      headerToolbar: {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      themeSystem: 'bootstrap',
      locale: currentLangCode,  

      //Random default events
      events:"<?=base_url();?>panel/events/getAllEvents",
      editable  : true,
      selectable:true,
      selectHelper:true,



       select: function(data)
        {

          var start    = moment(data.start).format('Y-MM-DD HH:mm:ss');
          var end    = moment(data.end).format('Y-MM-DD HH:mm:ss');

          bootbox.prompt("<?=lang('enter_event_title');?>", function(title){ 
            if (title) {
              $.ajax({
                 url:"<?=base_url();?>panel/events/add",
                 type:"POST",
                 data:{title:title, start:start, end:end},
                 success:function()
                 {
                  calendar.refetchEvents();
                  toastr.success("<?=lang('event_added');?>");
                 }
              })
            }
          });
        },

      eventDrop      : function(data) {
            var event = data.event;
            var start    = moment(event.start).format('Y-MM-DD HH:mm:ss');
            var end    = moment(event.end).format('Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;

            console.log(event);


           $.ajax({
             url:"<?=base_url();?>panel/events/update",
            type:"POST",
            data:{title:title, start:start, end:end, id:id},
            success:function()
            {
            calendar.refetchEvents();
             toastr.success("<?=lang('event_updated');?>");
            }
           });
      },

        eventResize:function(data)
        {
         var event = data.event;
            var start    = moment(event.start).format('Y-MM-DD HH:mm:ss');
            var end    = moment(event.end).format('Y-MM-DD HH:mm:ss');
         var title = event.title;
         var id = event.id;
         $.ajax({
           url:"<?=base_url();?>panel/events/update",
          type:"POST",
          data:{title:title, start:start, end:end, id:id},
          success:function(){
            calendar.refetchEvents();
           toastr.success("<?=lang('event_updated');?>");
          }
         })
        },


          eventClick:function(event)
          {
            bootbox.confirm({
                message: "<?=lang('event_remove_r_u_sure');?>",
                buttons: {
                    confirm: {
                        label: '<?=lang('yes');?>',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: '<?=lang('no');?>',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                    if (result) {
                      var id = event.event.id;
                      $.ajax({
                       url:"<?=base_url();?>panel/events/delete",
                       type:"POST",
                       data:{id:id},
                       success:function()
                       {
                      calendar.refetchEvents();
                        toastr.success("<?=lang('event_removed');?>");
                       }
                      })
                    }
                }
             });
          },


    });

    calendar.render();

  
  })
</script>
<script>
$(function() {
    $('#send_email_form').parsley({
        errorsContainer: function(pEle) {
            var $err = pEle.$element.closest('.form-group');
            return $err;
        }
    }).on('form:submit', function(event) {
        $('#loadingmessage').show(); // show the loading message.
        emailto = jQuery('#emailto_').val();
        subject = jQuery('#subject_').val();
        body = jQuery('#body_').val();
        jQuery.ajax({
            type: "POST",
            url: base_url + "panel/welcome/send_mail",
            data: "to=" + emailto + "&subject=" + subject + "&body=" + body,
            cache: false,
            dataType: "json",
            success: function(data) {
                $('#loadingmessage').hide();
                if (data == 2) {
                    toastr.error('<?= lang('
                        field_empty '); ?>');
                } else if (data == 1) {
                    toastr.info('<?= lang('
                        email_sent '); ?>');
                } else {
                    toastr.error('<?= lang('
                        email_not_sent '); ?>');
                }
            }
        });
        return false;
    });
    $('#send_quicksms').parsley({
        errorsContainer: function(pEle) {
            var $err = pEle.$element.closest('.form-group');
            return $err;
        }
    }).on('form:submit', function(event) {
        dta = $('#send_quicksms').serialize();
        jQuery.ajax({
            type: "POST",
            url: base_url + "panel/reparation/send_sms",
            data: dta,
            cache: false,
            dataType: "json",
            success: function(data) {
                if (data.status == true) toastr['success']("<?= $this->lang->line('quick_sms');?>", '<?= $this->lang->line('
                    sms_sent ');?>');
                else toastr['error']("<?= $this->lang->line('quick_sms');?>", '<?= $this->lang->line('
                    sms_not_sent ');?>');
            }
        });
        return false;
    });
});    
</script>
       
 <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $reparation_count; ?></h3>
                <p><?= lang('reparation_title'); ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?= base_url('panel/reparation'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $clients_count; ?></h3>
                <p><?= lang('client_title'); ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?= base_url('panel/inventory'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $stock_count; ?></h3>
                <p><?= lang('products'); ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?= base_url('panel/inventory'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>


        <div class="row">
          <section class="col-lg-7 connectedSortable ui-sortable">

            <?php if($this->Admin || $this->GP['reports-finance']): ?>
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                  <h3 class="card-title">
                    <i class="ion ion-stats-bars"></i>
                    <?= lang('revenue_chart'); ?>
                  </h3>
                   <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                      <i class="fa fa-times"></i></button>
                  </div>
                  <!-- /. tools -->

                </div><!-- /.card-header -->
                <div class="card-body">
                  <div id="area-chart" style="height: 338px;" class="full-width-chart"></div>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            <?php endif;?>



            <!-- Custom tabs (Chartts with tabs)-->
              <div class="card">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                  <h3 class="card-title">
                    <i class="fas fa-calendar"></i>
                    <?= lang('calendar'); ?>
                  </h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div id="calendar"></div>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->

          </section>


          <section class="col-lg-5 connectedSortable ui-sortable">
              <?php if($this->Admin || $this->GP['reports-stock']): ?>
               <!-- Custom tabs (Chartts with tabs)-->
              <div class="card">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                  <h3 class="card-title">
                    <i class="fa fa-th"></i>
                    <?= lang('stock'); ?>
                  </h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <canvas id="stock-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
              <?php endif;?>



              <?php if($this->Admin || $this->GP['reports-qemail']): ?>
               <!-- Custom tabs (Chartts with tabs)-->
              <div class="card">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                  <h3 class="card-title">
                    <i class="fa fa-envelope"></i>
                    <?= lang('qemail'); ?>
                  </h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <form action="#" method="post" id="send_email_form" >
                    <div class="form-group">
                      <input type="email" class="form-control" required name="emailto" id="emailto_" placeholder="<?= lang('email_to'); ?>">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" required name="subject" id="subject_" placeholder="<?= lang('email_subject'); ?>">
                    </div>
                    <div>
                      <textarea name="body" id="body_" required class="summernote" placeholder="<?= lang('email_body'); ?>" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                  </form>
                </div>
                <div class="card-footer clearfix">
              <button type="submit" form="send_email_form" class="pull-right btn btn-default"><?= lang('email_send'); ?>
                <i class="fa fa-arrow-circle-right"></i></button>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
              <?php endif;?>



          <?php if($this->Admin || $this->GP['dashboard-qsms']): ?>


             <!-- Custom tabs (Chartts with tabs)-->
              <div class="card">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                  <h3 class="card-title">
                    <i class="fa fa-envelope"></i>
                    <?= lang('quick_sms'); ?>
                  </h3>
                </div><!-- /.card-header -->
                <div class="card-body">

                    <form action="#" id="send_quicksms" method="post">
                      <div class="form-group">
                        <input type="text" required class="form-control" name="number" id="phone_number" placeholder="Number eg. (+923001234567)">
                      </div>
                      <div>
                        <textarea required="" name="text" id="fastsms" class="textarea" placeholder="SMS Text" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                      </div>
                    </form>
                 

                </div>

                 <div class="card-footer clearfix">
                    <button type="submit" class="pull-right btn btn-default" form="send_quicksms"><?= lang('email_send'); ?>
                      <i class="fa fa-arrow-circle-right"></i></button>
                  </div>


              </div>
              <!-- /.card -->
        <?php endif; ?>

          </section>
        </div>

    <script type="text/javascript">
   $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */


 /*
     * FULL WIDTH STATIC AREA CHART
     * -----------------
     */
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


    
</script>



