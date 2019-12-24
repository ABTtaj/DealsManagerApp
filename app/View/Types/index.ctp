<?php

/**
 * View for type page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
?>
<div class="row">
    <!-- Add Type Modal --> 
    <div class="modal fade" id="typeM">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo __('Add Type'); ?></h4>
                </div>
                <?php echo $this->Form->create('Type', array('type' => 'file', 'url' => array('controller' => 'Types', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
                <div class="modal-body">													
                    <div class="form-group" id="type-name-input">
                        <label><?php echo __('Name'); ?></label>
                        <?php echo $this->Form->input('Type.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Type Name'))); ?>	
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-sm" type="button" onclick="constructAFieldInputGroup()">Add New Field</button>
                        <button class="btn btn-danger btn-sm" type="button" onclick="removeLastFieldInputs()" id="remove-field-button">Remove Last Field</button>
                    </div>
                    <div class="form-group">
                        <hr>
                        <label>
                            <input type="checkbox" name="data[Type][quantifiable]">
                            <?php echo __('Quantifiable ?'); ?>
                        </label>
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
    <!-- Delete type modal -->
    <div class="modal fade" id="delTypeM">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button">&times;</button>
                    <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
                </div>
                <?php echo $this->Form->create('Type', array('url' => array('action' => 'delete'))); ?>
                <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
                <div class="modal-body">						
                    <p><?php echo __('Are you sure to delete this Type?'); ?> </p>
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
                        <h1 class="pull-left"><?php echo __('Types'); ?></h1>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-6">
                        <?php echo $this->Form->input('type_id', array('type' => 'text', 'class' => 'form-control search-data module-search', 'placeholder' => __('Quick Search Types'), 'data-name' => 'types', 'label' => false, 'div' => false)); ?>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-xs-6">
                        <div class="pull-right top-page-ui">
                            <?php if ($this->Common->isStaffPermission('42')): ?>                      
                            <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#typeM">
                                <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Type'); ?>
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
                        <!-- Type List -->
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
                                        if (!empty($types)) :

                                            foreach ($types as $row) :
                                                ?>
                                        <tr  id="<?php echo 'row' . h($row['Type']['id']); ?>">
                                            <td>
                                                        <?php if ($this->Common->isStaffPermission('43')) : ?>
                                                <a href="javascript:void(0)"  data-type="text" data-pk="<?php echo h($row['Type']['id']); ?>" data-url="types/edit"  class="editable editable-click vEdit" ref="popover" data-content="Edit Type Name" ><?php echo h($row['Type']['name']); ?></a>
                                                            <?php
                                                        else :
                                                            echo h($row['Type']['name']);
                                                        endif;
                                                        ?>
                                            </td>
                                            <td class="text-center">
                                                <a class="table-link" ref="popover" data-content="View Type"  href="<?php echo $this->Html->url(array("controller" => "types", "action" => "view", h($row['Type']['id']))); ?>">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                        <?php if ($this->Common->isStaffPermission('44')): ?>
                                                <a class="table-link danger" ref="popover" data-content="Delete Type"  href="#" data-toggle="modal" data-target="#delTypeM" onclick="fieldU('TypeId',<?php echo h($row['Type']['id']); ?>)">
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
                        <!--End Type List -->
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
    } else if (type == 'number'){
        label.append('<?= __('Number'); ?>');
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
    formGroup.appendChild(makeRadioInput('text',number,true))
    formGroup.appendChild(makeRadioInput('file',number))
    formGroup.appendChild(makeRadioInput('number',number))
    return formGroup;
}
function makeRequiredInput(number){
    var formGroup = makeFormGroup();
    var label = document.createElement("label");
    var input = document.createElement("input");
    input.setAttribute('type','checkbox');
    input.setAttribute('name','data[Field][field' + number + '][required]');
    label.appendChild(input);
    label.append(' <?= __('Required ?'); ?>');
    formGroup.appendChild(label);
    return formGroup;
}
function makeInputsContainer(number){
    var container = makeFormGroup();
    container.classList.add('product-fields');
    container.appendChild(document.createElement("hr"));
    container.appendChild(makeNameInput(number));
    container.appendChild(makeTypeInput(number));
    container.appendChild(makeRequiredInput(number)); 
    return container;
}
function appendInputsContainer(container,number){
    if(number != 0){
        $('.product-fields:last').after(container);
    } else {
        $('#type-name-input').after(container);
    }
}
function hideRemoveButton(){
    var number = $('.product-fields').length;
    if(number == 0){
        $('#remove-field-button').hide();
    }
}
function showRemoveButton(number){
    if(number == 0){
        $('#remove-field-button').show();
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