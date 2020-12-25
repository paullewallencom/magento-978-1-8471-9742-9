<?php
class Book_Brands_Block_Brands extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getBrands()     
     { 
        if (!$this->hasData('brands')) {
            $this->setData('brands', Mage::registry('brands'));
        }
        return $this->getData('brands');
        
    }
}