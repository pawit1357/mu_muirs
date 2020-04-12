<?php

    $model = new Accident();
    if (isset($_POST['Accident'])) {
        $model->attributes = $_POST['Accident'];

    }
    
// - SAFETY RECORD - ////
$criteria = new CDbCriteria();
$criteria->condition = "status=1 ".(($model->department_id == -1 || empty($model->department_id))? "" : " and department_id = ".$model->department_id);

// echo "SQL: status=1 ".(($model->department_id == -1 || empty($model->department_id))? "" : " and department_id = ".$model->department_id);


$safetyRecord = SafetyRecord::model()->find($criteria);

$we_have_operated ="0";
$days_target ="365";
if(isset($safetyRecord)){
    $we_have_operated = str_split(sprintf('%03d', CommonUtil::dateDiff( $safetyRecord->last_accident_occurred_date,date("Y-m-d"))));
    $days_target = str_split(sprintf('%03d', $safetyRecord->days_target));
}

$amt = 0;
$day ="0";
$year ="0";

$duplicateData = Yii::app()->db->createCommand("SELECT max(amount) amt FROM tb_safety_record_history 
where YEAR(create_date) = year(now()) ".(($model->department_id == -1 || empty($model->department_id))? "" : " and department_id = ".$model->department_id)."
group by department_id order by max(amount) desc limit 1")->queryAll();
if(isset($duplicateData)){
    foreach($duplicateData as $offer) {
        $amt = $offer['amt'];
    }
    $the_best_record = str_split(sprintf('%03d', $amt));
    list ($_year, $_month, $_day) = explode("-", $safetyRecord->last_accident_occurred_date);
    $day = str_split($_day);
    $year = str_split($_year + 543);
}
// - ************* - ////
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

<select class="form-control" name="Accident[department_id]" id="department_id" onchange="onchangeDepartment(this)">
<option value="-1">-- มหาวิทยาลัยมหิดล --</option>
<?php
echo CommonUtil::getDepartment($model->department_id);
?>

</select>
		<br>
                           <table style="border: 2px solid green;color: green;">
                                    <!-- HEADER -->
                                  	<tr><td colspan="7" style="padding: 3px;"></td></tr>
                                	<tr>
                                    	<td>&nbsp;</td>
                                    	<td><img src="<?php echo ConfigUtil::getAppName();?>/images/logo3.png" alt="logo"  height="45" align="left" /></td>
                                    	<td>&nbsp;</td>
                                    	<td style="text-align: center;width: 300px;">ป้ายสถิติความปลอดภัย มหาวิทยาลัยมหิดล<br>SAFETY FIRST MU</td>
                                    	<td>&nbsp;</td>
                                    	<td><img src="<?php echo ConfigUtil::getAppName();?>/images/logo4.png" alt="logo"  height="45" align="right" /></td>
                                    	<td>&nbsp;</td>
                                	</tr>
                                	<tr><td colspan="7" style="padding: 3px;"></td></tr>
                                	<tr><td colspan="7"><table  style="border: 2px solid green;width: 450px;"><tr><td></td></tr></table></td></tr>
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
                    										<td align="center" style="width:100px;"><?php echo CommonUtil::getShortThaiMonth($_month);?></td>
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
		<br>
		<div class="create-account">
			<p>
<?php echo CHtml::link('บุคคลทั่วไป',array('NormalPerson/'),array('class'=>'uppercase'));?> &nbsp;&nbsp;|&nbsp;&nbsp;
<?php echo CHtml::link('ผู้ดูแลประจำส่วนงาน',array('Site/Login'),array('class'=>'uppercase'));?>
			
<!-- 				<a href="javascript:;" id="register-btn" class="uppercase">ลงทะเบียนใช้งาน</a> -->
			</p>
		</div>
		
	<script src="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
	<script>
    function onchangeDepartment(sel){
    	document.getElementById("Form1").submit();
    }
	</script>
	</form>
</div>


	
	
	
	
	
	
	
	