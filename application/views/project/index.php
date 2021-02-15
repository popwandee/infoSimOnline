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
      <i class="fa fa-users"></i> Project InfoSim
      <small>ระบบจำลองสถานการณ์เพื่อการฝึกเจ้าหน้าที่ดำเนินกรรมวิธีข่าวกรอง</small>
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
              วัตถุประสงค์โครงการ
              การดำเนินการ
              ขั้นตอนการใช้งาน
              การกำหนดสถานการณ์หลักคืออะไร
              การประเมินผล
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
