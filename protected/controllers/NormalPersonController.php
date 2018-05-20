<?php
/**
 * SiteController is the default controller to handle user requests.
 */
class NormalPersonController extends CController {
	public $layout = '_blank2';
	private $_model;
	public function actionIndex() {
		// Authen Login
	    UserLoginUtils::authen ( 'anonymou', 'anonymou' );
	    
		$this->render ( '//normalperson/main' );
	}
	
}