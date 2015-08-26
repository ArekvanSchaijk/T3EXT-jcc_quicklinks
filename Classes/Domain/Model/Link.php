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
 *
 *
 * @package jcc_quicklinks
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Link extends AbstractEntity {

	/**
	 * name
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * isProduct
	 *
	 * @var boolean
	 */
	protected $isProduct = FALSE;

	/**
	 * product
	 *
	 * @var integer
	 */
	protected $product;

	/**
	 * link
	 *
	 * @var string
	 */
	protected $link;
	
	/**
	 * page
	 *
	 * @var integer
	 */
	protected $page;

	/**
	 * Returns the name
	 *
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the isProduct
	 *
	 * @return boolean $isProduct
	 */
	public function getIsProduct() {
		return $this->isProduct;
	}

	/**
	 * Sets the isProduct
	 *
	 * @param boolean $isProduct
	 * @return void
	 */
	public function setIsProduct($isProduct) {
		$this->isProduct = $isProduct;
	}

	/**
	 * Returns the boolean state of isProduct
	 *
	 * @return boolean
	 */
	public function isIsProduct() {
		return $this->getIsProduct();
	}

	/**
	 * Returns the product
	 *
	 * @return integer $product
	 */
	public function getProduct() {
		return $this->product;
	}

	/**
	 * Sets the product
	 *
	 * @param integer $product
	 * @return void
	 */
	public function setProduct($product) {
		$this->product = $product;
	}

	/**
	 * Returns the link
	 *
	 * @return string $link
	 */
	public function getLink() {
		return $this->link;
	}

	/**
	 * Sets the link
	 *
	 * @param string $link
	 * @return void
	 */
	public function setLink($link) {
		$this->link = $link;
	}
	
	/**
	 * Returns the page
	 *
	 * @return integer $page
	 */
	public function getPage() {
		return $this->page;
	}

	/**
	 * Sets the page
	 *
	 * @param integer $page
	 * @return void
	 */
	public function setPage($page) {
		$this->page = $page;
	}
}
?>