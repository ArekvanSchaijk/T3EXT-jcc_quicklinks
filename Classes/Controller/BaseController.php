<?php
namespace Ucreation\JccQuicklinks\Controller;

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

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Class BaseController
 *
 * @package Ucreation\JccQuicklinks
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class BaseController extends ActionController {

	/**
	 * @var integer
	 */
	protected $pid = 0;
	
	/**
	 * @var \SoapClient $api
	 */ 
	protected $api = NULL;
	
	/**
	 * @var array
	 */
	protected $extConf = FALSE;
	
	/**
	 * Initialize Action
	 *
	 * @return void
	 */
	public function initializeAction() {
		global $TSFE;
		$this->pid		= $TSFE->page['uid'];
		$this->extConf	= unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['jcc_quicklinks']);	
	}
	
	/**
	 * Api
	 *
	 * @return \SoapClient
	 */
	protected function api() {
		// Lazy loading
		if (!$this->api) {
			try {
				$this->api = new \SoapClient($this->extConf['wsdl']);
			} catch(SoapFault $e) {
				throw new Exception($e);
			}
		}
		return $this->api;
	}
	
	/**
	 * TCA Select Product List
	 *
	 * @param array $conf
	 * @return array
	 */
	public function TCASelectProductList($conf) {
		$availableProducts = $this->api()->getGovAvailableProducts();
		if ($availableProducts->products && count($availableProducts->products) > 0) {
			foreach ($availableProducts->products as $product) {	
				$conf['items'][] = array($product->productDesc, $product->productId);
			}
		}
		return $conf;
	}
	
}