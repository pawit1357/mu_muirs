<?php

ini_set ( 'max_execution_time', 0 );
class CommonUtil {
	

    
	public static function getShortThaiMonth($m){
		 $q_m = array("01"=>"ม.ค.",
				"02"=>"ก.พ.",
				"03"=>"มี.ค.",
				"04"=>"เม.ย.",
				"05"=>"พ.ค.",
				"06"=>"มิ.ย.",
				"07"=>"ก.ค.",
				"08"=>"ส.ค.",
				"09"=>"ก.ย.",
				"10"=>"ต.ค.",
				"11"=>"พ.ย.",
				"12"=>"ธ.ค."
		); 
		 return $q_m[$m];
	}
	public static function DateThai($strDate)
	{
	    $strYear = date("Y",strtotime($strDate))+543;
	    $strMonth= date("n",strtotime($strDate));
	    $strDay= date("j",strtotime($strDate));
// 	    $strHour= date("H",strtotime($strDate));
// 	    $strMinute= date("i",strtotime($strDate));
// 	    $strSeconds= date("s",strtotime($strDate));
	    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	    $strMonthThai=$strMonthCut[$strMonth];
	    return "$strDay $strMonthThai $strYear"; //, $strHour:$strMinute";
	}
	
	public static function convertModelToArray($models) {
		if (is_array ( $models ))
			$arrayMode = TRUE;
		else {
			$models = array (
					$models 
			);
			$arrayMode = FALSE;
		}
		
		$result = array ();
		foreach ( $models as $model ) {
			$attributes = $model->getAttributes ();
			$relations = array ();
			foreach ( $model->relations () as $key => $related ) {
				if ($model->hasRelated ( $key )) {
					$relations [$key] = convertModelToArray ( $model->$key );
				}
			}
			$all = array_merge ( $attributes, $relations );
			
			if ($arrayMode)
				array_push ( $result, $all );
			else
				$result = $all;
		}
		return $result;
	}
	public static function IsNullOrEmptyString($question) {
		return (! isset ( $question ) || trim ( $question ) === '');
	}
	public static function deleteDirectory($dirPath) {
		if (! is_dir ( $dirPath )) {
			throw new InvalidArgumentException ( "$dirPath must be a directory" );
		}
		if (substr ( $dirPath, strlen ( $dirPath ) - 1, 1 ) != '/') {
			$dirPath .= '/';
		}
		$files = glob ( $dirPath . '*', GLOB_MARK );
		foreach ( $files as $file ) {
			if (is_dir ( $file )) {
				self::deleteDirectory ( $file );
			} else {
				unlink ( $file );
			}
		}
		rmdir ( $dirPath );
	}
	function clean($string) {
		$string = str_replace ( ' ', '-', $string ); // Replaces all spaces with hyphens.
		
		return preg_replace ( '/[^A-Za-z0-9\-]/', '', $string ); // Removes special chars.
	}
	public static function endsWith($FullStr, $needle) {
		$StrLen = strlen ( $needle );
		$FullStrEnd = substr ( $FullStr, strlen ( $FullStr ) - $StrLen );
		return $FullStrEnd == $needle;
	}
	public static function dateDiff($date1, $date2) {
		// $datetime1 = new DateTime ( $date1 );
		// $datetime2 = new DateTime ( $date2 );
		// $interval = $datetime1->diff ( $datetime2 );
		// return $interval->format ( '%a' );
		$unixOriginalDate = strtotime ( $date1 );
		$unixNowDate = strtotime ( $date2 );
		$difference = $unixNowDate - $unixOriginalDate;
		$days = ( int ) ($difference / 86400);
		$hours = ( int ) ($difference / 3600);
		$minutes = ( int ) ($difference / 60);
		$seconds = $difference;
		return $days;
	} // end function dateDiff
	public static function getDateThai($date) {
		list ( $year, $month, $day ) = explode ( "-", $date );
		return $day . '/' . $month . '/' . ((( int ) $year) + 543);
	}
	public static function getDate($date) {
		list ( $day, $month, $year ) = explode ( "/", $date );
		
		return ((( int ) $year) - 543) . '-' . $month . '-' . $day;
	}
	public static function getCurDate()
	{
	    list ($day, $month, $year) = explode("/", date("d/m/Y"));
	    
	    return $day . '/' . $month . '/' . (((int) $year) + 543);
	}
	public function upload($file) {
		$currentdir = getcwd ();
		
		$upload_dir = $currentdir . "\\uploads\\" . date ( "Ymd" ) . "\\";
		$dest_dir = "/uploads/" . date ( "Ymd" ) . "/";
		if (! file_exists ( $upload_dir )) {
			mkdir ( $upload_dir, 0777, true );
		}
		
		$file_name = strtolower(self::random_string ( 10 ) . '.' . self::f_extension ( $file ['name'] ));
		$file_dir = $upload_dir . $file_name;
		
		$move = move_uploaded_file ( $file ["tmp_name"], $file_dir );
		return $dest_dir.$file_name;
	}
	public static function f_extension($fn) {
		$str = explode ( '/', $fn );
		$len = count ( $str );
		$str2 = explode ( '.', $str [($len - 1)] );
		$len2 = count ( $str2 );
		$ext = $str2 [($len2 - 1)];
		return $ext;
	}
	public static function random_string($length) {
		$key = '';
		$keys = array_merge ( range ( 0, 9 ), range ( 'a', 'z' ) );
		
		for($i = 0; $i < $length; $i ++) {
			$key .= $keys [array_rand ( $keys )];
		}
		
		return $key;
	}
	// public static function getLastRevision($ref_doc) {
	// $criteria = new CDbCriteria ();
	// $criteria->condition = "refer_doc ='" . $ref_doc . "'";
	// $criteria->order = 'id DESC';
	// $row = Form1::model ()->find ( $criteria );
	// $somevariable = $row->revision;
	// return $somevariable + 1;
	// }
	// public static function getLastRevision_Form2($ref_doc, $type) {
	// $criteria = new CDbCriteria ();
	// $criteria->condition = "ref_doc ='" . $ref_doc . "' AND type=" . $type;
	// $criteria->order = 'id DESC';
	// $row = Form2::model ()->find ( $criteria );
	// $somevariable = $row->revision;
	// return $somevariable + 1;
	// }
	// public static function getLastRevision_Form3($ref_doc) {
	// $criteria = new CDbCriteria ();
	// $criteria->condition = "ref_doc ='" . $ref_doc . "'";
	// $criteria->order = 'id DESC';
	// $row = Form3::model ()->find ( $criteria );
	// $somevariable = $row->revision;
	// return $somevariable + 1;
	// }
	// public static function getLastRevision_Form6($ref_doc) {
	// $criteria = new CDbCriteria ();
	// $criteria->condition = "ref_doc ='" . $ref_doc . "'";
	// $criteria->order = 'id DESC';
	// $row = Form6::model ()->find ( $criteria );
	// $somevariable = $row->revision;
	// return $somevariable + 1;
	// }
// 	public static function getValue($id) {
// 		$criteria = new CDbCriteria ();
// 		$criteria->condition = "id ='" . $id . "'";
// 		$criteria->order = 'id DESC';
// 		$row = MSetting::model ()->find ( $criteria );
// 		$somevariable = $row->value;
// 		return $somevariable;
// 	}

