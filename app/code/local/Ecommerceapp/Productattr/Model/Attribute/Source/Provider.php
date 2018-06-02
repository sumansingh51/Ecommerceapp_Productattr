<?php
class Ecommerceapp_Productattr_Model_Attribute_Source_Provider extends Mage_Eav_Model_Entity_Attribute_Source_Abstract{
    protected $_options = null;
    public function getAllOptions($withEmpty = false){
        if (is_null($this->_options)){
            $this->_options = array();
            //$this->_options[] = array('label'=>'HERE GOES THE LABEL', 'value'=>'HERE GOES THE VALUE');
            //as example
            $attribute = Mage::getModel('eav/config')->getAttribute('catalog_product', 'apparel_type'); //"color" is the attribute_code
            $allOptions = $attribute->getSource()->getAllOptions(true, true);
            foreach ($allOptions as $instance) {
                $this->_options[] = array('label'=> Mage::helper("eav")->__($instance['label']), value=>$instance['value']);
            }
        }
        
        $options = $this->_options;
        if ($withEmpty) {
            array_unshift($options, array('value'=>'', 'label'=>''));
        }

        $newArr = array();
/*//Possible color value
$attribute = Mage::getModel('eav/config')->getAttribute('catalog_product', 'apparel_type'); //"color" is the attribute_code
$allOptions = $attribute->getSource()->getAllOptions(true, true);
foreach ($allOptions as $instance) {
    $id = $instance['value']; //id of the option
    $value = $instance['label']; //Label of the option
    $newArr[$id] = $value;
}
$newArr = array_filter($newArr);
print_r($newArr);*/

        return $options;
    }
    public function getOptionText($value)
    {
        $options = $this->getAllOptions(false);
 
        foreach ($options as $item) {
            if ($item['value'] == $value) {
                return $item['label'];
            }
        }
        return false;
    }
    public function getFlatColums()
    {
        $attributeCode = $this->getAttribute()->getAttributeCode();
        $column = array(
            'unsigned'  => false,
            'default'   => null,
            'extra'     => null
        );
 
        if (Mage::helper('core')->useDbCompatibleMode()) {
            $column['type']     = 'int(10)';
            $column['is_null']  = true;
        } else {
            $column['type']     = Varien_Db_Ddl_Table::TYPE_SMALLINT;
            $column['length']   = 10;
            $column['nullable'] = true;
            $column['comment']  = $attributeCode . ' column';
        }
 
        return array($attributeCode => $column);
    }
    public function getFlatUpdateSelect($store)
    {
        return Mage::getResourceModel('eav/entity_attribute')
            ->getFlatUpdateSelect($this->getAttribute(), $store);
    }
}