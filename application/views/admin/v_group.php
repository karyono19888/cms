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
                          <th class="text-center">Nama Group</th>
                          <th class="text-center">Kode Group</th>
                          <th class="text-center"><i class="fas fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                          $no=1;
                          foreach ($data->result_array() as $row ){ 
                      ?>
                      <tr>    
                          <td class="text-center" width="50"><?=$no++ ?></td>
                          <td><?=$row['a_level_name'] ?></td>
                          <td class="text-center"><?=$row['a_level_id'] ?></td>
                          <td width="50">
                              <div class="btn-group">
                              <button type="button" class="btn btn-tool" data-toggle="dropdown">
                                  <i class="fas fa-ellipsis-v"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-right" role="menu">
                                  <a href="#" class="dropdown-item Edit" data-toggle="modal" data-target="#modal-sm" data-id="<?=$row['a_level_id'] ?>" data-backdrop="static" data-keyboard="false"><i class="fas fa-edit"></i> Edit</a>
                                  <a href="#" class="dropdown-item Hapus" data-id="<?=$row['a_level_id'] ?>"><i class="fas fa-trash-alt"></i> Delete</a>
                                  <a href="#" class="dropdown-item Akses" data-toggle="modal" data-target="#modal_menu" data-id="<?=$row['a_level_id'] ?>" data-nama="<?=$row['a_level_name'] ?>" data-backdrop="static" data-keyboard="false"><i class="fas fa-chalkboard-teacher"></i> Hak Akses</a>
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

  <div class="modal fade" id="modal_menu">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" >Pengaturan Akses Menu</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row justify-content-center">
            <div class="col-sm-10" id="tampil">
              
            </div>
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <div class="modal fade" id="modal-sm">
    <div class="modal-dialog">
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
              <label for="qty" class="col-sm-4 col-form-label">Nama Group :</label>
              <div class="col-sm-8">
                <input type="hidden" class="form-control" id="a_level_id" name="a_level_id">
                <input type="text" class="form-control" id="a_level_name" name="a_level_name" placeholder="Nama Group" required>
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
          url: '<?=site_url('admin/Group/view')?>',
          data: { myid: myid},
          success: function(response) { 
            var data=JSON.parse(response);
            if(data.success){
              $('#a_level_id').val(data.a_level_id);
						  $('#a_level_name').val(data.a_level_name);
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
    $(document).on("click", ".Akses", function () {
      btn = '';
      vlu = '';
      html = '';
      var myNm = $(this).data('nama');
      var myid = $(this).data('id');
      if(myid == 1){
        $('#modal_menu').modal('hide');
        SweetAlert.fire({
          icon: 'warning',
          title: 'Perhatian !',
					text: 'Group Administrator tidak boleh diupdate!',
          showConfirmButton: false,
          timer: 1500
        })
        setTimeout(() => {  window.location.assign('<?php echo site_url("admin/Group")?>'); }, 1500);
      }else{
        $.ajax({
          type: 'POST',
          url: '<?=site_url('admin/Group/menu')?>',
          data: { myid: myid},
          success: function(response) {
            html = '<h5>Group : '+ myNm +'</h5>';
            var data=JSON.parse(response);
            for (i = 0; i < data.rows.length; i++) {
              if(data.rows[i].a_mn_grp_sts == 1){ 
                vlu = 'Aktif';
                btn = 'btn btn-outline-info btn-sm';
              }else{ 
                vlu = 'Tidak Aktif';
                btn = 'btn btn-outline-danger btn-sm';
              } 
              html += '<div class="form-check mb-1 mt-1">'+
                        '<input type="submit" class="'+btn+'" id="updt" data-id="'+data.rows[i].a_mn_grp_id+'" data-sts="'+data.rows[i].a_mn_grp_sts+'" data-lvl="'+data.rows[i].a_mn_grp_lvl+'" value="'+vlu+'">'+
                        '<label class="form-check-label ml-2">'+data.rows[i].a_mn_name+'</label>'+ 
                      '</div>'
            }
            document.getElementById("tampil").innerHTML = html;
          }
        });
      }
    });
    $(document).on("click", "#updt", function () {
      btn = '';
      vlu = '';
      html = '';
      var myid = $(this).data('id');
      var mysts = $(this).data('sts');  
      var mylvl = $(this).data('lvl');  
      $.ajax({
        type: 'POST',
        url: '<?=site_url('admin/Group/akses')?>',
        data: { myid: myid, mysts: mysts, mylvl: mylvl},
        success: function(response) { 
          var data=JSON.parse(response);
          for (i = 0; i < data.rows.length; i++) {
            if(data.rows[i].a_mn_grp_sts == 1){ 
              vlu = 'Aktif';
              btn = 'btn btn-outline-info btn-sm';
            }else{ 
              vlu = 'Tidak Aktif';
              btn = 'btn btn-outline-danger btn-sm';
            } 
            html += '<div class="form-check mb-1 mt-1">'+
                      '<input type="submit" class="'+btn+'" id="updt" data-id="'+data.rows[i].a_mn_grp_id+'" data-sts="'+data.rows[i].a_mn_grp_sts+'" data-lvl="'+data.rows[i].a_mn_grp_lvl+'" value="'+vlu+'">'+
                      '<label class="form-check-label ml-2">'+data.rows[i].a_mn_name+'</label>'+ 
                    '</div>'
          }
          document.getElementById("tampil").innerHTML = html;
        }
      });
    }); 
    $(document).on("click", ".close", function () {
      var html = '';
      $('#a_level_id').val("");
      $('#a_level_name').val("");
      $('#alert').html(html);
      $('#tampil').html(html);
    });
    $(document).on("click", "#tombol_tambah", function () {
      if(validasi()){
        var data = $('#form').serialize();  
        $.ajax({
          type: 'POST',
          url: '<?=site_url('admin/Group/create')?>',
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
            setTimeout(() => {  window.location.assign('<?php echo site_url("admin/Group")?>'); }, 1500);
          }
        });
      }
    }); 
    $(document).on("click", "#tombol_update", function () {
      if(validasi()){
        var data = $('#form').serialize();  
        $.ajax({
          type: 'POST',
          url: '<?=site_url('admin/Group/update')?>',
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
            setTimeout(() => {  window.location.assign('<?php echo site_url("admin/Group")?>'); }, 1500);
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
            url: '<?=site_url('admin/Group/delete')?>',
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
              setTimeout(() => {  window.location.assign('<?php echo site_url("admin/Group")?>'); }, 1500);
            }
          });
        }
      })
    });
    function validasi() {
      var html = '';
      var a_level_name = document.getElementById("a_level_name").value;
      if (a_level_name != "") {
        return true;
      }else{
        SweetAlert.fire({
          icon: 'warning',
          title: 'Warning',
          text: 'Kolom tidak boleh kosong',
          showConfirmButton: false,
          timer: 1500
        });
      }
    }
  </script>
  <?php $this->load->view('template/v_bottom'); ?> 