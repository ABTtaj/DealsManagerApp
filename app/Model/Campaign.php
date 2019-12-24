<?php

/**
 * class for performing all campaign related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Campaign extends AppModel 
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Campaign';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'campaign';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array(
        'name' => array(
            'rule' => 'notblank',
            'required' => true,
        ),
        'cost' => array(
            'notblank' => array(
                'rule' => 'notblank',
                'required' => true,
            ),
            'numeric' => array(
                'rule' => 'numeric',
            ),
        ),
        'start' => array(
            'notblank' => array(
                'rule' => 'notblank',
                'required' => true,
            ),
            'date' => array(
                'rule' => 'date',
            ),
        ),
        'end' => array(
            'notblank' => array(
                'rule' => 'notblank',
                'required' => true,
            ),
            'date' => array(
                'rule' => 'date',
            ),
        )
    );


    /**
     * Relation to Product 
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Product' =>
            array(
                'className' => 'Product',
                'joinTable' => 'campaign_product',
                'foreignKey' => 'campaign_id',
                'associationForeignKey' => 'product_id',
                'unique' => true,
            ),
        'Source' =>
        array(
            'className' => 'Source',
            'joinTable' => 'campaign_source',
            'foreignKey' => 'campaign_id',
            'associationForeignKey' => 'source_id',
            'unique' => true,
        )
    );

    /**
     * This function is used to get all sources categories
     *
     * @access public
     * @return array
     */
    public function getAllCampaigns()
    {
        $result = $this->find('all', array('order' => array('Campaign.id DESC')));
        return $result;
    }

    /**
     * This function is used to get campaign by campaign id
     *
     * @access public
     * @return array
     */
    public function getCampaignById($sourceId)
    {
        $result = $this->find('first', array('conditions' => array('Campaign.id' => $sourceId)));
        return $result;
    }

    /**
     * This function is used to get campaign by campaign id
     *
     * @access public
     * @return array
     */
    public function getCampaignList()
    {
        $result = $this->find('all', array('order' => array('Campaign.name ASC')));
        return $result;
    }
}
