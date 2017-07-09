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
class ModuleBank_Jahanpay_Model_Config_Backend_Sellerid extends Mage_Core_Model_Config_Data
{
    /**
     * Verify seller id in ClickandBuy registration system to reduce configuration failures (experimental)
     *
     * @return ModuleBank_Jahanpay_Model_Jahanpay_Config_Backend_Sellerid
     */
    protected function _beforeSave()
    {
    	try {
    	    if ($this->getValue()) {
    			$client = new Varien_Http_Client();
    			$client->setUri((string)Mage::getConfig()->getNode('modulebank/jahanpay/verify_url'))
    				->setConfig(array('timeout'=>10,))
    				->setHeaders('accept-encoding', '')
    				->setParameterPost('seller_id', $this->getValue())
    				->setMethod(Zend_Http_Client::POST);
    			$response = $client->request();
//    			$responseBody = $response->getBody();
//    			if (empty($responseBody) || $responseBody != 'VERIFIED') {
    				// verification failed. throw error message (not implemented yet).
//    			}

    			// okay, seller id verified. continue saving.
    	    }
		} catch (Exception $e) {
			// verification system unavailable. no further action.
		}

        return $this;
    }
}
