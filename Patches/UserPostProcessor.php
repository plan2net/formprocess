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
	 * @var \TYPO3\CMS\Form\Domain\Model\Element
	 */
	protected $form;

	/**
	 * @var array
	 */
	protected $typoScript;


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
	 * @param \TYPO3\CMS\Form\Domain\Model\Element $form Form domain model
	 * @param array $typoScript Post processor TypoScript settings
	 */
	public function __construct(\TYPO3\CMS\Form\Domain\Model\Element $form, array $typoScript) {
		$this->form = $form;
		$this->typoScript = $typoScript;
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
	 * Sets the user function
	 *
	 * @return void
	 */
	protected function setUserFunction() {
		$this->userFunction = '';
		if ($this->typoScript['userFunction']) {
			$this->userFunction = $this->typoScript['userFunction'];
						
			$formData = array();
			$this->getFormData($this->form->getChildElements(), $formData);

			\TYPO3\CMS\Core\Utility\GeneralUtility::callUserFunction($this->userFunction, $formData, $this);
		}
	}
	
	protected function getFormData($elements, &$resultArr) {
		foreach($elements as $element) {
			$elementType = strtolower(trim($element->getElementType()));
			$name = '';
			$label = '';
			$value = NULL;
			$selected = NULL;
			$addField = TRUE;

			switch($elementType) {
				case 'fileupload':
					$name = $element->getAdditionalArgument('name');
					$label = $element->getAdditionalArgument('label');
					$value = $element->getAdditionalArgument('uploadedFiles')[0];
					break;

				case 'fieldset':
					$name = $element->getName();
					$label = $element->getAdditionalArgument('legend');
					$this->getFormData($element->getChildElements(), $value);
					break;

				case 'select':
					$name = $element->getAdditionalArgument('name');
					$label = $element->getAdditionalArgument('label');
					$this->getFormData($element->getChildElements(), $value);
					break;

				case 'option':
					$label = $element->getAdditionalArgument('label');
					$value = $element->getAdditionalArgument('text');
					$selected = (bool)!empty($element->getAdditionalArgument('selected'));
					break;

				case 'radio':
				case 'checkbox':
					$name = $element->getAdditionalArgument('name');
					$label = $element->getAdditionalArgument('label');
					$value = (bool)!empty($element->getAdditionalArgument('checked'));
					break;

				case 'radiogroup':
				case 'checkboxgroup':
					$name = $element->getName();
					$label = $element->getAdditionalArgument('legend');
					$this->getFormData($element->getChildElements(), $value);
					break;

				case 'container':
				case 'grid':
					$this->getFormData($element->getChildElements(), $resultArr);
					$addField = FALSE;
					break;

				case 'textarea':
					$name = $element->getAdditionalArgument('name');
					$label = $element->getAdditionalArgument('label');
					$value = $element->getAdditionalArgument('value');
					break;

				case 'header':
				case 'textblock':
				case 'reset':
					break;

				case 'submit':
					$addField = FALSE;
					break;

				default:
					$name = $element->getAdditionalArgument('name');
					$label = $element->getAdditionalArgument('label');
					$value = $element->getAdditionalArgument('value');
					break;
			}

			if($addField)
				$resultArr[] = array(
					'type' => $elementType,
					'name' => $name,
					'label' => $label,
					'value' => $value,
					'selected' => $selected
				);
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

	/**
	 * Set the current controller context
	 *
	 * @param \TYPO3\CMS\Form\Mvc\Controller\ControllerContext $controllerContext
	 * @return void
	 */
	public function setControllerContext(\TYPO3\CMS\Form\Mvc\Controller\ControllerContext $controllerContext) {
		$this->controllerContext = $controllerContext;
	}
}
