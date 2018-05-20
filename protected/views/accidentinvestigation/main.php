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
			<?php echo (UserLoginUtils::getUserRole()!=6)? '' : CHtml::link('ย้อนกลับ',array('NormalPerson/'),array('class'=>'btn btn-default btn-sm'));?>
			</div>
		</div>
		<div class="portlet-body form">
			<div class="form-body">
				<!-- BEGIN FORM-->
				<div class="panel-group accordion" id="accordion1">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse"
									data-parent="#accordion1" href="#collapse_1"> <i
									class="fa fa-user"></i> Section 1 :
									ข้อมูลส่วนตัวผู้ได้รับบาดเจ็บ (Personal Detail)
								</a>
							</h4>
						</div>
						<div id="collapse_1" class="panel-collapse in">
							<br>

							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">รายละเอียดของผู้ประสบเหตุ
											:<span class="required">*</span>
										</label>
										<div class="col-md-8">
											<input type="radio" checked="checked" id="person_type"
												name="AccidentInvestigation[person_type]" value="1" /> พนักงานมหาวิทยาลัย
											<input type="radio" id="person_type"
												name="AccidentInvestigation[person_type]" value="2" />
											พนักงานที่ปฏิบัติงานในนามบริษัท/ ลูกจ้างชั่วคราว
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input
												type="radio" id="person_type" name="AccidentInvestigation[person_type]"
												value="3" /> บุคคลภายนอกที่เข้ามาใช้บริการ <input
												type="radio" id="person_type" name="AccidentInvestigation[person_type]"
												value="4" /> นักศึกษา <input type="radio" id="person_type"
												name="AccidentInvestigation[person_type]" value="5" /> อื่นๆ <input
												type="text" value="" id="person_type_other"
												style="border: none; border-bottom-style: dotted; width: 150px;"
												name="AccidentInvestigation[person_type_other]" />
										</div>
										<div id="divReq-name"></div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">ชื่อ-นามสุกล:<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input id="name" type="text" value="" class="form-control"
												name="AccidentInvestigation[name]">

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
												class="form-control" name="AccidentInvestigation[positon_or_level]" />

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
									name="AccidentInvestigation[department_id]" id="department_id">
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
										<label class="control-label col-md-4">หน้าที่:<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="responsibility"
												class="form-control" name="AccidentInvestigation[responsibility]" />
										</div>
										<div id="divReq-responsibility"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">ระยะเวลาปฏิบัติงาน:<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="work_period"
												class="form-control" name="AccidentInvestigation[work_period]" />
										</div>
										<div id="divReq-work_period"></div>
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
									class="fa fa-user"></i> Section 2: ข้อมูลการเกิดอุบัติเหตุ
									(Accident Detail) </a>
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
												style="width: 80px !important" name="AccidentInvestigation[case_date]" />

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
											<input type="text" value="" id="accident_location"
												class="form-control" name="AccidentInvestigation[accident_location]" />
										</div>
										<div id="divReq-accident_location"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">ภารกิจในขณะเกิดเหตุ:<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="activity_at_accident"
												class="form-control" name="AccidentInvestigation[activity_at_accident]" />
										</div>
										<div id="divReq-activity_at_accident"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">จำนวนผู้ปฏิบัติงานในช่วงเวลาที่เกิดเหตุ :<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="count_work_person"
												class="form-control" name="AccidentInvestigation[count_work_person]" />
										</div>
										<div id="divReq-count_work_person">คน</div>
									</div>
								</div>
							</div>


							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">อวัยวะที่ได้รับบาดเจ็บ  
											:<span class="required">*</span>
										</label>
										<div class="col-md-8">

