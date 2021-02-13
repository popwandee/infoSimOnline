<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
</head>
<body>
    <?php

$infoId = '';
$title = '';
$content = '';
//$priorityId = '';
//$statusId = '';


if(!empty($infoDetail))
{
    foreach ($infoDetail as $uf)
    {
        $infoId = $uf->infoId;
        $title = $uf->title;
        $content = $uf->content;
        //$priorityId = $uf->priorityId;
        //$statusId = $uf->statusId;
    }
}


?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <i class="fa fa-users"></i> การจัดการข่าวสาร
                <small>เพิ่ม / แก้ไขข่าวสาร</small>
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">ป้อนข้อมูลงาน</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="editOldInfo" action="<?php echo base_url() ?>editInfo" method="post" role="form">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">ชื่องาน</label>
                                            <input type="hidden" name="taskId" id="infoId" value="<?php echo $infoId; ?>">
                                            <input type="text" class="form-control required" value="<?php echo $title; ?>" id="title" name="title">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="role">ลำดับความสำคัญ</label>
                                            <select class="form-control required" id="priority" name="priority">
                                                <option value="0">เลือกลำดับความสำคัญ</option>
                                                <?php
                                                /*
                                            if(!empty($tasks_prioritys))
                                            {
                                                foreach ($tasks_prioritys as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->priorityId ?>" <?php if($rl->priorityId == $priorityId) {echo "selected=selected";} ?>>
                                                        <?php echo $rl->priority ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            */
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="comment">Detail content</label>
                                            <textarea class="form-control" id="content" name="content" rows="4"><?php echo $content; ?></textarea>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="status">สถานะ</label>
                                                    <select class="form-control required" id="status" name="status">
                                                        <option value="0">เลือกสถานะ</option>
                                                        <?php
                                                        /*
                                            if(!empty($tasks_situations))
                                            {
                                                foreach ($tasks_situations as $rl)
                                                {
                                                    ?>
                                                            <option value="<?php echo $rl->statusId ?>" <?php if($rl->statusId == $statusId) {echo "selected=selected";} ?>>
                                                                <?php echo $rl->status ?>
                                                            </option>
                                                            <?php
                                                }
                                            }
                                            */
                                            ?>
                                                    </select>
                                                </div>


                                            </div>
                                            <!-- /.box-body -->

                                            <div class="box-footer">
                                                <input type="submit" class="btn btn-primary" value="ส่ง" />
                                                <input type="reset" class="btn btn-default" value="รีเซ็ต" />
                                            </div>
                                        </div>
                                    </div>
                        </form>
                        </div>
                        </div>
                        <div class="col-md-4">
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

                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                                    </div>
                                </div>
                        </div>
                    </div>
        </section>

        </div>
    </body>
    </html>
