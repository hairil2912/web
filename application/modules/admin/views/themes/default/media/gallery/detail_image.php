<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><?= $gallery->title ?></h4>
</div>
<div class="modal-body">
    
    <div class="row">
        <?php foreach($images as $image): ?>
            <div class="col-xs-6 col-md-3" id="img-<?= $image->gallery_id ?>">
                <div style="position: absolute;
                            bottom: 0;
                            left: 15px;
                            background: #00000091;
                            width: 85%;">
                    <a class="delete_img" data-id="<?= $image->gallery_id ?>" href="#" style="font-size: 25px;
                        color: #fff;
                        padding: 10px;"><i class="fa fa-trash"></i></a>
                </div>
                <a href="#" class="thumbnail">
                <img src="<?= base_url('assets/uploads/' . $image->image); ?>" alt="..." style="width: 100%;     height: 130px;">
                </a>
            </div>
        <?php endforeach; ?>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>