<?php

class Application_Form_ShirtOrderForm extends Zend_Form
{

    public function init()
    {
        $this->setName('shirtorderform');

        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $firstName = new Zend_Form_Element_Text('firstname');
        $firstName->setLabel('First Name')
        		  ->setRequired(true)
        		  ->addFilter('StripTags')
        		  ->addFilter('StringTrim')
        		  ->addValidator('NotEmpty'); 

        $lastName = new Zend_Form_Element_Text('lastname');
        $lastName->setLabel('Last Name')
        		  ->setRequired(true)
        		  ->addFilter('StripTags')
        		  ->addFilter('StringTrim')
        		  ->addValidator('NotEmpty');

        $address = new Zend_Form_Element_Text('address');
        $address->setLabel('Address')
        		  ->setRequired(true)
        		  ->addFilter('StripTags')
        		  ->addFilter('StringTrim')
        		  ->addValidator('NotEmpty');

        $shirtSize = new Zend_Form_Element_Text('shirtsize');
        $shirtSize->setLabel('Shirt Size')
        		  ->setRequired(true)
        		  ->addFilter('StripTags')
        		  ->addFilter('StringTrim')
        		  ->addValidator('NotEmpty'); 

        $shirtColor = new Zend_Form_Element_Text('color');
        $shirtColor->setLabel('Shirt Color')
        		  ->setRequired(true)
        		  ->addFilter('StripTags')
        		  ->addFilter('StringTrim')
        		  ->addValidator('NotEmpty');  

        $shirtType = new Zend_Form_Element_Text('shirttype');
        $shirtType->setLabel('Shirt Type')
        		  ->setRequired(true)
        		  ->addFilter('StripTags')
        		  ->addFilter('StringTrim')
        		  ->addValidator('NotEmpty');  

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $firstName, $lastName, $address, $shirtSize, $shirtColor, $shirtType, $submit));
    }


}

