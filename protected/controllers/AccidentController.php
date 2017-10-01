<?php
class AccidentController extends CController {
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
		if (isset ( $_POST ['Accident'] )) {
			
			$transaction = Yii::app ()->db->beginTransaction ();
			// Add Request
			$model = new Accident ();
			$model->attributes = $_POST ['Accident'];
			$model->report_date = CommonUtil::getDate ( $model->report_date );
			$model->case_date = CommonUtil::getDate ( $model->case_date );
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
			$img2 = $_FILES ['img2'];
			
			if (isset ( $img2 )) {
				$file_ary = CommonUtil::reArrayFiles ( $img2 );
				
				$index = 0;
				foreach ( $file_ary as $file ) {
					if ($file ['size'] > 0) {
						
						$model->img2 = CommonUtil::upload ( $file );
					}
					$index ++;
				}
			}
			
			if ($model->dammage_type == 1) {
				//record only die.
				$criteria = new CDbCriteria ();
				$criteria->condition = " department_id = " . UserLoginUtils::getUserInfo ()->department_id;
				$criteria->select = 'max(accident_date) AS accident_date';
				$row = SafetyRecordHistory::model ()->find ( $criteria );
				
				$acDate = date ( "Y-m-d H:i:s" );
				if (isset ( $row ['accident_date'] )) {
					$acDate = $row ['accident_date'];
				}
				
				$srh = new SafetyRecordHistory ();
				$srh->department_id = UserLoginUtils::getUserInfo ()->department_id;
				$srh->accident_date = date ( "Y-m-d H:i:s" );
				$srh->create_date = date ( "Y-m-d H:i:s" );
				
				$srh->accident_count = CommonUtil::dateDiff ( $acDate, $srh->accident_date );
				$srh->save ();
			}
			$model->save ();
			// echo "SAVE";
			$transaction->commit ();
			
			// $transaction->rollback ();
			$this->render ( '//accident/result' );
		} else {
			// Render
			$model = new Accident ();
			$this->render ( '//accident/main', array (
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
		
		if (isset ( $_POST ['Accident'] )) {
			
			$transaction = Yii::app ()->db->beginTransaction ();
			// Add Request
			$model = new Accident ();
			$model->attributes = $_POST ['Accident'];
			
			$model->save ();
			// echo "SAVE";
			$transaction->commit ();
			
			// $transaction->rollback ();
			$this->redirect ( Yii::app ()->createUrl ( 'Accident' ) );
		} else {
			// Render
			$this->render ( '//accident/create' );
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
		
		$this->redirect ( Yii::app ()->createUrl ( 'accident/' ) );
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
		if (isset ( $_POST ['accident'] )) {
			$transaction = Yii::app ()->db->beginTransaction ();
			$model->attributes = $_POST ['Accident'];
			
			$model->update ();
			$transaction->commit ();
			
			$this->redirect ( Yii::app ()->createUrl ( 'Accident' ) );
		}
		$this->render ( '//accident/update', array (
				'data' => $model 
		) );
	}
	public function loadModel() {
		if ($this->_model === null) {
			if (isset ( $_GET ['id'] )) {
				$id = addslashes ( $_GET ['id'] );
				$this->_model = Accident::model ()->findbyPk ( $id );
			}
			if ($this->_model === null)
				throw new CHttpException ( 404, 'The requested page does not exist.' );
		}
		return $this->_model;
	}
}