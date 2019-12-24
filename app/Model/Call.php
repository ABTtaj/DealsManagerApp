<?php

/**
 * class for performing all call related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Call extends AppModel 
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Call';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'call_log';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array(
        'content' => array(
            'rule' => 'notblank',
            'required' => true,
        )
    );

    /**
     * Relation to user 
     *
     * @var array
     */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => false,
            'fields' => array('User.name'),
            'conditions' => 'User.id = Call.user_id',
        )
    );

    /**
     * This function is used to get call logs by deal id
     *
     * @access public
     * @return array
     */
    public function getCallsByDeal($dealId)
    {
        $results = $this->find('all', array(
            'conditions' => array('Call.deal_id' => $dealId),
            'order' => array('Call.id DESC'),
            'fields' => array('Call.id', 'Call.content','Call.deal_id','Call.user_id','Call.created', 'User.first_name', 'User.last_name','User.picture','User.job_title','User.email')
        ));
        return $results;
    }

    /**
     * This function is used to get all sources categories
     *
     * @access public
     * @return array
     */
    public function getAllCalls()
    {
        $result = $this->find('all', array('order' => array('Call.id DESC')));
        return $result;
    }

    /**
     * This function is used to get call by call id
     *
     * @access public
     * @return array
     */
    public function getCallById($sourceId)
    {
        $result = $this->find('first', array('conditions' => array('Call.id' => $sourceId)));
        return $result;
    }

    /**
     * This function is used to get call by call id
     *
     * @access public
     * @return array
     */
    public function getCallList()
    {
        $result = $this->find('all', array('order' => array('Call.name ASC')));
        return $result;
    }
}
