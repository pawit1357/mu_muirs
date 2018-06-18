<?php
class Incident extends CActiveRecord {
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public function tableName() {
		return 'tb_incident';
	}
	public function relations() {
		return array (
				'onwerdepartment' => array(
						self::BELONGS_TO,
						'MDepartment',
						'owner_department_id'
				),
		);}
	public function rules() {
		return array (
				array (
						'id,owner_department_id,
						report_date,
						accident_location,
						accident_cause,
						accident_characteristics,accident_event_withness_first,
						img1,create_date,create_by',
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