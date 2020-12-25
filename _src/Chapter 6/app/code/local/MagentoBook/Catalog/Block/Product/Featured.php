<?php
class MagentoBook_Catalog_Block_Product_Featured extends Mage_Catalog_Block_Product_Abstract
{
	protected $_limit = 1;
	public function getFeaturedProducts()
	{
		$productCollection = Mage::registry('current_category')->getProductCollection();
		Mage::getModel('catalog/layer')->prepareProductCollection($productCollection);
		$productCollection
		->addAttributeToFilter('featured', true)
		->setPageSize($this->_limit)
		->load();
		return $productCollection;
	}
	
	public function setLimit($limit = null)
	{
		if(intval($limit) > 0)
		$this->_limit = intval($limit);
	}
}
?>