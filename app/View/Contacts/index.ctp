<?php
/**
 * View for all contacts home page
 * 
 * @author:   AnkkSoft.com
 * Copyright: AnkkSoft 2019
 * Website:   http://www.ankksoft.com
 * CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Email send modal -->
<div class="modal fade" id="uM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Send Message'); ?></h4>
            </div>
            <?php echo $this->Form->create('Contact', array('url' => array('controller' => 'contacts', 'action' => 'send_message'), 'inputDefaults' => array('label' => false, 'div' => false))); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label><?php echo __('To') . ':'; ?></label>
                    <span class="to-name"></span>
                    <?php echo $this->Form->input('Mail.to', array('type' => 'hidden', 'class' => 'to-mail')); ?>	
                </div>
                <div class="form-group">	
                    <?php echo $this->Form->input('Mail.subject', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Subject'))); ?>
                </div>
                <div class="form-group">									
                    <?php echo $this->Form->input('Mail.message', array('type' => 'textarea', 'class' => 'form-control', 'Placeholder' => __('Write a message'))); ?>
                </div>	
            </div>
            <div class="modal-footer">	
                <button type="button" class="btn btn-primary submitButton"><i class='fa fa-envelope'></i> <?php echo __('Send'); ?></button>
            </div>
            <?php echo $this->Form->end(); ?>	
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- Add Contact Modal -->                             
<div class="modal fade" id="contactM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Contact'); ?></h4>
            </div>
            <?php echo $this->Form->create('Contact', array('url' => array('controller' => 'Contacts', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
            <div class="modal-body tab-modal">
                <!-- Tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-contact"><?php echo __('Basic Details'); ?></a></li> 
                    <li><a data-toggle="tab" href="#tab-social"><?php echo __('Social'); ?></a></li>
                    <li><a data-toggle="tab" href="#tab-related-contact"><?php echo __('Related Contacts'); ?></a></li>
                </ul>
                <div class="tab-content">
                    <!-- contact details Tab -->
                    <div id="tab-contact" class="tab-pane fade active in">
                        <div class="form-group">
                            <label></label>
                            <?php echo $this->Form->input('Contact.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Contact Name'))); ?>	
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <?php echo $this->Form->input('Contact.email', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Email'))); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <?php echo $this->Form->input('Contact.phone', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Phone'))); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.title', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Job Title'))); ?>	
                        </div>
                        <div class="form-group">                  
                            <?php echo $this->Form->input('Contact.address', array('type' => 'textarea', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Address'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.city', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('City'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.state', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('State'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.zip_code', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Zip Code'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.country', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Country'))); ?>	
                        </div>                       
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.location', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Location'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.company_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $companies, 'empty' => __('Select Company'))); ?>	
                        </div>
                    </div>
                    <!-- Social Tab -->
                    <div id="tab-social" class="tab-pane fade">                      
                        <div class="form-group">
                            <label></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa  fa-facebook"></i></span>
                                <?php echo $this->Form->input('Contact.facebook', array('type' => 'text', 'class' => 'form-control input-inline input-medium')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-skype"></i></span>
                                <?php echo $this->Form->input('Contact.skype', array('type' => 'text', 'class' => 'form-control input-inline input-medium')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-linkedin"></i></span>
                                <?php echo $this->Form->input('Contact.linkedIn', array('type' => 'text', 'class' => 'form-control input-inline input-medium')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-twitter"></i></span>
                                <?php echo $this->Form->input('Contact.twitter', array('type' => 'text', 'class' => 'form-control input-inline input-medium')); ?>	
                            </div>
                        </div>
                    </div>
                    <!-- Deal Custom Field Tab -->
                    <div id="tab-custom" class="tab-pane fade">
                        <?php foreach ($custom as $row): ?>
                            <div class="form-group">
                                <label><?= h($row['Custom']['name']); ?></label>
                                <?php echo $this->Form->input('Custom.value' . h($row['Custom']['id']), array('type' => ($row['Custom']['type'] == '2') ? 'textarea' : 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => '')); ?>	
                            </div>
                        <?php endforeach; ?>                      
                    </div> 
                    <!-- Related Contact Tab -->
                    <div id="tab-related-contact" class="tab-pane fade">
                        <label></label>
                        <div class="form-group">
                            <button class="btn btn-primary blue btn-sm" type="button" onclick="makeRelatedContactForm()"><i class="fa fa-plus"></i> <?php echo __('Add'); ?></button>
                            <button class="btn btn-danger btn-sm" type="button" id="remove-related-contact-button" onclick="removeLastRelatedContactForm()"><i class="fa fa-minus"></i> <?php echo __('Remove last'); ?></button>		
                        </div>
                    </div>          
                </div>
            </div>
            <div class="modal-footer">			
                <button class="btn btn-primary blue btn-sm" type="submit"><i class="fa fa-check"></i> <?php echo __('Save'); ?></button>
                <button class="btn default btn-sm" data-dismiss="modal" type="button"><i class="fa fa-times"></i> <?php echo __('Close'); ?></button>					
            </div>
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- Delete modal -->
<div class="modal fade" id="delContM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Contact', array('url' => array('action' => 'delete'))); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p><?php echo __('Are you sure to delete this contact ?'); ?></p>
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
<div class="row">
    <div class="col-lg-12">
        <div class="row">
                <div class="clearfix">
                    <div class="col-md-3 col-xs-12">
                        <h1 class="pull-left"><?php echo __('Contacts'); ?></h1>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <?php if ($this->Common->isAdmin()) : ?>
                            <a class="btn btn-sm btn-warning" href="<?php echo $this->Html->url(array("controller" => "contacts", "action" => "import")); ?>" >
                                <i class="fa fa-upload"></i> <?php echo __('Import Contact'); ?>
                            </a> 
                        <?php endif; ?>
                        <div class="btn-group pull-right" role="group">
                            <button type="button" class="btn btn-primary btn-sm active mr-1" ref="popover" data-content="<?php echo __('Card View'); ?>"><i class="fa fa-th-large"></i></button>
                            <a href="<?php echo $this->Html->url(array("controller" => "contacts", "action" => "lists")); ?>" class="btn btn-white btn-sm" ref="popover" data-content="<?php echo __('List View'); ?>"><i class="fa fa-bars"></i></a>                
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <?php echo $this->Form->input('contact_id', array('type' => 'text', 'class' => 'form-control search-data module-search', 'placeholder' => __('Search Contacts'), 'data-name' => 'contacts', 'label' => false, 'div' => false)); ?>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="pull-right top-page-ui">
                            <?php if ($this->Common->isStaffPermission('12')): ?>                            
                                <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#contactM">
                                    <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Contact'); ?>
                                </a>                          
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                    <ul class="contact-letters">
                        <li><a href="javascript:void(0)" class="contact-letter" data-id="contacts">All</a></li>
                        <?php foreach (range('A', 'Z') as $char): ?>
                            <li><a href="javascript:void(0)" class="contact-letter" data-id="contacts"><?php echo h($char); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
        </div>
        <!-- Contacts List -->
        <div class="row" id="contacts-div">
            <div class="contact-list">
                <?php echo $this->element('contacts'); ?>
            </div>
            <?php echo $this->Form->input('letter', array('type' => 'hidden', 'value' => h($letter))); ?>
            <?php echo $this->Form->input('number', array('type' => 'hidden', 'value' => 2)); ?>
            <?php echo $this->Form->input('totalPages', array('type' => 'hidden', 'value' => h($total_pages))); ?>
        </div>	
        <!-- End Contacts List -->
        <?php if (count($Contacts) == 15): ?>
            <div class="manager-bottom">
                <button class="load_contact btn btn-primary" data-id="contacts"><?php echo __('Load More'); ?></button>
                <div class="animation_image"><?php echo $this->Html->image('ajax-loader.gif'); ?><?php echo __('Loading'); ?>...</div>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
    function makeFormGroup(){
        var formGroup = document.createElement("div");
        formGroup.classList.add('form-group');
        return formGroup;
    }
    function createNameInput(number){
        var formGroup = document.createElement("div");
        var label = document.createElement("label");
        var input = document.createElement("input");
        formGroup.classList.add('form-group');
        input.classList.add('form-control');
        input.classList.add('input-inline');
        input.classList.add('input-medium');
        input.setAttribute('type','text');
        input.setAttribute('required','true');
        input.setAttribute('placeholder','<?=__('Name')?>');
        input.setAttribute('name','data[RelatedContact][' + number + '][name]');
        formGroup.appendChild(label);
        formGroup.appendChild(input);
        return formGroup
    }
    function createEmailInput(number){
        var formGroup = document.createElement("div");
        var inputGroup = document.createElement("div");
        var span = document.createElement("span");
        var icon = document.createElement('i');
        var input = document.createElement("input");
        formGroup.classList.add('form-group');
        inputGroup.classList.add('input-group');
        span.classList.add('input-group-addon');
        icon.classList.add('fa');
        icon.classList.add('fa-envelope');
        input.classList.add('form-control');
        input.classList.add('input-inline');
        input.classList.add('input-medium');
        input.setAttribute('type','email');
        input.setAttribute('placeholder','<?=__('Email')?>');
        input.setAttribute('name','data[RelatedContact][' + number + '][email]');
        span.appendChild(icon);
        inputGroup.appendChild(span);
        inputGroup.appendChild(input);
        formGroup.appendChild(inputGroup);
        return formGroup;
    }
    function createPhoneInput(number){
        var formGroup = document.createElement("div");
        var inputGroup = document.createElement("div");
        var span = document.createElement("span");
        var icon = document.createElement('i');
        var input = document.createElement("input");
        formGroup.classList.add('form-group');
        inputGroup.classList.add('input-group');
        span.classList.add('input-group-addon');
        icon.classList.add('fa');
        icon.classList.add('fa-phone');
        input.classList.add('form-control');
        input.classList.add('input-inline');
        input.classList.add('input-medium');
        input.setAttribute('type','text');
        input.setAttribute('placeholder','<?=__('Phone')?>');
        input.setAttribute('name','data[RelatedContact][' + number + '][phone]');
        span.appendChild(icon);
        inputGroup.appendChild(span);
        inputGroup.appendChild(input);
        formGroup.appendChild(inputGroup);
        return formGroup;
    }
    function createAdressInput(number){
        var formGroup = document.createElement("div");
        var textarea = document.createElement("textarea");
        formGroup.classList.add('form-group');
        textarea.classList.add('form-control');
        textarea.classList.add('input-inline');
        textarea.classList.add('input-medium');
        textarea.setAttribute('placeholder','<?=__('Address')?>');
        textarea.setAttribute('cols','30');
        textarea.setAttribute('rows','6');
        textarea.setAttribute('name','data[RelatedContact][' + number + '][address]');
        formGroup.appendChild(textarea);
        return formGroup;
    }
    function showRemoveButton(number){
        if(number == 0){
            $('#remove-related-contact-button').show();
        }
    }
    function constructRelatedContactContainer(number){
        var container = document.createElement("div");
        var hr = document.createElement("hr");
        container.classList.add('related-contact-form');
        container.appendChild(createNameInput(number));
        container.appendChild(createEmailInput(number));
        container.appendChild(createPhoneInput(number));
        container.appendChild(createAdressInput(number));
        container.appendChild(hr);
        return container;
    }
    function appendRelatedContactForm(container,number){
        if(number != 0){
            $('.related-contact-form:last').after(container);
        } else {
            $('#tab-related-contact').prepend(container);
        }
    }
    function hideRemoveButton(){
        var number = $('.related-contact-form').length;
        if(number == 0){
            $('#remove-related-contact-button').hide();
        }
    }
    function makeRelatedContactForm(){
        var number = $('.related-contact-form').length;
        showRemoveButton(number);
        var container = constructRelatedContactContainer(number);
        appendRelatedContactForm(container,number);
    }
    function removeLastRelatedContactForm(){
        $('.related-contact-form:last').remove();
        hideRemoveButton();
    }
    $(document).ready(function(){
        $('#remove-related-contact-button').hide();
    });
</script>