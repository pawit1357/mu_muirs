<?php

class AjaxRequestController extends CController
{

    public $layout = 'ajax';

    private $_model;

    public function actionIndex()
    {}

    public function actionGetAmphur($province_id)
    {

        // Create connection
        mysql_connect(ConfigUtil::getHostName(), ConfigUtil::getUsername(), ConfigUtil::getPassword());
        mysql_select_db(ConfigUtil::getDbName());

        $json = array();
        $sql = "SELECT AMPHUR_ID,AMPHUR_NAME FROM tb_m_amphur WHERE PROVINCE_ID = " . $province_id;

        if ($result = mysql_query($sql)) {
            while ($item = mysql_fetch_assoc($result)) {
                $json[] = $item;
            }
        } else {
            print mysql_error();
        }
        echo json_encode($json);
    }

    public function actionGetTambon($amphur_id)
    {

        // Create connection
        mysql_connect(ConfigUtil::getHostName(), ConfigUtil::getUsername(), ConfigUtil::getPassword());
        mysql_select_db(ConfigUtil::getDbName());

        $json = array();
        $sql = "SELECT DISTRICT_ID,DISTRICT_NAME FROM tb_m_district WHERE amphur_id = " . $amphur_id;

        if ($result = mysql_query($sql)) {
            while ($item = mysql_fetch_assoc($result)) {
                $json[] = $item;
            }
        } else {
            print mysql_error();
        }
        echo json_encode($json);
    }

    public function actionCheckEmail($email)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = "(email = :email)";
        $criteria->params = array(
            ":email" => $email
        );

        $users = UsersLogin::model()->findAll($criteria);
        echo (empty($users[0]->id) ? 'true' : 'false'); //
                                                        // echo CJSON::encode(CommonUtil::convertModelToArray($users));
    }

    public function actionCheckUser($user)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = "(username = :username)";
        $criteria->params = array(
            ":username" => $user
        );

        $users = UsersLogin::model()->findAll($criteria);
        echo (empty($users[0]->id) ? 'true' : 'false'); //

        // isset($users)? 'true':'false';//
        // echo CJSON::encode ( CommonUtil::convertModelToArray ( $users ) );
    }

    public function actionGetDepartment()
    {    
        // Create connection
        mysql_connect(ConfigUtil::getHostName(), ConfigUtil::getUsername(), ConfigUtil::getPassword());
        mysql_select_db(ConfigUtil::getDbName());

        $parentKey = '-1';
        $sql = "select * from tb_m_department";
        
        $result = mysql_query($sql);
        if(mysql_num_rows($result) > 0)
        {
            $data =is_array(self::membersTree($parentKey))? array_values(self::membersTree($parentKey)): array(); 
        }else{
            $data=["id"=>"0","name"=>"No Members present in list","text"=>"No Members is present in list","nodes"=>[]];
        }
        echo json_encode(array_values($data));
        
    }
    
    public function membersTree($parentKey)
    {
        // Create connection
        mysql_connect(ConfigUtil::getHostName(), ConfigUtil::getUsername(), ConfigUtil::getPassword());
        mysql_select_db(ConfigUtil::getDbName());
        
        $sql = 'select id, name from tb_m_department WHERE faculty_id="'.$parentKey.'"';
        
        $result = mysql_query($sql);
        
        while($value = mysql_fetch_assoc($result)){
            $id = $value['id'];
            $row1[$id]['id'] = $value['id'];
            $row1[$id]['name'] = $value['name'];
            $row1[$id]['text'] = $value['name'];
            $row1[$id]['nodes'] =is_array(self::membersTree($value['id']))? array_values(self::membersTree($value['id'])): array();
        }
        
        return $row1;
    }
    
    
    
    
}