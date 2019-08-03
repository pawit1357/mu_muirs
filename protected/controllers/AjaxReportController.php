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
   accidental_damage_type,
   YEAR(case_date)	AS 'Year',
   COUNT(CASE WHEN MONTH(case_date) = 1  THEN case_date END) AS 'Jan',
   COUNT(CASE WHEN MONTH(case_date) = 2  THEN case_date END) AS 'Feb',
   COUNT(CASE WHEN MONTH(case_date) = 3  THEN case_date END) AS 'Mar',
   COUNT(CASE WHEN MONTH(case_date) = 4  THEN case_date END) AS 'Apr',
   COUNT(CASE WHEN MONTH(case_date) = 5  THEN case_date END) AS 'May',
   COUNT(CASE WHEN MONTH(case_date) = 6  THEN case_date END) AS 'Jun',
   COUNT(CASE WHEN MONTH(case_date) = 7  THEN case_date END) AS 'Jul',
   COUNT(CASE WHEN MONTH(case_date) = 8  THEN case_date END) AS 'Aug',
   COUNT(CASE WHEN MONTH(case_date) = 9  THEN case_date END) AS 'Sep',
   COUNT(CASE WHEN MONTH(case_date) = 10 THEN case_date END) AS 'Oct',
   COUNT(CASE WHEN MONTH(case_date) = 11 THEN case_date END) AS 'Nov',
   COUNT(CASE WHEN MONTH(case_date) = 12 THEN case_date END) AS 'Dec',
   COUNT(case_date)                                            AS 'TOTAL'
 FROM tb_accident_investigation where accidental_damage_type = 1
 GROUP BY  Year
UNION
SELECT 
   accidental_damage_type, 
   YEAR(case_date)	AS 'Year',
   COUNT(CASE WHEN MONTH(case_date) = 1  THEN case_date END) AS 'Jan',
   COUNT(CASE WHEN MONTH(case_date) = 2  THEN case_date END) AS 'Feb',
   COUNT(CASE WHEN MONTH(case_date) = 3  THEN case_date END) AS 'Mar',
   COUNT(CASE WHEN MONTH(case_date) = 4  THEN case_date END) AS 'Apr',
   COUNT(CASE WHEN MONTH(case_date) = 5  THEN case_date END) AS 'May',
   COUNT(CASE WHEN MONTH(case_date) = 6  THEN case_date END) AS 'Jun',
   COUNT(CASE WHEN MONTH(case_date) = 7  THEN case_date END) AS 'Jul',
   COUNT(CASE WHEN MONTH(case_date) = 8  THEN case_date END) AS 'Aug',
   COUNT(CASE WHEN MONTH(case_date) = 9  THEN case_date END) AS 'Sep',
   COUNT(CASE WHEN MONTH(case_date) = 10 THEN case_date END) AS 'Oct',
   COUNT(CASE WHEN MONTH(case_date) = 11 THEN case_date END) AS 'Nov',
   COUNT(CASE WHEN MONTH(case_date) = 12 THEN case_date END) AS 'Dec',
   COUNT(case_date)                                            AS 'TOTAL'
 FROM tb_accident_investigation where accidental_damage_type = 2
 GROUP BY  Year
