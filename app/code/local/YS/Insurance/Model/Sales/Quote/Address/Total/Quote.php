<?php

class YS_Insurance_Model_Sales_Quote_Address_Total_Quote extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
    protected $_code = 'insurance';

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return Mage::helper('ysinsurance')->__('Insurance');
    }
    
    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        parent::collect($address);
        if (($address->getAddressType() == 'billing')) {
            return $this;
        }

        $amount = $address->getInsurance();

        if ($amount) {
            $this->_setAmount($amount);
            $this->_setBaseAmount($amount);
        }

        return $this;
    }

    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        $amt = $address->getInsurance();
        $address->addTotal(array(
            'code' => $this->getCode(),
            'title' => Mage::helper('ysinsurance')->__('Shipping Insurance'),
            'value' => $amt
        ));
        return $this;
    }
    
}