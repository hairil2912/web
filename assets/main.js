function getCookies(cookieName) {
  if ($.Cookies || $.fn.Cookies) {
    return Cookies.get(cookieName);
  }
  return '';
}

var Main = function (param) {
  /*
   * table selector
   */
  this.getTable;
  this.tableId;
  this.getTable2;
  this.getTable3;
  this.getTable4;
  this.getTable5;
  this.tokenName;
  /*
   * table number, default true
   */
  this.tableNumber = true;
  this.tableNumber2 = true;
  this.tableNumber3 = true;
  this.tableNumber4 = true;
  this.tableNumber5 = true;
  this.lang = 'id';

  if (typeof param === "object") {
    this.btnSave = param.btnSave;
    this.btnCancel = param.btnCancel;
    this.btnUpdate = param.btnUpdate;
    this.confirmTitle = param.confirmTitle;
    this.deleteConfirm = param.deleteConfirm;
    this.tokenName = param.tokenName;
  }
}

Main.prototype = {
  /*
   * Datatable server side rendering
   * Make sure you have include Datatable plugin
   * @param table String
   */

  datatable: function (IDtable, columnDefs = function () { }, data = function (data) { }, createdRow=function(row,data,index){}) {
    this.tableId = IDtable;
    var self = this;

    var table = $(IDtable).DataTable({
      //"responsive": true,
      "order": [],
      "columnDefs": columnDefs.call(this),
      "processing": true,
      "serverSide": true,
      "deferRender": true,
      "ajax": {
        "url": $(IDtable).attr('data-url') + '?loader=false',
        "type": "POST",
        "data": data
      },
      "fnCreatedRow": function (row, data, index) {
        $('[data-toggle="tooltip"]').tooltip();
        if (self.tableNumber == true) {
          $('td', row).eq(0).html(index + 1);
        }
        createdRow(row, data, index);
      },
      "fnDrawCallback": function (oSettings) {
        $('[data-toggle="tooltip"]').tooltip();
        $('#bulk_action').val('');
        $('.dataTables_paginate > .pagination').addClass('pagination-sm');
      },
      "language": {
        "sProcessing": "Sedang memproses...",
        "sLengthMenu": "Tampilkan _MENU_ entri",
        "sZeroRecords": "Tidak ditemukan data yang sesuai",
        "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
        "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
        "sInfoPostFix": "",
        "sSearch": "Cari:",
        "sUrl": "",
        "oPaginate": {
          "sFirst": "Pertama",
          "sPrevious": "Sebelumnya",
          "sNext": "Selanjutnya",
          "sLast": "Terakhir"
        }
      },
      "initComplete": function (settings, json) {
        $(IDtable+'_filter input').unbind();
        $(IDtable+'_filter input').bind('keyup', function (e) {
          if (e.keyCode == 13) {
            table.search(this.value).draw();
          }
        });
      }
    });
    //new $.fn.dataTable.FixedHeader( table );
    this.getTable = table;
  },

  datatable2: function (IDtable, columnDefs = function () { }, data = function (data) { }, createdRow=function(row,data,index){}) {
    this.tableId = IDtable;
    var self = this;

    var table = $(IDtable).DataTable({
      //"responsive": true,
      "order": [],
      "columnDefs": columnDefs.call(this),
      "processing": true,
      "serverSide": true,
      "deferRender": true,
      "ajax": {
        "url": $(IDtable).attr('data-url') + '?loader=false',
        "type": "POST",
        "data": data
      },
      "fnCreatedRow": function (row, data, index) {
        $('[data-toggle="tooltip"]').tooltip();
        if (self.tableNumber2 == true) {
          $('td', row).eq(0).html(index + 1);
        }
        createdRow(row, data, index);
      },
      "fnDrawCallback": function (oSettings) {
        $('[data-toggle="tooltip"]').tooltip();
        $('#bulk_action').val('');
        $('.dataTables_paginate > .pagination').addClass('pagination-sm');
      },
      "language": {
        "sProcessing": "Sedang memproses...",
        "sLengthMenu": "Tampilkan _MENU_ entri",
        "sZeroRecords": "Tidak ditemukan data yang sesuai",
        "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
        "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
        "sInfoPostFix": "",
        "sSearch": "Cari:",
        "sUrl": "",
        "oPaginate": {
          "sFirst": "Pertama",
          "sPrevious": "Sebelumnya",
          "sNext": "Selanjutnya",
          "sLast": "Terakhir"
        }
      },
      "initComplete": function (settings, json) {
        $(IDtable+'_filter input').unbind();
        $(IDtable+'_filter input').bind('keyup', function (e) {
          if (e.keyCode == 13) {
            table.search(this.value).draw();
          }
        });
      }
    });
    //new $.fn.dataTable.FixedHeader( table );
    this.getTable2 = table;
  },
  datatable3: function (IDtable, columnDefs = function () { }, data = function (data) { }, createdRow=function(row,data,index){}) {
    this.tableId = IDtable;
    var self = this;

    var table = $(IDtable).DataTable({
      //"responsive": true,
      "order": [],
      "columnDefs": columnDefs.call(this),
      "processing": true,
      "serverSide": true,
      "deferRender": true,
      "ajax": {
        "url": $(IDtable).attr('data-url') + '?loader=false',
        "type": "POST",
        "data": data
      },
      "fnCreatedRow": function (row, data, index) {
        $('[data-toggle="tooltip"]').tooltip();
        if (self.tableNumber3 == true) {
          $('td', row).eq(0).html(index + 1);
        }
        createdRow(row, data, index);
      },
      "fnDrawCallback": function (oSettings) {
        $('[data-toggle="tooltip"]').tooltip();
        $('#bulk_action').val('');
        $('.dataTables_paginate > .pagination').addClass('pagination-sm');
      },
      "language": {
        "sProcessing": "Sedang memproses...",
        "sLengthMenu": "Tampilkan _MENU_ entri",
        "sZeroRecords": "Tidak ditemukan data yang sesuai",
        "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
        "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
        "sInfoPostFix": "",
        "sSearch": "Cari:",
        "sUrl": "",
        "oPaginate": {
          "sFirst": "Pertama",
          "sPrevious": "Sebelumnya",
          "sNext": "Selanjutnya",
          "sLast": "Terakhir"
        }
      },
      "initComplete": function (settings, json) {
        $(IDtable+'_filter input').unbind();
        $(IDtable+'_filter input').bind('keyup', function (e) {
          if (e.keyCode == 13) {
            table.search(this.value).draw();
          }
        });
      }
    });
    //new $.fn.dataTable.FixedHeader( table );
    this.getTable3 = table;
  },
  datatable4: function (IDtable, columnDefs = function () { }, data = function (data) { }, createdRow=function(row,data,index){}) {
    this.tableId = IDtable;
    var self = this;

    var table = $(IDtable).DataTable({
      //"responsive": true,
      "order": [],
      "columnDefs": columnDefs.call(this),
      "processing": true,
      "serverSide": true,
      "deferRender": true,
      "ajax": {
        "url": $(IDtable).attr('data-url') + '?loader=false',
        "type": "POST",
        "data": data
      },
      "fnCreatedRow": function (row, data, index) {
        $('[data-toggle="tooltip"]').tooltip();
        if (self.tableNumber4 == true) {
          $('td', row).eq(0).html(index + 1);
        }
        createdRow(row, data, index);
      },
      "fnDrawCallback": function (oSettings) {
        $('[data-toggle="tooltip"]').tooltip();
        $('#bulk_action').val('');
        $('.dataTables_paginate > .pagination').addClass('pagination-sm');
      },
      "language": {
        "sProcessing": "Sedang memproses...",
        "sLengthMenu": "Tampilkan _MENU_ entri",
        "sZeroRecords": "Tidak ditemukan data yang sesuai",
        "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
        "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
        "sInfoPostFix": "",
        "sSearch": "Cari:",
        "sUrl": "",
        "oPaginate": {
          "sFirst": "Pertama",
          "sPrevious": "Sebelumnya",
          "sNext": "Selanjutnya",
          "sLast": "Terakhir"
        }
      },
      "initComplete": function (settings, json) {
        $(IDtable+'_filter input').unbind();
        $(IDtable+'_filter input').bind('keyup', function (e) {
          if (e.keyCode == 13) {
            table.search(this.value).draw();
          }
        });
      }
    });
    //new $.fn.dataTable.FixedHeader( table );
    this.getTable4 = table;
  },
  datatable5: function (IDtable, columnDefs = function () { }, data = function (data) { }, createdRow=function(row,data,index){}) {
    this.tableId = IDtable;
    var self = this;

    var table = $(IDtable).DataTable({
      //"responsive": true,
      "order": [],
      "columnDefs": columnDefs.call(this),
      "processing": true,
      "serverSide": true,
      "deferRender": true,
      "ajax": {
        "url": $(IDtable).attr('data-url') + '?loader=false',
        "type": "POST",
        "data": data
      },
      "fnCreatedRow": function (row, data, index) {
        $('[data-toggle="tooltip"]').tooltip();
        if (self.tableNumber5 == true) {
          $('td', row).eq(0).html(index + 1);
        }
        createdRow(row, data, index);
      },
      "fnDrawCallback": function (oSettings) {
        $('[data-toggle="tooltip"]').tooltip();
        $('#bulk_action').val('');
        $('.dataTables_paginate > .pagination').addClass('pagination-sm');
      },
      "language": {
        "sProcessing": "Sedang memproses...",
        "sLengthMenu": "Tampilkan _MENU_ entri",
        "sZeroRecords": "Tidak ditemukan data yang sesuai",
        "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
        "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
        "sInfoPostFix": "",
        "sSearch": "Cari:",
        "sUrl": "",
        "oPaginate": {
          "sFirst": "Pertama",
          "sPrevious": "Sebelumnya",
          "sNext": "Selanjutnya",
          "sLast": "Terakhir"
        }
      },
      "initComplete": function (settings, json) {
        $(IDtable+'_filter input').unbind();
        $(IDtable+'_filter input').bind('keyup', function (e) {
          if (e.keyCode == 13) {
            table.search(this.value).draw();
          }
        });
      }
    });
    //new $.fn.dataTable.FixedHeader( table );
    this.getTable5 = table;
  },
  /*
   * Draw datatable
   * @param callback Function (optional)
   */
  refresh: function (callback = false) {
    var self = this;
    this.getTable.draw();
    if (typeof callback === "function") {
      callback.call(self);
    }
  },

  refresh2: function (callback = false) {
    var self = this;
    this.getTable2.draw();
    if (typeof callback === "function") {
      callback.call(self);
    }
  },
  refresh3: function (callback = false) {
    var self = this;
    this.getTable3.draw();
    if (typeof callback === "function") {
      callback.call(self);
    }
  },
  refresh4: function (callback = false) {
    var self = this;
    this.getTable4.draw();
    if (typeof callback === "function") {
      callback.call(self);
    }
  },
  refresh5: function (callback = false) {
    var self = this;
    this.getTable5.draw();
    if (typeof callback === "function") {
      callback.call(self);
    }
  },
  /*
   * Form action (save or update)
   * @param form String
   * @param callback Function (optional)
   */
  save: function (form, beforeSend = function () { }, callback = false, showNotif = true) {
    var self = this;
    $(document).on('submit', form, function (e) {
      e.preventDefault();
      var text = $(form + ' button[type=submit]').html();
      formData = new FormData($(form)[0]);
      formData.append(self.tokenName, getCookies(self.tokenName));

      $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'JSON',
        beforeSend: function () {
          $(form + ' button[type=submit]').html('Mohon Tunggu...').attr("disabled", "disabled");
          if (typeof beforeSend === "function") {
            beforeSend.apply(self);
          }
        },
        success: function (response) {
          $(form + ' button[type=submit]').html(text).removeAttr("disabled");
          if (response.status == true) {
            $('p.text-danger').remove();

            $('.form-group').removeClass('has-error')
              .removeClass('has-success');
            $('p.text-danger').remove();
            if (showNotif === true) {
              if (response.message) {
                self.notify(response.message);
              }
            }
          } else {
            $('p.text-danger').remove();
            if (response.errors) {
              $.each(response.errors, function (key, value) {
                var element = $('#' + key);
                element.closest('div.form-group')
                  // .removeClass('has-error')
                  // .addClass(value.length > 0 ? 'has-error' : 'has-success')
                  .find('p.text-danger')
                  .remove();

                var select2 = element.closest('div.form-group').find('span.select2.select2-container');
                if (select2.length) {
                  select2.after(value)
                } else {
                  if (element.closest('div.input-group').length) {
                    element.closest('div.input-group').after(value);
                  } else {
                    element.after(value);
                  }
                }

              });
            }
            if (showNotif === true) {
              if (response.message) {
                self.notify(response.message, 'warning');
              }
            }
          }
          if (typeof callback === "function") {
            callback.apply(self, [response]);
          }
          $(form + ' button[type=submit]').html(text).removeAttr("disabled");
        },
        error: function (response) {
          $(form + ' button[type=submit]').html(text).removeAttr("disabled");
          if (response.status === 403) {
            self.notify(response.responseJSON.message, 'warning');
          }
        }
      });
    });
  },

  authenticate: function (form, beforeSend = function () { }, callback = false) {
    var self = this;
    $(document).on('submit', form, function (e) {
      e.preventDefault();
      var text = $(form + ' button[type=submit]').html();
      $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: 'JSON',
        beforeSend: function () {
          $(form + ' button[type=submit]').html('Mohon Tunggu...').attr("disabled", "disabled");
          if (typeof beforeSend === "function") {
            beforeSend.apply(self);
          }
        },
        success: function (response) {
          $(form + ' button[type=submit]').html(text).removeAttr("disabled");
          if (response.status == false || response.status == true) {
            $('.form-group').removeClass('has-error')
              .removeClass('has-success');
            $('p.text-danger').remove();
          }
          if (response.status == false && response.errors) {
            $('#failed').text('');
            $.each(response.errors, function (key, value) {
              var element = $('#' + key);

              element.closest('div.form-group')
                .removeClass('has-error')
                .addClass(value.length > 0 ? 'has-error' : '')
                .find('p.text-danger')
                .remove();

              var select2 = element.closest('div.form-group').find('span.select2-container--bootstrap');

              if (select2.length) {
                select2.after(value)
              } else {
                if (element.closest('div.input-group').length) {
                  element.closest('div.input-group').after(value);
                } else {
                  element.after(value);
                }
              }

            });
          }

          if (typeof callback === "function") {
            callback.apply(self, [response]);
          }
        }
      });

    });
  },

  /*
   * autocomplete serverside rendering
   * make sure you have inlcude jquery autocomplete plugin
   */
  autocomplete: function (inputId, callback = function (event, ui) { }) {
    $(document).on('keyup.autocomplete', inputId, function () {
      $(this).autocomplete({
        source: $(this).attr('data-url'),
        select: callback
      });
    });
  },

  /*
   * Get Detail by specify key
   */
  getDetail: function (element, event = 'blur') {
    $(element).on(event, function (e) {
      e.preventDefault();

      var id = $(element).val();

      $.ajax({
        type: 'POST',
        url: $(element).attr('data-detail'),
        data: {
          id: id
        },
        dataType: 'json',
        success: function (res) {
          $.each(res, function (key, value) {
            $('#' + key).val(value);
            $('#' + key).attr('disabled', true);
          });
        }
      });
    });
  },
  /*
   *
   */
  edit: function (table, callback) {
    var btnUpdate = this.btnUpdate;
    $(document).on('click', '.editData', function (e) {
      e.preventDefault();
      $('#id').remove();
      $('#batal').remove();
      $(table).find('p.text-danger').remove();

      var id = $(this).attr('data-id');

      $.ajax({
        type: 'POST',
        url: $(table).attr('data-url-edit'),
        data: {
          id: id
        },
        dataType: 'JSON',
        success: function (response) {
          if (typeof callback === "function") {
            callback.apply(self, [response]);
          }
          if (response.status == true) {
            $.each(response.data, function (key, value) {

              var element = $('#' + key);

              element.closest('div.form-group')
                .removeClass('has-error')
                .find('p.text-danger')
                .remove();

              $('#submit').text(btnUpdate);
              $('#' + key).val(value);


              element.val(value).trigger('change');

            });
            $('<button type="reset" style="margin-left: 10px" id="batal" class="btn btn-default btn-sm">Batal</button>').insertAfter('#submit');
            $("<input id='id' type='hidden' name='id' value='" + id + "'>").insertAfter("#submit");
            $("<input id='method' type='hidden' name='_method' value='PUT'>").insertAfter("#submit");

            $("html, body").animate({
              scrollTop: 0
            }, 600);
          }


        }


      });
    });
  },

  fetchData: function (id) {
    var url = $(id).attr('data-url');
    $.get(url, function (response) {
      $(id).html(response);
    });
  },

  notify: function (text, status = "success", delay = 20, callback = function () { }) {
    alertify.set('notifier', 'delay', delay);
    if (status === 'success') {
      alertify
        .alert("<i class='fa fa-check'></i> Sukses", text, callback).set({ modal: true, closableByDimmer: false });
      $("<style>.ajs-header { background: #0097a7 !important; }</style>")
        .appendTo(document.documentElement);
    } else {
      alertify
        .alert("<i class='fa fa-info-circle'></i> Terjadi Kesalahan", text, callback).set({ modal: true, closableByDimmer: false });
      $("<style>.ajs-header { background: #dd4b39 !important; }</style>")
        .appendTo(document.documentElement);
    }
  },

  cancelEdit: function (idForm, callback = false) {
    var btnSave = this.btnSave;
    $(document).on('click', 'button#batal', function (e) {
      $(idForm + ' #submit').text(btnSave);
      $(idForm).trigger('reset');
      $(idForm + ' #id').remove();
      $(idForm + ' #method').remove();
      $(idForm + ' #batal').remove();
      $(idForm + ' .form-group').removeClass('has-error')
        .removeClass('has-success');
      $(idForm + " select").val("").trigger('change');

      if (typeof callback === "function") {
        callback.call(self);
      }

    });
  },

  /*
   * Delete data
   * @param table String
   * @param callback Function (optional)
   */
  delete: function (table, callback = false) {
    var deleteConfirm = this.deleteConfirm;
    var confirmTitle = this.confirmTitle;
    var self = this;
    $(table).on("click", ".deleteData:not(:disabled)", function (e) {
      e.preventDefault();
      var cObj = $(this);
      var data = {
        _method: 'DELETE',
        _type: $(this).attr('data-type'),
        id: $(this).attr('data-id'),
        _token: getCookies('_token')
      }

      var url = $(table).attr('data-url-delete');

      alertify.confirm('<i class="fa fa-info"></i> Konfirmasi', 'Apakah anda yakin ingin menghapus data?', function () {
        var currentHtml = cObj.html();
        cObj.prop('disabled', true).html('Mohon Tunggu');
        $.post(url, data, function (res) {
          cObj.prop('disabled', false).html(currentHtml);
          var response = jQuery.parseJSON(res);
          //console.log(response);
          if (response.status == true) {
            if (response.datatable == false) {
              //do nothing;
            } else {
              self.refresh();
            }
            self.notify(response.message);
          } else {
            self.notify(response.message, 0);
          }
          if (typeof callback === "function") {
            callback.apply(self, [response]);
          }
        }).fail(function (response) {
          cObj.prop('disabled', false).html(currentHtml);
          if (response.status === 403) {
            var response = jQuery.parseJSON(response.responseText);
            self.notify(response.message, 0);
          }
        });
      }, function () { });
    });
  },

  delete2: function (table, callback = false) {
    var deleteConfirm = this.deleteConfirm;
    var confirmTitle = this.confirmTitle;
    var self = this;
    $(table).on("click", ".deleteData:not(:disabled)", function (e) {
      e.preventDefault();
      var cObj = $(this);
      var data = {
        _method: 'DELETE',
        _type: $(this).attr('data-type'),
        id: $(this).attr('data-id'),
        _token: getCookies('_token')
      }

      var url = $(table).attr('data-url-delete');

      alertify.confirm('<i class="fa fa-info"></i> Konfirmasi', 'Apakah anda yakin ingin menghapus data?', function () {
        var currentHtml = cObj.html();
        cObj.prop('disabled', true).html('Mohon Tunggu');
        $.post(url, data, function (res) {
          cObj.prop('disabled', false).html(currentHtml);
          var response = jQuery.parseJSON(res);
          //console.log(response);
          if (response.status == true) {
            if (response.datatable == false) {
              //do nothing;
            } else {
              self.refresh2();
            }
            self.notify(response.message);
          } else {
            self.notify(response.message, 0);
          }
          if (typeof callback === "function") {
            callback.apply(self, [response]);
          }
        }).fail(function (response) {
          cObj.prop('disabled', false).html(currentHtml);
          if (response.status === 403) {
            var response = jQuery.parseJSON(response.responseText);
            self.notify(response.message, 0);
          }
        });
      }, function () { });
    });
  },

  bulkDelete: function (deleteId, type = 'delete') {

    var deleteConfirm = this.deleteConfirm;
    var confirmTitle = this.confirmTitle;
    var self = this;
    $(document).on('change', deleteId, function (e) {

      id = [];
      var selected_rows = self.getTable.column(0).checkboxes.selected();
      $.each(selected_rows, function (index, rowId) {
        id.push(rowId);
      });

      if (id.length > 0 && $(this).find(':selected').val()) {

        var data = {
          _method: 'DELETE',
          _type: $(this).find(':selected').val(),
          id: id
        }

        var url = $(self.tableId).attr('data-url-delete');

        alertify.confirm('<i class="fa fa-info"></i> ' + confirmTitle, deleteConfirm, function () {
          $.post(url, data, function (res) {
            var response = jQuery.parseJSON(res);
            if (response.status == true) {
              self.refresh();
              $(deleteId).val('').trigger('change');
              if (typeof callback === "function") {
                callback.apply(self, [response]);
              }
              self.notify(response.message);
            } else {
              self.notify(response.message, 'warning');
            }
          }).fail(function (response) {
            if (response.status === 403) {
              var response = jQuery.parseJSON(response.responseText);
              self.notify(response.message, 'warning');
            }
          });
        }, function () {
          $(deleteId).val('').trigger('change');
        });
      } else {
        $(deleteId).val('');
      }

    });
  },

  getParameterByName: function (name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
      results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
  }

}

