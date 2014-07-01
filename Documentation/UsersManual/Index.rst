.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.


Users Manual
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

 1. Install Extension
 2. Create a form using the wizard
 3. Add the Post Processer 'User' to the form
 4. Define your User Function, for Example '\Vendor\Procuct\Utility\UserFunctions->myUserFunction'

The PostProcessor will pass two arguments to the user function, the first argument holds the submitted form data, the second argument is a reference to itself. The User Function must accept these two arguments, for example:
 
::

	public function myUserFunction($formArray, &$pObj) {
		... custom code
	}