UNION
SELECT 
   accidental_damage_type,
   YEAR(case_date)	AS 'Year',
   COUNT(CASE WHEN MONTH(case_date) = 1  THEN case_date END) AS 'Jan',
   COUNT(CASE WHEN MONTH(case_date) = 2  THEN case_date END) AS 'Feb',
   COUNT(CASE WHEN MONTH(case_date) = 3  THEN case_date END) AS 'Mar',
   COUNT(CASE WHEN MONTH(case_date) = 4  THEN case_date END) AS 'Apr',
   COUNT(CASE WHEN MONTH(case_date) = 5  THEN case_date END) AS 'May',
   COUNT(CASE WHEN MONTH(case_date) = 6  THEN case_date END) AS 'Jun',
   COUNT(CASE WHEN MONTH(case_date) = 7  THEN case_date END) AS 'Jul',
   COUNT(CASE WHEN MONTH(case_date) = 8  THEN case_date END) AS 'Aug',
   COUNT(CASE WHEN MONTH(case_date) = 9  THEN case_date END) AS 'Sep',
   COUNT(CASE WHEN MONTH(case_date) = 10 THEN case_date END) AS 'Oct',
   COUNT(CASE WHEN MONTH(case_date) = 11 THEN case_date END) AS 'Nov',
   COUNT(CASE WHEN MONTH(case_date) = 12 THEN case_date END) AS 'Dec',
   COUNT(case_date)                                            AS 'TOTAL'
 FROM tb_accident_investigation where accidental_damage_type = 3
 GROUP BY  Year
UNION
SELECT 
   accidental_damage_type,
   YEAR(case_date)	AS 'Year',
   COUNT(CASE WHEN MONTH(case_date) = 1  THEN case_date END) AS 'Jan',
   COUNT(CASE WHEN MONTH(case_date) = 2  THEN case_date END) AS 'Feb',
   COUNT(CASE WHEN MONTH(case_date) = 3  THEN case_date END) AS 'Mar',
   COUNT(CASE WHEN MONTH(case_date) = 4  THEN case_date END) AS 'Apr',
   COUNT(CASE WHEN MONTH(case_date) = 5  THEN case_date END) AS 'May',
   COUNT(CASE WHEN MONTH(case_date) = 6  THEN case_date END) AS 'Jun',
   COUNT(CASE WHEN MONTH(case_date) = 7  THEN case_date END) AS 'Jul',
   COUNT(CASE WHEN MONTH(case_date) = 8  THEN case_date END) AS 'Aug',
   COUNT(CASE WHEN MONTH(case_date) = 9  THEN case_date END) AS 'Sep',
   COUNT(CASE WHEN MONTH(case_date) = 10 THEN case_date END) AS 'Oct',
   COUNT(CASE WHEN MONTH(case_date) = 11 THEN case_date END) AS 'Nov',
   COUNT(CASE WHEN MONTH(case_date) = 12 THEN case_date END) AS 'Dec',
   COUNT(case_date)                                            AS 'TOTAL'
 FROM tb_accident_investigation where accidental_damage_type = 4
 GROUP BY  Year
UNION
SELECT 
   accidental_damage_type,
   YEAR(case_date)	AS 'Year',
   COUNT(CASE WHEN MONTH(case_date) = 1  THEN case_date END) AS 'Jan',
   COUNT(CASE WHEN MONTH(case_date) = 2  THEN case_date END) AS 'Feb',
   COUNT(CASE WHEN MONTH(case_date) = 3  THEN case_date END) AS 'Mar',
   COUNT(CASE WHEN MONTH(case_date) = 4  THEN case_date END) AS 'Apr',
   COUNT(CASE WHEN MONTH(case_date) = 5  THEN case_date END) AS 'May',
   COUNT(CASE WHEN MONTH(case_date) = 6  THEN case_date END) AS 'Jun',
   COUNT(CASE WHEN MONTH(case_date) = 7  THEN case_date END) AS 'Jul',
   COUNT(CASE WHEN MONTH(case_date) = 8  THEN case_date END) AS 'Aug',
   COUNT(CASE WHEN MONTH(case_date) = 9  THEN case_date END) AS 'Sep',
   COUNT(CASE WHEN MONTH(case_date) = 10 THEN case_date END) AS 'Oct',
   COUNT(CASE WHEN MONTH(case_date) = 11 THEN case_date END) AS 'Nov',
   COUNT(CASE WHEN MONTH(case_date) = 12 THEN case_date END) AS 'Dec',
   COUNT(case_date)                                            AS 'TOTAL'
 FROM tb_accident_investigation where accidental_damage_type = 5
 GROUP BY  Year
