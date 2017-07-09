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
class ModuleBank_Jahanpay_Block_Form extends Mage_Payment_Block_Form
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('jahanpay/form.phtml');
    }

    public function getPaymentImageSrc()
    {
    	$locale = strtolower(Mage::app()->getLocale()->getLocaleCode());
    	$imgSrc = $this->getSkinUrl('images/jahanpay/'.$locale.'_outl.gif');

    	if (!file_exists(Mage::getDesign()->getSkinBaseDir().'/images/jahanpay/'.$locale.'_outl.gif')) {
    		$imgSrc = $this->getSkinUrl('images/jahanpay/intl_outl.gif');
    	}
    	return $imgSrc;
    }
}