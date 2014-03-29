<?php

class CLT_QBCSV_Block_Adminhtml_Edit_Params_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            //'action' => '/',
            'action' => $this->getUrl('*/*/export', array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post',
            'enctype' => 'multipart/form-data',
        ));
        $form->setUseContainer(true);

        $this->setForm($form);

        $fieldset = $form->addFieldset('qbcsv_dates', array(
            'legend' =>Mage::helper('qbcsv')->__('Date Range')
        ));
        $fieldset->addField('startDate', 'date', array(
            'label'     => Mage::helper('qbcsv')->__('Start'),
            'required'  => true,
            'name'      => 'startDate',
	    'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
	    'image'   => $this->getSkinUrl('images/grid-cal.gif'),
            'note'     => Mage::helper('qbcsv')->__('The start of report'),
        ));
        $fieldset->addField('endDate', 'date', array(
            'label'     => Mage::helper('qbcsv')->__('End'),
            'required'  => true,
            'name'      => 'endDate',
'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'image'   => $this->getSkinUrl('images/grid-cal.gif'),
            'note'     => Mage::helper('qbcsv')->__('The end of report'),
        ));
        return parent::_prepareForm();
    }
}
