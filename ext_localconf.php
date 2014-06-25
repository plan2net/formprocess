<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

// Register a Hook for the Backend Form Wizard
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['form']['hooks']['renderWizard'][] = 'WorldDirect\\Formprocess\\Hooks\\WizardViewHook->initialize';


// Add Page TS Config for form wizard
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TsConfig/page.ts">');



?>
