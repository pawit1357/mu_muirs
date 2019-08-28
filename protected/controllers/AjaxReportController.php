<?php
class AjaxReportController extends CController
{
    
    public $layout = 'ajax';
    
    private $_model;
    
    public function actionIndex()
    {}
    
    public function actionGetCRpt01()
    {
        
        // Create connection
        $con = mysqli_connect(ConfigUtil::getHostName(), ConfigUtil::getUsername(), ConfigUtil::getPassword(), ConfigUtil::getDbName());
        
        $sql = "
		   SELECT
		   COUNT(CASE WHEN dammage_type = 1  THEN dammage_type END) AS 'typ1',
		   COUNT(CASE WHEN dammage_type = 2  THEN dammage_type END) AS 'typ2',
		   COUNT(CASE WHEN dammage_type = 3  THEN dammage_type END) AS 'typ3',
		   COUNT(CASE WHEN dammage_type = 4  THEN dammage_type END) AS 'typ4',
		   COUNT(CASE WHEN dammage_type = 5  THEN dammage_type END) AS 'typ5'
		   FROM TB_ACCIDENT
			";
        
        $type1 = array();
        $type2 = array();
        $type3 = array();
        $type4 = array();
        $type5= array();
        
        $type1['name'] = iconv("tis-620","utf-8","เสียชีวิต(ราย)");
        $type2['name'] = iconv("tis-620","utf-8","สูญเสียอวัยวะ/ทุพพลภาพ");
        $type3['name'] = iconv("tis-620","utf-8","บาดเจ็บ/เจ็บป่วย");
        $type4['name'] = iconv("tis-620","utf-8","ทรัพย์สินเสียหาย");
        $type5['name'] = iconv("tis-620","utf-8","อื่น ๆ");

        if ($result1 = mysqli_query($con, $sql)) {
            while ($r = mysqli_fetch_array($result1)) {
            	$type1['data'][] = $r['typ1'];//"อุบัติเหตุอื่น ๆ"
            	$type1['data'][] = 0;//"อุบัติเหตุทางเคมี"
            	$type1['data'][] = 0;//"อุบัติเหตุทางชีวภาพ"
            	$type1['data'][] = 0;//"อุบัติเหตุทางรังสี"
            	$type1['data'][] = 0;//"อุบัติเหตุทางไฟฟ้า"
            	$type1['data'][] = 0;//"อัคคีภัย"
            	
            	$type2['data'][] = $r['typ2'];
            	$type2['data'][] = 0;
            	$type2['data'][] = 0;
            	$type2['data'][] = 0;
            	$type2['data'][] = 0;
            	$type2['data'][] = 0;
            	
            	$type3['data'][] = $r['typ3'];
            	$type3['data'][] = 0;
            	$type3['data'][] = 0;
            	$type3['data'][] = 0;
            	$type3['data'][] = 0;
            	$type3['data'][] = 0;
            	
            	$type4['data'][] = $r['typ4'];
            	$type4['data'][] = 0;
            	$type4['data'][] = 0;
            	$type4['data'][] = 0;
            	$type4['data'][] = 0;
            	$type4['data'][] = 0;
            	
            	$type5['data'][] = $r['typ5'];
            	$type5['data'][] = 0;
            	$type5['data'][] = 0;
            	$type5['data'][] = 0;
            	$type5['data'][] = 0;
            	$type5['data'][] = 0;
            }
        } else {
            print mysql_error();
        }
        
        $resultJson = array();
        array_push($resultJson, $type1);
        array_push($resultJson, $type2);
        array_push($resultJson, $type3);
        array_push($resultJson, $type4);
        array_push($resultJson, $type5);
        

        echo json_encode($resultJson, JSON_NUMERIC_CHECK  );
    }
    public function actionGetCRpt02()
    {
    	
    	// Create connection
    	$con = mysqli_connect(ConfigUtil::getHostName(), ConfigUtil::getUsername(), ConfigUtil::getPassword(), ConfigUtil::getDbName());
    	
    	$sql = "
		   SELECT
		   SUM(CASE WHEN dammage_type = 4  THEN dammage_type_4_value END) AS 'typ'
		   FROM TB_ACCIDENT where dammage_type=4
			";
    	
//     	$type1 = array();
//     	$type2 = array();
//     	$type3 = array();
    	$type4 = array();
//     	$type5= array();
    	
//     	$type1['name'] = iconv("tis-620","utf-8","เสียชีวิต(ราย)");
//     	$type2['name'] = iconv("tis-620","utf-8","สูญเสียอวัยวะ/ทุพพลภาพ");
//     	$type3['name'] = iconv("tis-620","utf-8","บาดเจ็บ/เจ็บป่วย");
    	$type4['name'] = iconv("tis-620","utf-8","ทรัพย์สินเสียหาย(บาท)");
//     	$type5['name'] = iconv("tis-620","utf-8","อื่น ๆ");
    	
    	if ($result1 = mysqli_query($con, $sql)) {
    		while ($r = mysqli_fetch_array($result1)) {
//     			$type1['data'][] = $r['typ1'];//"อุบัติเหตุอื่น ๆ"
//     			$type1['data'][] = 0;//"อุบัติเหตุทางเคมี"
//     			$type1['data'][] = 0;//"อุบัติเหตุทางชีวภาพ"
//     			$type1['data'][] = 0;//"อุบัติเหตุทางรังสี"
//     			$type1['data'][] = 0;//"อุบัติเหตุทางไฟฟ้า"
//     			$type1['data'][] = 0;//"อัคคีภัย"
    			
//     			$type2['data'][] = $r['typ2'];
//     			$type2['data'][] = 0;
//     			$type2['data'][] = 0;
//     			$type2['data'][] = 0;
//     			$type2['data'][] = 0;
//     			$type2['data'][] = 0;
    			
//     			$type3['data'][] = $r['typ3'];
//     			$type3['data'][] = 0;
//     			$type3['data'][] = 0;
//     			$type3['data'][] = 0;
//     			$type3['data'][] = 0;
//     			$type3['data'][] = 0;
    			
    			$type4['data'][] = $r['typ'];
    			$type4['data'][] = 0;
    			$type4['data'][] = 0;
    			$type4['data'][] = 0;
    			$type4['data'][] = 0;
    			$type4['data'][] = 0;
    			
//     			$type5['data'][] = $r['typ5'];
//     			$type5['data'][] = 0;
//     			$type5['data'][] = 0;
//     			$type5['data'][] = 0;
//     			$type5['data'][] = 0;
//     			$type5['data'][] = 0;
    		}
    	} else {
    		print mysql_error();
    	}
    	
    	$resultJson = array();
//     	array_push($resultJson, $type1);
//     	array_push($resultJson, $type2);
//     	array_push($resultJson, $type3);
    	array_push($resultJson, $type4);
//     	array_push($resultJson, $type5);
    	
    	
    	echo json_encode($resultJson, JSON_NUMERIC_CHECK  );
    }

