
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
										<div class="col-sm-5">
										
										                
										

<select class="form-control" name="Accident[department_id]" id="department_id" onchange="onchangeDepartment(this)">
<option value="-1">-- (ไม่มีสังกัด) --</option>
<?php
echo CommonUtil::getDepartment(UserLoginUtils::getDepartmentId());
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
										<label class="control-label col-md-4">ผู้พบเห็นเหตุการณ์
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
										<label class="control-label col-md-4">สังกัดผู้พบเห็นเหตุการณ์ :<span
											class="required"></span>
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
										        <div class='input-group date' >
                                                  <input type='text' class="form-control" id='case_date_time'  name="Accident[case_date_time]" />
                                                  <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                  </span>
                                                </div>
        
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
										<label class="control-label col-md-4">คำอธิบาย : <br>แนบรูปภาพ (ถ้ามี) :</label>
										<div class="col-md-4">
									<table style="width: 750px">
										<tr>
    										<td><input type="text" value="" id="img1_desc" class="form-control" name="AccidentImage[img1_description]" /></td>
    										<td><input type="text" value="" id="img2_desc" class="form-control" name="AccidentImage[img2_description]" /></td>
    										<td><input type="text" value="" id="img3_desc" class="form-control" name="AccidentImage[img3_description]" /></td>
    										<td><input type="text" value="" id="img4_desc" class="form-control" name="AccidentImage[img4_description]" /></td>
    										<td><input type="text" value="" id="img5_desc" class="form-control" name="AccidentImage[img5_description]" /></td>
										</tr>

										<tr>
										<td width="150px">
											<div class="fileinput fileinput-new"
												data-provides="fileinput">
												<div class="fileinput-new thumbnail"
													style="width: 150px; height: 100px;">
													<img
														src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
														alt="" />
												</div>
												<div class="fileinput-preview fileinput-exists thumbnail"
													style="max-width: 150px; max-height: 100px;"></div>
												<div>
													<span class="btn default btn-file"> <span
														class="fileinput-new"> เลือก </span> <span
														class="fileinput-exists">เปลี่ยน </span> <input
														type="file" name="img1[]" onchange="validateFileInput(this);">
													</span> <a href="javascript:;"
														class="btn red fileinput-exists" data-dismiss="fileinput">
														ลบ </a>
												</div>
											</div>
										</td>
										<td width="150px">
											<div class="fileinput fileinput-new"
												data-provides="fileinput">
												<div class="fileinput-new thumbnail"
													style="width: 150px; height: 100px;">
													<img
														src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
														alt="" />
												</div>
												<div class="fileinput-preview fileinput-exists thumbnail"
													style="max-width: 150px; max-height: 100px;"></div>
												<div>
													<span class="btn default btn-file"> <span
														class="fileinput-new"> เลือก </span> <span
														class="fileinput-exists">เปลี่ยน </span> <input
														type="file" name="img2[]" onchange="validateFileInput(this);">
													</span> <a href="javascript:;"
														class="btn red fileinput-exists" data-dismiss="fileinput">
														ลบ </a>
												</div>
											</div>
										</td>
										<td width="150px">
											<div class="fileinput fileinput-new"
												data-provides="fileinput">
												<div class="fileinput-new thumbnail"
													style="width: 150px; height: 100px;">
													<img
														src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
														alt="" />
												</div>
												<div class="fileinput-preview fileinput-exists thumbnail"
													style="max-width: 150px; max-height: 100px;"></div>
												<div>
													<span class="btn default btn-file"> <span
														class="fileinput-new"> เลือก </span> <span
														class="fileinput-exists">เปลี่ยน </span> <input
														type="file" name="img3[]" onchange="validateFileInput(this);">
													</span> <a href="javascript:;"
														class="btn red fileinput-exists" data-dismiss="fileinput">
														ลบ </a>
												</div>
											</div>
										</td>
										<td width="150px">
											<div class="fileinput fileinput-new"
												data-provides="fileinput">
												<div class="fileinput-new thumbnail"
													style="width: 150px; height: 100px;">
													<img
														src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
														alt="" />
												</div>
												<div class="fileinput-preview fileinput-exists thumbnail"
													style="max-width: 150px; max-height: 100px;"></div>
												<div>
													<span class="btn default btn-file"> <span
														class="fileinput-new"> เลือก </span> <span
														class="fileinput-exists">เปลี่ยน </span> <input
														type="file" name="img4[]" onchange="validateFileInput(this);">
													</span> <a href="javascript:;"
														class="btn red fileinput-exists" data-dismiss="fileinput">
														ลบ </a>
												</div>
											</div>
										</td>
										<td width="150px">
											<div class="fileinput fileinput-new"
												data-provides="fileinput">
												<div class="fileinput-new thumbnail"
													style="width: 150px; height: 100px;">
													<img
														src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
														alt="" />
												</div>
												<div class="fileinput-preview fileinput-exists thumbnail"
													style="max-width: 150px; max-height: 100px;"></div>
												<div>
													<span class="btn default btn-file"> <span
														class="fileinput-new"> เลือก </span> <span
														class="fileinput-exists">เปลี่ยน </span> <input
														type="file" name="img5[]" onchange="validateFileInput(this);">
													</span> <a href="javascript:;"
														class="btn red fileinput-exists" data-dismiss="fileinput">
														ลบ </a>
												</div>
											</div>
										</td>
										</tr>
										</table>



											<span style="font-size: xx-small;color: red;">(โปรดแนบไฟล์ jpg หรือ png ที่มีขนาดไม่เกิน  <?php echo ConfigUtil::getDefaultMaxUploadFileSize()?>MB)</span>

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
										<label class="control-label col-md-4">คำอธิบาย : <br>แนบรูปภาพ (ถ้ามี) :</label>
										<div class="col-md-4">
									<table style="width: 750px">
										<tr>
    										<td><input type="text" value="" id="img6_desc" class="form-control" name="AccidentImage[img6_description]" /></td>
    										<td><input type="text" value="" id="img7_desc" class="form-control" name="AccidentImage[img7_description]" /></td>
    										<td><input type="text" value="" id="img8_desc" class="form-control" name="AccidentImage[img8_description]" /></td>
    										<td><input type="text" value="" id="img9_desc" class="form-control" name="AccidentImage[img9_description]" /></td>
    										<td><input type="text" value="" id="img10_desc" class="form-control" name="AccidentImage[img10_description]" /></td>
										</tr>

										<tr>
										<td width="150px">
											<div class="fileinput fileinput-new"
												data-provides="fileinput">
												<div class="fileinput-new thumbnail"
													style="width: 150px; height: 100px;">
													<img
														src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
														alt="" />
												</div>
												<div class="fileinput-preview fileinput-exists thumbnail"
													style="max-width: 150px; max-height: 100px;"></div>
												<div>
													<span class="btn default btn-file"> <span
														class="fileinput-new"> เลือก </span> <span
														class="fileinput-exists">เปลี่ยน </span> <input
														type="file" name="img6[]" onchange="validateFileInput(this);">
													</span> <a href="javascript:;"
														class="btn red fileinput-exists" data-dismiss="fileinput">
														ลบ </a>
												</div>
											</div>
										</td>
										<td width="150px">
											<div class="fileinput fileinput-new"
												data-provides="fileinput">
												<div class="fileinput-new thumbnail"
													style="width: 150px; height: 100px;">
													<img
														src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
														alt="" />
												</div>
												<div class="fileinput-preview fileinput-exists thumbnail"
													style="max-width: 150px; max-height: 100px;"></div>
												<div>
													<span class="btn default btn-file"> <span
														class="fileinput-new"> เลือก </span> <span
														class="fileinput-exists">เปลี่ยน </span> <input
														type="file" name="img7[]" onchange="validateFileInput(this);">
													</span> <a href="javascript:;"
														class="btn red fileinput-exists" data-dismiss="fileinput">
														ลบ </a>
												</div>
											</div>
										</td>
										<td width="150px">
											<div class="fileinput fileinput-new"
												data-provides="fileinput">
												<div class="fileinput-new thumbnail"
													style="width: 150px; height: 100px;">
													<img
														src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
														alt="" />
												</div>
												<div class="fileinput-preview fileinput-exists thumbnail"
													style="max-width: 150px; max-height: 100px;"></div>
												<div>
													<span class="btn default btn-file"> <span
														class="fileinput-new"> เลือก </span> <span
														class="fileinput-exists">เปลี่ยน </span> <input
														type="file" name="img8[]" onchange="validateFileInput(this);">
													</span> <a href="javascript:;"
														class="btn red fileinput-exists" data-dismiss="fileinput">
														ลบ </a>
												</div>
											</div>
										</td>
										<td width="150px">
											<div class="fileinput fileinput-new"
												data-provides="fileinput">
												<div class="fileinput-new thumbnail"
													style="width: 150px; height: 100px;">
													<img
														src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
														alt="" />
												</div>
												<div class="fileinput-preview fileinput-exists thumbnail"
													style="max-width: 150px; max-height: 100px;"></div>
												<div>
													<span class="btn default btn-file"> <span
														class="fileinput-new"> เลือก </span> <span
														class="fileinput-exists">เปลี่ยน </span> <input
														type="file" name="img9[]" onchange="validateFileInput(this);">
													</span> <a href="javascript:;"
														class="btn red fileinput-exists" data-dismiss="fileinput">
														ลบ </a>
												</div>
											</div>
										</td>
										<td width="150px">
											<div class="fileinput fileinput-new"
												data-provides="fileinput">
												<div class="fileinput-new thumbnail"
													style="width: 150px; height: 100px;">
													<img
														src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
														alt="" />
												</div>
												<div class="fileinput-preview fileinput-exists thumbnail"
													style="max-width: 150px; max-height: 100px;"></div>
												<div>
													<span class="btn default btn-file"> <span
														class="fileinput-new"> เลือก </span> <span
														class="fileinput-exists">เปลี่ยน </span> <input
														type="file" name="img10[]" onchange="validateFileInput(this);">
													</span> <a href="javascript:;"
														class="btn red fileinput-exists" data-dismiss="fileinput">
														ลบ </a>
												</div>
											</div>
										</td>
										</tr>
										</table>



											<span style="font-size: xx-small;color: red;">(โปรดแนบไฟล์ jpg หรือ png ที่มีขนาดไม่เกิน  <?php echo ConfigUtil::getDefaultMaxUploadFileSize()?>MB)</span>


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
															class="rdDamageTypeCls" checked="checked"
															id="dammage_type" name="Accident_dammage_type[]" value="1" />&nbsp;&nbsp;เสียชีวิต
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
													<td><label class="radio-inline"> <input type="radio"
															class="rdDamageTypeCls" id="dammage_type"
															name="Accident_dammage_type[]" value="2" />&nbsp;&nbsp;สูญเสียอวัยวะ/ทุพพลภาพ
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
													<td><label class="radio-inline"> <input type="radio"
															class="rdDamageTypeCls" id="dammage_type"
															name="Accident_dammage_type[]" value="3" />&nbsp;&nbsp;บาดเจ็บ/เจ็บป่วย
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
													<td><label class="radio-inline"> <input type="radio"
															class="rdDamageTypeCls" id="dammage_type"
															name="Accident_dammage_type[]" value="4" />&nbsp;&nbsp;ทรัพย์สินเสียหาย
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
													<td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โปรดระบุรายละเอียด

														<input type="text" value="" id="dammage_type_4_other"
														style="border: none; border-bottom-style: dotted; width: 300px;"
														name="Accident[dammage_type_4_other]" />
													</td>

												</tr>
												<tr>
													<td><label class="radio-inline"> <input type="radio"
															class="rdDamageTypeCls" id="dammage_type"
															name="Accident_dammage_type[]" value="5" />&nbsp;&nbsp;มีการหยุดการปฏิบัติงาน
															จำนวนวันที่หยุดการปฏิบัติงาน

													</label></td>
													<td><input type="text" value="" id="dammage_type_5_value" class='allowNum'
														style="border: none; border-bottom-style: dotted; width: 80px;text-align: right;"
														name="Accident[dammage_type_5_value]" /></td>
													<td>วัน</td>
												</tr>
												<!-- New Requirement -->
												<tr>
													<td><label class="radio-inline"> <input type="radio"
															class="rdDamageTypeCls" id="dammage_type"
															name="Accident_dammage_type[]" value="6" />&nbsp;&nbsp;ผลกระทบต่อสิ่งแวดล้อม โปรดระบุรายละเอียด

													</label></td>
												</tr>
												<tr>
													<td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

														<input type="text" value="" id="dammage_type_6_value"
														style="border: none; border-bottom-style: dotted; width: 400px;"
														name="Accident[dammage_type_6_value]" />
													</td>

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
// 	            console.log('size:'+$_maxUploadFileSize);
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
    	  //$("#belong_to").val(sel.options[sel.selectedIndex].text)
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

    	$('#report_date').datepicker({language:'th-th',format:'dd/mm/yyyy'})
    	$('#case_date').datepicker({language:'th-th',format:'dd/mm/yyyy'})
       	$('#case_date_time').datetimepicker({format: 'HH:mm'});
    	
     
        $(".allowNum").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
