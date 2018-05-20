<?php
class ReportController extends CController {
	const CRLF = ""; // \r\n";
	public $layout = '_main';
	private $_model;
	
	/* OCC */
	public function actionReport01() {
		// Authen Login
		if (! UserLoginUtils::isLogin ()) {
			$this->redirect ( Yii::app ()->createUrl ( 'Site/login' ) );
		}
		
// 		$criteria = new CDbCriteria ();
// 		if (isset ( $_POST ['LabRegister'] )) {
			
// 			$regist = new LabRegister ();
// 			$regist->attributes = $_POST ['LabRegister'];
			
// 			$criteria = new CDbCriteria ();
// 			$criteria->compare ( 'dep_department_id', $regist->dep_department_id, true );
// 			$dataProvider = new CActiveDataProvider ( "LabRegister", array (
// 					'criteria' => $criteria 
// 			) );
			
// 			$this->render ( '//report/report01', array (
// 					'dataProvider' => $dataProvider 
// 			) );
// 		} else {
// 			$dataProvider = new CActiveDataProvider ( "LabRegister", array (
// 					'criteria' => $criteria 
// 			) );
			
// 			$this->render ( '//report/report01', array (
// 					'dataProvider' => $dataProvider 
// 			) );
// 		}
	}
	/* Chem */
	public function actionReport02() {
		// Authen Login
		if (! UserLoginUtils::isLogin ()) {
			$this->redirect ( Yii::app ()->createUrl ( 'Site/login' ) );
		}
		
// 		$criteria = new CDbCriteria ();
// 		if (isset ( $_POST ['LabRegister'] )) {
			
// 			$regist = new LabRegister ();
// 			$regist->attributes = $_POST ['LabRegister'];
// 			$criteria->compare ( 'dep_department_id', $regist->dep_department_id, true );
// 			$dataProvider = new CActiveDataProvider ( "LabRegister", array (
// 					'criteria' => $criteria 
// 			) );
			
// 			$this->render ( '//report/report02', array (
// 					'dataProvider' => $dataProvider 
// 			) );
// 		} else {
			
// 			$dataProvider = new CActiveDataProvider ( "LabRegister", array (
// 					'criteria' => $criteria 
// 			) );
			
// 			$this->render ( '//report/report02', array (
// 					'dataProvider' => $dataProvider 
// 			) );
// 		}
	}
	/* Rad */
	public function actionReport03() {
		// Authen Login
		if (! UserLoginUtils::isLogin ()) {
			$this->redirect ( Yii::app ()->createUrl ( 'Site/login' ) );
		}
		
// 		$criteria = new CDbCriteria ();
// 		if (isset ( $_POST ['LabRegister'] )) {
			
// 			$regist = new LabRegister ();
// 			$regist->attributes = $_POST ['LabRegister'];
// 			$criteria->compare ( 'dep_department_id', $regist->dep_department_id, true );
// 			$dataProvider = new CActiveDataProvider ( "LabRegister", array (
// 					'criteria' => $criteria 
// 			) );
			
// 			$this->render ( '//report/report03', array (
// 					'dataProvider' => $dataProvider 
// 			) );
// 		} else {
			
// 			$dataProvider = new CActiveDataProvider ( "LabRegister", array (
// 					'criteria' => $criteria 
// 			) );
			
// 			$this->render ( '//report/report03', array (
// 					'dataProvider' => $dataProvider 
// 			) );
// 		}
	}
	/* Bio */
	public function actionReport04() {
		// Authen Login
		if (! UserLoginUtils::isLogin ()) {
			$this->redirect ( Yii::app ()->createUrl ( 'Site/login' ) );
		}
		
// 		$criteria = new CDbCriteria ();
// 		if (isset ( $_POST ['LabRegister'] )) {
			
// 			$regist = new LabRegister ();
// 			$regist->attributes = $_POST ['LabRegister'];
// 			$criteria->compare ( 'dep_department_id', $regist->dep_department_id, true );
// 			$dataProvider = new CActiveDataProvider ( "LabRegister", array (
// 					'criteria' => $criteria 
// 			) );
			
// 			$this->render ( '//report/report04', array (
// 					'dataProvider' => $dataProvider 
// 			) );
// 		} else {
			
// 			$dataProvider = new CActiveDataProvider ( "LabRegister", array (
// 					'criteria' => $criteria 
// 			) );
			
// 			$this->render ( '//report/report04', array (
// 					'dataProvider' => $dataProvider 
// 			) );
// 		}
	}
	/* Reister */
	public function actionReport05() {
		// Authen Login
		if (! UserLoginUtils::isLogin ()) {
			$this->redirect ( Yii::app ()->createUrl ( 'Site/login' ) );
		}
		
// 		$criteria = new CDbCriteria ();
// 		if (isset ( $_POST ['LabRegister'] )) {
			
// 			$regist = new LabRegister ();
// 			$regist->attributes = $_POST ['LabRegister'];
// 			$criteria->compare ( 'dep_department_id', $regist->dep_department_id, true );
// 			$dataProvider = new CActiveDataProvider ( "LabRegister", array (
// 					'criteria' => $criteria 
// 			) );
			
// 			$this->render ( '//report/report05', array (
// 					'dataProvider' => $dataProvider 
// 			) );
// 		} else {
			
// 			$dataProvider = new CActiveDataProvider ( "LabRegister", array (
// 					'criteria' => $criteria 
// 			) );
			
// 			$this->render ( '//report/report05', array (
// 					'dataProvider' => $dataProvider 
// 			) );
// 		}
	}
	
	/* ------------------- EXPORT ----------------- */

}