<main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Media</a></li>
        <li class="breadcrumb-item active">Gallery</li>
      </ol>

      <div class="container">

        <div class="page-title">
          <h4>All Gallery</h4><a href="<?= site_url('admin/media/gallery_create') ?>" class="btn btn-sm btn-success">Add New</a>
        </div>
        <hr>
        <div class="animated fadeIn">
          <div class="row">

            <div class="col-lg-12">
              <!-- <div class="card">
                <div class="card-body"> -->
                  <table style="background: white" class="table table-responsive-sm table-striped table-bordered">
                    <thead>
                      <tr>
                        <th width="200">Title</th>
                        <th>Description</th>
                        <th width="100"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($gallery as $t): ?>
                        <tr>
                            <td><?= $t->title ?></td>
                            <td><?= $t->description ?></td>
                            <td>
                                <a href="#" class="detail" data-id="<?= $t->gallery_header_id ?>"><i class="fa fa-eye"></i></a>
                                
                                <a href="<?= site_url('admin/media/gallery_edit/'. $t->gallery_header_id) ?>"><i class="fa fa-edit"></i></a>
                                <a class="delete" data-id="<?= $t->gallery_header_id ?>" href="#"><i style="color: red" class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if(count($gallery) < 1): ?>
                        <tr>
                          <td colspan="6" style="text-align: center;">No gallery found</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                  <div class="pull-left">
                    <?= $links; ?>
                  
                  </div>
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
    </div>
  </div>
</div>

<script>
  document.onreadystatechange = () => {
    if ( document.readyState === 'complete' ) {

      $('table').on('click', '.delete', function(e){
        var id = $(this).attr('data-id');
        var tr = $(this).closest('tr');

        alertify.confirm('<i class="fa fa-info-circle"></i> Confirm', 'Are you sure want to permanently delete the data?', function(){ 

          $.ajax({
            method: 'POST',
            data: {
              id: id
            },
            url: '<?= site_url('admin/media/gallery_delete') ?>',
            dataType: 'json',
            success: function(response){
              if (response.status === true) {
                tr.hide();
                alertify.success(response.pesan)
                if (response.total == 0) {
                  $('table tbody').html('<tr>\
                    <td colspan="5" style="text-align: center;">No gallery found</td>\
                  </tr>');
                }
              } else {
                alertify.error(response.pesan)
              }
            }
          });

        }, function(){ 
          
        })
      });

      $('table').on('click', '.detail', function(e){
        e.preventDefault();

        $.get('<?= site_url('admin/media/detail_image_gallery?id=') ?>' + $(this).attr('data-id'), function(response){
          $('.modal-content').html(response);
          $('#myModal').modal('show');
        })
      })

      $(document).on('click', '.delete_img', function(e){
        e.preventDefault();
        
        var id = $(this).attr('data-id');

        if (confirm("Are you sure want to delete the image?")) {
          $('#img-'+id).remove();

          $.ajax({
            type: 'post',
            data: {
              id: id
            },
            url: '<?= site_url('admin/media/gallery_delete_image') ?>',
            success: function(response){}
          })

        }

      })
    }
  }
</script>