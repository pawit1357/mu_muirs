<?php
class MDepartment extends CActiveRecord {
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public function tableName() {
		return 'tb_m_department';
	}
	public function relations() {
		return array (
// 				'underdepartments' => array (
// 						self::BELONGS_TO,
// 						'MDepartment',
// 						'parent_id'
// 				),
		);
	}
	public function rules() {
		return array (
				array (
						'id,name,faculty_id,seq',
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
						'defaultOrder' => 'seq asc' 
				),
				'pagination' => array (
						'pageSize' => 50 
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
	
	public static function findById($id) {
		$criteria = new CDbCriteria ();
		$criteria->condition = " faculty_id = -1";
		$departments = self::model ()->findAll ($criteria);
		return $departments[0];
	}
	
}