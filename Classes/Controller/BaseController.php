<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Arek van Schaijk <info@ucreation.nl>, Ucreation
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package jcc_quicklinks
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_JccQuicklinks_Controller_BaseController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var SoapClient $api
	 */ 
	protected $api;
	
	/**
	 * @var array $extConf
	 */
	protected $extConf = false;
	
	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct() {
		
		$this->extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['jcc_quicklinks']);	
	}
	
	/**
	 * Api
	 *
	 * @return SoapClient $api
	 */
	protected function api() {
		
		// initialize SoapClient if not loaded yet
		if(!$this->api) {
			
			try {
			
				$this->api = new SoapClient($this->extConf['wsdl']);
				
			} catch(SoapFault $e) {
				
				// do something, but what?
			}
		}
		
		return $this->api;
	}
	
	/**
	 * TCA Select Product List
	 *
	 * @param array $conf
	 * @return void
	 */
	public function TCASelectProductList($conf) {
		
		$availableProducts = $this->api()->getGovAvailableProducts();
		
		// checks if we have an object with products
		if($availableProducts->products && count($availableProducts->products) > 0) {
			
			// loop given object with products
			foreach($availableProducts->products as $product) {
				
				$conf['items'][] = array($product->productDesc, $product->productId);
			}
		}

		return $conf;
	}
}
?>