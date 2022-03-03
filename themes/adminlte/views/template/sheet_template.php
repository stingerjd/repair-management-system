<?php
$tax = $db['tax'];
$price_without_tax = $db['total']; // PRICE WITHOUT TAX
$total = $db['grand_total']; // PRICE WITH TAX
$name = explode(' ', $client->name);
$first_name = $name[0];
$last_name = array_key_exists(1, $name) ? $name[1] : '';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?= $this->lang->line('report');?></title>
        <link rel="stylesheet" href="<?= $assets ?>plugins/bootstrap/dist/css/bootstrap.min.css">
        <link href="<?= $assets ?>dist/css/custom/report.css" rel="stylesheet">

        <!-- jQuery 2.2.3 -->
        <script src="<?= $assets ?>plugins/jquery/dist/jquery.min.js"></script>
        <!-- Accounting.js -->
        <script src="<?= $assets ?>plugins/custom/accounting.min.js"></script>
        <style type="text/css">
            .box {
                padding: 5px;
                border: 1px #ddd solid;
                border-radius: 2px;
            }
            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
                padding: 4px;
            }
            .halfinvoice{
                /*font-weight: bold;*/
            }
            h2, h3, h4 {
                font-weight: bold;
            }

             a[href]:after {
                content: ""
            }

            a[href^="#"]:after {
                content: ""
            }
        </style>
    </head>

    <body>
        <div class="halfinvoice">
            <main>
                <h3 style="padding: 0;margin: 0"><?=$settings->title;?></h3>
                <div class="box"></div>
                <br>
                <table class="table table-bordered">
                    <tr>
                        <td class="col-md-5"><h4><?=lang('reparation_code');?></h4></td>
                        <td class="col-md-7"><textarea class="form-control" style="font-weight: bold;font-size: 30px; padding: 5px; line-height: 1; height: 70px"><?=$db['code'];?></textarea></td>
                    </tr>

                    <tr>
                        <td><?=lang('reparation_model');?></td>
                        <td><textarea class="form-control"><?=$db['model_name'];?> <?=$db['imei'];?></textarea></td>
                    </tr>

                    <tr>
                        <td><?=lang('reparation_defect');?></td>
                        <td><textarea class="form-control"><?=$db['defect'];?></textarea></td>
                    </tr>

                    <tr>
                        <td><?=lang('client_company');?></td>
                        <td><input type="text" class="form-control" value="<?=$client->company;?>"></td>
                    </tr>

                    <tr>
                        <td><?=lang('client_name');?></td>
                        <td><input type="text" class="form-control"  value="<?=$client->name;?>"></td>
                    </tr>

                    <tr>
                        <td><?=lang('client_address');?></td>
                        <td><input type="text" class="form-control"  value="<?=$client->address;?>"></td>
                    </tr>

                    <tr>
                        <td><?=lang('client_postal_code');?></td>
                        <td><input type="text" class="form-control" value="<?=$client->postal_code;?>"></td>
                    </tr>

                    <tr>
                        <td><?=lang('client_city');?></td>
                        <td><input type="text" class="form-control" value="<?=$client->city;?>"></td>
                    </tr>

                    <tr>
                        <td><?=lang('client_telephone');?></td>
                        <td><input type="text" class="form-control" value="<?=$client->telephone;?>"></td>
                    </tr>

                    <tr>
                        <td><?=lang('client_email');?></td>
                        <td><input type="text" class="form-control" value="<?=$client->email;?>"></td>
                    </tr>

                    <?php $custom_fields = explode(',', $settings->custom_fields);
                    if (!empty(array_filter($custom_fields))):
                        $value = json_decode($db['custom_field'], true);
                        foreach($custom_fields as $line):?>
                             <?php if(!empty(array_filter($value))): ?>
                                 <tr>
                                    <td><?= $line; ?></td>
                                    <td><input type="text" class="form-control" value="<?= $value[bin2hex($line)]; ?>"></td>
                                </tr>
                            <?php 
                            endif;
                        endforeach;
                    endif;
                    ?>
                  
                    <tr>
                        <td colspan="2"><center><span class="box" style="font-weight: lighter;"><?=$settings->title;?></span></center></td>
                    </tr>
                </table>
                <span style="font-weight: lighter;">
                    <?=sprintf(lang('report_end_date'), date('d.m.Y - H:i', strtotime($db['date_opening'])));?> status: <?=$status->label; ?>
                    <div class="well" style="text-align: center;">
                        <?= $this->repairer->qrcode('link', urlencode(base_url()), 1); ?> 
                        <?= $this->repairer->barcode($db['code'], 'code128', 60, false); ?>
                    </div>        
                </span>
            </main>
            <div id="print_button"><?= $this->lang->line('print');?></div>
        </div>
    </body>

    <script>
        jQuery(document).on("click", "#print_button", function() {
            window.print();
            setInterval(function() {
                window.close();
            }, 500);
        });

        $(document).ready(function() {
            setTimeout(function() {
                window.print();
            }, 500);
            window.onafterprint = function(){
                setTimeout(function() {
                    window.close();
                }, 200);
            }
        });

        function auto_grow(element) {
            element.style.height = "5px";
            element.style.height = (element.scrollHeight)+"px";
        }
        // auto_grow(document.getElementById("comment"));
    </script>
</html>