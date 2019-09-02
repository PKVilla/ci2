<div class="container mt-5">
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-header with-border">
					<div class="box-body">
						<table class="table" id="my_table">
							<thead>
								<tr>
									<th>Client Name</th>
									<th>Invoice No</th>
									<th>Client ID</th>
									<th>Due Date</th>
									<th>Balance</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data as $key => $value) {
									// echo json_decode($query);
									echo '<tr>
											<td>'.$value['client_name'].'</td>
											<td>'.$value['invoice_no'].'</td>
											<td>'.$value['client_id'].'</td>
											<td>'.$value['due_date'].'</td>
											<td>'.$value['balance'].'</td>
										 </tr>';
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#my_table').DataTable();
	});

	// function ajax(){
	// 	$.ajax({
	// 		type: 'post',
	// 		url: '<?php echo base_url(); ?>email_controller/view';
	// 		async: true,
	// 		dataType: 'json',
	// 		// data: data,
	// 		success: function(data){
	// 			console.log(data);
	// 		}
	// 	});
	// }
</script>