<?php
class Accident extends CActiveRecord {
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public function tableName() {
		return 'tb_accident';
	}
	public function relations() {
		return array (
				'department' => array(
						self::BELONGS_TO,
						'MDepartment',
						'department_id'
				),
				'onwerdepartment' => array(
						self::BELONGS_TO,
						'MDepartment',
						'owner_department_id'
				),
		);
	}
	public function rules() {
		return array (
				array (
						'id,owner_department_id,
name,
position_or_level,
department_id,belong_to,
phone_number,
email, 
report_date,
case_date date 
name2,
belong_t,
img1,
img2,
accident_location,
accident_chronology,
accident_event,
accident_cause,
accident_solve,
dammage_type, 
dammage_type_1_value,
dammage_type_2_value,
dammage_type_3_value,
dammage_type_4_value, 
dammage_type_5_value,
create_by, 
create_dat',
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