<style type="text/css">
  p.box-title {
      color: rgba(109, 109, 109, 0.9333333333333333)
  }
</style>

<main class="main">

  <!-- Breadcrumb -->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item"><a href="#">Media</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('admin/media/gallery') ?>">Gallery</a></li>
    <?php if(@$gallery->gallery_header_id): ?>
      <li class="breadcrumb-item active">Edit Gallery</li>
    <?php else: ?>
      <li class="breadcrumb-item active">New Gallery</li>
    <?php endif; ?>
  </ol>

  <div class="container">

    <div class="page-title">
        <?php if(@$gallery->gallery_header_id): ?>
            <h4 style="margin-bottom: 0px">Edit Gallery</h4>
        <?php else: ?>
            <h4 style="margin-bottom: 0px">Add New Gallery</h4>
        <?php endif; ?>
      
    </div>
    <hr>
    <div class="animated fadeIn">
      <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-12">
          <div style="background: white; padding: 20px">
            <form class="form-horizontal" id="gallery_form" method="POST" action="<?= site_url('admin/media/gallery_save') ?>" enctype="multipart/form-data">
             
              <div class="form-group">
                <label>Gallery Title</label>
                <input type="text" name="title" placeholder="Title" class="form-control" value="<?= @$gallery->title ?>" required>
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea name="description" maxlength="140" id="description" class="form-control" placeholder="Gallery Description"><?= @$gallery->description ?></textarea>    
              </div>

              <div class="form-group" id="gallery_image_">
                <label>Gallery Images</label>
                <input type="file" name="images[]" class="form-control" style="margin-bottom: 2px">
                <div id="append_img">
                </div>
                <div class="pull-right" style="margin-top: 5px">
                    <button type="button" id="add_file" class="btn btn-success btn-sm">Add File</button>
                </div>
              </div>
            
              <div class="form-group">
                <?php if(@$gallery->gallery_header_id): ?>
                    <input type="hidden" name="id" value="<?= $gallery->gallery_header_id ?>">
                    <input type="hidden" name="_method" value="PUT">
                    <button type="submit" id="button" class="btn btn-success">Update</button>
                <?php else: ?>
                    <button type="submit" id="button" class="btn btn-success">Save</button>
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

        $(document).on('click', '#add_file', function(){
            $('#append_img').append('<input type="file" name="images[]" class="form-control" style="margin-bottom: 2px">');
        });

        $('#gallery_form').submit(function(e){
            e.preventDefault();

            var data = new FormData($('#gallery_form')[0]);

            $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: data,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response){

                console.log(response)

                if (response.status === true) {
                    if (!response.update) {
                        $('input, textarea').val('');

                        $('#gallery_image_').html(`<label>Gallery Images</label>
                            <input type="file" name="images[]" class="form-control" style="margin-bottom: 2px">
                            <div id="append_img">
                            </div>
                            <div class="pull-right" style="margin-top: 5px">
                                <button type="button" id="add_file" class="btn btn-success btn-sm">Add File</button>
                            </div>`);
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