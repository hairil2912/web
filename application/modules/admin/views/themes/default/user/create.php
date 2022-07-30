<style type="text/css">
  p.box-title {
      color: rgba(109, 109, 109, 0.9333333333333333)
  }
</style>

<main class="main">

  <!-- Breadcrumb -->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item"><a href="<?= site_url('admin/user/all') ?>">User</a></li>
    <?php if(@$user->user_id): ?>
      <li class="breadcrumb-item active">Edit User</li>
    <?php else: ?>
      <li class="breadcrumb-item active">New User</li>
    <?php endif; ?>
  </ol>

  <div class="container">

    <div class="page-title">
      <?php if(@$user->user_id): ?>
        <h4 style="margin-bottom: 0px">Edit User</h4>
      <?php else: ?>
        <h4 style="margin-bottom: 0px">Add New User</h4>
      <?php endif; ?>
      
    </div>
    <hr>
    <div class="animated fadeIn">
      <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-12">
          <div style="background: white; padding: 20px">
            <form class="form-horizontal" id="user_form" action="<?= site_url('admin/user/save') ?>" method="POST">
             
              <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="fullname" placeholder="Full Name" class="form-control" value="<?= @$user->fullname ?>" required>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Username" class="form-control" value="<?= @$user->email ?>" required>  
              </div>
              <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Username" class="form-control" value="<?= @$user->username ?>" required>  
              </div>
              <div class="form-group">
                <label>Password</label>
                <?php if(@$user->user_id): ?>
                  <input type="password" name="password" placeholder="Password" class="form-control"> 
                <?php else: ?>
                  <input type="password" name="password" placeholder="Password" class="form-control" required> 
                <?php endif; ?>
                 
              </div>

              <div class="form-group">
                <?php if(@$user->user_id): ?>
                  <input type="hidden" name="user_id" value="<?= $user->user_id ?>">
                  <input type="hidden" name="_method" value="PUT">
                  <button type="submit" class="btn btn-success">Update</button>
                <?php else: ?>
                  <button type="submit" class="btn btn-success">Save</button>
                <?php endif; ?>
              </div>
              
            </form>
          </div>
        </div>
      </div>
      <!--/.row-->

    </div>

  </div>
  <!-- /.conainer-fluid -->
</main>

<script>
  document.onreadystatechange = () => {
    if ( document.readyState === 'complete' ) {
        
      $('#user_form').submit(function(e){
        e.preventDefault();

        var data = new FormData($('#user_form')[0]);

        $.ajax({
          type: 'POST',
          url: $(this).attr('action'),
          data: data,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response){
            if (response.status === true) {
              if (!response.update) {
                $('input, textarea').val('');
              }
              alertify.success(response.pesan)
            } else {
              alertify.error(response.pesan)
            }
          }
        })

      })
    }
  }
</script>