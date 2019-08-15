<?php
class AccidentInvestigation extends CActiveRecord {
    
    public $report_date_to;
    public $report_date_from;
    
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
						'person_department_id'
				),
                'accidentInvestigationImage' => array(
				    self::BELONGS_TO,
				    'AccidentInvestigationImage',
				    'id'
				),
		);
	}
	public function rules() {
		return array (
				array (
						'
                            id,
                            report_name,
                            report_position,
                            case_date,
                            case_date_time,
                            report_date,
                            accident_location,
                            accident_mission,
                            count_work_person,
                            body_accident_type,
                            body_accident_type_other,
                            treat_detail,
                            leave_day,
                            eyewitnesses,
                            accident_event_happen,
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
                            accident_solve,
                            accident_protect,
                            create_date,
                            create_by,
                            update_date,
                            update_by
                            ',
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