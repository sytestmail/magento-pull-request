<?php

class YS_Insurance_Block_Sales_Order_Creditmemo_Totals extends Mage_Sales_Block_Order_Totals
{
    /**
     * Initialize order totals array
     *
     * @return Mage_Sales_Block_Order_Totals
     */
    protected function _initTotals()
    {
        parent::_initTotals();
        $this->removeTotal('base_grandtotal');
        if ((float) $this->getSource()->getAdjustmentPositive()) {
            $total = new Varien_Object(array(
                'code'  => 'adjustment_positive',
                'value' => $this->getSource()->getAdjustmentPositive(),
                'label' => $this->__('Adjustment Refund')
            ));
            $this->addTotal($total);
        }


        /**
         * Add insurance
         */
        if (!$this->getSource()->getIsVirtual() && ((float) $this->getOrder()->getShippingAddress()->getInsurance()))
        {
            $this->_totals['insurance'] = new Varien_Object(array(
                'code'  => 'insurance',
                'field' => 'insurance',
                'value' => $this->getOrder()->getShippingAddress()->getInsurance(),
                'label' => $this->__('Shipping insurance')
            ));
        }

        if ((float) $this->getSource()->getAdjustmentNegative()) {
            $total = new Varien_Object(array(
                'code'  => 'adjustment_negative',
                'value' => $this->getSource()->getAdjustmentNegative(),
                'label' => $this->__('Adjustment Fee')
            ));
            $this->addTotal($total);
        }

        return $this;
    }
}
