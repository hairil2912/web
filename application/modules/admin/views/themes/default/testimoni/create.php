<style type="text/css">
  p.box-title {
      color: rgba(109, 109, 109, 0.9333333333333333)
  }
</style>

<main class="main">

  <!-- Breadcrumb -->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item"><a href="<?= site_url('admin/testimoni/all') ?>">Testimoni</a></li>
    <?php if(@$testimoni->post_id): ?>
      <li class="breadcrumb-item active">Edit Testimoni</li>
    <?php else: ?>
      <li class="breadcrumb-item active">New Testimoni</li>
    <?php endif; ?>
  </ol>

  <div class="container">

    <div class="page-title">
      <h4 style="margin-bottom: 0px">Add New Testimoni</h4>
    </div>
    <hr>
    <div class="animated fadeIn">
      <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-12">
          <div style="background: white; padding: 20px">
            <form class="form-horizontal" id="testimoni_form" action="<?= site_url('admin/testimoni/save') ?>" method="POST" enctype="multipart/form-data">
             
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" placeholder="Name" class="form-control" value="<?= @$testimoni->title ?>" required>
              </div>
              <div class="form-group">
                <label>Job Title</label>
                <input type="text" name="jobtitle" placeholder="Job Title" class="form-control" value="<?= @$testimoni->jobtitle ?>" required>
              </div>
              <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" placeholder="Date" class="form-control" value="<?= @$testimoni->date ?>" required>
              </div>
              <div class="form-group">
                <label>Testimoni</label>
                <textarea name="testimoni" placeholder="Testimoni" class="form-control" required rows="3"><?= @$testimoni->content ?></textarea>
              </div>
              <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" placeholder="Image" class="form-control input-sm" accept="image/*">
                <?php if(@$testimoni->post_id): ?>
                  <p style="background: #f7f7f7;
                            color: #989898;
                            padding: 5px;
                            font-size: 12px;">
                    Leave the field empty if you want to use the previous image</p>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <?php if(@$testimoni->post_id): ?>
                  <input type="hidden" name="image_id" value="<?= $testimoni->image_id ?>">
                  <input type="hidden" name="post_id" value="<?= $testimoni->post_id ?>">
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
        
      $('#testimoni_form').submit(function(e){
        e.preventDefault();

        var data = new FormData($('#testimoni_form')[0]);

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
                $('input, textarea').val('');
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