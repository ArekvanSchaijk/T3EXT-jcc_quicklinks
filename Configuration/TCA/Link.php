<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_jccquicklinks_domain_model_link'] = array(
	'ctrl' => $TCA['tx_jccquicklinks_domain_model_link']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, is_product, product, link',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, is_product, product, link,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_jccquicklinks_domain_model_link',
				'foreign_table_where' => 'AND tx_jccquicklinks_domain_model_link.pid=###CURRENT_PID### AND tx_jccquicklinks_domain_model_link.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jcc_quicklinks/Resources/Private/Language/locallang_db.xml:tx_jccquicklinks_domain_model_link.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'is_product' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jcc_quicklinks/Resources/Private/Language/locallang_db.xml:tx_jccquicklinks_domain_model_link.is_product',
			'config' => array(
				'type' => 'check',
				'default' => 1
			),
		),
		'product' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jcc_quicklinks/Resources/Private/Language/locallang_db.xml:tx_jccquicklinks_domain_model_link.product',
			'displayCond' => 'FIELD:is_product:REQ:true',
			'config' => array(
				'type' => 'select',
				'itemsProcFunc' => 'Tx_JccQuicklinks_Controller_BaseController->TCASelectProductList',
				'items' => array(
					array('LLL:EXT:jcc_quicklinks/Resources/Private/Language/locallang_db.xml:tx_jccquicklinks_domain_model_link.product.0', 0),
				),
			),
		),
		'link' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jcc_quicklinks/Resources/Private/Language/locallang_db.xml:tx_jccquicklinks_domain_model_link.link',
			'displayCond' => 'FIELD:is_product:REQ:false',
			'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim,required',
			'wizards' => array(
				'_PADDING' => 2,
				'link' => array(
				'type' => 'popup',
				'title' => 'Link',
				'icon' => 'link_popup.gif',
				'script' => 'browse_links.php?mode=wizard',
				'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
				)
			),
			'softref' => 'typolink[linkList]'
			),
		),
	),
);

?>