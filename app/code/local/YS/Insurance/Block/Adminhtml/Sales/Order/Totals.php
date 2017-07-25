<?php

class YS_Insurance_Block_Adminhtml_Sales_Order_Totals extends Mage_Adminhtml_Block_Sales_Order_Totals
{
    /**
     * Initialize order totals array
     *
     * @return Mage_Sales_Block_Order_Totals
     */
    protected function _initTotals()
    {
        parent::_initTotals();
        $amount =  $this->getSource()->getInsurance();
        if ($amount) {
            $this->addTotalBefore(new Varien_Object(array(
                'code' => 'insurance',
                'value' => $amount,
                'base_value' => $amount,
                'label' => $this->helper('insurance')->__('Insurance'),
            ), array('shipping', 'tax')));
        }

        return $this;
    }

}