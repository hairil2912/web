<div class="pull-right">
  <?php echo $this->ajax_pagination->create_links(); ?>
</div>

<table style="background: white" class="table table-responsive-sm table-striped table-bordered">
  <thead>
    <tr>
      <th>Tag</th>
      <th>Description</th>
      <th width="60px"></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($tags as $tag): ?>
      <tr>
        <td><?= $tag->name ?></td>
        <td><?= $tag->description ?></td>
        <td>
          <a href="#" class="edit" data-id="<?= $tag->term_taxonomy_id ?>"><i class="fa fa-edit"></i></a>
          <a href="#" class="delete" data-id="<?= $tag->term_taxonomy_id ?>" style="color: red"><i class="fa fa-trash"></i></a>
        </td>
      </tr>
    <?php endforeach; ?>
    <?php if(count($tags) < 1): ?>
      <tr>
        <td colspan="3">No record found</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>