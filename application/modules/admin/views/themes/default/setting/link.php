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
    <li class="breadcrumb-item active">Link Terkait</li>
  </ol>

  <div class="container">

    <div class="page-title">
      <h4 style="margin-bottom: 0px">Setting - Link Terkait</h4>
    </div>
    <hr>
    <div class="animated fadeIn">
      <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-12">
          <div style="background: white; padding: 20px">
            <form class="form-horizontal" id="setting" action="<?= site_url('admin/setting/socialmedia') ?>" method="POST" enctype="multipart/form-data">
             
              <div class="form-group">
                <label>Link Terkait</label>
                <input type="text" name="site_name_link_1" placeholder="Nama Link" value="<?= @$link->site_name_link_1 ?>" class="form-control" required><br>
                <input type="url" name="site_link_1" placeholder="Link" value="<?= @$link->site_link_1 ?>" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Link Terkait</label>
                <input type="text" name="site_name_link_2" placeholder="Nama Link" value="<?= @$link->site_name_link_2 ?>" class="form-control" required><br>
                <input type="url" name="site_link_2" placeholder="Link" value="<?= @$link->site_link_2 ?>" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Link Terkait</label>
                <input type="text" name="site_name_link_3" placeholder="Nama Link" value="<?= @$link->site_name_link_3 ?>" class="form-control" required><br>
                <input type="url" name="site_link_3" placeholder="Link" value="<?= @$link->site_link_3 ?>" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Link Terkait</label>
                <input type="text" name="site_name_link_4" placeholder="Nama Link" value="<?= @$link->site_name_link_4 ?>" class="form-control" required><br>
                <input type="url" name="site_link_4" placeholder="Link" value="<?= @$link->site_link_4 ?>" class="form-control" required>
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