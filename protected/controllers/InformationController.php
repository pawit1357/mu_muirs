<?php
class InformationController extends CController {
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
		$model = new Information ();
		$this->render ( '//information/main', array (
				'data' => $model 
		) );
	}
	public function actionCreate() {
		// Authen Login
		if (! UserLoginUtils::isLogin ()) {
			$this->redirect ( Yii::app ()->createUrl ( 'Site/login' ) );
		}
		if (! UserLoginUtils::authorizePage ( $_SERVER ['REQUEST_URI'] )) {
			$this->redirect ( Yii::app ()->createUrl ( 'DashBoard/Permission' ) );
		}
		
		if (isset ( $_POST ['Information'] )) {
			
			$image_paths = $_FILES ['image_paths'];
			
			$transaction = Yii::app ()->db->beginTransaction ();
			// Add Request
			$model = new Information ();
			$model->attributes = $_POST ['Information'];
			$model->period_start = CommonUtil::getDate($model->period_start);
			$model->period_end = CommonUtil::getDate($model->period_end);
			
			if (isset ( $image_paths )) {
				$file_ary = CommonUtil::reArrayFiles ( $image_paths );
			
				$index = 0;
				foreach ( $file_ary as $file ) {
					if ($file ['size'] > 0) {
						CommonUtil::upload ( $file );
						$model->image_path = '/uploads/' . $file ['name'];
					}
					$index ++;
				}
			}
			
			
			$model->save ();
			// echo "SAVE";
			$transaction->commit ();
			
			// $transaction->rollback ();
			$this->redirect ( Yii::app ()->createUrl ( 'Information' ) );
		} else {
			// Render
			$this->render ( '//information/create' );
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
		
		$this->redirect ( Yii::app ()->createUrl ( 'Information/' ) );
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
		$tmp_img_path = $model->image_path;
		
		if (isset ( $_POST ['Information'] )) {
			
			$image_paths = $_FILES ['image_paths'];
				
			$transaction = Yii::app ()->db->beginTransaction ();
			// Add Request
			$model->attributes = $_POST ['Information'];
			$model->period_start = CommonUtil::getDate($model->period_start);
			$model->period_end = CommonUtil::getDate($model->period_end);
				
			if (isset ( $image_paths )) {
				$file_ary = CommonUtil::reArrayFiles ( $image_paths );
					
				$index = 0;
				foreach ( $file_ary as $file ) {
					if ($file ['size'] > 0) {
						CommonUtil::upload ( $file );
						$tmp_img_path = '/uploads/' . $file ['name'];
					}
					$index ++;
				}
			}
			$model->image_path = $tmp_img_path;
			$model->update();
			$transaction->commit ();
				
			$this->redirect ( Yii::app ()->createUrl ( 'Information' ) );
		}
		$this->render ( '//information/update', array (
				'data' => $model 
		) );
	}
	public function loadModel() {
		if ($this->_model === null) {
			if (isset ( $_GET ['id'] )) {
				$id = addslashes ( $_GET ['id'] );
				$this->_model = Information::model ()->findbyPk ( $id );
			}
			if ($this->_model === null)
				throw new CHttpException ( 404, 'The requested page does not exist.' );
		}
		return $this->_model;
	}
}