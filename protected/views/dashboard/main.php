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
                    
                    <div class="row">
						<div class="col-lg-6 col-xs-12 col-sm-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title"><i class="fa fa-desktop" aria-hidden="true"></i> ป้ายสถิติความปลอดภัย <?php echo UserLoginUtils::getDepartmentInfoName();?>
                                    <div class="actions"></div>
                                </div>
                                <div class="portlet-body">
									<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- XXXXXX -->
			</div>
		</div>
		<input type="hidden" id="hHost" value="<?php echo ConfigUtil::getUrlHostName()?>"/>
</form>

<script
	src="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/jquery.min.js"
	type="text/javascript"></script>
	
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<script>
var chart;
var pointStart = Date.UTC(2014,0,1);

jQuery(document).ready(function () {
	
	var host = $('#hHost').val();

	$.ajax({
		     url: host+"index.php/AjaxReport/GetCRpt01",
		     type: "GET",
		     dataType: "json",
		     success: function (json) {
			     rpt01(json);
		   		
		     },
		     error: function (xhr, ajaxOptions, thrownError) {
				alert('ERROR');
		     }
		});


});


function rpt01 (data) {
	
	console.log(data);

	Highcharts.chart('container', {
        title: {
            text: 'Point interval unit is one month'
        },
    
        xAxis: {
            type: 'datetime'
        },
    
        plotOptions: {
            series: {
                pointStart: Date.UTC(2019, 0, 1),
                pointIntervalUnit: 'month'
            }
        },
    
        series: data
//             [{
//             data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
//         }, {
//             data: [144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4, 29.9, 71.5, 106.4, 129.2]
//         }]
	});
}



</script>

