<main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Slide</a></li>
        <li class="breadcrumb-item active">All Slide</li>
      </ol>

      <div class="container">

        <div class="page-title">
          <h4>All Slides</h4><a href="<?= site_url('admin/slide/create') ?>" class="btn btn-sm btn-success">Add New</a>
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
                        <th>Thumbnail</th>
                        <th>Text 1</th>
                        <th>Text 2</th>
                        <th>Created On</th>
                        <th width="70"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($slides as $slide): ?>
                        <tr>
                          <td>
                            <a href="<?= base_url('assets/uploads/'. $slide->guid) ?>" target="_blank">
                              <img style="height: 60px" src="<?= base_url('assets/uploads/'. $slide->guid) ?>">
                            </a>  
                          </td>
                          <td><?= $slide->title ?></td>
                          <td><?= $slide->content ?></td>
                          <td><?= $slide->tanggal ?></td>
                          <td>
                            <a href="<?= site_url('admin/slide/edit/'. $slide->post_id) ?>"><i class="fa fa-edit"></i></a>
                            <a class="delete" data-id="<?= $slide->post_id ?>" href="#"><i style="color: red" class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if(count($slides) < 1): ?>
                        <tr>
                          <td colspan="5" style="text-align: center;">No slide found</td>
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
            url: '<?= site_url('admin/slide/delete') ?>',
            dataType: 'json',
            success: function(response){
              if (response.status === true) {
                tr.hide();
                alertify.success(response.pesan)
                if (response.slide_count == 0) {
                  $('table tbody').html('<tr>\
                    <td colspan="5" style="text-align: center;">No slide found</td>\
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