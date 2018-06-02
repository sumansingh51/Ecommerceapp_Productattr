<?php

$installer = $this;
$installer->startSetup();
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$setup->removeAttribute(Mage_Catalog_Model_Product::ENTITY, 'firstswatchvalue');
$setup->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'firstswatchvalue', array(
    'group'             => 'General',
    'type'              => 'int',
    'backend'           => '',
    'frontend'          => '',
    'label'             => 'First Selectable Swatch Value',
    'input'             => 'select',
    "source"            => 'productattr/attribute_source_provider',
    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible'           => true,
    'required'          => false,
    'searchable'        => false,
    'filterable'        => false,
    'comparable'        => false,
    'visible_on_front'  => false,
    'unique'            => false,
    'user_defined'      => true,
    'apply_to'          => 'configurable',
    'used_in_product_listing' =>true,
    'is_configurable'   => false,
));

$installer->endSetup();
