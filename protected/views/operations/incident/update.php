
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
						<b>อุบัติการณ์ (Incident)</b> หมายถึง
						เหตุการณ์ไม่พึงประสงค์ทั้งหมดที่เกิดขึ้น
						ไม่ว่าจะเป็นเหตุการณ์การเกิดอุบัติเหตุ (Accident)
						หรือเหตุการณ์เหตุฉิวเฉียด (Near Miss) โดยเหตุฉิวเฉียด หมายถึง
						เหตุการณ์ที่ไม่พึงประสงค์
						เมื่อเกิดขึ้นแม้จะไม่มีความเสียหายเกิดขึ้น
						แต่ถ้าไม่ควบคุมหรือป้องกันอาจนำไปสู่การเกิดอุบัติเหตุได้
					</p>
					<p>ตัวอย่างเหตุการณ์</p>
					<ul>
						<li>1. บุคลากรเดินสะดุดสายไฟที่วางอยู่บนพื้นเสียหลัก
							<ul>
								<li>ล้มกระแทกพื้น หัวเข่าถลอก <img
									src="<?php echo ConfigUtil::getAppName()?>/images/ac01.jpg"></li>
								<li>เกือบล้มแต่ทรงตัวไว้ได้ จึงไม่ได้รับบาดเจ็บ <img
									src="<?php echo ConfigUtil::getAppName()?>/images/ac02.jpg"></li>
							</ul>
						</li>
						<li>2. พนักงานขับรถบัสรับ – ส่ง พนักงานขับมาด้วยความเร็ว
							พอมาถึงทางโค้งมีคนวิ่งข้ามถนนตัดหน้าพนักงานขับรถจึงเหยียบเบรค
							เพื่อหยุดรถกะทันหัน
							<ul>
								<li>รถบัสเฉี่ยวคนวิ่งข้ามถนน
									เป็นเหตุให้คนวิ่งข้ามถนนล้มหัวเข่ากระแทกกับพื้นถนน <img
									src="<?php echo ConfigUtil::getAppName()?>/images/ac01.jpg">
								</li>
								<li>รถบัสหยุดได้ทันพอดีกับที่คนวิ่งข้ามถนนไปอย่างฉิวเฉียด <img
									src="<?php echo ConfigUtil::getAppName()?>/images/ac02.jpg">
								</li>
							</ul>
						</li>
					</ul>

				</div>
				<div class="panel-group accordion" id="accordion1">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse"
									data-parent="#accordion1" href="#collapse_1"> <i
									class="fa fa-user"></i>สภาพการณ์หรือการกระทำที่ไม่ปลอดภัย
								</a>
							</h4>
						</div>
						<div id="collapse_1" class="panel-collapse in">
							<br>

							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">คณะ/ส่วนงาน:<span
											class="required">*</span></label>
										<div class="col-md-6">
											<select class="form-control" name="Incident[owner_department_id]"
												id="owner_department_id">
												<option value="-1">-- (ไม่มีสังกัด) --</option>