	public static function reArrayFiles($file_post) {
		$file_ary = array ();
		$file_count = count ( $file_post ['name'] );
		$file_keys = array_keys ( $file_post );
		
		for($i = 0; $i < $file_count; $i ++) {
			foreach ( $file_keys as $key ) {
				$file_ary [$i] [$key] = $file_post [$key] [$i];
			}
		}
		
		return $file_ary;
	}
	
	public static function makeRandomString($max=6) {
	    $i = 0; //Reset the counter.
	    $possible_keys = "0123456789";
	    $keys_length = strlen($possible_keys);
	    $str = ""; //Let's declare the string, to add later.
	    while($i<$max) {
	        $rand = mt_rand(1,$keys_length-1);
	        $str.= $possible_keys[$rand];
	        $i++;
	    }
	    return $str;
	}
	
	public static function to_utf16($text) {
	    $out="";
	    $text=mb_convert_encoding($text,'UTF-16','UTF-8');
	    for ($i=0;$i<mb_strlen($text,'UTF-16');$i++)
	        $out.= bin2hex(mb_substr($text,$i,1,'UTF-16'));
	        return strtoupper($out);
	}
	
	public static function getDepartment($selected){
	    
	   // $result = "";
	    
	    $deptParent = MDepartment::model()->findAll(array("condition"=>"faculty_id = -1",'order'=>'seq'));
	    $deptChild = MDepartment::model()->findAll(array("condition"=>"faculty_id <> -1",'order'=>'seq'));

	    foreach ($deptParent as $parent) {
	        $isGroup = false;
	        foreach ($deptChild as $child) {
	            if(intval($parent['id']) == intval($child['faculty_id'])){
	                $isGroup = true;
	            }
	        }
	        if($isGroup){
	            echo '<optgroup style="color:#008;font-style:normal;font-weight:normal;" label="'.$parent['name'].'">';
	            echo '</optgroup>';
	        }else{
	            echo '<option style="color:#'.(intval($parent['faculty_id']) == -1? '008':'000').';font-style:normal;font-weight:normal;" value="'.$parent['id'].'" '. ($selected == ''? '' : ($parent['id'] == $selected ? 'selected="selected"':'')) .'>'.htmlspecialchars($parent['name']).'</option>';
	        }
	        
	        foreach ($deptChild as $child) {
	            if(intval($parent['id']) == intval($child['faculty_id'])){
	                echo '<option style="color:#000;font-style:normal;font-weight:normal;" value="'.$child['id'].'" '.($selected==''? '' : ($child['id'] == $selected ? 'selected="selected"':'')) .'>&nbsp;&nbsp;&nbsp;-&nbsp;'.htmlspecialchars($child['name']).' สังกัด'.htmlspecialchars($parent['name']).'</option>';
	            }
	        }
	    }

	    //return $result;
	}
	
