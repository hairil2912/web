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
    <li class="breadcrumb-item active">Category</li>
  </ol>

  <div class="container">

    <div class="page-title">
      <h4>Add New Category</h4>
    </div>

    <div class="animated fadeIn">

      <div class="row">

        <div class="col-lg-4">
          <form id="category_form" action="<?= site_url('admin/post/category') ?>" method="POST">
            <input type="hidden" name="id">
            <div class="form-group">
              <input type="text" name="category" placeholder="Enter Category" class="form-control" required="required">
            </div>
            <div class="form-group">
              <select id="category_parent" name="category_parent" class="form-control">
                <option value="">--Parent--</option>
                <?php foreach($categories_parent as $category): ?>
                  <option value="<?= $category->term_taxonomy_id ?>"><?= $category->name ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <textarea name="description" rows="4" placeholder="Category Description" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <button id="submit" type="submit" class="btn btn-sm btn-success">Save Category</button>
              <button id="cancel" type="button" style="display: none;" class="btn btn-sm btn-default">Cancel</button>
            </div>
          </form>
        </div>

        <div class="col-lg-8" id="category_lists">
          <div class="pull-right">
            <?php echo $this->ajax_pagination->create_links(); ?>
          </div>

          <table style="background: white" class="table table-responsive-sm table-striped table-bordered">
            <thead>
              <tr>
                <th>Category</th>
                <th>Description</th>
                <th width="60px"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($categories as $category): ?>
                <tr>
                  <td><?= $category->name ?></td>
                  <td><?= $category->description ?></td>
                  <td>
                    <a href="#" class="edit" data-id="<?= $category->term_taxonomy_id ?>"><i class="fa fa-edit"></i></a>
                    <a href="#" class="delete" data-id="<?= $category->term_taxonomy_id ?>" style="color: red"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
              <?php if(count($categories) < 1): ?>
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

      $('#category_form').submit(function(e){
        e.preventDefault();

        $.ajax({
          type: 'POST',
          url: $(this).attr('action'),
          data: $(this).serialize(),
          dataType: 'json',
          success: function(response){
             if (response.status === true) {
                $.get('<?= site_url('admin/post/category_ajax') ?>', function(html){
                  $('#category_lists').html(html)
                })

                var categories = '<option value="">--Parent--</option>';

                $.each(response.data, function(index, value){
                  categories += '<option value="'+value.term_taxonomy_id+'">'+value.name+'</optoion>'
                });

                $('#category_parent').html(categories);

                $('input, textarea, select').val('');
                $('#submit').text('Save Category');
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
          url: '<?= site_url('admin/post/category_edit') ?>',
          dataType: 'json',
          success: function(response){
            $('input[name=id]').val(response.term_taxonomy_id);
            $('input[name=category]').val(response.name);
            if (response.parent != 0) {
              $('select[name=category_parent]').val(response.parent);
            } else {
              $('select[name=category_parent]').val('');
            }
            $('textarea[name=description]').html(response.description);
            $('#submit').text('Update Category');
            $('#cancel').show();
          }
        })
      });

      $(document).on('click', '#cancel', function(){
        $('#submit').text('Save Category');
        $('input, textarea, select').val('');
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
            url: '<?= site_url('admin/post/category_delete') ?>',
            dataType: 'json',
            success: function(response){
              if (response.status === true) {
                $.get('<?= site_url('admin/post/category_ajax') ?>', function(html){
                  $('#category_lists').html(html)
                })

                var categories = '<option value="">--Parent--</option>';

                $.each(response.data, function(index, value){
                  categories += '<option value="'+value.term_taxonomy_id+'">'+value.name+'</optoion>'
                });

                $('#category_parent').html(categories);

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