<?php
echo CommonUtil::getDepartment($data->owner_department_id);
?>
			</select>

										</div>
										<div id="divReq-owner_department_id"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<label class="control-label col-md-4">วันที่แจ้ง
											:<span class="required">*</span>
										</label>
										<div class="col-md-4">
											<div class="input-group date date-picker"
												data-date-format="dd-mm-yyyy">
												<input type="text"
													value="<?php echo CommonUtil::getDateThai($data->report_date);?>"
													id="report_date" class="form-control"
													name="Incident[report_date]" /> <span
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

										<label class="control-label col-md-4">สถานที่เกิดเหตุ.:<span class="required">*</span> </label>
										<div class="col-md-4">
											<textarea rows="5" cols="70" id="accident_location"
												name="Incident[accident_location]"><?php echo $data->accident_location?></textarea>

										</div>
										<div id="divReq-accident_location"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">

										<label class="control-label col-md-4">ลักษณะของเหตุการณ์ : </label>
										<div class="col-md-8">
											<span style="font-size: xx-small;color: red;"> (เกิดขึ้นอย่างไร ที่ไหน เมื่อไหร่ ผู้เกี่ยวข้อง
												จำนวนผู้ได้รับผลกระทบ)</span>

										</div>
										<div class="col-md-4">
											<textarea rows="5" cols="70" id="accident_characteristics"
												name="Incident[accident_characteristics]"><?php echo $data->accident_characteristics?></textarea>

										</div>
										<div id="divReq-accident_characteristics"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">

										<label class="control-label col-md-4">คาดว่าเกิดจากสาเหตุ คือ
											: </label>
										<div class="col-md-8">
											<span style="font-size: xx-small;color: red;"> (ถ้าทราบ) </span>

										</div>
										<div class="col-md-4">
											<textarea rows="5" cols="70" id="accident_cause"
												name="Incident[accident_cause]"><?php echo $data->accident_cause?></textarea>

										</div>
										<div id="divReq-accident_cause"></div>
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
											<input type="text" value="<?php echo $data->accident_event_withness_first?>" id="accident_event_withness_first"
												class="form-control" name="Incident[accident_event_withness_first]" />
										</div>
										<div id="divReq-accident_event_withness_first"></div>
									</div>
								</div>
							</div>


							<div class="row">
								<div class="col-md-10">
									<div class="form-group last">
										<label class="control-label col-md-4">คำอธิบาย : <br>แนบรูปภาพ (ถ้ามี)</label>
										<div class="col-md-4">
										<table style="width: 750px">
										<tr>
    										<td><input type="text" value="<?php echo $imgs->img1_description;?>" id="img1_desc" class="form-control" name="IncidentImage[img1_description]" /></td>
    										<td><input type="text" value="<?php echo $imgs->img2_description;?>" id="img2_desc" class="form-control" name="IncidentImage[img2_description]" /></td>
    										<td><input type="text" value="<?php echo $imgs->img3_description;?>" id="img3_desc" class="form-control" name="IncidentImage[img3_description]" /></td>
    										<td><input type="text" value="<?php echo $imgs->img4_description;?>" id="img4_desc" class="form-control" name="IncidentImage[img4_description]" /></td>
    										<td><input type="text" value="<?php echo $imgs->img5_description;?>" id="img5_desc" class="form-control" name="IncidentImage[img5_description]" /></td>
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
														src="/muirs<?php echo $imgs->path_img2?>"
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
														src="/muirs<?php echo $imgs->path_img3?>"
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
														src="/muirs<?php echo $imgs->path_img4?>"
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
														src="/muirs<?php echo $imgs->path_img5?>"
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

											</div>

											<div class="clearfix margin-top-10"></div>
										</div>
									</div>
								</div>
							</div>


						</div>
					</div>

				</div>
			</div>






			<!-- END FORM-->

			<div class="form-actions">
				<div class="row">
					<div class="col-md-10">
						<div class="row">
							<div class="col-md-offset-3 col-md-10">
								<button type="submit" class="btn green uppercase"><?php echo ConfigUtil::getBtnSaveButton();?></button>
								<?php echo CHtml::link(ConfigUtil::getBtnCancelButton(),array('Incident/'),array('class'=>'btn btn-default uppercase'));?>
							</div>
						</div>
					</div>
					<div class="col-md-10"></div>
				</div>
			</div>
		</div>
	</div>
	
	<input type="hidden" id="maxUploadFileSize" value="<?php echo ConfigUtil::getDefaultMaxUploadFileSize()?>">


	<script
		src="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/jquery.min.js"
		type="text/javascript"></script>

	<script>

	var _validFileExtensions = [".jpg", ".jpeg",".png"];    
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
        	
        	
        	if($("#owner_department_id").val() =="-1"){
        		$("#owner_department_id").closest('.form-group').addClass('has-error');
        		$("#divReq-owner_department_id").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#owner_department_id").focus();
        		return false;
            }else{
            	$("#divReq-owner_department_id").html('');
            	$("#owner_department_id").closest('.form-group').removeClass('has-error');
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
//         	if($("#accident_characteristics").val().length == 0){
//         		$("#accident_characteristics").closest('.form-group').addClass('has-error');
//         		$("#divReq-accident_characteristics").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
//         		$("#accident_characteristics").focus();
//         		return false;
//             }else{
//             	$("#divReq-accident_characteristics").html('');
//             	$("#accident_characteristics").closest('.form-group').removeClass('has-error');
//         	}
//         	if($("#accident_cause").val().length == 0){
//         		$("#accident_cause").closest('.form-group').addClass('has-error');
//         		$("#divReq-accident_cause").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
//         		$("#accident_cause").focus();
//         		return false;
//             }else{
//             	$("#divReq-accident_cause").html('');
//             	$("#accident_cause").closest('.form-group').removeClass('has-error');
//         	}
        	if($("#accident_event_withness_first").val().length == 0){
        		$("#accident_event_withness_first").closest('.form-group').addClass('has-error');
        		$("#divReq-accident_event_withness_first").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#accident_event_withness_first").focus();
        		return false;
            }else{
            	$("#divReq-accident_event_withness_first").html('');
            	$("#accident_event_withness_first").closest('.form-group').removeClass('has-error');
        	}
        	this.submit();
    	});
    });

</script>

</form>