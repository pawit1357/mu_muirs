<?php
class AccidentInvestigationController extends CController {
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
		
		if (isset ( $_POST ['AccidentInvestigation'] )) {
			
			$transaction = Yii::app ()->db->beginTransaction ();
			// Add Request
			$model = new AccidentInvestigation();
			$model->attributes = $_POST ['AccidentInvestigation'];
			$model->case_date= CommonUtil::getDate ( $model->case_date);
			$model->create_date = date ( "Y-m-d H:i:s" );
			$model->create_by = UserLoginUtils::getUsersLoginId ();
			
			$img1 = $_FILES ['img1'];
			
			if (isset ( $img1 )) {
				$file_ary = CommonUtil::reArrayFiles ( $img1 );
				
				$index = 0;
				foreach ( $file_ary as $file ) {
					if ($file ['size'] > 0) {
						CommonUtil::upload ( $file );
						$model->img1 =CommonUtil::upload ($file);
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
						CommonUtil::upload ( $file );
						$model->img2 =CommonUtil::upload ($file);
					}
					$index ++;
				}
			}
			$img3 = $_FILES ['img3'];
			
			if (isset ( $img3 )) {
				$file_ary = CommonUtil::reArrayFiles ( $img3 );
				
				$index = 0;
				foreach ( $file_ary as $file ) {
					if ($file ['size'] > 0) {
						CommonUtil::upload ( $file );
						$model->img3 =CommonUtil::upload ($file);
					}
					$index ++;
				}
			}
			
			$bodyAccidentInvestigation = '';
			if (isset ( $_POST ['bodyAccidentInvestigation'] )) {
				foreach ( $_POST ['bodyAccidentInvestigation'] as $item ) {
					$bodyAccidentInvestigation.= $item. ',';
				}
			}else{
				$bodyAccidentInvestigation="";
			}
			$model->body_accident_type= rtrim ( $bodyAccidentInvestigation, "," );
			
			
			$accident_type= '';
			if (isset ( $_POST ['accident_type'] )) {
				foreach ( $_POST ['accident_type'] as $item ) {
					$accident_type.= $item. ',';
				}
			}else{
				$accident_type="";
			}
			$model->accident_type= rtrim ( $accident_type, "," );
			
			
			
			
			
			
			$model->save ();
			// echo "SAVE";
			$transaction->commit ();
			
			// $transaction->rollback ();
			$this->render ( '//accidentinvestigation/result' );
		} else {
			// Render
			$model = new AccidentInvestigation();
			$this->render ( '//accidentinvestigation/main', array (
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
		
		if (isset ( $_POST ['AccidentInvestigation'] )) {
			
			$transaction = Yii::app ()->db->beginTransaction ();
			// Add Request
			$model = new MTitle ();
			$model->attributes = $_POST ['AccidentInvestigation'];
			
			$model->save ();
			// echo "SAVE";
			$transaction->commit ();
			
			// $transaction->rollback ();
			$this->redirect ( Yii::app ()->createUrl ( 'AccidentInvestigation' ) );
		} else {
			// Render
			$this->render ( '//accidentinvestigation/create' );
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
		
		$this->redirect ( Yii::app ()->createUrl ( 'AccidentInvestigation/' ) );
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
		if (isset ( $_POST ['AccidentInvestigation'] )) {
			$transaction = Yii::app ()->db->beginTransaction ();
			$model->attributes = $_POST ['AccidentInvestigation'];
			
			$model->update ();
			$transaction->commit ();
			
			$this->redirect ( Yii::app ()->createUrl ( 'AccidentInvestigation' ) );
		}
		$this->render ( '//accidentinvestigation/update', array (
				'data' => $model 
		) );
	}
	public function loadModel() {
		if ($this->_model === null) {
			if (isset ( $_GET ['id'] )) {
				$id = addslashes ( $_GET ['id'] );
				$this->_model = AccidentInvestigation::model ()->findbyPk ( $id );
			}
			if ($this->_model === null)
				throw new CHttpException ( 404, 'The requested page does not exist.' );
		}
		return $this->_model;
	}
}