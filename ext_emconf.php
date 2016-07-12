<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "formprocess".
 *
 * Auto generated 24-06-2014 13:39
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'Form Process',
	'description' => 'This extension offers the opportunity to define a custom Post Processor for the TYPO3 form system extension. It also completely integrates itself into the TYPO3 Form Wizard.',
	'category' => 'misc',
	'shy' => false,
	'version' => '1.0.1',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => NULL,
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => false,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => false,
	'lockType' => '',
	'author' => 'Ben Walch',
	'author_email' => 'ben.walch@world-direct.at',
	'author_company' => 'World Direct eBusiness solutions GmbH',
	'CGLcompliance' => NULL,
	'CGLcompliance_note' => NULL,
	'constraints' => 
	array (
		'depends' => 
		array (
			'form' => '7.6.0',
			'typo3' => '7.6.0-7.6.99',
		),
		'conflicts' => 
		array (
		),
		'suggests' => 
		array (
		),
	),
);

?>