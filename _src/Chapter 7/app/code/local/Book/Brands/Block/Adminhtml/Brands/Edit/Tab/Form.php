<?php
class Book_Brands_Block_Adminhtml_Brands_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset('brands_form', array('legend'=>Mage::helper('brands')->__('Brand information')));
		$fieldset->addField('brand_name', 'text', array(
'label' => Mage::helper('brands')->__('Brand Name'),
'class' => 'required-entry',
'required' => true,
'name' => 'brand_name',
		));
		$fieldset->addField('status', 'select', array(
'label' => Mage::helper('brands')->__('Status'),
'name' => 'status',
'values' => array(
		array(
'value' => 1,
'label' => Mage::helper('brands')->__('Active'),
		),
		array(
'value' => 0,
'label' => Mage::helper('brands')->__('Inactive'),
		),
		),
		));
		$fieldset->addField('brand_location', 'text', array(
'label' => Mage::helper('brands')->__('Location'),
'class' => 'required-entry',
'required' => true,
'name' => 'brand_location',
		));
		$fieldset->addField('brand_description', 'editor', array(
'name' => 'brand_description',
'label' => Mage::helper('brands')->__('Description'),
'title' => Mage::helper('brands')->__('Description'),
'style' => 'width:98%; height:400px;',
'wysiwyg' => false,
'required' => true,
		));
		if ( Mage::getSingleton('adminhtml/session')->getBrandsData() )
		{
			$form->setValues(Mage::getSingleton('adminhtml/session')->getBrandsData());
			Mage::getSingleton('adminhtml/session')->setBrandsData(null);
		} elseif ( Mage::registry('brands_data') ) {
			$form->setValues(Mage::registry('brands_data')->getData());
		}
		return parent::_prepareForm();
	}
}