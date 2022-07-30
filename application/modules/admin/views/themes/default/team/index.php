<main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Team</a></li>
        <li class="breadcrumb-item active">All Team</li>
      </ol>

      <div class="container">

        <div class="page-title">
          <h4>All Team</h4><a href="<?= site_url('admin/team/create') ?>" class="btn btn-sm btn-success">Add New</a>
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
                        <th>Avatar</th>
                        <th>Job Title</th>
                        <th>Description</th>
                        <th>Social Link</th>
                        <th width="70"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($team as $t): ?>
                        <tr>
                            <td><?= $t->title ?></td>
                            <td>
                                <img style="height: 60px" src="<?= base_url('assets/uploads/' . $t->img) ?>" alt=""/>
                            </td>
                            <td><?= $t->jobtitle ?></td>
                            <td><?= $t->content ?></td>
                            <td>
                                <?php if(!empty($t->facebook)): ?>
                                    <a href="<?= $t->facebook ?>" target="_blank">Facebook</a><br>
                                <?php endif; ?>
                                <?php if(!empty($t->twiter)): ?>
                                    <a href="<?= $t->twiter ?>" target="_blank">Twiter</a><br>
                                <?php endif; ?>
                                <?php if(!empty($t->gplus)): ?>
                                    <a href="<?= $t->gplus ?>" target="_blank">Google Plus</a><br>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= site_url('admin/team/edit/'. $t->post_id) ?>"><i class="fa fa-edit"></i></a>
                                <a class="delete" data-id="<?= $t->post_id ?>" href="#"><i style="color: red" class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if(count($team) < 1): ?>
                        <tr>
                          <td colspan="6" style="text-align: center;">No team found</td>
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
            url: '<?= site_url('admin/team/delete') ?>',
            dataType: 'json',
            success: function(response){
              if (response.status === true) {
                tr.hide();
                alertify.success(response.pesan)
                if (response.team_count == 0) {
                  $('table tbody').html('<tr>\
                    <td colspan="5" style="text-align: center;">No team found</td>\
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