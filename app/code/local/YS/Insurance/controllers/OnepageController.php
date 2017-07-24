<?php
require_once(Mage::getModuleDir('controllers', 'Mage_Checkout') . DS . 'OnepageController.php');

class YS_Insurance_OnepageController extends Mage_Checkout_OnepageController
{
    public function saveInsuranceAction()
    {
        if ($this->_expireAjax()) {
            return;
        }

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost('insurance', '');
            $result = $this->getOnepage()->saveInsurance($data['value']);
            if (!$result) {
                Mage::dispatchEvent(
                    'checkout_controller_onepage_save_insurance',
                    array(
                        'request' => $this->getRequest(),
                        'quote' => $this->getOnepage()->getQuote()));
                $this->_prepareDataJSON($result);

                $result['goto_section'] = 'payment';
                $result['update_section'] = array(
                    'name' => 'payment-method',
                    'html' => $this->_getPaymentMethodsHtml()
                );
            }
            $this->_prepareDataJSON($result);
        }
    }



    /**
     * Shipping method save action
     */
    public function saveShippingMethodAction()
    {

        if ($this->_expireAjax()) {
            return;
        }

        if ($this->isFormkeyValidationOnCheckoutEnabled() && !$this->_validateFormKey()) {
            return;
        }

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost('shipping_method', '');
            $this->getOnepage()->getCheckout()->getQuote()->getShippingAddress()->setShippingMethod($data);
            $result = $this->getOnepage()->saveShippingMethod($data);
            // $result will contain error data if shipping method is empty
            if (!$result) {
                Mage::dispatchEvent(
                    'checkout_controller_onepage_save_shipping_method',
                    array(
                        'request' => $this->getRequest(),
                        'quote' => $this->getOnepage()->getQuote()));
                $this->getOnepage()->getQuote()->collectTotals();
                $this->_prepareDataJSON($result);

                $result['goto_section'] = 'insurance';
                $result['update_section'] = array(
                    'name' => 'payment-method',
                    'html' => $this->_getPaymentMethodsHtml()
                );
            }
            $this->getOnepage()->getQuote()->collectTotals()->save();
            $this->_prepareDataJSON($result);
        }
    }
}
