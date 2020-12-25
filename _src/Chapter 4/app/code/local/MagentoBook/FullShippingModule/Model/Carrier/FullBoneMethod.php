<?php
class MagentoBook_FullShippingModule_Model_Carrier_FullBoneMethod extends Mage_Shipping_Model_Carrier_Abstract
{
	protected $_code = 'fullshippingmodule';
	public function collectRates(Mage_Shipping_Model_Rate_Request $request)
	{
		if (!$this->getConfigData('active')) {
			Mage::log('The '.$this->_code.' shipping method is not active.');
			return false;
		}
		$handling = $this->getConfigData('handling');
		$result = Mage::getModel('shipping/rate_result');
		$method = Mage::getModel('shipping/rate_result_method');
		$items = Mage::getModel('checkout/session')->getQuote()->getAllItems();
		if (count($items) >= $this->getConfigData('minimum_item_limit')) {
			$code = $this->getConfigData('over_minimum_code');
			$title = $this->getConfigData('over_minimum_title');
			$price = $this->getConfigData('over_minimum_price');
		}
		else {
			$code = $this->getConfigData('under_minimum_code');
			$title = $this->getConfigData('under_minimum_title');
			$price = $this->getConfigData('under_minimum_price');
		}
		$method->setCarrier($this->_code);
		$method->setCarrierTitle($this->getConfigData('title'));
		$method->setMethod($code);
		$method->setMethodTitle($title);
		$method->setPrice($price + $handling);
		$result->append($method);
		return $result;
	}
}