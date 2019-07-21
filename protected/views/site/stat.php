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
<div class="content" style="width: 510px !important">
	<form id="Form1" method="post">

		<br>
		<table class="main-table">
			<tr>
				<td style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;<img
					src="<?php echo ConfigUtil::getAppName();?>/images/logo3.png"
					alt="logo" class="logo-default" height="45" />
				</td>
				<td style="text-align: left;" colspan="3"><font color="green">&nbsp;&nbsp;&nbsp;&nbsp;สถิติความปลอดภัย<br>SAFETY
						FIRST<br></font></td>
				<td style="text-align: right;"> <img
					src="<?php echo ConfigUtil::getAppName();?>/images/logo4.png"
					alt="logo" class="logo-default" height="45" /><br></td>
				<td> </td>
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
				<td><br> <font color="blue">เกิดอุบัติเหตุครั้งสุดทายเมื่อ<br> LAST
						ACCIDENT OCCURRED
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
				<td style="text-align: left;"><font color="blue">เป้าหมาย<br> TARGET
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
<tr><td colspan="6"><br></td></tr>
		</table>
		<br>
		<div class="create-account">
			<p>
<?php echo CHtml::link('บุคคลทั่วไป',array('NormalPerson/'),array('class'=>'uppercase'));?> &nbsp;&nbsp;|&nbsp;&nbsp;
<?php echo CHtml::link('ผู้ดูแลประจำส่วนงาน',array('Site/Login'),array('class'=>'uppercase'));?>
			
<!-- 				<a href="javascript:;" id="register-btn" class="uppercase">ลงทะเบียนใช้งาน</a> -->
			</p>
		</div>
	</form>
</div>

