<main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Testimoni</a></li>
        <li class="breadcrumb-item active">All Testimoni</li>
      </ol>

      <div class="container">

        <div class="page-title">
          <h4>All Testimoni</h4><a href="<?= site_url('admin/testimoni/create') ?>" class="btn btn-sm btn-success">Add New</a>
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
                        <th>Name</th>
                        <th>Thumbnail</th>
                        <th width="500">Testimoni</th>
                        <th>Created On</th>
                        <th>Status</th>
                        <th width="70"></th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php foreach($testimoni as $testi): ?>
                        <tr>
                          <td><?= $testi->title ?></td>
                          <td>
                            <?php if(empty($testi->guid)): ?>
                              <img style="height: 60px" src="<?= site_url('assets/admin/img/noimg.png') ?>"/>
                            <?php else: ?>
                              <img style="height: 60px" src="<?= site_url('assets/uploads/'.$testi->guid) ?>"/>
                            <?php endif; ?>
                            
                          </td>
                          <td><?= substr($testi->content, 0, 100) ?>...</td>
                          <td><?= $testi->tanggal ?></td>
                          <td>
                            <select name="status" class="form-control input-sm status-testimoni" data-id="<?= $testi->post_id ?>">
                              <option <?= ($testi->status == 'publish' ? 'selected' : '') ?> value="publish">Publish</option>
                              <option <?= ($testi->status == 'pending' ? 'selected' : '') ?> value="pending">Pending</option>  
                            </select>
                          </td>
                          <td>
                            <a href="<?= site_url('admin/testimoni/edit/'. $testi->post_id) ?>"><i class="fa fa-edit"></i></a>
                            <a class="delete" data-id="<?= $testi->post_id ?>" href="#"><i style="color: red" class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if(count($testimoni) < 1): ?>
                        <tr>
                          <td colspan="5" style="text-align: center;">No testimoni found</td>
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
            url: '<?= site_url('admin/testimoni/delete') ?>',
            dataType: 'json',
            success: function(response){
              if (response.status === true) {
                tr.hide();
                alertify.success(response.pesan)
                if (response.testimoni_count == 0) {
                  $('table tbody').html('<tr>\
                    <td colspan="5" style="text-align: center;">No testimoni found</td>\
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

      $('.status-testimoni').on('change', function(){

        var id = $(this).attr('data-id');

        $.ajax({
          type: 'POST',
          url: '<?= site_url('admin/testimoni/change_status') ?>',
          data: {
            id: id,
            status: $(this).val()
          },
          dataType: 'json',
          success: function(response){
            alertify.success(response.pesan)
          }
        })

      });

    }
  }
</script>