<?php

class AccidentInvestigationController extends CController
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
        
        // Render
        $model = new AccidentInvestigation();
        $this->render('//accidentinvestigation/main', array(
            'data' => $model
        ));
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
        
        if (isset($_POST['AccidentInvestigation'])) {
            
            $transaction = Yii::app()->db->beginTransaction();
            
            $person_types = $_POST['person_types'];
            $person_type_others = $_POST['person_type_others'];
            $person_lost_types = $_POST['person_lost_types'];
            
            $person_sexs = $_POST['person_sexs'];
            $person_names = $_POST['person_names'];
            $person_ages = $_POST['person_ages'];
            $person_positions = $_POST['person_positions'];
            $person_department_ids = $_POST['person_department_ids'];
            $person_responsibilitys = $_POST['person_responsibilitys'];
            $person_work_periods = $_POST['person_work_periods'];
            $person_dammage_bodys = $_POST['person_dammage_bodys'];
            $person_dammage_body_descs = $_POST['person_dammage_body_descs'];
            
            $index = 0;
            foreach ($person_names as $item) {
                $model = new AccidentInvestigation();
                $model->attributes = $_POST['AccidentInvestigation'];
                $model->case_date = CommonUtil::getDate($model->case_date);
                $model->create_date = date("Y-m-d H:i:s");
                $model->create_by = UserLoginUtils::getUsersLoginId();
                
                //
                $model->person_type = $person_types[$index];
                $model->person_type_other = $person_type_others[$index];
                $model->person_lost_type = $person_lost_types[$index];
                $model->person_sex = $person_sexs[$index];
                $model->person_name = $person_names[$index];
                $model->person_age = $person_ages[$index];
                $model->person_position = $person_positions[$index];
                $model->person_department_id = $person_department_ids[$index];
                $model->person_responsibility = $person_responsibilitys[$index];
                $model->person_work_period = $person_work_periods[$index];
                $model->person_dammage_body = $person_dammage_bodys[$index];
                $model->person_dammage_body_desc = $person_dammage_body_descs[$index];
                // /
                $bodyAccidentInvestigation = '';
                if (isset($_POST['bodyAccidentInvestigation'])) {
                    foreach ($_POST['bodyAccidentInvestigation'] as $item) {
                        $bodyAccidentInvestigation .= $item . ',';
                    }
                } else {
                    $bodyAccidentInvestigation = "";
                }
                $model->body_accident_type = rtrim($bodyAccidentInvestigation, ",");
                
                $accident_type = '';
                if (isset($_POST['accident_type'])) {
                    foreach ($_POST['accident_type'] as $item) {
                        $accident_type .= $item . ',';
                    }
                } else {
                    $accident_type = "";
                }
                $model->accident_type = rtrim($accident_type, ",");
                $model->group_id = date("YmdHis");
                $model->save();
                $index ++;
            }
            

            $acc_img = new AccidentInvestigationImage();
            $acc_img->accident_investigation_id = $model->id;
            
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
            $acc_img->save();
            
            
            // Notify//
            $model = new Notify();
            $model->report_type = 1; // 1:Acicent&Investigate,2:Incident,3:Accident
            $model->title = 'Acicent&Investigate';
            $model->remark = '';
            $model->isRead = false;
            $model->create_date = date("Y-m-d H:i:s");
            $model->save();
            // End-Notify//
            
            // echo "SAVE";
            $transaction->commit();
            
            // $transaction->rollback ();
            $this->render('//accidentinvestigation/result');
        } else {
            // Render
            $this->render('//accidentinvestigation/create');
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
        
        $this->redirect(Yii::app()->createUrl('AccidentInvestigation/'));
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
        
        $model = new AccidentInvestigation();
        
        $model = $this->loadModel();
        if (isset($_POST['AccidentInvestigation'])) {
            
            $transaction = Yii::app()->db->beginTransaction();
            
            $model->attributes = $_POST['AccidentInvestigation'];
            $model->case_date = CommonUtil::getDate($model->case_date);
            $model->update_date = date("Y-m-d H:i:s");
            $model->update_by = UserLoginUtils::getUsersLoginId();
            
            $bodyAccidentInvestigation = '';
            if (isset($_POST['bodyAccidentInvestigation'])) {
                foreach ($_POST['bodyAccidentInvestigation'] as $item) {
                    $bodyAccidentInvestigation .= $item . ',';
                }
            } else {
                $bodyAccidentInvestigation = "";
            }
            $model->body_accident_type = rtrim($bodyAccidentInvestigation, ",");
            
            $accident_type = '';
            if (isset($_POST['accident_type'])) {
                foreach ($_POST['accident_type'] as $item) {
                    $accident_type .= $item . ',';
                }
            } else {
                $accident_type = "";
            }
            $model->accident_type = rtrim($accident_type, ",");
            $model->update();
            

            $acc_img = AccidentInvestigationImage::model()->findbyPk($model->id);

            
            if(!isset($acc_img)){
                $acc_img = new AccidentInvestigationImage();
                $acc_img->accident_investigation_id = $model->id;
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
            if(!isset($acc_img)){

                $acc_img->update();
            }else{  

                $acc_img->save();
            }
            
            
            $transaction->commit();
            
            $this->redirect(Yii::app()->createUrl('AccidentInvestigation'));
        } else {
            $this->render('//accidentinvestigation/update', array(
                'data' => $model
            ));
        }
    }

    public function loadModel()
    {
        if ($this->_model === null) {
            if (isset($_GET['id'])) {
                $id = addslashes($_GET['id']);
                $this->_model = AccidentInvestigation::model()->findbyPk($id);
            }
            if ($this->_model === null)
                throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $this->_model;
    }
}