<?php
$cats = MCatagories::model ()->findAll ();
?>
<form id="Form1" method="post" enctype="multipart/form-data"
	class="form-horizontal">
	<div class="portlet light">
		<div class="portlet-title">
			<div class="caption">
				<?php echo  MenuUtil::getMenuName($_SERVER['REQUEST_URI'])?>

			</div>
			<div class="actions">
			<?php echo CHtml::link('ย้อนกลับ',array('Information/'),array('class'=>'btn btn-default btn-sm'));?>
			</div>
		</div>
		<div class="portlet-body form">
			<div class="form-body">
				<!-- BEGIN FORM-->

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-2">ประเภทข้อมูล <span
								class="required" aria-required="true"> * </span>
							</label>
							<div class="col-md-5">
								<select class="form-control select2"
									name="Information[catagories_id]" id="catagories_id">
									<option value="0">-- โปรดเลือก --</option>
									<?php foreach($cats as $item) {?>
									<option value="<?php echo $item->id?>"><?php echo $item->name?></option>
									<?php }?>
								</select>
							</div>
							<div id="divReq-catagories_id"></div>

						</div>


						<div class="form-group">
							<label class="control-label col-md-2">ภาพประกอบ: <span
								class="required">*</span>

							</label>
							<div class="col-md-5">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<div class="input-group input-large">
										<div
											class="form-control uneditable-input input-fixed input-large"
											data-trigger="fileinput">
											<i class="fa fa-file fileinput-exists"></i>&nbsp; <span
												class="fileinput-filename"></span>
										</div>
										<span class="input-group-addon btn default btn-file"> <span
											class="fileinput-new">Select file </span> <span
											class="fileinput-exists">Change </span> <input type="file"
											name="image_paths[]" id="image_path" size="25"  accept="image/x-png,image/gif,image/jpeg">


										</span> <a href="javascript:;"
											class="input-group-addon btn red fileinput-exists"
											data-dismiss="fileinput">Remove </a>
									</div>
								</div>
							</div>
							<div id="divReq-image_path"></div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">คำอธิบาย: <span
								class="required">*</span>

							</label>
							<div class="col-md-5">


								<input id="short_description" type="text" value=""
									class="form-control" name="Information[short_description]">
							</div>
							<div id="divReq-short_description"></div>
						</div>


						<div class="form-group last">
							<label class="control-label col-md-2">รายละเอียดข้อมูล <span
								class="required"> </span>
							</label>
							<div class="col-md-10">
								<textarea class="ckeditor form-control"
									name="Information[description]" rows="4"
									data-error-container="#editor2_error"></textarea>
								<div id="editor2_error"></div>
							</div>
						</div>





						<div class="form-group">
							<label class="control-label col-md-2"> วันที่เริ่มแสดงข้อมูล:<span
								class="required">*</span></label>


							<div class="col-md-5">

								<input type="text" value="" id="period_start"
									name="Information[period_start]" />


								<div id="divReq-period_start"></div>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2"> วันที่สิ้นสดุดแสดงข้อมูล:<span
								class="required">*</span></label>


							<div class="col-md-5">

								<input type="text" value="" id="period_end"
									name="Information[period_end]" />


								<div id="divReq-period_end"></div>
							</div>
						</div>




						<div class="form-group">
							<label class="control-label col-md-2"> สถานะ:<span
								class="required"> * </span>
							</label>
							<div class="radio-list">
								<label class="radio-inline"> <input type="radio" id="status"
									name="Information[status]" value="A" checked="checked" />
									Active
								</label> <label class="radio-inline"> <input type="radio"
									id="status" name="Information[status]" value="I" />InActive
								</label>

							</div>
						</div>
					</div>
				</div>

				<!-- END FORM-->

			</div>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-9">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<button type="submit" class="btn green uppercase"><?php echo ConfigUtil::getBtnSaveButton();?></button>
								<?php echo CHtml::link(ConfigUtil::getBtnCancelButton(),array('Information/'),array('class'=>'btn btn-default uppercase'));?>
							</div>
						</div>
					</div>
					<div class="col-md-9"></div>
				</div>
			</div>
		</div>
	</div>

	<script
		src="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/jquery.min.js"
		type="text/javascript"></script>


	<script>
	var host = 'http://localhost:81/mu_rad';
    jQuery(document).ready(function () {

		 $.datepicker.regional['th'] ={
			        changeMonth: true,
			        changeYear: true,
			        //defaultDate: GetFxupdateDate(FxRateDateAndUpdate.d[0].Day),
			        yearOffSet: 543,
			        showOn: "button",
			        buttonImage: '/labbase/images/calendar.gif',
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
			
	    $( "#period_start" ).datepicker( $.datepicker.regional["th"] );
	    $( "#period_start" ).datepicker("setDate", new Date()); 

	    $( "#period_end" ).datepicker( $.datepicker.regional["th"] );
	    $( "#period_end" ).datepicker("setDate", new Date()); 

	    
	    $('.grpOfInt').keypress(function (event) {
            return isNumber(event);
        });
        
	 
    	$( "#Form1" ).submit(function( event ) {

        	if($("#catagories_id").val() == '0'){
	    		$("#catagories_id").closest('.form-group').addClass('has-error');
	    		$("#divReq-catagories_id").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
	    		$("#catagories_id").focus();
		    	return false;
	        }else{
	        	$("#divReq-catagories_id").html('');
	        	$("#catagories_id").closest('.form-group').removeClass('has-error');
	    	}
	    	
        	if($("#image_path").val().length == 0){
	    		$("#image_path").closest('.form-group').addClass('has-error');
	    		$("#divReq-image_path").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
	    		$("#image_path").focus();
	    		return false;
	        }else{
	        	$("#divReq-image_path").html('');
	        	$("#image_path").closest('.form-group').removeClass('has-error');
	    	}

        	if($("#short_description").val().length == 0){
	    		$("#short_description").closest('.form-group').addClass('has-error');
	    		$("#divReq-short_description").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
	    		$("#short_description").focus();
	    		return false;
	        }else{
	        	$("#divReq-short_description").html('');
	        	$("#short_description").closest('.form-group').removeClass('has-error');
	    	}

        	if($("#description").val().length == 0){
	    		$("#description").closest('.form-group').addClass('has-error');
	    		$("#divReq-description").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
	    		$("#description").focus();
	    		return false;
	        }else{
	        	$("#divReq-description").html('');
	        	$("#description").closest('.form-group').removeClass('has-error');
	    	}
	    	
    	   	if(!moment($("#period_start").val(), 'DD/MM/YYYY',true).isValid()){
        		$("#period_start").closest('.form-group').addClass('has-error');
        		$("#divReq-period_start").html("<span id=\"id-error\" class=\"help-block help-block-error\">รูปแบบวันที่ผิด จะต้องอยู่ในรูปแบบ dd/mm/yyyy เช่น 18/02/2526.</span>");
        		$("#period_start").focus();
        		return false;
            }else{
            	$("#divReq-period_start").html('');
            	$("#period_start").closest('.form-group').removeClass('has-error');
        	}

        	if($("#period_start").val().length == 0){
        		$("#period_start").closest('.form-group').addClass('has-error');
        		$("#divReq-period_start").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#period_start").focus();
        		return false;
            }else{
            	$("#divReq-period_start").html('');
            	$("#period_start").closest('.form-group').removeClass('has-error');
        	}

        	
    	   	if(!moment($("#period_end").val(), 'DD/MM/YYYY',true).isValid()){
        		$("#period_end").closest('.form-group').addClass('has-error');
        		$("#divReq-period_end").html("<span id=\"id-error\" class=\"help-block help-block-error\">รูปแบบวันที่ผิด จะต้องอยู่ในรูปแบบ dd/mm/yyyy เช่น 18/02/2526.</span>");
        		$("#period_end").focus();
        		return false;
            }else{
            	$("#divReq-period_end").html('');
            	$("#period_end").closest('.form-group').removeClass('has-error');
        	}

        	if($("#period_end").val().length == 0){
        		$("#period_end").closest('.form-group').addClass('has-error');
        		$("#divReq-period_end").html("<span id=\"id-error\" class=\"help-block help-block-error\">This field is required.</span>");
        		$("#period_end").focus();
        		return false;
            }else{
            	$("#divReq-period_end").html('');
            	$("#period_end").closest('.form-group').removeClass('has-error');
        	}
        	
        	this.submit();
    	});
    });
    
    
</script>

</form>