<?php

/**
 * class for performing all campaign source related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class CampaignSource extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'CampaignSource';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'campaign_source';

    /**
     * This function is used to get assign source to campaign by source and campaign
     *
     * @access public
     * @return array
     */
    public function getCampaignSource($campaignId, $sourceId)
    {
        $result = $this->find('first', array('conditions' => array('source_id' => $sourceId, 'campaign_id' => $campaignId)));
        return $result;
    }

    /**
     * This function is used to get count of assign sources to campaign
     *
     * @access public
     * @return array
     */
    public function getSourceCount($campaignId)
    {
        $result = $this->find('count', array('conditions' => array('campaign_id' => $campaignId)));
        return $result;
    }
}
