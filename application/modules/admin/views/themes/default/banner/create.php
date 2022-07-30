<style type="text/css">
  p.box-title {
    color: rgba(109, 109, 109, 0.9333333333333333)
  }
</style>

<main class="main">

  <!-- Breadcrumb -->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item"><a href="<?= site_url('admin/banner/all') ?>">Banner</a></li>
    <?php if (@$banner->post_id) : ?>
      <li class="breadcrumb-item active">Edit Banner</li>
    <?php else : ?>
      <li class="breadcrumb-item active">New Banner</li>
    <?php endif; ?>
  </ol>

  <div class="container">

    <div class="page-title">
      <?php if (@$banner->post_id) : ?>
        <h4 style="margin-bottom: 0px">Edit Banner</h4>
      <?php else : ?>
        <h4 style="margin-bottom: 0px">Add New Banner</h4>
      <?php endif; ?>
    </div>
    <hr>
    <div class="animated fadeIn">
      <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-12">
          <div style="background: white; padding: 20px">
            <form class="form-horizontal" id="banner_form" action="<?= site_url('admin/banner/save') ?>" method="POST" enctype="multipart/form-data">

              <div class="form-group">
                <label>Banner Image</label>
                <input type="file" name="banner" placeholder="Banner" class="form-control input-sm" accept="image/*">
                <!-- <div class="alert alert-info">
                  <p style="margin-bottom: 0px;">Direkomendasikan gambar dengan ukuran <b>300x300</b></p>
                </div> -->
                <br>
								<div class="alert alert-success alert-dismissible" role="alert"> 
									<h4 style="margin-top: 0px;">
									<i class="fa fa-info"></i> 
										Informasi
									</h4> 
									<p>Max Size Gambar : <em class="text-danger">100kb</em>,<br>
									Resolusi Gambar : <em class="text-danger">1920x800 pixels</em>
									</p>
									<p></p>
								</div>
                <div class="form-group">
                  <label>Kata Sambutan</label>
                  <textarea id="summernote" rows="7" name="content" class="form-control"><?= @$banner->content ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <?php if (@$banner->post_id) : ?>
                  <input type="hidden" name="post_id" value="<?= $banner->post_id ?>">
                  <input type="hidden" name="_method" value="PUT">
                  <button type="submit" class="btn btn-success">Update</button>
                <?php else : ?>
                  <button type="submit" class="btn btn-success">Save</button>
                <?php endif; ?>
              </div>

            </form>
          </div>
        </div>
      </div>
      <!--/.row-->

    </div>

  </div>
  <!-- /.conainer-fluid -->
</main>

<script>
  document.onreadystatechange = () => {
    if (document.readyState === 'complete') {

      $('#banner_form').submit(function(e) {
        e.preventDefault();

        var data = new FormData($('#banner_form')[0]);

        $.ajax({
          type: 'POST',
          url: $(this).attr('action'),
          data: data,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status === true) {
              if (!response.update) {
                $('input').val('');
              }
              alertify.success(response.pesan)
            } else {
              alertify.error(response.pesan)
            }
          }
        })

      })
    }
  }
</script>