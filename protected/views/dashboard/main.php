<?php
// - SAFETY RECORD - ////
if(UserLoginUtils::getUserRole() == 3){//only staff
    $we_have_operated1 ="0";
    $days_target1 ="365";
    $day1 ="0";
    $year1 ="0";
    $month1 ="1";
    $the_best_record1 = "0";
    
    $criteria1 = new CDbCriteria();
    $criteria1->condition = " department_id = ".UserLoginUtils::getDepartmentId()." and status=1";
    
    $safetyRecord1 = SafetyRecord::model()->find($criteria1);
    if(isset($safetyRecord1)){
        $we_have_operated1 = str_split(sprintf('%03d', CommonUtil::dateDiff( $safetyRecord1->last_accident_occurred_date,date("Y-m-d"))));
        $days_target1 = str_split(sprintf('%03d', $safetyRecord1->days_target));
    
        list ($_year1, $_month1, $_day1) = explode("-", $safetyRecord1->last_accident_occurred_date);
        $day1 = str_split($_day1);
        $year1 = str_split($_year1 + 543);
        $month1 = $_month1;
    }

    $duplicateData1 = Yii::app()->db->createCommand("SELECT max(amount) amt FROM tb_safety_record_history where department_id = ".UserLoginUtils::getDepartmentId()." and YEAR(create_date) = year(now()) group by department_id order by max(amount) desc limit 1")->queryAll();
    if(isset($duplicateData1)){
        $amt1 = 0;
        foreach($duplicateData1 as $offer) {
            $amt1 = $offer['amt'];
        }
        $the_best_record1 = str_split(sprintf('%03d', $amt1));
    }
}
// - ************* - //
// - SAFETY RECORD(mahidol) - ////
$we_have_operated ="0";
$days_target ="365";
$day ="0";
$year ="0";
$month= "1";
$the_best_record="0";

$criteria = new CDbCriteria();
$criteria->condition = " status=1";
$safetyRecord = SafetyRecord::model()->find($criteria);
if(isset($safetyRecord)){
    $we_have_operated = str_split(sprintf('%03d', CommonUtil::dateDiff( $safetyRecord->last_accident_occurred_date,date("Y-m-d"))));
    $days_target = str_split(sprintf('%03d', $safetyRecord->days_target));
    list ($_year, $_month, $_day) = explode("-", $safetyRecord->last_accident_occurred_date);
    $day = str_split($_day);
    $year = str_split($_year + 543);
    $month = $_month;
}

$duplicateData = Yii::app()->db->createCommand("SELECT max(amount) amt FROM tb_safety_record_history where YEAR(create_date) = year(now()) group by department_id order by max(amount) desc limit 1")->queryAll();
if(isset($duplicateData)){
    $amt = 0;
    foreach($duplicateData as $offer) {
        $amt = $offer['amt'];
    }
    $the_best_record = str_split(sprintf('%03d', $amt));

}
// - ************* - ////



// $sql = 'SELECT department_id,sum(dammage_type_1_value) as dt1,sum(dammage_type_2_value) as dt2,sum(dammage_type_3_value) as dt3,sum(dammage_type_4_value) as dt4,sum(dammage_type_5_value) as dt5
//  FROM tb_accident where department_id <>-1 and department_id=' . UserLoginUtils::getUserInfo()->department_id . ' group by department_id';
// $list = Yii::app()->db->createCommand($sql)->queryAll();

// $dts1 = array();
// $dts2 = array();
// $dts3 = array();
// $dts4 = array();
// $dts5 = array();

// foreach ($list as $item) {
//     array_push($dts1, array(
//         "y" => (int) $item['dt1'],
//         "label" => 'Department'
//     ));
//     array_push($dts2, array(
//         "y" => (int) $item['dt2'],
//         "label" => 'Department'
//     ));
//     array_push($dts3, array(
//         "y" => (int) $item['dt3'],
//         "label" => 'Department'
//     ));
//     array_push($dts4, array(
//         "y" => (int) $item['dt4'],
//         "label" => 'Department'
//     ));
//     array_push($dts5, array(
//         "y" => (int) $item['dt5'],
//         "label" => 'Department'
//     ));
// }
?>

<style>
.main-table {
	width: 450px;
	border: 2px solid green;
	background-color: white;
	padding: 2px;
}

