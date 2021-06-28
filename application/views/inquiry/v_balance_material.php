<?php $this->load->view('template/v_header'); ?> 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Inquiry <span class="text-sm">Balance Material</span></h1>
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
                <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>    
                        <th class="text-center">No</th>
                        <th class="text-center">Barcode</th>
                        <th class="text-center">Part Name</th>
                        <th class="text-center">Stock</th>
                        <th class="text-center">Sharing</th>
                        <th class="text-center">Stamping</th>
                        <th class="text-center">Quality</th>
                        <th class="text-center">Delivery</th>
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
                        <td class="text-right">
                          <div class="btn-group">
                            <button type="button" class="btn btn-tool" data-toggle="dropdown">
                              <span style="color:#000"><?= number_format($row['qty'],0,',','.')?></span> <i class="fas fa-angle-down"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <a href="#" class="dropdown-item"><?= number_format($row['qty'],0,',','.')?> Sheet</a>
                                <a href="#" class="dropdown-item"><?= number_format($row['pcs'],0,',','.')?> Pcs</a>
                                <a href="#" class="dropdown-item"><?= number_format($row['kg'],2,',','.')?> Kg</a>
                            </div>
                          </div>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
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
  <?php $this->load->view('template/v_foot'); ?> 
  <?php $this->load->view('template/v_bottom'); ?> 