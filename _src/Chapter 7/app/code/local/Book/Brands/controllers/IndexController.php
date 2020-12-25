<?php
class Book_Brands_IndexController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
	{
		$brands_id = $this->getRequest()->getParam('id');
		if($brands_id != null && $brands_id != '') {
			$brands = Mage::getModel('brands/brands')->load($brands_id)->getData();
		} else {
			$brands = null;
		}
		if($brands == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$brandsTable = $resource->getTableName('brands');
			$select =  $read->select()->from($brandsTable,array('brands_id','brand_name','brand_description','brand_location','status'))->where('status', 1)->order('created_time DESC') ;
			$brands = $read->fetchAll($select);
		}
		Mage::register('brands', $brands);
		$this->loadLayout();
		$this->renderLayout();
	}
}