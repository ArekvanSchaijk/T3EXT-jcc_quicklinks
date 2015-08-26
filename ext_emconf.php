<?php

$EM_CONF[$_EXTKEY] = array (
	'title' => 'JCC Quicklinks',
	'description' => 'Quicklinks for the extension jcc_appointments',
	'category' => 'plugin',
	'version' => '1.1.0',
	'state' => 'stable',
	'uploadfolder' => FALSE,
	'createDirs' => '',
	'clearcacheonload' => FALSE,
	'author' => 'Arek van Schaijk',
	'author_email' => 'info@ucreation.nl',
	'author_company' => 'Ucreation',
	'constraints' => 
	array (
		'depends' => 
		array (
			'typo3' => '6.0.0-6.2.99',
			'jcc_appointments' => '2.0.0-2.4.99',
		),
		'conflicts' => 
		array (
		),
		'suggests' => 
		array (
		),
	),
);