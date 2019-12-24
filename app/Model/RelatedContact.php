<?php

/**
 * class for performing all type related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class RelatedContact extends AppModel 
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'RelatedContact';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'related_contact';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array(
        'name' => array(
            'rule' => 'notblank',
            'required' => true,
        ),
    );

    /**
     * Relation to user 
     *
     * @var array
     */
    public $belongsTo = array(
        'Contact' => array(
            'className' => 'Contact',
            'foreignKey' => false,
            'fields' => array('Contact.name'),
            'conditions' => 'Contact.id = RelatedContact.contact_id',
        )
    );

    /**
     * This function is used to get files by deal id
     *
     * @access public
     * @return array
     */
    public function getRelatedContactByContact($contactId)
    {
        $results = $this->find('all', array(
            'conditions' => array('RelatedContact.contact_id' => $contactId),
            'order' => array('RelatedContact.id DESC'),
            'fields' => array('RelatedContact.id', 'RelatedContact.name', 'RelatedContact.email', 'RelatedContact.phone', 'RelatedContact.address')
        ));
        return $results;
    }

    /**
     * This function is used to get all related contacts
     *
     * @access public
     * @return array
     */
    public function getAllRelatedContacts()
    {
        $result = $this->find('all', array('order' => array('RelatedContact.id DESC')));
        return $result;
    }

    /**
     * This function is used to get related contact by related contact id
     *
     * @access public
     * @return array
     */
    public function getRelatedContactById($relatedContactId)
    {
        $result = $this->find('first', array('conditions' => array('RelatedContact.id' => $relatedContactId)));
        return $result;
    }

    /**
     * This function is used to get reltedContactList
     *
     * @access public
     * @return array
     */
    public function getRelatedContactList()
    {
        $result = $this->find('all', array('order' => array('RelatedContact.name ASC')));
        return $result;
    }
}
