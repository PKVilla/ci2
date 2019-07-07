<div class="container mt-5">
	<div id="alert" class="alert alert-success" role="alert">
		
	</div>	
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">Add Post</div>
				<div class="card-body">
					<form method="POST">
						<div class="form-group">
							<label class="for">Title</label>
							<input class="form-control" type="text" name="title" id="title" placeholder="Title">
						</div>
						<div class="form-group">
							<label class="for">Body</label>
							<textarea class="form-control" rows="5" id="body" name="body" placeholder="body"></textarea>
						</div>
						<button id="save" name="save" class="btn btn-success" type="submit" value="save data">Post</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#alert').hide();
		<?php if ($this->session->flashdata('message')) { ?>
			$('#alert').html('<?php echo $this->session->flashdata('message'); ?>').show();
			//setTimeout(function() { $("#alert").fadeOut('slow'); }, 1000);
			//$('#alert').fadeOut('slow');
		<?php } ?>
	});
</script>