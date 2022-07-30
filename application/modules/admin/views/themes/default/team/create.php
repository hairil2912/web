<style type="text/css">
  p.box-title {
      color: rgba(109, 109, 109, 0.9333333333333333)
  }
</style>

<main class="main">

  <!-- Breadcrumb -->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item"><a href="<?= site_url('admin/team/all') ?>">Team</a></li>
    <?php if(@$team->post_id): ?>
      <li class="breadcrumb-item active">Edit Team</li>
    <?php else: ?>
      <li class="breadcrumb-item active">New Team</li>
    <?php endif; ?>
  </ol>

  <div class="container">

    <div class="page-title">
      <h4 style="margin-bottom: 0px">Add New Team</h4>
    </div>
    <hr>
    <div class="animated fadeIn">
      <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-12">
          <div style="background: white; padding: 20px">
            <form class="form-horizontal" id="team_form" action="<?= site_url('admin/team/save') ?>" method="POST" enctype="multipart/form-data">
             
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" placeholder="Name" class="form-control" value="<?= @$team->title ?>" required>
              </div>
              <div class="form-group">
                <label>Job Title</label>
                <input type="text" name="jobtitle" placeholder="Job Title" class="form-control" value="<?= @$team->jobtitle ?>" required>
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea name="description" placeholder="Description" class="form-control" required rows="3"><?= @$team->content ?></textarea>
              </div>
              <div class="form-group">
                <label>Jadwal</label>
                <textarea id="summernote" rows="7" name="jadwal" placeholder="Enter Post Title" class="form-control"><?= @$team->jadwal ?></textarea>
              </div>
              <p># Social Link</p>
              <div class="form-group">
                <label>Facebook</label>
                <input type="url" name="facebook" placeholder="Facebook" class="form-control" value="<?= @$team->facebook ?>">
              </div>
              <div class="form-group">
                <label>Twitter</label>
                <input type="url" name="twitter" placeholder="Twitter" class="form-control" value="<?= @$team->twitter ?>">
              </div>
              <div class="form-group">
                <label>Google Plus</label>
                <input type="url" name="gplus" placeholder="Google Plus" class="form-control" value="<?= @$team->gplus ?>">
              </div>
              <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" placeholder="Image" class="form-control input-sm" accept="image/*" require>
                <?php if(@$team->post_id): ?>
                  <p style="background: #f7f7f7;
                            color: #989898;
                            padding: 5px;
                            font-size: 12px;">
                    Leave the field empty if you want to use the previous image</p>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <?php if(@$team->post_id): ?>
                  <input type="hidden" name="image_id" value="<?= $team->image_id ?>">
                  <input type="hidden" name="post_id" value="<?= $team->post_id ?>">
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
      <!--/.row-->

    </div>

  </div>
  <!-- /.conainer-fluid -->
</main>

<script>
  document.onreadystatechange = () => {
    if ( document.readyState === 'complete' ) {
      
      $('#team_form').submit(function(e){
        e.preventDefault();

        var data = new FormData($('#team_form')[0]);

        $.ajax({
          type: 'POST',
          url: $(this).attr('action'),
          data: data,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response){
            console.log(response);
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