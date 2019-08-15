<?php
class AccidentInvestigationPerson extends CActiveRecord {
    public static function model($className = __CLASS__) {
        return parent::model ( $className );
    }
    public function tableName() {
        return 'tb_accident_investigation_person';
    }
    public function relations() {
        return array (
            'AccidentInvestigation' => array(
                self::BELONGS_TO,
                'AccidentInvestigation',
                'accident_investigation_id'
            ),
        );
    }
    public function rules() {
        return array (
            array (
                '
                id,
                accident_investigation_id,
                person_type,
                person_type_other,
                person_name,
                person_position,
                person_department_id,
                person_responsibility,
                person_work_period,
                person_lost_type,
                person_sex,
                person_age,
                person_dammage_body,
                person_dammage_body_desc,
                create_date datetime 
                create_by,
                update_date datetime 
                update_by
                ',
                'safe'
            )
        );
    }
    public function attributeLabels() {
        return array ();
        
    }
    public function getUrl($post = null) {
        if ($post === null)
            $post = $this->post;
            return $post->url . '#c' . $this->id;
    }
    protected function beforeSave() {
        return true;
    }
    public function search() {
        $criteria = new CDbCriteria ();
        return new CActiveDataProvider ( get_class ( $this ), array (
            'criteria' => $criteria,
            'sort' => array (
                'defaultOrder' => 't.id asc'
            ),
            'pagination' => array (
                'pageSize' => 15
            )  // ConfigUtil::getDefaultPageSize()
            
        ) );
    }
    public static function getMax() {
        $criteria = new CDbCriteria ();
        $criteria->order = 'id DESC';
        $row = self::model ()->find ( $criteria );
        $max = $row->id;
        return $max + 1;
    }
}