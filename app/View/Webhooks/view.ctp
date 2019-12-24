<?php
/**
 * View for source details page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
?>
<!-- Content -->
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="main-box no-header clearfix">	
                <div class="main-box-body clearfix">
                    <div class="row">                           
                        <div class="col-sm-12 contact-view-box text-center">
                            <h1><?= h($webhook['Webhook']['name']); ?></h1>  
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><?= __('Name') ?></th>
                                            <th class="text-center"><?= __('Pipeline Name') ?></th>
                                            <th class="text-center"><?= __('Source Name') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><?= h($webhook['Webhook']['name']); ?></td>
                                            <td class="text-center"><?= h($webhook['Pipeline']['name']) ?></td>
                                            <td class="text-center"><?php echo $this->Html->link(h($webhook['Source']['name']), array('controller' => 'sources', 'action' => 'view', h($webhook['Source']['id'])), array('escape' => false, 'ref' => 'popover', 'data-content' => 'View Source')); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php 
                                if(!empty(json_decode($webhook['Webhook']['fields'],true))){
                            ?>                                            
                                <div class="row">
                                    <div class="contact-box-heading">
                                        <span><strong><?php echo __('Fields'); ?></strong></span>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center"><?= __('Field Name') ?></th>
                                                <th class="text-center"><?= __('Field Type') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach(json_decode($webhook['Webhook']['fields'],true) as $field){
                                            ?>
                                                <tr>
                                                        <td class="text-center"><?= h($field['name']) ?></td>
                                                        <td class="text-center"><?= h($field['type']) ?></td>
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php 
                                }
                            ?>                        
                        </div>
                    </div>                                            
                </div>
            </div>
        </div>						
    </div>
</div>
<!-- /Content -->