<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
</head>
<body>

    <script src="jquery-3.5.1.min.js"></script>
    <div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> METL
      <small>รายการกิจเฉพาะสำคัญยิ่งต่อภารกิจ</small>
    </h1>
  </section>
  <section class="content">
    <div class="col-xs-12">
        <!--
      <div class="text-right">
        <a class="btn btn-primary" href="<?php echo base_url(); ?>addNewInfo">
          <i class="fa fa-plus"></i> เพิ่มรายงานข่าวสาร</a>
      </div>
  -->
      <div class="box">
        <div class="box-header">
          <div class="box-tools">
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
            <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
            <?php } ?>
            <?php
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php } ?>
            <div class="panel-body">
              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables2">
                <thead>
                  <tr>
                    <th width="10%">ที่ของข่าว</th>
                    <th>หัวเรื่อง</th>
                    <!--<th>ข่าวสาร</th>-->
                    <th width="15%">วันที่รายงาน</th>
                    <th width="15%">ลำดับความสำคัญ</th>
                    <th width="10%">สถานะ</th>
                    <th width="10%">การดำเนินการ</th>
                  </tr>
                </thead>
                <tbody id="show_data">

                </tbody>

              </table>
            </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</section>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        show_info(); //call function show all product

        $('#dataTables').dataTable();

        //function show all product
        function show_info(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo site_url('checker')?>',
                async : true,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    var timeNow = Date.now();
                    for(i=0; i<data.length; i++){
                        var publishedTime= new Date(data[i].dateTimeToPublish);
                        if (publishedTime < timeNow) {
                        html += '<tr>'+
                                '<td>'+data[i].infoId+'</td>'+
                                '<td><a href="infoDetail/'+data[i].infoId+'">'+data[i].title+'</a></td>'+
                                //'<td>'+data[i].content+'</td>'+
                                '<td>'+data[i].dateTimeToPublish+'</td>'+
                                '<td class='+data[i].priorityClass+'>'+data[i].priority+'</td>'+
                                '<td class='+data[i].statusClass+'>'+data[i].status+'</td>'+
                                '<td style="text-align:right;">';
                                if (data[i].statusId < 3) {
                                    html +='<a href="operateInfo/'+data[i].infoId+'" class="btn btn-success btn-sm item_edit" data-infoId="'+data[i].infoId+'">แจ้งดำเนินการแล้ว</a>'
                                    //'<a href="editOldInfo/'+data[i].infoId+'" class="btn btn-info btn-sm item_edit" data-infoId="'+data[i].infoId+'" data-product_name="'+data[i].title+'" data-price="'+data[i].title+'">Edit</a>'+' '+
                                    //'<a href="deleteInfo/'+data[i].infoId+'" class="btn btn-danger btn-sm item_delete" data-infoId="'+data[i].infoId+'">Delete</a>'+
                                    ;
                                }
                        html +='</td>'+
                                '</tr>';
                                } // end if
                    }// end for
                    $('#show_data').html(html);
                    //var x = 'Update';
                    //alert(publishedTime);
                }

            });
        }
        //Every 20 sec check if there is new update
        setInterval(show_info,20000);
    });
        </script>
</body>
</html>
