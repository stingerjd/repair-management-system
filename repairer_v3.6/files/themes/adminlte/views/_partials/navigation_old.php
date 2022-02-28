<ul class="nav navbar-nav">
          
                <?php if($action == 'index' && $ctrler == 'pos'): ?>
                <li class="dropdown">
                    <a class="btn bdarkGreen pos-tip" id="register_details" title="<span><?=lang('register_details')?></span>" data-placement="bottom" data-html="true" href="<?=base_url('panel/pos/register_details')?>" data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-check-circle"></i>
                    </a>
                </li>
                <li class="dropdown">
                    <a class="btn borange pos-tip" id="close_register" title="<span><?=lang('close_register')?></span>" data-placement="bottom" data-html="true" data-backdrop="static" href="<?=base_url('panel/pos/close_register')?>" data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-times-circle"></i>
                    </a>
                </li>
              <?php endif; ?>
          <!-- User Account: style can be found in dropdown.less -->
          <?php if($qty_alert_num > 0) { ?>
                <li class="dropdown hidden-sm">
                    <a class="btn blightOrange tip" title="<?= lang('alerts') ?>" 
                        data-placement="left" data-toggle="dropdown" href="#">
                        <i class="fa fa-exclamation-triangle"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="<?= site_url('panel/reports/quantity_alerts') ?>" class="">
                                <span class="badge badge-danger pull-right" style="margin-top:3px;"><?= $qty_alert_num; ?></span>
                                <span style="padding-right: 35px;"><?= lang('quantity_alerts') ?></span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
             <li class="dropdown item-more">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i style="font-size: 18px" class="fa fa-plus-circle"></i>
            </a>
              <div class="dropdown-menu dropdown-menu-custom" role="menu" aria-labelledby="dropdownMenu-more">
                <span class="arrow"></span>
                <h4 class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?=lang('add');?></font></font></h4>
                <ul class="more-list">
                  <?php if($this->Admin || $GP['customers-add']): ?>
                    <li>
                      <a role="menuitem" class="add_c">
                        <span class="fa fa-user-plus icon"></span><br>
                        <?=lang('add_client');?>
                      </a>
                    </li>
                  <?php endif; ?>
                  <?php if($this->Admin || $GP['repair-add']): ?>
                  <li>
                    <a role="menuitem" class="add_reparation">
                      <span class="fa fa-list-alt icon"></span><br>
                      <?=lang('add_reparation');?>
                    </a>
                  </li>
                  <?php endif; ?>
                  <?php if($this->Admin || $GP['dashboard-qsms']): ?>
                  <li>
                    <a type="button" data-toggle="modal" data-target="#sendSMSModal">
                      <span class="fa fa-comment icon"></span><br>
                      <?=lang('send_sms_label');?>
                    </a>
                  </li>
                  <?php endif; ?>
                  <?php if($this->Admin || $GP['dashboard-qemail']): ?>
                  <li>
                    <a type="button" data-toggle="modal" data-target="#sendEmailModal">
                      <span class="fa fa-paper-plane icon"></span><br>
                      <?=lang('send_email_label');?>
                    </a>
                  </li>
                  <?php endif; ?>
                </ul>
              </div>
            </li>
            <?php if ($settings->show_settings_menu == 0): ?>
              <?php if($this->Admin || $GP['settings-index']): ?>
              <li class="dropdown item-more">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i style="font-size: 18px" class="fa fa-cogs"></i>
                </a>
                  <div class="dropdown-menu dropdown-menu-custom" role="menu" aria-labelledby="dropdownMenu-more">
                      <span class="arrow"></span>
                      <h4 class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?=lang('settings/main');?></font></font></h4>
                      <ul class="more-list">
                        <?php if($this->Admin || $GP['settings-index']): ?>
                        <li>
                          <a role="menuitem" href="<?=base_url();?>panel/settings/index#general">
                            <span class="fa fa-cog icon"></span><br>
                            <?=lang('general_settings_title');?>
                          </a>
                        </li>
                        <li>
                          <a role="menuitem" href="<?=base_url();?>panel/settings/index#orders">
                            <span class="fa fa-list-alt icon"></span><br>
                            <?=lang('reparation');?>
                          </a>
                        </li>
                        <li>
                          <a role="menuitem" href="<?=base_url();?>panel/settings/index#invoice">
                            <span class="far fa-id-card icon"></span><br>
                            <?= lang('invoice_title');?>
                          </a>
                        </li>
                        <li>
                          <a role="menuitem" href="<?=base_url();?>panel/settings/index#appearance">
                            <span class="fab fa-css3 icon"></span><br>
                            <?=lang('appearance');?>
                          </a>
                        </li>
                        <li>
                          <a role="menuitem" href="<?=base_url();?>panel/settings/index#sms">
                            <span class="fa fa-comments icon"></span><br>
                            <?=lang('sms_title');?>
                          </a>
                        </li>
                      <?php endif; ?>
                      
                        <?php if($this->Admin || $GP['auth-index']): ?>
                        <li>
                          <a role="menuitem" href="<?=base_url();?>panel/auth/index">
                            <span class="fa fa fa-users icon"></span><br>
                            <?=lang('auth/index');?>
                          </a>
                        </li>
                        <?php endif; ?>
                        <?php if($this->Admin || $GP['auth-user_groups']): ?>
                        <li>
                          <a role="menuitem" href="<?=base_url();?>panel/auth/user_groups">
                            <span class="fab fa-expeditedssl icon"></span><br>
                            <?=lang('auth/user_groups');?>
                          </a>
                        </li>
                        <?php endif; ?>
                        <?php if($this->Admin || $GP['repair_statuses-index']): ?>
                        <li>
                          <a role="menuitem" href="<?=base_url();?>panel/settings/repair_statuses">
                            <span class="fa fa-tags icon"></span><br>
                            <?=lang('repair_statuses/index');?>
                          </a>
                        </li>
                        <?php endif; ?>

                         <?php if($this->Admin || $GP['tax_rates-index']): ?>
                        <li>
                          <a role="menuitem" href="<?=base_url();?>panel/settings/tax_rates">
                            <span class="fas fa-angle-double-right icon"></span><br>
                            <?=lang('tax_rates/index');?>
                          </a>
                        </li>
                        <?php endif; ?>
                        <?php if($this->Admin || $GP['categories-index']): ?>
                        <li>
                          <a role="menuitem" href="<?=base_url();?>panel/settings/categories">
                            <span class="fas fa-sitemap icon"></span><br>
                            <?=lang('categories/index');?>
                          </a>
                        </li>
                        <?php endif; ?>
                        <?php if($this->Admin || $GP['utilities-list_db']): ?>
                        <li>
                          <a role="menuitem" href="<?=base_url();?>panel/utilities/list_db">
                            <span class="fas fa-database icon"></span><br>
                            <?=lang('utilities/index');?>
                          </a>
                        </li>
                        <?php endif; ?>

                        <?php if($this->Admin || $GP['settings-sms_gateways']): ?>
                        <li>
                          <a role="menuitem" href="<?=base_url();?>panel/settings/sms_gateways">
                            <span class="fas fa-sms icon"></span><br>
                            <?=lang('sms_gateways');?>
                          </a>
                        </li>
                        <?php endif; ?>
                      </ul>
                  </div>
              </li>
            <?php endif;?>
          <?php endif;?>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= base_url(); ?>assets/uploads/members/<?= $user->image; ?>" class="user-image" alt="<?= $user->first_name.' '.$user->last_name; ?>">
              <span class="hidden-xs"><?= $user->first_name.' '.$user->last_name; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= base_url(); ?>assets/uploads/members/<?= $user->image; ?>" class="img-circle" alt="<?= $user->first_name.' '.$user->last_name; ?>">
                <p>
                  <?= $user->first_name.' '.$user->last_name; ?>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?= base_url('panel/auth/logout'); ?>" class="btn btn-default btn-flat"><?= lang('signout'); ?></a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>