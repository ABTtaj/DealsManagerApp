<?php
/**
 * View for product details page.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="main-box no-header clearfix">	
                <div class="main-box-body clearfix">
                    <div class="row" >                         
                        <div class="col-sm-12 contact-view-box text-center">
                            <h1><?= h($Product['Product']['name']); ?></h1>                           
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?= __('Name') ?></th>
                                        <th class="text-center"><?= __('Price') ?></th>
                                        <th class="text-center"><?= __('Quantity') ?></th>
                                        <th class="text-center"><?= __('Type') ?></th>
                                        <?php
                                            foreach(json_decode($Product['Product']['custom_fields'],true) as $customField=>$value){
                                        ?>
                                            <th class="text-center"><?= h($customField); ?></th>
                                        <?php
                                            }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td class="text-center"><?= h($Product['Product']['name']) ?></td>
                                            <td class="text-center"><?= h($Product['Product']['price']) ?></td>
                                            <td class="text-center"><?= is_null($Product['Product']['quantity']) ? '-' : h($Product['Product']['quantity']);?></td>
                                            <td class="text-center"><?= h($Product['Type']['name']) ?></td>
                                            <?php
                                                foreach(json_decode($Product['Product']['custom_fields'],true) as $customField=>$value){
                                            ?>
                                                <td class="text-center"><?= h($value['value']).' ('.h($value['type']).')'; ?></td>
                                            <?php
                                                }
                                            ?>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>                                           
                    <div class="row">
                        <div class="contact-box-heading">
                            <span><strong><?php echo __('Deals'); ?></strong></span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center"><span><?php echo __('Name'); ?></span></th>
                                    <th class="text-center"><span><?php echo __('Pipeline'); ?></span></th>
                                    <th class="text-center"><span><?php echo __('Stage'); ?></span></th>
                                    <th class="text-center"><span></span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($deals) {
                                    foreach ($deals as $row):

                                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <a href="<?php echo $this->Html->url(array('controller' => 'deals', 'action' => 'view', h($row['Deal']['id']))); ?>">  <?= h($row['Deal']['name']); ?></a>
                                            </td>                                       
                                            <td class="text-center">
                                                <?= h($row['Pipeline']['name']); ?>
                                            </td>
                                            <td class="text-center">
                                                <?= h($row['Stage']['name']); ?>
                                            </td>
                                            <td class="text-center">
                                                <?php $this->Common->status($row['Deal']['status']); ?>
                                            </td>
                                        </tr>
                                        <?php
                                    endforeach;
                                } else {
                                    echo '<tr><td colspan="4" class="text-center">' . __('No deal in this product.') . '</td></tr>';
                                }

                                ?>                                  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>