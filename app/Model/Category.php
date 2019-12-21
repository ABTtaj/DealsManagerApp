<?php

/**
 * class for performing all category related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Category extends AppModel 
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Category';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'category';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array(
        'name' => array(
            'rule' => 'notempty',
            'required' => true,
        )
    );

    /**
     * This function is used to get all sources categories
     *
     * @access public
     * @return array
     */
    public function getAllCategories()
    {
        $result = $this->find('all', array('order' => array('Category.id DESC')));
        return $result;
    }

    /**
     * This function is used to get category by category id
     *
     * @access public
     * @return array
     */
    public function getCategoryById($sourceId)
    {
        $result = $this->find('first', array('conditions' => array('Category.id' => $sourceId)));
        return $result;
    }

    /**
     * This function is used to get category by category id
     *
     * @access public
     * @return array
     */
    public function getCategoryList()
    {
        $result = $this->find('all', array('order' => array('Category.name ASC')));
        return $result;
    }
}
