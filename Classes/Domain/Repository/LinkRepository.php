<?php
namespace Ucreation\JccQuicklinks\Domain\Repository;

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

use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/**
 * Class LinkRepository
 *
 * @package Ucreation\JccQuicklinks
 * @author Arek van Schaijk <info@ucreation.nl>
 */
class LinkRepository extends Repository {

 	/**
	 * Initialize Object
	 *
	 * @return void
	 */
	public function initializeObject() {
		$defaultQuerySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
		$defaultQuerySettings->setRespectStoragePage(FALSE);
		$this->setDefaultQuerySettings($defaultQuerySettings);
	}
	
	/**
	 * Find Links By Pid
	 *
	 * @param integer $pid
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	public function findLinksByPid($pid) {
		$query = $this->createQuery();
		$query->setOrderings(array('sorting' => QueryInterface::ORDER_ASCENDING));
		$query->matching($query->equals('page', (int)$pid));
		return $query->execute();
	}
	
}