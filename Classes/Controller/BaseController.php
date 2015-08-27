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

use Ucreation\JccQuicklinks\Exception;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

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
	protected $jccSettings = NULL;
	
	/**
	 * Initialize Action
	 *
	 * @return void
	 */
	public function initializeAciton() {
		global $TSFE;
		$this->pid		= $TSFE->page['uid'];
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
				$this->api = new \SoapClient($this->getWsdlUrl());
			} catch(SoapFault $e) {
				throw new Exception($e);
			}
		}
		return $this->api;
	}
	
	/**
	 * Get Wsdl Url
	 *
	 * @return string
	 */
	protected function getWsdlUrl() {
		$this->retrieveJccSettings();
		return $this->jccSettings['soap']['wsdl'];
	}
	
	
	
	/**
	 * Retrieve Jcc Settings
	 *
	 * @return array
	 */
	protected function retrieveJccSettings() {
		if (!$this->jccSettings) {
			$configurationManager = $this->getObjectManager()->get('TYPO3\\CMS\Extbase\\Configuration\\ConfigurationManagerInterface');
			$configuration = $configurationManager->getConfiguration(
				ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK,
				'JccAppointments'
			);
			$this->jccSettings = $configuration['settings'];
		}
		return $this->jccSettings;
	}
	
	/**
	 * Get Object Manager
	 *
	 * @return \TYPO3\CMS\Extbase\Object\ObjectManager
	 */
	protected function getObjectManager() {
		if ($this->objectManager) {
			return $this->objectManager;
		}
		return GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
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