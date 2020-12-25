<?php
/**
 * Our bare bones shipping method
 */
class MagentoBook_ShippingModule_Model_Carrier_BareBonesMethod extends Mage_Shipping_Model_Carrier_Abstract
{
	protected $_code = 'shippingmodule';
	/**
	 * Collect rates for this shipping method based on information in $request
	 *
	 * @param Mage_Shipping_Model_Rate_Request $data
	 * @return Mage_Shipping_Model_Rate_Result
	 */
	public function collectRates(Mage_Shipping_Model_Rate_Request $request)
	{
		// skip if not enabled
		if (!$this->getConfigData('active')) {
			Mage::log('The '.$this->_code.' shipping method is not active.');
			return false;
		}
		// get necessary configuration values
		$handling = $this->getConfigData('handling');
		// this object will be returned as result of this method
		// containing all the shipping rates of this method
		$result = Mage::getModel('shipping/rate_result');
		// $response is an array that we have
		foreach ($response as $rMethod) {
			// create new instance of method rate
			$method = Mage::getModel('shipping/rate_result_method');
			// record carrier information
			$method->setCarrier($this->_code);
			$method->setCarrierTitle($this->getConfigData('title'));
			// record method information
			$method->setMethod($rMethod['code']);
			$method->setMethodTitle($rMethod['title']);
			// rate cost is optional property to record how much it costs to vendor to ship
			$method->setCost($rMethod['amount']);
			// add our handling fee, as a base charge on top of the shipping rate
			$method->setPrice($rMethod['amount']+$handling);
			// add this rate to the result
			$result->append($method);
		}
		return $result;
	}
}