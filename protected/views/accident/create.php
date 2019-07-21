<?php


$deptParent = MDepartment::model()->findAll(array("condition"=>"faculty_id = -1",'order'=>'seq'));
$deptChild = MDepartment::model()->findAll(array("condition"=>"faculty_id <> -1",'order'=>'seq'));

?>
<form id="Form1" method="post" enctype="multipart/form-data"
	class="form-horizontal">


	<div class="portlet light">
		<div class="portlet-title">
			<div class="caption">
				<?php echo  MenuUtil::getMenuName($_SERVER['REQUEST_URI'])?>
			</div>
			<div class="actions">
			<?php echo (UserLoginUtils::getUserRole()!=6)? '' : CHtml::link('ย้อนกลับ',array('NormalPerson/'),array('class'=>'btn btn-default btn-sm'));?>
			</div>
		</div>
		<div class="portlet-body form">
			<div class="form-body">
				<!-- BEGIN FORM-->

				<div class="note note-info">
					<p>
						<b>อุบัติเหตุ (Accident)</b> หมายถึง เหตุการณ์ที่ไม่พึงประสงค์
						เมื่อเกิดขึ้นมีผลทำให้เกิดการบาดเจ็บ พิการ เสียชีวิต
						รวมถึงการสูญเสียทรัพย์สิน
					</p>
				</div>
				<div class="panel-group accordion" id="accordion1">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse"
									data-parent="#accordion1" href="#collapse_1"> <i
									class="fa fa-user"></i> Section 1 : ผู้รายงาน
								</a>
							</h4>
						</div>
						<div id="collapse_1" class="panel-collapse in">
							<br>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">ชื่อ-นามสุกล :<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input id="name" type="text" value="" class="form-control"
												name="Accident[name]">

										</div>
										<div id="divReq-name"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">ตำแหน่ง/ชั้นปี :<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="position_or_level"
												class="form-control" name="Accident[position_or_level]" />

										</div>
										<div id="divReq-position_or_level"></div>
									</div>
								</div>
							</div>
							
	
            
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">คณะ/ส่วนงาน :<span
											class="required">*</span></label>
										<div class="col-sm-4">
										
										                
										

<select class="form-control" name="Accident[department_id]" id="department_id" onchange="onchangeDepartment(this)">
<option value="-1">-- (ไม่มีสังกัด) --</option>
<?php
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
        echo '<option style="color:#'.(intval($parent['faculty_id']) == -1? '008':'000').';font-style:normal;font-weight:normal;" value="'.$parent['id'].'">'.htmlspecialchars($parent['name']).'</option>';
    }
    
    foreach ($deptChild as $child) {
        if(intval($parent['id']) == intval($child['faculty_id'])){
            echo '<option style="color:#000;font-style:normal;font-weight:normal;" value="'.$child['id'].'">&nbsp;&nbsp;&nbsp;-&nbsp;'.htmlspecialchars($child['name']).'</option>';
        }
    }
}
    