    public function actionGetCRpt03()
    {
    	
    	// Create connection
    	$con = mysqli_connect(ConfigUtil::getHostName(), ConfigUtil::getUsername(), ConfigUtil::getPassword(), ConfigUtil::getDbName());
    	
    	$sql = "
		   SELECT
		   COUNT(CASE WHEN dammage_type = 1  THEN dammage_type END) AS 'typ1',
		   COUNT(CASE WHEN dammage_type = 2  THEN dammage_type END) AS 'typ2',
		   COUNT(CASE WHEN dammage_type = 3  THEN dammage_type END) AS 'typ3',
		   COUNT(CASE WHEN dammage_type = 4  THEN dammage_type END) AS 'typ4',
		   COUNT(CASE WHEN dammage_type = 5  THEN dammage_type END) AS 'typ5'
		   FROM TB_ACCIDENT
			";
    	
    	$type1 = array();
    	$type2 = array();
    	$type3 = array();
    	$type4 = array();
    	$type5= array();
    	
    	$type1['name'] = iconv("tis-620","utf-8","เสียชีวิต(ราย)");
    	$type2['name'] = iconv("tis-620","utf-8","สูญเสียอวัยวะ/ทุพพลภาพ");
    	$type3['name'] = iconv("tis-620","utf-8","บาดเจ็บ/เจ็บป่วย");
    	$type4['name'] = iconv("tis-620","utf-8","ทรัพย์สินเสียหาย");
    	$type5['name'] = iconv("tis-620","utf-8","อื่น ๆ");
    	
    	if ($result1 = mysqli_query($con, $sql)) {
    		while ($r = mysqli_fetch_array($result1)) {
    			$type1['data'][] = $r['typ1'];//"อุบัติเหตุอื่น ๆ"
    			$type1['data'][] = 0;//"อุบัติเหตุทางเคมี"
    			$type1['data'][] = 0;//"อุบัติเหตุทางชีวภาพ"
    			$type1['data'][] = 0;//"อุบัติเหตุทางรังสี"
    			$type1['data'][] = 0;//"อุบัติเหตุทางไฟฟ้า"
    			$type1['data'][] = 0;//"อัคคีภัย"
    			
    			$type2['data'][] = $r['typ2'];
    			$type2['data'][] = 0;
    			$type2['data'][] = 0;
    			$type2['data'][] = 0;
    			$type2['data'][] = 0;
    			$type2['data'][] = 0;
    			
    			$type3['data'][] = $r['typ3'];
    			$type3['data'][] = 0;
    			$type3['data'][] = 0;
    			$type3['data'][] = 0;
    			$type3['data'][] = 0;
    			$type3['data'][] = 0;
    			
    			$type4['data'][] = $r['typ4'];
    			$type4['data'][] = 0;
    			$type4['data'][] = 0;
    			$type4['data'][] = 0;
    			$type4['data'][] = 0;
    			$type4['data'][] = 0;
    			
    			$type5['data'][] = $r['typ5'];
    			$type5['data'][] = 0;
    			$type5['data'][] = 0;
    			$type5['data'][] = 0;
    			$type5['data'][] = 0;
    			$type5['data'][] = 0;
    		}
    	} else {
    		print mysql_error();
    	}
    	
    	$resultJson = array();
    	array_push($resultJson, $type1);
    	array_push($resultJson, $type2);
    	array_push($resultJson, $type3);
    	array_push($resultJson, $type4);
    	array_push($resultJson, $type5);
    	
    	
    	echo json_encode($resultJson, JSON_NUMERIC_CHECK  );
    }

