<?php

class YS_Insurance_Block_Checkout_Insurance extends Mage_Checkout_Block_Onepage_Abstract
{
    protected function _construct()
    {
        $insuranceConfig = Mage::getStoreConfig("ysinsurance/rates");

        $quote =  $this->getCheckout()->getQuote();

        $shippingMethod = explode("_", $quote->getShippingAddress()->getShippingMethod());
        $shippingMethod = $shippingMethod[0];


        $currency = Mage::app()->getLocale()->currency($quote->getQuoteCurrencyCode())->getSymbol();
        $shippingInsuranceEnabled = $insuranceConfig['field_' . $shippingMethod . '_active'];

        $totalPrice = $quote->getShippingAddress()->getShippingWithoutInsurance();
        if (!$totalPrice) {
            $totalPrice = $quote->getTotals()['grand_total']->getData('value');;
        }

        $shippingInsuranceValue = false;
        $totalPriceWithInsurance = $totalPrice;

        if ($shippingInsuranceEnabled) {
            $countAsPercents = $insuranceConfig['field_' . $shippingMethod . '_percent'];
            if ($countAsPercents) {
                $insurancePercentsNumber = $insuranceConfig['field_' . $shippingMethod . '_percents_number'];
                $shippingInsuranceValue = ($totalPrice/100) * $insurancePercentsNumber;
            } else {
                $shippingInsuranceValue = $insuranceConfig['field_' . $shippingMethod . '_value'];
            }
            $totalPriceWithInsurance = $totalPrice + $shippingInsuranceValue;
        }

        $this->getCheckout()->setStepData('insurance', array(
            'label' => Mage::helper('checkout')->__('Shipping insurance'),
            'is_show' => $this->isShow(),
            'shipping_insurance' => $shippingInsuranceValue,
            'total' => $totalPrice,
            'total_with_insurance' => $totalPriceWithInsurance,
            'currency' => $currency,
        ));

        $this->getCheckout()->setStepData('insurance', 'allow', true);
        parent::_construct();
    }

}