<input type="checkbox" checked="checked" id="bodyAccident1" name="bodyAccidentInvestigation[]" value="1" />ศีรษะ/ ลำคอ / ใบหน้า
<input type="checkbox" id="bodyAccident2" name="bodyAccidentInvestigation[]" value="2" />ตา
<input type="checkbox" id="bodyAccident3" name="bodyAccidentInvestigation[]" value="3" /> หลัง/ ไหล่       
<input type="checkbox" id="bodyAccident4" name="bodyAccidentInvestigation[]" value="4" /> ลำตัว  
<input type="checkbox" id="bodyAccident5" name="bodyAccidentInvestigation[]" value="5" /> แขน 
<input type="checkbox" id="bodyAccident6" name="bodyAccidentInvestigation[]" value="6" /> มือ/นิ้วมือ      								
<input type="checkbox" id="bodyAccident7" name="bodyAccidentInvestigation[]" value="7" /> ขา							
<input type="checkbox" id="bodyAccident8" name="bodyAccidentInvestigation[]" value="8" /> เท้า/ นิ้วเท้า       	
<input type="checkbox" id="bodyAccident9" name="bodyAccidentInvestigation[]" value="9" /> บาดเจ็บหลายส่วน      	
<input type="checkbox" id="bodyAccident10" name="bodyAccidentInvestigation[]" value="10" /> อื่นๆ											
<input type="text" value="" id="body_accident_type_other" style="border: none; border-bottom-style: dotted; width: 150px;"
												name="AccidentInvestigation[body_accident_type_other]" />
										</div>
										<div id="divReq-bodyAccident1"></div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">รายละเอียดการรักษา:<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="treat_detail"
												class="form-control" name="AccidentInvestigation[treat_detail]" />
										</div>
										<div id="divReq-treat_detail"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">จำนวนวันที่หยุดงานจริง:<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="leave_day"
												class="form-control" name="AccidentInvestigation[leave_day]" />
										</div>
										<div id="divReq-leave_day">วัน </div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">พยานผู้พบเห็นเหตุการณ์:<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="eyewitnesses"
												class="form-control" name="AccidentInvestigation[eyewitnesses]" />
										</div>
										<div id="divReq-eyewitnesses">วัน </div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">

										<label class="control-label col-md-4">ลักษณะเหตุการณ์เกิดขึ้นได้อย่างไร :
										</label>
										<div class="col-md-4">
											<textarea rows="5" cols="70" id="accident_event_happen"
												name="AccidentInvestigation[accident_event_happen]"></textarea>

										</div>
										<div id="divReq-accident_event_happen"></div>
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
										<label class="control-label col-md-4">ประเภทของการเกิดอุบัติเหตุ
											:<span class="required">*</span>
										</label>
										<div class="col-md-8">

											<input type="checkbox" checked="checked" id="accident_type1"
												name="accident_type[]" value="1" />อุบัติเหตุทางเคมี <input
												type="checkbox" id="accident_type2" name="accident_type[]"
												value="2" />อุบัติเหตุทางชีวภาพ <input type="checkbox"
												id="accident_type3" name="accident_type[]" value="3" />อุบัติเหตุทางรังสี
											<input type="checkbox" id="accident_type4"
												name="accident_type[]" value="4" />อุบัติเหตุทางไฟฟ้า <input
												type="checkbox" id="accident_type5" name="accident_type[]"
												value="5" />อัคคีภัย <input type="checkbox"
												id="accident_type6" name="accident_type[]" value="6" />อื่นๆ
											(โปรดระบุ) <input type="text" value=""
												id="accident_type6_other"
												style="border: none; border-bottom-style: dotted; width: 150px;"
												name="AccidentInvestigation[accident_type6_other]" />
										</div>
										<div id="divReq-accident_type1"></div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">ส่วนงานของท่านเคยเกิดเหตุการณ์ลักษณะใกล้เคียงครั้งนี้ 
											:<span class="required">*</span>
										</label>
										<div class="col-md-8"> 
 
<input type="radio" id="ever_happen1" name="AccidentInvestigation[ever_happen]" value="1" checked="checked" />เคย (โปรดระบุ)      																		
<input type="text" value="" id="ever_happen1_other" style="border: none; border-bottom-style: dotted; width: 150px;"
												name="AccidentInvestigation[ever_happen1_other]" />ครั้ง
<input type="radio" id="ever_happen2" name="AccidentInvestigation[ever_happen]" value="2" />ไม่เคย
										</div>
										<div id="divReq-bodyAccident1"></div>
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
									class="fa fa-user"></i> Section 3 : การวิเคราะห์หาสาเหตุ (Accident Analysis) </a>
							</h4>
						</div>
						<div id="collapse_3" class="panel-collapse in">
							<br>
							
														<div class="row">
								<div class="col-md-10">
									<div class="form-group">

										<label class="control-label col-md-2">
										</label>
										<div class="col-md-8">
											<textarea rows="5" cols="90" id="accident_cause"
												name="AccidentInvestigation[accident_cause]"></textarea>

										</div>
										<div id="divReq-accident_cause"></div>
									</div>
								</div>
							</div>

						</div>
					</div>
					
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse"
									data-parent="#accordion4" href="#collapse_4"><i
									class="fa fa-user"></i> Section 4 : ความเสียหายจากการเกิดอุบัติเหตุ</a>
							</h4>
						</div>
						<div id="collapse_4" class="panel-collapse in">
							<br>
							
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-2"> 
											
										</label>
										<div class="col-md-8">
