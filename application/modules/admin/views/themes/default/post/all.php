<style type="text/css">
  .separator {
    color: #888
  }
  hr.custom_hr {
    margin-top: 5px;
    margin-bottom: 10px;
  }
</style>

<main class="main">

  <!-- Breadcrumb -->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item"><a href="#">Post</a></li>
    <li class="breadcrumb-item active">All Post</li>
  </ol>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
          <div class="page-title">
            <h4>All Post</h4><a href="<?= site_url('admin/post/create') ?>" class="btn btn-sm btn-success">Add New</a>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <ul class="subsubsub pull-left">
          <li class="all">
            <a href="<?= site_url('admin/post/all') ?>" class="current">All
              <span class="count">(<?= (empty($count->all_post) or $count->all_post == null) ? 0 : $count->all_post ?>)</span>
            </a> |
          </li>
          <li class="publish">
            <a href="<?= site_url('admin/post/all?type=publish') ?>">Published 
              <span class="count">(<?= (empty($count->publish) or $count->publish == null) ? 0 : $count->publish ?>)</span>
            </a> |
          </li>
          <li class="draft">
            <a href="<?= site_url('admin/post/all?type=draft') ?>">Draft 
              <span class="count">(<?= (empty($count->draft) or $count->draft == null) ? 0 : $count->draft ?>)</span>
            </a> |
          </li>
          <li class="_trash">
            <a href="<?= site_url('admin/post/all?type=trash') ?>">Trash 
              <span class="count">(<?= (empty($count->trash) or $count->trash == null) ? 0 : $count->trash ?>)</span>
            </a>
          </li>
        </ul>
        
        <?php echo $links ?>
      </div>
    </div>

    <hr class="custom_hr">

    <div class="animated fadeIn">
      <div class="row">

        <div class="col-lg-12">
          <!-- <div class="card">
            <div class="card-body"> -->
              <table style="background: white" class="table table-responsive-sm table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Categories</th>
                    <th>Tags</th>
                    <th>Last Update</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($posts as $post): ?>
                    <tr>
                      <td>
                        <?= $post->title ?>
                        <br>
                          <?php if($post->status != 'trash'): ?>
                            <span><a href="<?= site_url('admin/post/create/'. $post->post_id) ?>"><i class="fa fa-edit"> Edit</i></a></span> <span class="separator">|</span>
                            <span><a href="#" style="color: red" class="trash" data-id="<?= $post->post_id ?>"><i class="fa fa-trash"> Trash</i></a></span>
                          <?php else: ?>
                            <span><a href="#" class="restore" data-id="<?= $post->post_id ?>"><i class="fa fa-reply"> Restore</i></a></span> <span class="separator">|</span>
                            <span><a href="#" style="color: red" class="delete" data-id="<?= $post->post_id ?>"><i class="fa fa-trash"> Permanently Delete</i></a></span>
                          <?php endif; ?>
                       </td>
                      <td><?= $post->author ?></td>
                      <td>
                          
                          <?php foreach (get_post_categories($post->post_id) as $category) {
                            echo '<span style="margin-right: 3px;" class="badge badge-primary">'.$category->name.'</span>';
                          } ?>

                      </td>
                      <td>
                          
                          <?php foreach (get_post_tags($post->post_id) as $category) {
                            echo '<span style="margin-right: 3px;" class="badge badge-primary">'.$category->name.'</span>';
                          } ?>

                      </td>
                      <td><?= $post->modified_on ?></td>
                    </tr>
                  <?php endforeach; ?>
                  <?php if(count($posts) < 1): ?>
                    <tr>
                      <td colspan="5">No record found</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
           <!--  </div>
          </div> -->
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

      $('.trash').click(function(){
        var id = $(this).attr('data-id');
        var tr = $(this).closest('tr');

        alertify.confirm('<i class="fa fa-info-circle"></i> Confirm', 'Are you sure want to delete the data?', function(){ 

          $.ajax({
            method: 'POST',
            data: {
              post_id: id
            },
            url: '<?= site_url('admin/post/trash') ?>',
            dataType: 'json',
            success: function(response){
              if (response.status === true) {
                tr.hide();

                $('.all .count').text('('+response.count.all_post+')');
                $('.publish .count').text('('+response.count.publish+')');
                $('.draft .count').text('('+response.count.draft+')');
                $('._trash .count').text('('+response.count.trash+')');

                alertify.success(response.pesan)
              } else {
                alertify.error(response.pesan)
              }
            }
          });

        }, function(){ 
          
        })

      });

      $('.restore').click(function(){
        var id = $(this).attr('data-id');
        var tr = $(this).closest('tr');

        alertify.confirm('<i class="fa fa-info-circle"></i> Confirm', 'Are you sure want to restore the data?', function(){ 

          $.ajax({
            method: 'POST',
            data: {
              post_id: id
            },
            url: '<?= site_url('admin/post/restore') ?>',
            dataType: 'json',
            success: function(response){
              if (response.status === true) {
                tr.hide();

                $('.all .count').text('('+response.count.all_post+')');
                $('.publish .count').text('('+response.count.publish+')');
                $('.draft .count').text('('+response.count.draft+')');
                $('._trash .count').text('('+response.count.trash+')');

                alertify.success(response.pesan)
              } else {
                alertify.error(response.pesan)
              }
            }
          });

        }, function(){ 
          
        })

      });

      $('.delete').click(function(){
        var id = $(this).attr('data-id');
        var tr = $(this).closest('tr');

        alertify.confirm('<i class="fa fa-info-circle"></i> Confirm', 'Are you sure want to permanently delete the data?', function(){ 

          $.ajax({
            method: 'POST',
            data: {
              post_id: id
            },
            url: '<?= site_url('admin/post/delete') ?>',
            dataType: 'json',
            success: function(response){
              if (response.status === true) {
                tr.hide();

                $('.all .count').text('('+response.count.all_post+')');
                $('.publish .count').text('('+response.count.publish+')');
                $('.draft .count').text('('+response.count.draft+')');
                $('._trash .count').text('('+response.count.trash+')');

                alertify.success(response.pesan)
              } else {
                alertify.error(response.pesan)
              }
            }
          });

        }, function(){ 
          
        })

      });
    }
  }
</script>