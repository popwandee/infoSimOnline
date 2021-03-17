<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <!-- Bootstrap 3.3.4 -->
  <link href="<?php echo base_url(); ?>assetse/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- FontAwesome 4.3.0 -->
  <link href="<?php echo base_url(); ?>assetse/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
  <script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

</head>
<body>

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> การจัดการข่าวสาร
            <small>เพิ่ม / แก้ไข รายการกิจเฉพาะสำคัญยิ่งต่อภารกิจ</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">



                    <div class="box-header">
                        <h3 class="box-title">รายการกิจเฉพาะสำคัญยิ่งต่อภารกิจ</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addNewInfo" action="<?php echo base_url() ?>addNewInfos" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="infoId">ที่ของข่าว</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('infoId'); ?>" id="infoId" name="infoId">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">หัวเรื่อง</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('title'); ?>" id="title" name="title" placeholder="หัวเรื่อง">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="role">ลำดับความสำคัญ</label>
                                        <select class="form-control required" id="priorityId" name="priorityId">
                                            <option value="0">เลือกลำดับความสำคัญ</option>
                                            <?php
                                            if(!empty($infos_prioritys))
                                            {
                                                foreach ($infos_prioritys as $rl)
                                                {
                                                    ?>
                                                <option value="<?php echo $rl->priorityId ?>" <?php if($rl->priorityId == set_value('priority')) {echo "selected=selected";} ?>>
                                                    <?php echo $rl->priority ?>
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
                                        <label for="content">เนื้อหาข่าวสาร</label>
                                        <textarea class="form-control" id="content" name="content" rows="4"><?php echo set_value('content'); ?></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dateTimeToPublish">วันเวลาที่ให้แสดงผล</label>
                                        <div class="input-group" id="dateTimeToPublish" data-date-format="yy-mm-dd hh:ii:ss">
                                            <input type="text" name="dateTimeToPublish" class="form-control">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                </div>
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="uploadImage">รูปภาพ</label>
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

                            <!-- /.box-body -->

                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary" value="ส่ง" />
                                <input type="reset" class="btn btn-default" value="รีเซ็ต" />
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

        <script  type="text/javascript">
          $(function(){
              $('#dateTimeToPublish').datetimepicker();
          });

          $(document).ready(function () {
           $('input[type=file]').change(function () {
             $('#btnUpload').show();
             $('#divFiles').html('');
             for (var i = 0; i < this.files.length; i++) { //Progress bar and status label's for each file genarate dynamically
                  var fileId = i;
                  $("#divFiles").append('<div class="col-md-12">' +
                          '<div class="progress-bar progress-bar-striped active" id="progressbar_' + fileId + '" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:0%"></div>' +
                          '</div>' +
                          '<div class="col-md-12">' +
                               '<div class="col-md-6">' +
                                  '<input type="button" class="btn btn-danger" style="display:none;line-height:6px;height:25px" id="cancel_' + fileId + '" value="cancel">' +
                               '</div>' +
                               '<div class="col-md-6">' +
                                  '<p class="progress-status" style="text-align: right;margin-right:-15px;font-weight:bold;color:saddlebrown" id="status_' + fileId + '"></p>' +
                               '</div>' +
                          '</div>' +
                          '<div class="col-md-12">' +
                               '<p id="notify_' + fileId + '" style="text-align: right;"></p>' +
                          '</div>');
                        }
                    })
                });

                function uploadFiles() {
                   var file = document.getElementById("uploadImageFile")//All files
                   for (var i = 0; i < file.files.length; i++) {
                          uploadSingleFile(file.files[i], i);
                   }
                }

                function uploadSingleFile(file, i) {
                    var fileId = i;
                    var ajax = new XMLHttpRequest();
                    //Progress Listener
                    ajax.upload.addEventListener("progress", function (e) {
                        var percent = (e.loaded / e.total) * 100;
                        $("#status_" + fileId).text(Math.round(percent) + "% uploaded, please wait...");
                        $('#progressbar_' + fileId).css("width", percent + "%")
                        $("#notify_" + fileId).text("Uploaded " + (e.loaded / 1048576).toFixed(2) + " MB of " + (e.total / 1048576).toFixed(2) + " MB ");
                    }, false);
                    //Load Listener
                    ajax.addEventListener("load", function (e) {
                        $("#status_" + fileId).text(event.target.responseText);
                        $('#progressbar_' + fileId).css("width", "100%")

                        //Hide cancel button
                        var _cancel = $('#cancel_' + fileId);
                        _cancel.hide();
                    }, false);
                    //Error Listener
                    ajax.addEventListener("error", function (e) {
                        $("#status_" + fileId).text("Upload Failed");
                    }, false);
                    //Abort Listener
                    ajax.addEventListener("abort", function (e) {
                        $("#status_" + fileId).text("Upload Aborted");
                    }, false);

                    ajax.open("POST", "uploadFile"); // Your API .net, php

                    var uploaderForm = new FormData(); // Create new FormData
                    uploaderForm.append("file", file); // append the next file for upload
                    ajax.send(uploaderForm);

                    //Cancel button
                    var _cancel = $('#cancel_' + fileId);
                    _cancel.show();

                    _cancel.on('click', function () {
                        ajax.abort();
                    })
                }
        </script>

    </div>

</body>
</html>
