<main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Banner</a></li>
        <li class="breadcrumb-item active">All Banner</li>
      </ol>

      <div class="container">

        <div class="page-title">
          <h4>All Banner</h4><a href="<?= site_url('admin/banner/create') ?>" class="btn btn-sm btn-success">Add New</a>
        </div>
        <hr>
        <div class="animated fadeIn">
          <div class="row">

            <div class="col-lg-6">
              <!-- <div class="card">
                <div class="card-body"> -->
                  <table style="background: white" class="table table-responsive-sm table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Banner Image</th>
                        <th width="70"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($banners as $banner): ?>
                        <tr>
                          <td>
                            <img height="70" height="70" src="<?= base_url('assets/uploads/'. $banner->guid) ?>">
                          </td>
                          <td>
                            <a href="<?= site_url('admin/banner/edit/'. $banner->post_id) ?>"><i class="fa fa-edit"></i></a>
                            <a class="delete" data-id="<?= $banner->post_id ?>" href="#"><i style="color: red" class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if(count($banners) < 1): ?>
                        <tr>
                          <td colspan="5" style="text-align: center;">No banner found</td>
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
              post_id: id
            },
            url: '<?= site_url('admin/banner/delete') ?>',
            dataType: 'json',
            success: function(response){
              if (response.status === true) {
                tr.hide();
                alertify.success(response.pesan)
                if (response.slide_count == 0) {
                  $('table tbody').html('<tr>\
                    <td colspan="5" style="text-align: center;">No banner found</td>\
                  </tr>');
                }
              } else {
                alertify.error(response.pesan)
              }
            }
          });

        }, function(){ 
          
        })
      })

    }
  }
</script>