?>
</select>



										</div>
										<div id="divReq-faculty_id"></div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">เบอร์โทรศัพท์ :<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="phone_number"
												class="form-control" name="Accident[phone_number]" />
										</div>
										<div id="divReq-phone_number"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">อีเมล์ :<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="email" class="form-control"
												name="Accident[email]" />
										</div>
										<div id="divReq-email"></div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">วันที่เขียนรายงาน :<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
 
											<div class="input-group date date-picker"
												data-date-format="dd-mm-yyyy">
												<input type="text"
													value="<?php echo CommonUtil::getCurDate();?>"
													id="report_date" class="form-control"
													name="Accident[report_date]" /> <span
													class="input-group-btn">
													<button class="btn default" type="button">
														<i class="fa fa-calendar"></i>
													</button>
												</span>
											</div>
										</div>


										<div id="divReq-report_date"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">ผู้พบเห็นเหตุการณ์คนแรก
											ชื่อ-สกุล :<span class="required"></span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="name2" class="form-control"
												name="Accident[name2]" />
										</div>
										<div id="divReq-name2"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">สังกัด :<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="belong_to"
												class="form-control" name="Accident[belong_to]" />
										</div>
										<div id="divReq-belong_to"></div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse"
									data-parent="#accordion2" href="#collapse_2"><i
									class="fa fa-user"></i> Section 2: รายละเอียดการเกิดอุบัติเหตุ
								</a>
							</h4>
						</div>
						<div id="collapse_2" class="panel-collapse in">
							<br>

							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">วัน/เดือน/ปี ที่เกิดเหตุ 
											:<span class="required">*</span>
										</label>
										<div class="col-md-2">
											<div class="input-group date date-picker"
												data-date-format="dd-mm-yyyy">
												<input type="text"
													value="<?php echo CommonUtil::getCurDate();?>"
													id="case_date" class="form-control"
													name="Accident[case_date]" /> <span class="input-group-btn">
													<button class="btn default" type="button">
														<i class="fa fa-calendar"></i>
													</button>
												</span>
												
											</div>
										</div>
										
										<div class="col-md-2">
										
										<select  class="form-control select2" name="Accident[case_date_time]" id="case_date_time">
  <option value="00:00:00">00:00</option>      
        <option value="00:30:00">00:30</option>      
        <option value="01:00:00">01:00</option>     
        <option value="01:30:00">01:30</option>      
        <option value="02:00:00">02:00</option>      
        <option value="02:30:00">02:30</option>      
        <option value="03:00:00">03:00</option>      
        <option value="03:30:00">03:30</option>      
        <option value="04:00:00">04:00</option>      
        <option value="04:30:00">04:30</option>      
        <option value="05:00:00">05:00</option>      
        <option value="05:30:00">05:30</option>      
        <option value="06:00:00">06:00</option>      
        <option value="06:30:00">06:30</option>     
        <option value="07:00:00">07:00</option>      
        <option value="07:30:00">07:30</option>      
        <option value="08:00:00">08:00</option>      
        <option value="08:30:00">08:30</option>      
        <option value="09:00:00">09:00</option>      
        <option value="09:30:00">09:30</option>      
        <option value="10:00:00">10:00</option>      
        <option value="10:30:00">10:30</option>      
        <option value="11:00:00">11:00</option>      
        <option value="11:30:00">11:30</option>      
        <option value="12:00:00">12:00</option>      
        <option value="12:30:00">12:30</option>      
        <option value="13:00:00">13:00</option>      
        <option value="13:30:00">13:30</option>      
        <option value="14:00:00">14:00</option>      
        <option value="14:30:00">14:30</option>      
        <option value="15:00:00">15:00</option>      
        <option value="15:30:00">15:30</option>      
        <option value="16:00:00">16:00</option>      
        <option value="16:30:00">16:30</option>      
        <option value="17:00:00">17:00</option>      
        <option value="17:30:00">17:30</option>      
        <option value="18:00:00">18:00</option>      
        <option value="18:30:00">18:30</option>      
        <option value="19:00:00">19:00</option>      
        <option value="19:30:00">19:30</option>      
        <option value="20:00:00">20:00</option>      
        <option value="20:30:00">20:30</option>      
        <option value="21:00:00">21:00</option>      
        <option value="21:30:00">21:30</option>      
        <option value="22:00:00">22:00</option>      
        <option value="22:30:00">22:30</option>      
        <option value="23:00:00">23:00</option>      
        <option value="23:30:00">23:30</option>
</select>
										</div>
										
										<div id="divReq-case_date">
										
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">สถานที่เกิดเหตุ :<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="Accident_location"
												class="form-control" name="Accident[accident_location]" />
										</div>
										<div id="divReq-Accident_location"></div>
									</div>
								</div>
							</div>