	public static function getAccidentAnalyze($selected){


		$exploded=explode(",",$selected); //Limit is unspecified, so it will return all the substrings;

	    $paramLists = MParameterList::model()->findAll(array('order'=>'id'));
	    
	    $index =1;
	    foreach ($paramLists as $paramList) {
	        //'.($index==1? 'checked="checked"':'').'
	        echo '<tr>';
	        echo '<td>'.(($paramList['param_group']==-1)? '' : '<input type="checkbox" '.((in_array($paramList['id'], $exploded)) ? 'checked="checked"':'').' id="accident_cause'.$index.'" name="accident_causes[]" value="'.$paramList['id'].'" />').'</td>';
	        echo '<td>'.$paramList['param_name'].'</td>';
	        echo '</tr>';
	        $index++;
	    }
	}
	
	public static function resizeImg($images,$new_images) {
		
// 	    $images = "mygirl.jpg";
// 	    $new_images = "MyResize/mygirl.jpg";

	    $width=200; //*** Fix Width & Heigh (Autu caculate) ***//
	    $size=GetimageSize($images);
	    $height=round($width*$size[1]/$size[0]);
	    $images_orig = ImageCreateFromJPEG($images);
	    $photoX = ImagesX($images_orig);
	    $photoY = ImagesY($images_orig);
	    $images_fin = ImageCreateTrueColor($width, $height);
	    ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
	    ImageJPEG($images_fin,$new_images);
	    ImageDestroy($images_orig);
	    ImageDestroy($images_fin);
	}
	
// 	public static function isContain($str, $check){
// 		$result = false;
		

		
		
// 		echo $str.'-'.$check.''.$exploded[0];
// 		if (strpos($str, $check) !== false) {
// 			$result= true;
// 		}
// 		return $result;
// 	}
	
	/* #MASTER# */
	const CHECKBOX_TYPE = "1";
	const TEXT_TYPE = "2";
	const TABLE_TYPE = "3";
	const FILE_TYPE = "4";
	/* QUERY */
	const SURVEY_BIO = "1";
	const SURVEY_CHEM = "2";
	const SURVEY_OCC = "3";
	const SURVEY_RADBASE = "4";
	
}
?>