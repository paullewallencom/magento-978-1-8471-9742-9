<?php
class Book_Brands_Adminhtml_BrandsController extends Mage_Adminhtml_Controller_action
{
	protected function _initAction()
	{
		$this->loadLayout()->_setActiveMenu('brands/items')->_addBreadcrumb(Mage::helper('adminhtml')->__('Brands Manager'),Mage::helper('adminhtml')->__('Brands Manager'));
		return $this;
	}
	public function indexAction() {
		$this->_initAction()->renderLayout();
	}
	public function editAction()
	{
		$brandsId = $this->getRequest()->getParam('id');
		$brandsModel = Mage::getModel('brands/brands')->load($brandsId);
		if ($brandsModel->getId() || $brandsId == 0) {
			Mage::register('brands_data', $brandsModel);
			$this->loadLayout();
			$this->_setActiveMenu('brands/items');
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('BrandsManager'), Mage::helper('adminhtml')->__('Brands Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Brand Description'), Mage::helper('adminhtml')->__('Brand Description'));
			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
			$this->_addContent($this->getLayout()->createBlock('brands/adminhtml_brands_edit'))->_addLeft($this->getLayout()->createBlock('brands/adminhtml_brands_edit_tabs'));
			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('brands')->__('Brand does not exist'));
			$this->_redirect('*/*/');
		}
	}
	public function newAction()
	{
		$this->_forward('edit');
	}
	public function saveAction()
	{
		if ( $this->getRequest()->getPost() ) {
			try {
				$postData = $this->getRequest()->getPost();
				$brandsModel = Mage::getModel('brands/brands');
				if( $this->getRequest()->getParam('id') <= 0 )
				$brandsModel->setCreatedTime(Mage::getSingleton('core/date')->gmtDate());
				$brandsModel->addData($postData)->setUpdateTime(Mage::getSingleton('core/date')->gmtDate())->setId($this->getRequest()->getParam('id'))->save();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Brand was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setBrandsData(false);
				$this->_redirect('*/*/');
				return;
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				Mage::getSingleton('adminhtml/session')->setData($this->getRequest()->getPost());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				return;
			}
		}
		$this->_redirect('*/*/');
	}
	public function deleteAction()
	{
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$brandsModel = Mage::getModel('brands/brands');
				$brandsModel->setId($this->getRequest()->getParam('id'))->delete();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Brand was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}
}