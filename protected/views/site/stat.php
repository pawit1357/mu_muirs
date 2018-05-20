<?php
$criteria = new CDbCriteria ();
$criteria->select = 'max(accident_date) AS accident_date';
$row = SafetyRecordHistory::model ()->find ( $criteria );

$criteria2 = new CDbCriteria ();
$criteria2->select = 'max(accident_count) AS accident_count';
$row2 = SafetyRecordHistory::model ()->find ( $criteria2 );

$we_have_operated = str_split ( sprintf ( '%03d', 0 ) );
$target = str_split ( sprintf ( '%03d', 365 ) ); // $srConfig[0]->target));
$day = str_split(0);
$year = str_split(0);
if (isset ( $row ['accident_date'] )) {
	$we_have_operated = str_split ( sprintf ( '%03d', CommonUtil::dateDiff ( $row ['accident_date'], date ( "Y-m-d H:i:s" ) ) ) );
	list ( $_year, $_month, $_day ) = explode ( "-", $row ['accident_date'] );
	$day = str_split ( $_day );
	$year = str_split ( $_year + 543 );
}
if (isset ( $row2 ['accident_count'] )) {
	$the_best_record = str_split ( sprintf ( '%03d', $row2 ['accident_count'] ) );
}

list ( $_year1, $_month1, $_day1 ) = explode ( "-", date ( "Y-m-d H:i:s" ) . '' );
$day1 = str_split ( $_day1 );
$year1 = str_split ( $_year1 + 543 );
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
							<td align="center"><?php echo $target[0];?></td>
							<td align="center"><?php echo $target[1];?></td>
							<td align="center"><?php echo $target[2];?></td>
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
			<tr>
				<td style="text-align: right;"><font color="green">ปรับปรุง ณ
						วันที่&nbsp;&nbsp;&nbsp;<br>TO DATE<br>&nbsp;&nbsp;&nbsp;
				</font></td>

				<td colspan="2">

					<table class="main-sub-table">
						<tr id="one">
							<td align="center"><?php echo $day1[0];?></td>
							<td align="center"><?php echo $day1[1];?></td>
							<td align="center"><?php echo CommonUtil::getShortThaiMonth($_month1);?></td>
							<td align="center"><?php echo $year1[2];?></td>
							<td align="center"><?php echo $year1[3];?></td>
						</tr>
					</table>
				</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
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

