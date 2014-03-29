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
        $fromDate = date('Y-m-d H:i:s', strtotime($post['startDate'])); 
$toDate = date('Y-m-d H:i:s', strtotime($post['endDate']));
 
/* Get the collection */
$orders = Mage::getModel('sales/order')->getCollection()
    ->addAttributeToFilter('created_at', array('from'=>$fromDate, 'to'=>$toDate))
    ->addAttributeToFilter('status', array('eq' => Mage_Sales_Model_Order::STATE_COMPLETE));


$list = "";
foreach ($orders as $order) {
$list .= "<h2>".$order->getCreatedAt()." - " . $order->getId() . " for " . $order->getCustomerName() . " - $" . $order->getGrandTotal() . "</h2><table>";
foreach ($order->getAllItems() as $item) {
$product = $item->getProduct();
$list .= "<tr><td style='width:30px'>". round($item->getQtyOrdered()) . " </td><td style='width:100px'> " .$item->sku."</td><td style='width: 500px'> " . $item->getName() . "</td><td style='width:100px'>$" . round($item->getOriginalPrice(),2) . "</td><td style='width:100px'>".round(($item->getQtyOrdered() * $item->getOriginalPrice()),2)."</td></tr>";
}
$list .= "<tr><td>".round($order->getTotalQtyOrdered())."</td><td colspan=3></td><td>".round($order->getGrandTotal(),2)."</td></table><br/>";
}
$list .= "";
        $this->_addContent($this->getLayout()
            ->createBlock('core/text', 'example-block')
            ->setText('<h1>'.$post['startDate'] . ' - ' . $post['endDate'] .'</h1>'.$list));
        $this->_addContent($this->getLayout()->createBlock('qbcsv/adminhtml_edit_params'));
        $this->renderLayout();
    }
    protected function _addContent(Mage_Core_Block_Abstract $block)
    {
        $this->getLayout()->getBlock('content')->append($block);
        return $this;
    }
}
