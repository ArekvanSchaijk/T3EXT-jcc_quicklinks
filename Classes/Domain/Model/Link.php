<?php
namespace Ucreation\JccQuicklinks\Domain\Model;

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

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Class Link
 *
 * @package Ucreation\JccQuicklinks
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class Link extends AbstractEntity {

	/**
	 * @var string
	 */
	protected $name = '';

	/**
	 * @var boolean
	 */
	protected $isProduct = FALSE;

	/**
	 * @var integer
	 */
	protected $product = 0;

	/**
	 * @var string
	 */
	protected $link = '';
	
	/**
	 * @var integer
	 */
	protected $page = 0;

	/**
	 * Get Name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Set Name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Get Is Product
	 *
	 * @return boolean
	 */
	public function getIsProduct() {
		return $this->isProduct;
	}

	/**
	 * Set Is Product
	 *
	 * @param boolean $isProduct
	 * @return void
	 */
	public function setIsProduct($isProduct) {
		$this->isProduct = $isProduct;
	}

	/**
	 * Is Is Product
	 *
	 * @return boolean
	 */
	public function isIsProduct() {
		return $this->getIsProduct();
	}

	/**
	 * Get Product
	 *
	 * @return integer
	 */
	public function getProduct() {
		return $this->product;
	}

	/**
	 * Set Product
	 *
	 * @param integer $product
	 * @return void
	 */
	public function setProduct($product) {
		$this->product = $product;
	}

	/**
	 * Get Link
	 *
	 * @return string
	 */
	public function getLink() {
		return $this->link;
	}

	/**
	 * Set Link
	 *
	 * @param string $link
	 * @return void
	 */
	public function setLink($link) {
		$this->link = $link;
	}
	
	/**
	 * Get Page
	 *
	 * @return integer
	 */
	public function getPage() {
		return $this->page;
	}

	/**
	 * Set Page
	 *
	 * @param integer $page
	 * @return void
	 */
	public function setPage($page) {
		$this->page = $page;
	}
	
}