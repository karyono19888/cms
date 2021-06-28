  <?php $this->load->view('template/v_header'); ?> 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Masters</h1>
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
                        Data Line
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-outline-primary btn-sm Tambah" data-toggle="modal" data-target="#modal-sm" data-backdrop="static" data-keyboard="false">
                            <i class="fas fa-plus-circle"></i> Add
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>    
                        <th class="text-center">No</th>
                        <th class="text-center">Line</th>
                        <th class="text-center">Leader</th>
                        <th class="text-center">Keterangan</th>
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
                        <td><?=$row['m_line_name'] ?></td>
                        <td><?=$row['m_line_leader'] ?></td>
                        <td><?=$row['m_line_keterangan'] ?></td>
                        <td width="50">
                            <div class="btn-group">
                            <button type="button" class="btn btn-tool" data-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <a href="#" class="dropdown-item Edit" data-toggle="modal" data-target="#modal-sm" data-id="<?=$row['m_line_id'] ?>" data-backdrop="static" data-keyboard="false"><i class="fas fa-edit"></i> Edit</a>
                                <a href="#" class="dropdown-item Hapus" data-id="<?=$row['m_line_id'] ?>"><i class="fas fa-trash-alt"></i> Delete</a>
                            </div>
                            </div>
                        </td>
                    </tr>
                    <?php };?>
                  </tbody>
                </table>
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
              <label for="qty" class="col-sm-3 col-form-label">line :</label>
              <div class="col-sm-4">
                <input type="hidden" class="form-control" id="m_line_id" name="m_line_id">
                <input type="text" class="form-control" id="m_line_name" name="m_line_name" placeholder="line" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-3 col-form-label">Leader :</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="m_line_leader" name="m_line_leader" placeholder="Leader" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-3 col-form-label">Keterangan :</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="m_line_keterangan" name="m_line_keterangan" placeholder="Keterangan" required>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="submit" class="btn btn-outline-primary" id="tombol_tambah">Save</button>
            <button type="submit" class="btn btn-outline-primary" id="tombol_update">Update</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <?php $this->load->view('template/v_foot'); ?> 
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
          url: '<?=site_url('master/Line/view')?>',
          data: { myid: myid},
          success: function(response) { 
            var data=JSON.parse(response);
						$('#m_line_id').val(data.m_line_id);
						$('#m_line_name').val(data.m_line_name);
            $('#m_line_leader').val(data.m_line_leader);
            $('#m_line_keterangan').val(data.m_line_keterangan);
          }
        });
    });
    $(document).on("click", ".close", function () {
      $('#m_line_id').val("");
      $('#m_line_name').val("");
      $('#m_line_leader').val("");
      $('#m_line_keterangan').val("");
    });
    $(document).on("click", "#tombol_tambah", function () {
      if(validasi()){
        var data = $('#form').serialize();  
        $.ajax({
          type: 'POST',
          url: '<?=site_url('master/Line/create')?>',
          data: data,
          success: function(response) { 
            $('#modal-sm').modal('hide');
          }
        });
      }
    }); 
    $(document).on("click", "#tombol_update", function () {
      if(validasi()){
        var data = $('#form').serialize();  
        $.ajax({
          type: 'POST',
          url: '<?=site_url('master/Line/update')?>',
          data: data,
          success: function(response) { 
            $('#modal-sm').modal('hide');
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
            url: '<?=site_url('master/Line/delete')?>',
            data: { Id: Id},
            success: function(response) { 
              var data=JSON.parse(response);
              if(data.success){
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
              }else{
                Swal.fire(
                  'Deleted!',
                  'Your file cannot be deleted.',
                  'error'
                )
              }
              setTimeout(() => {  window.location.assign('<?php echo site_url("master/Line")?>'); }, 1500);
            }
          });
        }
      })
    });
    function validasi() {
      var html = '';
      var m_line_name = document.getElementById("m_line_name").value;
      var m_line_leader = document.getElementById("m_line_leader").value;
      var m_line_keterangan = document.getElementById("m_line_keterangan").value;
      if (m_line_name != "" && m_line_leader != "" && m_line_keterangan != "") {
        return true;
      }else{
        SweetAlert.fire({
          icon: 'warning',
          title: 'Warning!',
          text: 'Kolom tidak boleh ada yang kosong.',
          showConfirmButton: false,
          timer: 1500
        });
      }
    }
  </script>
  <?php $this->load->view('template/v_bottom'); ?> 