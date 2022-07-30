<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0.0
  </div>
  <strong>Copyright &copy; <?= date('Y') ?> <a href="#">Klikdata.</strong> All rights
  reserved.
</footer>

</div>
<!-- ./wrapper -->


<!-- jQuery 3 -->
<script src="<?= base_url('assets/pasien/') ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('assets/pasien/') ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/pasien/') ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= base_url('assets/pasien/') ?>dist/js/adminlte.min.js"></script>
<!-- <script src="<?= base_url('assets/pasien/') ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="<?= base_url('assets/pasien/') ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> -->
<script src="<?= base_url('assets/pasien/') ?>bower_components/select2/dist/js/select2.full.js"></script>
<script src="<?= base_url('assets/pasien/') ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url('assets/pasien/') ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?= base_url('assets/pasien/plugins/alertifyjs/alertify.min.js') ?>"></script>
<script src="<?= base_url('assets/pasien/plugins/jquery.blockUI.min.js') ?>"></script>
<script src="<?= base_url('assets/') ?>main.js"></script>
<!-- <script src="<?= base_url('assets/') ?>jquery.nestable.js"></script> -->
<script src="<?= base_url('assets/js.cookie.min.js') ?>"></script>
<!-- <script src="<?= base_url('node_modules/socket.io-client/dist/socket.io.js') ?>"></script> -->
<!-- <script src="<?= base_url('assets/') ?>cht.js"></script> -->
<!-- <?= stack('js') ?>
<?php if ($this->session->multiple['logged_in'] === true and $this->session->radiologi['multiple'] === true) : ?>
<script>
  $(document).ready(function() {
    $(document).on('click', '.changeModul', function(e) {
      e.preventDefault();
      $.get('<?= site_url('auth/selectModul') ?>', function(html) {
        $('#myModal').html(html).modal('show');
        $(document).on('click', '#btn-proses', function(e) {
          e.preventDefault();
          var modul = $("input[name=modul]:checked").val();
          $.ajax({
            url: '<?= site_url('auth/processModul') ?>',
            type: 'POST',
            data: {
              modul: modul
            },
            dataType: 'json',
            success: function(response) {
              if (response.status === true) {
                window.location.href = response.redirect;
              } else {
                alert(response.message);
              }
            }
          })
        });

        $(document).on('click', '.modul-list', function() {
          $('.modul-list').removeClass('selectedRow');
          $('input[name=modul]').prop('checked', false);
          $(this).addClass('selectedRow');
          $(this).find('input[name=modul]').prop('checked', true);
        });
      });
    })
  })
</script>
<?php endif; ?> -->
</body>

</html>