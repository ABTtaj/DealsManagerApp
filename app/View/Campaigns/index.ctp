<?php

/**
 * View for campaign page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
?>
<div class="row">
    <!-- Add Campaign Modal --> 
    <div class="modal fade" id="campaignM">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo __('Add Campaign'); ?></h4>
                </div>
                <?php echo $this->Form->create('Campaign', array('type' => 'file', 'url' => array('controller' => 'Campaigns', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
                <div class="modal-body">													
                    <div class="form-group">
                        <label><?php echo __('Name'); ?></label>
                        <?php echo $this->Form->input('Campaign.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Campaign Name'))); ?>	
                    </div>
                    <div class="form-group">
                        <label><?php echo __('Cost'); ?></label>
                        <div class="input-group">
                            <span class="input-group-addon"> <?= $this->Session->read('Auth.User.currency_symbol'); ?></span>
                            <?php echo $this->Form->input('Campaign.cost', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Campaign Price'), 'value' => 0, 'label' => false, 'div' => false)); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?php echo __('Products'); ?></label>
                        <select class="select-tags form-control w100" multiple="multiple" name="data[Campaign][products][]">
                            <?php foreach ($products as $row): ?>
                                <option value="<?php echo h($row['Product']['id']); ?>"><?php echo h($row['Product']['name']); ?></option>
                            <?php endforeach; ?> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?php echo __('Sources'); ?></label>
                        <select class="select-tags form-control w100" multiple="multiple" name="data[Campaign][sources][]">
                            <?php foreach ($sources as $row): ?>
                                <option value="<?php echo h($row['Source']['id']); ?>"><?php echo h($row['Source']['name']); ?></option>
                            <?php endforeach; ?> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?php echo __('Start'); ?></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <?php echo $this->Form->input('Campaign.start', array('type' => 'text', 'class' => 'form-control datepickerDateT')); ?>
                        </div>	
                    </div>		
                    <div class="form-group">
                        <label><?php echo __('End'); ?></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <?php echo $this->Form->input('Campaign.end', array('type' => 'text', 'class' => 'form-control datepickerDateT')); ?>
                        </div>	
                    </div>
                </div>
                <div class="modal-footer">			
                    <button class="btn btn-primary blue btn-sm" type="submit"><i class="fa fa-check"></i> <?php echo __('Save'); ?></button>
                    <button class="btn default btn-sm" data-dismiss="modal" type="button"><i class="fa fa-times"></i> <?php echo __('Close'); ?></button>
                </div>
                <?php echo $this->Form->end(); ?>
                <?php echo $this->Js->writeBuffer(); ?>
            </div>
        </div>
    </div>
    <!-- Delete campaign modal -->
    <div class="modal fade" id="delCampaignM">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button">&times;</button>
                    <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
                </div>
                <?php echo $this->Form->create('Campaign', array('url' => array('action' => 'delete'))); ?>
                <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
                <div class="modal-body">						
                    <p><?php echo __('Are you sure to delete this Campaign?'); ?> </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary delSubmit"  type="button"><?php echo __('Yes'); ?></button>
                    <button class="btn default" data-dismiss="modal" type="button"><?php echo __('No'); ?></button>
                </div>
                <?php echo $this->Form->end(); ?>
                <?php echo $this->Js->writeBuffer(); ?>
            </div>
        </div>
    </div>
    <!-- /Delete modal -->
    <!-- Content -->
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <h1 class="pull-left"><?php echo __('Campaigns'); ?></h1>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-6">
                        <?php echo $this->Form->input('campaign_id', array('type' => 'text', 'class' => 'form-control search-data module-search', 'placeholder' => __('Quick Search Campaigns'), 'data-name' => 'campaigns', 'label' => false, 'div' => false)); ?>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-xs-6">
                        <div class="pull-right top-page-ui">
                            <?php if ($this->Common->isStaffPermission('42')): ?>                      
                            <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#campaignM">
                                <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Campaign'); ?>
                            </a>                       
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                        <!-- Campaign List -->
                        <div class="table-responsive">
                            <div class="table-scrollable">
                                <table class="table table-hover table-striped dataTables">
                                    <thead>
                                        <tr>
                                            <th><?= __('Name'); ?></th>
                                            <th class="text-center"><?= __('Cost'); ?></th>
                                            <th class="text-center"><?= __('Start Date'); ?></th>
                                            <th class="text-center"><?= __('End Date'); ?></th>
                                            <th class="text-center"><?= __('Actions') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if (!empty($campaigns)) :
                                                foreach ($campaigns as $row) :
                                        ?>
                                            <tr id="<?php echo 'row' . h($row['Campaign']['id']); ?>">
                                                <td>
                                                    <?php if ($this->Common->isStaffPermission('43')) : ?>
                                                        <a href="javascript:void(0)"  data-type="text" data-pk="<?php echo h($row['Campaign']['id']); ?>" data-url="campaigns/edit"  class="editable editable-click vEdit" ref="popover" data-content="Edit Campaign Name" ><?php echo h($row['Campaign']['name']); ?></a>
                                                    <?php
                                                        else :
                                                            echo h($row['Campaign']['name']);
                                                        endif;
                                                    ?>
                                                </td>
                                                <td class="text-center"><?= h($row['Campaign']['cost']) ?></td>
                                                <td class="text-center text-muted"><?= h($row['Campaign']['start']) ?></td>
                                                <td class="text-center text-muted"><?= h($row['Campaign']['end']) ?></td>
                                                <td class="text-center">
                                                    <a class="table-link" ref="popover" data-content="View Campaign"  href="<?php echo $this->Html->url(array("controller" => "campaigns", "action" => "view", h($row['Campaign']['id']))); ?>">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <?php if ($this->Common->isStaffPermission('44')): ?>
                                                        <a class="table-link danger" ref="popover" data-content="Delete Campaign"  href="#" data-toggle="modal" data-target="#delCampaignM" onclick="fieldU('CampaignId',<?php echo h($row['Campaign']['id']); ?>)">
                                                            <i class="fa fa-trash-o"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php
                                                endforeach;
                                            endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>		
                        </div>
                        <!--End Campaign List -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
    <!-- /Content -->
</div>