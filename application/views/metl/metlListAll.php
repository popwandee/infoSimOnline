<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
</head>
<body>

    <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> ข่าวสารทั้งหมด
      <small>ข่าวสารทั้งหมดในแผงควบคุมของเรา</small>
    </h1>
  </section>
  <section class="content">
    <div class="col-xs-12">
      <div class="text-right">
        <a class="btn btn-primary" href="<?php echo base_url(); ?>addNewInfo">
          <i class="fa fa-plus"></i> เพิ่มรายงานข่าวสาร</a>
      </div>
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
              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>หัวเรื่อง</th>
                    <th>ข่าวสาร</th>
                    <th>เงื่อนไข</th>
                    <th>ลำดับความสำคัญ</th>
                    <th>วันที่สร้าง</th>
                    <th>วันและเวลาจะให้แสดงผล</th>
                    <th>การดำเนินการ</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        if(!empty($infoRecords))
                        {
                            foreach($infoRecords as $record)
                            {
                        ?>
                      <tr>
                        <td>
                          <?php echo $record->infoId ?>
                        </td>
                        <td>
                          <?php echo $record->title ?>
                        </td>
                        <td>
                          <?php echo $record->content ?>
                        </td>
                        <td>
                          <div class="label label-<?php
                          if ($record->statusId == '1')
                          {
                          $status='รอดำเนินการ';echo 'danger';}
                          else if ($record->statusId == '2')
                          {
                          $status='ดำเนินการแล้ว';echo 'success';}
                          ?>">
                          <?php echo $status; ?>
                          </div>
                        </td>

                        <td>
                          <div class="label label-<?php
                          if ($record->priorityId == '1'){
                          $priorityId='สำคัญมาก';echo 'danger';}
                          else if ($record->priorityId == '2')
                          {
                          $priorityId='สำคัญ';echo 'warning';}
                          else if ($record->priorityId == '3')
                          {
                          $priorityId='ปกติ';echo 'info';}
                          ?>">
                          <?php echo $priorityId;?>
                          </div>
                        </td>
                        <td>
                          <?php echo $record->createdDtm; ?>
                        </td>
                        <td>
                          <?php
                          //echo $record->dateTimeToPublish;
                          $now = date("Y-m-d H:i:s");
                          $now   = new DateTime(date("Y-m-d H:i:s"));
                          $dateTimeToPublish = new DateTime($record->dateTimeToPublish);
                          $dteDiff  = $now->diff($dateTimeToPublish);
                          $timeTo = $dteDiff->format("%H:%I:%S");
                          if($dateTimeToPublish>$now){
                              $textToShow = "จะแสดงใน ".$timeTo." ชั่วโมง";
                          }else{
                              $textToShow = "แสดงผลมาแล้ว ".$timeTo." ชั่วโมง";
                          }
                          echo $textToShow; ?>
                        </td>
                        <td class="text-center">
                          <a class="btn btn-sm btn-info" href="<?php echo base_url().'editOldInfo/'.$record->infoId; ?>" title="แก้ไข">
                            <i class="fa fa-pencil"></i>
                          </a>
                          <a class="btn btn-sm btn-danger deleteUser" href="<?php echo base_url().'deleteInfo/'.$record->infoId; ?>" data-userid="<?php echo $record->infoId; ?>"
                            title="ลบ">
                            <i class="fa fa-trash"></i>
                          </a>
                        </td>

                      </tr>
                      <?php
                            }
                        }
                        ?>
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
</body>
</html>
