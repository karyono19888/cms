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
                        Data Item
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
                        <th class="text-center">Barcode</th>
                        <th class="text-center">Part Name</th>
                        <th class="text-center">Model</th>
                        <th class="text-center">Spesifikasi</th>
                        <th class="text-center">BQ</th>
                        <th class="text-center">Kg/Sheet</th>
                        <th class="text-center">Part No (GLC)</th>
                        <th class="text-center">Job No</th>
                        <th class="text-center">Part No Dlv</th>
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
                        <td><?=$row['m_item_code'] ?></td>
                        <td><?=$row['m_item_name'] ?></td>
                        <td><?=$row['m_item_model'] ?></td>
                        <td><?=$row['m_item_spesifikasi'] ?></td>
                        <td><?=$row['m_item_bq'] ?></td>
                        <td><?=$row['m_item_kg_sheet'] ?></td>
                        <td><?=$row['m_item_part_no_glc'] ?></td>
                        <td><?=$row['m_item_job_no'] ?></td>
                        <td><?=$row['m_item_part_dlv'] ?></td>
                        <td width="50">
                            <div class="btn-group">
                            <button type="button" class="btn btn-tool" data-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <a href="#" class="dropdown-item Edit" data-toggle="modal" data-target="#modal-sm" data-id="<?=$row['m_item_id'] ?>" data-backdrop="static" data-keyboard="false"><i class="fas fa-edit"></i> Edit</a>
                                <a href="#" class="dropdown-item Hapus" data-id="<?=$row['m_item_id'] ?>"><i class="fas fa-trash-alt"></i> Delete</a>
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
              <label for="qty" class="col-sm-3 col-form-label">Job No :</label>
              <div class="col-sm-4">
                <input type="hidden" class="form-control" id="m_item_id" name="m_item_id">
                <input type="text" class="form-control" id="m_item_job_no" name="m_item_job_no" placeholder="Job No" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-3 col-form-label">Part No(GLC) :</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="m_item_part_no_glc" name="m_item_part_no_glc" placeholder="Part No(GLC)" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-3 col-form-label">Model :</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="m_item_model" name="m_item_model" placeholder="Model" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-3 col-form-label">Part Name :</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="m_item_name" name="m_item_name" placeholder="Part Name" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-3 col-form-label">Spesifikasi :</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="m_item_spesifikasi" name="m_item_spesifikasi" placeholder="Spesifikasi" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-3 col-form-label">BQ :</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="m_item_bq" name="m_item_bq" placeholder="BQ" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-3 col-form-label">Kg/Sheet :</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="m_item_kg_sheet" name="m_item_kg_sheet" placeholder="Kg/Sheet" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-3 col-form-label">Part No Dlv :</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="m_item_part_dlv" name="m_item_part_dlv" placeholder="Part No Dlv" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="cart" class="col-sm-3 col-form-label">Category :</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id="m_item_category" name="m_item_category" data-placeholder="Category" required>
                  <option value=""></option>
                  <?php foreach($category->result_array() as $data){ ?>
                    <option value="<?=$data['m_category_id']?>"><?=$data['m_category_name']?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="cart" class="col-sm-3 col-form-label">Uom :</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id="m_item_uom" name="m_item_uom" data-placeholder="Uom" required>
                  <option value=""></option>
                  <?php foreach($uom->result_array() as $data){ ?>
                    <option value="<?=$data['m_uom_id']?>"><?=$data['m_uom_name']?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="cart" class="col-sm-3 col-form-label">Type :</label>
              <div class="col-sm-5">
                <select class="form-control select2" style="width: 100%;" id="m_item_type" name="m_item_type" data-placeholder="Type" required>
                  <option value=""></option>
                  <?php foreach($type->result_array() as $data){ ?>
                    <option value="<?=$data['m_type_id']?>"><?=$data['m_type_name']?></option>
                  <?php } ?>
                </select>
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
      var html2 = '';
      var html3 = '';
      var myid = $(this).data('id');
        $.ajax({
          type: 'POST',
          url: '<?=site_url('master/Item/view')?>',
          data: { myid: myid},
          success: function(response) { 
            var data=JSON.parse(response);
            $('#m_item_id').val(data.m_item_id);
            $('#m_item_name').val(data.m_item_name);
            $('#m_item_model').val(data.m_item_model);
            $('#m_item_spesifikasi').val(data.m_item_spesifikasi);
            $('#m_item_bq').val(data.m_item_bq);
            $('#m_item_kg_sheet').val(data.m_item_kg_sheet);
            $('#m_item_part_no_glc').val(data.m_item_part_no_glc);
            $('#m_item_job_no').val(data.m_item_job_no);
            $('#m_item_part_dlv').val(data.m_item_part_dlv);
            html += '<option value='+data.m_item_category+'>'+data.m_category_name+'</option>';
            html +='<?php foreach($category->result_array() as $data){ ?><option value="<?=$data['m_category_id']?>"><?=$data['m_category_name']?></option><?php } ?>';
						$('#m_item_category').html(html);
            html2 += '<option value='+data.m_item_uom+'>'+data.m_uom_name+'</option>';
            html2 +='<?php foreach($uom->result_array() as $data){ ?><option value="<?=$data['m_uom_id']?>"><?=$data['m_uom_name']?></option><?php } ?>';
						$('#m_item_uom').html(html2);
            html3 += '<option value='+data.m_item_type+'>'+data.m_type_name+'</option>';
            html3 +='<?php foreach($type->result_array() as $data){ ?><option value="<?=$data['m_type_id']?>"><?=$data['m_type_name']?></option><?php } ?>';
						$('#m_item_type').html(html3);
          }
        });
    });
    $(document).on("click", ".close", function () {
      var html = '';
      var html2 = '';
      var html3 = '';
      $('#m_item_id').val("");
      $('#m_item_name').val("");
      $('#m_item_model').val("");
      $('#m_item_spesifikasi').val("");
      $('#m_item_bq').val("");
      $('#m_item_kg_sheet').val("");
      $('#m_item_part_no_glc').val("");
      $('#m_item_job_no').val("");
      $('#m_item_part_dlv').val("");
      $('#alert').html(html);
      html += '<option value=""></option>';
      html +='<?php foreach($category->result_array() as $data){ ?><option value="<?=$data['m_category_id']?>"><?=$data['m_category_name']?></option><?php } ?>';
      $('#m_item_category').html(html);
      html2 += '<option value=""></option>';
      html2 +='<?php foreach($uom->result_array() as $data){ ?><option value="<?=$data['m_uom_id']?>"><?=$data['m_uom_name']?></option><?php } ?>';
      $('#m_item_uom').html(html2);
      html3 += '<option value=""></option>';
      html3 +='<?php foreach($type->result_array() as $data){ ?><option value="<?=$data['m_type_id']?>"><?=$data['m_type_name']?></option><?php } ?>';
      $('#m_item_type').html(html3);
    });
    $(document).on("click", "#tombol_tambah", function () {
      if(validasi()){
        var data = $('#form').serialize();  
        $.ajax({
          type: 'POST',
          url: '<?=site_url('master/Item/create')?>',
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
          url: '<?=site_url('master/Item/update')?>',
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
            url: '<?=site_url('master/Item/delete')?>',
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
              setTimeout(() => {  window.location.assign('<?php echo site_url("master/Item")?>'); }, 1500);
            }
          });
        }
      })
    });
    function validasi() {
      var html = '';
      var m_item_job_no      = document.getElementById("m_item_job_no").value;
      var m_item_part_no_glc = document.getElementById("m_item_part_no_glc").value;
      var m_item_name        = document.getElementById("m_item_name").value;
      var m_item_model       = document.getElementById("m_item_model").value;
      var m_item_spesifikasi = document.getElementById("m_item_spesifikasi").value;
      var m_item_bq          = document.getElementById("m_item_bq").value;
      var m_item_kg_sheet    = document.getElementById("m_item_kg_sheet").value;
      var m_item_part_dlv    = document.getElementById("m_item_part_dlv").value;
      if (m_item_job_no != "" && m_item_part_no_glc != "" && m_item_name != "" && m_item_model != "" && m_item_spesifikasi != "" && m_item_bq != "" && m_item_kg_sheet != "" && m_item_part_dlv != "") {
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