    public function actionGetCRpt04()
    {
    	
    	// Create connection
    	$con = mysqli_connect(ConfigUtil::getHostName(), ConfigUtil::getUsername(), ConfigUtil::getPassword(), ConfigUtil::getDbName());
    	
    	$sql = "
		   SELECT
		   COUNT(CASE WHEN dammage_type = 1  THEN dammage_type END) AS 'typ1',
		   COUNT(CASE WHEN dammage_type = 2  THEN dammage_type END) AS 'typ2',
		   COUNT(CASE WHEN dammage_type = 3  THEN dammage_type END) AS 'typ3',
		   COUNT(CASE WHEN dammage_type = 4  THEN dammage_type END) AS 'typ4',
		   COUNT(CASE WHEN dammage_type = 5  THEN dammage_type END) AS 'typ5'
		   FROM TB_ACCIDENT
			";
    	
    	$type1 = array();
    	$type2 = array();
    	$type3 = array();
    	$type4 = array();
    	$type5= array();
    	
    	$type1['name'] = iconv("tis-620","utf-8","เสียชีวิต(ราย)");
    	$type2['name'] = iconv("tis-620","utf-8","สูญเสียอวัยวะ/ทุพพลภาพ");
    	$type3['name'] = iconv("tis-620","utf-8","บาดเจ็บ/เจ็บป่วย");
    	$type4['name'] = iconv("tis-620","utf-8","ทรัพย์สินเสียหาย");
    	$type5['name'] = iconv("tis-620","utf-8","อื่น ๆ");
    	
    	if ($result1 = mysqli_query($con, $sql)) {
    		while ($r = mysqli_fetch_array($result1)) {
    			$type1['data'][] = $r['typ1'];//"อุบัติเหตุอื่น ๆ"
    			$type1['data'][] = 0;//"อุบัติเหตุทางเคมี"
    			$type1['data'][] = 0;//"อุบัติเหตุทางชีวภาพ"
    			$type1['data'][] = 0;//"อุบัติเหตุทางรังสี"
    			$type1['data'][] = 0;//"อุบัติเหตุทางไฟฟ้า"
    			$type1['data'][] = 0;//"อัคคีภัย"
    			
    			$type2['data'][] = $r['typ2'];
    			$type2['data'][] = 0;
    			$type2['data'][] = 0;
    			$type2['data'][] = 0;
    			$type2['data'][] = 0;
    			$type2['data'][] = 0;
    			
    			$type3['data'][] = $r['typ3'];
    			$type3['data'][] = 0;
    			$type3['data'][] = 0;
    			$type3['data'][] = 0;
    			$type3['data'][] = 0;
    			$type3['data'][] = 0;
    			
    			$type4['data'][] = $r['typ4'];
    			$type4['data'][] = 0;
    			$type4['data'][] = 0;
    			$type4['data'][] = 0;
    			$type4['data'][] = 0;
    			$type4['data'][] = 0;
    			
    			$type5['data'][] = $r['typ5'];
    			$type5['data'][] = 0;
    			$type5['data'][] = 0;
    			$type5['data'][] = 0;
    			$type5['data'][] = 0;
    			$type5['data'][] = 0;
    		}
    	} else {
    		print mysql_error();
    	}
    	
    	$resultJson = array();
    	array_push($resultJson, $type1);
    	array_push($resultJson, $type2);
    	array_push($resultJson, $type3);
    	array_push($resultJson, $type4);
    	array_push($resultJson, $type5);
    	
    	
    	echo json_encode($resultJson, JSON_NUMERIC_CHECK  );
    }

}

