<form id="Form1" method="post" enctype="multipart/form-data"
	class="form-horizontal">

	<div class="portlet light">
		<div class="portlet-title">
			<div class="caption">
				
					<?php echo  MenuUtil::getMenuName($_SERVER['REQUEST_URI'])?>
				<span class="caption-helper">(ระบุเงื่อนไขสำหรับการค้นหา)</span>
			</div>
			<div class="actions">
			</div>
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
echo CommonUtil::getDepartment('');
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
													value="<?php echo ($data->report_date_to !='')? $data->report_date_to:  CommonUtil::getCurDate();?>"
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
		<div class="portlet-title">
			<div class="caption">
			<i class="fa fa-desktop"></i>
				<span class="caption-subject bold font-yellow-casablanca uppercase">ผลการค้นหา</span>
			</div>
			<div class="actions">

				
<a href="<?php echo Yii::app()->CreateUrl('Report/Report01Pdf/department_id/'.$data->department_id.'/report_date_from/'.(($data->report_date_from =='')?  CommonUtil::getDate(CommonUtil::getCurDate()) : CommonUtil::getDate($data->report_date_from)).'/report_date_to/'.(($data->report_date_to =='')? CommonUtil::getDate(CommonUtil::getCurDate()) :  CommonUtil::getDate($data->report_date_to)))?>" class="btn btn-primary btn-lg" role="button">Download (PDF)</a>

			</div>
		</div>
		<div class="portlet-body form">
			<div class="form-body">
				<!-- BEGIN FORM-->
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
								<th></th>
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
								<td class="center">
								<a title="Edit" class="fa fa-file-pdf-o"	href="<?php echo Yii::app()->CreateUrl('Report/ExportPdf/id/'.$data->id)?>"></a>
								
								</td>
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
        

    	$('#report_date_from').datepicker({language:'th-th',format:'dd/mm/yyyy'})
    	$('#report_date_to').datepicker({language:'th-th',format:'dd/mm/yyyy'})
    	
    	 


       
    	var table = $('#gvResult');

    	var oTable = table.dataTable({
// 	        dom: 'Bfrtip',
// 	        buttons: [
// 	             'copy', 'csv', 'excel', 'pdf', 'print'
// 	        	'excel',  'print'
// 	        ],
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
