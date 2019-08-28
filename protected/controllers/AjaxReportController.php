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
        
        $type1['name'] = iconv("tis-620","utf-8","���ª��Ե(���)");
        $type2['name'] = iconv("tis-620","utf-8","�٭����������/�ؾ���Ҿ");
        $type3['name'] = iconv("tis-620","utf-8","�Ҵ��/�纻���");
        $type4['name'] = iconv("tis-620","utf-8","��Ѿ���Թ�������");
        $type5['name'] = iconv("tis-620","utf-8","��� �");

        if ($result1 = mysqli_query($con, $sql)) {
            while ($r = mysqli_fetch_array($result1)) {
            	$type1['data'][] = $r['typ1'];//"�غѵ��˵���� �"
            	$type1['data'][] = 0;//"�غѵ��˵طҧ���"
            	$type1['data'][] = 0;//"�غѵ��˵طҧ����Ҿ"
            	$type1['data'][] = 0;//"�غѵ��˵طҧ�ѧ��"
            	$type1['data'][] = 0;//"�غѵ��˵طҧ俿��"
            	$type1['data'][] = 0;//"�Ѥ�����"
            	
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
    	
//     	$type1['name'] = iconv("tis-620","utf-8","���ª��Ե(���)");
//     	$type2['name'] = iconv("tis-620","utf-8","�٭����������/�ؾ���Ҿ");
//     	$type3['name'] = iconv("tis-620","utf-8","�Ҵ��/�纻���");
    	$type4['name'] = iconv("tis-620","utf-8","��Ѿ���Թ�������(�ҷ)");
//     	$type5['name'] = iconv("tis-620","utf-8","��� �");
    	
    	if ($result1 = mysqli_query($con, $sql)) {
    		while ($r = mysqli_fetch_array($result1)) {
//     			$type1['data'][] = $r['typ1'];//"�غѵ��˵���� �"
//     			$type1['data'][] = 0;//"�غѵ��˵طҧ���"
//     			$type1['data'][] = 0;//"�غѵ��˵طҧ����Ҿ"
//     			$type1['data'][] = 0;//"�غѵ��˵طҧ�ѧ��"
//     			$type1['data'][] = 0;//"�غѵ��˵طҧ俿��"
//     			$type1['data'][] = 0;//"�Ѥ�����"
    			
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
    	
    	$type1['name'] = iconv("tis-620","utf-8","���ª��Ե(���)");
    	$type2['name'] = iconv("tis-620","utf-8","�٭����������/�ؾ���Ҿ");
    	$type3['name'] = iconv("tis-620","utf-8","�Ҵ��/�纻���");
    	$type4['name'] = iconv("tis-620","utf-8","��Ѿ���Թ�������");
    	$type5['name'] = iconv("tis-620","utf-8","��� �");
    	
    	if ($result1 = mysqli_query($con, $sql)) {
    		while ($r = mysqli_fetch_array($result1)) {
    			$type1['data'][] = $r['typ1'];//"�غѵ��˵���� �"
    			$type1['data'][] = 0;//"�غѵ��˵طҧ���"
    			$type1['data'][] = 0;//"�غѵ��˵طҧ����Ҿ"
    			$type1['data'][] = 0;//"�غѵ��˵طҧ�ѧ��"
    			$type1['data'][] = 0;//"�غѵ��˵طҧ俿��"
    			$type1['data'][] = 0;//"�Ѥ�����"
    			
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
    	
    	$type1['name'] = iconv("tis-620","utf-8","���ª��Ե(���)");
    	$type2['name'] = iconv("tis-620","utf-8","�٭����������/�ؾ���Ҿ");
    	$type3['name'] = iconv("tis-620","utf-8","�Ҵ��/�纻���");
    	$type4['name'] = iconv("tis-620","utf-8","��Ѿ���Թ�������");
    	$type5['name'] = iconv("tis-620","utf-8","��� �");
    	
    	if ($result1 = mysqli_query($con, $sql)) {
    		while ($r = mysqli_fetch_array($result1)) {
    			$type1['data'][] = $r['typ1'];//"�غѵ��˵���� �"
    			$type1['data'][] = 0;//"�غѵ��˵طҧ���"
    			$type1['data'][] = 0;//"�غѵ��˵طҧ����Ҿ"
    			$type1['data'][] = 0;//"�غѵ��˵طҧ�ѧ��"
    			$type1['data'][] = 0;//"�غѵ��˵طҧ俿��"
    			$type1['data'][] = 0;//"�Ѥ�����"
    			
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

