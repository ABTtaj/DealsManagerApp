<?php

/**
 * class for performing all webhook related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Webhook extends AppModel 
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Webhook';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'webhook';

    /**
     * model validation array
     *
     * @var array
     */ 
    var $validate = array(
        'name' => array(
            'rule' => 'notblank',
            'required' => true,
        )
    );
    
    /**
     * Relation to pipeline and source
     * @var array
     */
    public $belongsTo = array(
        'Pipeline' => array(
            'className' => 'Pipeline',
            'foreignKey' => 'pipeline_id'
        ),
        'Source' => array(
            'className' => 'Source',
            'foreignKey' => 'source_id'
        )
    );

    /**
     * This function is used to get all product webhooks
     *
     * @access public
     * @return array
     */
    public function getAllWebhooks()
    {
        $result = $this->find('all', array('order' => array('Webhook.id DESC')));
        return $result;
    }

    /**
     * This function is used to get webhook by webhook id
     *
     * @access public
     * @return array
     */
    public function getWebhookById($sourceId)
    {
        $result = $this->find('first', array('conditions' => array('Webhook.id' => $sourceId)));
        return $result;
    }

    /**
     * This function is used to get webhook by webhook id
     *
     * @access public
     * @return array
     */
    public function getWebhookList()
    {
        $result = $this->find('all', array('order' => array('Webhook.name ASC')));
        return $result;
    }
}
