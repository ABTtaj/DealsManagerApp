<?php

/**
 * Class for performing all campaign related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class CampaignsController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Campaign','Product','Source','CampaignProduct','CampaignSource');

    /**
     * This controller uses following helpers
     *
     * @var array
     */
    var $helpers = array('Html', 'Form', 'Js', 'Paginator', 'Time');

    /**
     * This controller uses following components
     *
     * @var array
     */
    var $components = array('Auth', 'Cookie', 'Session', 'Paginator', 'RequestHandler', 'Flash');

    /**
     * Called before the controller action.  You can use this method to configure and customize components
     * or perform logic that needs to happen before each controller action.
     *
     * @return void
     */
    public function beforeFilter()
    {
        parent::beforeFilter();
        //check if login
        $this->checkLogin();
        //set layout
        $this->layout = 'admin';
    }

    /**
     * This function is used to display campaign home page.
     *
     * @var array
     */
    public function index()
    {
        //get all campaigns
        $campaigns = $this->Campaign->getAllCampaigns();
        $products = $this->Product->getProductList();
        $sources = $this->Source->getSourceList();
        //set variables to view
        $this->set(compact('campaigns','products','sources'));
    }

    /**
     * This function is used to add new campaign
     *
     * @return void
     */
    public function add()
    {
        // autorender off for view
        $this->autoRender = false;
        $this->request->data['Campaign']['start'] = date('Y-m-d', strtotime($this->request->data['Campaign']['start']));
        $this->request->data['Campaign']['end'] = date('Y-m-d', strtotime($this->request->data['Campaign']['end']));

        //save campaign
        if ($this->Campaign->save($this->request->data)) {
            $campaignId = $this->Campaign->getLastInsertId();
            //save sources
            if (isset($this->request->data['Campaign']['sources'])):
                foreach ($this->request->data['Campaign']['sources'] as $value):
                    $this->CampaignSource->create();
                    $this->request->data['CampaignSource']['source_id'] = $value;
                    $this->request->data['CampaignSource']['campaign_id'] = $campaignId;
                    $this->CampaignSource->save($this->request->data);
                endforeach;
            endif;
            //save products
            if (isset($this->request->data['Campaign']['products'])):
                foreach ($this->request->data['Campaign']['products'] as $value):
                    $this->CampaignProduct->create();
                    $this->request->data['CampaignProduct']['product_id'] = $value;
                    $this->request->data['CampaignProduct']['campaign_id'] = $campaignId;
                    $this->CampaignProduct->save($this->request->data);
                endforeach;
            endif;
            //sucess message
            $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            //redirect to campaign home page
            return $this->redirect(
                    array('controller' => 'campaigns', 'action' => 'index')
            );
        } else {
            //return json failure message
            $response = array('bug' => 1, 'msg' => 'failure');
            return json_encode($response);
        } 
    }

    /**
     * This function is used to edit campaign
     *
     * @return json
     */
    public function edit()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            //--------- Ajax request  -----------
            if ($this->RequestHandler->isAjax()) {
                $this->layout = 'ajax';
                //common variables
                $this->request->data['Campaign']['id'] = $this->request->data['pk'];
                $this->request->data['Campaign']['name'] = $this->request->data['value'];
                //update campaign
                $success = $this->Campaign->save($this->request->data);
                if ($success) {
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success');
                    return json_encode($response);
                } else {
                    //return json failure message
                    $response = array('bug' => 1, 'msg' => 'failure');
                    return json_encode($response);
                }
            }
        }
    }

    /**
     * This function is used to delete campaigns
     *
     * @return json
     */
    public function delete()
    {
        // autorender off for view
        $this->autoRender = false;
        $campaignId = $this->request->data['Campaign']['id'];
        if (!empty($campaignId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete campaign
                $success = $this->Campaign->delete($campaignId, false);
                if ($success) {
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $campaignId);
                    return json_encode($response);
                } else {
                    //return json failure message
                    $response = array('bug' => 1, 'msg' => 'failure');
                    return json_encode($response);
                }
            }
        }
    }


    /**
     * This function is used to View for campaign details page
     *
     * @return array
     */
    public function view($id = null)
    {
        //get campaign
        $campaign = $this->Campaign->getCampaignById($id);
        //set variables to view
        $this->set(compact('campaign'));
    }
}

/* End of file Campaigns.php */
/* Location: ./app/Controller/Campaigns.php */