//                alert('ป้อนข้อมูลได้เฉพาะตัวเลข');
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
//            	if($("#belong_to").val().length == 0){
//         		$("#belong_to").closest('.form-group').addClass('has-error');
//         		$("#divReq-belong_to").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
//         		$("#belong_to").focus();
//         		return false;
//             }else{
//             	$("#divReq-belong_to").html('');
//             	$("#belong_to").closest('.form-group').removeClass('has-error');
//         	}
          	if($("#case_date").val().length == 0){
        		$("#case_date").closest('.form-group').addClass('has-error');
        		$("#divReq-case_date").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#case_date").focus();
        		return false;
            }else{
            	$("#divReq-case_date").html('');
            	$("#case_date").closest('.form-group').removeClass('has-error');
        	}

          	
        	if($("#case_date_time").val().length == 0){
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
        	
         	if($("#chronology").val().length == 0){
        		$("#chronology").closest('.form-group').addClass('has-error');
        		$("#divReq-chronology").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#chronology").focus();
        		return false;
            }else{
            	$("#divReq-chronology").html('');
            	$("#chronology").closest('.form-group').removeClass('has-error');
        	}

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
    			case "6":
       				if($("#dammage_type_6_value").val().length == 0){
        				alert('ระบุรายละเอียด');
						return false;
        			}
        			break;
			}

        	
        	this.submit();
    	});
    });

</script>

</form>