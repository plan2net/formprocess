Ext.namespace('TYPO3.Form.Wizard.Viewport.Left.Form.PostProcessors');

/**
 * The user post processor
 *
 * @class TYPO3.Form.Wizard.Viewport.Left.Form.PostProcessors.User
 * @extends TYPO3.Form.Wizard.Viewport.Left.Form.PostProcessors.PostProcessor
 */
TYPO3.Form.Wizard.Viewport.Left.Form.PostProcessors.User = Ext.extend(TYPO3.Form.Wizard.Viewport.Left.Form.PostProcessors.PostProcessor, {
	/**
	 * @cfg {String} processor
	 *
	 * The name of this processor
	 */
	processor: 'user',

	/**
	 * Constructor
	 *
	 * Add the configuration object to this component
	 * @param config
	 */
	constructor: function(config) {
		Ext.apply(this, {
			configuration: {
				userFunction: '',
			}
		});
		TYPO3.Form.Wizard.Viewport.Left.Form.PostProcessors.User.superclass.constructor.apply(this, arguments);
	}
});

Ext.reg('typo3-form-wizard-viewport-left-form-postprocessors-user', TYPO3.Form.Wizard.Viewport.Left.Form.PostProcessors.User);
