<?php

class AccidentController extends CController
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
		$model = new Accident();
		$this->render('//operations/accident/main', array(
				'data' => $model
		));
	}
	
	public function actionCreate()
	{
		// Authen Login
		if (! UserLoginUtils::isLogin()) {
			$this->redirect(Yii::app()->createUrl('Site/login'));
		}
		
		// if (! UserLoginUtils::authorizePage($_SERVER['REQUEST_URI'])) {
		// $this->redirect(Yii::app()->createUrl('DashBoard/Permission'));
		// }
		
		if (isset($_POST['Accident'])) {
			try {
				
				$transaction = Yii::app()->db->beginTransaction();
				// Add Request
				$model = new Accident();
				$model->attributes = $_POST['Accident'];
				$model->report_date = CommonUtil::getDate($model->report_date);
				$model->case_date = CommonUtil::getDate($model->case_date);
				$model->create_date = date("Y-m-d H:i:s");
				$model->create_by = UserLoginUtils::getUsersLoginId();
				
				$Accident_dammage_type = '';
				if (isset($_POST['Accident_dammage_type'])) {
					foreach ($_POST['Accident_dammage_type'] as $item) {
						$Accident_dammage_type .= $item . ',';
					}
				} else {
					$Accident_dammage_type = "";
				}
				$model->dammage_type = rtrim($Accident_dammage_type, ",");
				
				if (strpos($model->dammage_type, '1') !== false || strpos($model->dammage_type, '5') !== false) {
					// record only die.
					$lastAcDate = date("Y-m-d");
					
					$criteria = new CDbCriteria();
					$criteria->condition = " department_id = ".UserLoginUtils::getDepartmentId()." and status = 1 and year=".date("Y");
					$row = SafetyRecord::model()->find($criteria);
					
					if(!isset($row)){
						$row = new SafetyRecord();
						$row->department_id = UserLoginUtils::getDepartmentId();
						$row->year = date("Y");
						$row->days_target = 365;
						$row->status = 1;
						$row->last_accident_occurred_date = $model->case_date;
						$row->create_date = date("Y-m-d H:i:s");
						$row->save();
						
						$lastAcDate = $model->case_date;
					}else{
						$lastAcDate = $row->last_accident_occurred_date;
						$row->last_accident_occurred_date = $model->case_date;
						$row->update_date = date("Y-m-d H:i:s");
						$row->update();
					}
					
					$rowHis = new SafetyRecordHistory();
					$rowHis->department_id = UserLoginUtils::getDepartmentId();
					$rowHis->amount = CommonUtil::dateDiff($lastAcDate, $row->last_accident_occurred_date);
					$rowHis->last_accident_occurred_date = $model->case_date;
					$rowHis->create_date = date("Y-m-d H:i:s");
					$rowHis->save();
					
				}
				
				$model->save();
				
				// Save image.
				$acc_img = new AccidentImage();
				$acc_img->accident_id = $model->id;
				
				if (isset($_POST['AccidentImage'])) {
					$acc_img->attributes = $_POST['AccidentImage'];
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
				$img6 = $_FILES['img6'];
				if (isset($img6)) {
					$file_ary = CommonUtil::reArrayFiles($img6);
					$index = 0;
					foreach ($file_ary as $file) {
						if ($file['size'] > 0) {
							$acc_img->path_img6 = CommonUtil::upload($file);
						}
						$index ++;
					}
				}
				$img7 = $_FILES['img7'];
				if (isset($img7)) {
					$file_ary = CommonUtil::reArrayFiles($img7);
					$index = 0;
					foreach ($file_ary as $file) {
						if ($file['size'] > 0) {
							$acc_img->path_img7 = CommonUtil::upload($file);
						}
						$index ++;
					}
				}
				$img8 = $_FILES['img8'];
				if (isset($img8)) {
					$file_ary = CommonUtil::reArrayFiles($img8);
					$index = 0;
					foreach ($file_ary as $file) {
						if ($file['size'] > 0) {
							$acc_img->path_img8 = CommonUtil::upload($file);
						}
						$index ++;
					}
				}
				$img9 = $_FILES['img9'];
				if (isset($img9)) {
					$file_ary = CommonUtil::reArrayFiles($img9);
					$index = 0;
					foreach ($file_ary as $file) {
						if ($file['size'] > 0) {
							$acc_img->path_img9 = CommonUtil::upload($file);
						}
						$index ++;
					}
				}
				$img10 = $_FILES['img10'];
				if (isset($img10)) {
					$file_ary = CommonUtil::reArrayFiles($img10);
					$index = 0;
					foreach ($file_ary as $file) {
						if ($file['size'] > 0) {
							$acc_img->path_img10 = CommonUtil::upload($file);
						}
						$index ++;
					}
				}
				$acc_img->save();
				
				
				// Notify//
				$notify = new Notify ();
				$notify->report_type = 3; // 1:Acicent&Investigate,2:Incident,3:Accident
				$notify->department_id = UserLoginUtils::getDepartmentId ();
				$notify->title = 'บันทึกข้อมูลอุบัติเหตุxxxxxxx';
				$notify->remark = 'บันทึกข้อมูลอุบัติเหตุ '.$model->name.','.$model->phone_number;
				$notify->isRead = false;
				$notify->create_date = date ( "Y-m-d H:i:s" );
				$notify->save ();
				// End-Notify//
				
				// echo "SAVE";
				$transaction->commit();
				
				$this->render('//operations/accident/result');
			} catch (Exception $e) {
				echo $e;
				$transaction->rollback();
			}
		} else {
			// Render
			$this->render('//operations/accident/create');
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
		
		$this->redirect(Yii::app()->createUrl('Accident/'));
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
		$modelImg = AccidentImage::model()->find(array("condition"=>"accident_id =".$model->id));
		
		if (isset($_POST['Accident'])) {
			try {
				
				$transaction = Yii::app()->db->beginTransaction();
				$model->attributes = $_POST['Accident'];
				$model->report_date = CommonUtil::getDate($model->report_date);
				$model->case_date = CommonUtil::getDate($model->case_date);
				$model->update_date = date("Y-m-d H:i:s");
				$model->update_by = UserLoginUtils::getUsersLoginId();
				
				$model->update();
				
				// Save image.
				$acc_img = new AccidentImage();
				$acc_img = AccidentImage::model()->find(array("condition"=>"accident_id =".$model->id));
				
				if (isset($_POST['AccidentImage'])) {
					$acc_img->attributes = $_POST['AccidentImage'];
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
				$img6 = $_FILES['img6'];
				if (isset($img6)) {
					$file_ary = CommonUtil::reArrayFiles($img6);
					$index = 0;
					foreach ($file_ary as $file) {
						if ($file['size'] > 0) {
							$acc_img->path_img6 = CommonUtil::upload($file);
						}
						$index ++;
					}
				}
				$img7 = $_FILES['img7'];
				if (isset($img7)) {
					$file_ary = CommonUtil::reArrayFiles($img7);
					$index = 0;
					foreach ($file_ary as $file) {
						if ($file['size'] > 0) {
							$acc_img->path_img7 = CommonUtil::upload($file);
						}
						$index ++;
					}
				}
				$img8 = $_FILES['img8'];
				if (isset($img8)) {
					$file_ary = CommonUtil::reArrayFiles($img8);
					$index = 0;
					foreach ($file_ary as $file) {
						if ($file['size'] > 0) {
							$acc_img->path_img8 = CommonUtil::upload($file);
						}
						$index ++;
					}
				}
				$img9 = $_FILES['img9'];
				if (isset($img9)) {
					$file_ary = CommonUtil::reArrayFiles($img9);
					$index = 0;
					foreach ($file_ary as $file) {
						if ($file['size'] > 0) {
							$acc_img->path_img9 = CommonUtil::upload($file);
						}
						$index ++;
					}
				}
				$img10 = $_FILES['img10'];
				if (isset($img10)) {
					$file_ary = CommonUtil::reArrayFiles($img10);
					$index = 0;
					foreach ($file_ary as $file) {
						if ($file['size'] > 0) {
							$acc_img->path_img10 = CommonUtil::upload($file);
						}
						$index ++;
					}
				}
				
				//                 if(!isset($acc_img)){
				$acc_img->update();
				//                 }else{
				//                     $acc_img->save();
				//                 }
				
				
				// Notify//
				$model1 = new Notify();
				$model1->report_type = 3; // 1:Acicent&Investigate,2:Incident,3:Accident
				$model1->title = 'Accident';
				$model1->remark = '';
				$model1->isRead = false;
				$model1->create_date = date("Y-m-d H:i:s");
				$model1->save();
				// End-Notify//
				
				$transaction->commit();
				
				$this->redirect(Yii::app()->createUrl('Accident'));
			} catch (Exception $e) {
				echo $e;
				$transaction->rollback();
			}
		} else {
			
			$this->render('//operations/accident/update', array(
					'data' => $model,'imgs' =>$modelImg
			));
		}
	}
	
	public function loadModel()
	{
		if ($this->_model === null) {
			if (isset($_GET['id'])) {
				
				$id = addslashes($_GET['id']);
				$this->_model = Accident::model()->findbyPk($id);
				
			}
			if ($this->_model === null)
				throw new CHttpException(404, 'The requested page does not exist.');
		}
		return $this->_model;
	}
}