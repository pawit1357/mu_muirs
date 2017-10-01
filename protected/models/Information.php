<?php
class Information extends CActiveRecord {
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public function tableName() {
		return 'tb_information';
	}
	public function relations() {
		return array(
				'catagories' => array(self::BELONGS_TO, 'MCatagories', 'catagories_id'),
				'department' => array(self::BELONGS_TO, 'MDepartment', 'dep_department_id'),
				'build' => array(self::BELONGS_TO, 'MBuilding', 'building_id'),
				'lab_operating_characteristics' => array(self::BELONGS_TO, 'MLabOperChar', 'lab_operating_characteristics_id'),
				'lab_type' => array(self::BELONGS_TO, 'MLabType', 'lab_type_id'),
				'users' => array(self::BELONGS_TO, 'UsersLogin', 'user_id')
		);
	}
	public function rules() {
		return array (
				array (
						'id,
						catagories_id,
						image_path,
						short_description,
						description,
						period_start,
						period_end,
						status',
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
				) 
		) // ConfigUtil::getDefaultPageSize()

		 );
	}
	
	public static function getMax() {
		$criteria = new CDbCriteria ();
		$criteria->order = 'id DESC';
		$row = self::model ()->find ( $criteria );
		$max = $row->id;
		return $max + 1;
	}
	
}