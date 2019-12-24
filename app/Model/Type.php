<?php

/**
 * class for performing all type related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Type extends AppModel 
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Type';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'type';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array(
        'name' => array(
            'rule' => 'notblank',
            'required' => true,
        )
    );
    
    /**
     * Relation to product 
     *
     * @var array
     */
    public $hasMany = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'type_id',
        )
    );

    /**
     * This function is used to get all product types
     *
     * @access public
     * @return array
     */
    public function getAllTypes()
    {
        $result = $this->find('all', array('order' => array('Type.id DESC')));
        return $result;
    }

    /**
     * This function is used to get type by type id
     *
     * @access public
     * @return array
     */
    public function getTypeById($typeId)
    {
        $result = $this->find('first', array('conditions' => array('Type.id' => $typeId)));
        return $result;
    }

    /**
     * This function is used to get type by type id
     *
     * @access public
     * @return array
     */
    public function getTypeList()
    {
        $result = $this->find('all', array('order' => array('Type.name ASC')));
        return $result;
    }
}
