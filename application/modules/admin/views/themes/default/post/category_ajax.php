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