<style>
    .pt-100 {
        padding-top: 33px;
    }
</style>

<div id="dialog-form" title="Submit Testimoni">
    <form id="testimoni-form">
        <fieldset>
            <label for="name">Nama Lengkap</label><br>
            <input type="text" name="nama" id="nama" class="text ui-widget-content ui-corner-all klik-form"><br>
            <label for="pesan">Pesan</label><br>
            <textarea name="pesan" id="pesan" class="text ui-widget-content ui-corner-all klik-form" rows="4"></textarea><br>
            <label for="password">Foto</label><br>
            <input type="file" name="foto" id="foto" accept="image/*" class="text ui-widget-content ui-corner-all klik-form"><br>
        </fieldset>
    </form>
</div>
<div class="rs-footer-inner pb-100 md-pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <div class="footer-section pt-100">
                    <div class="footer-logo">
                        <img style="width: 233px; height:66px;" src="<?= base_url('assets/uploads/' . get_site_setting('site_icon')) ?>" alt="">
                    </div>
                    <div class="widget-desc">
                        <p>
                            <?= get_site_setting('site_address') ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="footer-section pl-60 md-pl-0 pt-100 md-pt-45">
                    <div class="footer-title">
                        <h3>Link Terkait</h3>
                    </div>
                    <div class="openingfoot">
                        <ul>
                            <li><a style="color:white;" target="_blank" href="<?= @get_site_setting('site_link_1'); ?>"><i class="fa fa-angle-right"></i> <?= @get_site_setting('site_name_link_1'); ?></a></li>
                            <li><a style="color:white;" target="_blank" href="<?= @get_site_setting('site_link_2'); ?>"><i class="fa fa-angle-right"></i> <?= @get_site_setting('site_name_link_2'); ?></a></li>
                            <li><a style="color:white;" target="_blank" href="<?= @get_site_setting('site_link_3'); ?>"><i class="fa fa-angle-right"></i> <?= @get_site_setting('site_name_link_3'); ?></a></li>
                            <li><a style="color:white;" target="_blank" href="<?= @get_site_setting('site_link_4'); ?>"><i class="fa fa-angle-right"></i> <?= @get_site_setting('site_name_link_4'); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="footer-section pl-60 md-pl-0 pt-100 md-pt-45">
                    <div class="footer-title">
                        <h3>Lest News</h3>
                    </div>
                    <div class="openingfoot">
                        <ul>
                            <?php foreach (latest_news(null) as $post) : ?>
                                <li><a style="color:white;" href="<?= site_url('detail/' . $post->slug) ?>"><i class="fa fa-angle-right"></i> <?= substr(strip_tags($post->title), 0, 20) ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="footer-section pt-100 md-pt-35">
                    <div class="footer-title">
                        <h3>SignUp For Newsletter</h3>
                    </div>
                    <div class="widget-desc md-mt-0">
                        <p>

                        </p>
                    </div>
                    <div class="btn-part mb-30">
                        <form>
                            <input type="email" name="email" placeholder="Enter Your Email" required>
                            <input type="submit" value="Sign up">
                            <i class="fa fa-arrow-down"></i>
                        </form>
                    </div>
                    <div class="social-icon">
                        <ul>
                            <li><a href="<?= @get_site_setting('site_facebook')?>"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="<?= @get_site_setting('site_twitter') ?>"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="<?= @get_site_setting('site_instagram') ?>"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="<?= @get_site_setting('site_linkedin'); ?>"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="<?= @get_site_setting('site_gplus') ?>"><i class="fa fa-google-plus-square"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="rs-footer-bottom part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="copy-right-part text-center">
                    <p>Copyright © <?= date('Y') ?> <?= get_site_setting('site_name') ?>. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="scrollUp">
    <i class="fa fa-angle-up"></i>
</div>

<div aria-hidden="true" class="modal fade search-modal" role="dialog" tabindex="-1">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span class="flaticon-cross"></span>
    </button>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="search-block clearfix">
                <form>
                    <div class="form-group">
                        <input class="form-control" placeholder="Search Here.." type="text">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/newsite/js/modernizr-2.8.3.min.js') ?>"></script>
<script src="<?= base_url('assets/newsite/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/newsite/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/newsite/js/wow.min.js') ?>"></script>
<script src="<?= base_url('assets/newsite/js/rsmenu-main.js') ?>"></script>
<script src="<?= base_url('assets/newsite/js/owl.carousel.min.js') ?>"></script>
<script src="<?= base_url('assets/newsite/js/jquery.counterup.min.js') ?>"></script>
<script src="<?= base_url('assets/newsite/js/waypoints.min.js') ?>"></script>
<script src="<?= base_url('assets/newsite/js/slick.min.js') ?>"></script>
<script src="<?= base_url('assets/newsite/js/main.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/site/js/jquery-ui.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/site/yoosa') ?>/js/notify.min.js"></script>
<script type="text/javascript">
    var dialog = $("#dialog-form").dialog({
        autoOpen: !1,
        height: 400,
        width: 350,
        modal: !0,
        buttons: {
            "Submit": submit,
            Cancel: function() {
                dialog.dialog("close")
            }
        },
        close: function() {}
    });

    function submit() {
        var data = new FormData($('#testimoni-form')[0]);
        $.ajax({
            type: 'POST',
            url: '<?= site_url('testimoni') ?>',
            data: data,
            contentType: !1,
            processData: !1,
            dataType: 'json',
            success: function(response) {
                $('.text-danger').remove();
                if (response.status === !1) {
                    $.each(response.error, function(index, value) {
                        $('#' + index).after(value)
                    })
                } else {
                    dialog.dialog('close')
                    alert(response.pesan)
                }
            }
        })
    }
    $("#isi_testimoni").button().on("click", function(e) {
        e.preventDefault();
        dialog.dialog("open")
    });
    var modal = document.getElementById('myModal');
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
        modal.style.display = "none"
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none"
        }
    }
    $('.not-available').click(function() {
        $('.modal').css('display', 'block')
    })
</script>
</body>

</html>