<!-- 
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">ลำดับเหตุการณ์:<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<textarea rows="5" cols="70" id="chronology"
												 name="Accident[accident_chronology]" ></textarea>
										</div>
										<div id="divReq-chronology"></div>
									</div>
								</div>
							</div>
 -->
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">

										<label class="control-label col-md-4">ลักษณะเหตุการณ์ :<span class="required">*</span>
										</label>
										<div class="col-md-8">
											<span style="font-size: xx-small;color: red;"> (เกิดขึ้นอย่างไร ที่ไหน เมื่อไหร่ ผู้เกี่ยวข้อง
												จำนวนผู้ได้รับผลกระทบ)</span>

										</div>
										<div class="col-md-4">
											<textarea rows="5" cols="70" id="Accident_event"
												name="Accident[accident_event]"></textarea>

										</div>
										<div id="divReq-accident_event"></div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-10">
									<div class="form-group last">
										<label class="control-label col-md-4">แนบรูปภาพ (ถ้ามี) :</label>
										<div class="col-md-4">
											<span style="font-size: xx-small;color: red;">(โปรดแนบไฟล์ jpg หรือ pdf ที่มีขนาดไม่เกิน  <?php echo ConfigUtil::getDefaultMaxUploadFileSize()?>MB)</span>
											<div class="input-group">

											<div class="row fileupload-buttonbar">
												<div class="col-lg-7">
													<!-- The fileinput-button span is used to style the file input field as button -->
													<span class="btn green fileinput-button"> <input
														type="file" name="img1[]" multiple="multiple"  onchange="validateFileInput(this);">
													</span>
													<!-- The global file processing state -->
													<span class="fileupload-process"> </span>
												</div>
												
												<!-- The global progress information -->
												<div class="col-lg-5 fileupload-progress fade">
													<!-- The global progress bar -->
													<div class="progress progress-striped active"
														role="progressbar" aria-valuemin="0" aria-valuemax="100">
														<div class="progress-bar progress-bar-success"
															style="width: 0%;"></div>
													</div>
													<!-- The extended global progress information -->
													<div class="progress-extended">&nbsp;</div>
												</div>
												
												
											</div>
											<div class="clearfix margin-top-10"></div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-10">
									<div class="form-group">

										<label class="control-label col-md-4">สาเหตุเบื้องต้นของการเกิดอุบัติเหตุ :
										</label>
										<div class="col-md-4">
											<textarea rows="5" cols="70" id="Accident_cause"
												name="Accident[accident_cause]"></textarea>

										</div>
										<div id="divReq-Accident_cause"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">

										<label class="control-label col-md-4">การแก้ไขเบื้องต้นที่ได้กระทำไปแล้ว 
											: </label>
										<div class="col-md-4">
											<textarea rows="5" cols="70" id="Accident_solve"
												name="Accident[accident_solve]"></textarea>

										</div>
										<div id="divReq-Accident_solve"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group last">
										<label class="control-label col-md-4">แนบรูปภาพ (ถ้ามี) :</label>
										<div class="col-md-4">
											<span style="font-size: xx-small;color: red;">(โปรดแนบไฟล์ jpg หรือ pdf ที่มีขนาดไม่เกิน  <?php echo ConfigUtil::getDefaultMaxUploadFileSize()?>MB)</span>
											<div class="row fileupload-buttonbar">
												<div class="col-lg-7">
													<!-- The fileinput-button span is used to style the file input field as button -->
													<span class="btn green fileinput-button"> <input
														type="file" name="img2[]" multiple="multiple" onchange="validateFileInput(this);">
													</span>
													<!-- The global file processing state -->
													<span class="fileupload-process"> </span>
												</div>
												<!-- The global progress information -->
												<div class="col-lg-5 fileupload-progress fade">
													<!-- The global progress bar -->
													<div class="progress progress-striped active"
														role="progressbar" aria-valuemin="0" aria-valuemax="100">
														<div class="progress-bar progress-bar-success"
															style="width: 0%;"></div>
													</div>
													<!-- The extended global progress information -->
													<div class="progress-extended">&nbsp;</div>
												</div>
											</div>

											<div class="clearfix margin-top-10"></div>
										</div>
									</div>
								</div>
							</div>

						</div>

					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse"
									data-parent="#accordion3" href="#collapse_3"><i
									class="fa fa-user"></i> Section 3 :
									ความเสียหายการเกิดอุบัติเหตุ </a>
							</h4>
						</div>
						<div id="collapse_3" class="panel-collapse in">
							<br>

							<div class="row">

								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-1"></label>



										<div class="col-md-8">
											<table>
												<tr>
													<td><label class="radio-inline"> <input type="checkbox"
															class="rdDamageTypeCls" checked="checked"
															id="dammage_type" name="Accident_dammage_type[]" value="1" />เสียชีวิต
															จำนวน

													</label></td>
													<td>&nbsp;&nbsp; <input type="text" value="" class='allowNum'
														id="dammage_type_1_value"
														style="border: none; border-bottom-style: dotted; width: 80px;text-align: right;"
														name="Accident[dammage_type_1_value]" />&nbsp;&nbsp;
														
													</td>
													<td>ราย</td>
												</tr>
												<tr>
													<td><label class="radio-inline"> <input type="checkbox"
															class="rdDamageTypeCls" id="dammage_type"
															name="Accident_dammage_type[]" value="2" />สูญเสียอวัยวะ/ทุพพลภาพ
															จำนวน

													</label></td>
													<td>&nbsp;&nbsp; <input type="text" value="" class='allowNum'
														id="dammage_type_2_value"
														style="border: none; border-bottom-style: dotted; width: 80px;text-align: right;"
														name="Accident[dammage_type_2_value]" />&nbsp;&nbsp;
													</td>
													<td>ราย</td>
												</tr>
												<tr>
													<td><label class="radio-inline"> <input type="checkbox"
															class="rdDamageTypeCls" id="dammage_type"
															name="Accident_dammage_type[]" value="3" />บาดเจ็บ/เจ็บป่วย
															จำนวน

													</label></td>
													<td>&nbsp;&nbsp; <input type="text" value="" class='allowNum'
														id="dammage_type_3_value"
														style="border: none; border-bottom-style: dotted; width: 80px;text-align: right;"
														name="Accident[dammage_type_3_value]" />&nbsp;&nbsp;
													</td>
													<td>ราย</td>
												</tr>
												<tr>
													<td><label class="radio-inline"> <input type="checkbox"
															class="rdDamageTypeCls" id="dammage_type"
															name="Accident_dammage_type[]" value="4" />ทรัพย์สินเสียหาย
															จำนวน

													</label></td>
													<td>&nbsp;&nbsp; <input type="text" value="" class='allowNum2'
														id="dammage_type_4_value"
														style="border: none; border-bottom-style: dotted; width: 80px;text-align: right;"
														name="Accident[dammage_type_4_value]" />&nbsp;&nbsp;
													</td>
													<td>บาท</td>
												</tr>
												<tr>
													<td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โปรดระบุรายละเอียด

														<input type="text" value="" id="dammage_type_4_other"
														style="border: none; border-bottom-style: dotted; width: 300px;"
														name="Accident[dammage_type_4_other]" />
													</td>

												</tr>
												<tr>
													<td><label class="radio-inline"> <input type="checkbox"
															class="rdDamageTypeCls" id="dammage_type"
															name="Accident_dammage_type[]" value="5" />มีการหยุดการปฏิบัติงาน
															จำนวนวันที่หยุดการปฏิบัติงาน

													</label></td>
													<td><input type="text" value="" id="dammage_type_5_value" class='allowNum'
														style="border: none; border-bottom-style: dotted; width: 80px;text-align: right;"
														name="Accident[dammage_type_5_value]" /></td>
													<td>วัน</td>
												</tr>
											</table>
										</div>

										<div id="divReq-room_id"></div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>
				<div class="note note-info">
					<p>
						<b>หมายเหตุ : กรณีที่ต้องสอบสวนการเกิดอุบัติเหตุ</b>
					</p>
					<ul>
						<li>ทรัพย์สินเสียหายตั้งแต่ 5,000 บาท</li>
						<li>ผู้ได้รับบาดเจ็บต้องหยุดงาน ภายใน 24 ชม.
							ไม่สามารถทำงานหน้าที่เดิมได้</li>
						<li>อุบัติเหตุเกิดขึ้นกับบุคคลภายนอกและต้องปฐมพยาบาล
							หรือรักษาพยาบาล</li>
						<li>ภาชนะบรรจุสารเคมี เกิดการหกหรือรั่วไหล
							และมีแนวโน้มก่อให้เกิดอันตราย</li>
						<li>ไฟไหม้</li>
					</ul>

				</div>





			<!-- END FORM-->
			<div class="form-actions">
				<div class="row">
					<div class="col-md-10">
						<div class="row">
							<div class="col-md-offset-3 col-md-10">
								<button type="submit" class="btn green uppercase"><?php echo ConfigUtil::getBtnSaveButton();?></button>
								<?php echo CHtml::link(ConfigUtil::getBtnCancelButton(),array('Accident/'),array('class'=>'btn btn-default uppercase'));?>
							</div>
						</div>
					</div>
					<div class="col-md-10"></div>
				</div>
			</div>
		</div>
	</div>
	<input id="hostUrl" type="hidden" value="<?php echo ConfigUtil::getUrlHostName();?>">
	<input type="hidden" id="maxUploadFileSize" value="<?php echo ConfigUtil::getDefaultMaxUploadFileSize()?>">


	<script src="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
		

	<script>
	
	function sanitizeNumericInput(input) {

	    // a negative sign comes before any digit
	    var is_negative = /^[^0-9]*\-/.test(input)

	    // remove anything that is not a digit or decimal point
	    var digits = input.replace(/[^0-9\.]/g, '');

	    // find the first decimal point
	    var decimal_point = digits.indexOf('.');

	    // no decimal point, don't worry about inserting one
	    if(decimal_point == -1) decimal_point = digits.length;

	    // remove all other decimal points and create a numeric string
	    var clean = (is_negative?'-':'') + digits.substr(0, decimal_point) + '.' + digits.substr(decimal_point).replace(/\./g, '');

	    // attempt to turn this into a number data-type
	    var number = parseFloat(clean);

	    // no digits (not a number) return '0.00'
	    if(isNaN(number)) return '0.00';

	    // round to two decimal places
	    number = (Math.round(number*100) / 100);

	    // force two digits after the decimal point, convert to string and return it
    	var parts = number.toFixed(2).toString().replace("," ,"").split(".");
    	parts[0] = parts[0].replace("," ,"").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    	return parts.join(".");
	}
	
	var _validFileExtensions = [".jpg", ".jpeg",".pdf"];    
	function validateFileInput(oInput) {

		$_maxUploadFileSize = document.getElementById("maxUploadFileSize").value;
		
	    if (oInput.type == "file") {
	        var sFileName = oInput.value;
	        var sFileSize = oInput.files[0].size / 1024 / 1024;//MB
	         if (sFileName.length > 0) {
	            var blnValid = false;
	            for (var j = 0; j < _validFileExtensions.length; j++) {
	                var sCurExtension = _validFileExtensions[j];
	                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
	                    blnValid = true;
	                    break;
	                }
	            }
	            console.log('size:'+$_maxUploadFileSize);
	            if(sFileSize > $_maxUploadFileSize ){
	                alert("โปรดแนบไฟล์ที่มีขนาดไม่เกิน "+$_maxUploadFileSize+"MB" );
	                oInput.value = "";
	                return false;
	            }else if (!blnValid) {
	                alert("โปรดแนบไฟล์ jpg หรือ pdf" );
	                oInput.value = "";
	                return false;
	            }
	        }
	    }
	    return true;
	}
	
