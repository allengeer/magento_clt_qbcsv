<?php

class CLT_QBCSV_Block_Adminhtml_Edit_Params_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => '/',
            //'action' => $this->getUrl('*/*/export', array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post',
            'enctype' => 'multipart/form-data',
        ));

        $form->setUseContainer(true);

        $this->setForm($form);

        $fieldset = $form->addFieldset('qbcsv_dates', array(
            'legend' =>Mage::helper('qbcsv')->__('Date Range')
        ));
        $fieldset->addField('startDate', 'text', array(
            'label'     => Mage::helper('qbcsv')->__('Start'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'startDate',
            'note'     => Mage::helper('qbcsv')->__('The start of report'),
        ));
        $fieldset->addField('endDate', 'text', array(
            'label'     => Mage::helper('qbcsv')->__('End'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'endDate',
            'note'     => Mage::helper('qbcsv')->__('The end of report'),
        ));
        return parent::_prepareForm();
    }
}
