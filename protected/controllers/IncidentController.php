<?php

class IncidentController extends CController
{
	
	public $layout = '_main';
	
	private $_model;
	
	public function actionIndex()
	{
		// Authen Login
		if (! UserLoginUtils::isLogin()) {
			$this->redirect(Yii::app()->createUrl('Site/login'));
		}
		if (! UserLoginUtils::authorizePage($_SERVER['REQUEST_URI'])) {
			$this->redirect(Yii::app()->createUrl('DashBoard/Permission'));
		}
		if(UserLoginUtils::getUserRole() == 6){
			$this->render('//operations/incident/create');
		}else{
			// Render
			$model = new Incident();
			$this->render('//operations/incident/main', array(
					'data' => $model
			));
		}
		
	}
	
	public function actionCreate()
	{
		// Authen Login
		if (! UserLoginUtils::isLogin()) {
			$this->redirect(Yii::app()->createUrl('Site/login'));
		}
		if (! UserLoginUtils::authorizePage($_SERVER['REQUEST_URI'])) {
			$this->redirect(Yii::app()->createUrl('DashBoard/Permission'));
		}
		
		
		if (isset ( $_POST ['Incident'] )) {
			
			$transaction = Yii::app ()->db->beginTransaction ();
			// Add Request
			$model = new Incident ();
			$model->attributes = $_POST ['Incident'];
			$model->report_date = CommonUtil::getDate ( $model->report_date );
			$model->create_date = date ( "Y-m-d H:i:s" );
			$model->create_by = UserLoginUtils::getUsersLoginId ();
			
			$model->save ();
			
			// Save image.
			$acc_img = new IncidentImage();
			$acc_img->incident_id = $model->id;
			
			if (isset($_POST['IncidentImage'])) {
				$acc_img->attributes = $_POST['IncidentImage'];
			}
			
			$img1 = $_FILES['img1'];
			if (isset($img1)) {
				$file_ary = CommonUtil::reArrayFiles($img1);
				$index = 0;
				foreach ($file_ary as $file) {
					if ($file['size'] > 0) {
						$acc_img->path_img1 = CommonUtil::upload($file);
					}
					$index ++;
				}
			}
			$img2 = $_FILES['img2'];
			if (isset($img2)) {
				$file_ary = CommonUtil::reArrayFiles($img2);
				$index = 0;
				foreach ($file_ary as $file) {
					if ($file['size'] > 0) {
						$acc_img->path_img2 = CommonUtil::upload($file);
					}
					$index ++;
				}
			}
			$img3 = $_FILES['img3'];
			if (isset($img3)) {
				$file_ary = CommonUtil::reArrayFiles($img3);
				$index = 0;
				foreach ($file_ary as $file) {
					if ($file['size'] > 0) {
						$acc_img->path_img3 = CommonUtil::upload($file);
					}
					$index ++;
				}
			}
			$img4 = $_FILES['img4'];
			if (isset($img4)) {
				$file_ary = CommonUtil::reArrayFiles($img4);
				$index = 0;
				foreach ($file_ary as $file) {
					if ($file['size'] > 0) {
						$acc_img->path_img4 = CommonUtil::upload($file);
					}
					$index ++;
				}
			}
			$img5 = $_FILES['img5'];
			if (isset($img5)) {
				$file_ary = CommonUtil::reArrayFiles($img5);
				$index = 0;
				foreach ($file_ary as $file) {
					if ($file['size'] > 0) {
						$acc_img->path_img5 = CommonUtil::upload($file);
					}
					$index ++;
				}
			}
			$acc_img->save();
			
			
			
			
			// Notify//
			$notify = new Notify ();
			$notify->report_type = 2; // 1:Acicent&Investigate,2:Incident,3:Accident
			$notify->department_id = UserLoginUtils::getDepartmentId ();
			$notify->title = 'บันทึกข้อมูลอุบัติการณ์';
			$notify->remark = 'บันทึกข้อมูลอุบัติการณ์'.$model->accident_event_withness_first.','.$model->accident_cause;
			$notify->isRead = false;
			$notify->create_date = date ( "Y-m-d H:i:s" );
			$notify->save ();
			// End-Notify//
			
			// echo "SAVE";
			$transaction->commit ();
			
			// $transaction->rollback ();
			// $this->redirect ( Yii::app ()->createUrl ( 'Incident' ) );
			$this->render ( '//operations/incident/result' );
		} else {
			// Render
			$this->render('//operations/incident/create');
		}
	}
	
