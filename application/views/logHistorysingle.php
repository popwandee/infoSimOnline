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
            <i class="fa fa-users"></i> บันทึกประวัติ
            <small>บันทึกประวัติของผู้ใช้</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <?= $userInfo->name." : ".$userInfo->email ?>
                        </h3>
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
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>ชื่อผู้ใช้</th>
                                            <th>การดำเนินการ</th>
                                            <th>ฟังก์ชันการทำงาน</th>
                                            <th>Roled ID ผู้ใช้ </th>
                                            <th>Roled ผู้ใช้ </th>
                                            <th>IP ผู้ใช้ </th>
                                            <th>สแกนเนอร์</th>
                                            <th>์ข้อมูลเบราว์เซอรทั้งหมด</th>
                                            <th>Platform</th>
                                            <th>วันและเวลา</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                      if(!empty($userRecords))
                      {
                          foreach($userRecords as $record)
                          {
                      ?>
                                            <tr>
                                                <td>
                                                    <?php echo $record->id ?>
                                                </td>
                                                <td>
                                                    <?php echo $record->userName ?>
                                                </td>
                                                <td>
                                                    <?php echo $record->process ?>
                                                </td>
                                                <td>
                                                    <?php echo $record->processFunction ?>
                                                </td>
                                                <td>
                                                    <?php echo $record->userRoleId ?>
                                                </td>
                                                <td>
                                                    <?php echo $record->userRoleText ?>
                                                </td>
                                                <td>
                                                    <?php echo $record->userIp ?>
                                                </td>
                                                <td>
                                                    <?php echo $record->userAgent ?>
                                                </td>
                                                <td>
                                                    <?php echo $record->agentString ?>
                                                </td>
                                                <td>
                                                    <?php echo $record->platform ?>
                                                </td>
                                                <td>
                                                    <?php echo $record->createdDtm ?>
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
        </div>
    </section>
</div>
</body>
</html>
