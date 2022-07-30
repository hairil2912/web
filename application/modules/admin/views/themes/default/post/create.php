<style type="text/css">
	p.box-title {
		color: rgba(109, 109, 109, 0.9333333333333333)
	}

	.bootstrap-tagsinput .tag {
		margin-right: 2px;
		color: white;
		background: #1ca8d9;
		padding: 2px 6px;
		border-radius: 3px;
	}

	.bootstrap-tagsinput input {
	width: 100% !important;
	}

	.bootstrap-tagsinput {
	display: block;
	border-radius: 0;
	}

	img.__featured_image {
		width: 100%;
		margin-bottom: 10px;
	}
</style>

<main class="main">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">Home</li>
		<li class="breadcrumb-item"><a href="#">Post</a></li>
		<li class="breadcrumb-item active">New Post</li>
	</ol>
	<div class="container">
		<div class="page-title">
			<?php if(@$post->post_id): ?>
				<h4>Edit Post</h4>
			<?php else: ?>
				<h4	h4>Add New Post</h4>
			<?php endif; ?>
		</div>
		<div class="animated fadeIn">
			<form id="form_post" action="<?= current_url() ?>" method="POST">
				<div class="row">
					<div class="col-lg-9">
						<div class="form-group">
							<input type="hidden" name="post_id" value="<?= @$post->post_id ?>">
							<input type="hidden" name="post_status">
							<input type="text" name="title" required placeholder="Enter Post Title" class="form-control" value="<?= @$post->title ?>">
						</div>
						<div class="form-group">
							<textarea id="summernote" rows="7" name="content" placeholder="Enter Post Title" class="form-control"><?= @$post->content ?></textarea>
						</div>
						<div class="form-group">
							<textarea name="excerpt" placeholder="Excerpt" class="form-control"><?= @$post->excerpt ?></textarea>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="card">
							<div class="card-body">
								<p class="box-title">Publish</p>
								<button type="submit" class="btn btn-sm btn-danger" id="draft">Save as Draft</button>
								<button type="submit" class="pull-right btn btn-sm btn-success" id="publish">Publish</button>
							</div>
						</div>
						<div class="card">
							<div class="card-body">
								<p class="box-title">Categories</p>
								<div class="list-category">
									<?php foreach($categories as $category): ?>
										<div class="checkbox">
										<label>
											<input <?= (in_array($category->term_taxonomy_id, explode('|', @$post->category))) ? 'checked' : '' ?> 
											name="categories[]" value="<?= $category->term_taxonomy_id ?>" type="checkbox"> <?= $category->name ?>
										</label>
										</div>
									<?php endforeach; ?>
								<?php if (count($categories) < 1) {
									echo '<p style="color: #b39797;font-style: italic;">Category not found.</p>';
								} ?>
								</div>
								<p class="box-title">Create a New Category</p>
								<div class="form-group">
									<input type="text" name="category" class="form-control input-sm">
								</div>
								<div class="form-group">
									<select name="category_parent" class="form-control input-sm">
										<option value="">--Parent--</option>
										<?php foreach($categories as $category): ?>
											<option value="<?= $category->term_taxonomy_id ?>"><?= $category->name ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group">
									<button id="submit_category" class="btn btn-success btn-sm">Create</button>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-body">
								<p class="box-title">Tags</p>
								<div class="form-group">
									<input type="text" id="tags" name="tags" data-role="tagsinput" class="form-control input-sm" value="<?= @$post->tags ?>">
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-body">
								<p class="box-title">Featured Image</p>
								<?php if(empty(@$post->featured_image)): ?>
									<input type="hidden" name="featured_image">
									<img style="display: none" class="__featured_image" src="">
									<a style="margin-top: 5px;" id="select_feature_img" class="select" href="#">Select feature image</a>
								<?php else: ?>
									<input type="hidden" name="featured_image" value="<?= @$post->featured_image ?>">
									<img class="__featured_image" src="<?= base_url('assets/uploads/' . @$post->featured_image) ?>">
									<a style="margin-top: 5px;" id="select_feature_img" class="remove" href="#">Remove feature image</a>
								<?php endif; ?>
								<br>
								<br>
								<div class="alert alert-success alert-dismissible" role="alert"> 
									<h4 style="margin-top: 0px;"><i class="fa fa-info"></i> Informasi</h4> 
									<p>Size Gambar Slider : <em class="text-danger">100kb</em></p>
									<p>Resolusi Gambar Slider : <em class="text-danger">1200x800 pixels.</em></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</main>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			</div>
			<div class="modal-body">...</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>

