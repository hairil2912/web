</div>
<footer class="app-footer">
	<span><a href="http://coreui.io">CoreUI</a> © 2018 creativeLabs.</span>
	<span class="ml-auto">Powered by <a href="http://coreui.io">CoreUI</a></span>
</footer>

<script src="<?= site_url() ?>assets/admin/node_modules/jquery/dist/jquery.min.js"></script>
<script src="<?= site_url() ?>assets/admin/node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="<?= site_url() ?>assets/admin/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= site_url() ?>assets/admin/node_modules/pace-progress/pace.min.js"></script>
<script src="<?= site_url() ?>assets/admin/node_modules/alertifyjs/build/alertify.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript">
	alertify.defaults.transition = "slide";
	alertify.defaults.theme.ok = "btn btn-primary btn-sm";
	alertify.defaults.theme.cancel = "btn btn-danger btn-sm";
	alertify.defaults.theme.input = "form-control";
</script>

<script src="<?= site_url('assets/admin/') ?>jscolor.js"></script>
<script src="<?= site_url('assets/admin/') ?>src/js/app.js"></script>
<script src="<?= site_url('assets/admin/') ?>jquery.nestable.js"></script>
<?php if ($this->uri->segment(3) == 'create') : ?>
	<?php asset_js(); ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#summernote').summernote({
				height: 300,
				callbacks: {
					onImageUpload: function(files, editor, welEditable) {
						sendFile(files[0], editor, welEditable);
					}
				}
			});

			function sendFile(file, editor, welEditable) {
				data = new FormData();
				data.append("file", file);
				$.ajax({
					data: data,
					type: "POST",
					url: "<?= site_url('admin/media/summernote_upload') ?>",
					cache: false,
					dataType: 'json',
					contentType: false,
					processData: false,
					success: function(res) {
						if (res.status == true) {
							var image = $('<img>').attr('src', res.url);
							$('#summernote').summernote("insertNode", image[0]);
						} else {
							alertify.warning("<i class='fa fa-times'></i> " + res.message);
						}
					}
				});
			}
		});
	</script>
<?php endif ?>

</body>

</html>