<?php

/**
 * Class for performing all type related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class TypesController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Type');

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
     * This function is used to display type home page.
     *
     * @var array
     */
    public function index()
    {
        //get all types
        $types = $this->Type->getAllTypes();

        //set variables to view
        $this->set(compact('types'));
    }

    /**
     * This function is used to add new type
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
                'required'=>isset($value['required']) ? $value['required'] : false
            ));
        }
        $this->request->data['Type']['fields'] = json_encode($fields);
        //save type
        if ($this->Type->save($this->request->data)) {
            //sucess message
            $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            //redirect to type home page
            return $this->redirect(
                array('controller' => 'types', 'action' => 'index')
            );
        } else {
            //return json failure message
            $response = array('bug' => 1, 'msg' => 'failure');
            return json_encode($response);
        } 
    }

    /**
     * This function is used to edit type
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
                $this->request->data['Type']['id'] = $this->request->data['pk'];
                $this->request->data['Type']['name'] = $this->request->data['value'];
                //update type
                $success = $this->Type->save($this->request->data);
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
     * This function is used to delete types
     *
     * @return json
     */
    public function delete()
    {
        // autorender off for view
        $this->autoRender = false;
        $typeId = $this->request->data['Type']['id'];
        if (!empty($typeId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete type
                $success = $this->Type->delete($typeId, false);
                if ($success) {
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $typeId);
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
     * This function is used to View for type details page
     *
     * @return array
     */
    public function view($id = null)
    {
        $userId = ($this->checkAdmin()) ? '' : $this->Auth->user('id');
        $userGId = $this->Auth->user('user_group_id');
        $groupId = $this->Auth->user('group_id');
        //get type
        $type = $this->Type->getTypeById($id);
        //set variables to view
        $this->set(compact('type'));
    }
}

/* End of file Types.php */
/* Location: ./app/Controller/Types.php */