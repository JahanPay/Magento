<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * @category     :  ModuleBank
 * @package      :  ModuleBank_JahanpayPayment
 *
 * @company      :  ModuleBank
 * @created by   :  Seyed Hamzeh Fazeli
 * @contact      :  www.ModuleBank.ir, support@modulebank.ir, 09160666110
 * @created on   :  15 September 2015
 * @copyright    :  Copyright (C) 2015. All rights reserved.
 * @author       :  Seyed Hamzeh Fazeli
 * @description  :  Jahanpay Gateway Payment for the component (Magento)
 */
class ModuleBank_Jahanpay_Block_Redirect extends Mage_Core_Block_Template
{
    /**
     * Return checkout session instance
     *
     * @return Mage_Checkout_Model_Session
     */
    protected function _getCheckout()
    {
        return Mage::getSingleton('checkout/session');
    }

    /**
     * Return order instance
     *
     * @return Mage_Sales_Model_Order|null
     */
    protected function _getOrder()
    {
        if ($this->getOrder()) {
            return $this->getOrder();
        } elseif ($orderIncrementId = $this->_getCheckout()->getLastRealOrderId()) {
            return Mage::getModel('sales/order')->loadByIncrementId($orderIncrementId);
        } else {
            return null;
        }
    }

	public function getFormData()
	{
		$order = $this->_getOrder()->_data;
		$array = $this->_getOrder()->getPayment()->getMethodInstance()->getFormFields();
		$price = $array["price"];
		$price = round($order["grand_total"],0);
		$callBackUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK);
		$callBackUrl .= "jahanpay/processing/response/?oID=".$order["entity_id"];
		date_default_timezone_set("Asia/Tehran");
		$pin = $this->_getOrder()->getPayment()->getMethodInstance()->getConfigData('seller_id');
		$ResNum   = time();
		$price    = intval($price * 10);

		$client = new SoapClient("http://www.jpws.me/directservice?wsdl");
		$res = $client->requestpayment($pin, $price, $callBackUrl, $ResNum);
		if($res['result']==1)
		{
			@session_start();
			$_SESSION['jau'] = $res['au'];
			$_SESSION['jam'] = $price;
			$_SESSION['jao'] = $ResNum;
			return array(1, '<div style="display:none;">'.$res['form'].'</div><script>document.forms["jahanpay"].submit();</script>');
		}
		else
		{
			return 'Error ('.$res['result'].') in RequestPayment...';
		}
    }
}
