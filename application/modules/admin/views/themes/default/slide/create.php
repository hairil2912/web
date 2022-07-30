<style type="text/css">
	p.box-title {
		color: rgba(109, 109, 109, 0.9333333333333333)
	}
</style>
<main class="main">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">Home</li>
		<li class="breadcrumb-item"><a href="<?= site_url('admin/slide/all') ?>">Slide</a></li>
		<?php if(@$slide->post_id): ?>
			<li class="breadcrumb-item active">Edit Slide</li>
		<?php else: ?>
			<li class="breadcrumb-item active">New Slide</li>
		<?php endif; ?>
	</ol>
	<div class="container">
		<div class="page-title">
			<h4 style="margin-bottom: 0px">Add New Slide</h4>
		</div>
		<hr>
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12">
					<div style="background: white; padding: 20px">
						<form class="form-horizontal" id="slide_form" action="<?= site_url('admin/slide/save') ?>" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label>Text 1</label>
								<input type="text" name="text1" placeholder="Slider Text 1" class="form-control" value="<?= @$slide->title ?>" required>
								<input class="jscolor form-control" name="text1_color" value="<?= (@$slide->text1_color) ? @$slide->text1_color : 'FFFFFF' ?>">
							</div>
							<div class="form-group">
								<label>Text 2</label>
								<input type="text" name="text2" placeholder="Slider Text 2" class="form-control" value="<?= @$slide->content ?>" required>
								<input class="jscolor form-control" name="text2_color" value="<?= (@$slide->text2_color) ? @$slide->text2_color : 'FFFFFF' ?>">
							</div>
							<div class="form-group">
								<label>Slider File</label>
								<input type="file" name="slide" placeholder="Slide" class="form-control input-sm" accept="image/*">
								<?php if(@$slide->post_id): ?>
									<p style="background: #f7f7f7; color: #989898; padding: 5px; font-size: 12px;">
										Leave the field empty if you want to use the previous slide
									</p>
								<?php endif; ?>
								<br>
								<div class="alert alert-success alert-dismissible" role="alert"> 
									<h4 style="margin-top: 0px;">
									<i class="fa fa-info"></i> 
										Informasi
									</h4> 
									<p>Size Gambar Slider : <em class="text-danger">100kb</em>,
									Resolusi Gambar Slider : <em class="text-danger">1920x800 pixels.</em>
									</p>
									<p></p>
								</div>
							</div>
							<div class="form-group">
								<?php if(@$slide->post_id): ?>
									<input type="hidden" name="post_id" value="<?= $slide->post_id ?>">
									<input type="hidden" name="_method" value="PUT">
									<button type="submit" class="btn btn-success">Update</button>
								<?php else: ?>
									<button type="submit" class="btn btn-success">Save</button>
								<?php endif; ?>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<script>
	document.onreadystatechange = () => {
		if ( document.readyState === 'complete' ) {
			$('#slide_form').submit(function(e){
				e.preventDefault();
				var data = new FormData($('#slide_form')[0]);
				$.ajax({
					type: 'POST',
					url: $(this).attr('action'),
					data: data,
					contentType: false,
					processData: false,
					dataType: 'json',
					success: function(response){
						if (response.status === true) {
							if (!response.update) {
								$('input').val('');
							}
							alertify.success(response.pesan)
						} else {
							alertify.error(response.pesan)
						}
					}
				});
			});
		}
	}
</script>