<?php
/**
 * View for Contact details page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   http://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>

<!-- Content -->
<div class="row company-view">
    <div class="col-lg-12">
        <div class="row">
            <div class="main-box no-header clearfix">	
                <div class="main-box-body clearfix">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="clearfix">                               
                                <h1 class="pull-left"> 
                                    <?php $cImage = ($contact['Contact']['picture']) ? $contact['Contact']['picture'] : 'user.png'; ?>    
                                    <?= $this->Html->image('contact/thumb/' . $cImage); ?> 
                                    <?= h($contact['Contact']['name']); ?>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">                     
                        <div class="col-lg-12">
                            <dl class="dl-horizontal">
                                <dt><?php echo __('Title'); ?>:</dt> <dd><span class="label label-warning"><?= h($contact['Contact']['title']); ?></span></dd>
                                <dt><?php echo __('Email'); ?>:</dt> <dd><?= h($contact['Contact']['email']); ?></dd>
                                <dt><?php echo __('Phone'); ?>:</dt> <dd><?= h($contact['Contact']['phone']); ?></dd>
                                <dt><?php echo __('Website'); ?>:</dt> <dd> <?= h($contact['Contact']['website']); ?> </dd>
                                <dt><?php echo __('Address'); ?>:</dt> <dd>  <?= h($contact['Contact']['address']); ?></dd>
                                <dt><?php echo __('City'); ?>:</dt> <dd> <?= h($contact['Contact']['city']); ?> </dd>
                                <dt><?php echo __('State'); ?>:</dt> <dd> <?= h($contact['Contact']['state']); ?> </dd>
                                <dt><?php echo __('Zip Code'); ?>:</dt> <dd><?= h($contact['Contact']['zip_code']); ?> </dd>
                                <dt><?php echo __('Country'); ?>:</dt> <dd> <?= h($contact['Contact']['country']); ?> </dd>
                                <dt><?php echo __('Location'); ?>:</dt> <dd> <?= h($contact['Contact']['location']); ?> </dd>
                                <!-- Custom Fields -->
                                <?php foreach ($custom as $row): ?>
                                    <dt><?php echo h($row['Custom']['name']); ?>:</dt> <dd> 	<?php echo h($row['CustomContact']['value']); ?> </dd>                     
                                <?php endforeach; ?>
                            </dl>
                        </div>
                        <div class="col-lg-12">
                            <ul class="company-view-social">
                                <?php if (!empty($contact['Contact']['skype'])) : ?> <li> <a href="<?php echo h($contact['Contact']['skype']); ?>" target="_blank"><i class="fa fa-skype fa-3x"></i>  </a></li><?php endif; ?>       
                                <?php if (!empty($contact['Contact']['facebook'])) : ?><li><a href="<?php echo h($contact['Contact']['facebook']); ?>" target="_blank"><i class="fa fa-facebook-square fa-3x"></i> </a> </li><?php endif; ?>
                                <?php if (!empty($contact['Contact']['twitter'])) : ?><li><a href="<?php echo h($contact['Contact']['twitter']); ?>" target="_blank"><i class="fa fa-twitter-square fa-3x"></i>  </a></li><?php endif; ?>
                                <?php if (!empty($contact['Contact']['google_plus'])) : ?><li><a href="<?php echo h($contact['Contact']['google_plus']); ?>" target="_blank"><i class="fa fa-google-plus-square fa-3x"></i> </a></li><?php endif; ?>
                                <?php if (!empty($contact['Contact']['linkedIn'])) : ?><li><a href="<?php echo h($contact['Contact']['linkedIn']); ?>" target="_blank"><i class="fa fa-linkedin-square fa-3x"></i>  </a></li><?php endif; ?>                          
                                <?php if (!empty($contact['Contact']['youtube'])) : ?><li><a href="<?php echo h($contact['Contact']['youtube']); ?>" target="_blank"><i class="fa fa-youtube-square fa-3x"></i> </a></li><?php endif; ?>
                                <?php if (!empty($contact['Contact']['pinterest'])) : ?><li><a href="<?php echo h($contact['Contact']['pinterest']); ?>" target="_blank"><i class="fa fa-pinterest-square fa-3x"></i> </a></li><?php endif; ?>   
                                <?php if (!empty($contact['Contact']['tumblr'])) : ?><li><a href="<?php echo h($contact['Contact']['tumblr']); ?>" target="_blank"><i class="fa fa-tumblr-square fa-3x"></i> </a></li><?php endif; ?>   
                                <?php if (!empty($contact['Contact']['github'])) : ?><li><a href="<?php echo h($contact['Contact']['github']); ?>" target="_blank"><i class="fa fa-github-square fa-3x"></i> </a></li><?php endif; ?>  
                                <?php if (!empty($contact['Contact']['instagram'])) : ?><li><a href="<?php echo h($contact['Contact']['instagram']); ?>" target="_blank"><i class="fa  fa-instagram fa-3x"></i> </a></li><?php endif; ?>    
                                <?php if (!empty($contact['Contact']['digg'])) : ?><li><a href="<?php echo h($contact['Contact']['digg']); ?>" target="_blank"><i class="fa fa-digg fa-3x"></i> </a></li><?php endif; ?> 
                            </ul>   
                        </div>    
                    </div>
                    <div class="row m-t-sm">
                        <div class="col-lg-12">
                            <div class="panel blank-panel">
                                <div class="panel-heading">
                                    <div class="panel-options">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"><?php echo __('Deals'); ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div id="tab-1" class="tab-pane active">
                                            <table class="table table-striped user-list">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo __('Name'); ?></th>
                                                        <th><?php echo __('Pipeline'); ?></th>
                                                        <th><?php echo __('Stage'); ?></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($contact['Deals'] as $row) : ?>
                                                        <tr>
                                                            <td><a href="<?php echo $this->Html->url(array('controller' => 'deals', 'action' => 'view', h($row['Deal']['id']))); ?>">  <?= h($row['Deal']['name']); ?></a></td>
                                                            <td><?= h($row['Pipeline']['name']); ?></td>
                                                            <td><?= h($row['Stage']['name']); ?></td>
                                                            <td><?php $this->Common->status($row['Deal']['status']); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        if(!empty($contact['RelatedContacts'])){
                    ?>
                        <div class="row top-margin contact-list">
                            <?php 
                                foreach($contact['RelatedContacts'] as $row){
                            ?>            
                                <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12" id="<?php echo 'row' . h($row['Contact']['id']); ?>">
                                    <div class="main-box clearfix profile-box-contact">
                                        <div class="main-box-body clearfix">
                                            <div class="profile-box-header contact-box-list clearfix">
                                                <div class="col-sm-6">
                                                    <div class="text-center">
                                                        <?= $this->Html->image('contact/thumb/' . 'user.png', array('class' => 'img-circle m-t-xs ')); ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h2><?php echo $row['RelatedContact']['name']; ?></h2>
                                                    <ul class="contact-details">                                   
                                                        <li>
                                                            <?php echo ($row['RelatedContact']['email']) ? '<i class="fa fa-envelope"></i> ' . h($row['RelatedContact']['email']) : ''; ?>
                                                        </li>
                                                        <li>
                                                            <?php echo ($row['RelatedContact']['phone']) ? ' <i class="fa fa-phone"></i> ' . h($row['RelatedContact']['phone']) : ''; ?>
                                                        </li>
                                                        <li>
                                                            <?php echo ($row['RelatedContact']['location']) ? ' <i class="fa fa-map-marker"></i> ' . h($row['RelatedContact']['location']) : ''; ?>
                                                        </li>
                                                        <li>
                                                            <?php echo ($row['RelatedContact']['address']) ? ' <i class="fa fa-home"></i> ' . h($row['RelatedContact']['address']) : ''; ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>	
                                </div>
                            <?php
                                }
                            ?>		
                        </div>	
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>		
    </div>
</div>
<!--Theme Jquery -->
<?php echo $this->Html->css('jasny-bootstrap.min.css'); ?>
<?php echo $this->Html->script('jasny-bootstrap.min.js'); ?>
<!--End Theme Jquery -->