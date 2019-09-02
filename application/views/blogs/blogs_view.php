<!-- <div class="container mt-5 mb-5">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="add_search">
						<a class="btn btn-success" href="<?php echo base_url('blogs/create_blog');?>">Add Post</a>
						<form class="form-inline float-right">
					      <input id="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
					      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
					    </form>
					</div>
					<br>
					<?php foreach ($data as $value): ?>
						<label>Title</label>
						<h3><?php echo $value['TITLE']; ?></h3>
						<label>Post</label>
						<p><?php echo $value['BODY']; ?></p>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#search').keyup(function(){
			let word = $(this).val();
			$.post('<?php echo base_url('blogs/show_blog');?>', {word:word}, function(data){
				$('').html(data);
			});
		});
	});
</script> -->
<div class="container mt-5">
	<div class="row">
		<div class="col-lg-12">
			<!-- <div class="card"> -->
			<div class="box-body">
	  			<table id="dtMaterialDesignExample" class=" table table-striped table-bordered table-hover">
		   			<thead style="text-align: right;">
		   				<th style="text-align: center;width:3%;">Title</th>
		   				<th style="text-align: center;width:10%;">Body</th>
		   			</thead>
		   			<tbody>

			   			<?php foreach ($data as $value) {

			   				echo '<tr>';
			   				echo '<td style="text-align: center;">'.$value['TITLE'].'</td>';
			   				echo '<td style="text-align: center;">'.$value['BODY'].'</td>';
			   				echo '</tr>';
			   				}
		   				?>
		   			</tbody>	
	   			</table>
  			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#mytable').dataTable();
	});
</script>