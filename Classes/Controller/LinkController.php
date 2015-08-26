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

/**
 *
 *
 * @package jcc_quicklinks
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class LinkController extends BaseController {

	/**
	 * pid
	 *
	 * @var integer $pid
	 */
	private $pid;
	
	/**
	 * linkRepository
	 *
	 * @var \Ucreation\JccQuicklinks\Domain\Repository\LinkRepository
	 */
	protected $linkRepository;
	
	/**
	 * @const string TYPE_PRODUCT
	 */
	const TYPE_PRODUCT = 'product';
	
	/**
	 * @const string TYPE_MAIL
	 */
	const TYPE_MAIL = 'mail';
	
	/**
	 * @const string TYPE_PAGE
	 */
	const TYPE_PAGE = 'page';
	
	/**
	 * @const string TYPE_EXTERNAL
	 */
	const TYPE_EXTERNAL = 'external';
	
	/**
	 * Construct
	 *
	 * @return void
	 */
	public function __construct() {
		
		$this->pid = $GLOBALS['TSFE']->page['uid'];
	}

	/**
	 * injectLinkRepository
	 *
	 * @param \Ucreation\JccQuicklinks\Domain\Repository\LinkRepository $linkRepository
	 * @return void
	 */
	public function injectLinkRepository(\Ucreation\JccQuicklinks\Domain\Repository\LinkRepository $linkRepository) {
		$this->linkRepository = $linkRepository;
	}
	
	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {

		$linksArray = array();
		
		// get quicklinks for current $pid
		$links = $this->linkRepository->findLinksByPid($this->pid);
		
		// loop all links and generate some custom array
		foreach($links as $link) {
			
			// product link
			if($link->isIsProduct()) {
				
				// we dont have a link path
				$linkPath = NULL;
				
				// product id
				$productId = $link->getProduct();
				
				// link type
				$linkType = self::TYPE_PRODUCT;
			
			// custom link	
			} else {
				
				// link path
				$linkPath = $link->getLink();
				
				// we dont have a product id
				$productId = NULL;
				
				// page link
				if(ctype_digit($linkPath)) {
					
					$linkType = self::TYPE_PAGE;
				
				// mailto link	
				} else if(strpos($linkPath, '@') !== false) {
					
					$linkType = self::TYPE_MAIL;
				
				// external link	
				} else {
					
					$linkType = self::TYPE_EXTERNAL;
				}
			}
			
			$linksArray[] = array(
				'name' => $link->getName(),
				'path' => $linkPath,
				'productId' => $productId,
				'type' => $linkType,
			);
		}
		
		// override $links
		$links = $linksArray;

		$this->view->assign('links', $links);
		$this->view->assign('altTitle', $GLOBALS['TSFE']->page['tx_jccquicklinks_title']);
	}
}
?>