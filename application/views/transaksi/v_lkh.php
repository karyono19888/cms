  <?php $this->load->view('template/v_header'); ?> 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Transactions <span class="text-sm">Daily Work Report</span></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-border-none"></i>
                        Header
                    </h3>
                    <div class="card-tools">
                        <div class="btn-group">
                          <button type="button" class="btn btn-tool" data-toggle="dropdown">
                              <i class="fas fa-ellipsis-v"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right" role="menu">
                              <a class="dropdown-item Tambah" data-toggle="modal" data-target="#modal_header" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus-circle"></i> Add</a>
                              <a class="dropdown-item Edit"><i class="fas fa-edit"></i> Edit</a>
                              <a class="dropdown-item HapusNo"><i class="fas fa-trash-alt"></i> Delete</a>
                          </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
              <div class="card-body">
                <table id="tableHeader" class="table table-bordered table-striped">
                  <thead>
                    <tr>    
                        <th class="text-center">No</th>
                        <th class="text-center">Line</th>
                        <th class="text-center">Shift</th>
                        <th class="text-center">Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $no=1;
                        foreach ($data->result_array() as $row ){
                        if($row['t_lkh_head_shift'] == 1){
                          $shift = "Pagi";
                        }else{
                          $shift = "Malam";
                        }
                    ?>
                    <tr id="baris" data-id="<?=$row['t_lkh_head_id'] ?>">    
                        <td class="text-center" width="50"><?=$no++ ?></td>
                        <td><?=$row['t_lkh_head_line'] ?></td>
                        <td><?=$shift ?></td>
                        <td class="text-center"><?=date('d-m-Y', strtotime($row['t_lkh_head_date'])) ?></td>
                    </tr>
                    <?php };?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-border-none"></i>
                        Line
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-outline-primary btn-sm Tambah2">
                            <i class="fas fa-plus-circle"></i> Add
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive-xl">
                  <table id="tableLine" class="table table-bordered table-striped">
                    <thead>
                      <tr>    
                          <th class="text-center">No</th>
                          <th class="text-center">Job No</th>
                          <th class="text-center">Die Change Time</th>
                          <th class="text-center">Stamping Time</th>
                          <th class="text-center">TPT</th>
                          <th class="text-center">Working</th>
                          <th class="text-center">Stroke</th>
                          <th class="text-center"><i class="fas fa-cogs"></i></th>
                      </tr>
                    </thead>
                    <tbody id="tampil">
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <div class="modal fade" id="modal_header">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form class="form-horizontal" id="form_header" method="post">
          <div class="modal-header">
            <h4 class="modal-title" id="judul1_head">Tambah Data Header</h4>
            <h4 class="modal-title" id="judul2_head">Edit Data Header</h4>
            <button type="button" class="close" id="tutup" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label for="qty" class="col-sm-4 col-form-label">Date :</label>
              <div class="col-sm-3">
                <input type="hidden" class="form-control" id="t_lkh_head_id" name="t_lkh_head_id">
                <input type="date" class="form-control" id="t_lkh_head_date" name="t_lkh_head_date" placeholder="Date" required>  
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-4 col-form-label">Line :</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="t_lkh_head_line" name="t_lkh_head_line" placeholder="Line" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-4 col-form-label">Shift :</label>
              <div class="col-sm-4">
                <select class="form-control select2" style="width: 100%;" id="t_lkh_head_shift" name="t_lkh_head_shift" data-placeholder="Document Type" required>
                  <option selected="selected" value=""></option>
                  <option value="1">Pagi</option>
                  <option value="2">Malam</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-4 col-form-label">Description :</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="t_lkh_head_ket" name="t_lkh_head_ket" placeholder="Description">
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="submit" class="btn btn-outline-primary" id="tombol_tambah_head">Save</button>
            <button type="submit" class="btn btn-outline-primary" id="tombol_update_head">Update</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <div class="modal fade" id="modal_line">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form class="form-horizontal" id="form_line" method="post">
          <div class="modal-header">
            <h4 class="modal-title" id="judul1_line">Tambah Data Line</h4>
            <h4 class="modal-title" id="judul2_line">Edit Data Line</h4>
            <button type="button" class="close" id="tutup2" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label for="qty" class="col-sm-3 col-form-label">Job No :</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="t_lkh_line_id" name="t_lkh_line_id">
                <input type="hidden" class="form-control" id="t_lkh_line_head" name="t_lkh_line_head">
                <select class="form-control select2 Item" style="width: 100%;" id="t_lkh_line_item" name="t_lkh_line_item" data-placeholder="Job No & Part No GLC" required>
                  <option></option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-3 col-form-label">Die Change Time :</label>
              <div class="col-sm-3">
                <input type="number" class="form-control" id="t_lkh_line_dct" name="t_lkh_line_dct" placeholder="Die Change Time" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-3 col-form-label">Stamping Time :</label>
              <div class="col-sm-3">
                <input type="number" class="form-control" id="t_lkh_line_st" name="t_lkh_line_st" placeholder="Stamping Time" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-3 col-form-label">TPT :</label>
              <div class="col-sm-3">
                <input type="number" class="form-control" id="t_lkh_line_tpt" name="t_lkh_line_tpt" placeholder="TPT" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-3 col-form-label">Working :</label>
              <div class="col-sm-3">
                <input type="number" class="form-control" id="t_lkh_line_working" name="t_lkh_line_working" placeholder="Working" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-3 col-form-label">Stroke :</label>
              <div class="col-sm-3">
                <input type="number" class="form-control" id="t_lkh_line_stroke" name="t_lkh_line_stroke" placeholder="Stroke" required>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-primary" id="tombol_tambah_line">Save</button>
            <button type="button" class="btn btn-outline-primary" id="tombol_update_line">Update</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <?php $this->load->view('template/v_foot'); ?> 
  <script>

    // Header

    $(document).on("click", ".Tambah", function () {
      $('#judul2_head').hide();
      $('#tombol_update_head').hide();
      $('#judul1_head').show();
      $('#tombol_tambah_head').show();
    });
    $(document).ready(function() {
      var table = $('#tableHeader').DataTable();
      $('#tableHeader tbody').on( 'click', 'tr', function () {
          if ( $(this).hasClass('selected') ) {
              $(this).removeClass('selected');
              $('#t_lkh_line_head').val('');
              html = '';
              document.getElementById("tampil").innerHTML = html;
          }else {
              table.$('tr.selected').removeClass('selected');
              $(this).addClass('selected');
              var idHead = $(this).data('id');
              $('#t_lkh_line_head').val(idHead);
              getLine();
          }
      });
    });
    $(document).on("click", "#tombol_tambah_head", function () {
      if(validasi()){
        var data = $('#form_header').serialize();  
        $.ajax({
          type: 'POST',
          url: '<?=site_url('transaksi/Lkh/create_head')?>',
          data: data,
          success: function(response) { 
            $('#modal_header').modal('hide');
          }
        });
      }
    }); 
    $(document).on("click", ".Edit", function () {
      $('#judul1_head').hide();
      $('#tombol_tambah_head').hide();
      $('#judul2_head').show();
      $('#tombol_update_head').show();
      var html = '';
      var myid = document.getElementById("t_lkh_line_head").value;
      if(myid > 0){
        $.ajax({
          type: 'POST',
          url: '<?=site_url('transaksi/Lkh/view_head')?>',
          data: { myid: myid},
          success: function(response) { 
            $('#modal_header').modal({ backdrop: 'static', keyboard: false, show: true });
            var data=JSON.parse(response);
            if(data.t_lkh_head_shift == 1){
              html += '<option selected="selected" value="1">Pagi</option>'+
                      '<option value="2">Malam</option>';
            }else{
              html += '<option value="1">Pagi</option>'+
                      '<option selected="selected" value="2">Malam</option>';
            }
            $('#t_lkh_head_id').val(data.t_lkh_head_id);
						$('#t_lkh_head_date').val(data.t_lkh_head_date);
            $('#t_lkh_head_line').val(data.t_lkh_head_line);
            $('#t_lkh_head_shift').html(html);
            $('#t_lkh_head_ket').val(data.t_lkh_head_ket);
          }
        });
      }else{
        noHead();
      }
    });
    $(document).on("click", "#tombol_update_head", function () {
      if(validasi()){
        var data = $('#form_header').serialize();  
        $.ajax({
          type: 'POST',
          url: '<?=site_url('transaksi/Lkh/update_head')?>',
          data: data,
          success: function(response) { 
            $('#modal_header').modal('hide');
          }
        });
      }
    });  
    $(document).on("click", "#tutup", function () {
      var html = '';
      $('#t_lkh_head_id').val('');
      $('#t_lkh_head_date').val('');
      $('#t_lkh_head_line').val('');
      $('#t_lkh_head_ket').val('');
      html += '<option selected="selected" value=""></option>'+
              '<option value="1">Pagi</option>'+
              '<option value="2">Malam</option>';
      $('#t_lkh_head_shift').html(html);
    });
    function validasi() {
      var t_lkh_head_date   = document.getElementById("t_lkh_head_date").value;
      var t_lkh_head_line   = document.getElementById("t_lkh_head_line").value;
      var t_lkh_head_shift  = document.getElementById("t_lkh_head_shift").value;
      if (t_lkh_head_date != "" && 
          t_lkh_head_line != "" && 
          t_lkh_head_shift != "") {
        return true;
      }else{
        SweetAlert.fire({
          icon: 'warning',
          title: 'Warning!',
          text: 'Kolom Date, Line dan Shift tidak boleh kosong.',
          showConfirmButton: false,
          timer: 1500
        });
      }
    }
    function noHead(){
      SweetAlert.fire({
        icon: 'warning',
        title: 'Perhatian !',
        text: 'Header belum di pilih!',
        showConfirmButton: false,
        timer: 1500
      });
    }

    //Line

    function getLine(){
      var id = document.getElementById("t_lkh_line_head").value;
      no = 1;
      html = '';
      $.ajax({
        type: 'POST',
        url: '<?=site_url('transaksi/Lkh/view_line')?>',
        data: { id: id},
        success: function(response) { 
          var data=JSON.parse(response);
          for (i = 0; i < data.rows.length; i++) {
            html += '<tr>'+
                      '<td class="text-center">'+[no++]+'</td>'+
                      '<td>'+data.rows[i].m_item_job_no+'</td>'+
                      '<td class="text-right">'+data.rows[i].t_lkh_line_dct+'</td>'+
                      '<td class="text-right">'+data.rows[i].t_lkh_line_st+'</td>'+
                      '<td class="text-right">'+data.rows[i].t_lkh_line_tpt+'</td>'+
                      '<td class="text-right">'+data.rows[i].t_lkh_line_working+'</td>'+
                      '<td class="text-right">'+data.rows[i].t_lkh_line_stroke+'</td>'+
                      '<td width="50">'+
                        '<div class="btn-group">'+
                          '<button type="button" class="btn btn-tool" data-toggle="dropdown">'+
                              '<i class="fas fa-ellipsis-v"></i>'+
                          '</button>'+
                          '<div class="dropdown-menu dropdown-menu-right" role="menu">'+
                              '<a href="#" class="dropdown-item Edit2" data-toggle="modal" data-target="#modal_line" data-id="'+data.rows[i].t_lkh_line_id+'" data-backdrop="static" data-keyboard="false"><i class="fas fa-edit"></i> Edit</a>'+
                              '<a href="#" class="dropdown-item Hapus2" data-id="'+data.rows[i].t_lkh_line_id+'"><i class="fas fa-trash-alt"></i> Delete</a>'+
                          '</div>'+
                        '</div>'+
                      '</td>'+
                    '</tr>'
          }
          $('#tampil').html(html);
        }
      });
    }
    $(document).on("click", ".Tambah2", function () {
      var idLine = document.getElementById("t_lkh_line_head").value;
      if(idLine > 0){
        $('#modal_line').modal({ backdrop: 'static', keyboard: false, show: true });
        $('#judul2_line').hide();
        $('#tombol_update_line').hide();
        $('#judul1_line').show();
        $('#tombol_tambah_line').show();
        getItem();
      }else{
        noHead();
      }
    });
    function getItem(){
      var html ='';
      $.ajax({
        type: 'GET',
        url: '<?=site_url('transaksi/Lkh/getItem')?>',
        success: function(response) { 
          var data=JSON.parse(response);
          html +='<option></option>';
          for (i = 0; i < data.row.length; i++) {
            html += '<option value="'+data.row[i].m_item_id+'">'+data.row[i].m_item_job_no+' ( '+data.row[i].m_item_part_no_glc+' )</option>'
          }
          document.getElementById("t_lkh_line_item").innerHTML = html;
        }
      });
    }
    $(document).on("click", "#tombol_tambah_line", function () {
      if(validasi2()){
        var data = $('#form_line').serialize();  
        $.ajax({
          type: 'POST',
          url: '<?=base_url('transaksi/Lkh/create_line')?>',
          data: data,
          success: function(response) { 
            var data=JSON.parse(response);
            if(data.success){
              SweetAlert.fire({
                icon: 'success',
                title: 'Sukses!',
                text: 'Input data berhasil.',
                showConfirmButton: false,
                timer: 1500
              });
              getLine();
              getItem()
              $('#t_lkh_line_dct').val('');
              $('#t_lkh_line_st').val('');
              $('#t_lkh_line_tpt').val('');
              $('#t_lkh_line_working').val('');
              $('#t_lkh_line_stroke').val('');
            }else{
              SweetAlert.fire({
                icon: 'error',
                title: 'Warning!',
                text: 'Input data gagal.',
                showConfirmButton: false,
                timer: 1500
              });
            }
          }
        });
      }
    }); 
    $(document).on("click", ".Edit2", function () {
      var html = '';
      $('#judul1_line').hide();
      $('#tombol_tambah_line').hide();
      $('#judul2_line').show();
      $('#tombol_update_line').show();
      var id = $(this).data('id');
      $.ajax({
          type: 'POST',
          url: '<?=site_url('transaksi/Lkh/edit_line')?>',
          data: {id:id},
          success: function(response) {
            var data=JSON.parse(response);
            html += '<option value="'+data.m_item_id+'">'+data.m_item_job_no+' ( '+data.m_item_part_no_glc+' )</option>';
            html += '<?php foreach($item->result_array() as $data){ ?><option value="<?=$data['m_item_id']?>">'+
                    '<?=$data['m_item_job_no']?> ( <?=$data['m_item_part_no_glc']?> )</option><?php } ?>';
            $('#t_lkh_line_item').html(html);
            $('#t_lkh_line_id').val(data.t_lkh_line_id);
            $('#t_lkh_line_dct').val(data.t_lkh_line_dct);
            $('#t_lkh_line_st').val(data.t_lkh_line_st);
            $('#t_lkh_line_tpt').val(data.t_lkh_line_tpt);
            $('#t_lkh_line_working').val(data.t_lkh_line_working);
            $('#t_lkh_line_stroke').val(data.t_lkh_line_stroke);
          }
      });
    });
    $(document).on("click", "#tombol_update_line", function () {
      if(validasi2()){
        var data = $('#form_line').serialize();  
        $.ajax({
          type: 'POST',
          url: '<?=site_url('transaksi/Lkh/update_line')?>',
          data: data,
          success: function(response) { 
            var data=JSON.parse(response);
            if(data.success){
              SweetAlert.fire({
                icon: 'success',
                title: 'Sukses!',
                text: 'Update data berhasil.',
                showConfirmButton: false,
                timer: 1500
              });
              $('#modal_line').modal('hide');
              getLine();
            }else{
              SweetAlert.fire({
                icon: 'error',
                title: 'Warning!',
                text: 'Update data gagal.',
                showConfirmButton: false,
                timer: 1500
              });
            }
          }
        });
      }
    });
    $(document).on("click", ".Hapus2", function () {
      var Id = $(this).data('id');
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: 'POST',
            url: '<?=site_url('transaksi/Lkh/delete_line')?>',
            data: { Id: Id},
            success: function(response) { 
              var data=JSON.parse(response);
              if(data.success){
                SweetAlert.fire({
                  icon: 'success',
                  title: 'Deleted!',
                  text: 'Your file has been deleted.',
                  showConfirmButton: false,
                  timer: 1500
                });
              }else{
                SweetAlert.fire({
                  icon: 'error',
                  title: 'Deleted!',
                  text: 'Your file cannot be deleted.',
                  showConfirmButton: false,
                  timer: 1500
                });
              }
              getLine();
            }
          });
        }
      })
    });
    function validasi2() {
      var t_lkh_line_item    = document.getElementById("t_lkh_line_item").value;
      var t_lkh_line_dct     = document.getElementById("t_lkh_line_dct").value;
      var t_lkh_line_st      = document.getElementById("t_lkh_line_st").value;
      var t_lkh_line_tpt     = document.getElementById("t_lkh_line_tpt").value;
      var t_lkh_line_working = document.getElementById("t_lkh_line_working").value;
      var t_lkh_line_stroke  = document.getElementById("t_lkh_line_stroke").value;
      if(t_lkh_line_item != '' && t_lkh_line_dct != '' && t_lkh_line_st != '' &&
      t_lkh_line_tpt != '' && t_lkh_line_working != '' && t_lkh_line_stroke != ''){
        return true;
      }else{
        SweetAlert.fire({
          icon: 'warning',
          title: 'Warning!',
          text: 'Semua Kolom tidak boleh kosong.',
          showConfirmButton: false,
          timer: 1500
        });
      }
    };
  </script>
  <?php $this->load->view('template/v_bottom'); ?> 