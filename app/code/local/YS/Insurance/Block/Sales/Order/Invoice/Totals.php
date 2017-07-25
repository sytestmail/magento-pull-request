<?php

class YS_Insurance_Block_Sales_Order_Invoice_Totals extends Mage_Sales_Block_Order_Invoice_Totals
{
    /**
     * Initialize order totals array
     *
     * @return Mage_Sales_Block_Order_Totals
     */
    protected function _initTotals()
    {
        return Mage::helper('ysinsurance')->addShippingInsuranceToTotals($this);
    }
}
