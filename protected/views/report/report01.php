<?php
$deptParent = MDepartment::model()->findAll(array("condition"=>"faculty_id = -1",'order'=>'seq'));
$deptChild = MDepartment::model()->findAll(array("condition"=>"faculty_id <> -1",'order'=>'seq'));


// $criteria = new CDbCriteria ();
// switch (UserLoginUtils::getUserRoleName ()) {
// 	case UserLoginUtils::ADMIN :
// 	case UserLoginUtils::EXCUTIVE :
// 		break;
// 	case UserLoginUtils::STAFF :
// 	case UserLoginUtils::USER :
// 		$dept_id = isset ( UserLoginUtils::getRegisterInfo ()->dep_department_id ) ? UserLoginUtils::getRegisterInfo ()->dep_department_id : 0;
// 		$criteria->condition = " t.id = " . $dept_id;
// 		break;
// }

// $departments = MDepartment::model ()->findAll ( $criteria );

?>
<form id="Form1" method="post" enctype="multipart/form-data"
	class="form-horizontal">

	<div class="portlet light">
		<div class="portlet-title">
			<div class="caption">
				
					<?php echo  MenuUtil::getMenuName($_SERVER['REQUEST_URI'])?>
				<span class="caption-helper">(ระบุเงื่อนไขสำหรับการค้นหา)</span>
			</div>
			<div class="actions"></div>
		</div>
		<div class="portlet-body form">
			<div class="form-body">
				<!-- BEGIN FORM-->
				<div class="row">
					<div class="col-md-9">
						<div class="form-group">
							<label class="control-label col-md-3">สังกัดหน่วยงาน:<span
								class="required">*</span></label>
							<div class="col-md-6">
