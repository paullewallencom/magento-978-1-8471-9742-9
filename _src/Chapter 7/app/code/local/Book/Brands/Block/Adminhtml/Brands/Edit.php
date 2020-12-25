<?php
class Book_Brands_Block_Adminhtml_Brands_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	public function __construct()
	{
		parent::__construct();
		$this->_objectId = 'id';
		$this->_blockGroup = 'brands';
		$this->_controller = 'adminhtml_brands';
		$this->_updateButton('save', 'label', Mage::helper('brands')->__('Save Brand'));
		$this->_updateButton('delete', 'label', Mage::helper('brands')->__('Delete Brand'));
	}
	public function getHeaderText()
	{
		if( Mage::registry('brands_data') && Mage::registry('brands_data')->getId() ) {
		return Mage::helper('brands')->__("Edit Brand '%s'", $this->htmlEscape(Mage::registry('brands_data')->getTitle()));
	} 
	else {
		return Mage::helper('brands')->__('Add Brand');
	}
	}
}