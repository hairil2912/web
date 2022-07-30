<style type="text/css">

.dd { display: block; margin: 0; padding: 0; max-width: 600px; list-style: none; font-size: 13px; line-height: 20px; }

.dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
.dd-list .dd-list { padding-left: 30px; }
.dd-collapsed .dd-list { display: none; }

.dd-item,
.dd-empty,
.dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }

.dd-handle { display: block; height: 30px; margin: 5px 0; padding: 5px 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    -webkit-border-radius: 3px;
            border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd-handle:hover { color: #2ea8e5; background: #fff; }

.dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
.dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
.dd-item > button[data-action="collapse"]:before { content: '-'; }

.dd-placeholder,
.dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
.dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
    background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                      -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                         -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                              linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-size: 60px 60px;
    background-position: 0 0, 30px 30px;
}

.dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
.dd-dragel > .dd-item .dd-handle { margin-top: 0; }
.dd-dragel .dd-handle {
    -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
            box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
}

/**
 * Nestable Extras
 */

.nestable-lists { display: block; clear: both; padding: 30px 0; width: 100%; border: 0; border-top: 2px solid #ddd; border-bottom: 2px solid #ddd; }

#nestable-menu { padding: 0; margin: 20px 0; }

#nestable-output,
#nestable2-output { width: 100%; height: 7em; font-size: 0.75em; line-height: 1.333333em; font-family: Consolas, monospace; padding: 5px; box-sizing: border-box; -moz-box-sizing: border-box; }

#nestable2 .dd-handle {
    color: #fff;
    border: 1px solid #999;
    background: #bbb;
    background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
    background:    -moz-linear-gradient(top, #bbb 0%, #999 100%);
    background:         linear-gradient(top, #bbb 0%, #999 100%);
}
#nestable2 .dd-handle:hover { background: #bbb; }
#nestable2 .dd-item > button:before { color: #fff; }

@media only screen and (min-width: 700px) {

    .dd { width: 48%; }
    .dd + .dd { margin-left: 2%; }

}

.dd-hover > .dd-handle { background: #2ea8e5 !important; }

/**
 * Nestable Draggable Handles
 */

.dd3-content { display: block; height: 30px; margin: 5px 0; padding: 5px 10px 5px 40px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    -webkit-border-radius: 3px;
            border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd3-content:hover { color: #2ea8e5; background: #fff; }

.dd-dragel > .dd3-item > .dd3-content { margin: 0; }

.dd3-item > button { margin-left: 30px; }

.dd3-handle { position: absolute; margin: 0; left: 0; top: 0; cursor: pointer; width: 30px; text-indent: 100%; white-space: nowrap; overflow: hidden;
    border: 1px solid #aaa;
    background: #ddd;
    background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
    background:    -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
    background:         linear-gradient(top, #ddd 0%, #bbb 100%);
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.dd3-handle:before { content: '≡'; display: block; position: absolute; left: 0; top: 3px; width: 100%; text-align: center; text-indent: 0; color: #fff; font-size: 20px; font-weight: normal; }
.dd3-handle:hover { background: #ddd; }

/**
 * Socialite
 */

.socialite { display: block; float: left; height: 35px; }

    </style> 
 <!-- Main content -->
  <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Appearance</a></li>
        <li class="breadcrumb-item active">Menu</li>
      </ol>

      <div class="container">

        <div class="animated fadeIn">
          <div class="row">
            <div class="col-md-4">
              <div style="background: #fff; padding: 20px">

                <a data-toggle="collapse" href="#create" aria-expanded="false" aria-controls="collapseExample">
                  Create a New Menu
                </a>
                <div class="collapse" id="create">
                  <hr>
                  <form id="menu_form" action="<?= site_url('admin/appearance/menu') ?>" method="POST">
                    <div class="form-group">
                      <input type="text" name="menu" class="form-control form-sm" placeholder="Name of the menu" required>
                    </div>
                    <div class="form-group">
                      <select name="parent" class="form-control" id="menu_list">
                        <option value="0">--Menu Parent--</option>
                        <?php foreach($menus as $menu): ?>
                          <option value="<?= $menu->post_id ?>"><?= $menu->title ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="text" name="link" class="form-control form-sm" placeholder="Url" required>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-success">Save</button>
                    </div>
                  </form>
                </div>
                <hr>
                <a data-toggle="collapse" href="#pages" aria-expanded="false" aria-controls="collapseExample">
                  Add Menu From Page
                </a>
                <div class="collapse" id="pages">
                  <hr>
                  <?php foreach($pages as $page): ?>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="<?= $page->post_id ?>"> <?= $page->title ?>
                      </label>
                    </div>
                  <?php endforeach; ?>
                  <div class="form-group">
                    <button type="button" id="add_menu" class="btn btn-success">Add to Menu</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div style="background: #fff; padding: 20px">
                <p>Menus Tree</p>
                <hr>
                <div class="dd" id="nestable3">
                  <?php echo get_menus(); ?>
                </div>
                <hr>
              </div>
            </div>
          </div>
          <!--/.row-->
        </div>

      </div>
      <!-- /.conainer-fluid -->
  </main>

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <form id="edit_menu" action="<?= site_url('admin/appearance/menu') ?>" method="POST">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Edit Menu</h4>
          </div>
          <div class="modal-body">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    document.onreadystatechange = () => {
      if ( document.readyState === 'complete' ) {
        
        $('#menu_form').submit(function(e){
          e.preventDefault();

          $.ajax({
            type: 'POST',
            data: $(this).serialize(),
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(response){
              if (response.status === true) {
                $.get('<?= site_url('admin/appearance/fetch_menus') ?>', function(response){
                  $('#menu_list').html(response)
                });

                $.get('<?= site_url('admin/appearance/fetch_menus_tree') ?>', function(response){
                  $('#nestable3').html(response)

                  $('#nestable3').nestable({
                    maxDepth: 3
                  })
                  .on('change', updateOutput);
                });

                alertify.success(response.pesan)
              } else {
                alertify.error(response.pesan)
              }
            }
          })

        });
        
        var updateOutput = function(e)
        {
            var list = e.length ? e : $(e.target);
            var menus = list.nestable('serialize');

            $.ajax({
              type: 'POST',
              data: {
                menus: menus
              },
              dataType: 'json',
              url: '<?= site_url('admin/appearance/save_menu_structure') ?>',
              success: function(response){
                console.log(response)
              }
            })
        };


        $('#nestable-menu').on('click', function(e)
        {
            var target = $(e.target),
                action = target.data('action');
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
        });

        $('#nestable3').nestable({
          maxDepth: 3
        })
        .on('change', updateOutput);
        
        $('#nestable3').on('click', '.delete', function(e){
          e.preventDefault();

            var id = $(this).attr('data-id');
            alertify.confirm('<i class="fa fa-info-circle"></i> Confirm', 'Are you sure want to permanently delete the menu?', function(){ 

              $.ajax({
                method: 'POST',
                data: {
                  post_id: id
                },
                url: '<?= site_url('admin/appearance/delete_menu') ?>',
                dataType: 'json',
                success: function(response){
                
                  if (response.status === true) {
                    $.get('<?= site_url('admin/appearance/fetch_menus') ?>', function(response){
                      $('#menu_list').html(response)
                    });

                    $.get('<?= site_url('admin/appearance/fetch_menus_tree') ?>', function(response){
                      $('#nestable3').html(response)

                      $('#nestable3').nestable({
                        maxDepth: 3
                      })
                      .on('change', updateOutput);
                    });

                    alertify.success(response.pesan)
                  } else {
                    alertify.error(response.pesan)
                  }
                }
              });

            }, function(){ 
              
            })
        })

        $('#nestable3').on('click', '.edit', function(e){
          e.preventDefault();

          $.get('<?= site_url('admin/appearance/get_detail_menu/') ?>' + $(this).attr('data-id'), function(response){
            $('.modal-body').html(response);
          })

          $('#myModal').modal('show');
        });

        $(document).on('submit', '#edit_menu', function(e){
          e.preventDefault();

          $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response){
              console.log(response)
              if (response.status === true) {
                $.get('<?= site_url('admin/appearance/fetch_menus') ?>', function(response){
                  $('#menu_list').html(response)
                });

                $.get('<?= site_url('admin/appearance/fetch_menus_tree') ?>', function(response){
                  $('#nestable3').html(response)

                  $('#nestable3').nestable({
                    maxDepth: 3
                  })
                  .on('change', updateOutput);
                });
                
                $('#myModal').modal('hide');

                alertify.success(response.pesan)
              } else {
                alertify.error(response.pesan)
              }
            }
          })
        });

        $('#add_menu').click(function(e){
          e.preventDefault();

          var selected = [];
          $('#pages input:checked').each(function() {
              selected.push($(this).val());
          });

          $.ajax({
            type: 'POST',
            url: '<?= site_url('admin/appearance/add_multiple_menu_by_page') ?>',
            data: {
              ids: selected
            },
            dataType: 'json',
            success: function(response){
              if (response.status === true) {
                $.get('<?= site_url('admin/appearance/fetch_menus') ?>', function(response){
                  $('#menu_list').html(response)
                });

                $.get('<?= site_url('admin/appearance/fetch_menus_tree') ?>', function(response){
                  $('#nestable3').html(response)

                  $('#nestable3').nestable({
                    maxDepth: 3
                  })
                  .on('change', updateOutput);
                });
                
                $('#myModal').modal('hide');

                alertify.success(response.pesan)
              } else {
                alertify.error(response.pesan)
              }
            }
          })
        });
      }
    } 
  </script>