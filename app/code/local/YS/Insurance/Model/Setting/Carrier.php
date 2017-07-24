<?php

class YS_Insurance_Model_Setting_Carrier extends Mage_Core_Model_Config_Data
{
    /**
     * Get fields prefixes
     *
     * @return array
     */
    public function getPrefixes()
    {
        $prefixes = array();
        $carriers = Mage::getSingleton('shipping/config')->getAllCarriers();

        foreach ($carriers as $carrier) {
            $prefixes[] = array(
                'field' => sprintf('field_%s_', $carrier->getCarrierCode()),
                'label' => $carrier->getConfigData('title'),
            );
        }
        return $prefixes;
    }
}