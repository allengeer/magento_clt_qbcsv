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
        $this->loadLayout()->renderLayout();
    }
}