";
        
        
        $type1 = array();
        $type2 = array();
        $type3 = array();
        $type4 = array();
        $type5 = array();
        
        $type1['name'] = iconv("tis-620","utf-8","เสียชีวิต");
        $type2['name'] = iconv("tis-620","utf-8","สูญเสียอวัยวะ/ทุพพลภาพ");
        $type3['name'] = iconv("tis-620","utf-8","บาดเจ็บ/เจ็บป่วย");
        $type4['name'] = iconv("tis-620","utf-8","ทรัพย์สินเสียหาย");
        $type5['name'] = iconv("tis-620","utf-8","อื่น ๆ");

        if ($result1 = mysqli_query($con, $sql)) {
            while ($r = mysqli_fetch_array($result1)) {
                if($r['accidental_damage_type'] == 1){
                    $type1['data'][] = $r['Jan'];
                    $type1['data'][] = $r['Feb'];
                    $type1['data'][] = $r['Mar'];
                    $type1['data'][] = $r['Apr'];
                    $type1['data'][] = $r['May'];
                    $type1['data'][] = $r['Jun'];
                    $type1['data'][] = $r['Jul'];
                    $type1['data'][] = $r['Aug'];
                    $type1['data'][] = $r['Sep'];
                    $type1['data'][] = $r['Oct'];
                    $type1['data'][] = $r['Nov'];
                    $type1['data'][] = $r['Dec'];
                }
                if($r['accidental_damage_type'] == 2){
                    $type2['data'][] = $r['Jan'];
                    $type2['data'][] = $r['Feb'];
                    $type2['data'][] = $r['Mar'];
                    $type2['data'][] = $r['Apr'];
                    $type2['data'][] = $r['May'];
                    $type2['data'][] = $r['Jun'];
                    $type2['data'][] = $r['Jul'];
                    $type2['data'][] = $r['Aug'];
                    $type2['data'][] = $r['Sep'];
                    $type2['data'][] = $r['Oct'];
                    $type2['data'][] = $r['Nov'];
                    $type2['data'][] = $r['Dec'];
                }
                if($r['accidental_damage_type'] == 3){
                    $type3['data'][] = $r['Jan'];
                    $type3['data'][] = $r['Feb'];
                    $type3['data'][] = $r['Mar'];
                    $type3['data'][] = $r['Apr'];
                    $type3['data'][] = $r['May'];
                    $type3['data'][] = $r['Jun'];
                    $type3['data'][] = $r['Jul'];
                    $type3['data'][] = $r['Aug'];
                    $type3['data'][] = $r['Sep'];
                    $type3['data'][] = $r['Oct'];
                    $type3['data'][] = $r['Nov'];
                    $type3['data'][] = $r['Dec'];
                }
                if($r['accidental_damage_type'] == 4){
                    $type4['data'][] = $r['Jan'];
                    $type4['data'][] = $r['Feb'];
                    $type4['data'][] = $r['Mar'];
                    $type4['data'][] = $r['Apr'];
                    $type4['data'][] = $r['May'];
                    $type4['data'][] = $r['Jun'];
                    $type4['data'][] = $r['Jul'];
                    $type4['data'][] = $r['Aug'];
                    $type4['data'][] = $r['Sep'];
                    $type4['data'][] = $r['Oct'];
                    $type4['data'][] = $r['Nov'];
                    $type4['data'][] = $r['Dec'];
                }
                if($r['accidental_damage_type'] == 5){
                    $type5['data'][] = $r['Jan'];
                    $type5['data'][] = $r['Feb'];
                    $type5['data'][] = $r['Mar'];
                    $type5['data'][] = $r['Apr'];
                    $type5['data'][] = $r['May'];
                    $type5['data'][] = $r['Jun'];
                    $type5['data'][] = $r['Jul'];
                    $type5['data'][] = $r['Aug'];
                    $type5['data'][] = $r['Sep'];
                    $type5['data'][] = $r['Oct'];
                    $type5['data'][] = $r['Nov'];
                    $type5['data'][] = $r['Dec'];
                }
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