<script>
document.onreadystatechange = () => {
	if ( document.readyState === 'complete' ) {
		$(document).on('click', '#select_feature_img.select', function(){

			$.get('<?= site_url('admin/media/load_modal_media') ?>', function(response){
			$('#myModal .modal-dialog').addClass('modal-lg');
			$('.modal-content').html(response);
			$('#myModal').modal('show');
			})

		});

		$(document).on('change', 'input[type=radio][name=image]', function(){
			var label = $(this).closest('div');
			$('.img-radio').removeClass('check')
			label.addClass('check');
		});

		$(document).on('click', '.select_image', function(){
			var checked = $('input[type=radio][name=image]:checked', '#gallery').val();
			$('input[name=featured_image]').val(checked);

			$(".__featured_image").css('display', 'block')
								.attr("src", '<?= base_url('assets/uploads/') ?>' + checked);

			$('#select_feature_img').removeClass('select')
									.addClass('remove')
									.text('Remove featured image');

			$('#myModal').modal('hide');
		});

		$(document).on('click', '#select_feature_img.remove', function(){
			$('#select_feature_img').removeClass('remove')
									.addClass('select')
									.text('Select featured image');
			$('input[name=featured_image]').val('');
			$(".__featured_image").css('display', 'none')
								.attr("src", "");
		});

		$('#submit_category').click(function(e){	
		e.preventDefault();
			if ($('input[name=category]').val().length > 0) {
				$.ajax({
					type: 'POST',
					url: '<?= site_url('admin/post/category') ?>',
					data: {
						category: $('input[name=category]').val(),
						category_parent: $('select[name=category_parent]').find(':selected').val()
					},
					dataType: 'json',
					success: function(response){
						$('input[name=category]').val('');
						$('select[name=category_parent]').val('');
						if (response.status === true) {
							$.get('<?= site_url('admin/post/get_category') ?>', function(res){
								var res = JSON.parse(res);
								var categories = '';
								var parent = '<option value="">--Parent--</option>';
								$.each(res, function(index, value){
									categories += '<div class="checkbox">\<label>\<input style="margin-right: 4px;" name="categories[]" value="'+value.term_taxonomy_id+'" type="checkbox">'+value.name+'\</label>\</div>';
									parent += '<option value="'+value.term_taxonomy_id+'">'+value.name+'</option>';
								});
								$('.list-category').html(categories);
								$('select[name=category_parent]').html(parent);
							});
						}
					}
				});
			}
		});

		$('#draft').click(function(){
			$('input[name=post_status]').val('draft');
		});

		$('#publish').click(function(){
			$('input[name=post_status]').val('publish');
		});

		$('#form_post').submit(function(e){
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: $(this).serialize(),
				dataType: 'json',
				success: function(response){
					if (response.status === true) {
						if ( $('input[name=post_status]').val() == 'publish' ) {
							alertify.success("<i class='fa fa-check'></i> " + response.pesan);
						} else {
							alertify.success("<i class='fa fa-check'></i> Post successfully save as draft");
						}
						if (!response.update) {
							$('input:checkbox').removeAttr('checked');
							$('input, textarea').val('');
							$('#summernote').summernote('code', '');
							$('#tags').tagsinput('removeAll');
							$('#select_feature_img').removeClass('remove').addClass('select').text('Select featured image');
							$('input[name=featured_image]').val('');
							$(".__featured_image").css('display', 'none').attr("src", "");
							$("input:checkbox").prop('checked', false);
						}
					}
				}
			});
		});
	}
}
</script>