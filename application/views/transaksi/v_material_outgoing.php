<?php $this->load->view('template/v_header'); ?> 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Transactions <span class="text-sm">Material Outgoing</span></h1>
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
                      <button type="button" class="btn btn-outline-primary btn-sm Tambah" data-toggle="modal" data-target="#modal_header" data-backdrop="static" data-keyboard="false">
                          <i class="fas fa-plus-circle"></i> Add
                      </button>
                      <button type="button" class="btn btn-outline-primary btn-sm Edit">
                          <i class="fas fa-edit"></i> Edit
                      </button>
                    </div>
                </div>
                <!-- /.card-header -->
              <div class="card-body">
                <table id="tableHeader" class="table table-bordered table-striped">
                  <thead>
                    <tr>    
                        <th class="text-center">No</th>
                        <th class="text-center">Document No</th>
                        <th class="text-center">Line</th>
                        <th class="text-center">Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $no=1;
                        foreach ($data->result_array() as $row ){ 
                    ?>
                    <tr id="baris" data-id="<?=$row['t_mo_head_id'] ?>">    
                        <td class="text-center" width="50"><?=$no++ ?></td>
                        <td><?=$row['t_mo_head_doc_no'] ?></td>
                        <td><?=$row['m_line_name'] ?></td>
                        <td class="text-center"><?=date('d-m-Y', strtotime($row['t_mo_head_date'])) ?></td>
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
                          <th class="text-center">Barcode</th>
                          <th class="text-center">Spec</th>
                          <th class="text-center">Qty Sheet</th>
                          <th class="text-center">Qty Pcs</th>
                          <th class="text-center">Qty Kg</th>
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
    <div class="modal-dialog">
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
            <div id="alert"></div>
            <div id="EdDate"></div>
            <div class="form-group row">
              <label for="qty" class="col-sm-4 col-form-label">Document No :</label>
              <div class="col-sm-4">
                <input type="hidden" class="form-control" id="t_mo_head_id" name="t_mo_head_id">
                <input type="text" class="form-control" id="t_mo_head_doc_no" name="t_mo_head_doc_no" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-4 col-form-label">Line :</label>
              <div class="col-sm-8">
                <select class="form-control select2" style="width: 100%;" id="t_mo_head_line" name="t_mo_head_line" data-placeholder="Line" required>
                  <option value=""></option>
                  <?php foreach($line->result_array() as $data){ ?>
                    <option value="<?=$data['m_line_id']?>"><?=$data['m_line_name']?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-4 col-form-label">Date :</label>
              <div class="col-sm-5">
                <input type="date" class="form-control" id="t_mo_head_date" name="t_mo_head_date" placeholder="Date" required>  
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
            <div id="alert2"></div>
            <div class="form-group row">
              <label for="qty" class="col-sm-3 col-form-label">Material :</label>
              <div class="col-sm-5">
                <select class="form-control select2 Item" style="width: 100%;" id="t_mo_line_proses" name="t_mo_line_proses" data-placeholder="Material" required>
                  <option value=""></option>
                  <option value="1">Sharing</option>
                  <option value="2">Non Sharing</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-3 col-form-label">Barcode & Spec :</label>
              <div class="col-sm-9">
                <input type="hidden" class="form-control" id="t_mo_line_id" name="t_mo_line_id">
                <input type="hidden" class="form-control" id="t_mo_line_head" name="t_mo_line_head">
                <select class="form-control select2 Item" style="width: 100%;" id="t_mo_line_item" name="t_mo_line_item" data-placeholder="Job No" required>
                  <option></option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-3 col-form-label">Stok :</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="stok_sheet" placeholder="Sheet" readonly>
              </div>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="stok_pcs" placeholder="Pcs" readonly>
              </div>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="stok_kg" placeholder="Kg" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="qty" class="col-sm-3 col-form-label">Qty :</label>
              <div class="col-sm-3">
                <input type="hidden" class="form-control" id="m_item_bq">
                <input type="hidden" class="form-control" id="m_item_kg_sheet">
                <input type="text" class="form-control" id="t_mo_line_sheet" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" placeholder="Sheet" required>
                <input type="hidden" class="form-control" id="qty" name="t_mo_line_sheet" readonly>
              </div>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="pcs" placeholder="Pcs" readonly>
                <input type="hidden" class="form-control" id="t_mo_line_pcs" name="t_mo_line_pcs" placeholder="Pcs" readonly>
              </div>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="kg" placeholder="Kg" readonly>
                <input type="hidden" class="form-control" id="t_mo_line_kg" name="t_mo_line_kg" placeholder="Kg" readonly>
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
      $.ajax({
        type: 'GET',
        url: '<?=site_url('transaksi/MaterialOutgoing/getDocNo')?>',
        success: function(response) { 
          var data=JSON.parse(response);
          $('#t_mo_head_doc_no').val(data.doc_no);
        }
      });
    });
    $(document).ready(function() {
      var table = $('#tableHeader').DataTable();
      $('#tableHeader tbody').on( 'click', 'tr', function () {
          if ( $(this).hasClass('selected') ) {
              $(this).removeClass('selected');
              $('#t_mo_line_head').val('');
              html = '';
              document.getElementById("tampil").innerHTML = html;
          }
          else {
              table.$('tr.selected').removeClass('selected');
              $(this).addClass('selected');
              var idHead = $(this).data('id');
              $('#t_mo_line_head').val(idHead);
              getLine();
          }
      });
    });
    function getLine(){
      var id = document.getElementById("t_mo_line_head").value;
      no = 1;
      html = '';
      $.ajax({
        type: 'POST',
        url: '<?=site_url('transaksi/MaterialOutgoing/view_line')?>',
        data: { id: id},
        success: function(response) { 
          var data=JSON.parse(response);
          for (i = 0; i < data.rows.length; i++) {
            html += '<tr>'+
                      '<td class="text-center">'+[no++]+'</td>'+
                      '<td>'+data.rows[i].m_item_code+'</td>'+
                      '<td>'+data.rows[i].m_item_spesifikasi+'</td>'+
                      '<td class="text-center">'+titik(data.rows[i].t_mo_line_sheet)+'</td>'+
                      '<td class="text-center">'+titik(data.rows[i].t_mo_line_pcs)+'</td>'+
                      '<td class="text-center">'+titik_koma(data.rows[i].t_mo_line_kg)+'</td>'+
                      '<td width="50">'+
                        '<div class="btn-group">'+
                          '<button type="button" class="btn btn-tool" data-toggle="dropdown">'+
                              '<i class="fas fa-ellipsis-v"></i>'+
                          '</button>'+
                          '<div class="dropdown-menu dropdown-menu-right" role="menu">'+
                              '<a href="#" class="dropdown-item Edit2" data-toggle="modal" data-target="#modal_line" data-id="'+data.rows[i].t_mo_line_id+'" data-backdrop="static" data-keyboard="false"><i class="fas fa-edit"></i> Edit</a>'+
                              '<a href="#" class="dropdown-item Hapus2" data-id="'+data.rows[i].t_mo_line_id+'"><i class="fas fa-trash-alt"></i> Delete</a>'+
                          '</div>'+
                        '</div>'+
                      '</td>'+
                    '</tr>'
          }
          $('#tampil').html(html);
        }
      });
    }
    $(document).on("click", ".Edit", function () {
      $('#judul1_head').hide();
      $('#tombol_tambah_head').hide();
      $('#judul2_head').show();
      $('#tombol_update_head').show();
      var html = '';
      var html2 = '';
      var html3 = '';
      var myid = document.getElementById("t_mo_line_head").value;
      if(myid > 0){
        $.ajax({
          type: 'POST',
          url: '<?=site_url('transaksi/MaterialOutgoing/view_head')?>',
          data: { myid: myid},
          success: function(response) { 
            $('#modal_header').modal({ backdrop: 'static', keyboard: false, show: true });
            var data=JSON.parse(response);
						$('#t_mo_head_id').val(data.t_mo_head_id);
            $('#t_mo_head_doc_no').val(data.t_mo_head_doc_no);
            html += '<option value='+data.m_line_id+'>'+data.m_line_name+'</option>';
            html += '<?php foreach($line->result_array() as $data){ ?><option value="<?=$data['m_line_id']?>"><?=$data['m_line_name']?></option><?php } ?>';
						$('#t_mo_head_line').html(html);
            $('#t_mo_head_date').val(data.t_mo_head_date);
          }
        });
      }else{
        SweetAlert.fire({
					icon: 'warning',
					title: 'Perhatian !',
					text: 'Header belum di pilih!',
					showConfirmButton: false,
					timer: 1500
				})
      }
    });
    $(document).on("click", "#tombol_tambah_head", function () {
      if(validasi()){
        var data = $('#form_header').serialize();  
        $.ajax({
          type: 'POST',
          url: '<?=site_url('transaksi/MaterialOutgoing/create_head')?>',
          data: data,
          success: function(response) { 
            $('#modal_header').modal('hide');
          }
        });
      }
    }); 
    $(document).on("click", "#tombol_update_head", function () {
      if(validasi()){
        var data = $('#form_header').serialize();  
        $.ajax({
          type: 'POST',
          url: '<?=site_url('transaksi/MaterialOutgoing/update_head')?>',
          data: data,
          success: function(response) { 
            $('#modal_header').modal('hide');
          }
        });
      }
    });  
    $(document).on("click", ".Hapus", function () {
      var Id = document.getElementById("t_mo_line_head").value;
      if(Id > 0){
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
              url: '<?=site_url('transaksi/MaterialOutgoing/delete_head')?>',
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
                setTimeout(() => {  window.location.assign('<?php echo site_url("transaksi/MaterialOutgoing")?>'); }, 1500);
              }
            });
          }
        })
      }else{
        SweetAlert.fire({
					icon: 'warning',
					title: 'Perhatian !',
					text: 'Header belum di pilih!',
					showConfirmButton: false,
					timer: 1500
				})
      }
    });
    function validasi() {
      var html = '';
      var t_mo_head_doc_no  = document.getElementById("t_mo_head_doc_no").value;
      var t_mo_head_line      = document.getElementById("t_mo_head_line").value;
      var t_mo_head_date    = document.getElementById("t_mo_head_date").value;
      if (t_mo_head_doc_no != "" && 
          t_mo_head_line != "" && 
          t_mo_head_date != "") {
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
    $(document).on("click", "#tutup", function () {
      var html = '';
      $('#t_mo_head_doc_no').val("");
      $('#t_mo_head_date').val("");
      html += '<option value=""></option>';
      html += '<?php foreach($line->result_array() as $data){ ?><option value="<?=$data['m_line_id']?>"><?=$data['m_line_name']?></option><?php } ?>';
      $('#t_mo_head_line').html(html);
    });

    // Line

    $(document).on("click", ".Tambah2", function () {
      var idLine = document.getElementById("t_mo_line_head").value;
      if(idLine > 0){
        $('#modal_line').modal({ backdrop: 'static', keyboard: false, show: true });
        $('#judul2_line').hide();
        $('#tombol_update_line').hide();
        $('#judul1_line').show();
        $('#tombol_tambah_line').show();
        getItem();
      }else{
        SweetAlert.fire({
					icon: 'warning',
					title: 'Perhatian !',
					text: 'Header belum di pilih!',
					showConfirmButton: false,
					timer: 1500
				})
      }
    });
    function getItem(){
      var html ='';
      $.ajax({
        type: 'GET',
        url: '<?=site_url('transaksi/MaterialOutgoing/getItem')?>',
        success: function(response) { 
          var data=JSON.parse(response);
          html +='<option></option>';
          for (i = 0; i < data.row.length; i++) {
            html += '<option value="'+data.row[i].m_item_id+'">'+data.row[i].m_item_code+' ( '+data.row[i].m_item_spesifikasi+' )</option>'
          }
          document.getElementById("t_mo_line_item").innerHTML = html;
        }
      });
    }
    $(document).on("change", ".Item", function () {
      $('#t_mo_line_sheet').val("");
      $('#t_mo_line_pcs').val("");
      $('#t_mo_line_kg').val("");
      $('#m_item_bq').val("");
      $('#m_item_kg_sheet').val("");
      $('#pcs').val("");
      $('#kg').val("");
      $('#qty').val("");
      var id = document.getElementById("t_mo_line_item").value;
        $.ajax({
          type: 'POST',
          url: '<?=site_url('transaksi/MaterialOutgoing/getBarcode')?>',
          data: {id:id},
          success: function(response) { 
            var data=JSON.parse(response);
            $('#m_item_bq').val(data.m_item_bq);
            $('#m_item_kg_sheet').val(data.m_item_kg_sheet);
            $('#stok_sheet').val(titik(data.sheet));
            $('#stok_pcs').val(titik(data.pcs));
            $('#stok_kg').val(titik_koma(data.kg));
            $('#t_mo_line_sheet').focus();
          }
        });
    });
    $(document).on("keyup", "#t_mo_line_sheet", function () {
      var m_item_bq       = document.getElementById("m_item_bq").value;
      var m_item_kg_sheet = document.getElementById("m_item_kg_sheet").value;
      var t_mo_line_sheet = document.getElementById("t_mo_line_sheet").value;
      var qty = parseInt(t_mo_line_sheet.replace(/,.*|[^0-9]/g, ''), 10);
      pcs = qty * m_item_bq;
      kg  = qty * m_item_kg_sheet;
      if(pcs > 0){
        document.getElementById("pcs").value=titik(pcs);
        document.getElementById("t_mo_line_pcs").value=no_koma(pcs);
      }else{
        document.getElementById("pcs").value='';
        document.getElementById("t_mo_line_pcs").value='';
      }
      if(kg > 0){
        document.getElementById("kg").value=titik_koma(kg);
        document.getElementById("t_mo_line_kg").value=no_koma(kg);
        document.getElementById("qty").value=qty;
      }else{
        document.getElementById("kg").value='';
        document.getElementById("t_mo_line_kg").value='';
        document.getElementById("qty").value='';
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
          url: '<?=site_url('transaksi/MaterialOutgoing/edit_line')?>',
          data: {id:id},
          success: function(response) {
            var data=JSON.parse(response);
            $('#t_mo_line_id').val(data.t_mo_line_id);
            html += '<option value="'+data.m_item_id+'">'+data.m_item_code+' ( '+data.m_item_spesifikasi+' )</option>';
            html += '<?php foreach($item->result_array() as $data){ ?><option value="<?=$data['m_item_id']?>"><?=$data['m_item_code']?> ( <?=$data['m_item_spesifikasi']?> )</option><?php } ?>';
            $('#t_mo_line_item').html(html);
            $('#t_mo_line_sheet').val(titik(data.t_mo_line_sheet));
            $('#qty').val(data.t_mo_line_sheet);
            $('#t_mo_line_pcs').val(data.t_mo_line_pcs);
            $('#t_mo_line_kg').val(data.t_mo_line_kg);
            $('#pcs').val(titik(data.t_mo_line_pcs));
            $('#kg').val(titik_koma(data.t_mo_line_kg));
            $('#m_item_bq').val(data.m_item_bq);
            $('#m_item_kg_sheet').val(data.m_item_kg_sheet);
            $('#stok_sheet').val(titik(data.sheet));
            $('#stok_pcs').val(titik(data.pcs));
            $('#stok_kg').val(titik_koma(data.kg));
          }
      });
    });
    $(document).on("click", "#tombol_tambah_line", function () {
      if(validasi2()){
        var data = $('#form_line').serialize();
        $.ajax({
          type: 'POST',
          url: '<?=site_url('transaksi/MaterialOutgoing/create_line')?>',
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
              clear();
              getItem();
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
    $(document).on("click", "#tombol_update_line", function () {
      if(validasi2()){
        var data = $('#form_line').serialize();  
        $.ajax({
          type: 'POST',
          url: '<?=site_url('transaksi/MaterialOutgoing/update_line')?>',
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
    function validasi2() {
      var html = '';
      var t_mo_line_item     = document.getElementById("t_mo_line_item").value;
      var t_mo_line_sheet      = document.getElementById("t_mo_line_sheet").value;
      if (t_mo_line_item != "" &&  
          t_mo_line_sheet != "") {
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
            url: '<?=site_url('transaksi/MaterialOutgoing/delete_line')?>',
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
    
    $(document).on("click", "#tutup2", function () {
      clear();
    });
    function clear(){
      var html = '';
      $('#t_mo_line_item').html("");
      $('#t_mo_line_sheet').val("");
      $('#t_mo_line_pcs').val("");
      $('#t_mo_line_kg').val("");
      $('#m_item_bq').val("");
      $('#m_item_kg_sheet').val("");
      $('#pcs').val("");
      $('#kg').val("");
      $('#qty').val("");
      $('#stok_sheet').val("");
      $('#stok_pcs').val("");
      $('#stok_kg').val("");
    };
  </script>
  <?php $this->load->view('template/v_bottom'); ?> 