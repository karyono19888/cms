<?php $this->load->view('template/v_header'); ?> 
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Masters <small class="h6"><?=$title?></small></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary float-left">List Data</h5>
            <button type="button" class="btn btn-outline-primary btn-sm Tambah float-right" data-toggle="modal" data-target="#modal-sm" data-backdrop="static" data-keyboard="false">
              <i class="fas fa-plus-circle"></i> Add
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th class="text-center">Nama Instansi</th>
                          <th class="text-center">Kontak</th>
                          <th class="text-center">Alamat</th>
                          <th class="text-center">Telepon</th>
                          <th class="text-center">Fax</th>
                          <th class="text-center">Status</th>
                          <th class="text-center">ID</th>
                          <th class="text-center">Keterangan</th>
                          <th class="text-center"><i class="fas fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                          $no=1;
                          foreach ($data->result_array() as $row ){ 
                          if($row['m_bp_jns'] == 1) {
                              $bp = 'Customer';
                          }else{
                              $bp = 'Supplier';
                          }
                      ?>
                      <tr>    
                          <td class="text-center" width="50"><?=$no++ ?></td>
                          <td><?=$row['m_bp_name'] ?></td>
                          <td><?=$row['m_bp_ctc'] ?></td>
                          <td><?=$row['m_bp_alt'] ?></td>
                          <td><?=$row['m_bp_tlp'] ?></td>
                          <td><?=$row['m_bp_fax'] ?></td>
                          <td><?=$row['m_sts_name'] ?></td>
                          <td class="text-center"><?=$row['m_bp_code'] ?></td>
                          <td><?=$bp ?></td>
                          <td width="50">
                              <div class="btn-group">
                              <button type="button" class="btn btn-tool" data-toggle="dropdown">
                                  <i class="fas fa-ellipsis-v"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-right" role="menu">
                                  <a href="#" class="dropdown-item Edit" data-toggle="modal" data-target="#modal-sm" data-id="<?=$row['m_bp_id'] ?>" data-backdrop="static" data-keyboard="false"><i class="fas fa-edit"></i> Edit</a>
                                  <a href="#" class="dropdown-item Hapus" data-id="<?=$row['m_bp_id'] ?>"><i class="fas fa-trash-alt"></i> Delete</a>
                              </div>
                              </div>
                          </td>
                      </tr>
                      <?php };?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

  </div>

  <div class="modal fade" id="modal-sm">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form class="form-horizontal" id="form" method="post">
          <div class="modal-header">
            <h4 class="modal-title" id="judul1">Tambah Data</h4>
            <h4 class="modal-title" id="judul2">Edit Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="alert"></div>
            <div class="form-group row">
              <label for="qty" class="col-sm-4 col-form-label">ID Business Partner :</label>
              <div class="col-sm-4">
                <input type="hidden" class="form-control" id="m_bp_id" name="m_bp_id">
                <input type="text" class="form-control" id="m_bp_code" name="m_bp_code" placeholder="ID Business Partner" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-4 col-form-label">Nama Business Partner :</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="m_bp_name" name="m_bp_name" placeholder="Nama Business Partner" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-4 col-form-label">Nama Kontak :</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="m_bp_ctc" name="m_bp_ctc" placeholder="Nama Kontak" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-4 col-form-label">Alamat :</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="m_bp_alt" name="m_bp_alt" placeholder="Alamat" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-4 col-form-label">Telepon :</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="m_bp_tlp" name="m_bp_tlp" placeholder="Telepon" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-4 col-form-label">Fax :</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="m_bp_fax" name="m_bp_fax" placeholder="Fax">
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-4 col-form-label">Status :</label>
              <div class="col-sm-4">
                <select class="form-control select2" style="width: 100%;" id="m_bp_active" name="m_bp_active" data-placeholder="Status" required>
                  <option selected="selected" value=""></option>
                  <option value="1">Aktif</option>
                  <option value="2">Tidak Aktif</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-4 col-form-label">Keterangan :</label>
              <div class="col-sm-4">
                <select class="form-control select2" style="width: 100%;" id="m_bp_jns" name="m_bp_jns" data-placeholder="Keterangan" required>
                  <option selected="selected" value=""></option>
                  <option value="1">Customer</option>
                  <option value="2">Supplier</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-primary" id="tombol_tambah">Save</button>
            <button type="button" class="btn btn-outline-primary" id="tombol_update">Update</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <?php $this->load->view('template/v_footer'); ?> 
  <script>
    $(document).on("click", ".Tambah", function () {
      $('#judul2').hide();
      $('#tombol_update').hide();
      $('#judul1').show();
      $('#tombol_tambah').show();
    });
    $(document).on("click", ".Edit", function () {
      $('#judul1').hide();
      $('#tombol_tambah').hide();
      $('#judul2').show();
      $('#tombol_update').show();
      var html = '';
      var html2 = '';
      var myid = $(this).data('id');
        $.ajax({
          type: 'POST',
          url: '<?=site_url('master/Bp/view')?>',
          data: { myid: myid},
          success: function(response) { 
            var data=JSON.parse(response);
            if(data.success){
              $('#m_bp_id').val(data.m_bp_id);
              $('#m_bp_code').val(data.m_bp_code);
              $('#m_bp_name').val(data.m_bp_name);
              $('#m_bp_ctc').val(data.m_bp_ctc);
              $('#m_bp_alt').val(data.m_bp_alt);
              $('#m_bp_tlp').val(data.m_bp_tlp);
              $('#m_bp_fax').val(data.m_bp_fax);
              if(data.m_bp_active == 1){
                  html += '<option selected="selected" value="1">Aktif</option>';
                  html += '<option value="2">Tidak Aktif</option>';
              }else{
                  html += '<option value="1">Aktif</option>';
                  html += '<option selected="selected" value="2">Tidak Aktif</option>';
              }
              $('#m_bp_active').html(html);

              if(data.m_bp_jns == 1){
                  html2 += '<option selected="selected" value="1">Customer</option>';
                  html2 += '<option value="2">Supplier</option>';
              }else{
                  html2 += '<option value="1">Customer</option>';
                  html2 += '<option selected="selected" value="2">Supplier</option>';
              }
              
              $('#m_bp_jns').html(html2);
            }else{
              SweetAlert.fire({
                icon: 'warning',
                title: 'Warning',
                text: data.msg,
                showConfirmButton: false,
                timer: 1500
              });
            }
          }
        });
    });
    $(document).on("click", ".close", function () {
      var html = '';
      $('#m_bp_id').val("");
      $('#m_bp_code').val("");
      $('#m_bp_name').val("");
      $('#m_bp_ctc').val("");
      $('#m_bp_alt').val("");
      $('#m_bp_tlp').val("");
      $('#m_bp_fax').val("");
      $('#m_bp_active').val("");
      $('#alert').html(html);
    });
    $(document).on("click", "#tombol_tambah", function () {
      if(validasi()){
        var data = $('#form').serialize();  
        $.ajax({
          type: 'POST',
          url: '<?=site_url('master/Bp/create')?>',
          data: data,
          success: function(response) { 
            var data=JSON.parse(response);
            if(data.success){
              SweetAlert.fire({
                icon: 'success',
                title: 'Success',
                text: data.msg,
                showConfirmButton: false,
                timer: 1500
              });
            }else{
              SweetAlert.fire({
                icon: 'error',
                title: 'Error',
                text: data.msg,
                showConfirmButton: false,
                timer: 1500
              });
            }
            setTimeout(() => {  window.location.assign('<?php echo site_url("master/Bp")?>'); }, 1500);
          }
        });
      }
    }); 
    $(document).on("click", "#tombol_update", function () {
      if(validasi()){
        var data = $('#form').serialize();  
        $.ajax({
          type: 'POST',
          url: '<?=site_url('master/Bp/update')?>',
          data: data,
          success: function(response) { 
            var data=JSON.parse(response);
            if(data.success){
              SweetAlert.fire({
                icon: 'success',
                title: 'Success',
                text: data.msg,
                showConfirmButton: false,
                timer: 1500
              });
            }else{
              SweetAlert.fire({
                icon: 'error',
                title: 'Error',
                text: data.msg,
                showConfirmButton: false,
                timer: 1500
              });
            }
            setTimeout(() => {  window.location.assign('<?php echo site_url("master/Bp")?>'); }, 1500);
          }
        });
      }
    });  
    $(document).on("click", ".Hapus", function () {
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
            url: '<?=site_url('master/Bp/delete')?>',
            data: { Id: Id},
            success: function(response) { 
              var data=JSON.parse(response);
              if(data.success){
                SweetAlert.fire({
                  icon: 'success',
                  title: 'Success',
                  text: data.msg,
                  showConfirmButton: false,
                  timer: 1500
                });
              }else{
                SweetAlert.fire({
                  icon: 'error',
                  title: 'Error',
                  text: data.msg,
                  showConfirmButton: false,
                  timer: 1500
                });
              }
              setTimeout(() => {  window.location.assign('<?php echo site_url("master/Bp")?>'); }, 1500);
            }
          });
        }
      })
    });
    function validasi() {
      var html = '';
      var m_bp_code   = document.getElementById("m_bp_code").value;
      var m_bp_name   = document.getElementById("m_bp_name").value;
      var m_bp_ctc    = document.getElementById("m_bp_ctc").value;
      var m_bp_alt    = document.getElementById("m_bp_alt").value;
      var m_bp_tlp    = document.getElementById("m_bp_tlp").value;
      var m_bp_active = document.getElementById("m_bp_active").value;
      var m_bp_jns    = document.getElementById("m_bp_jns").value;
      if (m_bp_code != "" && m_bp_name != "" && m_bp_ctc != "" && m_bp_alt != "" && m_bp_tlp != "" && m_bp_active != "" && m_bp_jns != "") {
        return true;
      }else{
        SweetAlert.fire({
          icon: 'warning',
          title: 'Warning',
          text: 'Semua Kolom tidak boleh kosong!, Kecuali Fax',
          showConfirmButton: false,
          timer: 1500
        });
      }
    }
  </script>
  <?php $this->load->view('template/v_bottom'); ?> 