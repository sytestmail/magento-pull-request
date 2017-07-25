<?php

class YS_Insurance_Block_Sales_Order_Creditmemo_Totals extends Mage_Sales_Block_Order_Totals
{
    protected function _initTotals()
    {
       return Mage::helper('ysinsurance')->addShippingInsuranceToTotals($this);
    }
}
