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
        $this->render('//accident/main', array(
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

                if (strpos($model->dammage_type, '1') !== false) {
                    // record only die.
                    $criteria = new CDbCriteria();
                    $criteria->condition = " department_id = -1 and status=1";
                    $row = SafetyRecordHistory::model()->find($criteria);
                    // $row->we_have_operated_day = 0;
                    $row->the_best_record = CommonUtil::dateDiff($row->last_accident_occurred_date, date("Y-m-d H:i:s"));
                    $row->last_accident_occurred_date = date("Y-m-d H:i:s");
                    $row->save();
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

                $this->render('//accident/result');
            } catch (Exception $e) {
                echo $e;
                $transaction->rollback();
            }
        } else {
            // Render
            $this->render('//accident/create');
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

        $this->redirect(Yii::app()->createUrl('accident/'));
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
                $acc_img->update();

                // Notify//
                $model = new Notify();
                $model->report_type = 3; // 1:Acicent&Investigate,2:Incident,3:Accident
                $model->title = 'Accident';
                $model->remark = '';
                $model->isRead = false;
                $model->create_date = date("Y-m-d H:i:s");
                $model->save();
                // End-Notify//

                $transaction->commit();

                $this->redirect(Yii::app()->createUrl('Accident'));
            } catch (Exception $e) {
                echo $e;
                $transaction->rollback();
            }
        } else {
            $this->render('//accident/update', array(
                'data' => $model
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