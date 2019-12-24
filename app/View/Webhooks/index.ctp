<?php

/**
 * View for webhook page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
?>
<div class="row">
    <!-- Add Webhook Modal --> 
    <div class="modal fade" id="webhookM">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button webhook="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo __('Add Webhook'); ?></h4>
                </div>
                <?php echo $this->Form->create('Webhook', array('webhook' => 'file', 'url' => array('controller' => 'Webhooks', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
                <div class="modal-body">													
                    <div class="form-group">
                        <label><?php echo __('Name'); ?></label>
                        <?php echo $this->Form->input('Webhook.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Webhook Name'))); ?>	
                    </div>		
                    <div class="form-group">
                        <label><?php echo __('Pipeline'); ?></label>
                        <?php echo $this->Form->input('Webhook.pipeline_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($this->Common->getPipelineList()), 'label' => false)); ?>	
                    </div>			
                    <div class="form-group" id="webhook-source-input">
                        <label><?php echo __('Source'); ?></label>
                        <?php echo $this->Form->input('Webhook.source_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($this->Common->getSourcesList()), 'label' => false)); ?>	
                    </div>	
                    <div class="form-group">
                        <button class="btn btn-success btn-sm" type="button" onclick="constructAFieldInputGroup()">Add New Field</button>
                        <button class="btn btn-danger btn-sm" type="button" onclick="removeLastFieldInputs()" id="remove-field-button">Remove Last Field</button>
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
    <!-- Delete webhook modal -->
    <div class="modal fade" id="delWebhookM">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button">&times;</button>
                    <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
                </div>
                <?php echo $this->Form->create('Webhook', array('url' => array('action' => 'delete'))); ?>
                <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
                <div class="modal-body">						
                    <p><?php echo __('Are you sure to delete this Webhook?'); ?> </p>
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
                        <h1 class="pull-left"><?php echo __('Webhooks'); ?></h1>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-6">
                        <?php echo $this->Form->input('webhook_id', array('type' => 'text', 'class' => 'form-control search-data module-search', 'placeholder' => __('Quick Search Webhooks'), 'data-name' => 'webhooks', 'label' => false, 'div' => false)); ?>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-xs-6">
                        <div class="pull-right top-page-ui">
                            <?php if ($this->Common->isStaffPermission('42')): ?>                      
                            <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#webhookM">
                                <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Webhook'); ?>
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
                        <!-- Webhook List -->
                        <div class="table-responsive">
                            <div class="table-scrollable">
                                <table class="table table-hover table-striped dataTables">
                                    <thead>
                                        <tr>
                                            <th><?= __('Name'); ?></th>
                                            <th class="text-center"><?= __('Pipeline Name') ?></th>
                                            <th class="text-center"><?= __('Source Name') ?></th>
                                            <th class="text-center"><?= __('Actions') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if (!empty($webhooks)) :
                                                foreach ($webhooks as $row) :
                                        ?>
                                            <tr id="<?php echo 'row' . h($row['Webhook']['id']); ?>">
                                                <td>
                                                    <?php if ($this->Common->isStaffPermission('43')) : ?>
                                                        <a href="javascript:void(0)"  data-type="text" data-pk="<?php echo h($row['Webhook']['id']); ?>" data-url="webhooks/edit"  class="editable editable-click vEdit" ref="popover" data-content="Edit Webhook Name" ><?php echo h($row['Webhook']['name']); ?></a>
                                                    <?php
                                                        else :
                                                            echo h($row['Webhook']['name']);
                                                        endif;
                                                    ?>
                                                </td>
                                                <td class="text-center"><?= h($row['Pipeline']['name']) ?></td>
                                                <td class="text-center"><?php echo $this->Html->link(h($row['Source']['name']), array('controller' => 'sources', 'action' => 'view', h($row['Source']['id'])), array('escape' => false, 'ref' => 'popover', 'data-content' => 'View Source')); ?></td>
                                                <td class="text-center">
                                                    <a class="table-link" ref="popover" data-content="View Webhook"  href="<?php echo $this->Html->url(array("controller" => "webhooks", "action" => "view", h($row['Webhook']['id']))); ?>">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <?php if ($this->Common->isStaffPermission('44')): ?>
                                                        <a class="table-link danger" ref="popover" data-content="Delete Webhook"  href="#" data-toggle="modal" data-target="#delWebhookM" onclick="fieldU('WebhookId',<?php echo h($row['Webhook']['id']); ?>)">
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
                        <!--End Webhook List -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
    <!-- /Content -->
</div>
<script>
function makeFormGroup(){
    var formGroup = document.createElement("div");
    formGroup.classList.add('form-group');
    return formGroup;
}
function makeRadioInput(type,number,isActive = false){
    var label = document.createElement("label");
    label.classList.add('btn');
    var radio = document.createElement("input");
    radio.setAttribute('type','radio');
    radio.setAttribute('name','data[Field][field'+ number +'][type]');
    radio.setAttribute('value',type);
    if(isActive){
        label.classList.add('active');
        radio.setAttribute('checked','true');
    }
    label.appendChild(radio);
    if(type =='text'){
        label.append('<?= __('Text'); ?>');
    } else if (type == 'file'){
        label.append('<?= __('File'); ?>');
    }
    return label;
}
function makeNameInput(number){
    var formGroup = makeFormGroup();
    var input = document.createElement("input");
    input.classList.add('form-control');
    input.classList.add('input-inline');
    input.classList.add('input-medium');
    input.setAttribute('name','data[Field][field' + number + '][name]');
    input.setAttribute('type','text');
    input.setAttribute('required','true');
    input.setAttribute('placeholder','<?= __('Field Name') ?>');
    var label = document.createElement("label");
    label.append(' <?= __('Field Name'); ?>');
    formGroup.appendChild(label);
    formGroup.appendChild(input);
    return formGroup;
}
function makeTypeInput(number){
    var formGroup = makeFormGroup();
    formGroup.setAttribute('data-toggle','buttons');
    var label = document.createElement("label");
    label.append(' <?= __('Field Type'); ?>');
    var labelContainer = document.createElement("div");
    labelContainer.appendChild(label);
    formGroup.appendChild(labelContainer);
    formGroup.appendChild(makeRadioInput('text',number,true));
    formGroup.appendChild(makeRadioInput('file',number));
    return formGroup;
}
function makeInputsContainer(number){
    var container = makeFormGroup();
    container.classList.add('product-fields');
    container.appendChild(document.createElement("hr"));
    container.appendChild(makeNameInput(number));
    container.appendChild(makeTypeInput(number));
    return container;
}
function appendInputsContainer(container,number){
    if(number != 0){
        $('.product-fields:last').after(container);
    } else {
        $('#webhook-source-input').after(container);
    }
}
function showRemoveButton(number){
    if(number == 0){
        $('#remove-field-button').show();
    }
}
function hideRemoveButton(){
    var number = $('.product-fields').length;
    if(number == 0){
        $('#remove-field-button').hide();
    }
}
function constructAFieldInputGroup(){
    var number = $('.product-fields').length;
    showRemoveButton(number);
    var container = makeInputsContainer(number); 
    appendInputsContainer(container,number);  
}  
function removeLastFieldInputs(){
    $('.product-fields:last').remove();
    hideRemoveButton();
}
$(document).ready(function(){
    $('#remove-field-button').hide();
});
</script>