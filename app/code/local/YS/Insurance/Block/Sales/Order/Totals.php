<?php

class YS_Insurance_Block_Sales_Order_Totals extends Mage_Sales_Block_Order_Totals
{
    protected function _initTotals()
    {

            Mage::helper('ysinsurance')->addShippingInsuranceToTotals($this);
    }
}
