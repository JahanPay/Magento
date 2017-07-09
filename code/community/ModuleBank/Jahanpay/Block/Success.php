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
class ModuleBank_Jahanpay_Block_Success extends Mage_Core_Block_Template
{
    protected function _toHtml()
    {
        $successUrl = Mage::getUrl('*/*/success', array('_secure'=>true));

        $html	= '<html>'
        		. '<meta http-equiv="refresh" content="0; URL='.$successUrl.'">'
        		. '<body>'
        		. '<p>' . $this->__('پرداخت شما با موفقیت انجام پذیرفت.') . '</p>'
        		. '<p>' . $this->__('برای ادامه روی <a href="%s">این لینک</a> کلیک کنید', $successUrl) . '</p>'
        		. '</body></html>';

        return $html;
    }
}