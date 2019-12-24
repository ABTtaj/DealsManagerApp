<?php

/**
 * class for performing all campaign product related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class CampaignProduct extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'CampaignProduct';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'campaign_product';

    /**
     * This function is used to get assign product to campaign by product and campaign
     *
     * @access public
     * @return array
     */
    public function getCampaignProduct($campaignId, $productId)
    {
        $result = $this->find('first', array('conditions' => array('product_id' => $productId, 'campaign_id' => $campaignId)));
        return $result;
    }

    /**
     * This function is used to get count of assign products to campaign
     *
     * @access public
     * @return array
     */
    public function getProductCount($campaignId)
    {
        $result = $this->find('count', array('conditions' => array('campaign_id' => $campaignId)));
        return $result;
    }
}
