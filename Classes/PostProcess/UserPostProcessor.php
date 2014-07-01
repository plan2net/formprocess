<?php
namespace TYPO3\CMS\Form\PostProcess;

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
 * The user post processor
 */
class UserPostProcessor implements \TYPO3\CMS\Form\PostProcess\PostProcessorInterface {

	/**
	 * @var \TYPO3\CMS\Form\Domain\Model\Form
	 */
	protected $form;

	/**
	 * @var array
	 */
	protected $typoScript;

	/**
	 * @var \TYPO3\CMS\Form\Request
	 */
	protected $requestHandler;

	/**
	 * @var string
	 */
	protected $userFunction;

	/**
	 * @var array
	 */
	protected $dirtyHeaders = array();

	/**
	 * Constructor
	 *
	 * @param \TYPO3\CMS\Form\Domain\Model\Form $form Form domain model
	 * @param array $typoScript Post processor TypoScript settings
	 */
	public function __construct(\TYPO3\CMS\Form\Domain\Model\Form $form, array $typoScript) {
		$this->form = $form;
		$this->typoScript = $typoScript;
		$this->requestHandler = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Form\\Request');
	}

	/**
	 * The main method called by the post processor
	 *
	 * @return string HTML message from this processor
	 */
	public function process() {
		$this->setUserFunction();
		return $this->render();
	}

	/**
	 * Sets the redirect destination
	 *
	 * @return void
	 */
	protected function setUserFunction() {
		$this->userFunction = '';
		if ($this->typoScript['userFunction']) {
			$this->userFunction = $this->typoScript['userFunction'];
						
			$formData = array();
			$this->getFormData($this->form->getElements(), $formData);
						
			\TYPO3\CMS\Core\Utility\GeneralUtility::callUserFunction($this->userFunction, $formData, $this);
		}
	}
	
	protected function getFormData($elements, &$resultArr) {
		foreach($elements as $element) {
			$elementType = \TYPO3\CMS\Form\Utility\FormUtility::getLastPartOfClassName($element, TRUE);
			$name = '';
			$label = '';
			$value = NULL;
			$addField = TRUE;
			switch($elementType) {
				case 'select':
					$name = $element->getAttributeValue('name');
					$label = ($element->getAdditionalObjectByKey('label')) ? $element->getAdditionalValue('label') : '';
					$this->getFormData($element->getElements(), $value);
					break;
				case 'option':
					$label = $element->getData();
					$value = FALSE;
					if (array_key_exists('selected', $element->getAllowedAttributes()) && $element->hasAttribute('selected'))
						$value = TRUE;
					break;
				case 'radio':
				case 'checkbox':
					$name = $element->getAttributeValue('name');
					$label = ($element->getAdditionalObjectByKey('label')) ? $element->getAdditionalValue('label') : '';
					$value = FALSE;
					if (array_key_exists('checked', $element->getAllowedAttributes()) && $element->hasAttribute('checked'))
						$value = TRUE;
					break;
				case 'radiogroup':
				case 'checkboxgroup':
					$name = array_shift($element->getElements())->getAttributeValue('name');
					$label = ($element->getAdditionalObjectByKey('legend')) ? $element->getAdditionalValue('legend') : '';
					$this->getFormData($element->getElements(), $value);
					break;
				case 'container':
				case 'grid':
					$this->getFormData($element->getElements(), $resultArr);
					$addField = FALSE;
					break;
				case 'textarea':
					$name = $element->getAttributeValue('name');
					$label = ($element->getAdditionalObjectByKey('label')) ? $element->getAdditionalValue('label') : '';
					$value = $element->getData();
					break;
				case 'submit':
					$addField = FALSE;
					break;
				default:
					$name = $element->getAttributeValue('name');
					$label = ($element->getAdditionalObjectByKey('label')) ? $element->getAdditionalValue('label') : '';
					$value = ($element->hasAttribute('value')) ? $element->getAttributeValue('value') : '';
					break;
			}
			if($addField)
				$resultArr[] = array('type' => $elementType, 'name' => $name, 'label' => $label, 'value' => $value);
		}
	}

	/**
	 * Render the message after trying to send the mail
	 *
	 * @return string HTML message from the mail view
	 */
	protected function render() {
		return '';
	}
}
