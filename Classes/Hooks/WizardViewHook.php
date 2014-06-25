<?php
namespace WorldDirect\Formprocess\Hooks;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Ben Walch <ben.walch@world-direct.at>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * The form wizard view
 *
 * @author Ben Walch <ben.walch@world-direct.at>
 */
class WizardViewHook { // TYPO3\CMS\Form\View\Wizard\WizardView

    /**
     * wizard View
     *
     * @var \TYPO3\CMS\Form\View\Wizard\WizardView
     */
    protected $wizardView;

    /**
     * initialize function
     *
     * @param array $params
     * @param \TYPO3\CMS\Form\View\Wizard\WizardView $wizardView
     */
    public function initialize($params, $wizardView) {
		$this->wizardView = $wizardView;
			
		$this->loadLocalization();
		$this->loadJavascript();
    }
	
	public function loadLocalization() {
		$wizardLabels = $GLOBALS['LANG']->includeLLFile('EXT:formprocess/Resources/Private/Language/locallang_wizard.xlf', FALSE, TRUE);
		$this->wizardView->doc->getPageRenderer()->addInlineLanguageLabelArray($wizardLabels['default']);	
	}
    
    public function loadJavascript() {	
		$baseUrl = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('formprocess') . 'Resources/Public/JavaScript/Wizard/';
		$javascriptFiles = array(
			'Viewport/Left/Form/PostProcessors/PostProcessor.js',
			'Viewport/Left/Form/PostProcessors/User.js'
		);
		
		// Load the additional javascript for form wizard
		foreach ($javascriptFiles as $javascriptFile) {
			$this->wizardView->doc->getPageRenderer()->addJsFile($baseUrl . $javascriptFile, 'text/javascript', TRUE, FALSE);
		}
    }

}