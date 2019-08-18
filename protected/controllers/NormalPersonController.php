<?php
/**
 * SiteController is the default controller to handle user requests.
 */
class NormalPersonController extends CController {
	public $layout = '_blank2';
	private $_model;
	public function actionIndex() {
		// Authen Login
// 	    UserLoginUtils::authen ( 'anonymou', 'anonymou' );
	    
		$this->render ( '//operations/normalperson/main' );
	}
	
	public function actionCAccident()
	{	    
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
	            $model = new Notify();
	            $model->report_type = 3; // 1:Acicent&Investigate,2:Incident,3:Accident
	            $model->title = 'Accident';
	            $model->remark = '';
	            $model->isRead = false;
	            $model->create_date = date("Y-m-d H:i:s");
	            $model->save();
	            // End-Notify//
	            
	            // echo "SAVE";
	            $transaction->commit();
	            
	            $this->render('//operations/normalperson/result');
	        } catch (Exception $e) {
	            echo $e;
	            $transaction->rollback();
	        }
	    } else {
	        // Render
	        $this->render('//operations/normalperson/accident');
	    }
	}


	public function actionCIncident()
	{

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
	        $notify = new Notify();
	        $notify->report_type = 2;//1:Acicent&Investigate,2:Incident,3:Accident
	        $notify->title = 'Incident';
	        $notify->remark = '';
	        $notify->isRead = false;
	        $notify->create_date = date("Y-m-d H:i:s");
	        $notify->save();
	        // End-Notify//
	        
	        // echo "SAVE";
	        $transaction->commit ();
	        
	        // $transaction->rollback ();
	        // $this->redirect ( Yii::app ()->createUrl ( 'Incident' ) );
	        $this->render ( '//operations/normalperson/result' );
	    } else {
	        // Render
	        $this->render('//operations/normalperson/incident');
	        
	    }
	}

}