if (typeof jQuery.fn.dataTableExt != 'undefined') {

  jQuery.fn.dataTableExt.oApi.reload = function (oSettings, sNewSource, fnCallback, bStandingRedraw) {
    if (jQuery.fn.dataTable.versionCheck) {
      var api = new jQuery.fn.dataTable.Api(oSettings);

      if (sNewSource) {
        api.ajax.url(sNewSource).load(fnCallback, !bStandingRedraw);
      } else {
        api.ajax.reload(fnCallback, !bStandingRedraw);
      }
      return;
    }

    if (sNewSource !== undefined && sNewSource !== null) {
      oSettings.sAjaxSource = sNewSource;
    }

    if (oSettings.oFeatures.bServerSide) {
      this.fnDraw();
      return;
    }

    this.oApi._fnProcessingDisplay(oSettings, true);
    var that = this;
    var iStart = oSettings._iDisplayStart;
    var aData = [];

    this.oApi._fnServerParams(oSettings, aData);

    oSettings.fnServerData.call(oSettings.oInstance, oSettings.sAjaxSource, aData, function (json) {
      that.oApi._fnClearTable(oSettings);

      var aData = (oSettings.sAjaxDataProp !== "") ?
        that.oApi._fnGetObjectDataFn(oSettings.sAjaxDataProp)(json) : json;

      for (var i = 0; i < aData.length; i++) {
        that.oApi._fnAddData(oSettings, aData[i]);
      }

      oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();

      that.fnDraw();

      if (bStandingRedraw === true) {
        oSettings._iDisplayStart = iStart;
        that.oApi._fnCalculateEnd(oSettings);
        that.fnDraw(false);
      }

      that.oApi._fnProcessingDisplay(oSettings, false);

      if (typeof fnCallback == 'function' && fnCallback !== null) {
        fnCallback(oSettings);
      }
    }, oSettings);
  }

}

