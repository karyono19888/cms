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
                        Data Uom
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
                        <th class="text-center">Nama Uom</th>
                        <th class="text-center">Kode Uom</th>
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
                        <td><?=$row['m_uom_name'] ?></td>
                        <td class="text-center"><?=$row['m_uom_id'] ?></td>
                        <td width="50">
                            <div class="btn-group">
                            <button type="button" class="btn btn-tool" data-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <a href="#" class="dropdown-item Edit" data-toggle="modal" data-target="#modal-sm" data-id="<?=$row['m_uom_id'] ?>" data-backdrop="static" data-keyboard="false"><i class="fas fa-edit"></i> Edit</a>
                                <a href="#" class="dropdown-item Hapus" data-id="<?=$row['m_uom_id'] ?>"><i class="fas fa-trash-alt"></i> Delete</a>
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
              <label for="qty" class="col-sm-4 col-form-label">Nama Uom :</label>
              <div class="col-sm-8">
                <input type="hidden" class="form-control" id="m_uom_id" name="m_uom_id">
                <input type="text" class="form-control" id="m_uom_name" name="m_uom_name" placeholder="Nama Uom" required>
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
          url: '<?=site_url('master/Uom/view')?>',
          data: { myid: myid},
          success: function(response) { 
            var data=JSON.parse(response);
						$('#m_uom_id').val(data.m_uom_id);
						$('#m_uom_name').val(data.m_uom_name);
          }
        });
    });
    $(document).on("click", ".close", function () {
      var html = '';
      $('#m_uom_id').val("");
      $('#m_uom_name').val("");
      $('#alert').html(html);
      $('#tampil').html(html);
    });
    $(document).on("click", "#tombol_tambah", function () {
      if(validasi()){
        var data = $('#form').serialize();  
        $.ajax({
          type: 'POST',
          url: '<?=site_url('master/Uom/create')?>',
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
          url: '<?=site_url('master/Uom/update')?>',
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
            url: '<?=site_url('master/Uom/delete')?>',
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
              setTimeout(() => {  window.location.assign('<?php echo site_url("master/Uom")?>'); }, 1500);
            }
          });
        }
      })
    });
    function validasi() {
      var html = '';
      var m_uom_name = document.getElementById("m_uom_name").value;
      if (m_uom_name != "") {
        return true;
      }else{
        html = '<div class="alert alert-danger alert-dismissible">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
                  '<i class="icon fas fa-ban"></i> Text tidak boleh kosong'+
                '</div>';
        $('#alert').html(html);
      }
    }
  </script>
  <?php $this->load->view('template/v_bottom'); ?> 