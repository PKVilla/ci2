<div class="container mt-5">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<input class="form-control" type="number" name="invoice" placeholder="search invoice">
				</div>
				<div class="card-body">
					<h3>Result</h3>
					<table id="invoice_search" class="table table-dark">
					  <thead>
					    <tr>
					      <th scope="col">Invoice no</th>
					      <th scope="col">Client Name</th>
					      <th scope="col">Email</th>
					      <th scope="col">Balance</th>
					    </tr>
					  </thead>
					  <tbody>
					    <tr>
					      <th scope="row">1</th>
					      <td>Mark</td>
					      <td>Otto</td>
					      <td>@mdo</td>
					    </tr>	
					  </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("#search").keyup(function(){
  		let invoice = $(this).val();
  		// console.log(word);
  		$.post("<?php echo base_url()?>search_con/search", {"invoice"+invoice}, function(data){
  			$("#invoice_search").html(data);
  		});

  	});

</script>