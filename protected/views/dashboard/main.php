<?php
// // - SAFETY RECORD - ////
$criteria = new CDbCriteria();
$criteria->condition = " department_id = -1 and status=1";
$safetyRecord = SafetyRecordHistory::model()->find($criteria);

$we_have_operated = str_split(sprintf('%03d', CommonUtil::dateDiff( $safetyRecord->create_date,date("Y-m-d"))));
$days_target = str_split(sprintf('%03d', $safetyRecord->days_target));
$the_best_record = str_split(sprintf('%03d', $safetyRecord->the_best_record));

list ($_year, $_month, $_day) = explode("-", $safetyRecord->last_accident_occurred_date);
$day = str_split($_day);
$year = str_split($_year + 543);
// // - ************* - ////
$sql = 'SELECT department_id,sum(dammage_type_1_value) as dt1,sum(dammage_type_2_value) as dt2,sum(dammage_type_3_value) as dt3,sum(dammage_type_4_value) as dt4,sum(dammage_type_5_value) as dt5
 FROM tb_accident where department_id <>-1 and department_id=' . UserLoginUtils::getUserInfo()->department_id . ' group by department_id';
$list = Yii::app()->db->createCommand($sql)->queryAll();

$dts1 = array();
$dts2 = array();
$dts3 = array();
$dts4 = array();
$dts5 = array();

foreach ($list as $item) {
    array_push($dts1, array(
        "y" => (int) $item['dt1'],
        "label" => 'Department'
    ));
    array_push($dts2, array(
        "y" => (int) $item['dt2'],
        "label" => 'Department'
    ));
    array_push($dts3, array(
        "y" => (int) $item['dt3'],
        "label" => 'Department'
    ));
    array_push($dts4, array(
        "y" => (int) $item['dt4'],
        "label" => 'Department'
    ));
    array_push($dts5, array(
        "y" => (int) $item['dt5'],
        "label" => 'Department'
    ));
}
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
	<div class="portlet light">
		<div class="portlet-title">
			<div class="caption">
				<span class="caption-subject bold uppercase font-dark">
					สถิติความปลอดภัย </span> <span class="caption-helper"></span>
			</div>
			<div class="actions">
				<a class="btn btn-circle btn-icon-only btn-default" href="#"> <i
					class="icon-cloud-upload"></i>
				</a>
			</div>
		</div>

		<div class="portlet-body form">
			<div class="form-body">
				<!-- BEGIN FORM-->

				<div align="center">

					<table class="main-table">
						<tr>
							<td style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp; <img
								src="<?php echo ConfigUtil::getAppName();?>/images/logo3.png"
								alt="logo" class="logo-default" height="45" />
							</td>
							<td style="text-align: left;" colspan="3"><font color="green">&nbsp;&nbsp;&nbsp;&nbsp;สถิติความปลอดภัย<br>SAFETY
									FIRST<br></font></td>
							<td style="text-align: right;"><img
								src="<?php echo ConfigUtil::getAppName();?>/images/logo4.png"
								alt="logo" class="logo-default" height="45" /><br></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="6"><table class="main-table">
									<tr>
										<td></td>
									</tr>
								</table></td>

						</tr>
						<!-- xxxxxxx -->
						<tr>
							<td><br> <font color="blue">เกิดอุบัติเหตุครั้งสุดทายเมื่อ<br>
									LAST ACCIDENT OCCURRED
							</font></td>
							<td colspan="2">

								<table class="main-sub-table">
									<tr id="one">
										<td align="center"><?php echo $day[0];?></td>
										<td align="center"><?php echo $day[1];?></td>
										<td align="center"><?php echo CommonUtil::getShortThaiMonth($_month);?></td>
										<td align="center"><?php echo $year[2];?></td>
										<td align="center"><?php echo $year[3];?></td>
									</tr>
								</table>
							</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>

						<!-- xxxxxxxxx -->
						<tr>
							<td><font color="blue">เราเคยทำงานมาแล้ว<br> WE HAVE OPERATED
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
						<!-- xxxxxx -->
						<tr>
							<td style="text-align: left;" colspan="4"><font color="green">เราเคยมีจำนวนวันสูงสุดที่ไม่มีอุบัติเหตุถึงขั้นหยุดงาน<br>THE
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
						<!-- xxxxx -->
						<!-- 
						<tr>
							<td style="text-align: right;"><font color="green">ปรับปรุง ณ
									วันที่&nbsp;&nbsp;&nbsp;<br>TO DATE<br>&nbsp;&nbsp;&nbsp;
							</font></td>

							<td colspan="2">

								<table class="main-sub-table">
									<tr id="one">
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
									</tr>
								</table>
							</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						 -->
					</table>

				</div>
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

