<?php

class Application_Model_DbTable_ShirtOrderForm extends Zend_Db_Table_Abstract
{

    protected $_name = 'shirtorderform';

    // This function is to get a specific row in the DB
    public function getOrderForm($id) 
    {
    	$id = (int) $id;
    	$row = $this->fetchRow('id = ' . $id);
    	if (!$row) {
    		throw new Exception("Could not find row $id");
    	}
    	return $row->toArray();
    }

    // insert to DB
    public function addOrderForm($firstName, $lastName, $address, $shirtSize, $shirtColor, $shirtType)
    {
    	$data = array(
    		'firstname' => $firstName,
    		'lastname' => $lastName,
    		'address' => $address,
    		'shirtsize' => $shirtSize,
    		'color' => $shirtColor,
    		'shirttype' => $shirtType,
    		);
    	$this->insert($data);
    }

    // update DB with ID
    public function updateOrderForm($id, $firstName, $lastName, $address, $shirtSize, $shirtColor, $shirtType) 
    {
    	$data = array(
    		'firstname' => $firstName,
    		'lastname' => $lastName,
    		'address' => $address,
    		'shirtsize' => $shirtSize,
    		'color' => $shirtColor,
    		'shirttype' => $shirtType,
    		);
    	$this->update($data, 'id = '. (int)$id);
    }

    // Delete row from id parameter 
    public function deleteOrderForm($id)
    {
    	$this->delete('id =' . (int)$id);
    }


}

