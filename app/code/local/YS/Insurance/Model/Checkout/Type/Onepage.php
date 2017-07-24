<?php

class YS_Insurance_Model_Checkout_Type_Onepage extends Mage_Checkout_Model_Type_Onepage
{
    public function saveInsurance($insurance)
    {
        $quote = $this->getCheckout()->getQuote();
        if ($insurance) {
            $quote->setInsurance($insurance);
//          $this->getCheckout()->getQuote()->getShippingAddress()->setInsurance($insurance)->save();

            if (! $quote->getShippingWithoutInsurance() ) {
                $total = $quote->getTotals()['grand_total']->getData('value');
                $quote->setShippingWithoutInsurance($total);
            }
            $addresses = $this->getCheckout()->getQuote()->getAllShippingAddresses();
            foreach ($addresses as $address) {
                if (empty($address->getShippingWithoutInsurance())) {
                    $total = $quote->getTotals()['grand_total']->getData('value');
                    $address->setShippingWithoutInsurance($total);
                }
                $address->setInsurance($insurance)->save();
            }

        }

        $this->getCheckout()
            ->setStepData("insurance", "complete", true)
            ->setStepData("payment", "allow", true);

        return array();
    }

    public function saveShippingMethod($shippingMethod)
    {
        if (empty($shippingMethod)) {
            $res = array(
                "error" => -1,
                "message" => Mage::helper("checkout")->__("Invalid shipping method.")
            );
            return $res;
        }
        $rate = $this->getQuote()->getShippingAddress()->getShippingRateByCode($shippingMethod);
        if (!$rate) {
            $res = array(
                "error" => -1,
                "message" => Mage::helper("checkout")->__("Invalid shipping method.")
            );
            return $res;
        }
        $this->getQuote()->getShippingAddress()->setShippingMethod($shippingMethod);
        $this->getQuote()->collectTotals()->save();

        $this->getCheckout()
            ->setStepData("shipping_method", "complete", true)
            ->setStepData("insurance", "allow", true);

        return array();
    }
}