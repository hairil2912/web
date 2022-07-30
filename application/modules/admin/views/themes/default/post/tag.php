<style type="text/css">
  p.box-title {
      color: rgba(109, 109, 109, 0.9333333333333333)
  }
</style>

<main class="main">

  <!-- Breadcrumb -->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item"><a href="#">Post</a></li>
    <li class="breadcrumb-item active">Tags</li>
  </ol>

  <div class="container">

    <div class="page-title">
      <h4>Add New Tag</h4>
    </div>

    <div class="animated fadeIn">
      <div class="row">

        <div class="col-lg-4">
          <form id="tag_form" action="<?= site_url('admin/post/tag') ?>" method="POST">
            <div class="form-group">
              <input type="hidden" name="id">
              <input type="text" name="tag" placeholder="Enter New Tag" class="form-control" required="required">
            </div>
            <div class="form-group">
              <textarea name="description" rows="4" placeholder="Tag Description" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <button id="submit" type="submit" class="btn btn-sm btn-success">Save Tag</button>
              <button id="cancel" type="button" style="display: none;" class="btn btn-sm btn-default">Cancel</button>
            </div>
          </form>
        </div>

        <div class="col-lg-8" id="tag_lists">
          <div class="pull-right">
            <?php echo $this->ajax_pagination->create_links(); ?>
          </div>

          <table style="background: white" class="table table-responsive-sm table-striped table-bordered">
            <thead>
              <tr>
                <th>Tag</th>
                <th>Description</th>
                <th width="60px"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($tags as $tag): ?>
                <tr>
                  <td><?= $tag->name ?></td>
                  <td><?= $tag->description ?></td>
                  <td>
                    <a href="#" class="edit" data-id="<?= $tag->term_taxonomy_id ?>"><i class="fa fa-edit"></i></a>
                    <a href="#" class="delete" data-id="<?= $tag->term_taxonomy_id ?>" style="color: red"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
              <?php if(count($tags) < 1): ?>
                <tr>
                  <td colspan="3">No record found</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
        <!--/.col-->
      </div>
      <!--/.row-->

    </div>

  </div>
  <!-- /.conainer-fluid -->
</main>

<script>
  document.onreadystatechange = () => {
    if ( document.readyState === 'complete' ) {

      $('#tag_form').submit(function(e){
        e.preventDefault();

        $.ajax({
          type: 'POST',
          url: $(this).attr('action'),
          data: $(this).serialize(),
          dataType: 'json',
          success: function(response){
             if (response.status === true) {
                $.get('<?= site_url('admin/post/tag_ajax') ?>', function(html){
                  $('#tag_lists').html(html)
                })

                $('input, textarea, select').val('');
                $('#submit').text('Save Tag');
                $('#cancel').hide();
                alertify.success(response.pesan)
              } else {
                alertify.error(response.pesan)
              }
          }
        })
      });

      $(document).on('click', '.edit', function(){
        var id = $(this).attr('data-id');

        $.ajax({
          type: 'POST',
          data: {
            id: id
          },
          url: '<?= site_url('admin/post/tag_edit') ?>',
          dataType: 'json',
          success: function(response){
            $('input[name=id]').val(response.term_taxonomy_id);
            $('input[name=tag]').val(response.name);
            $('textarea[name=description]').html(response.description);
            $('#submit').text('Update Tag');
            $('#cancel').show();
          }
        })
      });

      $(document).on('click', '#cancel', function(){
        $('#submit').text('Save Tag');
        $('input, textarea').val('');
        $(this).hide();
      });

      $(document).on('click', '.delete', function(){
        var id = $(this).attr('data-id');

        alertify.confirm('<i class="fa fa-info-circle"></i> Confirm', 'Are you sure want to delete the data?', function(){ 

          $.ajax({
            type: 'POST',
            data: {
              id: id
            },
            url: '<?= site_url('admin/post/tag_delete') ?>',
            dataType: 'json',
            success: function(response){
              if (response.status === true) {
                $.get('<?= site_url('admin/post/tag_ajax') ?>', function(html){
                  $('#tag_lists').html(html)
                })
                alertify.success(response.pesan);
              } else {
                alertify.success(response.pesan);
              }
            }
          });
        }, function(){

        });
      });
    }
  }
</script>