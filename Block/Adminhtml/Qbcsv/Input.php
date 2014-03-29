<?php

class CLT_QBCSV_Block_Adminhtml_Qbcsv_Input extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'qbcsv';
        $this->_controller = 'adminhtml_qbcsv';
        $this->_mode = 'input';

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

    protected function _prepareLayout()
    {
        if ($this->_blockGroup && $this->_controller && $this->_mode) {
            $this->setChild('form', $this->getLayout()->createBlock($this->_blockGroup . '/' . $this->_controller . '_' . $this->_mode . '_form'));
        }
        return parent::_prepareLayout();
    }
}