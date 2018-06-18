<?php
$criteria = new CDbCriteria();
$departments = MDepartment::model()->findAll();

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
											<div class="mt-radio-list">
												<table>
													<tr>
														<td><input type="radio" checked="checked" id="person_type"
															name="" value="1" /></td>
														<td>พนักงานมหาวิทยาลัย</td>
														<td></td>
													</tr>
													<tr>
														<td><input type="radio" id="person_type"
															name="" value="2" /></td>
														<td>พนักงานที่ปฏิบัติงานในนามบริษัท/ ลูกจ้างชั่วคราว</td>
														<td></td>
													</tr>
													<tr>
														<td><input type="radio" id="person_type"
															name="" value="3" /></td>
														<td>บุคคลภายนอกที่เข้ามาใช้บริการ</td>
														<td></td>
													</tr>
													<tr>
														<td><input type="radio" id="person_type"
															name="" value="4" /></td>
														<td>นักศึกษา</td>
														<td></td>
													</tr>
													<tr>
														<td><input type="radio" id="person_type"
															name="AccidentInvestigation[person_type]" value="5" /></td>
														<td>อื่นๆ<input type="text" value=""
															id="person_type_other"
															style="border: none; border-bottom-style: dotted; width: 150px; text-align: left;"
															name="" /></td>
													</tr>

												</table>


											</div>
										</div>
										<div id="divReq-person_type"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">ประเภทความเสียหาย </label>
										<div class="col-md-8">
											<input type="radio" checked="checked" id="person_lost_type"
												name="" value="1" />
											เสียชีวิต <input type="radio" id="person_lost_type"
												name="" value="2" />
											สูญเสียอวัยวะ/ทุพพลภาพ
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input
												type="radio" id="person_lost_type"
												name="" value="3" />
											บาดเจ็บ/เจ็บป่วย

										</div>
										<div id="divReq-person_lost_type"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">เพศ:<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<div class="mt-radio-list">
												<input type="radio" checked="checked" id="person_sex"
													name="" value="1" />ชาย <input
													type="radio" id="person_sex"
													name="" value="2" />หญิง
											</div>



										</div>
										<div id="divReq-person_sex"></div>
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
											<input id="person_name" type="text" value="" class="form-control"
												name="">

										</div>
										<div id="divReq-person_name"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">อายุ:<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="person_age"
												class="form-control allowNum"
												name="" />

										</div>
										<div>ปี</div>
										<div id="divReq-person_age"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">ตำแหน่ง/ชั้นปี:<span
											class="required"></span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="person_position"
												class="form-control"
												name="" />

										</div>
										<div id="divReq-person_position"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">คณะ/ส่วนงาน:<span
											class="required"></span></label>
										<div class="col-md-6">
											<select class="form-control select2"
												name=""
												id="person_department_id">
												<option value="-1">-- (ไม่มีสังกัด) --</option>
			<?php foreach($departments as $item) {?>
			<option value="<?php echo $item->id?>"><?php echo (($item->faculty_id < 0)? '' : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- '). $item->name?></option>
			<?php }?>
			</select>

										</div>
										<div id="divReq-person_department_id"></div>
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
											<input type="text" value="" id="person_responsibility"
												class="form-control"
												name="" />
										</div>
										<div id="divReq-person_responsibility"></div>
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
											<input type="text" value="" id="person_work_period"
												class="form-control allowNum"
												name="" />
										</div>
										<div>วัน</div>
										<div id="divReq-person_work_period"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">(กรณีที่บาดเจ็บ)
											อวัยวะที่บาดเจ็บ:<span class="required"></span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="person_dammage_body"
												class="form-control"
												name="" />
										</div>
										<div id="divReq-person_dammage_body"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">ลักษณะการบาดเจ็บ:<span
											class="required"></span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="person_dammage_body_desc"
												class="form-control"
												name="" />
										</div>
										<div id="divReq-person_dammage_body_desc"></div>
									</div>
								</div>
							</div>

						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-1"><span class="required"></span>
									</label>

									<div class="col-md-10">


										<br>
										<table>
											<tr>
												<td><button type="button" class="sm btn green" id="btnAdd">เพิ่ม (+)</button></td>
											</tr>
										</table>
<br>
							<div class="table-scrollable">

										<table class="table table-striped table-bordered table-hover"
											id="tData">
											<thead>
												<tr>
													<th style="font-size: xx-small; text-align: center;"></th>
													<th style="font-size: xx-small; text-align: center;">รายละเอียดของผู้ประสบเหตุ</th>
													<th style="font-size: xx-small; text-align: center;">ประเภทความเสียหาย</th>
													<th style="font-size: xx-small; text-align: center;">เพศ</th>
													<th style="font-size: xx-small; text-align: center;">ชื่อ-นามสุกล</th>
													<th style="font-size: xx-small; text-align: center;">อายุ</th>

													<th style="font-size: xx-small; text-align: center;">ตำแหน่ง/ชั้นปี</th>
													<th style="font-size: xx-small; text-align: center;">คณะ/ส่วนงาน</th>
													<th style="font-size: xx-small; text-align: center;">หน้าที่</th>
													<th style="font-size: xx-small; text-align: center;">ระยะเวลาปฏิบัติงาน</th>
													<th style="font-size: xx-small; text-align: center;">อวัยวะที่บาดเจ็บ</th>
													<th style="font-size: xx-small; text-align: center;">ลักษณะการบาดเจ็บ</th>
													<th style="font-size: xx-small; text-align: center;"></th>
													
												</tr>
											</thead>
											<tbody>

											</tbody>

										</table>
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
											<div class="input-group date date-picker"
												data-date-format="dd-mm-yyyy">
												<input type="text"
													value="<?php echo CommonUtil::getCurDate();?>"
													id="case_date" class="form-control"
													name="AccidentInvestigation[case_date]" /> <span
													class="input-group-btn">
													<button class="btn default" type="button">
														<i class="fa fa-calendar"></i>
													</button>
												</span>
											</div>


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
												class="form-control"
												name="AccidentInvestigation[accident_location]" />
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
												class="form-control"
												name="AccidentInvestigation[activity_at_accident]" />
										</div>
										<div id="divReq-activity_at_accident"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">จำนวนผู้ปฏิบัติงานในช่วงเวลาที่เกิดเหตุ
											:<span class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="count_work_person"
												class="form-control allowNum"
												name="AccidentInvestigation[count_work_person]" />
										</div>
										<div id="divReq-count_work_person">คน</div>
									</div>
								</div>
							</div>


							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">อวัยวะที่ได้รับบาดเจ็บ :<span
											class="required">*</span>
										</label>
										<div class="col-md-8">

											<input type="checkbox" checked="checked" id="bodyAccident1"
												name="bodyAccidentInvestigation[]" value="1" />ศีรษะ/ ลำคอ /
											ใบหน้า <input type="checkbox" id="bodyAccident2"
												name="bodyAccidentInvestigation[]" value="2" />ตา <input
												type="checkbox" id="bodyAccident3"
												name="bodyAccidentInvestigation[]" value="3" /> หลัง/ ไหล่ <input
												type="checkbox" id="bodyAccident4"
												name="bodyAccidentInvestigation[]" value="4" /> ลำตัว <input
												type="checkbox" id="bodyAccident5"
												name="bodyAccidentInvestigation[]" value="5" /> แขน <input
												type="checkbox" id="bodyAccident6"
												name="bodyAccidentInvestigation[]" value="6" /> มือ/นิ้วมือ
											<input type="checkbox" id="bodyAccident7"
												name="bodyAccidentInvestigation[]" value="7" /> ขา <input
												type="checkbox" id="bodyAccident8"
												name="bodyAccidentInvestigation[]" value="8" /> เท้า/
											นิ้วเท้า <input type="checkbox" id="bodyAccident9"
												name="bodyAccidentInvestigation[]" value="9" />
											บาดเจ็บหลายส่วน <input type="checkbox" id="bodyAccident10"
												name="bodyAccidentInvestigation[]" value="10" /> อื่นๆ <input
												type="text" value="" id="body_accident_type_other"
												style="border: none; border-bottom-style: dotted; width: 150px;"
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
												class="form-control"
												name="AccidentInvestigation[treat_detail]" />
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
												class="form-control allowNum" name="AccidentInvestigation[leave_day]" />
										</div>
										<div id="divReq-leave_day">วัน</div>
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
												class="form-control"
												name="AccidentInvestigation[eyewitnesses]" />
										</div>
										<div id="divReq-eyewitnesses"></div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-10">
									<div class="form-group">

										<label class="control-label col-md-4">ลักษณะเหตุการณ์เกิดขึ้นได้อย่างไร
											: </label>
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
											<div class="row fileupload-buttonbar">
												<div class="col-lg-7">
													<!-- The fileinput-button span is used to style the file input field as button -->
													<span class="btn green fileinput-button"> <input
														type="file" name="img1[]" multiple="multiple">
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

											<input type="radio" id="ever_happen1"
												name="AccidentInvestigation[ever_happen]" value="1"
												/>เคย (โปรดระบุ) <input type="text"
												value="" id="ever_happen1_other"
												style="border: none; border-bottom-style: dotted; width: 150px;" class='allowNum'
												name="AccidentInvestigation[ever_happen1_other]" />ครั้ง <input
												type="radio" id="ever_happen2"
												name="AccidentInvestigation[ever_happen]" value="2" checked="checked"  />ไม่เคย
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
									class="fa fa-user"></i> Section 3 : การวิเคราะห์หาสาเหตุ
									(Accident Analysis) </a>
							</h4>
						</div>
						<div id="collapse_3" class="panel-collapse in">
							<br>

							<div class="row">
								<div class="col-md-10">
									<div class="form-group">

										<label class="control-label col-md-2"> </label>
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
									class="fa fa-user"></i> Section 4 :
									ความเสียหายจากการเกิดอุบัติเหตุ</a>
							</h4>
						</div>
						<div id="collapse_4" class="panel-collapse in">
							<br>

							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-2"> </label>
										<div class="col-md-8">
											<table>





												<tr>
													<td><input type="radio" checked="checked" class="rdDamageTypeCls"
														id="accidental_damage_type"
														name="AccidentInvestigation[accidental_damage_type]"
														value="1" />เสียชีวิต จำนวน</td>
													<td><input type="text" value="" id="accidental_damage1" class='allowNum'
														style="border: none; border-bottom-style: dotted; width: 150px;"
														name="AccidentInvestigation[accidental_damage1]" /></td>
													<td>ราย</td>
												</tr>

												<tr>
													<td><input type="radio" id="accidental_damage_type" class="rdDamageTypeCls"
														name="AccidentInvestigation[accidental_damage_type]"
														value="2" />สูญเสียอวัยวะ/ทุพพลภาพ จำนวน</td>
													<td><input type="text" value="" id="accidental_damage2" class='allowNum'
														style="border: none; border-bottom-style: dotted; width: 150px;"
														name="AccidentInvestigation[accidental_damage2]" /></td>
													<td>ราย</td>
												</tr>

												<tr>
													<td><input type="radio" id="accidental_damage_type" class="rdDamageTypeCls"
														name="AccidentInvestigation[accidental_damage_type]"
														value="3" />บาดเจ็บ/เจ็บป่วย จำนวน</td>
													<td><input type="text" value="" id="accidental_damage3" class='allowNum'
														style="border: none; border-bottom-style: dotted; width: 150px;"
														name="AccidentInvestigation[accidental_damage3]" /></td>
													<td>ราย</td>
												</tr>

												<tr>
													<td><input type="radio" id="accidental_damage_type" class="rdDamageTypeCls"
														name="AccidentInvestigation[accidental_damage_type]"
														value="4" />ทรัพย์สินเสียหาย จำนวน</td>
													<td><input type="text" value="" id="accidental_damage4" class='allowNum'
														style="border: none; border-bottom-style: dotted; width: 150px;"
														name="AccidentInvestigation[accidental_damage4]" /></td>
													<td>บาท</td>
												</tr>

												<tr>
													<td>โปรดระบุรายละเอียด</td>
													<td colspan="2"><input type="text" value=""
														id="accidental_damage4_other"
														style="border: none; border-bottom-style: dotted; width: 150px;"
														name="AccidentInvestigation[accidental_damage4_other]" />
													</td>
												</tr>

												<tr>
													<td><input type="radio" id="accidental_damage_type" class="rdDamageTypeCls"
														name="AccidentInvestigation[accidental_damage_type]"
														value="5" />มีการหยุดการปฏิบัติงาน
														จำนวนวันที่หยุดการปฏิบัติงาน</td>
													<td><input type="text" value="" id="accidental_damage5" class='allowNum'
														style="border: none; border-bottom-style: dotted; width: 150px;"
														name="AccidentInvestigation[accidental_damage5]" /></td>
													<td>วัน</td>
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
									data-parent="#accordion6" href="#collapse_6"><i
									class="fa fa-user"></i> Section 5 :
									การดำเนินการแก้ไขและการป้องกันไม่ให้เกิดซ้ำ (Corrective and
									Preventive action) </a>
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

											<div class="row fileupload-buttonbar">
												<div class="col-lg-7">
													<!-- The fileinput-button span is used to style the file input field as button -->
													<span class="btn green fileinput-button"> <input
														type="file" name="img2[]" multiple="multiple">
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
											<div class="row fileupload-buttonbar">
												<div class="col-lg-7">
													<!-- The fileinput-button span is used to style the file input field as button -->
													<span class="btn green fileinput-button"> <input
														type="file" name="img3[]" multiple="multiple">
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
								<?php echo CHtml::link(ConfigUtil::getBtnCancelButton(),array('AccidentInvestigation/'),array('class'=>'btn btn-default uppercase'));?>
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

        
        $('#btnAdd').click(function (event) {
            	var txt_person_type = $('#person_type').val();
            	var txt_person_type_other = $('#person_type_other').val();
            	var txt_person_lost_type = $('#person_lost_type').val();
            	
            	var txt_person_sex = $('#person_sex').val();
            	var txt_person_name = $('#person_name').val();
            	var txt_person_age = $('#person_age').val();
            	var txt_person_position = $('#person_position').val();
            	var txt_person_department_id = $('#person_department_id').val();
            	var txt_person_responsibility = $('#person_responsibility').val();
            	var txt_person_work_period = $('#person_work_period').val();
            	var txt_person_dammage_body = $('#person_dammage_body').val();
            	var txt_person_dammage_body_desc = $('#person_dammage_body_desc').val();
            	
    	    	var rowCount = $('#tData tr').length;
    	    	var rid = uniqId();
    	    	
	    	$('#tData > tbody:last').append('<tr id="r'+(rid)+'"><td style="text-align: center;">'+(rowCount)+'.</td>'+
	    			'<td><input style="width : 100px !important;" id="person_type" type="hidden" value="'+txt_person_type+'" class="form-control" name="person_types[]">'+
	    			'<input style="width : 100px !important;" id="hperson_type" type="label" value="'+getPersonPype(txt_person_type)+'" class="form-control" readonly="readonly"></td>'+

	    			'<td><input style="width : 100px !important;" id="person_lost_type" type="hidden" value="'+txt_person_lost_type+'" class="form-control" name="person_lost_types[]">'+
	    			'<input style="width : 100px !important;" id="person_lost_type" type="label" value="'+getpersonLostType(txt_person_lost_type)+'" class="form-control" readonly="readonly"></td>'+
	    		
	    			'<td><input style="width : 100px !important;" id="person_sex" type="hidden" value="'+txt_person_sex+'"class="form-control" name="person_sexs[]">'+
	    			'<input style="width : 100px !important;" id="hperson_sex" type="label" value="'+getPersonSex(txt_person_sex)+'" class="form-control" readonly="readonly"></td>'+
	    			
	    			'<td><input style="width : 100px !important;" id="person_name" type="label" value="'+txt_person_name+'"class="form-control" name="person_names[]" readonly="readonly"></td>'+
	    			'<td><input style="width : 60px !important;" id="person_age" type="label" value="'+txt_person_age+'"class="form-control" name="person_ages[]" readonly="readonly"></td>'+
	    			'<td><input style="width : 60px !important;" id="person_position" type="label" value="'+txt_person_position+'"class="form-control" name="person_positions[]" readonly="readonly"></td>'+

	    			'<td><input style="width : 100px !important;" id="person_department_id" type="hidden" value="'+txt_person_department_id+'" class="form-control" name="person_department_ids[]">'+
	    			'<input style="width : 100px !important;" id="person_department_id" type="label" value="'+getPersonDepartment(txt_person_department_id)+'" class="form-control" readonly="readonly"></td>'+
	    			
	    			'<td><input style="width : 60px !important;" id="person_responsibility" type="label" value="'+txt_person_responsibility+'"class="form-control" name="person_responsibilitys[]" readonly="readonly"></td>'+
	    			'<td><input style="width : 60px !important;" id="person_work_period" type="label" value="'+txt_person_work_period+'"class="form-control" name="person_work_periods[]" readonly="readonly"></td>'+
	    			'<td><input style="width : 60px !important;" id="person_dammage_body" type="label" value="'+txt_person_dammage_body+'"class="form-control" name="person_dammage_bodys[]" readonly="readonly"></td>'+
	    			'<td><input style="width : 60px !important;" id="person_dammage_body_desc" type="label" value="'+txt_person_dammage_body_desc+'"class="form-control" name="person_dammage_body_descs[]" readonly="readonly"></td>'+

	    			'<td style="text-align: center;"><button type="button" class="btn red uppercase" id="btnAdd" onclick="return deleteElement(r'+(rid)+');">ลบ</button></td>'+
	    	    	'</tr>'); 

// 	    	 $('#txt_pathogen_name').val('');
// 	    	 $('#txt_pathogen_code').val('');
// 	    	 $('#txt_pathogen_volume').val('');
// 	    	 $('#txt_supervisor').val('');
// 	    	 $('#txt_manufacture_plant').val('');
// 	    	 $('#txt_manufacture_fuse').val('');
// 	    	 $('#txt_manufacture_prepare').val('');
// 	    	 $('#txt_manufacture_transform').val('');
// 	    	 $('#txt_manufacture_packing').val('');
// 	    	 $('#txt_manufacture_total_packing').val('');
// 	    	 $('#txt_distribute_sell').val('');
// 	    	 $('#txt_distribute_pay').val('');
// 	    	 $('#txt_distribute_give').val('');
// 	    	 $('#txt_distribute_exchange').val('');
// 	    	 $('#txt_distribute_donate').val('');
// 	    	 $('#txt_distribute_lost').val('');
// 	    	 $('#txt_distribute_discard').val('');
// 	    	 $('#txt_distribute_destroy').val('');
// 	    	 $('#txt_import').val('');
// 	    	 $('#txt_export').val('');
// 	    	 $('#txt_import_to_other').val('');
	    	
     });
    	$( "#Form1" ).submit(function( event ) {
        	
     		$row_count = $('#tData tbody tr').length;
    		if($row_count == 0){
        		alert('ยังไม่ได้เพิ่มรายงาน\n(กดปุ่ม+ เพื่อเพิ่มรายการก่อนบันทึก)');
				return false;
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
        	if($("#accident_location").val().length == 0){
        		$("#accident_location").closest('.form-group').addClass('has-error');
        		$("#divReq-accident_location").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#accident_location").focus();
        		return false;
            }else{
            	$("#divReq-accident_location").html('');
            	$("#accident_location").closest('.form-group').removeClass('has-error');
        	}
        	if($("#activity_at_accident").val().length == 0){
        		$("#activity_at_accident").closest('.form-group').addClass('has-error');
        		$("#divReq-activity_at_accident").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#activity_at_accident").focus();
        		return false;
            }else{
            	$("#divReq-activity_at_accident").html('');
            	$("#activity_at_accident").closest('.form-group').removeClass('has-error');
        	}
        	if($("#count_work_person").val().length == 0){
        		$("#count_work_person").closest('.form-group').addClass('has-error');
        		$("#divReq-count_work_person").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#count_work_person").focus();
        		return false;
            }else{
            	$("#divReq-count_work_person").html('');
            	$("#count_work_person").closest('.form-group').removeClass('has-error');
        	}
//         	bodyAccident1 - 10	|RD
        	if($("#treat_detail").val().length == 0){
        		$("#treat_detail").closest('.form-group').addClass('has-error');
        		$("#divReq-treat_detail").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#treat_detail").focus();
        		return false;
            }else{
            	$("#divReq-treat_detail").html('');
            	$("#treat_detail").closest('.form-group').removeClass('has-error');
        	}
        	if($("#leave_day").val().length == 0){
        		$("#leave_day").closest('.form-group').addClass('has-error');
        		$("#divReq-leave_day").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#leave_day").focus();
        		return false;
            }else{
            	$("#divReq-leave_day").html('');
            	$("#leave_day").closest('.form-group').removeClass('has-error');
        	}
        	if($("#eyewitnesses").val().length == 0){
        		$("#eyewitnesses").closest('.form-group').addClass('has-error');
        		$("#divReq-eyewitnesses").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#eyewitnesses").focus();
        		return false;
            }else{
            	$("#divReq-eyewitnesses").html('');
            	$("#eyewitnesses").closest('.form-group').removeClass('has-error');
        	}
        	if($("#accident_event_happen").val().length == 0){
        		$("#accident_event_happen").closest('.form-group').addClass('has-error');
        		$("#divReq-accident_event_happen").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#accident_event_happen").focus();
        		return false;
            }else{
            	$("#divReq-accident_event_happen").html('');
            	$("#accident_event_happen").closest('.form-group').removeClass('has-error');
        	}
        	//accident_type1 - 6	|RD
        	//ever_happen1 -2   	|RD
        	if($("#accident_cause").val().length == 0){
        		$("#accident_cause").closest('.form-group').addClass('has-error');
        		$("#divReq-accident_cause").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#accident_cause").focus();
        		return false;
            }else{
            	$("#divReq-accident_cause").html('');
            	$("#accident_cause").closest('.form-group').removeClass('has-error');
        	}
        	//accidental_damage_type	|RD
        	var damageType = $('.rdDamageTypeCls:checked').val();
			switch(damageType){
    			case "1":
    				if($("#accidental_damage1").val().length == 0){
        				alert('ระบุจำนวนผู้เสียชีวิต');
						return false;
        			}
        			break;
    			case "2":
    				if($("#accidental_damage2").val().length == 0){
        				alert('ระบุจำนวนผู้สูญเสียอวัยวะ/ทุพพลภาพ');
						return false;
        			}
        			break;
    			case "3":
       				if($("#accidental_damage3").val().length == 0){
        				alert('ระบุจำนวนผู้บาดเจ็บ/เจ็บป่วย');
						return false;
        			}
        			break;
    			case "4":
       				if($("#accidental_damage4").val().length == 0){
        				alert('ระบุจำนวนผู้ทรัพย์สินเสียหาย');
						return false;
        			}
        			break;
    			case "5":
       				if($("#accidental_damage5").val().length == 0){
        				alert('ระบุจำนวนวันที่หยุดการปฏิบัติงาน');
						return false;
        			}
        			break;
			}
        	//accidental_damage1 - 5	|RD
        	if($("#accident_solve").val().length == 0){
        		$("#accident_solve").closest('.form-group').addClass('has-error');
        		$("#divReq-accident_solve").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#accident_solve").focus();
        		return false;
            }else{
            	$("#divReq-accident_solve").html('');
            	$("#accident_solve").closest('.form-group').removeClass('has-error');
        	}
        	if($("#accident_protect").val().length == 0){
        		$("#accident_protect").closest('.form-group').addClass('has-error');
        		$("#divReq-accident_protect").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#accident_protect").focus();
        		return false;
            }else{
            	$("#divReq-accident_protect").html('');
            	$("#accident_protect").closest('.form-group').removeClass('has-error');
        	}
        	this.submit();
    	});
    });
    
    function uniqId() {
   		return Math.round(new Date().getTime() + (Math.random() * 100));
    }
    function deleteElement(id){
        $("#"+id.id).remove();
    }
    function getpersonLostType($val){
        return 'dsafasdf';
    }
    function getPersonPype($val) {
   		return 'xxxx1';
    }
    function getPersonSex($val){
		return 'yyyy2';
   	}
    function getPersonDepartment($val){
		return 'yyyy2asdf';
   	}
</script>

</form>