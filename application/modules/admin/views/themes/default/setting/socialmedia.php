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
    <li class="breadcrumb-item active">Social Media</li>
  </ol>

  <div class="container">

    <div class="page-title">
      <h4 style="margin-bottom: 0px">Setting - Social Media</h4>
    </div>
    <hr>
    <div class="animated fadeIn">
      <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-12">
          <div style="background: white; padding: 20px">
            <form class="form-horizontal" id="setting" action="<?= site_url('admin/setting/socialmedia') ?>" method="POST" enctype="multipart/form-data">
             
              <div class="form-group">
                <label>Facebook</label>
                <input type="url" name="site_facebook" placeholder="Facebook" value="<?= @$setting->site_facebook ?>" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Twitter</label>
                <input type="url" name="site_twitter" placeholder="Twitter" value="<?= @$setting->site_twitter ?>" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Google Plus</label>
                <input type="url" name="site_gplus" placeholder="Google Plus" value="<?= @$setting->site_gplus ?>" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Instagram</label>
                <input type="url" name="site_instagram" placeholder="Instagram" value="<?= @$setting->site_instagram ?>" class="form-control" required>
              </div>
              <div class="form-group">
                <label>LinkedIn</label>
                <input type="url" name="site_linkedin" placeholder="LinkedIn" value="<?= @$setting->site_linkedin ?>" class="form-control" required>
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
    if ( document.readyState === 'complete' ) {
        
      $('#setting').submit(function(e){
        e.preventDefault();

        var data = new FormData($('#setting')[0]);

        $.ajax({
          type: 'POST',
          url: $(this).attr('action'),
          data: data,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response){
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