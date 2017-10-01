<?php
class AccidentInvestigation extends CActiveRecord {
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public function tableName() {
		return 'tb_accident_investigation';
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
						'id,owner_department_idÁ
						name,
						positon_or_level,
						department_id,
						responsibility,
						work_period,
						person_type,
						person_type_other,
						case_date,
						accident_location,
						activity_at_accident,
						count_work_person,
						body_accident_type,
						body_accident_type_other,
						treat_detail,
						leave_day,
						eyewitnesses,
						accident_event_happen,
						img1,
						accident_type,
						accident_type6_other,
						ever_happen,
						ever_happen1_other,
						accident_cause,
						accidental_damage_type,
						accidental_damage1,
						accidental_damage2,
						accidental_damage3,
						accidental_damage4,
						accidental_damage4_other,
						accidental_damage5,
						lost_type,
						accident_name1,
						accident_age1,
						accident_year1,
						accident_position1,
						dammage_body1,
						dammage_body_desc1,
						accident_name2,
						accident_age2,
						accident_year2,
						accident_position2,
						dammage_body2,
						dammage_body_desc2,
						accident_name3,
						accident_age3,
						accident_year3,
						accident_position3,
						dammage_body3,
						dammage_body_desc3,
						accident_solve,
						img2,
						accident_protect,
						img3,
						create_date,
						create_by',
						'safe' 
				) 
		);
	}
	public function attributeLabels() {
		return array ()

		;
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
				) // ConfigUtil::getDefaultPageSize()
 
		) );
	}
	public static function getMax() {
		$criteria = new CDbCriteria ();
		$criteria->order = 'id DESC';
		$row = self::model ()->find ( $criteria );
		$max = $row->id;
		return $max+1;
	}
}