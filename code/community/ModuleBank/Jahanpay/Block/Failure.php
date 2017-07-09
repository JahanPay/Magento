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
class ModuleBank_Jahanpay_Block_Failure extends Mage_Core_Block_Template
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('jahanpay/failure.phtml');
    }

    /**
     * Get continue shopping url
     */
    public function getContinueShoppingUrl()
    {
        return Mage::getUrl('checkout/cart');
    }
}