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

            $process = 'งานทั้งหมด';
            $processFunction = 'Manager/tasks';
            $this->logrecord($process,$processFunction);

            $this->global['pageTitle'] = 'InfoSim : งานทั้งหมด';

            $this->loadViews("tasks", $this->global, $data, NULL);
    }

    /**
     * This function is used to load the add new task
     */
    function addNewTask()
    {
            $data['tasks_prioritys'] = $this->user_model->getTasksPrioritys();

            $this->global['pageTitle'] = 'InfoSim : เพิ่มงาน';

            $this->loadViews("addNewTask", $this->global, $data, NULL);
    }

     /**
     * This function is used to add new task to the system
     */
    function addNewTasks()
    {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('fname','ชื่องาน','required');
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
                    $process = 'เพิ่มงานใหม่';
                    $processFunction = 'Manager/addNewTasks';
                    $this->logrecord($process,$processFunction);

                    $this->session->set_flashdata('success', 'สร้างงานสำเร็จแล้ว');
                }
                else
                {
                    $this->session->set_flashdata('error', 'การสร้างงานล้มเหลว');
                }

                redirect('addNewTask');
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

            $this->global['pageTitle'] = 'InfoSim : แก้ไขงาน';

            $this->loadViews("editOldTask", $this->global, $data, NULL);
    }

    /**
     * This function is used to edit tasks
     */
    function editTask()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('fname','ชื่องาน','required');
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
                $process = 'แก้ไขงาน';
                $processFunction = 'Manager/editTask';
                $this->logrecord($process,$processFunction);
                $this->session->set_flashdata('success', 'แก้ไขงานสำเร็จ');
            }
            else
            {
                $this->session->set_flashdata('error', 'การแก้ไขงานล้มเหลว');
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
                 $process = 'การลบงาน';
                 $processFunction = 'Manager/deleteTask';
                 $this->logrecord($process,$processFunction);

                 $this->session->set_flashdata('success', 'ลบงานสำเร็จ');
                }
            else
            {
                $this->session->set_flashdata('error', 'การลบงานล้มเหลว');
            }
            redirect('tasks');
    }

    /**
     * This function used to load the first screen of the user
     */
    public function manageInfo()
    {
        $data['infoRecords'] = $this->info_model->getInfos();

        $this->global['pageTitle'] = 'InfoSim : ข่าวสารทั้งหมด';

        $this->loadViews("info/infoListAll", $this->global, $data, NULL);
    }

    /**
     * This function used to load all information
     */
    public function checker()
    {
        $data = $this->info_model->getInfos();

        echo json_encode($data);
    }
}
