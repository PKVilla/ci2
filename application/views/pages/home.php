<?php $this->load->view('templates/header2'); ?>

<button id="blogs" class="btn btn-success" onclick="blogs()">Go to Blogs</button> <br> <br>

<script type="text/javascript">
	// $(document).ready(function($){
		// $('#blogs').on('click', function(){
		// 	window.location.assign('blogs/blogs_view');
		// });

		function blogs(){
			window.location.assign('<?php echo base_url(); ?>blogs/show_blog');
		}
	// });
</script>