	public function actionDelete()
	{
		// Authen Login
		if (! UserLoginUtils::isLogin()) {
			$this->redirect(Yii::app()->createUrl('Site/login'));
		}
		if (! UserLoginUtils::authorizePage($_SERVER['REQUEST_URI'])) {
			$this->redirect(Yii::app()->createUrl('DashBoard/Permission'));
		}
		$model = $this->loadModel();
		$model->delete();
		
		$this->redirect(Yii::app()->createUrl('Incident/'));
	}
	
	public function actionUpdate()
	{
		// Authen Login
		if (! UserLoginUtils::isLogin()) {
			$this->redirect(Yii::app()->createUrl('Site/login'));
		}
		if (! UserLoginUtils::authorizePage($_SERVER['REQUEST_URI'])) {
			$this->redirect(Yii::app()->createUrl('DashBoard/Permission'));
		}
		
		$model = $this->loadModel();
		$modelImg = IncidentImage::model()->find(array("condition"=>"incident_id =".$model->id));
		
		if (isset($_POST['Incident'])) {
			$transaction = Yii::app()->db->beginTransaction();
			$model->attributes = $_POST['Incident'];
			$model->report_date = CommonUtil::getDate ( $model->report_date );
			
			$model->update_date = date ( "Y-m-d H:i:s" );
			$model->update_by = UserLoginUtils::getUsersLoginId ();
			
			$model->update();
			
			
			// Save image.
			$acc_img = new IncidentImage();
			$acc_img = IncidentImage::model()->find(array("condition"=>"incident_id =".$model->id));
			
			if (isset($_POST['IncidentImage'])) {
				$acc_img->attributes = $_POST['IncidentImage'];
			}
			
			
			$img1 = $_FILES['img1'];
			if (isset($img1)) {
				$file_ary = CommonUtil::reArrayFiles($img1);
				$index = 0;
				foreach ($file_ary as $file) {
					if ($file['size'] > 0) {
						$acc_img->path_img1 = CommonUtil::upload($file);
					}
					$index ++;
				}
			}
			$img2 = $_FILES['img2'];
			if (isset($img2)) {
				$file_ary = CommonUtil::reArrayFiles($img2);
				$index = 0;
				foreach ($file_ary as $file) {
					if ($file['size'] > 0) {
						$acc_img->path_img2 = CommonUtil::upload($file);
					}
					$index ++;
				}
			}
			$img3 = $_FILES['img3'];
			if (isset($img3)) {
				$file_ary = CommonUtil::reArrayFiles($img3);
				$index = 0;
				foreach ($file_ary as $file) {
					if ($file['size'] > 0) {
						$acc_img->path_img3 = CommonUtil::upload($file);
					}
					$index ++;
				}
			}
			$img4 = $_FILES['img4'];
			if (isset($img4)) {
				$file_ary = CommonUtil::reArrayFiles($img4);
				$index = 0;
				foreach ($file_ary as $file) {
					if ($file['size'] > 0) {
						$acc_img->path_img4 = CommonUtil::upload($file);
					}
					$index ++;
				}
			}
			$img5 = $_FILES['img5'];
			if (isset($img5)) {
				$file_ary = CommonUtil::reArrayFiles($img5);
				$index = 0;
				foreach ($file_ary as $file) {
					if ($file['size'] > 0) {
						$acc_img->path_img5 = CommonUtil::upload($file);
					}
					$index ++;
				}
			}
			
			$acc_img->update();
			
			
			$transaction->commit();
			
			$this->redirect(Yii::app()->createUrl('Incident'));
		}
		$this->render('//operations/incident/update', array(
				'data' => $model,'imgs' =>$modelImg
		));
	}
	
	public function loadModel()
	{
		if ($this->_model === null) {
			if (isset($_GET['id'])) {
				$id = addslashes($_GET['id']);
				$this->_model = Incident::model()->findbyPk($id);
			}
			
			
			if ($this->_model === null)
				throw new CHttpException(404, 'The requested page does not exist.');
		}
		return $this->_model;
	}
}