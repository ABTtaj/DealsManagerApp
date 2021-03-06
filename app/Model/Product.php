<?php

/**
 * class for performing all product related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2019
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Product extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Product';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'products';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    
    /**
     * Relation to type 
     *
     * @var array
     */
    public $belongsTo = array(
        'Type' => array(
            'className' => 'Type',
            'foreignKey' => 'type_id'
        )
    );

    /**
     * This function is used to get all products
     *
     * @access public
     * @return array
     */
    public function getAllProducts()
    {
        //query
        $result = $this->find('all', array('order' => array('Product.id DESC')));
        return $result;
    }

    /**
     * This function is used to get product by product id
     *
     * @access public
     * @return array
     */
    public function getProductById($productId)
    {
        //query
        $result = $this->find('first', array('conditions' => array('Product.id' => $productId)));
        return $result;
    }

    /**
     * This function is used to get product files by product id
     *
     * @access public
     * @return array
     */
    public function getProductFilesById($productId)
    {
        $product = $this->find('first', array('conditions' => array('Product.id' => $productId)));
        $customFields = json_decode($product['Product']['custom_fields'],true);
        $result = array();
        foreach($customFields as $customField => $details){
            if($details['type'] == 'file'){
                array_push($result,$details['value']);
            }
        }
        return $result;
    }

    /**
     * This function is used to get products in deal by deal id
     *
     * @access public
     * @return array
     */
    public function getProductsByDeal($dealId)
    {
        //query
        $results = $this->find('all', array('joins' => array(
                array('table' => 'product_deals',
                    'alias' => 'ProductDeal',
                    'type' => 'left',
                    'foreignKey' => false,
                    'conditions' => array('Product.id = ProductDeal.product_id')
                )
            ),
            'conditions' => array('ProductDeal.deal_id' => $dealId),
            'fields' => array('Product.id', 'Product.name', 'Product.price', 'ProductDeal.id', 'ProductDeal.quantity', 'ProductDeal.discount', 'ProductDeal.price'),
            'order' => array('Product.name ASC')
        ));
        return $results;
    }

    /**
     * This function is used to get product price by product id
     *
     * @access public
     * @return array
     */
    public function getProductPrice($productId)
    {
        //query
        $result = $this->find('first', array('conditions' => array('Product.id' => $productId), 'fields' => array('Product.price')));
        return $result;
    }

    /**
     * This function is used to get products in deal by deal id
     *
     * @access public
     * @return array
     */
    public function getProductsForDeal($Id)
    {
        //query
        $results = $this->find('first', array('joins' => array(
                array('table' => 'product_deals',
                    'alias' => 'ProductDeal',
                    'type' => 'left',
                    'foreignKey' => false,
                    'conditions' => array('Product.id = ProductDeal.product_id')
                )
            ),
            'conditions' => array('Product.id' => $Id),
            'fields' => array('Product.id', 'Product.name', 'Product.price', 'ProductDeal.id', 'ProductDeal.quantity', 'ProductDeal.discount', 'ProductDeal.price'),
        ));
        return $results;
    }

    /**
     * This function is used to get all products
     *
     * @access public
     * @return array
     */
    public function getProductList()
    {
        $result = $this->find('all', array('order' => array('Product.name ASC')));
        return $result;
    }

    /**
     * This function is used to get all products
     *
     * @access public
     * @return array
     */
    public function getAllProductList()
    {
        $result = $this->find('list', array('fields' => array('Product.id', 'Product.name'), 'order' => array('Product.name ASC')));
        return $result;
    }

    /**
     * This function is used to get all products id,name,price
     *
     * @access public
     * @return array
     */
    public function getAllProduct()
    {
        $result = $this->find('all', array('fields' => array('Product.id', 'Product.name', 'Product.price'), 'order' => array('Product.name ASC')));
        return $result;
    }
}
