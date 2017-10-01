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
								<li>ล้มกระแทกพื้น หัวเข้าถลอก <img
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
										<label class="control-label col-md-4">วันที่แจ้ง:<span
											class="required">*</span>
										</label>
										<div class="col-md-4">
											<input type="text" value="" id="report_date"
												style="width: 80px !important" name="Incident[report_date]" />

										</div>
										<div id="divReq-report_date"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">

										<label class="control-label col-md-4">สถานที่เกิดเหตุ.: </label>
										<div class="col-md-4">
											<textarea rows="5" cols="70" id="accident_location"
												name="Incident[accident_location]"></textarea>

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
											<span> (เกิดขึ้นอย่างไร ที่ไหน เมื่อไหร่ ผู้เกี่ยวข้อง
												จำนวนผู้ได้รับผลกระทบ)</span>

										</div>
										<div class="col-md-4">
											<textarea rows="5" cols="70" id="accident_characteristics"
												name="Incident[accident_characteristics]"></textarea>

										</div>
										<div id="divReq-accident_characteristics"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">

										<label class="control-label col-md-4">คาดว่าสาเหตุที่เกิด คือ
											: </label>
										<div class="col-md-8">
											<span> (ถ้าทราบ) </span>

										</div>
										<div class="col-md-4">
											<textarea rows="5" cols="70" id="accident_characteristics"
												name="Incident[accident_characteristics]"></textarea>

										</div>
										<div id="divReq-accident_characteristics"></div>
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
											<input type="text" value="" id="accident_cause"
												class="form-control" name="Incident[accident_cause]" />
										</div>
										<div id="divReq-accident_cause"></div>
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