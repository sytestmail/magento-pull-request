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
        $source = $this->getSource();

        $this->_totals = array();
        $this->_totals['subtotal'] = new Varien_Object(array(
            'code'  => 'subtotal',
            'value' => $source->getSubtotal(),
            'label' => $this->__('Subtotal')
        ));

        /**
         * Add insurance
         */
        if (!$source->getIsVirtual() && ((float) $this->getOrder()->getShippingAddress()->getInsurance()))
        {
            $this->_totals['insurance'] = new Varien_Object(array(
                'code'  => 'insurance',
                'field' => 'insurance',
                'value' => $this->getOrder()->getShippingAddress()->getInsurance(),
                'label' => $this->__('Shipping insurance')
            ));
        }

        /**
         * Add shipping
         */
        if (!$source->getIsVirtual() && ((float) $source->getShippingAmount() || $source->getShippingDescription()))
        {
            $this->_totals['shipping'] = new Varien_Object(array(
                'code'  => 'shipping',
                'field' => 'shipping_amount',
                'value' => $this->getSource()->getShippingAmount(),
                'label' => $this->__('Shipping & Handling')
            ));
        }

        /**
         * Add discount
         */
        if (((float)$this->getSource()->getDiscountAmount()) != 0) {
            if ($this->getSource()->getDiscountDescription()) {
                $discountLabel = $this->__('Discount (%s)', $source->getDiscountDescription());
            } else {
                $discountLabel = $this->__('Discount');
            }
            $this->_totals['discount'] = new Varien_Object(array(
                'code'  => 'discount',
                'field' => 'discount_amount',
                'value' => $source->getDiscountAmount(),
                'label' => $discountLabel
            ));
        }
        
        
        $this->_totals['grand_total'] = new Varien_Object(array(
            'code'  => 'grand_total',
            'field'  => 'grand_total',
            'strong'=> true,
            'value' => $source->getGrandTotal(),
            'label' => $this->__('Grand Total')
        ));

        /**
         * Base grandtotal
         */
        if ($this->getOrder()->isCurrencyDifferent()) {
            $this->_totals['base_grandtotal'] = new Varien_Object(array(
                'code'  => 'base_grandtotal',
                'value' => $this->getOrder()->formatBasePrice($source->getBaseGrandTotal()),
                'label' => $this->__('Grand Total to be Charged'),
                'is_formated' => true,
            ));
        }
        return $this;
    }

}
