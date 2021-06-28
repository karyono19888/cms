  <?php $this->load->view('template/v_header'); ?>  
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Admin <small class="h6"><?=$title?></small></h1>

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
                            <th class="text-center">Nama Lengkap</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Level</th>
                            <th class="text-center">ID User</th>
                            <th class="text-center"><i class="fas fa-cogs"></i></th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php 
                            $no=1;
                            foreach ($user->result_array() as $row ){ 
                        ?>
                        <tr>    
                            <td class="text-center" width="50"><?=$no++ ?></td>
                            <td><?=$row['a_user_name'] ?></td>
                            <td><?=$row['a_user_username'] ?></td>
                            <td><?=$row['a_level_name'] ?></td>
                            <td class="text-center" width="100"><?=$row['a_user_id'] ?></td>
                            <td width="50">
                                <div class="btn-group">
                                  <button type="button" class="btn btn-tool" data-toggle="dropdown">
                                      <i class="fas fa-ellipsis-v"></i>
                                  </button>
                                  <div class="dropdown-menu dropdown-menu-right" role="menu">
                                      <a href="#" class="dropdown-item Edit" data-toggle="modal" data-target="#modal-sm" data-id="<?=$row['a_user_id'] ?>" data-backdrop="static" data-keyboard="false"><i class="fas fa-edit"></i> Edit</a>
                                      <a href="#" class="dropdown-item Hapus" data-id="<?=$row['a_user_id'] ?>"><i class="fas fa-trash-alt"></i> Delete</a>
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
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="form-horizontal" id="form" method="post" validation>
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
              <label for="qty" class="col-sm-4 col-form-label">Nama Lengkap :</label>
              <div class="col-sm-8">
                <input type="hidden" class="form-control" id="a_user_id" name="a_user_id">
                <input type="text" class="form-control" id="a_user_name" name="a_user_name" placeholder="Nama Lengkap" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="lot" class="col-sm-4 col-form-label">Username :</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="a_user_username" name="a_user_username" placeholder="Username" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="a_user_password" class="col-sm-4 col-form-label">Password :</label>
              <div class="col-sm-8">
                <input type="password" class="form-control" id="a_user_password" name="a_user_password" placeholder="Password">
              </div>
            </div>
            <div class="form-group row">
              <label for="cart" class="col-sm-4 col-form-label">Level :</label>
              <div class="col-sm-8">
                <select class="form-control" style="width: 100%;" id="a_user_level" name="a_user_level" data-placeholder="Level" required>
                  <option value=""></option>
                  <?php foreach($level->result_array() as $data){ ?>
                    <option value="<?=$data['a_level_id']?>"><?=$data['a_level_name']?></option>
                  <?php } ?>
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
      var myid = $(this).data('id');
        $.ajax({
          type: 'POST',
          url: '<?=site_url('admin/User/view')?>',
          data: { myid: myid},
          success: function(response) { 
            var data=JSON.parse(response);
            if(data.success){
              $('#a_user_id').val(data.a_user_id);
              $('#a_user_name').val(data.a_user_name);
              $('#a_user_username').val(data.a_user_username);
              //$('#a_user_password').val(data.a_user_password);
              html += '<option value='+data.a_level_id+'>'+data.a_level_name+'</option>';
              html +='<?php foreach($level->result_array() as $data){ ?><option value="<?=$data['a_level_id']?>"><?=$data['a_level_name']?></option><?php } ?>';
              $('#a_user_level').html(html);
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
      $('#a_user_id').val("");
      $('#a_user_name').val("");
      $('#a_user_username').val("");
      $('#a_user_password').val("");
      html += '<option value=""></option>';
      html +='<?php foreach($level->result_array() as $data){ ?><option value="<?=$data['a_level_id']?>"><?=$data['a_level_name']?></option><?php } ?>';
      $('#a_user_level').html(html);
      $('#alert').html('');
    });
    $(document).on("click", "#tombol_tambah", function () {
      if(validasi()){
        var data = $('#form').serialize();  
        $.ajax({
          type: 'POST',
          url: '<?=site_url('admin/User/create')?>',
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
            setTimeout(() => {  window.location.assign('<?php echo site_url("admin/User")?>'); }, 1500);
          }
        });
      }
    }); 
    $(document).on("click", "#tombol_update", function () {
      if(validasi2()){
        var data = $('#form').serialize();  
        $.ajax({
          type: 'POST',
          url: '<?=site_url('admin/User/update')?>',
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
            setTimeout(() => {  window.location.assign('<?php echo site_url("admin/User")?>'); }, 1500);
          }
        });
      }
    });  
    $(document).on("click", ".Hapus", function () {
      var a_user_id = $(this).data('id');
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
            url: '<?=site_url('admin/User/delete')?>',
            data: { a_user_id: a_user_id},
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
              setTimeout(() => {  window.location.assign('<?php echo site_url("admin/User")?>'); }, 1500);
            }
          });
        }
      })
    });
    function validasi() {
      var html = '';
      document.getElementById('a_user_password').setAttribute('required','required')
      var a_user_name = document.getElementById("a_user_name").value;
      var a_user_username = document.getElementById("a_user_username").value;
      var a_user_password = document.getElementById("a_user_password").value;
      var a_user_level = document.getElementById("a_user_level").value;
      if (a_user_name != "" && a_user_username!="" && a_user_password !="" && a_user_level !="") {
        return true;
      }else{
        SweetAlert.fire({
          icon: 'warning',
          title: 'Warning',
          text: 'Semua Kolom tidak boleh kosong!',
          showConfirmButton: false,
          timer: 1500
        });
      }
    }
    function validasi2() {
      var html = '';
      var a_user_name = document.getElementById("a_user_name").value;
      var a_user_username = document.getElementById("a_user_username").value;
      var a_user_level = document.getElementById("a_user_level").value;
      if (a_user_name != "" && a_user_username!="" && a_user_level !="") {
        return true;
      }else{
        SweetAlert.fire({
          icon: 'warning',
          title: 'Warning',
          text: 'Kolom Nama, Username & Level tidak boleh kosong!',
          showConfirmButton: false,
          timer: 1500
        });
      }
    }
  </script>
  <?php $this->load->view('template/v_bottom'); ?> 

  