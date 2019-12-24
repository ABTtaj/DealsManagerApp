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
                            <h1><?= h($type['Type']['name']); ?></h1>                           
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center"><?= __('Name') ?></th>
                                    <th class="text-center"><?= __('Quantifiable') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td class="text-center"><?= h($type['Type']['name']) ?></td>
                                        <td class="text-center"><?= $type['Type']['quantifiable'] == 1 ? 'True' : 'False' ?></td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php 
                        if(!empty(json_decode($type['Type']['fields'],true))){
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
                                        foreach(json_decode($type['Type']['fields'],true) as $field){
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
                        if(!empty($type['Product'])){
                    ?>                                   
                        <div class="row">
                            <div class="contact-box-heading">
                                <span><strong><?php echo __('Products'); ?></strong></span>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center"><?php echo __('Name'); ?></th>
                                    <th class="text-center"><?php echo __('Cost'); ?></th>
                                    <th class="text-center"><?php echo __('Quantity'); ?></th>
                                </tr>
                            </thead>
                                <tbody>
                                    <?php 
                                        foreach($type['Product'] as $product){
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $this->Html->link(h($product['name']), array('controller' => 'products', 'action' => 'view', h($product['id'])), array('escape' => false, 'ref' => 'popover', 'data-content' => 'View Product')); ?></td>
                                            <td class="text-center"><?= h($product['price']) ?></td>
                                            <td class="text-center"><?= is_null($product['quantity']) ? '-' : h($product['quantity']);?></td>
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
<!-- /Content -->