.main-sub-table {
	width: 100px;
	border: 2px solid black;
	background-color: white;
	padding: 2px;
}

.main-sub-table-1 {
	width: 50px;
	border: 2px solid black;
	background-color: white;
	padding: 2px;
}

.main-sub-table-td {    
	border: 2px solid black;
}

#one td {
	width: 40px;
	height: 15px;
	border: 2px solid black;
	border-color: black;
}
</style>

<form id="Form1" method="post" enctype="multipart/form-data"
	class="form-horizontal">
	
	
		<div class="portlet-body form">
			<div class="form-body">
				<!-- BEGIN FORM-->
                    <div class="row">
                        <!-- RPT1 -->
                        <div class="col-lg-6 col-xs-12 col-sm-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title"><i class="fa fa-desktop" aria-hidden="true"></i> ป้ายสถิติความปลอดภัย มหาวิทยาลัยมหิดล
                                    <div class="actions"></div>
                                </div>
                                <div class="portlet-body">
                                

                                <table>
                                	<tr>
                                	<td>&nbsp;</td>
                                	<td>
                                <table style="border: 2px solid green;color: green;">
                                    <!-- HEADER -->
                                  	<tr><td colspan="7" style="padding: 3px;"></td></tr>
                                	<tr>
                                    	<td>&nbsp;</td>
                                    	<td><img src="<?php echo ConfigUtil::getAppName();?>/images/logo3.png" alt="logo"  height="45" align="left" /></td>
                                    	<td>&nbsp;</td>
                                    	<td style="text-align: center;width: 400px;">ป้ายสถิติความปลอดภัย มหาวิทยาลัยมหิดล<br>SAFETY FIRST</td>
                                    	<td>&nbsp;</td>
                                    	<td><img src="<?php echo ConfigUtil::getAppName();?>/images/logo4.png" alt="logo"  height="45" align="right" /></td>
                                    	<td>&nbsp;</td>
                                	</tr>
                                	<tr><td colspan="7" style="padding: 3px;"></td></tr>
                                	<tr><td colspan="7"><table  style="border: 2px solid green;width: 540px;"><tr><td></td></tr></table></td></tr>
                                	<!-- CONTENT -->
                                	<tr>
                                	<td colspan="7">
                                		<table style="width: 100%;">
                    						<tr>
                    							<td width="220px;"><br> <font color="blue">&nbsp;เกิดอุบัติเหตุครั้งสุดทายเมื่อ<br>
                    									&nbsp;LAST ACCIDENT OCCURRED
                    							</font></td>
                    							<td>
                    								<table class="main-sub-table">
                    									<tr id="one">
                    										<td align="center"><?php echo $day[0];?></td>
                    										<td align="center"><?php echo $day[1];?></td>
                    										<td align="center"><?php echo CommonUtil::getShortThaiMonth($month);?></td>
                    										<td align="center"><?php echo $year[2];?></td>
                    										<td align="center"><?php echo $year[3];?></td>
                    									</tr>
                    								</table>
                    							</td>
                    						</tr>
                                		</table>
                                		</td>
                                	</tr>
                                	<tr>
                                		<td colspan="7">
                                        	<table style="width: 100%;">
        										<tr>
                        							<td><font color="blue">&nbsp;เราเคยทำงานมาแล้ว<br>&nbsp;WE HAVE OPERATED
                        							</font></td>
                        							<td style="text-align: left;">
                        								<table class="main-sub-table-1">
                        									<tr id="one">
                        										<td align="center"><?php echo $we_have_operated[0];?></td>
                        										<td align="center"><?php echo $we_have_operated[1];?></td>
                        										<td align="center"><?php echo $we_have_operated[2];?></td>
                        									</tr>
                        								</table>
                        							</td>
                        							<td style="text-align: left;"><font color="blue">วัน<br> DAY
                        							</font></td>
                        							<td style="text-align: left;"><font color="blue">เป้าหมาย<br>
                        									TARGET
                        							</font></td>
                        							<td style="text-align: left;">
                        								<table class="main-sub-table-1">
                        									<tr id="one">
                        										<td align="center"><?php echo $days_target[0];?></td>
                        										<td align="center"><?php echo $days_target[1];?></td>
                        										<td align="center"><?php echo $days_target[2];?></td>
                        									</tr>
                        								</table>
                        							</td>
                        							<td style="text-align: left;"><font color="blue">วัน<br> DAY
                        							</font></td>
                        						</tr>
                                        	</table>
                                		</td>
                                	</tr>
                                	<tr>
                                		<td colspan="7">
                                        	<table style="width: 100%;">
                        						<tr>
                        							<td style="text-align: left;"><font color="green">&nbsp;เราเคยมีจำนวนวันสูงสุดที่ไม่มีอุบัติเหตุถึงขั้นหยุดงาน<br>&nbsp;THE
                        									BEST RECORD
                        							</font></td>
                        							<td style="text-align: left;">
                        								<table class="main-sub-table-1">
                        									<tr id="one">
                        										<td align="center"><?php echo $the_best_record[0];?></td>
                        										<td align="center"><?php echo $the_best_record[1];?></td>
                        										<td align="center"><?php echo $the_best_record[2];?></td>
                        									</tr>
                        								</table>
                        							</td>
                        							<td style="text-align: left;"><font color="green">วัน<br> DAY
                        							</font></td>
                        						</tr>
                                    		</table>
                                		</td>
                                	</tr>
                                </table>

                                	</td>
                                	</tr>
                                </table>



                                </div>
                            </div>
                        </div>
                        <!-- RPT2 -->
                        <?php if(UserLoginUtils::getUserRole() == 3){?>
                        <div class="col-lg-6 col-xs-12 col-sm-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title"><i class="fa fa-desktop" aria-hidden="true"></i> ป้ายสถิติความปลอดภัย <?php echo UserLoginUtils::getDepartmentInfoName();?>
                                    <div class="actions"></div>
                                </div>
                                <div class="portlet-body">
                                

                                <table>
                                	<tr>
                                	<td>&nbsp;</td>
                                	<td>
                                <table style="border: 2px solid green;color: green;">
                                    <!-- HEADER -->
                                  	<tr><td colspan="7" style="padding: 3px;"></td></tr>
                                	<tr>
                                    	<td>&nbsp;</td>
                                    	<td><img src="<?php echo ConfigUtil::getAppName();?>/images/logo3.png" alt="logo"  height="45" align="left" /></td>
                                    	<td>&nbsp;</td>
                                    	<td style="text-align: center;width: 400px;">ป้ายสถิติความปลอดภัย <?php echo UserLoginUtils::getDepartmentInfoName();?><br>SAFETY FIRST</td>
                                    	<td>&nbsp;</td>
                                    	<td><img src="<?php echo ConfigUtil::getAppName();?>/images/logo4.png" alt="logo"  height="45" align="right" /></td>
                                    	<td>&nbsp;</td>
                                	</tr>
                                	<tr><td colspan="7" style="padding: 3px;"></td></tr>
                                	<tr><td colspan="7"><table  style="border: 2px solid green;width: 540px;"><tr><td></td></tr></table></td></tr>
                                	<!-- CONTENT -->
                                	<tr>
                                	<td colspan="7">
                                		<table style="width: 100%;">
                    						<tr>
                    							<td width="220px;"><br> <font color="blue">&nbsp;เกิดอุบัติเหตุครั้งสุดทายเมื่อ<br>
                    									&nbsp;LAST ACCIDENT OCCURRED
                    							</font></td>
                    							<td>
                    								<table class="main-sub-table">
                    									<tr id="one">
                    										<td align="center"><?php echo $day1[0];?></td>
                    										<td align="center"><?php echo $day1[1];?></td>
                    										<td align="center"><?php echo CommonUtil::getShortThaiMonth($month1);?></td>
                    										<td align="center"><?php echo $year1[2];?></td>
                    										<td align="center"><?php echo $year1[3];?></td>
                    									</tr>
                    								</table>
                    							</td>
                    						</tr>
                                		</table>
                                		</td>
                                	</tr>
                                	<tr>
                                		<td colspan="7">
                                        	<table style="width: 100%;">
        										<tr>
                        							<td><font color="blue">&nbsp;เราเคยทำงานมาแล้ว<br>&nbsp;WE HAVE OPERATED
                        							</font></td>
                        							<td style="text-align: left;">
                        								<table class="main-sub-table-1">
                        									<tr id="one">
                        										<td align="center"><?php echo $we_have_operated1[0];?></td>
                        										<td align="center"><?php echo $we_have_operated1[1];?></td>
                        										<td align="center"><?php echo $we_have_operated1[2];?></td>
                        									</tr>
                        								</table>
                        							</td>
                        							<td style="text-align: left;"><font color="blue">วัน<br> DAY
                        							</font></td>
                        							<td style="text-align: left;"><font color="blue">เป้าหมาย<br>
                        									TARGET
                        							</font></td>
                        							<td style="text-align: left;">
                        								<table class="main-sub-table-1">
                        									<tr id="one">
                        										<td align="center"><?php echo $days_target1[0];?></td>
                        										<td align="center"><?php echo $days_target1[1];?></td>
                        										<td align="center"><?php echo $days_target1[2];?></td>
                        									</tr>
                        								</table>
                        							</td>
                        							<td style="text-align: left;"><font color="blue">วัน<br> DAY
                        							</font></td>
                        						</tr>
                                        	</table>
                                		</td>
                                	</tr>
                                	<tr>
                                		<td colspan="7">
                                        	<table style="width: 100%;">
                        						<tr>
                        							<td style="text-align: left;"><font color="green">&nbsp;เราเคยมีจำนวนวันสูงสุดที่ไม่มีอุบัติเหตุถึงขั้นหยุดงาน<br>&nbsp;THE
                        									BEST RECORD
                        							</font></td>
                        							<td style="text-align: left;">
                        								<table class="main-sub-table-1">
                        									<tr id="one">
                        										<td align="center"><?php echo $the_best_record1[0];?></td>
                        										<td align="center"><?php echo $the_best_record1[1];?></td>
                        										<td align="center"><?php echo $the_best_record1[2];?></td>
                        									</tr>
                        								</table>
                        							</td>
                        							<td style="text-align: left;"><font color="green">วัน<br> DAY
                        							</font></td>
                        						</tr>
                                    		</table>
                                		</td>
                                	</tr>
                                </table>

                                	</td>
                                	</tr>
                                </table>



                                </div>
                            </div>
                        </div>
                   	<?php }?>
                    </div>
                    

			</div>
		</div>
	
	
	<div class="portlet light">
		<div class="portlet-title">
			<div class="caption">
				<span class="caption-subject bold uppercase font-dark">
					 </span> <span class="caption-helper"></span>
			</div>
			<div class="actions">
				<a class="btn btn-circle btn-icon-only btn-default" href="#"> <i
					class="icon-cloud-upload"></i>
				</a>
			</div>
		</div>


		
		
		
		
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<span class="caption-subject bold uppercase font-dark">ACCIDENT
						REPORT</span> <span class="caption-helper">กราฟแสดงจำนวนความเสียหายจากการเกิดอุบัติเหตุภายในมหาวิทยาลัยมหิดลของคณะ/สถาบัน/หน่วยงานต่างๆ</span>
				</div>
				<div class="actions">
					<a class="btn btn-circle btn-icon-only btn-default" href="#"> <i
						class="icon-cloud-upload"></i>
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<div id="chartContainer1" style="height: 300px; width: 100%;"></div>

			</div>
		</div>
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<span class="caption-subject bold uppercase font-dark">ACCIDENT
						REPORT</span> <span class="caption-helper">กราฟแสดงจำนวนครั้งของการเกิดอุบัติเหตุ
						จำแนกตามประเภทการเกิดอุบัติเหตุของวิทยาเขตศาลายา</span>
				</div>
				<div class="actions">
					<a class="btn btn-circle btn-icon-only btn-default" href="#"> <i
						class="icon-cloud-upload"></i>
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<div id="chartContainer2" style="height: 300px; width: 100%;"></div>
			</div>
		</div>
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<span class="caption-subject bold uppercase font-dark">ACCIDENT
						REPORT</span> <span class="caption-helper">กราฟแสดงจำนวนครั้งของการเกิดอุบัติเหตุ
						จำแนกตามประเภทการเกิดอุบัติเหตุของวิทยาเขตศาลายา</span>
				</div>
				<div class="actions">
					<a class="btn btn-circle btn-icon-only btn-default" href="#"> <i
						class="icon-cloud-upload"></i>
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<div id="chartContainer3" style="height: 300px; width: 100%;"></div>
			</div>
		</div>
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<span class="caption-subject bold uppercase font-dark">ACCIDENT
						REPORT</span> <span class="caption-helper">กราฟแสดงมูลค่าความเสียหาย
						จำแนกตามประเภทการเกิดอุบัติเหตุของวิทยาเขตศาลายา</span>
				</div>
				<div class="actions">
					<a class="btn btn-circle btn-icon-only btn-default" href="#"> <i
						class="icon-cloud-upload"></i>
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<div id="chartContainer4" style="height: 300px; width: 100%;"></div>
			</div>
		</div>
	</div>

