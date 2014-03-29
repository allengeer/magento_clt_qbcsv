<?php
/**
 * Created by PhpStorm.
 * User: ageer
 * Date: 3/29/14
 * Time: 7:56 AM
 */

class CLT_QBCSV_Adminhtml_QbExportController extends Mage_Adminhtml_Controller_Action {

    public function indexAction()
    {
        $this->_setActiveMenu('qbexportmenu/qbexport');
        $this->loadLayout();
        $this->loadLayout()->renderLayout();
    }

    public function editAction()
    {
        $this->_setActiveMenu('qbexportmenu/qbexport');
        $this->loadLayout();
        $this->getResponse()->setBody($this->getLayout()->createBlock('qbcsv/adminhtml_edit_reportparams')->toHtml());
    }
    public function exportAction()
    {
        $this->_setActiveMenu('qbexportmenu/qbexport');
        $this->loadLayout();
        $this->loadLayout()->renderLayout();
    }
}