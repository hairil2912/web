<main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">User</a></li>
        <li class="breadcrumb-item active">All Users</li>
      </ol>

      <div class="container">

        <div class="page-title">
          <h4>All Users</h4><a href="<?= site_url('admin/user/create') ?>" class="btn btn-sm btn-success">Add New</a>
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
                        <th width="200">Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th width="70"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($users as $user): ?>
                        <tr>
                            <td><?= $user->fullname ?></td>
                            <td><?= $user->username ?></td>
                            <td><?= $user->email ?></td>
                            <td><?= $user->level == 0 ? 'Super User' : 'Operator' ?></td>
                            <td>
                                <?php if($user->level == $this->session->user->level): ?>
                                  <a href="<?= site_url('admin/user/edit/'. $user->user_id) ?>"><i class="fa fa-edit"></i></a>
                                <?php else: ?>
                                  <a href="<?= site_url('admin/user/edit/'. $user->user_id) ?>"><i class="fa fa-edit"></i></a>
                                  
                                  <a class="delete" data-id="<?= $user->user_id ?>" href="#"><i style="color: red" class="fa fa-trash"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                      <?php endforeach; ?>
                      <?php if(count($users) < 1): ?>
                        <tr>
                          <td colspan="6" style="text-align: center;">No user found</td>
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

        alertify.confirm('<i class="fa fa-info-circle"></i> Confirm', 'Are you sure want to permanently delete the user?', function(){ 

          $.ajax({
            method: 'POST',
            data: {
              user_id: id
            },
            url: '<?= site_url('admin/user/delete') ?>',
            dataType: 'json',
            success: function(response){
              if (response.status === true) {
                tr.hide();
                alertify.success(response.pesan)
                if (response.total == 0) {
                  $('table tbody').html('<tr>\
                    <td colspan="5" style="text-align: center;">No user found</td>\
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