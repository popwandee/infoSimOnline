<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
</head>
<body>
    <?php
    if(!empty($infoDetail))
    {
            $infoId = $infoDetail->infoId;
            $title = $infoDetail->title;
            $content = $infoDetail->content;
            $priorityId = $infoDetail->priorityId;
            $statusId = $infoDetail->statusId;
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
                            <h3 class="box-title">ป้อนข้อมูลข่าวสาร</h3>
                        </div>
                        <!-- /.box-header -->
                            <!-- form start -->
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="editOldInfo" action="<?php echo base_url() ?>mEditInfo" method="post" role="form">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">ชื่อเรื่อง</label>
                                                <input type="hidden" name="taskId" id="infoId" value="<?php echo $infoId; ?>">
                                                <input type="text" class="form-control required" value="<?php echo $title; ?>" id="title" name="title">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="role">ลำดับความสำคัญ</label>
                                                <select class="form-control required" id="priority" name="priority">
                                                    <?php
                                                if(!empty($infosPrioritys))
                                                {
                                                    foreach ($infosPrioritys as $infosPriority)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $infosPriority->priorityId ?>" <?php if($infosPriority->priorityId == $priorityId) {echo "selected=selected";} ?>>
                                                            <?php echo $infosPriority->priority ?>
                                                        </option>
                                                        <?php
                                                    }
                                                }

                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="comment">เนื้อหาข่าวสาร</label>
                                                <textarea class="form-control" id="content" name="content" rows="4"><?php echo $content; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="status">สถานะ</label>
                                                <select class="form-control required" id="status" name="status">
                                                    <?php
                                                if(!empty($infosStatus))
                                                {
                                                    foreach ($infosStatus as $infoStatus)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $infoStatus->statusId ?>" <?php if($infoStatus->statusId == $statusId) {echo "selected=selected";} ?>>
                                                            <?php echo $infoStatus->status ?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="uploadImage">เพิ่มรูปภาพ</label>
                                                <div class="input-group" id="uploadImage">
                                                    <input type="file" class="form-control" id="uploadImageFile" name="files[]" multiple/>
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-file"></span>
                                                    </span>
                                                </div>
                                                <div class="input-group" id="uploadImage">
                                                    <input type="file" class="form-control" id="uploadImageFile" name="files[]" multiple/>
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-file"></span>
                                                    </span>
                                                </div>
                                                <div class="input-group" id="uploadImage">
                                                    <input type="file" class="form-control" id="uploadImageFile" name="files[]" multiple/>
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-file"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
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
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php
                    if(!empty($images))
                    {
                        foreach ($images as $image){
                            echo '<img src='.base_url().'uploads/'.$image->url.' width="300"><br>';
                        }
                    }?>

                </div>
            </div>
        </div>
        </section>

        </div>
    </body>
    </html>
