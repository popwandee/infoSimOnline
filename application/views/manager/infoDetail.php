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
                <i class="fa fa-users"></i> ข่าวสาร
                <small>อ่านข่าวสาร</small>
            </h1>
        </section>
        <section class="content">
            <div class="row">
            <?php

            if(!empty($infoDetail))
            {
                foreach($infoDetail as $detail){
                    $infoId = $detail->infoId;
                    $title = $detail->title;
                    $content = $detail->content;
                    $createdDtm = $detail->createdDtm;
                    $createdBy = $detail->name;
                    $priority = $detail->priority;
                    $priorityId = $detail->priorityId;
                    $status = $detail->status;
                    $statusId = $detail->statusId;
                }
            }

            ?>
                <!-- left column -->
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">รายละเอียดข่าวสาร</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="editOldInfo" action="<?php echo base_url() ?>mEditInfo" method="post" role="form">
                            <div class="box-body">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">ที่ของข่าว</label>
                                            <input type="text" class="form-control" name="infoId" value="<?php echo $infoId  ?>" readonly>
                                        </div>
                                    </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="role">ลำดับความสำคัญ</label>
                                        <input type="text" class="form-control" name="priority" value="<?php echo $priority ?>" readonly>
                                    </div>
                                </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status">สถานะ</label>
                                                <input type="text" class="form-control" id="status" name="status" value="<?php echo $status  ?>" readonly>
                                                <?php
                                                    if($statusId<3){?>
                                                        <a href="<?php echo base_url().'mOperateInfo/'.$infoId;?>"><input type="button" class="btn btn-primary" name="doneButton" id="doneButton" value="แจ้งดำเนินการแล้ว"></a>
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fname">เรื่อง</label>
                                            <input type="text" class="form-control required" value="<?php echo $title; ?>" id="title" name="title" readonly>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="comment">เนื้อหา</label>
                                            <textarea class="form-control" id="content" name="content" rows="4" readonly><?php echo $content; ?></textarea>
                                        </div>
                                    </div>
                        </form>
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
    <script type="text/javascript">
        $("doneButton").click(function(){
            alert("OK");
          $.ajax({url: "mOperateInfo/<?php echo $infoId; ?>",
                success: function(result){
                $("#status").html(result);
          }});
        });
    </script>
    </body>
    </html>
