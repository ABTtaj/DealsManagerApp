<?php

/**
 * View for category page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
?>
<div class="row">
    <!-- Add Category Modal --> 
    <div class="modal fade" id="CategoryM">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo __('Add Category'); ?></h4>
                </div>
                <?php echo $this->Form->create('Category', array('type' => 'file', 'url' => array('controller' => 'Categories', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
                <div class="modal-body">													
                    <div class="form-group">
                        <?php echo $this->Form->input('Category.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Category Name'))); ?>	
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
    <!-- Delete category modal -->
    <div class="modal fade" id="delCategoryM">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button">&times;</button>
                    <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
                </div>
                <?php echo $this->Form->create('Category', array('url' => array('action' => 'delete'))); ?>
                <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
                <div class="modal-body">						
                    <p><?php echo __('Are you sure to delete this Category?'); ?> </p>
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
                        <h1 class="pull-left"><?php echo __('Categories'); ?></h1>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-6">
                        <?php echo $this->Form->input('category_id', array('type' => 'text', 'class' => 'form-control search-data module-search', 'placeholder' => __('Quick Search Categories'), 'data-name' => 'categories', 'label' => false, 'div' => false)); ?>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-xs-6">
                        <div class="pull-right top-page-ui">
                            <?php if ($this->Common->isStaffPermission('42')): ?>                      
                            <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#categoryM">
                                <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Category'); ?>
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
                        <!-- Category List -->
                        <div class="table-responsive">
                            <div class="table-scrollable">
                                <table class="table table-hover table-striped dataTables">
                                    <thead>
                                        <tr>
                                            <th><?php echo __('Name'); ?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($categories)) :

                                            foreach ($categories as $row) :
                                                ?>
                                        <tr  id="<?php echo 'row' . h($row['Category']['id']); ?>">
                                            <td>
                                                        <?php if ($this->Common->isStaffPermission('43')) : ?>
                                                <a href="javascript:void(0)"  data-type="text" data-pk="<?php echo h($row['Category']['id']); ?>" data-url="categories/edit"  class="editable editable-click vEdit" ref="popover" data-content="Edit Category Name" ><?php echo h($row['Category']['name']); ?></a>
                                                            <?php
                                                        else :
                                                            echo h($row['Category']['name']);
                                                        endif;
                                                        ?>
                                            </td>
                                            <td class="text-center">
                                                <a class="table-link" ref="popover" data-content="View Category"  href="<?php echo $this->Html->url(array("controller" => "categories", "action" => "view", h($row['Category']['id']))); ?>">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                        <?php if ($this->Common->isStaffPermission('44')): ?>
                                                <a class="table-link danger" ref="popover" data-content="Delete Category"  href="#" data-toggle="modal" data-target="#delCategoryM" onclick="fieldU('CategoryId',<?php echo h($row['Category']['id']); ?>)">
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
                        <!--End Category List -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
    <!-- /Content -->
</div>