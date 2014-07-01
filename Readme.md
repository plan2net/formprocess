# Formprocess #

## What does it do? ##

This Extensions adds functionality to the TYPO3 form system extension. It adds a user postProcessor to the form wizard, where you can define a user function which will be executed after successful form submission.

## Users Manual ##

 1. Install Extension
 2. Create a form using the wizard
 3. Add the Post Processer 'User' to the form
 4. Define your User Function, for Example '\Vendor\Procuct\Utility\UserFunctions->myUserFunction'
 
The PostProcessor will call your User Function with two parameters, the first holds the submitted form data, the second is a reference to itself.
The User Function must accept these two arguments, for example:

```sh
public function myUserFunction($formData, &$pObj) {
  ... custom processing of form data
}
```