<select class="form-control" name="Accident[department_id]" id="department_id" onchange="onchangeDepartment(this)">
<option value="-1">-- (ทั้งหมด) --</option>
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
        echo '<option style="color:#'.(intval($parent['faculty_id']) == -1? '008':'000').';font-style:normal;font-weight:normal;" value="'.$parent['id'].'" '. ($parent['id'] == $data->department_id? 'selected="selected"':'') .'>'.htmlspecialchars($parent['name']).'</option>';
    }
    
    foreach ($deptChild as $child) {
        if(intval($parent['id']) == intval($child['faculty_id'])){
            echo '<option style="color:#000;font-style:normal;font-weight:normal;" value="'.$child['id'].'" '. ($child['id'] == $data->department_id? 'selected="selected"':'') .'>&nbsp;&nbsp;&nbsp;-&nbsp;'.htmlspecialchars($child['name']).'</option>';
        }
    }
}
?>
</select>
							</div>
							<div id="divReq-department_id"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-9">
						<div class="form-group">
							<label class="control-label col-md-3">วันที่เกิดเหตุ (เริ่มต้น):
							<span class="required">*</span></label>
							<div class="col-md-6">
									<div class="input-group date date-picker"
										data-date-format="dd-mm-yyyy">
										<input type="text"
											value="<?php echo ($data->report_date_from !='')? $data->report_date_from: CommonUtil::getCurDate();?>"
											id="report_date_from" class="form-control"
											name="Accident[report_date_from]" /> <span
											class="input-group-btn">
											<button class="btn default" type="button">
												<i class="fa fa-calendar"></i>
											</button>
										</span>
									</div>
							</div>
						</div>
					</div>
					<div class="col-md-9">
						<div class="form-group">
							<label class="control-label col-md-3">
							วันที่เกิดเหตุ (สิ้นสุด):
							<span
								class="required">*</span></label>
							<div class="col-md-6">
											<div class="input-group date date-picker"
												data-date-format="dd-mm-yyyy">
												<input type="text"
													value="<?php echo ($data->report_date_from !='')? $data->report_date_to:  CommonUtil::getCurDate();?>"
													id="report_date_to" class="form-control"
													name="Accident[report_date_to]" /> <span
													class="input-group-btn">
													<button class="btn default" type="button">
														<i class="fa fa-calendar"></i>
													</button>
												</span>
											</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END FORM-->
			<div class="form-actions">
				<div class="row">
					<div class="col-md-9">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<input type='submit' name='submitBtn' id='submitBtn'
									class='btn green uppercase' value="ค้นหา" />
								<button type="reset" class="enableOnInput btn default uppercase">ยกเลิก</button>
							</div>
						</div>
					</div>
					<div class="col-md-9"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="portlet light">
		<div class="portlet-body form">
			<div class="form-body">
				<!-- BEGIN FORM-->
				<br>
				<br>
				<br>
					<table class="table table-striped table-hover table-bordered"
						id="gvResult">
						<thead>
							<tr>
								<th>ลำดับ</th>
								<th>ผู้รายงาน</th>
								<th>เบอร์โทรศัพท์</th>
								<th>คณะ/ส่วนงาน</th>
								<th>ลักษณะเหตุการณ์</th>
								<th>สถานที่เกิดเหตุ</th>
								<th>วัน/เดือน/ปี ที่เกิดเหตุ </th>
							</tr>
						</thead>
						<tbody>
	<?php
	$counter = 1;
	foreach ( $dataProvider->data as $data ) {
		?>
				<tr>
								<td class="center"><?php echo $counter?></td>
								<td class="center"><?php echo $data->name?></td>
								<td class="center"><?php echo $data->phone_number?></td>
								<td class="center"><?php echo $data->department->name?></td>
								<td class="center"><?php echo $data->accident_event?></td>
								<td class="center"><?php echo $data->accident_location?></td>
								<td class="center"><?php echo $data->case_date?></td>
							</tr>
			<?php
			$counter++;
	}
	?>	

						</tbody>
					</table>
			</div>
		</div>
	</div>
	<script
		src="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/jquery.min.js"
		type="text/javascript"></script>



	<script>
    jQuery(document).ready(function () {

		$.datetimepicker.setLocale('th'); // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
   	 	// กรณีใช้แบบ input
       $("#report_date_from").datetimepicker({
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
       $("#report_date_to").datetimepicker({
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
       $("#report_date_from").on("mouseenter mouseleave",function(e){
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
       $("#report_date_to").on("mouseenter mouseleave",function(e){
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



       
    	var table = $('#gvResult');

    	var oTable = table.dataTable({
	        dom: 'Bfrtip',
	        buttons: [
// 	             'copy', 'csv', 'excel', 'pdf', 'print'
	        	'excel',  'print'
	        ],
    	    // Internationalisation. For more info refer to http://datatables.net/manual/i18n
    	    "language": {
    	        "aria": {
    	            "sortAscending": ": activate to sort column ascending",
    	            "sortDescending": ": activate to sort column descending"
    	        },
    	        "emptyTable": "ไม่พบข้อมูล",
    	        "info": "แสดง  _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
    	        "infoEmpty": "No entries found",
    	        "infoFiltered": "(filtered1 from _MAX_ total entries)",
    	        "lengthMenu": "แสดงข้อมูล  _MENU_ รายการ",
    	        "search": "ใส่คำที่ต้องการค้นหา:",
    	        "zeroRecords": "ไม่พบรายการที่ค้นหา"
    	    },

    	    responsive: true,
    	    "searching": false,
    	    //"ordering": false, disable column ordering 
    	    //"paging": false, disable pagination

    	    "order": [ [0, 'asc']],
    	    "lengthMenu": [
    	        [5, 10, 15, 20, -1],
    	        [5, 10, 15, 20, "ทั้งหมด"] // change per page values here
    	    ],
    	    // set the initial value
    	    "pageLength": 10 ,
    	    "columnDefs": [ {
    	        "targets": 'no-sort',
    	        "orderable": false,
    	  } ]
    		});
    });
</script>

</form>
