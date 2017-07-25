<?php

class YS_Insurance_Model_Sales_Order_Pdf_Total_Pdf extends Mage_Sales_Model_Order_Pdf_Total_Default
{
    public function getTotalsForDisplay()
    {

        $amount = $this->getOrder()->formatPriceTxt($this->getAmount());

        if ($this->getAmountPrefix()) {
            $amount = $this->getAmountPrefix().$amount;
        }
        $title = $this->_getSalesHelper()->__($this->getTitle());
        if ($this->getTitleSourceField()) {
            $label = $title . ' (' . $this->getTitleDescription() . '):';
        } else {
            $label = $title . ':';
        }
        $fontSize = $this->getFontSize() ? $this->getFontSize() : 7;
        $total[0] = array(
            'amount'  => $amount,
            'label'   => $label,
            'font_size' => $fontSize
        );
        return $total;

    }
}
