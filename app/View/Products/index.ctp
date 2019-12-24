<?php
/**
 * View for product home page.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Add Product Modal --> 
<div class="modal fade" id="productM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= __('Add Product'); ?></h4>
            </div>
            <?= $this->Form->create('Product', array('type' => 'file','url' => array('controller' => 'Products', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
            <div class="modal-body">													
                <div class="form-group">
                    <label><?= __('Name'); ?></label>
                    <?= $this->Form->input('Product.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Product Name'))); ?>	
                </div>		
                <div class="form-group" id="product-type-input">
                    <label><?= __('Type'); ?></label>
                    <?= $this->Form->input('Product.type_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($this->Common->getTypesList()), 'label' => false,'onchange' => 'changeProductType(event)','id'=>'type-select-input')); ?>	
                </div>		
                <div class="form-group">
                    <label><?= __('Price'); ?></label>
                    <div class="input-group">
                        <span class="input-group-addon"><?= $this->Session->read('Auth.User.currency_symbol'); ?></span>
                        <?= $this->Form->input('Product.price', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Product Price'), 'value' => 0)); ?>	
                    </div>
                </div>
            </div>
            <div class="modal-footer">			
                <button class="btn btn-primary blue btn-sm" type="submit"><i class="fa fa-check"></i> <?= __('Save'); ?></button>
                <button class="btn default btn-sm" data-dismiss="modal" type="button"><i class="fa fa-times"></i> <?= __('Close'); ?></button>
            </div>
            <?= $this->Form->end(); ?>	
            <?= $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- /.modal -->
<!-- Delete product modal -->
<div class="modal fade" id="delProductM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?= __('Confirmation'); ?></h4>
            </div>
            <?= $this->Form->create('Product', array('url' => array('action' => 'delete'))); ?>
            <?= $this->Form->input('id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p><?= __('Are you sure to delete this Product ?'); ?>  </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary delSubmit"  type="button"><?= __('Yes'); ?></button>
                <button class="btn default" data-dismiss="modal" type="button"><?= __('No'); ?></button>
            </div>
            <?= $this->Form->end(); ?>
            <?= $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- /Delete modal -->
<!-- Content -->
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <h1 class="pull-left"><?= __('Products'); ?></h1>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-6">
                        <?= $this->Form->input('product_id', array('type' => 'text', 'class' => 'form-control search-data module-search', 'placeholder' => __('Quick Search Products'), 'data-name' => 'products', 'label' => false, 'div' => false)); ?>

                    </div>
                    <div class="col-lg-2 col-sm-6 col-xs-6">
                        <div class="pull-right top-page-ui">
                            <?php if ($this->Common->isStaffPermission('32')): ?>                    
                                <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#productM">
                                    <i class="fa fa-plus-circle fa-lg"></i> <?= __('Add Product'); ?>
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
                        <!-- Product List -->
                        <?php debug($products); ?>
                        <div class="table-responsive">
                            <div class="table-scrollable">
                                <table class="table table-hover dataTable table-striped dataTables">
                                    <thead>
                                        <tr>
                                            <th><?= __('Name'); ?></th>
                                            <th><?= __('Price'); ?></th>
                                            <th class="text-center"><?= __('Actions'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($products)) :

                                            foreach ($products as $row) :

                                                ?>
                                                <tr  id="<?= 'row' . h($row['Product']['id']); ?>">
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')) : ?>
                                                            <a href="javascript:void(0)"  data-type="text" data-pk="<?= h($row['Product']['id']); ?>" data-name="name" data-url="products/edit"  class="editable editable-click vEdit" ref="popover" data-content="Edit Name" ><?= h($row['Product']['name']); ?></a>
                                                            <?php
                                                        else :
                                                            echo h($row['Product']['name']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')) : ?>
                                                            <span class="blue-color"><?= h($this->Session->read('Auth.User.currency_symbol')); ?></span><a href="javascript:void(0)"  data-type="text" data-pk="<?= h($row['Product']['id']); ?>" data-name="price" data-url="products/edit"  class="editable editable-click vEdit" ref="popover" data-content="Edit Price" ><?= h($row['Product']['price']); ?></a>
                                                            <?php
                                                        else :
                                                            echo $this->Session->read('Auth.User.currency_symbol') . '' . h($row['Product']['price']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td class="text-center">	
                                                        <a class="table-link" ref="popover" data-content="View Product" href="<?= $this->Html->url(array("controller" => "products", "action" => "view", h($row['Product']['id']))); ?>" ref="popover" data-content="View Product" >
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <?php if ($this->Common->isStaffPermission('34')): ?>
                                                            <a class="table-link danger" href="#" ref="popover" data-content="Delete Product" data-toggle="modal" data-target="#delProductM" onclick="fieldU('ProductId',<?= h($row['Product']['id']); ?>)" ref="popover" data-content="Delete Product" >
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
                        <!--End Product List -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>
<script>
var types = initializeTypesArray();
function initializeTypesArray(){
    var types = {};
    <?php 
        foreach($types as $type){
    ?>
    types[<?= $type['Type']['id'] ?>] = {
        quantifiable: <?= $type['Type']['quantifiable'] == 'on' ? 'true' : 'false' ?>,
        fields:[]
    };
    <?php
            $fields = json_decode($type['Type']['fields'],true);
            foreach($fields as $field){
    ?>
    var field = {};
    field.name = '<?= $field['name'] ?>' ;
    field.type = '<?= $field['type'] ?>' ;
    field.required = <?= $field['required'] == 'on' ? 'true' : 'false' ?> ;
    types[<?= $type['Type']['id'] ?>].fields.push(field);
    <?php
            }
        }
    ?>
    return types;
}
function createAFormGroup(field){
    var formGroup = document.createElement("div");
    var label = document.createElement("label");
    label.append(field.name);
    var input = document.createElement("input");
    formGroup.classList.add('form-group');
    formGroup.classList.add('custom-fields');
    if(field.type != 'file'){
        input.classList.add('form-control');
    }
    input.classList.add('input-inline');
    input.classList.add('input-medium');
    input.setAttribute('type',field.type);
    input.setAttribute('name','data[Fields][' + field.name + ']');
    if(field.required){
        input.setAttribute('required',field.required);
    }
    input.setAttribute('placeholder',field.name);
    formGroup.appendChild(label);
    formGroup.appendChild(input);
    return formGroup;
}
function makeQuantityInput(){
    var formGroup = document.createElement("div");
    var label = document.createElement("label");
    label.append('Quantity');
    var input = document.createElement("input");
    formGroup.classList.add('form-group');
    formGroup.classList.add('custom-fields');
    input.classList.add('form-control');
    input.classList.add('input-inline');
    input.classList.add('input-medium');
    input.setAttribute('type','number');
    input.setAttribute('name','data[Product][quantity]');
    input.setAttribute('required',true);
    input.setAttribute('placeholder',<?=__('Quantity'); ?>);
    formGroup.appendChild(label);
    formGroup.appendChild(input);
    return formGroup;
}
function constructCustomFieldsInputs(typeId){
    if(types[typeId].quantifiable){
        $('#product-type-input').after(makeQuantityInput());
    }
    for(var i =0; i < types[typeId].fields.length; i++){
        $('#product-type-input').after(createAFormGroup(types[typeId].fields[i]));
    }
}
function changeProductType(event){
    var typeId = event.target.value;
    $('.custom-fields').remove();
    constructCustomFieldsInputs(typeId);
}
$(document).ready(function () {
    var typeId = $('#type-select-input').val();
    if(typeId){
        constructCustomFieldsInputs(typeId);
    }
});
</script>