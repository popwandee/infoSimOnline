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
            <i class="fa fa-users"></i> อัปโหลดบันทึกการสำรองข้อมูล
            <small>กระบวนการอัปโหลดบันทึกการสำรองข้อมูล</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">เลือกไฟล์ sql หรือ gz.sql ของคุณสำหรับการติดตั้งสำรอง</h3>
                        <div class="box-tools">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <div class="panel-body">
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
                                <form role="form" action="<?php echo base_url() ?>logHistoryUploadFile" method="post" id="LoghistoryUpload" role="form" enctype="multipart/form-data"
                                    accept-charset="utf-8">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="role">บันทึกตาราง</label>
                                                    <select class="form-control" id="optionfilebackup" name="optionfilebackup">
                                                        <option value="0">เลือกจอง</option>
                                                        <?php
                                            if(!empty($backups))
                                            {
                                                    foreach ($backups as $k => $v)
                                                    {
                                                    if (!is_array($v))
                                                    {
                                                    ?>
                                                            <option value="<?php echo $v ?>">
                                                                <?php echo $v ?>
                                                            </option>
                                                            <?php
                                                }
                                            }
                                            }
                                            ?>
                                                    </select>
                                                    <div class="form-group">
                                                        <label for="filebackup">เลือกไฟล์</label>
                                                        <input type="file" id="filebackup" name="filebackup">
                                                        <p class="help-block">สำหรับการอัปโหลดสำรองคุณต้องเลือกการสำรองข้อมูลจากเซิร์ฟเวอร์หรือเลือกไฟล์.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" class="btn btn-primary" value="โหลด" />
                                        <input type="reset" class="btn btn-default" value="รีเซ็ต" />
                                    </div>
                                </form>

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