$.fn.imagesLoaded = function () {

  // get all the images (excluding those with no src attribute)
  var $imgs = this.find('img[src!=""]');
  // if there's no images, just return an already resolved promise
  if (!$imgs.length) {
    return $.Deferred().resolve().promise();
  }

  // for each image, add a deferred object to the array which resolves when the image is loaded (or if loading fails)
  var dfds = [];
  $imgs.each(function () {

    var dfd = $.Deferred();
    dfds.push(dfd);
    var img = new Image();
    img.onload = function () {
      dfd.resolve();
    }
    img.onerror = function () {
      dfd.resolve();
    }
    img.src = this.src;

  });

  // return a master promise object which will resolve when all the deferred objects have resolved
  // IE - when all the images are loaded
  return $.when.apply($, dfds);

}

$(document).on('keyup keypress', 'form input[type="text"]', function (e) {
  if (e.which == 13) {
    e.preventDefault();
    return false;
  }
});

var App = new Main({
  tokenName: tokenName
});
$(document).ready(function () {

  if ($('.sticky-box').length > 0) {
    // grab the initial top offset of the navigation
    var parentwidth = parseInt($(".box-header.sticky-box").width()) - 15;
    var stickyNavTop = $('.sticky-box').offset().top;

    // our function that decides weather the navigation bar should have "fixed" css position or not.
    var stickyNav = function () {
      var scrollTop = $(window).scrollTop(); // our current vertical position from the top
      // if we've scrolled more than the navigation, change its position to fixed to stick to top,
      // otherwise change it back to relative
      var p = 0;
      if ($('body').hasClass('sidebar-collapse')) {
        p = parentwidth + 180;
      } else {
        p = parentwidth
      }
      if (scrollTop > stickyNavTop) {
        $('.sticky-box').addClass('sticky').width(p);
        $('.btn-sticky').show();
      } else {
        $('.sticky-box').removeClass('sticky');
        $('.btn-sticky').hide();
      }
    };

    stickyNav();
    // and run it again every time you scroll
    $(window).scroll(function () {
      stickyNav();
    });
  }

  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    $('.nav-tabs').find('.label').removeClass('label-info').addClass('label-danger');
    $(e.target).find('.label').removeClass('label-danger').addClass('label-info');
  });
  $('.content-wrapper').click(function (e) {
    $('#sidebar-filter').removeClass('control-sidebar-open')
  });
  $('body').tooltip({
    selector: '[rel=tooltip]'
  });
  $(window).scroll(function () {
    $('#sidebar-filter').removeClass('control-sidebar-open')
  });
  $('#export').click(function () {
    $('#form-search').submit()
  });

  $('[data-toggle="tooltip"]').tooltip();
  $('body').tooltip({
    selector: '[data-toggle="tooltip"]'
  });
  if ($.datepicker || $.fn.datepicker) {
    $(".datepicker").datepicker({
      format: 'dd/mm/yyyy',
      autoclose: true
    }).datepicker("setDate", new Date());
  }
  if ($.timepicker || $.fn.timepicker) {
    $('.timepicker').timepicker({
      showInputs: false,
      maxHours: 24,
      showMeridian: false
    });
  }
  var url_active = window.location;
  $('.nav-item').find('[href="' + url_active + '"]').closest('li').addClass('active').addClass('menu-open');
  $('.nav-item').find('[href="' + url_active + '"]').closest('ul').closest('li').addClass('active').addClass('menu-open');
  $('.nav-item').find('[href="' + url_active + '"]').closest('ul').closest('li').closest('ul').closest('li').addClass('active').addClass('menu-open');
  $('.nav-item').find('[href="' + url_active + '"]').closest('ul').closest('li').closest('ul').closest('li').closest('ul').closest('li').addClass('active').addClass('menu-open');
  $('.nav-item').find('[href="' + url_active + '"]').closest('ul').closest('li').closest('ul').closest('li').closest('ul').closest('li').closest('ul').closest('li').addClass('active').addClass('menu-open');
  $('.nav-item').find('li.active').closest('li').find('span.arrow').addClass('menu-open');
  $('#myModal').on('hidden.bs.modal', function () {
    $(this).html('');
  });

  $(document).on('click', '.disabled', function (e) {
    e.preventDefault();
  });
  $(document).on('dbclick', '.disabled', function (e) {
    e.preventDefault();
  });

  $(document).on('click', '.sidebar-toggle', function () {
    $('.sticky-box').css('width', '100%');
  });
});

