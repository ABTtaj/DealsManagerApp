<?php

/**
 * Class for performing all call related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class CallsController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Call');

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
     * This function is used to display call home page.
     *
     * @var array
     */
    public function index()
    {
        //get all calls
        $calls = $this->Call->getAllCalls();

        //set variables to view
        $this->set(compact('calls'));
    }

    /**
     * This function is used to add new call
     *
     * @return void
     */
    public function add()
    {
        // autorender off for view
        $this->autoRender = false;
        $this->request->data['Call']['user_id'] = $this->Auth->user('id');
        $dealId = $this->request->data['Call']['deal_id'];
        //save call log
        if ($this->Call->save($this->request->data)) {
            //success message
            $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
        } else {
            //failure message
            $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
        }
        //redirect to deal view
        if ($this->checkClient()):
            return $this->redirect(
                    array('controller' => 'Deals', 'action' => 'cview', $dealId)
            );
        else:
            return $this->redirect(
                    array('controller' => 'Deals', 'action' => 'view', $dealId)
            );
        endif;
        
    }

    /**
     * This function is used to edit call
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
                $this->request->data['Call']['id'] = $this->request->data['pk'];
                $this->request->data['Call']['name'] = $this->request->data['value'];
                //update call
                $success = $this->Call->save($this->request->data);
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
     * This function is used to delete calls
     *
     * @return json
     */
    public function delete()
    {
        // autorender off for view
        $this->autoRender = false;
        $callId = $this->request->data['Call']['id'];
        if (!empty($callId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete call
                $success = $this->Call->delete($callId, false);
                if ($success) {
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $callId);
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
     * This function is used to View for call details page
     *
     * @return array
     */
    public function view($id = null)
    {
        $userId = ($this->checkAdmin()) ? '' : $this->Auth->user('id');
        $userGId = $this->Auth->user('user_group_id');
        $groupId = $this->Auth->user('group_id');
        //get call
        $call = $this->Call->getCallById($id);
        //set variables to view
        $this->set(compact('call', 'deals'));
    }
}

/* End of file Calls.php */
/* Location: ./app/Controller/Calls.php */