<?php
$criteria = new CDbCriteria ();
switch (UserLoginUtils::getUserRoleName ()) {
	case UserLoginUtils::ADMIN :
	case UserLoginUtils::EXCUTIVE :
		break;
	case UserLoginUtils::STAFF :
	case UserLoginUtils::USER :
		$dept_id = isset ( UserLoginUtils::getRegisterInfo ()->dep_department_id ) ? UserLoginUtils::getRegisterInfo ()->dep_department_id : 0;
		$criteria->condition = " t.id = " . $dept_id;
		break;
}

$departments = MDepartment::model ()->findAll ( $criteria );

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
								<select class="form-control select2"
									name="LabRegister[dep_department_id]" id="dep_department_id">
									<option value="0">-- โปรดเลือก --</option>
			<?php foreach($departments as $item) {?>
			<option value="<?php echo $item->id?>"><?php echo $item->name?></option>
			<?php }?>
								</select>
							</div>
							<div id="divReq-department_id"></div>
						</div>
					</div>
				</div>
				<!-- 				<div class="well"> -->

				<!-- 				xxxx -->
				<!-- 				</div> -->
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
				<!-- 			<h4>Heading text goes here...</h4> -->
				<table class="table table-striped table-hover table-bordered"
					id="gvResult">
					<thead>
						<tr>
							<th>ลำดับ</th>
							<th>คณะ</th>
							<th>สังกัดหน่วยงาน</th>
							<th>อาคาร</th>
							<th>รหัสห้องปฏิบัติการ</th>
							<th class="no-sort">
							
							</th>
						</tr>
					</thead>
					<tbody>
	<?php
	$order = 1;
	foreach ( $dataProvider->data as $data ) {
		?>
				<tr>
							<td class="center"><?php echo $order?></td>
							<td class="center"><?php echo $data->faculty->name?></td>
							<td class="center"><?php echo $data->department->name?></td>
							<td class="center"><?php echo $data->build->name?></td>
							<td class="center"><?php echo $data->lab_code?></td>
							<td class="center">
							<a title="Edit" class="fa fa-edit"
									href="<?php echo Yii::app()->CreateUrl('SurveyBio/View/dept_id/'.$data->dep_department_id)?>"></a>
							</td>
						</tr>
			<?php
		$order ++;
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
