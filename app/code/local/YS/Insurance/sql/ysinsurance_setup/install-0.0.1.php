<?php
$installer = new Mage_Sales_Model_Resource_Setup('core_setup');
$installer->startSetup();


$installer->addAttribute(
    'quote', 
    'insurance',
    [
        'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
        'scale' => 12,
        'precision' => 4,
        'visible' => true,
        'required' => false
    ]
);

$installer->addAttribute(
    'quote',
    'shipping_without_insurance',
    [
        'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
        'scale' => 12,
        'precision' => 4,
        'visible' => true,
        'required' => false
    ]
);

$installer->addAttribute(
    'quote_address',
    'insurance',
    [
        'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
        'scale' => 12,
        'precision' => 4,
        'visible' => true,
        'required' => false
    ]
);

$installer->addAttribute(
    'quote_address',
    'shipping_without_insurance',
    [
        'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
        'scale' => 12,
        'precision' => 4,
        'visible' => true,
        'required' => false
    ]
);

$installer->addAttribute(
    'order',
    'insurance',
    [
        'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
        'scale' => 12,
        'precision' => 4,
        'visible' => true,
        'required' => false
    ]
);

$installer->addAttribute(
    'order',
    'shipping_without_insurance',
    [
        'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
        'scale' => 12,
        'precision' => 4,
        'visible' => true,
        'required' => false
    ]
);

$installer->addAttribute(
    'order_address',
    'insurance',
    [
        'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
        'scale' => 12,
        'precision' => 4,
        'visible' => true,
        'required' => false
    ]
);

$installer->addAttribute(
    'order_address',
    'shipping_without_insurance',
    [
        'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
        'scale' => 12,
        'precision' => 4,
        'visible' => true,
        'required' => false
    ]
);

$installer->endSetup();


