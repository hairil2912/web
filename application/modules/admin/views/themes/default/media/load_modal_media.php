<style type="text/css">
  .img-list {
    height: 97px;
    width: 97px;
    overflow: hidden;
    cursor: pointer;
  }
  .img-radio {
    display: inline-flex;
    position: relative;
  }
  input.custom-img-radio {
      display: none;
      padding: 11px;
      margin-right: 60px;
  }

  .check:after {
      content: "";
      top: 0;
      position: absolute;
      background: rgba(0, 183, 255, 0.4);
      width: 97px;
      height: 97px;
  }
  .img-l {
      max-height: 400px;
  }
  .modal-header {
    display: block !important;
  }
</style>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">Select image</h4>
</div>
<div class="modal-body">
  <div class="row">
    <div class="col-md-12 mb-4">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#upload_box" role="tab" aria-controls="upload_box">Upload Images</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#image_lists" role="tab" aria-controls="image_lists">Images Media</a>
        </li>
      </ul>

      <div class="tab-content">
        <div class="tab-pane active" id="upload_box" role="tabpanel">
          <form action="/file-upload" id="dropzone" class="dropzone">
            <div class="fallback">
              <input name="file" type="image" multiple />
            </div>
          </form>        </div>
        <div class="tab-pane" id="image_lists" role="tabpanel">
          <div class="row">
            <div class="col-md-12 pre-scrollable img-l">
              <form id="gallery">
                <?php foreach($images as $image): ?>

                  <?php if ( file_exists('./assets/uploads/'. $image->guid) ): ?>
                    <div class="radio img-radio">
                      <label>
                        <input class="custom-img-radio" type="radio" name="image" value="<?= $image->guid ?>">
                        <img class="img-list" src="<?= base_url('assets/uploads/'. $image->guid) ?>">
                      </label>
                    </div>
                  <?php endif; ?>
                <?php endforeach; ?>

                <?php
                  if (count($images) < 1) {
                    echo '<p style="color: #ec7676;">No image found.</p>';
                  }
                ?>

              </form>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12" style="padding-top: 15px;">
              <button class="select_image btn-success btn-sm pull-right">Select Image</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    var myDropzone = new Dropzone("#dropzone", {
      url: "<?= site_url('admin/media/upload') ?>",
      maxFilesize: 2,
      method:"post",
      acceptedFiles:"image/*",
      paramName:"userfile",
      dictInvalidFileType:"Type file ini tidak dizinkan",
      addRemoveLinks:true
    });

    myDropzone.on("complete", function(file) {

      alertify.success("Images uploaded successfully");

      $.get('<?= site_url('admin/media/get_media') ?>', function(html){
        $('#gallery').html(html);
      });
      myDropzone.removeFile(file);
    });

  });
</script>