// 	var treeData;

    function onchangeDepartment(sel){
    	  $("#belong_to").val(sel.options[sel.selectedIndex].text)
    }
    
//     function initTree(treeData) {
//         $('#treeview_json').treeview({data: treeData});
//     }

    jQuery(document).ready(function () {

//     	$.ajax({
//     	     url: $('#hostUrl').val()+"index.php/AjaxRequest/GetDepartment",
//     	     type: "GET",
//     	     dataType: "json",
//     	     success: function (response) {
        	     
// 	         	$.each(response, function( index, value ) {
// 					html += "<ul>" + value.name;
// //     	        	 console.log( index + ": " + value.name );
//         	      	$.each(value.nodes, function (index1, item1) {
//        	                 html += "<li>" + item1.name + "</li>";
//        	             });
// 	         		html += "</ul>";
// 	        	});
// 	        	$("#container").append('<ul>'+html+'</ul>');
// //     	        initTree(response)
//     	     },
//     	     error: function (xhr, ajaxOptions, thrownError) {
//     			alert('ERROR');
//     	     }
//     	});

    	$.datetimepicker.setLocale('th'); // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
        
      
    	 // กรณีใช้แบบ input
        $("#report_date").datetimepicker({
            timepicker:false,
            format:'d/m/Y',  // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
            lang:'th',  // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
            onSelectDate:function(dp,$input){
                var yearT=new Date(dp).getFullYear()-0;  
                var yearTH=yearT+543;
                var fulldate=$input.val();
                var fulldateTH=fulldate.replace(yearT,yearTH);
                $input.val(fulldateTH);
            },
        });       


        // กรณีใช้กับ input ต้องกำหนดส่วนนี้ด้วยเสมอ เพื่อปรับปีให้เป็น ค.ศ. ก่อนแสดงปฏิทิน
        $("#report_date").on("mouseenter mouseleave",function(e){
            var dateValue=$(this).val();
            if(dateValue!=""){
                    var arr_date=dateValue.split("/"); // ถ้าใช้ตัวแบ่งรูปแบบอื่น ให้เปลี่ยนเป็นตามรูปแบบนั้น
                    // ในที่นี้อยู่ในรูปแบบ 00-00-0000 เป็น d-m-Y  แบ่งด่วย - ดังนั้น ตัวแปรที่เป็นปี จะอยู่ใน array
                    //  ตัวที่สอง arr_date[2] โดยเริ่มนับจาก 0 
                    if(e.type=="mouseenter"){
                        var yearT=arr_date[2]-543;
                    }       
                    if(e.type=="mouseleave"){
                        var yearT=parseInt(arr_date[2])+543;
                    }   
                    dateValue=dateValue.replace(arr_date[2],yearT);
                    $(this).val(dateValue);                                                 
            }       
        });
        
        // กรณีใช้แบบ input
        $("#case_date").datetimepicker({
            timepicker:false,
            format:'d/m/Y',  // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
            lang:'th',  // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
            onSelectDate:function(dp,$input){
                var yearT=new Date(dp).getFullYear()-0;  
                var yearTH=yearT+543;
                var fulldate=$input.val();
                var fulldateTH=fulldate.replace(yearT,yearTH);
                $input.val(fulldateTH);
            },
        });       


        // กรณีใช้กับ input ต้องกำหนดส่วนนี้ด้วยเสมอ เพื่อปรับปีให้เป็น ค.ศ. ก่อนแสดงปฏิทิน
        $("#case_date").on("mouseenter mouseleave",function(e){
            var dateValue=$(this).val();
            if(dateValue!=""){
                    var arr_date=dateValue.split("/"); // ถ้าใช้ตัวแบ่งรูปแบบอื่น ให้เปลี่ยนเป็นตามรูปแบบนั้น
                    // ในที่นี้อยู่ในรูปแบบ 00-00-0000 เป็น d-m-Y  แบ่งด่วย - ดังนั้น ตัวแปรที่เป็นปี จะอยู่ใน array
                    //  ตัวที่สอง arr_date[2] โดยเริ่มนับจาก 0 
                    if(e.type=="mouseenter"){
                        var yearT=arr_date[2]-543;
                    }       
                    if(e.type=="mouseleave"){
                        var yearT=parseInt(arr_date[2])+543;
                    }   
                    dateValue=dateValue.replace(arr_date[2],yearT);
                    $(this).val(dateValue);                                                 
            }       
        });
     
        $(".allowNum").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               alert('ป้อนข้อมูลได้เฉพาะตัวเลข');
               return false;
           }
          });

        $('#dammage_type_4_value').bind('change', function(){
            this.value = sanitizeNumericInput(this.value);
        });
        

        

        $(".allowNum2").keypress(function (evt, element) {
            var charCode = (evt.which) ? evt.which : event.keyCode

                    if (
                        (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
                        (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
                        (charCode < 48 || charCode > 57))
                        return false;

                    return true;
                    
          });
    	$( "#Form1" ).submit(function( event ) {

        	if($("#name").val().length == 0){
        		$("#name").closest('.form-group').addClass('has-error');
        		$("#divReq-name").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#name").focus();
        		return false;
            }else{
            	$("#divReq-name").html('');
            	$("#name").closest('.form-group').removeClass('has-error');
        	}
        	if($("#position_or_level").val().length == 0){
        		$("#position_or_level").closest('.form-group').addClass('has-error');
        		$("#divReq-position_or_level").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#position_or_level").focus();
        		return false;
            }else{
            	$("#divReq-position_or_level").html('');
            	$("#position_or_level").closest('.form-group').removeClass('has-error');
        	}
        	if($("#department_id").val() == "-1"){
        		$("#department_id").closest('.form-group').addClass('has-error');
        		$("#divReq-department_id").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#department_id").focus();
        		return false;
            }else{
            	$("#divReq-department_id").html('');
            	$("#department_id").closest('.form-group').removeClass('has-error');
        	}
        	if($("#phone_number").val().length == 0){
        		$("#phone_number").closest('.form-group').addClass('has-error');
        		$("#divReq-phone_number").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#phone_number").focus();
        		return false;
            }else{
            	$("#divReq-phone_number").html('');
            	$("#phone_number").closest('.form-group').removeClass('has-error');
        	}
        	if($("#email").val().length == 0){
        		$("#email").closest('.form-group').addClass('has-error');
        		$("#divReq-email").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#email").focus();
        		return false;
            }else{
            	$("#divReq-email").html('');
            	$("#email").closest('.form-group').removeClass('has-error');
        	}
        	if($("#report_date").val().length == 0){
        		$("#report_date").closest('.form-group').addClass('has-error');
        		$("#divReq-report_date").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#report_date").focus();
        		return false;
            }else{
            	$("#divReq-report_date").html('');
            	$("#report_date").closest('.form-group').removeClass('has-error');
        	}
//         	if($("#name2").val().length == 0){
//         		$("#name2").closest('.form-group').addClass('has-error');
//         		$("#divReq-name2").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
//         		$("#name2").focus();
//         		return false;
//             }else{
//             	$("#divReq-name2").html('');
//             	$("#name2").closest('.form-group').removeClass('has-error');
//         	}
           	if($("#belong_to").val().length == 0){
        		$("#belong_to").closest('.form-group').addClass('has-error');
        		$("#divReq-belong_to").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#belong_to").focus();
        		return false;
            }else{
            	$("#divReq-belong_to").html('');
            	$("#belong_to").closest('.form-group').removeClass('has-error');
        	}
          	if($("#case_date").val().length == 0){
        		$("#case_date").closest('.form-group').addClass('has-error');
        		$("#divReq-case_date").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#case_date").focus();
        		return false;
            }else{
            	$("#divReq-case_date").html('');
            	$("#case_date").closest('.form-group').removeClass('has-error');
        	}
        	if($("#case_date_time").val() == "00:00:00"){
        		$("#case_date").closest('.form-group').addClass('has-error');
        		$("#divReq-case_date").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#case_date_time").focus();
        		return false;
            }else{
            	$("#divReq-case_date").html('');
            	$("#case_date").closest('.form-group').removeClass('has-error');
        	}
          	
         	if($("#Accident_location").val().length == 0){
        		$("#Accident_location").closest('.form-group').addClass('has-error');
        		$("#divReq-Accident_location").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#Accident_location").focus();
        		return false;
            }else{
            	$("#divReq-Accident_location").html('');
            	$("#Accident_location").closest('.form-group').removeClass('has-error');
        	}



         	if($("#Accident_event").val().length == 0){
        		$("#Accident_event").closest('.form-group').addClass('has-error');
        		$("#divReq-accident_event").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#Accident_event").focus();
        		return false;
            }else{
            	$("#divReq-accident_event").html('');
            	$("#Accident_event").closest('.form-group').removeClass('has-error');
        	}
        	
//          	if($("#chronology").val().length == 0){
//         		$("#chronology").closest('.form-group').addClass('has-error');
//         		$("#divReq-chronology").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
//         		$("#chronology").focus();
//         		return false;
//             }else{
//             	$("#divReq-chronology").html('');
//             	$("#chronology").closest('.form-group').removeClass('has-error');
//         	}

    		var damageType = $('.rdDamageTypeCls:checked').val();
			switch(damageType){
    			case "1":
    				if($("#dammage_type_1_value").val().length == 0){
        				alert('ระบุจำนวนผู้เสียชีวิต');
						return false;
        			}
        			break;
    			case "2":
    				if($("#dammage_type_2_value").val().length == 0){
        				alert('ระบุจำนวนผู้สูญเสียอวัยวะ/ทุพพลภาพ');
						return false;
        			}
        			break;
    			case "3":
       				if($("#dammage_type_3_value").val().length == 0){
        				alert('ระบุจำนวนผู้บาดเจ็บ/เจ็บป่วย');
						return false;
        			}
        			break;
    			case "4":
       				if($("#dammage_type_4_value").val().length == 0){
        				alert('ระบุจำนวนผู้ทรัพย์สินเสียหาย');
						return false;
        			}
        			break;
    			case "5":
       				if($("#dammage_type_5_value").val().length == 0){
        				alert('ระบุจำนวนวันที่หยุดการปฏิบัติงาน');
						return false;
        			}
        			break;
			}

        	
        	this.submit();
    	});
    });

</script>

</form>