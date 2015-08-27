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
 * Class LinkController
 *
 * @package Ucreation\JccQuicklinks
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class LinkController extends BaseController {
	
	/**
	 * @const string
	 */
	const	TYPE_PRODUCT	= 'product',
			TYPE_MAIL		= 'mail',
			TYPE_PAGE		= 'page',
			TYPE_EXTERNAL	= 'external';
	
	/**
	 * @var \Ucreation\JccQuicklinks\Domain\Repository\LinkRepository
	 * @inject
	 */
	protected $linkRepository = NULL;
	
	/**
	 * Constructor
	 *
	 * @global \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController $TSFE
	 * @return void
	 */
	public function __construct() {
		global $TSFE;
		$this->pid = $TSFE->page['uid'];
	}
	
	/**
	 * List Action
	 *
	 * @global \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController $TSFE
	 * @return void
	 */
	public function listAction() {
		
		global $TSFE;

		$linksArray = array();
		
		// gets all quicklinks from the repository
		$links = $this->linkRepository->findLinksByPid($this->pid);

		foreach ($this->linkRepository->findLinksByPid($this->pid) as $link) {
			
			// when there is an product set
			if ($link->isIsProduct()) {
				
				$linkPath = NULL;
				$productId = $link->getProduct();
				$linkType = self::TYPE_PRODUCT;
			
			// when there is an custom link created
			} else {
				
				$linkPath = $link->getLink();
				$productId = NULL;
				
				// link to an page
				if (ctype_digit($linkPath)) {
					$linkType = self::TYPE_PAGE;
				// link to an email
				} else if (strpos($linkPath, '@') !== FALSE) {
					$linkType = self::TYPE_MAIL;
				// link to an external address	
				} else {
					$linkType = self::TYPE_EXTERNAL;
				}
			}
			
			$linksArray[] = array(
				'name'		=> $link->getName(),
				'path'		=> $linkPath,
				'productId'	=> $productId,
				'type'		=> $linkType,
			);
		}

		// view allocations
		$this->view->assign('links', $linksArray);
		$this->view->assign('altTitle', $TSFE->page['tx_jccquicklinks_title']);
	}
	
}