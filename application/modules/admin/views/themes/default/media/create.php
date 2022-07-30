<style type="text/css">
  p.box-title {
      color: rgba(109, 109, 109, 0.9333333333333333)
  }
</style>

<main class="main">

  <!-- Breadcrumb -->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item"><a href="#">Media</a></li>
    <li class="breadcrumb-item active">New Media</li>
  </ol>

  <div class="container">

    <div class="page-title">
      <h4>Add New Media</h4>
    </div>

    <div class="animated fadeIn">
      <div class="row">

        <div class="col-lg-12">
          <div class="form-group">
            <input type="text" name="title" placeholder="Enter Page Title" class="form-control">
          </div>
          <div class="form-group">
            <textarea id="summernote" rows="7" name="content" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <textarea name="content" placeholder="Excerpt" class="form-control"></textarea>
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
      

    }
  }
</script>