var urlParam = function(url, name){
  var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(url);
  if (results==null){
     return null;
  }
  else{
     return results[1] || 0;
  }
}

$(document).ajaxSend(function (event, jqxhr, settings) {
  var loader = urlParam(site_url+'?'+settings.data, 'loader');
  //console.log(loader);
  if (!loader) {
    var loader = urlParam(settings.url, 'loader');
    //alert(loader);
    if (loader != 'false') {
      $.blockUI({ message: '<h5><img width="40px" src="' + site_url + 'assets/static-image/spinner.gif" /> Mohon Tunggu...</h5>' });
    }
  }
});
$(document).ajaxComplete(function () {
  window.setTimeout(function () {
    $.unblockUI();
  }, 400);
  $('[data-toggle="tooltip"]').tooltip();
  
});
$(document).ajaxError(function () {
  $.unblockUI();
})

function block() {
  return $.blockUI({ message: '<h5><img width="40px" src="' + site_url + 'assets/static-image/spinner.gif" /> Mohon Tunggu...</h5>' });
}
function unblock() {
  return $.unblockUI();
}

function addDays(date, days) {
  var result = new Date(date);
  result.setDate(result.getDate() + days);
  return result;
}
function format_date(date, separator = '/') {
  var tgl = new Date(date);
  var dd = tgl.getDate();
  var mm = tgl.getMonth() + 1; //January is 0!

  var yyyy = tgl.getFullYear();
  if (dd < 10) {
    dd = '0' + dd;
  }
  if (mm < 10) {
    mm = '0' + mm;
  }
  var today = dd + separator + mm + separator + yyyy;

  return today
}

Number.prototype.format = function (n, x) {
  var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
  return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};