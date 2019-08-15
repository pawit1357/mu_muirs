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
        $this->render('//operations/accidentinvestigation/main', array(
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
            
            $model = new AccidentInvestigation();
            $model->attributes = $_POST['AccidentInvestigation'];
            $model->create_date = date("Y-m-d H:i:s");
            $model->create_by = UserLoginUtils::getUsersLoginId();
            $model->update_date = date("Y-m-d H:i:s");
            $model->update_by = UserLoginUtils::getUsersLoginId();
            
            $model->report_date = CommonUtil::getDate($model->report_date);
            $model->case_date =  CommonUtil::getDate($model->case_date);
            $body_accident_type = '';
            if (isset($_POST['bodyAccidentInvestigation'])) {
                foreach ($_POST['bodyAccidentInvestigation'] as $item) {
                    $body_accident_type .= $item . ',';
                }
            } else {
                $body_accident_type = "";
            }
            $model->body_accident_type = rtrim($body_accident_type, ",");
            $accident_type = '';
            if (isset($_POST['accident_type'])) {
                foreach ($_POST['accident_type'] as $item) {
                    $accident_type .= $item . ',';
                }
            } else {
                $accident_type = "";
            }
            $model->accident_type = rtrim($accident_type, ",");
            $model->save();
            
            //#####################################################
            $person_types = $_POST['person_types'];
            $person_type_others = $_POST['person_type_others'];
            $person_names = $_POST['person_names'];
            $person_ages = $_POST['person_ages'];
            $person_sexs = $_POST['person_sexs'];
            $person_positions = $_POST['person_positions'];
            $person_work_periods = $_POST['person_work_periods'];
            $person_responsibilitys = $_POST['person_responsibilitys'];
            $person_department_ids = $_POST['person_department_ids'];
            //#####################################################
            $person_lost_types = $_POST['person_lost_types'];
            $person_dammage_bodys = $_POST['person_dammage_bodys'];
            $person_dammage_body_descs = $_POST['person_dammage_body_descs'];
            //#####################################################
            $index = 0;
            foreach ($person_names as $item) {

                $person = new AccidentInvestigationPerson();
                $person->accident_investigation_id = $model->id;
                //
                $person->person_type = $person_types[$index];
                $person->person_type_other = $person_type_others[$index];
                $person->person_name = $person_names[$index];
                $person->person_position = $person_positions[$index];
                $person->person_department_id = $person_department_ids[$index];
                $person->person_responsibility = $person_responsibilitys[$index];
                $person->person_work_period = $person_work_periods[$index];
                $person->person_lost_type = $person_lost_types[$index];
                $person->person_sex = $person_sexs[$index];
                $person->person_age = $person_ages[$index];
                $person->person_dammage_body = $person_dammage_bodys[$index];
                $person->person_dammage_body_desc = $person_dammage_body_descs[$index];
                
//                 $bodyAccidentInvestigation = '';
//                 if (isset($_POST['bodyAccidentInvestigation'])) {
//                     foreach ($_POST['bodyAccidentInvestigation'] as $item) {
//                         $bodyAccidentInvestigation .= $item . ',';
//                     }
//                 } else {
//                     $bodyAccidentInvestigation = "";
//                 }
//                 $model->body_accident_type = rtrim($bodyAccidentInvestigation, ",");
                

//                 $model->accident_type = rtrim($accident_type, ",");
//                 $model->group_id = date("YmdHis");
                $person->save();
                $index ++;
            }
            
            // Save image.
            $acc_img = new AccidentInvestigationImage();
            $acc_img->accident_investigation_id = $model->id;
            
            if (isset($_POST['AccidentInvestigationImage'])) {
                $acc_img->attributes = $_POST['AccidentInvestigationImage'];
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
            $img11 = $_FILES['img11'];
            if (isset($img11)) {
                $file_ary = CommonUtil::reArrayFiles($img11);
                $index = 0;
                foreach ($file_ary as $file) {
                    if ($file['size'] > 0) {
                        $acc_img->path_img11 = CommonUtil::upload($file);
                    }
                    $index ++;
                }
            }
            $img12 = $_FILES['img12'];
            if (isset($img12)) {
                $file_ary = CommonUtil::reArrayFiles($img12);
                $index = 0;
                foreach ($file_ary as $file) {
                    if ($file['size'] > 0) {
                        $acc_img->path_img12 = CommonUtil::upload($file);
                    }
                    $index ++;
                }
            }
            $img13 = $_FILES['img13'];
            if (isset($img13)) {
                $file_ary = CommonUtil::reArrayFiles($img13);
                $index = 0;
                foreach ($file_ary as $file) {
                    if ($file['size'] > 0) {
                        $acc_img->path_img13 = CommonUtil::upload($file);
                    }
                    $index ++;
                }
            }
            $img14 = $_FILES['img14'];
            if (isset($img14)) {
                $file_ary = CommonUtil::reArrayFiles($img14);
                $index = 0;
                foreach ($file_ary as $file) {
                    if ($file['size'] > 0) {
                        $acc_img->path_img14 = CommonUtil::upload($file);
                    }
                    $index ++;
                }
            }
            $img15 = $_FILES['img15'];
            if (isset($img15)) {
                $file_ary = CommonUtil::reArrayFiles($img15);
                $index = 0;
                foreach ($file_ary as $file) {
                    if ($file['size'] > 0) {
                        $acc_img->path_img15 = CommonUtil::upload($file);
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
            $this->render('//operations/accidentinvestigation/result');
        } else {
            // Render
            $this->render('//operations/accidentinvestigation/create');
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
        $modelImg = AccidentInvestigationImage::model()->find(array("condition"=>"accident_id =".$model->id));
        
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
            

            
            // Save image.
            $acc_img = new AccidentInvestigationImage();
            $acc_img = AccidentImage::model()->find(array("condition"=>"accident_investigation_id =".$model->id));
            
            if (isset($_POST['AccidentInvestigationImage'])) {
                $acc_img->attributes = $_POST['AccidentInvestigationImage'];
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
            $img11 = $_FILES['img11'];
            if (isset($img11)) {
                $file_ary = CommonUtil::reArrayFiles($img11);
                $index = 0;
                foreach ($file_ary as $file) {
                    if ($file['size'] > 0) {
                        $acc_img->path_img11 = CommonUtil::upload($file);
                    }
                    $index ++;
                }
            }
            $img12 = $_FILES['img12'];
            if (isset($img12)) {
                $file_ary = CommonUtil::reArrayFiles($img12);
                $index = 0;
                foreach ($file_ary as $file) {
                    if ($file['size'] > 0) {
                        $acc_img->path_img12 = CommonUtil::upload($file);
                    }
                    $index ++;
                }
            }
            $img13 = $_FILES['img13'];
            if (isset($img13)) {
                $file_ary = CommonUtil::reArrayFiles($img13);
                $index = 0;
                foreach ($file_ary as $file) {
                    if ($file['size'] > 0) {
                        $acc_img->path_img13 = CommonUtil::upload($file);
                    }
                    $index ++;
                }
            }
            $img14 = $_FILES['img14'];
            if (isset($img14)) {
                $file_ary = CommonUtil::reArrayFiles($img14);
                $index = 0;
                foreach ($file_ary as $file) {
                    if ($file['size'] > 0) {
                        $acc_img->path_img14 = CommonUtil::upload($file);
                    }
                    $index ++;
                }
            }
            $img15 = $_FILES['img15'];
            if (isset($img15)) {
                $file_ary = CommonUtil::reArrayFiles($img15);
                $index = 0;
                foreach ($file_ary as $file) {
                    if ($file['size'] > 0) {
                        $acc_img->path_img15 = CommonUtil::upload($file);
                    }
                    $index ++;
                }
            }
            $acc_img->update();

            
            
            $transaction->commit();
            
            $this->redirect(Yii::app()->createUrl('AccidentInvestigation'));
        } else {
            $this->render('//operations/accidentinvestigation/update', array(
                'data' => $model,'imgs' =>$modelImg
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