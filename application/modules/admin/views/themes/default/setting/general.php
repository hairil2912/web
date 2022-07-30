<style type="text/css">
  p.box-title {
    color: rgba(109, 109, 109, 0.9333333333333333)
  }
</style>

<main class="main">

  <!-- Breadcrumb -->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item"><a href="#">Setting</a></li>
    <li class="breadcrumb-item active">General</li>
  </ol>

  <div class="container">

    <div class="page-title">
      <h4 style="margin-bottom: 0px">Setting - General</h4>
    </div>
    <hr>
    <div class="animated fadeIn">
      <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-12">
          <div style="background: white; padding: 20px">
            <form class="form-horizontal" id="setting" action="<?= site_url('admin/setting/general') ?>" method="POST" enctype="multipart/form-data">

              <div class="form-group">
                <label>Site Name</label>
                <input type="text" name="site_name" placeholder="Site Name" value="<?= @$setting->site_name ?>" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Site Description</label>
                <textarea name="site_description" placeholder="Site Description" class="form-control" required><?= @$setting->site_description ?></textarea>
              </div>
              <div class="form-group">
                <label>Address</label>
                <textarea name="site_address" placeholder="Address" class="form-control" required><?= @$setting->site_address ?></textarea>
              </div>
              <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="site_email" placeholder="Email" value="<?= @$setting->site_email ?>" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="site_contact" placeholder="Phone Number" value="<?= @$setting->site_contact ?>" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="">Jam Buka</label>
                <input type="text" name="site_open" placeholder="Jam Buka" value="<?= @$setting->site_open ?>" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Site Logo</label>
                <input type="hidden" name="icon_" value="<?= @$setting->site_icon ?>">
                <input type="file" name="icon" placeholder="Logo" class="form-control input-sm" accept="image/*" require>
              </div>
								<div class="alert alert-success alert-dismissible" role="alert"> 
									<h4 style="margin-top: 0px;">
									<i class="fa fa-info"></i> 
										Informasi
									</h4> 
									<p>Max Size Gambar : <em class="text-danger">300 kb</em>,<br>
									Resolusi Gambar : <em class="text-danger">2366x768 pixels</em>
									</p>
									<p></p>
								</div>
              <div class="form-group">
                <label>Color Header</label>
                <input class="jscolor form-control" name="color" value="<?= (@$color->color) ? @$color->color : 'FFFFFF' ?>">
              </div>
              <div class="form-group">
                <label for="">Color Menu</label>
                <input class="jscolor form-control" name="color_2" value="<?= (@$color->color_2) ? @$color->color_2 : 'FFFFFF' ?>">
              </div>
              <div class="form-group">
                <label for="">Color Copyright</label>
                <input class="jscolor form-control" name="color_3" value="<?= (@$color->color_3) ? @$color->color_3 : 'FFFFFF' ?>">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success">Update</button>
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

      $('#setting').submit(function(e) {
        e.preventDefault();

        var data = new FormData($('#setting')[0]);

        $.ajax({
          type: 'POST',
          url: $(this).attr('action'),
          data: data,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status === true) {
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