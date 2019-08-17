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
									class="fa fa-newspaper-o"></i> ข้อมูลผู้รายงาน
								</a>
							</h4>
						</div>
						<div id="collapse_1" class="panel-collapse in">
							<br>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">ชื่อผู้รายงาน :<span
											class="required">*</span>
										</label>

										<div class="col-md-4">
											<input id="report_name" type="text"
												value="<?php echo $data->report_name;?>"
												class="form-control"
												name="AccidentInvestigation[report_name]">
										</div>
										<div id="divReq-report_name"></div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">ตำแหน่ง :<span
											class="required">*</span>
										</label>

										<div class="col-md-4">
											<input id="report_position" type="text"
												value="<?php echo $data->report_position;?>"
												class="form-control"
												name="AccidentInvestigation[report_position]">
										</div>
										<div id="divReq-report_position"></div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">วันที่เขียนรายงาน :<span
											class="required">*</span>
										</label>

										<div class="col-md-4">
											<div class="input-group date date-picker"
												data-date-format="dd-mm-yyyy">
												<input type="text"
													value="<?php echo (isset($data->report_date)? CommonUtil::getDateThai($data->report_date) : CommonUtil::getCurDate());?>"
													id="report_date" class="form-control"
													name="AccidentInvestigation[report_date]" /> <span
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
						</div>
					</div>

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
														<td><input type="radio" checked="checked" id="person_type" <?php echo count($persons)>1? '' : ($person->person_type =="1")? 'checked="checked"':''; ?>
															class="rdPersonTypeCls"
															name="AccidentInvestigationPerson[person_type]" value="1"
															class="mt-radio" /></td>
														<td>พนักงานมหาวิทยาลัย</td>
														<td></td>
													</tr>
													<tr>
														<td><input type="radio" id="person_type" <?php echo count($persons)>1? '' : ($person->person_type =="2")? 'checked="checked"':''; ?>
															class="rdPersonTypeCls"
															name="AccidentInvestigationPerson[person_type]" value="2"
															class="mt-radio" /></td>
														<td>พนักงานที่ปฏิบัติงานในนามบริษัท/ ลูกจ้างชั่วคราว</td>
														<td></td>
													</tr>
													<tr>
														<td><input type="radio" id="person_type" <?php echo count($persons)>1? '' : ($person->person_type =="3")? 'checked="checked"':''; ?>
															class="rdPersonTypeCls"
															name="AccidentInvestigationPerson[person_type]" value="3"
															class="mt-radio" /></td>
														<td>บุคคลภายนอกที่เข้ามาใช้บริการ</td>
														<td></td>
													</tr>
													<tr>
														<td><input type="radio" id="person_type" <?php echo count($persons)>1? '' : ($person->person_type =="4")? 'checked="checked"':''; ?>
															class="rdPersonTypeCls"
															name="AccidentInvestigationPerson[person_type]" value="4"
															class="mt-radio" /></td>
														<td>นักศึกษา</td>
														<td></td>
													</tr>
													<tr>
														<td><input type="radio" id="person_type" <?php echo count($persons)>1? '' : ($person->person_type =="5")? 'checked="checked"':''; ?>
															class="rdPersonTypeCls"
															name="AccidentInvestigationPerson[person_type]" value="5"
															class="mt-radio" /></td>
														<td>อื่นๆ<input type="text" value="<?php echo count($persons)>1? '' : $person->person_type_other;?>"
															id="person_type_other"
															style="border: none; border-bottom-style: dotted; width: 150px; text-align: left;"
															name="AccidentInvestigationPerson[person_type_other]" /></td>
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
										<label class="control-label col-md-4">ชื่อ-นามสุกล :<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input id="person_name" type="text" value="<?php echo count($persons)>1? '' : $person->person_name;?>"
												class="form-control"
												name="AccidentInvestigationPerson[person_name]">

										</div>
										<div id="divReq-person_name"></div>
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
											<input type="text" value="<?php echo count($persons)>1? '' : $person->person_position;?>" id="person_position"
												class="form-control"
												name="AccidentInvestigationPerson[person_position]" />

										</div>
										<div id="divReq-person_position"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">คณะ/ส่วนงาน :<span
											class="required"></span></label>
										<div class="col-md-6">
											<select class="form-control"
												name="AccidentInvestigationPerson[person_department_id]"
												id="person_department_id">
												<option value="-1">-- (ไม่มีสังกัด) --</option>
<?php
echo CommonUtil::getDepartment (  count($persons)>1? '' : $person->person_department_id );

