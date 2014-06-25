<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "formgrids".
 *
 * Auto generated 24-06-2014 13:39
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'Form Process',
	'description' => 'This extension adds functionality to the TYPO3 form system extension. It offers the opportunity to define a custom Post Processor. It also integrates itself into the TYPO3 Form Wizard.',
	'category' => 'misc',
	'shy' => false,
	'version' => '1.0.0',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => NULL,
	'module' => '',
	'state' => 'alpha',
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
			'form' => '6.0',
			'typo3' => '6.2.0-6.2.99',
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