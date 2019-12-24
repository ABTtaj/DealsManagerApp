<?php

/**
 * Class for performing all webhook related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class WebhooksController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Webhook','Pipeline','Source');

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
     * This function is used get data with the webhook.
     *
     */
    public function webhook($id)
    {
        if($this->request->is('POST')){
            //get the webhooks
            $webhook = $this->Webhook->getWebhookById($id);
        }
    }

    /**
     * This function is used to display webhook home page.
     *
     * @var array
     */
    public function index()
    {
        //get all webhooks
        $webhooks = $this->Webhook->getAllWebhooks();

        //set variables to view
        $this->set(compact('webhooks'));
    }

    /**
     * This function is used to add new webhook
     *
     * @return void
     */
    public function add()
    {
        // autorender off for view
        $this->autoRender = false;
        // manage fields
        $fields = array();
        foreach($this->request->data['Field'] as $value){
            array_push($fields,array(
                'name'=>$value['name'],
                'type'=>$value['type'],
            ));
        }
        $this->request->data['Webhook']['fields'] = json_encode($fields);
        //save webhook
        if ($this->Webhook->save($this->request->data)) {
            //sucess message
            $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            //redirect to webhook home page
            return $this->redirect(
                array('controller' => 'webhooks', 'action' => 'index')
            );
        } else {
            //return json failure message
            $response = array('bug' => 1, 'msg' => 'failure');
            return json_encode($response);
        } 
    }

    /**
     * This function is used to edit webhook
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
                $this->request->data['Webhook']['id'] = $this->request->data['pk'];
                $this->request->data['Webhook']['name'] = $this->request->data['value'];
                //update webhook
                $success = $this->Webhook->save($this->request->data);
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
     * This function is used to delete webhooks
     *
     * @return json
     */
    public function delete()
    {
        // autorender off for view
        $this->autoRender = false;
        $webhookId = $this->request->data['Webhook']['id'];
        if (!empty($webhookId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete webhook
                $success = $this->Webhook->delete($webhookId, false);
                if ($success) {
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $webhookId);
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
     * This function is used to View for webhook details page
     *
     * @return array
     */
    public function view($id = null)
    {        
        //get webhook
        $webhook = $this->Webhook->getWebhookById($id);
        //set variables to view
        $this->set(compact('webhook'));
    }
}

/* End of file Webhooks.php */
/* Location: ./app/Controller/Webhooks.php */