<table>





	<tr>
		<td>
			<input type="radio" checked="checked" id="accidental_damage_type" name="AccidentInvestigation[accidental_damage_type]" value="1" />เสียชีวิต จำนวน
		</td>
		<td>
			<input type="text" value="" id="accidental_damage1" style="border: none; border-bottom-style: dotted; width: 150px;"
			name="AccidentInvestigation[accidental_damage1]" />
		</td>
		<td>
		ราย
		</td>
	</tr>

	<tr>
		<td>
			<input type="radio" id="accidental_damage_type" name="AccidentInvestigation[accidental_damage_type]" value="2" />สูญเสียอวัยวะ/ทุพพลภาพ จำนวน 
		</td>
		<td>
			<input type="text" value="" id="accidental_damage2" style="border: none; border-bottom-style: dotted; width: 150px;"
			name="AccidentInvestigation[accidental_damage2]" />
		</td>
		<td>
		ราย
		</td>
	</tr>

	<tr>
		<td>
			<input type="radio" id="accidental_damage_type" name="AccidentInvestigation[accidental_damage_type]" value="3" />บาดเจ็บ/เจ็บป่วย จำนวน  
		</td>
		<td>
			<input type="text" value="" id="accidental_damage3" style="border: none; border-bottom-style: dotted; width: 150px;"
			name="AccidentInvestigation[accidental_damage3]" />
		</td>
		<td>
		ราย
		</td>
	</tr>

	<tr>
		<td>
			<input type="radio" id="accidental_damage_type" name="AccidentInvestigation[accidental_damage_type]" value="4" />ทรัพย์สินเสียหาย จำนวน  
		</td>
		<td>
			<input type="text" value="" id="accidental_damage4" style="border: none; border-bottom-style: dotted; width: 150px;"
			name="AccidentInvestigation[accidental_damage4]" />
		</td>
		<td>
		บาท
		</td>
	</tr>

	<tr>
	<td>โปรดระบุรายละเอียด</td>
		<td colspan="2">

			<input type="text" value="" id="accidental_damage4_other" style="border: none; border-bottom-style: dotted; width: 150px;"
			name="AccidentInvestigation[accidental_damage4_other]" />
		</td>
	</tr>
	
	<tr>
		<td>
			<input type="radio" id="accidental_damage_type" name="AccidentInvestigation[accidental_damage_type]" value="5" />มีการหยุดการปฏิบัติงาน จำนวนวันที่หยุดการปฏิบัติงาน  
		</td>
		<td>
			<input type="text" value="" id="accidental_damage5" style="border: none; border-bottom-style: dotted; width: 150px;"
			name="AccidentInvestigation[accidental_damage5]" />
		</td>
		<td>
		วัน
		</td>
	</tr>
</table>

												
										</div>
										<div id="divReq-accidental_damage_type"></div>
									</div>
								</div>
							</div>

						</div>
					</div>		
					
					
							<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse"
									data-parent="#accordion5" href="#collapse_5"><i
									class="fa fa-user"></i> รายชื่อผู้เสียชีวิต/ บาดเจ็บ</a>
							</h4>
						</div>
						<div id="collapse_5" class="panel-collapse in">
							<br>

							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-2">
										</label>
										<div class="col-md-8">
											<input type="radio" checked="checked" id="lost_type"
												name="AccidentInvestigation[lost_type]" value="1" /> เสียชีวิต
											<input type="radio" id="lost_type"
												name="AccidentInvestigation[lost_type]" value="2" />
											สูญเสียอวัยวะ/ทุพพลภาพ          
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input
												type="radio" id="lost_type" name="AccidentInvestigation[lost_type]"
												value="3" /> บาดเจ็บ/เจ็บป่วย
												
										</div>
										<div id="divReq-name"></div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-2">
										</label>
										<div class="col-md-10">
<table>
<tr>
<td>1.</td>
<td>ชื่อ – สกุล </td>
<td>
	<input type="text" value="" id="accident_name1" style="border: none; border-bottom-style: dotted; width: 150px;"
			name="AccidentInvestigation[accident_name1]" />
</td>
<td> อายุ </td>
<td>
	<input type="text" value="" id="accident_age1" style="border: none; border-bottom-style: dotted; width: 50px;"
			name="AccidentInvestigation[accident_age1]" />
</td>
<td>ปี เพศ</td>
<td>
	<input type="text" value="" id="accident_year1" style="border: none; border-bottom-style: dotted; width: 50px;"
			name="AccidentInvestigation[accident_year1]" />
</td>
<td>ตำแหน่ง</td>
<td>
	<input type="text" value="" id="accident_position1" style="border: none; border-bottom-style: dotted; width: 150px;"
			name="AccidentInvestigation[accident_position1]" />
</td>
</tr>

<tr>
<td></td>
<td colspan="2">(กรณีที่บาดเจ็บ) อวัยวะที่บาดเจ็บ </td>
<td colspan="2">
	<input type="text" value="" id="dammage_body1" style="border: none; border-bottom-style: dotted; width: 150px;"
			name="AccidentInvestigation[dammage_body1]" />
