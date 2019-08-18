<?php
class Incident extends CActiveRecord {
    
    public $report_date_to;
    public $report_date_from;
    
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public function tableName() {
		return 'tb_incident';
	}
	public function relations() {
		return array (
				'department' => array(
						self::BELONGS_TO,
						'MDepartment',
						'owner_department_id'
				),
		);}
	public function rules() {
		return array (
				array (
						'id,
                        report_date,
                        accident_location,
                        accident_cause,
                        accident_characteristics,
                        accident_event_withness_first,
                        img1,
                        owner_department_id,
                        create_date,
                        create_by,
                        update_date,
                        update_by,
                        id,owner_department_id,report_date_to,report_date_from','safe' 
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
		switch (UserLoginUtils::getUserRole ()) {
			case "1" : // Admin
				break;
			default :
				$criteria->addCondition ( "t.owner_department_id = " . UserLoginUtils::getDepartmentId () );
				break;
		}
		return new CActiveDataProvider ( get_class ( $this ), array (
				'criteria' => $criteria,
				'sort' => array (
						'defaultOrder' => 't.create_date desc' 
				),
				'pagination' => array (
				    'pageSize' => 1500
				)  // ConfigUtil::getDefaultPageSize()
		
		) );
	}
// 	public static function getMax() {
// 		$criteria = new CDbCriteria ();
// 		$criteria->order = 'id DESC';
// 		$row = self::model ()->find ( $criteria );
// 		$max = $row->id;
// 		return $max + 1;
// 	}
}