<form id="Form1" method="POST" enctype="multipart/form-data"
	class="form-horizontal">

	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
	<div class="portlet light">
				<div class="portlet-title">
					<div class="caption">
						รายการแจ้งเตือน
					</div>
					<div class="actions">
					<?php echo  CHtml::link('ย้อนกลับ',array('Dashboard'),array('class'=>'btn btn-default btn-sm'));?>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-hover table-bordered"
						id="gvResult">
						<thead>
							<tr>
								<th>ลำดับ</th>
								<th>ประเภทรายงาน</th>
								<th>รายละเอียด</th>
								<th>วันที่</th>
								
							</tr>
						</thead>
						<tbody>
	<?php
	$counter = 1;
	
	$criteria = new CDbCriteria();
	$criteria->order = 'create_date DESC';
// 	$criteria->condition = " isRead=0";
	$dataProvider = Notify::model()->findAll($criteria);
	
	foreach ( $dataProvider as $data ) {
		?>
				<tr>
								<td class="center"><?php echo $counter?></td>
								<td class="center"><?php echo $data->title?></td>
								<td class="center"><?php echo $data->remark?></td>
								<td class="center"><?php echo $data->create_date?></td>
								
							</tr>
			<?php
			$counter++;}
	?>	

						</tbody>
					</table>

				</div>
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


	    // setup responsive extension: http://datatables.net/extensions/responsive/
	    responsive: true,

	    //"ordering": false, disable column ordering 
	    //"paging": false, disable pagination

	    "order": [
	        [0, 'asc']
	    ],
	    
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