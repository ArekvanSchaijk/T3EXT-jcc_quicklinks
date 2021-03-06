<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

// gets the extension configuration
$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['jcc_quicklinks']);

// register plugin
if(!$confArr['disableFrontendPlugin']) {
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
		$_EXTKEY,
		'Pi1',
		'JCC Quicklinks'
	);
}

// add plugin configuration
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'JCC Quicklinks');

// register table tx_jccquicklinks_domain_model_link
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_jccquicklinks_domain_model_link');
$TCA['tx_jccquicklinks_domain_model_link'] = array(
	'ctrl' => array(
		'requestUpdate' => 'is_product',
		'title'	=> 'LLL:EXT:jcc_quicklinks/Resources/Private/Language/locallang_db.xlf:tx_jccquicklinks_domain_model_link',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'hideTable' => TRUE,
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'name,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Link.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_jccquicklinks_domain_model_link.gif'
	),
);

if($confArr['enableTitle']) {
	$tempColumns['tx_jccquicklinks_title'] = array(
		'exclude' => 0,
		'label' => 'LLL:EXT:jcc_quicklinks/Resources/Private/Language/locallang_db.xlf:tabs.jccquicklinks.tx_jccquicklinks_title',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	);
}

// extends page table
$tempColumns['tx_jccquicklinks_links'] = array(
	'exclude' => 0,
	'label' => 'LLL:EXT:jcc_quicklinks/Resources/Private/Language/locallang_db.xlf:tabs.jccquicklinks.tx_jccquicklinks_links',
	'config' => array(
		'type' => 'inline',
		'foreign_table' => 'tx_jccquicklinks_domain_model_link',
		'foreign_field' => 'page',
		'maxitems' => 25,
		'appearance' => array(
			'collapseAll'	=> 1,
			'expandSingle'	=> 1,
		),
	),
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $tempColumns, 1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', '--div--;LLL:EXT:jcc_quicklinks/Resources/Private/Language/locallang_db.xlf:tabs.jccquicklinks,tx_jccquicklinks_title,tx_jccquicklinks_links');