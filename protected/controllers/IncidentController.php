<?php
class IncidentController extends CController {
	public $layout = '_main';
	private $_model;
	public function actionIndex() {
		// Authen Login
		if (! UserLoginUtils::isLogin ()) {
			$this->redirect ( Yii::app ()->createUrl ( 'Site/login' ) );
		}
		if (! UserLoginUtils::authorizePage ( $_SERVER ['REQUEST_URI'] )) {
			$this->redirect ( Yii::app ()->createUrl ( 'DashBoard/Permission' ) );
		}
		
		if (isset ( $_POST ['Incident'] )) {
			
			$transaction = Yii::app ()->db->beginTransaction ();
			// Add Request
			$model = new Incident ();
			$model->attributes = $_POST ['Incident'];
			$model->report_date = CommonUtil::getDate ( $model->report_date );
			$model->create_date = date ( "Y-m-d H:i:s" );
			$model->create_by = UserLoginUtils::getUsersLoginId ();
			
			$img1 = $_FILES ['img1'];
			
			if (isset ( $img1 )) {
				$file_ary = CommonUtil::reArrayFiles ( $img1 );
				
				$index = 0;
				foreach ( $file_ary as $file ) {
					if ($file ['size'] > 0) {
						CommonUtil::upload ( $file );
						$model->img1 = CommonUtil::upload ( $file );
					}
					$index ++;
				}
			}
			
			$model->save ();
			
			// Notify//
			$model = new Notify();
			$model->report_type = 2;//1:Acicent&Investigate,2:Incident,3:Accident
			$model->title = 'Incident';
			$model->remark = '';
			$model->isRead = false;
			$model->create_date = date("Y-m-d H:i:s");
			$model->save();
			// End-Notify//
			
			// echo "SAVE";
			$transaction->commit ();
			
			// $transaction->rollback ();
			// $this->redirect ( Yii::app ()->createUrl ( 'Incident' ) );
			$this->render ( '//incident/result' );
		} else {
			// Render
			$model = new Accident ();
			$this->render ( '//incident/main', array (
					'data' => $model 
			) );
		}
	}
	public function actionCreate() {
		// Authen Login
		if (! UserLoginUtils::isLogin ()) {
			$this->redirect ( Yii::app ()->createUrl ( 'Site/login' ) );
		}
		if (! UserLoginUtils::authorizePage ( $_SERVER ['REQUEST_URI'] )) {
			$this->redirect ( Yii::app ()->createUrl ( 'DashBoard/Permission' ) );
		}
		
		if (isset ( $_POST ['Incident'] )) {
			
			$transaction = Yii::app ()->db->beginTransaction ();
			// Add Request
			$model = new MTitle ();
			$model->attributes = $_POST ['Incident'];
			
			$model->save ();
			// echo "SAVE";
			$transaction->commit ();
			
			// $transaction->rollback ();
			$this->redirect ( Yii::app ()->createUrl ( 'Incident' ) );
		} else {
			// Render
			$this->render ( '//incident/create' );
		}
	}
	public function actionDelete() {
		// Authen Login
		if (! UserLoginUtils::isLogin ()) {
			$this->redirect ( Yii::app ()->createUrl ( 'Site/login' ) );
		}
		if (! UserLoginUtils::authorizePage ( $_SERVER ['REQUEST_URI'] )) {
			$this->redirect ( Yii::app ()->createUrl ( 'DashBoard/Permission' ) );
		}
		$model = $this->loadModel ();
		$model->delete ();
		
		$this->redirect ( Yii::app ()->createUrl ( 'Incident/' ) );
	}
	public function actionUpdate() {
		// Authen Login
		if (! UserLoginUtils::isLogin ()) {
			$this->redirect ( Yii::app ()->createUrl ( 'Site/login' ) );
		}
		if (! UserLoginUtils::authorizePage ( $_SERVER ['REQUEST_URI'] )) {
			$this->redirect ( Yii::app ()->createUrl ( 'DashBoard/Permission' ) );
		}
		$model = $this->loadModel ();
		if (isset ( $_POST ['Incident'] )) {
			$transaction = Yii::app ()->db->beginTransaction ();
			$model->attributes = $_POST ['Incident'];
			
			$model->update ();
			$transaction->commit ();
			
			$this->redirect ( Yii::app ()->createUrl ( 'Incident' ) );
		}
		$this->render ( '//incident/update', array (
				'data' => $model 
		) );
	}
	public function loadModel() {
		if ($this->_model === null) {
			if (isset ( $_GET ['id'] )) {
				$id = addslashes ( $_GET ['id'] );
				$this->_model = Incident::model ()->findbyPk ( $id );
			}
			if ($this->_model === null)
				throw new CHttpException ( 404, 'The requested page does not exist.' );
		}
		return $this->_model;
	}
}