?>
			</select>

										</div>
										<div id="divReq-person_department_id"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">หน้าที่ :<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="<?php echo count($persons)>1? '' : $person->person_responsibility;?>" id="person_responsibility"
												class="form-control"
												name="AccidentInvestigationPerson[person_responsibility]" />
										</div>
										<div id="divReq-person_responsibility"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">ระยะเวลาปฏิบัติงาน :<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="<?php echo count($persons)>1? '' : $person->person_work_period;?>" id="person_work_period"
												class="form-control allowNum"
												name="AccidentInvestigationPerson[person_work_period]" />
										</div>
										<div>วัน</div>
										<div id="divReq-person_work_period"></div>
									</div>
								</div>
							</div>
						</div>

						<!-- MERGE SECCION 4 -->
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">ประเภทความเสียหาย : </label>
										<div class="col-md-8">
    										<div class="mt-radio-list">
    											<input type="radio" checked="checked" class="rdPersonLostTypeCls" id="person_lost_type" <?php echo count($persons)>1? '' : ($person->person_lost_type =="1")? 'checked="checked"':''; ?>
    												name="AccidentInvestigationPerson[person_lost_type]" value="1" />
    											เสียชีวิต <input type="radio" class="rdPersonLostTypeCls" id="person_lost_type" <?php echo count($persons)>1? '' : ($person->person_lost_type =="2")? 'checked="checked"':''; ?>
    												name="AccidentInvestigationPerson[person_lost_type]" value="2" />
    											สูญเสียอวัยวะ/ทุพพลภาพ
    											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input
    												type="radio" id="person_lost_type" class="rdPersonLostTypeCls" <?php echo count($persons)>1? '' : ($person->person_lost_type =="3")? 'checked="checked"':''; ?>
    												name="AccidentInvestigationPerson[person_lost_type]" value="3" />
    											บาดเจ็บ/เจ็บป่วย
    										</div>
										</div>
										<div id="divReq-person_lost_type"></div>
									</div>
								</div>
							</div>
						<div class="row">
							<div class="col-md-10">
								<div class="form-group">
									<label class="control-label col-md-4">อายุ :<span
										class="required">*</span>
									</label>
									<div class="col-md-4">
										<input type="text" value="<?php echo count($persons)>1? '' : $person->person_age;?>" id="person_age"
											class="form-control allowNum"
											name="AccidentInvestigationPerson[person_age]" />

									</div>
									<div>ปี</div>
									<div id="divReq-person_age"></div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-10">
								<div class="form-group">
									<label class="control-label col-md-4">เพศ :<span
										class="required">*</span>
									</label>
									<div class="col-md-4">
										<div class="mt-radio-list">
											<input type="radio" id="person_sex" class="rdPersonSexCls" <?php echo count($persons)>1? '' : ($person->person_sex =="1")? 'checked="checked"':''; ?>
												name="AccidentInvestigationPerson[person_sex]" value="1"
												class="mt-radio" checked="checked" />ชาย <input type="radio"
												id="person_sex" class="rdPersonSexCls" <?php echo count($persons)>1? '' : ($person->person_sex =="2")? 'checked="checked"':''; ?>
												name="AccidentInvestigationPerson[person_sex]" value="2"
												class="mt-radio" />หญิง
										</div>
									</div>
									<div id="divReq-person_sex"></div>
								</div>
							</div>
						</div>
						<!-- 
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">ตำแหน่ง/ชั้นปี :<span
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
							 -->
						<div class="row">
							<div class="col-md-10">
								<div class="form-group">
									<label class="control-label col-md-4">(กรณีที่บาดเจ็บ)
										อวัยวะที่บาดเจ็บ :<span class="required"></span>
									</label>
									<div class="col-md-4">
										<input type="text" value="<?php echo count($persons)>1? '' : $person->person_dammage_body;?>" id="person_dammage_body"
											class="form-control"
											name="AccidentInvestigationPerson[person_dammage_body]" />
									</div>
									<div id="divReq-person_dammage_body"></div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-10">
								<div class="form-group">
									<label class="control-label col-md-4">ลักษณะการบาดเจ็บ :<span
										class="required"></span>
									</label>
									<div class="col-md-4">
										<input type="text" value="<?php echo count($persons)>1? '' : $person->person_dammage_body_desc;?>" id="person_dammage_body_desc"
											class="form-control"
											name="AccidentInvestigationPerson[person_dammage_body_desc]" />
									</div>
									<div id="divReq-person_dammage_body_desc"></div>
								</div>
							</div>
						</div>
						<!-- END MERGE SECCION 4 -->


						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-1"><span class="required"></span>
									</label>

									<div class="col-md-10">
										<br>
										<table>
											<tr>
												<td><button type="button" class="sm btn green" id="btnAdd">เพิ่ม
														(+)</button><span style="font-size: xx-small; color: red;"> (กรณีมีผู้บาดเจ็บมากกว่า 1 คน)</span></td>
											</tr>
										</table>
										<br> <br>
										<div class="table-scrollable">

											<table class="table table-striped table-bordered table-hover"
												id="tData">
												<thead>
													<tr>
														<th style="font-size: xx-small; text-align: center;"></th>
														<th style="font-size: xx-small; text-align: center;"></th>
														<th
															style="font-size: xx-small; text-align: center; width: 100%">รายละเอียดของผู้ประสบเหตุ</th>
														<th
															style="font-size: xx-small; text-align: center; width: 100%">ชื่อ-นามสุกล</th>
														<th
															style="font-size: xx-small; text-align: center; width: 100%">ตำแหน่ง/ชั้นปี</th>
														<th
															style="font-size: xx-small; text-align: center; width: 100%">คณะ/ส่วนงาน</th>
														<th
															style="font-size: xx-small; text-align: center; width: 100%">หน้าที่</th>
														<th
															style="font-size: xx-small; text-align: center; width: 100%">ระยะเวลาปฏิบัติงาน</th>
															<th style="font-size: xx-small; text-align: center; width: 100%">ประเภทความเสียหาย </th>
															
														<th style="font-size: xx-small; text-align: center;">อายุ</th>
														<th style="font-size: xx-small; text-align: center;">เพศ</th>
														<th style="font-size: xx-small; text-align: center;">ตำแหน่ง</th>
														<th style="font-size: xx-small; text-align: center;">อวัยวะที่บาดเจ็บ</th>
														<th style="font-size: xx-small; text-align: center;">ลักษณะการบาดเจ็บ</th>
														<!-- 

													<th style="font-size: xx-small; text-align: center;">ประเภทความเสียหาย</th>

													<th style="font-size: xx-small; text-align: center;"></th>
	
													 -->
													</tr>
												</thead>
												<tbody>
													<?php if(count($persons)>1){
														$rowCount =1;
														foreach ($persons as $person) {
															$tr ='';
															$tr =$tr .'<tr id="r'.($person->id).'">';
															$tr =$tr .'<td style="text-align: center;"><button type="button" class="btn red uppercase" id="btnAdd" onclick="return deleteElement(r'.($person->id).');">ลบ</button></td>';
															$tr =$tr .'<td style="text-align: center;">'.($rowCount).'.</td>';
															
															$tr =$tr .'<td style="font-size: xx-small; text-align: center;">';
															$tr =$tr .'<input style="width : 100px !important;" id="person_type" type="hidden" value="'.$person->person_type.'" class="form-control" name="person_types[]">';
															$tr =$tr .'<input style="width : 200px !important;" id="hperson_type" type="label" value="'.$person->person_type.'" class="form-control" readonly="readonly">';
															$tr =$tr .'</td>';
															
															$tr =$tr .'<td style="font-size: xx-small; text-align: center;">';
															$tr =$tr .'<input style="width : 200px !important;" id="person_name" type="label" value="'.$person->person_name.'"class="form-control" name="person_names[]" readonly="readonly">';
															$tr =$tr .'</td>';
															
															$tr =$tr .'<td style="font-size: xx-small; text-align: center;">';
															$tr =$tr .'<input style="width : 60px !important;" id="person_position" type="label" value="'.$person->person_position.'"class="form-control" name="person_positions[]" readonly="readonly">';
															$tr =$tr .'</td>';
															
															$tr =$tr .'<td style="font-size: xx-small; text-align: center;">';
															$tr =$tr .'<input style="width : 100px !important;" id="person_department_id" type="hidden" value="'.$person->person_department_id.'" class="form-control" name="person_department_ids[]">';
															$tr =$tr .'<input style="width : 200px !important;" id="person_department_id" type="label" value="'.$person->person_department_id.'" class="form-control" readonly="readonly">';
															$tr =$tr .'</td>';
															
															$tr =$tr .'<td style="font-size: xx-small; text-align: center;">';
															$tr =$tr .'<input style="width : 120px !important;" id="person_responsibility" type="label" value="'.$person->person_responsibility.'"class="form-control" name="person_responsibilitys[]" readonly="readonly">';
															$tr =$tr .'</td>';
															
															$tr =$tr .'<td style="font-size: xx-small; text-align: center;">';
															$tr =$tr .'<input style="width : 120px !important;" id="person_work_period" type="label" value="'.$person->person_work_period.'"class="form-control" name="person_work_periods[]" readonly="readonly">';
															$tr =$tr .'</td>';
															
															$tr =$tr .'<td style="font-size: xx-small; text-align: center;">';
															$tr =$tr .'<input style="width : 100px !important;" id="person_sex" type="hidden" value="'.$person->person_lost_type.'"class="form-control" name="person_sexs[]">';
															$tr =$tr .'<input style="width : 100px !important;" id="hperson_sex" type="label" value="'.$person->person_lost_type.'" class="form-control" readonly="readonly">';
															$tr =$tr .'</td>';
															
															$tr =$tr .'<td style="font-size: xx-small; text-align: center;">';
															$tr =$tr .'<input style="width : 60px !important;" id="person_age" type="label" value="'.$person->person_age.'"class="form-control" name="person_ages[]" readonly="readonly">';
															$tr =$tr .'</td>';
															
															$tr =$tr .'<td style="font-size: xx-small; text-align: center;">';
															$tr =$tr .'<input style="width : 100px !important;" id="person_sex" type="hidden" value="'.$person->person_sex.'"class="form-control" name="person_sexs[]">';
															$tr =$tr .'<input style="width : 100px !important;" id="hperson_sex" type="label" value="'.$person->person_sex.'" class="form-control" readonly="readonly">';
															$tr =$tr .'</td>';
															
															$tr =$tr .'<td style="font-size: xx-small; text-align: center;">';
															$tr =$tr .'<input style="width : 60px !important;" id="person_position" type="label" value="'.$person->person_position.'"class="form-control" name="person_positions[]" readonly="readonly">';
															$tr =$tr .'</td>';
															
															$tr =$tr .'<td style="font-size: xx-small; text-align: center;">';
															$tr =$tr .'<input style="width : 60px !important;" id="person_dammage_body" type="label" value="'.$person->person_dammage_body.'"class="form-control" name="person_dammage_bodys[]" readonly="readonly">';
															$tr =$tr .'</td>';
															
															$tr =$tr .'<td style="font-size: xx-small; text-align: center;">';
															$tr =$tr .'<input style="width : 60px !important;" id="person_dammage_body_desc" type="label" value="'.$person->person_dammage_body_desc.'"class="form-control" name="person_dammage_body_descs[]" readonly="readonly">';
															$tr =$tr .'</td>';
														
															$tr =$tr .'</tr>';
															echo $tr;
															$rowCount++;
														}
													}?>
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
										<div class="col-md-2">
											<div class="input-group date date-picker"
												data-date-format="dd-mm-yyyy">
												<input type="text"
													value="<?php echo (isset($data->case_date)? CommonUtil::getDateThai($data->case_date): CommonUtil::getCurDate());?>"
													id="case_date" class="form-control"
													name="AccidentInvestigation[case_date]" /> <span
													class="input-group-btn">
													<button class="btn default" type="button">
														<i class="fa fa-calendar"></i>
													</button>
												</span>
											</div>
										</div>
										<div class="col-md-2">
											<div class='input-group date'>
												<input type='text' class="form-control" id='case_date_time'
													name="AccidentInvestigation[case_date_time]"
													value="<?php echo $data->case_date_time;?>" /> <span
													class="input-group-addon"> <span
													class="glyphicon glyphicon-time"></span>
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
											<input type="text"
												value="<?php echo $data->accident_location;?>"
												id="accident_location" class="form-control"
												name="AccidentInvestigation[accident_location]" />
										</div>
										<div id="divReq-accident_location"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">ภารกิจในขณะเกิดเหตุ :<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text"
												value="<?php echo $data->accident_mission;?>"
												id="accident_mission" class="form-control"
												name="AccidentInvestigation[accident_mission]" />
										</div>
										<div id="divReq-accident_mission"></div>
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
											<input type="text"
												value="<?php echo $data->count_work_person;?>"
												id="count_work_person" class="form-control allowNum"
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
										


											<input type="checkbox" id="bodyAccident1" <?php echo ((strpos($data->body_accident_type, '1') !== false) ? 'checked="checked"':''); ?>
												name="bodyAccidentInvestigation[]" value="1" />ศีรษะ/ ลำคอ /
											ใบหน้า <input type="checkbox" id="bodyAccident2" <?php echo ((strpos($data->body_accident_type, '2') !== false) ? 'checked="checked"':''); ?>
												name="bodyAccidentInvestigation[]" value="2" />ตา <input
												type="checkbox" id="bodyAccident3" <?php echo ((strpos($data->body_accident_type, '3') !== false) ? 'checked="checked"':''); ?>
												name="bodyAccidentInvestigation[]" value="3" /> หลัง/ ไหล่ <input
												type="checkbox" id="bodyAccident4"  <?php echo ((strpos($data->body_accident_type, '4') !== false) ? 'checked="checked"':''); ?>
												name="bodyAccidentInvestigation[]" value="4" /> ลำตัว <input
												type="checkbox" id="bodyAccident5"   <?php echo ((strpos($data->body_accident_type, '5') !== false) ? 'checked="checked"':''); ?>
												name="bodyAccidentInvestigation[]" value="5" /> แขน <input
												type="checkbox" id="bodyAccident6"   <?php echo ((strpos($data->body_accident_type, '6') !== false) ? 'checked="checked"':''); ?>
												name="bodyAccidentInvestigation[]" value="6" /> มือ/นิ้วมือ
												<input type="checkbox" id="bodyAccident7"  <?php echo ((strpos($data->body_accident_type, '7') !== false) ? 'checked="checked"':''); ?>
												name="bodyAccidentInvestigation[]" value="7" /> ขา <input
												type="checkbox" id="bodyAccident8"   <?php echo ((strpos($data->body_accident_type, '8') !== false) ? 'checked="checked"':''); ?>
												name="bodyAccidentInvestigation[]" value="8" /> เท้า/
												นิ้วเท้า <input type="checkbox" id="bodyAccident9"  <?php echo ((strpos($data->body_accident_type, '9') !== false) ? 'checked="checked"':''); ?>
												name="bodyAccidentInvestigation[]" value="9" />
												บาดเจ็บหลายส่วน <input type="checkbox" id="bodyAccident10" <?php echo ((strpos($data->body_accident_type, '10') !== false) ? 'checked="checked"':''); ?>
												name="bodyAccidentInvestigation[]" value="10" /> อื่นๆ <input
												type="text" value="<?php echo $data->body_accident_type_other;?>" id="body_accident_type_other"
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
										<label class="control-label col-md-4">รายละเอียดการรักษา :<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="<?php echo $data->treat_detail;?>" id="treat_detail"
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
										<label class="control-label col-md-4">จำนวนวันที่หยุดงานจริง :<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="<?php echo $data->leave_day;?>" id="leave_day"
												class="form-control allowNum"
												name="AccidentInvestigation[leave_day]" />
										</div>
										<div id="divReq-leave_day">วัน</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">พยานผู้พบเห็นเหตุการณ์ :<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="<?php echo $data->eyewitnesses;?>" id="eyewitnesses"
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
											<span style="font-size: xx-small; color: red;"> (ใคร ทำอะไร
												ที่ไหน อย่างไร เมื่อไหร่)</span>
											<textarea rows="5" cols="70" id="accident_event_happen"
												name="AccidentInvestigation[accident_event_happen]"><?php echo $data->accident_event_happen;?></textarea>

										</div>
										<div id="divReq-accident_event_happen"></div>
									</div>
								</div>
							</div>



							<div class="row">
								<div class="col-md-10">
									<div class="form-group last">
										<label class="control-label col-md-4">คำอธิบาย : <br>แนบรูปภาพ
											(ถ้ามี) :
										</label>
										<div class="col-md-4">

											<table style="width: 750px">
												<tr>
													<td><input type="text" value="<?php echo $imgs->img1_description;?>" id="img1_desc"
														class="form-control"
														name="AccidentInvestigationImage[img1_description]" /></td>
													<td><input type="text" value="<?php echo $imgs->img2_description;?>" id="img2_desc"
														class="form-control"
														name="AccidentInvestigationImage[img2_description]" /></td>
													<td><input type="text" value="<?php echo $imgs->img3_description;?>" id="img3_desc"
														class="form-control"
														name="AccidentInvestigationImage[img3_description]" /></td>
													<td><input type="text" value="<?php echo $imgs->img4_description;?>" id="img4_desc"
														class="form-control"
														name="AccidentInvestigationImage[img4_description]" /></td>
													<td><input type="text" value=<?php echo $imgs->img5_description;?>"" id="img5_desc"
														class="form-control"
														name="AccidentInvestigationImage[img5_description]" /></td>
												</tr>

												<tr>
													<td width="150px">
														<div class="fileinput fileinput-new"
															data-provides="fileinput">
															<div class="fileinput-new thumbnail"
																style="width: 150px; height: 100px;">
																<img
																	src="/muirs<?php echo $imgs->path_img1?>"
																	alt="" />
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail"
																style="max-width: 150px; max-height: 100px;"></div>
															<div>
																<span class="btn default btn-file"> <span
																	class="fileinput-new"> เลือก </span> <span
																	class="fileinput-exists">เปลี่ยน </span> <input
																	type="file" name="img1[]"
																	onchange="validateFileInput(this);">
																</span> <a href="javascript:;"
																	class="btn red fileinput-exists"
																	data-dismiss="fileinput"> ลบ </a>
															</div>
														</div>
													</td>
													<td width="150px">
														<div class="fileinput fileinput-new"
															data-provides="fileinput">
															<div class="fileinput-new thumbnail"
																style="width: 150px; height: 100px;">
																<img
																	src="/muirs<?php echo $imgs->path_img2?>"
																	alt="" />
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail"
																style="max-width: 150px; max-height: 100px;"></div>
															<div>
																<span class="btn default btn-file"> <span
																	class="fileinput-new"> เลือก </span> <span
																	class="fileinput-exists">เปลี่ยน </span> <input
																	type="file" name="img2[]"
																	onchange="validateFileInput(this);">
																</span> <a href="javascript:;"
																	class="btn red fileinput-exists"
																	data-dismiss="fileinput"> ลบ </a>
															</div>
														</div>
													</td>
													<td width="150px">
														<div class="fileinput fileinput-new"
															data-provides="fileinput">
															<div class="fileinput-new thumbnail"
																style="width: 150px; height: 100px;">
																<img
																	src="/muirs<?php echo $imgs->path_img3?>"
																	alt="" />
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail"
																style="max-width: 150px; max-height: 100px;"></div>
															<div>
																<span class="btn default btn-file"> <span
																	class="fileinput-new"> เลือก </span> <span
																	class="fileinput-exists">เปลี่ยน </span> <input
																	type="file" name="img3[]"
																	onchange="validateFileInput(this);">
																</span> <a href="javascript:;"
																	class="btn red fileinput-exists"
																	data-dismiss="fileinput"> ลบ </a>
															</div>
														</div>
													</td>
													<td width="150px">
														<div class="fileinput fileinput-new"
															data-provides="fileinput">
															<div class="fileinput-new thumbnail"
																style="width: 150px; height: 100px;">
																<img
																	src="/muirs<?php echo $imgs->path_img4?>"
																	alt="" />
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail"
																style="max-width: 150px; max-height: 100px;"></div>
															<div>
																<span class="btn default btn-file"> <span
																	class="fileinput-new"> เลือก </span> <span
																	class="fileinput-exists">เปลี่ยน </span> <input
																	type="file" name="img4[]"
																	onchange="validateFileInput(this);">
																</span> <a href="javascript:;"
																	class="btn red fileinput-exists"
																	data-dismiss="fileinput"> ลบ </a>
															</div>
														</div>
													</td>
													<td width="150px">
														<div class="fileinput fileinput-new"
															data-provides="fileinput">
															<div class="fileinput-new thumbnail"
																style="width: 150px; height: 100px;">
																<img
																	src="/muirs<?php echo $imgs->path_img5?>"
																	alt="" />
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail"
																style="max-width: 150px; max-height: 100px;"></div>
															<div>
																<span class="btn default btn-file"> <span
																	class="fileinput-new"> เลือก </span> <span
																	class="fileinput-exists">เปลี่ยน </span> <input
																	type="file" name="img5[]"
																	onchange="validateFileInput(this);">
																</span> <a href="javascript:;"
																	class="btn red fileinput-exists"
																	data-dismiss="fileinput"> ลบ </a>
															</div>
														</div>
													</td>
												</tr>
											</table>
											<span style="font-size: xx-small; color: red;">(โปรดแนบไฟล์ jpg หรือ png ที่มีขนาดไม่เกิน  <?php echo ConfigUtil::getDefaultMaxUploadFileSize()?>MB)</span>

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

											<input type="checkbox" <?php echo ((strpos($data->accident_type, '1') !== false) ? 'checked="checked"':''); ?> id="accident_type1"
												name="accident_type[]" value="1" />อุบัติเหตุทางเคมี <input
												type="checkbox" <?php echo ((strpos($data->accident_type, '2') !== false) ? 'checked="checked"':''); ?> id="accident_type2" name="accident_type[]"
												value="2" />อุบัติเหตุทางชีวภาพ <input type="checkbox" <?php echo ((strpos($data->accident_type, '3') !== false) ? 'checked="checked"':''); ?>
												id="accident_type3" name="accident_type[]" value="3" />อุบัติเหตุทางรังสี
											<input type="checkbox" <?php echo ((strpos($data->accident_type, '4') !== false) ? 'checked="checked"':''); ?> id="accident_type4"
												name="accident_type[]" value="4" />อุบัติเหตุทางไฟฟ้า <input
												type="checkbox" <?php echo ((strpos($data->accident_type, '5') !== false) ? 'checked="checked"':''); ?> id="accident_type5" name="accident_type[]"
												value="5" />อัคคีภัย <input type="checkbox"
												id="accident_type6" <?php echo ((strpos($data->accident_type, '6') !== false) ? 'checked="checked"':''); ?> name="accident_type[]" value="6" />อื่นๆ
											(โปรดระบุ) <input type="text" value="<?php echo $data->accident_type6_other?>"
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

											<input type="radio" id="ever_happen1" <?php echo ((strpos($data->ever_happen, '1') !== false) ? 'checked="checked"':''); ?>
												name="AccidentInvestigation[ever_happen]" value="1" />เคย
											(โปรดระบุ) <input type="text" value="<?php echo $data->ever_happen1_other;?>"
												id="ever_happen1_other"
												style="border: none; border-bottom-style: dotted; width: 150px;"
												class='allowNum'
												name="AccidentInvestigation[ever_happen1_other]" />ครั้ง <input
												type="radio" id="ever_happen2" <?php echo ((strpos($data->ever_happen, '2') !== false) ? 'checked="checked"':''); ?>
												name="AccidentInvestigation[ever_happen]" value="2"
												checked="checked" />ไม่เคย
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
											<table>
											<?php CommonUtil::getAccidentAnalyze($data->accident_cause);?>
                                        </table>
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
													<td><input type="radio" <?php echo ((strpos($data->accidental_damage_type, '1') !== false) ? 'checked="checked"':''); ?>
														class="rdDamageTypeCls" id="accidental_damage_type"
														name="AccidentInvestigation[accidental_damage_type]"
														value="1" />เสียชีวิต จำนวน</td>
													<td><input type="text" value="<?php echo $data->accidental_damage1;?>" id="accidental_damage1"
														class='allowNum'
														style="border: none; border-bottom-style: dotted; width: 150px; text-align: right;"
														name="AccidentInvestigation[accidental_damage1]" /></td>
													<td>ราย</td>
												</tr>

												<tr>
													<td><input type="radio" id="accidental_damage_type" <?php echo ((strpos($data->accidental_damage_type, '2') !== false) ? 'checked="checked"':''); ?>
														class="rdDamageTypeCls"
														name="AccidentInvestigation[accidental_damage_type]"
														value="2" />สูญเสียอวัยวะ/ทุพพลภาพ จำนวน</td>
													<td><input type="text" value="<?php echo $data->accidental_damage2;?>" id="accidental_damage2"
														class='allowNum'
														style="border: none; border-bottom-style: dotted; width: 150px; text-align: right;"
														name="AccidentInvestigation[accidental_damage2]" /></td>
													<td>ราย</td>
												</tr>

												<tr>
													<td><input type="radio" id="accidental_damage_type" <?php echo ((strpos($data->accidental_damage_type, '3') !== false) ? 'checked="checked"':''); ?>
														class="rdDamageTypeCls"
														name="AccidentInvestigation[accidental_damage_type]"
														value="3" />บาดเจ็บ/เจ็บป่วย จำนวน</td>
													<td><input type="text" value="<?php echo $data->accidental_damage3;?>" id="accidental_damage3"
														class='allowNum'
														style="border: none; border-bottom-style: dotted; width: 150px; text-align: right;"
														name="AccidentInvestigation[accidental_damage3]" /></td>
													<td>ราย</td>
												</tr>

												<tr>
													<td><input type="radio" id="accidental_damage_type" <?php echo ((strpos($data->accidental_damage_type, '4') !== false) ? 'checked="checked"':''); ?>
														class="rdDamageTypeCls"
														name="AccidentInvestigation[accidental_damage_type]"
														value="4" />ทรัพย์สินเสียหาย จำนวน</td>
													<td><input type="text" value="<?php echo $data->accidental_damage4;?>" id="accidental_damage4"
														class='allowNum2'
														style="border: none; border-bottom-style: dotted; width: 150px; text-align: right;"
														name="AccidentInvestigation[accidental_damage4]" /></td>
													<td>บาท</td>
												</tr>

												<tr>
													<td>โปรดระบุรายละเอียด</td>
													<td colspan="2"><input type="text" value="<?php echo $data->accidental_damage4_other;?>"
														id="accidental_damage4_other"
														style="border: none; border-bottom-style: dotted; width: 150px;"
														name="AccidentInvestigation[accidental_damage4_other]" />
													</td>
												</tr>

												<tr>
													<td><input type="radio" id="accidental_damage_type" <?php echo ((strpos($data->accidental_damage_type, '5') !== false) ? 'checked="checked"':''); ?>
														class="rdDamageTypeCls"
														name="AccidentInvestigation[accidental_damage_type]"
														value="5" />มีการหยุดการปฏิบัติงาน
														จำนวนวันที่หยุดการปฏิบัติงาน</td>
													<td><input type="text" value="<?php echo $data->accidental_damage5;?>" id="accidental_damage5"
														class='allowNum'
														style="border: none; border-bottom-style: dotted; width: 150px; text-align: right;"
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
												name="AccidentInvestigation[accident_solve]"><?php echo $data->accident_solve;?></textarea>

										</div>
										<div id="divReq-accident_solve"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group last">
										<label class="control-label col-md-4">คำอธิบาย : <br>แนบรูปภาพ
											(ถ้ามี) :
										</label>
										<div class="col-md-4">
											<table style="width: 750px">
												<tr>
													<td><input type="text" value="<?php echo $imgs->img6_description;?>" id="img6_desc"
														class="form-control"
														name="AccidentInvestigationImage[img6_description]" /></td>
													<td><input type="text" value="<?php echo $imgs->img7_description;?>" id="img7_desc"
														class="form-control"
														name="AccidentInvestigationImage[img7_description]" /></td>
													<td><input type="text" value="<?php echo $imgs->img8_description;?>" id="img8_desc"
														class="form-control"
														name="AccidentInvestigationImage[img8_description]" /></td>
													<td><input type="text" value="<?php echo $imgs->img9_description;?>" id="img9_desc"
														class="form-control"
														name="AccidentInvestigationImage[img9_description]" /></td>
													<td><input type="text" value="<?php echo $imgs->img10_description;?>" id="img10_desc"
														class="form-control"
														name="AccidentInvestigationImage[img10_description]" /></td>
												</tr>

												<tr>
													<td width="150px">
														<div class="fileinput fileinput-new"
															data-provides="fileinput">
															<div class="fileinput-new thumbnail"
																style="width: 150px; height: 100px;">
																<img
																	src="/muirs<?php echo $imgs->path_img6?>"
																	alt="" />
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail"
																style="max-width: 150px; max-height: 100px;"></div>
															<div>
																<span class="btn default btn-file"> <span
																	class="fileinput-new"> เลือก </span> <span
																	class="fileinput-exists">เปลี่ยน </span> <input
																	type="file" name="img6[]"
																	onchange="validateFileInput(this);">
																</span> <a href="javascript:;"
																	class="btn red fileinput-exists"
																	data-dismiss="fileinput"> ลบ </a>
															</div>
														</div>
													</td>
													<td width="150px">
														<div class="fileinput fileinput-new"
															data-provides="fileinput">
															<div class="fileinput-new thumbnail"
																style="width: 150px; height: 100px;">
																<img
																	src="/muirs<?php echo $imgs->path_img7?>"
																	alt="" />
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail"
																style="max-width: 150px; max-height: 100px;"></div>
															<div>
																<span class="btn default btn-file"> <span
																	class="fileinput-new"> เลือก </span> <span
																	class="fileinput-exists">เปลี่ยน </span> <input
																	type="file" name="img7[]"
																	onchange="validateFileInput(this);">
																</span> <a href="javascript:;"
																	class="btn red fileinput-exists"
																	data-dismiss="fileinput"> ลบ </a>
															</div>
														</div>
													</td>
													<td width="150px">
														<div class="fileinput fileinput-new"
															data-provides="fileinput">
															<div class="fileinput-new thumbnail"
																style="width: 150px; height: 100px;">
																<img
																	src="/muirs<?php echo $imgs->path_img8?>"
																	alt="" />
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail"
																style="max-width: 150px; max-height: 100px;"></div>
															<div>
																<span class="btn default btn-file"> <span
																	class="fileinput-new"> เลือก </span> <span
																	class="fileinput-exists">เปลี่ยน </span> <input
																	type="file" name="img8[]"
																	onchange="validateFileInput(this);">
																</span> <a href="javascript:;"
																	class="btn red fileinput-exists"
																	data-dismiss="fileinput"> ลบ </a>
															</div>
														</div>
													</td>
													<td width="150px">
														<div class="fileinput fileinput-new"
															data-provides="fileinput">
															<div class="fileinput-new thumbnail"
																style="width: 150px; height: 100px;">
																<img
																	src="/muirs<?php echo $imgs->path_img9?>"
																	alt="" />
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail"
																style="max-width: 150px; max-height: 100px;"></div>
															<div>
																<span class="btn default btn-file"> <span
																	class="fileinput-new"> เลือก </span> <span
																	class="fileinput-exists">เปลี่ยน </span> <input
																	type="file" name="img9[]"
																	onchange="validateFileInput(this);">
																</span> <a href="javascript:;"
																	class="btn red fileinput-exists"
																	data-dismiss="fileinput"> ลบ </a>
															</div>
														</div>
													</td>
													<td width="150px">
														<div class="fileinput fileinput-new"
															data-provides="fileinput">
															<div class="fileinput-new thumbnail"
																style="width: 150px; height: 100px;">
																<img
																	src="/muirs<?php echo $imgs->path_img10?>"
																	alt="" />
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail"
																style="max-width: 150px; max-height: 100px;"></div>
															<div>
																<span class="btn default btn-file"> <span
																	class="fileinput-new"> เลือก </span> <span
																	class="fileinput-exists">เปลี่ยน </span> <input
																	type="file" name="img10[]"
																	onchange="validateFileInput(this);">
																</span> <a href="javascript:;"
																	class="btn red fileinput-exists"
																	data-dismiss="fileinput"> ลบ </a>
															</div>
														</div>
													</td>
												</tr>
											</table>
											<span style="font-size: xx-small; color: red;">(โปรดแนบไฟล์ jpg หรือ png ที่มีขนาดไม่เกิน  <?php echo ConfigUtil::getDefaultMaxUploadFileSize()?>MB)</span>

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
												name="AccidentInvestigation[accident_protect]"><?php echo $data->accident_protect;?></textarea>

										</div>
										<div id="divReq-accident_protect"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group last">
										<label class="control-label col-md-4">คำอธิบาย : <br>แนบรูปภาพ
											(ถ้ามี) :
										</label>
										<div class="col-md-4">
											<table style="width: 750px">
												<tr>
													<td><input type="text" value="<?php echo $imgs->img11_description;?>" id="img11_desc"
														class="form-control"
														name="AccidentInvestigationImage[img11_description]" /></td>
													<td><input type="text" value="<?php echo $imgs->img12_description;?>" id="img12_desc"
														class="form-control"
														name="AccidentInvestigationImage[img12_description]" /></td>
													<td><input type="text" value="<?php echo $imgs->img13_description;?>" id="img13_desc"
														class="form-control"
														name="AccidentInvestigationImage[img13_description]" /></td>
													<td><input type="text" value="<?php echo $imgs->img14_description;?>" id="img14_desc"
														class="form-control"
														name="AccidentInvestigationImage[img14_description]" /></td>
													<td><input type="text" value="<?php echo $imgs->img15_description;?>" id="img15_desc"
														class="form-control"
														name="AccidentInvestigationImage[img15_description]" /></td>
												</tr>

												<tr>
													<td width="150px">
														<div class="fileinput fileinput-new"
															data-provides="fileinput">
															<div class="fileinput-new thumbnail"
																style="width: 150px; height: 100px;">
																<img
																	src="/muirs<?php echo $imgs->path_img11?>"
																	alt="" />
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail"
																style="max-width: 150px; max-height: 100px;"></div>
															<div>
																<span class="btn default btn-file"> <span
																	class="fileinput-new"> เลือก </span> <span
																	class="fileinput-exists">เปลี่ยน </span> <input
																	type="file" name="img11[]"
																	onchange="validateFileInput(this);">
																</span> <a href="javascript:;"
																	class="btn red fileinput-exists"
																	data-dismiss="fileinput"> ลบ </a>
															</div>
														</div>
													</td>
													<td width="150px">
														<div class="fileinput fileinput-new"
															data-provides="fileinput">
															<div class="fileinput-new thumbnail"
																style="width: 150px; height: 100px;">
																<img
																	src="/muirs<?php echo $imgs->path_img12?>"
																	alt="" />
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail"
																style="max-width: 150px; max-height: 100px;"></div>
															<div>
																<span class="btn default btn-file"> <span
																	class="fileinput-new"> เลือก </span> <span
																	class="fileinput-exists">เปลี่ยน </span> <input
																	type="file" name="img12[]"
																	onchange="validateFileInput(this);">
																</span> <a href="javascript:;"
																	class="btn red fileinput-exists"
																	data-dismiss="fileinput"> ลบ </a>
															</div>
														</div>
													</td>
													<td width="150px">
														<div class="fileinput fileinput-new"
															data-provides="fileinput">
															<div class="fileinput-new thumbnail"
																style="width: 150px; height: 100px;">
																<img
																	src="/muirs<?php echo $imgs->path_img13?>"
																	alt="" />
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail"
																style="max-width: 150px; max-height: 100px;"></div>
															<div>
																<span class="btn default btn-file"> <span
																	class="fileinput-new"> เลือก </span> <span
																	class="fileinput-exists">เปลี่ยน </span> <input
																	type="file" name="img13[]"
																	onchange="validateFileInput(this);">
																</span> <a href="javascript:;"
																	class="btn red fileinput-exists"
																	data-dismiss="fileinput"> ลบ </a>
															</div>
														</div>
													</td>
													<td width="150px">
														<div class="fileinput fileinput-new"
															data-provides="fileinput">
															<div class="fileinput-new thumbnail"
																style="width: 150px; height: 100px;">
																<img
																	src="/muirs<?php echo $imgs->path_img14?>"
																	alt="" />
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail"
																style="max-width: 150px; max-height: 100px;"></div>
															<div>
																<span class="btn default btn-file"> <span
																	class="fileinput-new"> เลือก </span> <span
																	class="fileinput-exists">เปลี่ยน </span> <input
																	type="file" name="img14[]"
																	onchange="validateFileInput(this);">
																</span> <a href="javascript:;"
																	class="btn red fileinput-exists"
																	data-dismiss="fileinput"> ลบ </a>
															</div>
														</div>
													</td>
													<td width="150px">
														<div class="fileinput fileinput-new"
															data-provides="fileinput">
															<div class="fileinput-new thumbnail"
																style="width: 150px; height: 100px;">
																<img
																	src="/muirs<?php echo $imgs->path_img15?>"
																	alt="" />
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail"
																style="max-width: 150px; max-height: 100px;"></div>
															<div>
																<span class="btn default btn-file"> <span
																	class="fileinput-new"> เลือก </span> <span
																	class="fileinput-exists">เปลี่ยน </span> <input
																	type="file" name="img15[]"
																	onchange="validateFileInput(this);">
																</span> <a href="javascript:;"
																	class="btn red fileinput-exists"
																	data-dismiss="fileinput"> ลบ </a>
															</div>
														</div>
													</td>
												</tr>
											</table>
											<span style="font-size: xx-small; color: red;">(โปรดแนบไฟล์ jpg หรือ png ที่มีขนาดไม่เกิน  <?php echo ConfigUtil::getDefaultMaxUploadFileSize()?>MB)</span>


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
	<input type="hidden" id="maxUploadFileSize"
		value="<?php echo ConfigUtil::getDefaultMaxUploadFileSize()?>">




	<script
		src="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/jquery.min.js"
		type="text/javascript"></script>

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
	                alert("โปรดแนบไฟล์ jpg หรือ png" );
	                oInput.value = "";
	                return false;
	            }
	        }
	    }
	    return true;
	}
	

    
    jQuery(document).ready(function () {

    	$('#report_date').datepicker({language:'th-th',format:'dd/mm/yyyy'})
    	$('#case_date').datepicker({language:'th-th',format:'dd/mm/yyyy'})
    	$('#case_date_time').datetimepicker({format: 'HH:mm'});


    	
        $(".allowNum").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               return false;
           }
          });

        $('#accidental_damage4').bind('change', function(){
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
        
        $('#btnAdd').click(function (event) {

        	/*Section 1 : ข้อมูลส่วนตัวผู้ได้รับบาดเจ็บ (Personal Detail)*/
    		var rdPersonType = $('.rdPersonTypeCls:checked').val();
			switch(rdPersonType){
    			case "5":
    				if($("#person_type_other").val().length == 0){
        				alert('อื่นๆ โปรดระบุ');
						return false;
        			}
        			break;
			}
        	if($("#person_name").val().length == 0){
        		$("#person_name").closest('.form-group').addClass('has-error');
        		$("#divReq-person_name").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#person_name").focus();
        		return false;
            }else{
            	$("#divReq-person_name").html('');
            	$("#person_name").closest('.form-group').removeClass('has-error');
        	}
        	if($("#person_position").val().length == 0){
        		$("#person_position").closest('.form-group').addClass('has-error');
        		$("#divReq-person_position").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#person_position").focus();
        		return false;
            }else{
            	$("#divReq-person_position").html('');
            	$("#person_position").closest('.form-group').removeClass('has-error');
        	}
        	if($("#person_department_id").val() == "-1"){
        		$("#person_department_id").closest('.form-group').addClass('has-error');
        		$("#divReq-person_department_id").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#person_department_id").focus();
    		return false;
            }else{
            	$("#divReq-person_department_id").html('');
            	$("#person_department_id").closest('.form-group').removeClass('has-error');
        	}
//         	if($("#person_position").val().length == 0){
//         		$("#person_position").closest('.form-group').addClass('has-error');
//         		$("#divReq-person_position").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
//         		$("#person_position").focus();
//         		return false;
//             }else{
//             	$("#divReq-person_position").html('');
//             	$("#person_position").closest('.form-group').removeClass('has-error');
//         	}

        	if($("#person_responsibility").val().length == 0){
        		$("#person_responsibility").closest('.form-group').addClass('has-error');
        		$("#divReq-person_responsibility").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#person_responsibility").focus();
        		return false;
            }else{
            	$("#divReq-person_responsibility").html('');
            	$("#person_responsibility").closest('.form-group').removeClass('has-error');
        	}
        	if($("#person_work_period").val().length == 0){
        		$("#person_work_period").closest('.form-group').addClass('has-error');
        		$("#divReq-person_work_period").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#person_work_period").focus();
        		return false;
            }else{
            	$("#divReq-person_work_period").html('');
            	$("#person_work_period").closest('.form-group').removeClass('has-error');
        	}
        	if($("#person_age").val().length == 0){
        		$("#person_age").closest('.form-group').addClass('has-error');
        		$("#divReq-person_age").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#person_age").focus();
        		return false;
            }else{
            	$("#divReq-person_age").html('');
            	$("#person_age").closest('.form-group').removeClass('has-error');
        	}
        	if($("#person_sex").val().length == 0){
        		$("#person_sex").closest('.form-group').addClass('has-error');
        		$("#divReq-person_sex").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#person_sex").focus();
        		return false;
            }else{
            	$("#divReq-person_sex").html('');
            	$("#person_sex").closest('.form-group').removeClass('has-error');
        	}
        	
        		var personType = $('.rdPersonTypeCls:checked').val();
            	var txt_person_type_other = $('#person_type_other').val();
            	var txt_person_name = $('#person_name').val();
            	var txt_person_department_id = $('#person_department_id').val();
            	var txt_person_department_id_text = $("#person_department_id option:selected").text();
            	var txt_person_responsibility = $('#person_responsibility').val();
            	var txt_person_work_period = $('#person_work_period').val();

            	
            	var txt_person_age = $('#person_age').val();
        		var personSex = $('.rdPersonSexCls:checked').val();
        		var personLostType = $('.rdPersonLostTypeCls:checked').val();
        		


            	var txt_person_position = $('#person_position').val();
            	var txt_person_dammage_body = $('#person_dammage_body').val();
            	var txt_person_dammage_body_desc = $('#person_dammage_body_desc').val();

    	    	var rowCount = $('#tData tr').length;
    	    	var rid = uniqId();

	    	$('#tData > tbody:last').append('<tr id="r'+(rid)+'">'+
	    			'<td style="text-align: center;"><button type="button" class="btn red uppercase" id="btnAdd" onclick="return deleteElement(r'+(rid)+');">ลบ</button></td>'+
	    	    	'<td style="text-align: center;">'+(rowCount)+'.</td>'+
	    	    	
	    			'<td style="font-size: xx-small; text-align: center;">'+
	    			'<input style="width : 100px !important;" id="person_type" type="hidden" value="'+personType+'" class="form-control" name="person_types[]">'+
	    			'<input style="width : 200px !important;" id="hperson_type" type="label" value="'+getPersonType(personType)+'" class="form-control" readonly="readonly">'+
	    			'</td>'+

	    			'<td style="font-size: xx-small; text-align: center;">'+
	    			'<input style="width : 200px !important;" id="person_name" type="label" value="'+txt_person_name+'"class="form-control" name="person_names[]" readonly="readonly">'+
	    			'</td>'+
	    			
	    			'<td style="font-size: xx-small; text-align: center;">'+
	    			'<input style="width : 60px !important;" id="person_position" type="label" value="'+txt_person_position+'"class="form-control" name="person_positions[]" readonly="readonly">'+
	    			'</td>'+

	    			'<td style="font-size: xx-small; text-align: center;">'+
					'<input style="width : 100px !important;" id="person_department_id" type="hidden" value="'+txt_person_department_id+'" class="form-control" name="person_department_ids[]">'+
	    			'<input style="width : 200px !important;" id="person_department_id" type="label" value="'+txt_person_department_id_text+'" class="form-control" readonly="readonly">'+
	    			'</td>'+
	    			
	    			'<td style="font-size: xx-small; text-align: center;">'+
	    			'<input style="width : 120px !important;" id="person_responsibility" type="label" value="'+txt_person_responsibility+'"class="form-control" name="person_responsibilitys[]" readonly="readonly">'+
	    			'</td>'+
	    			
	    			'<td style="font-size: xx-small; text-align: center;">'+
	    			'<input style="width : 120px !important;" id="person_work_period" type="label" value="'+txt_person_work_period+'"class="form-control" name="person_work_periods[]" readonly="readonly">'+
	    			'</td>'+
	    			
	    			'<td style="font-size: xx-small; text-align: center;">'+
	    			'<input style="width : 100px !important;" id="person_lost_type" type="hidden" value="'+personLostType+'"class="form-control" name="person_lost_types[]">'+
	    			'<input style="width : 100px !important;" id="hperson_lost_type" type="label" value="'+getpersonLostType(personLostType)+'" class="form-control" readonly="readonly">'+
	    			'</td>'+
	    			
	    			'<td style="font-size: xx-small; text-align: center;">'+
	    			'<input style="width : 60px !important;" id="person_age" type="label" value="'+txt_person_age+'"class="form-control" name="person_ages[]" readonly="readonly">'+
	    			'</td>'+

	    			
	    			'<td style="font-size: xx-small; text-align: center;">'+
	    			'<input style="width : 100px !important;" id="person_sex" type="hidden" value="'+personSex+'"class="form-control" name="person_sexs[]">'+
	    			'<input style="width : 100px !important;" id="hperson_sex" type="label" value="'+getPersonSex(personSex)+'" class="form-control" readonly="readonly">'+
	    			'</td>'+

	    			'<td style="font-size: xx-small; text-align: center;">'+
	    			'<input style="width : 60px !important;" id="person_position" type="label" value="'+txt_person_position+'"class="form-control" name="person_positions[]" readonly="readonly">'+
	    			'</td>'+
	    			
	    			'<td style="font-size: xx-small; text-align: center;">'+
	    			'<input style="width : 60px !important;" id="person_dammage_body" type="label" value="'+txt_person_dammage_body+'"class="form-control" name="person_dammage_bodys[]" readonly="readonly">'+
	    			'</td>'+
	    			
	    			'<td style="font-size: xx-small; text-align: center;">'+
	    			'<input style="width : 60px !important;" id="person_dammage_body_desc" type="label" value="'+txt_person_dammage_body_desc+'"class="form-control" name="person_dammage_body_descs[]" readonly="readonly">'+
	    			'</td>'+

// 	    			'<td style="font-size: xx-small; text-align: center;">'+
// 	    			'<input style="width : 100px !important;" id="person_lost_type" type="hidden" value="'+txt_person_lost_type+'" class="form-control" name="person_lost_types[]">'+
// 	    			'<input style="width : 100px !important;" id="person_lost_type" type="label" value="'+getpersonLostType(txt_person_lost_type)+'" class="form-control" readonly="readonly">'+
// 	    			'</td>'+
	    		
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
        	
//      	$row_count = $('#tData tbody tr').length;
//     		if($row_count == 0){
//         		alert('ยังไม่ได้เพิ่มรายงาน\n(กดปุ่ม+ เพื่อเพิ่มรายการก่อนบันทึก)');
// 				return false;
//         	}
			/*Section 0 : ข้อมูลผู้รายงาน*/
        	if($("#report_name").val().length == 0){
        		$("#report_name").closest('.form-group').addClass('has-error');
        		$("#divReq-report_name").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#report_name").focus();
        		return false;
            }else{
            	$("#divReq-report_name").html('');
            	$("#report_name").closest('.form-group').removeClass('has-error');
        	}
        	if($("#report_position").val().length == 0){
        		$("#report_position").closest('.form-group').addClass('has-error');
        		$("#divReq-report_position").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#report_position").focus();
        		return false;
            }else{
            	$("#divReq-report_position").html('');
            	$("#report_position").closest('.form-group').removeClass('has-error');
        	}
        	if($("#report_date").val().length == 0){
        		$("#report_date").closest('.form-group').addClass('has-error');
        		$("#divReq-report_date").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#case_date").focus();
        		return false;
            }else{
            	$("#divReq-report_date").html('');
            	$("#report_date").closest('.form-group').removeClass('has-error');
        	}
        	
        	/*Section 2: ข้อมูลการเกิดอุบัติเหตุ (Accident Detail)*/
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
        		$("#report_date").closest('.form-group').addClass('has-error');
        		$("#divReq-report_date").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#case_date").focus();
        		return false;
            }else{
            	$("#divReq-report_date").html('');
            	$("#report_date").closest('.form-group').removeClass('has-error');
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
        	if($("#accident_mission").val().length == 0){
        		$("#accident_mission").closest('.form-group').addClass('has-error');
        		$("#divReq-accident_mission").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#accident_mission").focus();
        		return false;
            }else{
            	$("#divReq-accident_mission").html('');
            	$("#accident_mission").closest('.form-group').removeClass('has-error');
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


        	
        	switch($('#bodyAccident10').is(":checked")){
            	case true:
    				if($("#body_accident_type_other").val().length == 0){
    					alert('อื่นๆ โปรดระบุ');
						return false;
    				}
                	break;
        	}
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
        	switch($('#accident_type6').is(":checked")){
        		case true:
    				if($("#accident_type6_other").val().length == 0){
    					alert('อื่นๆ โปรดระบุ');
    					return false;
    				}
            	break;
    		}
        	//ever_happen1 -2   	|RD
        	switch($('#ever_happen1').is(":checked")){
        		case true:
    				if($("#ever_happen1_other").val().length == 0){
    					alert('อื่นๆ โปรดระบุ');
    					return false;
    				}
            	break;
			}
			/* Section 3 : การวิเคราะห์หาสาเหตุ (Accident Analysis) */
        	if($("#accident_cause").val().length == 0){
        		$("#accident_cause").closest('.form-group').addClass('has-error');
        		$("#divReq-accident_cause").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#accident_cause").focus();
        		return false;
            }else{
            	$("#divReq-accident_cause").html('');
            	$("#accident_cause").closest('.form-group').removeClass('has-error');
        	}
//         	//accidental_damage_type	|RD
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
/*  Section 5 : การดำเนินการแก้ไขและการป้องกันไม่ให้เกิดซ้ำ (Corrective and Preventive action) */
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

//     function validateFieldText(element_id){
//     	if($("#"+element_id).val().length == 0){
//         	alert('');
//     		$("#"+element_id).closest('.form-group').addClass('has-error');
//     		$("#divReq-"+element_id).html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
//     		$("#report_name").focus();
//     		return false;
//         }else{
//         	$("#divReq-"+element_id).html('');
//         	$("#"+element_id).closest('.form-group').removeClass('has-error');
//     	}
//     }
    
    function uniqId() {
   		return Math.round(new Date().getTime() + (Math.random() * 100));
    }
    
    function deleteElement(id){
        $("#"+id.id).remove();
    }
    

    function getPersonType(element) {
        var persontypes =["พนักงานมหาวิทยาลัย","พนักงานที่ปฏิบัติงานในนามบริษัท/ลูกจ้างชั่วคราว","บุคคลภายนอกที่เข้ามาใช้บริการ","นักศึกษา","อื่นๆ"];
        return persontypes[element-1];
    }
    
    function getPersonSex($val){
    	$result = '';
            switch($val){
            case '1':
                $result= 'ชาย';
                break;
            case '2':
                $result= 'หญิง';
                
                break;
       	}
    	return $result;
    }
    function getpersonLostType($val){
    	$result = '';
            switch($val){
            case '1':
                $result= 'เสียชีวิต ';
                break;
            case '2':
                $result= 'สูญเสียอวัยวะ/ทุพพลภาพ';
                break;
            case '3':
                $result='บาดเจ็บ/เจ็บป่วย';
                break;
       	}
    	return $result;
    }
    
   	
</script>

</form>