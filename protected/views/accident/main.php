<?php 
$criteria = new CDbCriteria ();
$departments = MDepartment::model ()->findAll ();
?>
<form id="Form1" method="post" enctype="multipart/form-data"
	class="form-horizontal">


	<div class="portlet light">
		<div class="portlet-title">
			<div class="caption">
				<?php echo  MenuUtil::getMenuName($_SERVER['REQUEST_URI'])?>
			</div>
			<div class="actions">
			<?php echo CHtml::link('ย้อนกลับ',array('Form1/'),array('class'=>'btn btn-default btn-sm'));?>
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
										<label class="control-label col-md-4">ชื่อ-นามสุกล:<span
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
										<label class="control-label col-md-4">ตำแหน่ง/ชั้นปี:<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="positon_or_level"
												class="form-control" name="Accident[position_or_level]" />

										</div>
										<div id="divReq-positon_or_level"></div>
									</div>
								</div>
							</div>
				<div class="row">
					<div class="col-md-10">
						<div class="form-group">
							<label class="control-label col-md-4">คณะ/ส่วนงาน:<span
								class="required">*</span></label>
							<div class="col-md-6">

								<select class="form-control select2"
									name="Accident[department_id]" id="department_id">
									<option value="-1">-- (ไม่มีสังกัด) --</option>
			<?php foreach($departments as $item) {?>
			<option value="<?php echo $item->id?>"><?php echo sprintf('%02d', $item->id).'-'. $item->name?></option>
			<?php }?>
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
										<label class="control-label col-md-4">วันที่เขียนรายงาน:<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="report_date"
												style="width: 80px !important" name="Accident[report_date]" />

										</div>
										<div id="divReq-report_date"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">ผู้พบเห็นเหตุการณ์คนแรก
											ชื่อ-สกุล :<span class="required">*</span>
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
										<label class="control-label col-md-4">สังกัด:<span
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
										<div class="col-md-4">
											<input type="text" value="" id="case_date"
												style="width: 80px !important" name="Accident[case_date]" />

										</div>
										<div id="divReq-case_date"></div>
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
							
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">ลำดับเหตุการณ์:<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="chronology"
												class="form-control" name="Accident[accident_chronology]" />
										</div>
										<div id="divReq-chronology"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">

										<label class="control-label col-md-4">ลักษณะเหตุการณ์ : <!-- 							<span class="required">*</span> -->
										</label>
										<div class="col-md-8">
											<span> (เกิดขึ้นอย่างไร ที่ไหน เมื่อไหร่ ผู้เกี่ยวข้อง
												จำนวนผู้ได้รับผลกระทบ)</span>

										</div>
										<div class="col-md-4">
											<textarea rows="5" cols="70" id="Accident_event"
												name="Accident[accident_event]"></textarea>

										</div>
										<div id="divReq-Accident_event"></div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-10">
									<div class="form-group last">
										<label class="control-label col-md-4">แนบรูปภาพ (ถ้ามี)</label>
										<div class="col-md-4">
											<div class="fileinput fileinput-new"
												data-provides="fileinput">
												<div class="fileinput-new thumbnail"
													style="width: 200px; height: 150px;">
													<img
														src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
														alt="" />
												</div>
												<div class="fileinput-preview fileinput-exists thumbnail"
													style="max-width: 200px; max-height: 150px;"></div>
												<div>
													<span class="btn default btn-file"> <span
														class="fileinput-new"> Select image </span> <span
														class="fileinput-exists"> Change </span> <input
														type="file" name="img1[]">
													</span> <a href="javascript:;"
														class="btn red fileinput-exists" data-dismiss="fileinput">
														Remove </a>
												</div>
												<span class="required"> ไฟล์ไม่เกิน 1MB</span>
											</div>

											<div class="clearfix margin-top-10"></div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-10">
									<div class="form-group">

										<label class="control-label col-md-4">สาเหตุเบื้องต้นของการเกิดอุบัติเหตุ:
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
										<label class="control-label col-md-4">แนบรูปภาพ (ถ้ามี)</label>
										<div class="col-md-4">
											<div class="fileinput fileinput-new"
												data-provides="fileinput">
												<div class="fileinput-new thumbnail"
													style="width: 200px; height: 150px;">
													<img
														src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
														alt="" />
												</div>
												<div class="fileinput-preview fileinput-exists thumbnail"
													style="max-width: 200px; max-height: 150px;"></div>
												<div>
													<span class="btn default btn-file"> <span
														class="fileinput-new"> Select image </span> <span
														class="fileinput-exists"> Change </span> <input
														type="file" name="img2[]">
													</span> <a href="javascript:;"
														class="btn red fileinput-exists" data-dismiss="fileinput">
														Remove </a>
												</div>
												<span class="required"> ไฟล์ไม่เกิน 1MB</span>
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
													<td><label class="radio-inline"> <input type="radio"
															checked="checked" id="dammage_type"
															name="Accident[dammage_type]" value="1" />เสียชีวิต จำนวน

													</label></td>
													<td>&nbsp;&nbsp; <input type="text" value=""
														id="dammage_type_1_value"
														style="border: none; border-bottom-style: dotted; width: 80px;"
														name="Accident[dammage_type_1_value]" />&nbsp;&nbsp;
													</td>
													<td>ราย</td>
												</tr>
												<tr>
													<td><label class="radio-inline"> <input type="radio"
															id="dammage_type" name="Accident[dammage_type]" value="2" />สูญเสียอวัยวะ/ทุพพลภาพ
															จำนวน

													</label></td>
													<td>&nbsp;&nbsp; <input type="text" value=""
														id="dammage_type_2_value"
														style="border: none; border-bottom-style: dotted; width: 80px;"
														name="Accident[dammage_type_2_value]" />&nbsp;&nbsp;
													</td>
													<td>ราย</td>
												</tr>
												<tr>
													<td><label class="radio-inline"> <input type="radio"
															id="dammage_type" name="Accident[dammage_type]" value="3" />บาดเจ็บ/เจ็บป่วย
															จำนวน

													</label></td>
													<td>&nbsp;&nbsp; <input type="text" value=""
														id="dammage_type_3_value"
														style="border: none; border-bottom-style: dotted; width: 80px;"
														name="Accident[dammage_type_3_value]" />&nbsp;&nbsp;
													</td>
													<td>ราย</td>
												</tr>
												<tr>
													<td><label class="radio-inline"> <input type="radio"
															id="dammage_type" name="Accident[dammage_type]" value="4" />ทรัพย์สินเสียหาย
															จำนวน

													</label></td>
													<td>&nbsp;&nbsp; <input type="text" value=""
														id="dammage_type_4_value"
														style="border: none; border-bottom-style: dotted; width: 80px;"
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
													<td><label class="radio-inline"> <input type="radio"
															id="dammage_type" name="Accident[dammage_type]" value="5" />มีการหยุดการปฏิบัติงาน
															จำนวนวันที่หยุดการปฏิบัติงาน

													</label></td>
													<td><input type="text" value="" id="dammage_type_5_value"
														style="border: none; border-bottom-style: dotted; width: 80px;"
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
			</div>






			<!-- END FORM-->

			<div class="form-actions">
				<div class="row">
					<div class="col-md-10">
						<div class="row">
							<div class="col-md-offset-3 col-md-10">
								<button type="submit" class="btn green uppercase"><?php echo ConfigUtil::getBtnSaveButton();?></button>
								<?php echo CHtml::link(ConfigUtil::getBtnCancelButton(),array('Form1/'),array('class'=>'btn btn-default uppercase'));?>
							</div>
						</div>
					</div>
					<div class="col-md-10"></div>
				</div>
			</div>
		</div>
	</div>


	<script
		src="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/jquery.min.js"
		type="text/javascript"></script>

	<script>


    
    jQuery(document).ready(function () {
        
		 $.datepicker.regional['th'] ={
			        changeMonth: true,
			        changeYear: true,
			        //defaultDate: GetFxupdateDate(FxRateDateAndUpdate.d[0].Day),
			        yearOffSet: 543,
			        showOn: "button",
			        buttonImage: '/images/calendar.gif',
			        buttonImageOnly: true,
			        dateFormat: 'dd/mm/yy',
			        dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
			        dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
			        monthNames: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
			        monthNamesShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
			        constrainInput: true,
			       
			        prevText: 'ก่อนหน้า',
			        nextText: 'ถัดไป',
			        yearRange: '-20:+20',
			        buttonText: 'เลือก',
			      
			    };
		    
			$.datepicker.setDefaults($.datepicker.regional['th']);
		    $( "#report_date" ).datepicker( $.datepicker.regional["th"] ); // Set ภาษาที่เรานิยามไว้ด้านบน
		    $( "#report_date" ).datepicker("setDate", new Date()); //Set ค่าวันปัจจุบัน
		    $( "#case_date" ).datepicker( $.datepicker.regional["th"] ); // Set ภาษาที่เรานิยามไว้ด้านบน
		    $( "#case_date" ).datepicker("setDate", new Date()); //Set ค่าวันปัจจุบัน
		    
    	$( "#Form1" ).submit(function( event ) {
        	
     		//Validate date format
//     	   	if(!moment($("#license_expire_date").val(), 'DD/MM/YYYY',true).isValid()){
//         		$("#license_expire_date").closest('.form-group').addClass('has-error');
//         		$("#divReq-license_expire_date").html("<span id=\"id-error\" class=\"help-block help-block-error\">รูปแบบวันที่ผิด จะต้องอยู่ในรูปแบบ dd/mm/yyyy เช่น 18/02/2526.</span>");
//         		$("#license_expire_date").focus();
//         		return false;
//             }else{
//             	$("#divReq-license_expire_date").html('');
//             	$("#license_expire_date").closest('.form-group').removeClass('has-error');
//         	}
        	
        	
//         	if($("#code_usage_id").val() == "0"){
//         		$("#code_usage_id").closest('.form-group').addClass('has-error');
//         		$("#divReq-code_usage_id").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
//         		$("#code_usage_id").focus();
//         		return false;
//             }else{
//             	$("#divReq-code_usage_id").html('');
//             	$("#code_usage_id").closest('.form-group').removeClass('has-error');
//         	}
        	
        	
        	this.submit();
    	});
    });

</script>

</form>