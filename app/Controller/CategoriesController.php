<?php

/**
 * Class for performing all category related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class CategoriesController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Category');

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
     * This function is used to display category home page.
     *
     * @var array
     */
    public function index()
    {
        //get all categories
        $categories = $this->Category->getAllCategories();

        //set variables to view
        $this->set(compact('categories'));
    }

    /**
     * This function is used to add new category
     *
     * @return void
     */
    public function add()
    {
        // autorender off for view
        $this->autoRender = false;

        //save category
        if ($this->Category->save($this->request->data)) {
            //sucess message
            $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            //redirect to category home page
            return $this->redirect(
                    array('controller' => 'categories', 'action' => 'index')
            );
        } else {
            //return json failure message
            $response = array('bug' => 1, 'msg' => 'failure');
            return json_encode($response);
        } 
    }

    /**
     * This function is used to edit category
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
                $this->request->data['Category']['id'] = $this->request->data['pk'];
                $this->request->data['Category']['name'] = $this->request->data['value'];
                //update category
                $success = $this->Category->save($this->request->data);
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
     * This function is used to delete categories
     *
     * @return json
     */
    public function delete()
    {
        // autorender off for view
        $this->autoRender = false;
        $categoryId = $this->request->data['Category']['id'];
        if (!empty($categoryId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete category
                $success = $this->Category->delete($categoryId, false);
                if ($success) {
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $categoryId);
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
     * This function is used to View for category details page
     *
     * @return array
     */
    public function view($id = null)
    {
        //get category
        $category = $this->Category->getCategoryById($id);
        //set variables to view
        $this->set(compact('category'));
    }
}

/* End of file Categories.php */
/* Location: ./app/Controller/Categories.php */