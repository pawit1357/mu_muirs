<?php
$deptParent = MDepartment::model()->findAll(array("condition"=>"faculty_id = -1",'order'=>'seq'));
$deptChild = MDepartment::model()->findAll(array("condition"=>"faculty_id <> -1",'order'=>'seq'));

$titles = MTitle::model ()->findAll ();
?>
<div class="content" style="width: 510px !important">
	<form id="Form1" method="post" enctype="multipart/form-data"
		class="form-horizontal">
		<h3 class="font-green">CREATE A NEW ACCOUNT</h3>
		<!-- 		<p class="hint">พิมพ์ข้อมูลส่วนตัว:</p> -->
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">คำนำหน้า</label>
			<select name="UsersLogin[title_id]" class="form-control"
				id="title_id">
				<option value="">-- คำนำหน้า --</option>
             <?php foreach($titles as $item) {?>
			<option value="<?php echo $item->id?>"><?php echo sprintf('%02d', $item->id).'-'. $item->name?></option>
			<?php }?>
                    </select>
		</div>
		<span class="hint">Your Name (กรอกชื่อนามสกุลเป็น ภาษาไทย
			ยกเว้นชาวต่างชาติ):</span>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">ชื่อ</label> <input
				class="form-control placeholder-no-fix" type="text" id="first_name"
				placeholder="ชื่อ" name="UsersLogin[first_name]" />
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">นามสกุล</label>
			<input class="form-control placeholder-no-fix" type="text"
				id="last_name" placeholder="นามสกุล" name="UsersLogin[last_name]" />
		</div>
		<span class="hint">Input your username (กรุณากรอกอีเมล์ของมหาวิทยาลัยมหิดลเท่านั้น)</span>

		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">อีเมล์</label> <input
				class="form-control placeholder-no-fix" type="text" id="email"
				placeholder="อีเมล์" name="UsersLogin[username]" />
		</div>
		<span class="hint">Create your password</span>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<input class="form-control placeholder-no-fix" type="password"
				autocomplete="off" id="register_password" placeholder="Password"
				name="UsersLogin[password]" />
		</div>
		<span class="hint">Confirm your password</span>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<input class="form-control placeholder-no-fix" type="password"
				autocomplete="off" id="register_password_confirm"
				placeholder="Confirm Password" />
		</div>

		<span class="hint">Facuty/Institute/Centre</span>

		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">ส่วนงาน</label>
			<select name="UsersLogin[department_id]" id="department_id"
				class="form-control">
<option value="">-- (ไม่มีสังกัด) --</option>
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
		<span class="hint">Contact Info</span>

		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Contact Info</label>
			<input class="form-control placeholder-no-fix" type="text"
				autocomplete="off" id="register_password" placeholder="Contact Info"
				name="UsersLogin[mobile_phone]" />
		</div>


		<div class="form-actions">
	
	
	
	<?php echo CHtml::link(ConfigUtil::getBtnCancelButton(),array('Site/'),array('class'=>'btn green btn-outline'));?>
	<button type="submit" class="btn btn-success uppercase pull-right">Sign
				Up</button>


		</div>



		<script
			src="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/jquery.min.js"
			type="text/javascript"></script>

		<script>
    jQuery(document).ready(function () {

//       $("#username").attr('maxlength','50');
//     	 $("#password").attr('maxlength','8');
//     	 $("#email").attr('maxlength','50');
//     	 $("#first_name").attr('maxlength','20');
//     	 $("#last_name").attr('maxlength','20');
//     	 $("#mobile_phone").attr('maxlength','20');



    	 
        	$( "#Form1" ).submit(function( event ) {
            	
            	if($("#title_id").val() == ""){
					alert("ยังไม่ได้เลือก คำนำหน้าชื่อ");
            		$("#title_id").focus();
            		return false;
                }
            	
            	if($("#first_name").val().length == 0){
            		alert("ยังไม่ได้ป้อน ชื่อ");
            		$("#first_name").focus();
            		return false;
              	}
            	if($("#last_name").val().length == 0){
            		alert("ยังไม่ได้ป้อน นามสกุล");
            		$("#last_name").focus();
            		return false;
              	}

              	
              	 var email = $('#email').val();
                	
            	if(email.length == 0){
            		alert("ยังไม่ได้ป้อน ชื่อผูใช้");
            		$("#email").focus();
            		return false;
              	}
                var freeRegex = /^[\w-\.]+@([mahidol.ac.th+\.])+[\w-]{2,4}$/;
                if(!email.match(freeRegex)) 
                {
                   alert("กรุณากรอกอีเมล์ของมหาวิทยาลัยมหิดลเท่านั้น")
                   return false;
                }
         	        
            	if($("#department_id").val() == ""){
					alert("ยังไม่ได้เลือก ส่วนงาน");
            		$("#department_id").focus();
            		return false;
                }
                
               	if($("#register_password").val().length == 0){
            		alert("ยังไม่ได้ ป้อนรหัสผ่าน");
            		$("#register_password").focus();
            		return false;
              	}
             	if($("#register_password_confirm").val().length == 0){
            		alert("ยังไม่ได้ ป้อนยืนยันรหัสผ่าน");
            		$("#register_password_confirm").focus();
            		return false;
              	}
             	if($("#register_password").val()!=$("#register_password_confirm").val()){
             		alert("รหัสผ่านที่ป้อนไม่ตรงกัน");
            		$("#register_password_confirm").focus();
            		return false;
                 }
              	

               		this.submit();
               		alert("สมัครเรียบร้อยแล้ว");
            	
        	});

    });
    

    
</script>
	</form>
</div>
