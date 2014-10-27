<?php

class IndexController extends Zend_Controller_Action
{
    // This function is called during startup
    public function init()
    {
        /* Initialize action controller here */
    }

    // this function is called when index is running
    public function indexAction()
    {
        // create an object of the database model, then displays all the rows of db
        $shirtOrderForm = new Application_Model_DbTable_ShirtOrderForm();
        $this->view->shirtorderform = $shirtOrderForm->fetchAll();
    }

    // this controller will handle adding content to the DB
    public function addAction()
    {
        // First we create an object of the form we created through Zend
        $form = new Application_Form_ShirtOrderForm();
        $form->submit->setLabel('Add');
        // show the view of the form
        $this->view->form = $form;

        //checks if there is request that is sent
        if ($this->getRequest()->isPost()) {
            //retreive the form information
            $formData = $this->getRequest()->getPost();
            // Checks to see if all fields are fill out properly
            if ($form->isValid($formData)) {
                // putting the values into variables
                $firstName = $form->getValue('firstname');
                $lastName = $form->getValue('lastname');
                $address = $form->getValue('address');
                $shirtSize = $form->getValue('shirtsize');
                $shirtColor = $form->getValue('color');
                $shirtType = $form->getValue('shirttype');
                // Create an instance of DB model, so that we can use function
                // to insert into the database
                $shirtOrderForm = new Application_Model_DbTable_ShirtOrderForm();
                $shirtOrderForm->addOrderForm($firstName, $lastName, $address, $shirtSize, $shirtColor, $shirtType);
                // back to the index view
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }

        }
    }

    public function editAction()
    {
        $form = new Application_Form_ShirtOrderForm();
        $form->submit->setLabel('Save');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                //Same as add, but here we need to retreive the ID as well
                // so that we know which row to update completely
                $id = (int)$form->getValue('id');
                $firstName = $form->getValue('firstname');
                $lastName = $form->getValue('lastname');
                $address = $form->getValue('address');
                $shirtSize = $form->getValue('shirtsize');
                $shirtColor = $form->getValue('color');
                $shirtType = $form->getValue('shirttype');
                $orderShirtForm = new Application_Model_DbTable_ShirtOrderForm();
                //Our DBObject will use the updateOrderForm to update the DB
                $orderShirtForm->updateOrderForm($id, $firstName, $lastName, $address, $shirtSize, $shirtColor, $shirtType);
                // back to index
                $this->_helper->redirector('index');
            } else {
                // if not posted, display selected data 
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                // if not null, grab selected row and display its data
                $orderShirtForm = new Application_Model_DbTable_ShirtOrderForm();
                $form->populate($orderShirtForm->getOrderForm($id));

            }
        }
    }

    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
            // checks if the POST is from delete button, and retreives yes or no
            $del = $this->getRequest()->getPost('del');

            if ($del == 'Yes') {
                // retreives the id of row, and deletes it with our DBHelper Object
                $id = $this->getRequest()->getPost('id');
                $orderShirtForm = new Application_Model_DbTable_ShirtOrderForm();
                $orderShirtForm->deleteOrderForm($id);
            }
            // back to index
            $this->_helper->redirector('index');
        } else {
            // if not POST, grab info through the select row's ID
            $id = $this->_getParam('id', 0);
            $orderShirtForm = new Application_Model_DbTable_ShirtOrderForm();
            $this->view->shirtorderform = $orderShirtForm->getOrderForm($id);
        }
    }


}







