<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
/**
 * Class : Manager (ManagerController)
 * Manager class to control to authenticate manager credentials and include manager functions.
 * @author : Samet Aydın / sametay153@gmail.com
 * @version : 1.0
 * @since : 27.02.2018
 */
class Manager extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('info_model');
        // Datas -> libraries ->BaseController / This function used load user sessions
        $this->datas();
        // isLoggedIn / Login control function /  This function used login control
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            redirect('login');
        }
        else
        {
            // isManagerOrAdmin / Admin or manager role control function / This function used admin or manager role control
            if($this->isManagerOrAdmin() == TRUE)
            {
                $this->accesslogincontrol();
            }
        }
    }

     /**
     * This function used to show tasks
     */
    function tasks()
    {
            $data['taskRecords'] = $this->user_model->getTasks();

            $this->global['pageTitle'] = 'InfoSim : หขส./ตขอ. ทั้งหมด';

            $this->loadViews("tasks", $this->global, $data, NULL);
    }

    /**
     * This function is used to load the add new task
     */
    function addNewTask()
    {
            $data['tasks_prioritys'] = $this->user_model->getTasksPrioritys();

            $this->global['pageTitle'] = 'InfoSim : เพิ่ม หขส./ตขอ.';

            $this->loadViews("addNewTask", $this->global, $data, NULL);
    }

     /**
     * This function is used to add new task to the system
     */
    function addNewTasks()
    {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('fname','ชื่อ หขส./ตขอ.','required');
            $this->form_validation->set_rules('priority','ลำดับความสำคัญ','required');

            if($this->form_validation->run() == FALSE)
            {
                $this->addNewTask();
            }
            else
            {
                $title = $this->input->post('fname');
                $comment = $this->input->post('comment');
                $priorityId = $this->input->post('priority');
                $statusId = 1;
                $permalink = sef($title);

                $taskInfo = array('title'=>$title, 'comment'=>$comment, 'priorityId'=>$priorityId, 'statusId'=> $statusId,
                                    'permalink'=>$permalink, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));

                $result = $this->user_model->addNewTasks($taskInfo);

                if($result > 0)
                {
                    $process = 'เพิ่ม หขส./ตขอ. ใหม่ title => '.$title;
                    $processFunction = 'Manager/addNewTasks';
                    $this->logrecord($process,$processFunction);

                    $this->session->set_flashdata('success', 'สร้าง หขส./ตขอ. สำเร็จแล้ว');
                }
                else
                {
                    $this->session->set_flashdata('error', 'การสร้าง หขส./ตขอ. ล้มเหลว');
                }

                redirect('ddNewTask');
            }
        }

    /**
     * This function is used to open edit tasks view
     */
    function editOldTask($taskId = NULL)
    {
            if($taskId == null)
            {
                redirect('tasks');
            }

            $data['taskInfo'] = $this->user_model->getTaskInfo($taskId);
            $data['tasks_prioritys'] = $this->user_model->getTasksPrioritys();
            $data['tasks_situations'] = $this->user_model->getTasksSituations();

            $this->global['pageTitle'] = 'InfoSim : แก้ไข หขส./ตขอ.';

            $this->loadViews("editOldTask", $this->global, $data, NULL);
    }

    /**
     * This function is used to edit tasks
     */
    function editTask()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('fname','ชื่อเรื่อง หขส./ตขอ.','required');
        $this->form_validation->set_rules('priority','ลำดับความสำคัญ','required');

        $taskId = $this->input->post('taskId');

        if($this->form_validation->run() == FALSE)
        {
            $this->editOldTask($taskId);
        }
        else
        {
            $taskId = $this->input->post('taskId');
            $title = $this->input->post('fname');
            $comment = $this->input->post('comment');
            $priorityId = $this->input->post('priority');
            $statusId = $this->input->post('status');
            $permalink = sef($title);

            $taskInfo = array('title'=>$title, 'comment'=>$comment, 'priorityId'=>$priorityId, 'statusId'=> $statusId,
                                'permalink'=>$permalink);

            $result = $this->user_model->editTask($taskInfo,$taskId);

            if($result > 0)
            {
                $process = 'แก้ไข หขส./ตขอ. id =>'.$taskId;
                $processFunction = 'Manager/editTask';
                $this->logrecord($process,$processFunction);
                $this->session->set_flashdata('success', 'แก้ไข หขส./ตขอ. สำเร็จ');
            }
            else
            {
                $this->session->set_flashdata('error', 'การแก้ไข หขส./ตขอ. ล้มเหลว');
            }
            redirect('tasks');

            }
    }

    /**
     * This function is used to delete tasks
     */
    function deleteTask($taskId = NULL)
    {
        if($taskId == null)
            {
                redirect('tasks');
            }

            $result = $this->user_model->deleteTask($taskId);

            if ($result == TRUE) {
                 $process = 'การลบ หขส./ตขอ. => '.$taskId;
                 $processFunction = 'Manager/deleteTask';
                 $this->logrecord($process,$processFunction);

                 $this->session->set_flashdata('success', 'ลบ หขส./ตขอ. สำเร็จ');
                }
            else
            {
                $this->session->set_flashdata('error', 'การลบ หขส./ตขอ. ล้มเหลว');
            }
            redirect('tasks');
    }

    /**
     * This function used to load the first screen of the user
     */
    public function manageInfo()
    {
        $data['infoRecords'] = $this->info_model->getAllInfos();

        $this->global['pageTitle'] = 'InfoSim : ข่าวสารทั้งหมด';

        $this->loadViews("manager/infoListAll", $this->global, $data, NULL);
    }

    /**
     * This function used to load the first screen of the user
     */
    public function mInfoDetail($infoId=NULL)
    {
        if($infoId == null)
        {
            redirect('einfo');
        }

        $data['infoDetail'] = $this->info_model->getInfoDetail($infoId);
        $data['images'] = $this->info_model->getImage($infoId);
        $data['listInfosPrioritys'] = $this->info_model->getInfosPrioritys();
        $data['listInfosStatus'] = $this->info_model->getInfosStatus();

        $this->global['pageTitle'] = 'InfoSim : อ่านข่าว';

        $this->loadViews("manager/infoDetail", $this->global, $data, NULL);
    }
    /**
     * This function used to autoload and refresh screen information
     */
    public function mChecker()
    {
        $data = $this->info_model->getInfosChecker();

        echo json_encode($data);
    }

    /**
    * This function is used to load the add new information
    */
    function mAddNewInfoForm()
    {

           $data['infos_prioritys'] = $this->info_model->getInfosPrioritys();

           $this->global['pageTitle'] = 'InfoSim : เพิ่มข่าวสาร';

           $this->loadViews("manager/addNewInfoForm", $this->global, $data, NULL);

    }

    /**
    * This function is used to add new infos to the system
    */
    function mAddNewInfoToDB()
    {

           $this->load->library('form_validation');
           $this->form_validation->set_rules('infoId','ที่ของข่าว','required');
           $this->form_validation->set_rules('title','หัวเรื่องข่าว','required');
           $this->form_validation->set_rules('priorityId','ลำดับความสำคัญ','required');

           if($this->form_validation->run() == FALSE)
           {
               $this->addNewInfoForm();
           }
           else
           {
               $infoId = $this->input->post('infoId');
               $title = $this->input->post('title');
               $content = $this->input->post('content');
               $file = $this->input->post('file');

               if(isset($_FILES['files'])){
                   $count = count($_FILES['files']['name']);
                   for($i=0;$i<$count;$i++){
                       if(!empty($_FILES['files']['name'][$i])){
                           $file = $_FILES['files']['tmp_name'][$i];
                           $folder = "infoImage";
                           $file_publicid = $infoId.$i;
                           $tag = $title;
                           $target_file = basename($_FILES["files"]["name"][$i]);
                           $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                           if(!empty($imageFileType)){
                             $option=array("folder" => $folder,"tags"=>$tag,"public_id" => $file_publicid);
                             $cloudUpload = \Cloudinary\Uploader::upload($file,$option);
                             $imageUrl ="$folder/$file_publicid.".$imageFileType;
                           }else{
                             $imageUrl ="sample.jpg";
                           }
                            $process = 'Upload รูปภาพใหม่->'.$imageUrl;
                            $processFunction = 'manager/mAddNewInfoToDB';
                            $this->logrecord($process,$processFunction);
                        }
                    }
                }else{
                   echo "<br>Not set _FILES";
                }

               //$updatedDtm = $this->input->post('updatedDtm');
               //$updatedBy = $this->input->post('updatedBy');
               $createdDtm = date('Y-m-d H:i:s');
               $createdBy = $this->vendorId;
               $dateTimeToPublish = date_create($this->input->post('dateTimeToPublish'));
       		   $dateTimeToPublish = date_format($dateTimeToPublish,"Y-m-d H:i:s");
               $priorityId = $this->input->post('priorityId');
               $statusId = 1;
               $isDeleted = 0;

               $infoDetail = array('infoId'=>$infoId, 'title'=>$title, 'content'=>$content, 'priorityId'=>$priorityId, 'statusId'=> $statusId,
                                   'createdBy'=>$createdBy, 'createdDtm'=>$createdDtm ,
                                   'dateTimeToPublish'=>$dateTimeToPublish, 'isDeleted'=>$isDeleted);

               $result = $this->info_model->addNewInfo($infoDetail);
               if($result > 0)
               {
                   $process = 'เพิ่มข่าวสารใหม่ infoId=>'.$infoId;
                   $processFunction = 'Manager/mAddNewInfoToDB';
                   $this->logrecord($process,$processFunction);

                   $this->session->set_flashdata('success', 'เพิ่มข่าวสารสำเร็จแล้ว');
               }
               else
               {
                   $this->session->set_flashdata('error', 'การเพิ่มข่าวสารล้มเหลว');
               }

               redirect('mAddNewInfo');
           }

       }
       /**
        * This function is used to finish tasks.
        */
       function mReadInfo($infoId)
       {
               $readInfo = array('statusId'=>2,'endDtm'=>date('Y-m-d H:i:s'));

               $result = $this->info_model->readInfo($infoId, $readInfo);

               if ($result > 0) {
                    $process = 'อ่านข่าวสารแล้ว';
                    $processFunction = 'Manager/mReadInfo';
                    $this->logrecord($process,$processFunction);
                    $this->session->set_flashdata('success', 'อ่านข่าวสารแล้ว');
                    if ($this->role != ROLE_EMPLOYEE){
                       redirect('einfo');
                    }
                    else{
                       redirect('einfo');
                    }
                   }
               else {
                   $this->session->set_flashdata('error', 'อ่านข่าวสารแล้วไม่สำเร็จ');
                   if ($this->role != ROLE_EMPLOYEE){
                       redirect('tasks');
                    }
                    else{
                       redirect('etasks');
                    }
               }
       }
       /**
        * This function is used to open delete info view
        */
       function operateInfo($infoId = NULL)
       {
               if($infoId == null)
               {
                   redirect('einfo');
               }

               $infoDetail = array('statusId'=>3);
               $data['result'] = $this->info_model->deleteInfo($infoId,$infoDetail);

               $this->global['pageTitle'] = 'InfoSim : ลบข่าวสาร';

                   redirect('einfo');
       }
       /**
        * This function is used to open edit info view
        */
       function mEditOldInfo($infoId = NULL)
       {
               if($infoId == null)
               {
                   redirect('einfo');
               }

               $data['infoDetail'] = $this->info_model->getInfos($infoId);
               $data['infosPrioritys'] = $this->info_model->getInfosPrioritys();
               $data['infosStatus'] = $this->info_model->getInfosStatus();

               $this->global['pageTitle'] = 'InfoSim : แก้ไขข่าวสาร';

               $this->loadViews("manager/mEditOldInfo", $this->global, $data, NULL);
       }
       /**
        * This function is used to open delete info view
        */
       function mDeleteInfo($infoId = NULL)
       {
               if($infoId == null)
               {
                   redirect('einfo');
               }

               $infoDetail = array('statusId'=>0);
               $data['result'] = $this->info_model->deleteInfo($infoId,$infoDetail);
               $process = 'ลบข่าวสาร id->'.$infoId;
               $processFunction = 'Manager/mDeleteInfo';
               $this->logrecord($process,$processFunction);

                   redirect('einfo');
       }
       /**
        * This function is used to open edit info view
        */
       function mHardDeleteInfo($infoId = NULL)
       {
               if($infoId == null)
               {
                   redirect('einfo');
               }

               $data['result'] = $this->info_model->hardDeleteInfo($infoId);
               $process = 'ลบข่าวสาร id->'.$infoId;
               $processFunction = 'Manager/hardDeleteInfo';
               $this->logrecord($process,$processFunction);
               $this->global['pageTitle'] = 'InfoSim : ลบข่าวสาร';

                   redirect('einfo');
       }
}
