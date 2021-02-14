<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
// Cloudinary
require 'assets/plugins/cloudinary/cloudinary_php/src/Cloudinary.php';
require 'assets/plugins/cloudinary/cloudinary_php/src/Uploader.php';
require 'assets/plugins/cloudinary/cloudinary_php/src/Api.php';
\Cloudinary::config(array(
    'cloud_name' => 'crma51',
    'api_key' => '486757946979428',
    'api_secret' => 'cT7-rRMQmkCINwzvaVdFIy_SaUU'
));
/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Samet Aydın / sametay153@gmail.com
 * @version : 1.0
 * @since : 27.02.2018
 */
class Info extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('info_model');
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $data['infoRecords'] = $this->info_model->getInfos();

        $this->global['pageTitle'] = 'InfoSim : ข่าวสารทั้งหมด';

        $this->loadViews("info/index", $this->global, $data, NULL);
    }

        /**
         * This function used to load the first screen of the user
         */
        public function allInfos()
        {
            $data['infoRecords'] = $this->info_model->getAllInfos();

            $this->global['pageTitle'] = 'InfoSim : ข่าวสารทั้งหมด';

            $this->loadViews("info/index", $this->global, $data, NULL);
        }

        /**
         * This function used to load the first screen of the user
         */
        public function infoDetail($infoId=NULL)
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

            $this->loadViews("info/infoDetail", $this->global, $data, NULL);
        }
    /**
     * This function used to load the first screen of the user
     */
    public function checker()
    {
        $data = $this->info_model->getInfosChecker();

        echo json_encode($data);
    }

    /**
    * This function is used to load the add new information
    */
    function addNewInfoForm()
    {
           $data['infos_prioritys'] = $this->info_model->getInfosPrioritys();

           $this->global['pageTitle'] = 'InfoSim : เพิ่มงาน';

           $this->loadViews("info/addNewInfoForm", $this->global, $data, NULL);
    }

    /**
    * This function is used to add new infos to the system
    */
    function addNewInfoToDB()
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
                           $folder = "infoSimOnline";
                           $file_publicid = $infoId.$i;
                           $tag = $title;
                            $imageUrl = $this->upload_image($files,$folder,$file_publicid,$tag);
                            echo $imageUrl."<br>";
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
                   $process = 'เพิ่มข่าวใหม่';
                   $processFunction = 'User/addNewInfos';
                   $this->logrecord($process,$processFunction);

                   $this->session->set_flashdata('success', 'เพิ่มข่าวสารสำเร็จแล้ว');
               }
               else
               {
                   $this->session->set_flashdata('error', 'การเพิ่มข่าวสารล้มเหลว');
               }

               redirect('addNewInfo');
           }
       }


       function upload_image($files,$folder,$file_publicid,$tag=""){
               $files = $files["single_upload_image"]["tmp_name"];
               $target_file = basename($_FILES["single_upload_image"]["name"]);
               $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
               if(!empty($imageFileType)){
                 $option=array("folder" => $folder,"tags"=>$tag,"public_id" => $file_publicid);
                 $cloudUpload = \Cloudinary\Uploader::upload($files,$option);
                 $image_url ="$folder/$file_publicid.".$imageFileType;
               }else{
                 $image_url ="sample.jpg";
               }
               return $image_url;
       }

       /**
       * This function is used to add new infos to the system
       */
       function uploadFile()
       {
            $file = $this->input->post('file');
            if(isset($_FILES)){
                $count = count($_FILES['files']['name']);
                for($i=0;$i<$count;$i++){
                    if(!empty($_FILES['files']['name'][$i])){
                        $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                        $config['upload_path'] = 'uploads/';
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['max_size'] = '50000';
                        $config['file_name'] = $_FILES['files']['name'][$i];

                        $this->load->library('upload',$config);

                        if($this->upload->do_upload('file')){
                            $uploadData = $this->upload->data();
                            $filename = $uploadData['file_name'];

                            $data['totalFiles'][] = $filename;
                        }
                    }
                }
            }

          }
    /**
     * This function is used to finish tasks.
     */
    function readInfo($infoId)
    {
            $readInfo = array('statusId'=>2,'endDtm'=>date('Y-m-d H:i:s'));

            $result = $this->info_model->readInfo($infoId, $readInfo);

            if ($result > 0) {
                 $process = 'อ่านข่าวสารแล้ว';
                 $processFunction = 'Info/readInfo';
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
     * This function is used to open edit info view
     */
    function editOldInfo($infoId = NULL)
    {
            if($infoId == null)
            {
                redirect('einfo');
            }

            $data['infoDetail'] = $this->info_model->getInfos($infoId);
            $data['infosPrioritys'] = $this->info_model->getInfosPrioritys();
            $data['infosStatus'] = $this->info_model->getInfosStatus();

            $this->global['pageTitle'] = 'InfoSim : แก้ไขข่าวสาร';

            $this->loadViews("info/editOldInfo", $this->global, $data, NULL);
    }
    /**
     * This function is used to open delete info view
     */
    function deleteInfo($infoId = NULL)
    {
            if($infoId == null)
            {
                redirect('einfo');
            }

            $infoDetail = array('statusId'=>0);
            $data['result'] = $this->info_model->deleteInfo($infoId,$infoDetail);

            $this->global['pageTitle'] = 'InfoSim : ลบข่าวสาร';

                redirect('einfo');
    }
    /**
     * This function is used to open edit info view
     */
    function hardDeleteInfo($infoId = NULL)
    {
            if($infoId == null)
            {
                redirect('einfo');
            }

            $data['result'] = $this->info_model->hardDeleteInfo($infoId);

            $this->global['pageTitle'] = 'InfoSim : ลบข่าวสาร';

                redirect('einfo');
    }
}

?>
