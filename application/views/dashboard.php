<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      การจัดการ
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>
              <?php if(isset($tasksCount)) { echo $tasksCount; } else { echo '0'; } ?>
            </h3>
            <p>งาน</p>
          </div>
          <div class="icon">
            <i class="fa fa-tasks"></i>
          </div>
          <a href="<?php echo base_url(); ?><?php  if($role != ROLE_EMPLOYEE) {echo 'tasks';}else{echo 'etasks';} ?>" class="small-box-footer">ดูทั้งหมด
            <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>
              <?php if(isset($finishedTasksCount)) { echo $finishedTasksCount; } else { echo '0'; } ?>
            </h3>
            <p>เสร็จสิ้นงาน</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="<?php echo base_url(); ?><?php  if($role != ROLE_EMPLOYEE) {echo 'tasks';}else{echo 'etasks';} ?>" class="small-box-footer">ข้อมูลมากกว่านี้
            <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>
              <?php if(isset($usersCount)) { echo $usersCount; } else { echo '0'; } ?>
            </h3>
            <p>ผู้ใช้</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
          <a href="<?php echo base_url(); ?>userListing" class="small-box-footer">ข้อมูลมากกว่านี้
            <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>
              <?php if(isset($logsCount)) { echo $logsCount; } else { echo '0'; } ?>
            </h3>
            <p>Log</p>
          </div>
          <div class="icon">
            <i class="fa fa-archive"></i>
          </div>
          <a href="<?php echo base_url(); ?>log-history" class="small-box-footer">ข้อมูลมากกว่านี้
            <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
    </div>
  </section>

  <div class="container">

          <dl class="row">
          <dt class="col-sm-3">ชื่อโปรแกรม</dt>
          <dd class="col-sm-9">ระบบจำลองสถานการณ์ข่าวกรอง เพื่อการฝึกเจ้าหน้าที่ดำเนินกรรมวิธีข่าวกรอง</dd>

          <dt class="col-sm-3">การบริหารจัดการงาน</dt>
          <dd class="col-sm-9">
          <p>การสร้างงานใหม่</p>
          <p>การแก้ไขงาน</p>
          <p>การลบงาน</p>
          <p>การปรับแก้ไขสถานะงาน</p>
          </dd>

          <dt class="col-sm-3">Malesuada porta</dt>
          <dd class="col-sm-9">Etiam porta sem malesuada magna mollis euismod.</dd>

          <dt class="col-sm-3 text-truncate">Truncated term is truncated</dt>
          <dd class="col-sm-9">Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</dd>

          <dt class="col-sm-3">Nesting</dt>
          <dd class="col-sm-9">
          <dl class="row">
            <dt class="col-sm-4">Nested definition list</dt>
            <dd class="col-sm-8">Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc.</dd>
          </dl>
          </dd>
          </dl>

  </div>





</div>