</td>
<td colspan="2">ลักษณะการบาดเจ็บ </td>
<td colspan="3">
	<input type="text" value="" id="dammage_body_desc1" style="border: none; border-bottom-style: dotted; width: 150px;"
			name="AccidentInvestigation[dammage_body_desc1]" />
</td>
</tr>
<tr>
<td>2.</td>
<td>ชื่อ – สกุล </td>
<td>
	<input type="text" value="" id="accident_name2" style="border: none; border-bottom-style: dotted; width: 150px;"
			name="AccidentInvestigation[accident_name2]" />
</td>
<td> อายุ </td>
<td>
	<input type="text" value="" id="accident_age2" style="border: none; border-bottom-style: dotted; width: 50px;"
			name="AccidentInvestigation[accident_age2]" />
</td>
<td>ปี เพศ</td>
<td>
	<input type="text" value="" id="accident_year2" style="border: none; border-bottom-style: dotted; width: 50px;"
			name="AccidentInvestigation[accident_year2]" />
</td>
<td>ตำแหน่ง</td>
<td>
	<input type="text" value="" id="accident_position2" style="border: none; border-bottom-style: dotted; width: 150px;"
			name="AccidentInvestigation[accident_position2]" />
</td>
</tr>

<tr>
<td></td>
<td colspan="2">(กรณีที่บาดเจ็บ) อวัยวะที่บาดเจ็บ </td>
<td colspan="2">
	<input type="text" value="" id="dammage_body2" style="border: none; border-bottom-style: dotted; width: 150px;"
			name="AccidentInvestigation[dammage_body2]" />
</td>
<td colspan="2">ลักษณะการบาดเจ็บ </td>
<td colspan="3">
	<input type="text" value="" id="dammage_body_desc2" style="border: none; border-bottom-style: dotted; width: 150px;"
			name="AccidentInvestigation[dammage_body_desc2]" />
</td>
</tr>

<tr>
<td>3.</td>
<td>ชื่อ – สกุล </td>
<td>
	<input type="text" value="" id="accident_name3" style="border: none; border-bottom-style: dotted; width: 150px;"
			name="AccidentInvestigation[accident_name3]" />
</td>
<td> อายุ </td>
<td>
	<input type="text" value="" id="accident_age3" style="border: none; border-bottom-style: dotted; width: 50px;"
			name="AccidentInvestigation[accident_age3]" />
</td>
<td>ปี เพศ</td>
<td>
	<input type="text" value="" id="accident_year3" style="border: none; border-bottom-style: dotted; width: 50px;"
			name="AccidentInvestigation[accident_year3]" />
</td>
<td>ตำแหน่ง</td>
<td>
	<input type="text" value="" id="accident_position3" style="border: none; border-bottom-style: dotted; width: 150px;"
			name="AccidentInvestigation[accident_position3]" />
</td>
</tr>

<tr>
<td></td>
<td colspan="2">(กรณีที่บาดเจ็บ) อวัยวะที่บาดเจ็บ </td>
<td colspan="2">
	<input type="text" value="" id="dammage_body3" style="border: none; border-bottom-style: dotted; width: 150px;"
			name="AccidentInvestigation[dammage_body3]" />
</td>
<td colspan="2">ลักษณะการบาดเจ็บ </td>
<td colspan="3">
	<input type="text" value="" id="dammage_body_desc3" style="border: none; border-bottom-style: dotted; width: 150px;"
			name="AccidentInvestigation[dammage_body_desc3]" />
</td>
</tr>

</table>
												
										</div>
										<div id="divReq-dammage_body1"></div>
									</div>
								</div>
							</div>		
						</div>
					</div>
				
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse"
									data-parent="#accordion6" href="#collapse_6"><i
									class="fa fa-user"></i> Section 5 : การดำเนินการแก้ไขและการป้องกันไม่ให้เกิดซ้ำ (Corrective and Preventive action) </a>
							</h4>
						</div>
						<div id="collapse_6" class="panel-collapse in">
							<br>
<div class="row">
								<div class="col-md-10">
									<div class="form-group">

										<label class="control-label col-md-4">การแก้ไขเบื้องต้นที่ได้กระทำไปแล้ว
											: </label>
										<div class="col-md-4">
											<textarea rows="5" cols="70" id="accident_solve"
												name="AccidentInvestigation[accident_solve]"></textarea>

										</div>
										<div id="divReq-accident_solve"></div>
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
<div class="row">
								<div class="col-md-10">
									<div class="form-group">

										<label class="control-label col-md-4">การดำเนินการแก้ไขและป้องกันเพื่อไม่ให้เกิดซ้ำ 
											: </label>
										<div class="col-md-4">
											<textarea rows="5" cols="70" id="accident_protect"
												name="AccidentInvestigation[accident_protect]"></textarea>

										</div>
										<div id="divReq-accident_protect"></div>
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
														type="file" name="img3[]">
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
						
							
<!-- END -->
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