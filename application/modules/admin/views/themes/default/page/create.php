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
		<li class="breadcrumb-item"><a href="#">Page</a></li>
		<li class="breadcrumb-item active">New Page</li>
	</ol>
	<div class="container">
		<div class="page-title">
			<?php if(@$page->post_id): ?>
				<h4>Edit Page</h4>
			<?php else: ?>
				<h4>Add New Page</h4>
			<?php endif; ?>
		</div>
		<div class="animated fadeIn">
			<form id="form_post" action="<?= current_url() ?>" method="POST">
				<div class="row">
					<div class="col-lg-9">
						<div class="form-group">
							<input type="hidden" name="post_id" value="<?= @$page->post_id ?>">
							<input type="hidden" name="post_status">
							<input type="text" name="title" required placeholder="Enter Page Title" class="form-control" value="<?= @$page->title ?>">
						</div>
						<div class="form-group">
							<textarea id="summernote" rows="7" name="content" class="form-control"><?= @$page->content ?></textarea>
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
								<p class="box-title">Page Attributes</p>
								<div class="form-group">
									<select id="post_parent" name="post_parent" class="form-control input-sm">
										<option value="">--Parent--</option>
										<?php foreach($page_parent as $parent): ?>
											<option <?= ($parent->post_id == @$page->post_parent) ? 'selected' : '' ?> value="<?= $parent->post_id ?>"><?= $parent->title ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
						<!-- <div class="card"> -->
							<!-- <div class="card-body"> -->
								<!-- <p class="box-title">Featured Image</p> -->
								<!-- <?php if(empty(@$page->featured_image)): ?> -->
									<input type="hidden" name="featured_image">
									<img style="display: none" class="__featured_image" src="">
									<!-- <a style="margin-top: 5px;" id="select_feature_img" class="select" href="#">Select feature image</a> -->
								<!-- <?php else: ?>
									<input type="hidden" name="featured_image" value="<?= @$page->featured_image ?>">
									<img class="__featured_image" src="<?= base_url('assets/uploads/' . @$page->featured_image) ?>">
									<a style="margin-top: 5px;" id="select_feature_img" class="remove" href="#">Remove feature image</a>
								<?php endif; ?> -->
							<!-- </div> -->
						<!-- </div> -->
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
			});
		});

		$(document).on('change', 'input[type=radio][name=image]', function(){
			var label = $(this).closest('div');
			$('.img-radio').removeClass('check')
			label.addClass('check');
		});

		$(document).on('click', '.select_image', function(){
			var checked = $('input[type=radio][name=image]:checked', '#gallery').val();
			$('input[name=featured_image]').val(checked);
			$(".__featured_image").css('display', 'block').attr("src", '<?= base_url('assets/uploads/') ?>' + checked);
			$('#select_feature_img').removeClass('select').addClass('remove').text('Remove featured image');
			$('#myModal').modal('hide');
		});

		$(document).on('click', '#select_feature_img.remove', function(){
			$('#select_feature_img').removeClass('remove').addClass('select').text('Select featured image');
			$('input[name=featured_image]').val('');
			$(".__featured_image").css('display', 'none').attr("src", "");
		});

		$('#draft').click(function(){
			$('input[name=post_status]').val('draft');
		});

		$('#publish').click(function(){
			$('input[name=post_status]').val('publish');
		});

		$('#form_post').submit(function(e){
			e.preventDefault();
			var selected_parent = $('#post_parent').val();
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: $(this).serialize(),
				dataType: 'json',
				success: function(response){
					if (response.status === true) {
					var parent = '<option value="">--Parent--</option>';
						$.each(response.parent, function(index, value){
							var select = (value.post_id == selected_parent) ? 'selected' : '';
							parent += '<option '+select+' value="'+value.post_id+'">'+value.title+'</option>';
						});
						$('#post_parent').html(parent);
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