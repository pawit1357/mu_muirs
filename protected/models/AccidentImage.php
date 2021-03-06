<?php
class AccidentImage extends CActiveRecord {
    
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public function tableName() {
		return 'tb_accedent_images';
	}
	public function relations() {
		return array (
				'Accident' => array(
						self::BELONGS_TO,
						'Accident',
						'accident_id'
				),
		);
	}
	public function rules() {
		return array (
				array (
						'id,accident_id,
                        path_img1,
                        path_img2,
                        path_img3,
                        path_img4,
                        path_img5,
                        path_img6,
                        path_img7,
                        path_img8,
                        path_img9,
                        path_img10,
                        img1_description,
                        img2_description,
                        img3_description,
                        img4_description,
                        img5_description,
                        img6_description,
                        img7_description,
                        img8_description,
                        img9_description,
                        img10_description',
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