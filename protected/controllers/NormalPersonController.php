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
	
	public function actionCreate()
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
// 	            $model->create_by = UserLoginUtils::getUsersLoginId();
	            
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
	                $criteria->condition = " department_id = ".$model->department_id." and status = 1 and year=".date("Y");
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
	                        $acc_img->save();
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
	        $this->render('//operations/normalperson/create');
	    }
	}


	public function actionCreateIncident()
	{

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
	        $this->render ( '//operations/normalperson/result' );
	    } else {
	        // Render
	        $this->render('//operations/normalperson/create_incident');
	        
	    }
	}

}