</form>

<script
	src="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/jquery.min.js"
	type="text/javascript"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script>
jQuery(document).ready(function () {
	
});
window.onload = function () {
	
	
	
	
	
var chart = new CanvasJS.Chart("chartContainer1", {
	title: {
		text: ""
	},
	axisY: {
		title: "Value"
	},
	exportEnabled: true,
	data: [{
		type: "column",
		showInLegend: true, 
		legendText: "เสียชีวิต",
		dataPoints: <?php echo json_encode($dts1, $JSON_NUMERIC_CHECK); ?>
	},{
		type: "column",
		showInLegend: true, 
		legendText: "สูญเสียอวัยวะ/ทุพพลภาพ",
		dataPoints: <?php echo json_encode($dts2, $JSON_NUMERIC_CHECK); ?>
	},{
		type: "column",
		showInLegend: true, 
		legendText: "บาดเจ็บ/เจ็บป่วย",
		dataPoints: <?php echo json_encode($dts3, $JSON_NUMERIC_CHECK); ?>
	},{
		type: "column",
		showInLegend: true, 
		legendText: "ทรัพย์สินเสียหาย",
		dataPoints: <?php echo json_encode($dts4, $JSON_NUMERIC_CHECK); ?>
	},{
		type: "column",
		showInLegend: true, 
		legendText: "มีการหยุดการปฏิบัติงาน ",
		dataPoints: <?php echo json_encode($dts5, $JSON_NUMERIC_CHECK); ?>
	}
	

	
	]
});
chart.render();
 //
var chart = new CanvasJS.Chart("chartContainer2", {
	title: {
		text: "Result DISC"
	},
	axisY: {
		title: "Value"
	},
	data: [{
		type: "line",
		showInLegend: true, 
		legendText: "Most",
		dataPoints: <?php echo json_encode($posM, $JSON_NUMERIC_CHECK); ?>
	},{
		type: "line",
		showInLegend: true, 
		legendText: "Least",
		dataPoints: <?php echo json_encode($posL, $JSON_NUMERIC_CHECK); ?>
	},{
		type: "line",
		showInLegend: true, 
		legendText: "Actual",
		dataPoints: <?php echo json_encode($posA, $JSON_NUMERIC_CHECK); ?>
	}
	

	
	]
});
chart.render();
//
var chart = new CanvasJS.Chart("chartContainer3", {
	title: {
		text: "Result DISC"
	},
	axisY: {
		title: "Value"
	},
	data: [{
		type: "line",
		showInLegend: true, 
		legendText: "Most",
		dataPoints: <?php echo json_encode($posM, $JSON_NUMERIC_CHECK); ?>
	},{
		type: "line",
		showInLegend: true, 
		legendText: "Least",
		dataPoints: <?php echo json_encode($posL, $JSON_NUMERIC_CHECK); ?>
	},{
		type: "line",
		showInLegend: true, 
		legendText: "Actual",
		dataPoints: <?php echo json_encode($posA, $JSON_NUMERIC_CHECK); ?>
	}
	

	
	]
});
chart.render();
//
var chart = new CanvasJS.Chart("chartContainer4", {
	title: {
		text: "Result DISC"
	},
	axisY: {
		title: "Value"
	},
	data: [{
		type: "line",
		showInLegend: true, 
		legendText: "Most",
		dataPoints: <?php echo json_encode($posM, $JSON_NUMERIC_CHECK); ?>
	},{
		type: "line",
		showInLegend: true, 
		legendText: "Least",
		dataPoints: <?php echo json_encode($posL, $JSON_NUMERIC_CHECK); ?>
	},{
		type: "line",
		showInLegend: true, 
		legendText: "Actual",
		dataPoints: <?php echo json_encode($posA, $JSON_NUMERIC_CHECK); ?>
	}
	

	
	]
});
chart.render();














}

</script>

