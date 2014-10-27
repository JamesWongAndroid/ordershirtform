<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $shirtOrderForm = new Application_Model_DbTable_ShirtOrderForm();
        $this->view->shirtorderform = $shirtOrderForm->fetchAll();
    }

    public function addAction()
    {
        $form = new Application_Form_ShirtOrderForm();
        $form->submit->setLable('Add');
        $this->view->form = $form;

        if ($this->getRequest()->$isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $firstName = $form->getValue('firstname');
                $lastName = $form->getValue('lastname');
                $address = $form->getValue('address');
                $shirtSize = $form->getValue('shirtsize');
                $shirtColor = $form->getValue('color');
                $shirtType = $form->getValue('shirttype');
                $shirtOrderForm->addOrderForm($firstName, $lastName, $address, $shirtSize, $shirtColor, $shirtType);

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
                $firstName = $form->getValue('firstname');
                $lastName = $form->getValue('lastname');
                $address = $form->getValue('address');
                $shirtSize = $form->getValue('shirtsize');
                $shirtColor = $form->getValue('color');
                $shirtType = $form->getValue('shirttype');
                $orderShirtForm = new Application_Model_DbTable_ShirtOrderForm();
                $orderShirtForm->updateOrderForm($firstName, $lastName, $address, $shirtSize, $shirtColor, $shirtType);

                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $orderShirtForm = new Application_Model_DbTable_ShirtOrderForm();
                $form->populate($orderShirtForm->getOrderForm($id));

            }
        }
    }

    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $orderShirtForm = new Application_Model_DbTable_ShirtOrderForm();
                $orderShirtForm->deleteOrderForm($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $orderShirtForm = new Application_Model_DbTable_ShirtOrderForm();
            $this->view->shirtorderform = $shirtorderform->getOrderForm($id);
        }
    }


}







