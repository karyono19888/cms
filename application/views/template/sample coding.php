no = 1;
html = '';
var data=JSON.parse(response);
for (i = 0; i < data.rows.length; i++) {
  html += '<tr>'+
            '<td class="text-center">'+[no++]+'</td>'+
            '<td>'+data.rows[i].t_mrc_head_doc_no+'_'+data.rows[i].t_mrc_head_date+'</td>'+
            '<td>'+data.rows[i].m_item_name+'</td>'+
            '<td>'+data.rows[i].m_item_code+'</td>'+
            '<td class="text-center">'+data.rows[i].t_mrc_line_no_line+'</td>'+
            '<td class="text-center">'+data.rows[i].t_mrc_line_qty+'</td>'+
          '</tr>'
}
$('#tampil').html(html);

$this->db->join(self::$table1, 't_mrc_line_head=t_mrc_head_id', 'left');
$this->db->join(self::$table4, 't_mrc_line_item=m_item_id', 'left');
$this->db->where('t_mrc_line_head', $t_mrc_line_head);
$query  = $this->db->get(self::$table2);

$data = array();
foreach ( $query->result() as $row ){
    array_push($data, $row); 
}

$result = array();
$result['rows']  = $data;

return json_encode($result);


<thead>
  <tr>    
      <th class="text-center">No</th>
      <th class="text-center">Receipt</th>
      <th class="text-center">Item</th>
      <th class="text-center">Barcode</th>
      <th class="text-center">Line No</th>
      <th class="text-center">Qty</th>
  </tr>
</thead>
<tbody>
<?php 
      $no2=1;
      foreach ($line->result() as $row2 ){ 
  ?>
  <tr id="baris2" data-id="<?=$row2['t_mrc_line_id'] ?>">    
      <td class="text-center" width="50"><?=$no2++ ?></td>
      <td><?=$row2['t_mrc_head_doc_no'] ?>_<?=$row2['t_mrc_head_date'] ?></td>
      <td><?=$row2['m_item_name'] ?></td>
      <td><?=$row2['m_item_code'] ?></td>
      <td><?=$row2['t_mrc_line_no_line'] ?></td>
      <td><?=$row2['t_mrc_line_qty'] ?></td>
  </tr>
  <?php };?>
</tbody>


"columns": [
      { "data": "no" },
      { "data": "receipt" },    
      { "data": "item" }, 
      { "data": "barcode" }, 
      { "data": "line" }, 
      { "data": "t_mrc_line_qty" }, 
  ],


  $("#tableLine").DataTable({
  "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": true,
  "buttons": ["csv", "excel", "pdf", "print"],
  "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
  language: {
  paginate: {
    next: '<i class="fas fa-arrow-circle-right"></i>',
    previous: '<i class="fas fa-arrow-circle-left"></i>'
  }
  },
});

var id = document.getElementById("t_mrc_line_head").value;
  $('#tableLine').DataTable({
    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
    "order": [], //Initial no order.
    "ajax":
    {
      "url": "<?=site_url('transaksi/MaterialReceipt/view_line')?>", // URL file untuk proses select datanya
      "type": "POST",
      "data": function ( data ) {
        data.id = id;
        // d.custom = $('#myInput').val();
        // etc
      }
    },
    "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
    "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": true,
    
    //Set column definition initialisation properties.
    "columnDefs": [
      { 
        "targets": [ 0 ], //first column / numbering column
        //"orderable": false, //set not orderable
      },
      ],
  });


  $no = 0;
  $this->db->join(self::$table1, 't_mrc_line_head=t_mrc_head_id', 'left');
  $this->db->join(self::$table4, 't_mrc_line_item=m_item_id', 'left');
  $this->db->where('t_mrc_line_head', $t_mrc_line_head);
  $query  = $this->db->get(self::$table2);

  $data = array();
  foreach ( $query->result() as $item ){
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $item->t_mrc_head_doc_no.'_'.$item->t_mrc_head_date;
      $row[] = $item->m_item_name;
      $row[] = $item->m_item_code;
      $row[] = $item->t_mrc_line_no_line;
      $row[] = $item->t_mrc_line_qty;

      $data[] = $row;
  }

  //$result = array();
  //$result['data']  = $data;
  
  //return json_encode($result); 
  $output = array(
      "draw" => $_POST['draw'],
      //"recordsTotal" => $query->count_all_results(),
      "recordsFiltered" => $query->num_rows(),
      "data" => $data,
      );
  //output to json format
  return json_encode($output); 

  $("#tableLine").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": true, "select": true, "info": false,
    "buttons": ["csv", "excel", "pdf", "print"],
    "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
    language: {
      paginate: {
        next: '<i class="fas fa-arrow-circle-right"></i>',
        previous: '<i class="fas fa-arrow-circle-left"></i>'
      }
    },
  });