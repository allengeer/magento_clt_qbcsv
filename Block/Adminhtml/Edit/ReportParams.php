<?php

class CLT_QBCSV_Block_Adminhtml_Edit_Reportparams extends Mage_Adminhtml_Block_Widget_Form_Container
{
/**
* Constructor
*/
    public function __construct()
    {
    parent::__construct();
    $this->_blockGroup = 'qbcsv';
    $this->_controller = 'adminhtml_edit_reportparams';

    $this->_addButton('generate', array(
    'label' => Mage::helper('adminhtml')->__('Generate CSV'),
    'onclick' => 'saveAndContinueEdit()',
    'class' => 'save',
    ), -100);

    $this->_formScripts[] = "

    function saveAndContinueEdit(){
    editForm.submit($('edit_form').action+'back/input/');
    }
    ";
    }

    public function getHeaderText() {
        return "Input date range";
    }


}