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
                                <h1><?= h($category['Category']['name']); ?></h1>                           
                            </div>
                        </div>
                        <?php
                        if(!empty($category['Source'])){
                        ?>                                     
                            <div class="row">
                                <div class="contact-box-heading">
                                    <span><strong><?php echo __('Sources'); ?></strong></span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo __('Name'); ?></th>
                                        <th class="text-center"><?php echo __('Color'); ?></th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        <?php 
                                            foreach($category['Source'] as $source){
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $this->Html->link(h($source['name']), array('controller' => 'sources', 'action' => 'view', h($source['id'])), array('escape' => false, 'ref' => 'popover', 'data-content' => 'View Source')); ?></td>
                                                <td class="text-center"><div class="btn" style="background-color:<?= h($source['color']) ?>"></div></td>
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