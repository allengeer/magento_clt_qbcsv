<?php
/**
 * Created by PhpStorm.
 * User: ageer
 * Date: 3/29/14
 * Time: 7:56 AM
 */

class CLT_QBCSV_TestController extends Mage_Adminhtml_Controller_Action {

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function editAction()
    {
//        $this->_setActiveMenu('qbexportmenu/qbexport');
        $this->loadLayout();
        $this->getLayout()->getBlock('content')->append($this->getLayout()->createBlock('qbcsv/adminhtml_edit_params'));
        $this->renderLayout();
    }

    public function exportAction()
    {
//        $this->_setActiveMenu('qbexportmenu/qbexport');

        $this->loadLayout();
        $post = $this->getRequest()->getPost();
        
        $this->_addContent($this->getLayout()
            ->createBlock('core/text', 'example-block')
            ->setText('<h1>'.$post['startDate'] . ' - ' . $post['endDate'] .'</h1>'));
        $this->_addContent($this->getLayout()->createBlock('qbcsv/adminhtml_edit_params'));
        $this->renderLayout();
    }
    protected function _addContent(Mage_Core_Block_Abstract $block)
    {
        $this->getLayout()->getBlock('content')->append($block);
        return $this;
    }
}
