<?php

/**
 * Created by PhpStorm.
 * User: ageer
 * Date: 3/29/14
 * Time: 7:56 AM
 */
class CLT_QBCSV_TestController extends Mage_Adminhtml_Controller_Action
{

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
            ->addAttributeToFilter('created_at', array('from' => $fromDate, 'to' => $toDate))
            ->addAttributeToFilter('status', array('eq' => Mage_Sales_Model_Order::STATE_COMPLETE));


        $headers = array('order_num','date', 'customer', 'sku', 'item','description', 'qty', 'price','total_price',
                        'bill_address1','bill_address2','bill_address3','bill_address4','bill_city','bill_state','bill_zip', 'bill_country',
                        'ship_address1','ship_address2','ship_address3','ship_address4','ship_city','ship_state','ship_zip', 'ship_country',
                        'payment_method'
        );
        $fd = fopen('php://temp/maxmemory:1048576', 'w');
        fputcsv($fd, $headers);
        foreach ($orders as $order) {

            foreach ($order->getAllItems() as $item) {
                $product = Mage::getModel('catalog/product')->load($item->getProductId());
                fputcsv($fd, array($order->getId(), $order->getCreatedAt(), $order->getCustomerName(),  $item->sku,$item->getName(),$product->getDescription(), round($item->getQtyOrdered()),round($item->getOriginalPrice(), 2),
                    round($item->getQtyOrdered()*$item->getOriginalPrice(), 2),
                    $order->getBillingAddress()->getStreet1(),$order->getBillingAddress()->getStreet2(),$order->getBillingAddress()->getStreet3(),$order->getBillingAddress()->getStreet4(),$order->getBillingAddress()->getCity(), $order->getBillingAddress()->getRegion(), $order->getBillingAddress()->getCountry(),
                    $order->getShippingAddress()->getStreet1(),$order->getShippingAddress()->getStreet2(),$order->getShippingAddress()->getStreet3(),$order->getShippingAddress()->getStreet4(),$order->getShippingAddress()->getCity(), $order->getShippingAddress()->getRegion(), $order->getShippingAddress()->getCountry(),
                    $order->getPayment()->getMethodInstance()->getTitle()
                ));
            }
        }
        rewind($fd);
        $csv = stream_get_contents($fd);
        fclose($fd);

        $this->_prepareDownloadResponse('order.csv', $csv);
    }

    protected function _addContent(Mage_Core_Block_Abstract $block)
    {
        $this->getLayout()->getBlock('content')->append($block);
        return $this;
    }
}
