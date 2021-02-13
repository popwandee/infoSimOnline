<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Info_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function infoListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.infoId, BaseTbl.title, BaseTbl.content, BaseTbl.image');
        $this->db->from('tbl_infos as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.title  LIKE '%".$searchText."%'
                            OR  BaseTbl.content  LIKE '%".$searchText."%'
                            OR  BaseTbl.image  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function infoListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.infoId, BaseTbl.title, BaseTbl.content, BaseTbl.image, Role.piorityId');
        $this->db->from('tbl_infos as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.title  LIKE '%".$searchText."%'
                            OR  BaseTbl.content  LIKE '%".$searchText."%'
                            OR  BaseTbl.image  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.$isDeleted', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

        /**
         * This function is used to get the user listing count
         * @param string $searchText : This is optional search text
         * @param number $page : This is pagination offset
         * @param number $segment : This is pagination limit
         * @return array $result : This is result
         */
        function getAllInfos()
        {
            $this->db->select('*');
            $this->db->from('tbl_infos');
            $this->db->join('tbl_infos_prioritys', 'tbl_infos_prioritys.priorityId = tbl_infos.priorityId');
            $this->db->join('tbl_infos_status', 'tbl_infos_status.statusId = tbl_infos.statusId');

            $this->db->order_by('dateTimeToPublish','DESC');

            $query = $this->db->get();

            $result = $query->result();
            return $result;
        }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getInfoDetail($infoId)
    {
        $this->db->select('BaseTbl.infoId, BaseTbl.title, BaseTbl.content, BaseTbl.createdDtm,
        tbl_users.name, tbl_infos_prioritys.priority,tbl_infos_prioritys.priorityId,
        tbl_infos_status.status,tbl_infos_status.statusId');
        $this->db->from('tbl_infos as BaseTbl');
        $this->db->join('tbl_infos_prioritys', 'tbl_infos_prioritys.priorityId = BaseTbl.priorityId');
        $this->db->join('tbl_infos_status', 'tbl_infos_status.statusId = BaseTbl.statusId');
        $this->db->join('tbl_users', 'tbl_users.userId = BaseTbl.createdBy');
        $this->db->where('BaseTbl.infoId', $infoId);
        $query = $this->db->get();

        return $query->result();
    }
    function getImage($infoId)
    {
        $this->db->select('BaseTbl.id,BaseTbl.infoId,BaseTbl.url,BaseTbl.tag');
        $this->db->from('tbl_image as BaseTbl');
        $this->db->join('tbl_infos', 'tbl_infos.infoId = BaseTbl.infoId');
        $this->db->where('BaseTbl.infoId', $infoId);
        $query = $this->db->get();

        return $query->result();
    }

        /**
         * This function used to get user information by id
         * @param number $userId : This is user id
         * @return array $result : This is user information
         */
        function getInfos()
        {
            $this->db->select('*');
            $this->db->from('tbl_infos');
            $this->db->where('isDeleted', 0);
            $this->db->where('tbl_infos.statusId',1);
            $query = $this->db->get();

            return $query->result();
        }

                /**
                 * This function used to get user information by id
                 * @param number $userId : This is user id
                 * @return array $result : This is user information
                 */
        function getInfosChecker()
        {
            $this->db->select('*');
            $this->db->from('tbl_infos');
            $this->db->join('tbl_infos_prioritys', 'tbl_infos_prioritys.priorityId = tbl_infos.priorityId');
            $this->db->join('tbl_infos_status', 'tbl_infos_status.statusId = tbl_infos.statusId');
            $this->db->where('tbl_infos.isDeleted', 0);
            $this->db->where('tbl_infos.statusId',1);
            $this->db->order_by('dateTimeToPublish','DESC');
            $query = $this->db->get();

            return $query->result();
        }

            /**
             * This function used to get user information by id
             * @param number $userId : This is user id
             * @return array $result : This is user information
             */
            function getInfoById($infoId)
            {
                $this->db->select('infoId, title, content, image, piorityId');
                $this->db->from('tbl_infos');
                $this->db->where('isDeleted', 0);
                $this->db->where('infoId', $infoId);
                $query = $this->db->get();

                return $query->row();
            }


            /**
             * This function is used to get info prioritys
             */
            function getInfosPrioritys()
            {
                $this->db->select('*');
                $this->db->from('tbl_infos_prioritys');
                $query = $this->db->get();

                return $query->result();
            }

                /**
                 * This function is used to get info Status
                 */
                function getInfosStatus()
                {
                    $this->db->select('*');
                    $this->db->from('tbl_infos_status');
                    $query = $this->db->get();

                    return $query->result();
                }

    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewInfo($infoDetail)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_infos', $infoDetail);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
function uploadImageFile($imageDetail)
{
    //echo "<br>Image data to insert is <br>";

    $this->db->trans_start();
    $this->db->insert('tbl_image', $imageDetail);
    $insert_id = $this->db->insert_id();

    $this->db->trans_complete();

    return $insert_id;
}

    /**
     * This function is used to update the information
     * @param array $infoDetail : This is updated information
     * @param number $infoId : This is information id
     */
    function editInfo($infoDetail, $infoId)
    {
        $this->db->where('infoId', $infoId);
        $this->db->update('tbl_infos', $infoDetail);

        return TRUE;
    }

        /**
         * This function is used to delete the information
         * @param number $infoId : This is information id
         * @return boolean $result : TRUE / FALSE
         */
        function deleteInfo($infoId,$infoDetail)
        {
            $this->db->where('infoId', $infoId);
            $this->db->update('tbl_infos', $infoDetail);

            return TRUE;
        }

    /**
     * This function is used to delete the information
     * @param number $infoId : This is information id
     * @return boolean $result : TRUE / FALSE
     */
    function hardDeleteInfo($infoId)
    {
        $this->db->where('infoId', $infoId);
        $result = $this->db->delete('tbl_infos');

        return $result;
    }


    /**
     * This function is used to add a new task
     */
    function addNewInfos($infoDetail)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_infos', $infoDetail);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }



    /**
     * This function is used to return the size of the table
     * @param string $tablename : This is table name
     * @param string $dbname : This is database name
     * @return array $return : Table size in mb
     */
    function gettablemb($tablename,$dbname)
    {
        $this->db->select('round(((data_length + index_length)/1024/1024),2) as total_size');
        $this->db->from('information_schema.tables');
        $this->db->where('table_name', $tablename);
        $this->db->where('table_schema', $dbname);
        $query = $this->db->get($tablename);

        return $query->row();
    }

    /**
     * This function is used to get the tasks count
     * @return array $result : This is result
     */
    function infosCount()
    {
        $this->db->select('*');
        $this->db->from('tbl_infos BaseTbl');
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * This function is used to get the finished tasks count
     * @return array $result : This is result
     */
    function finishedInfosCount()
    {
        $this->db->select('*');
        $this->db->from('tbl_info as BaseTbl');
        $this->db->where('BaseTbl.statusId', 2);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * This function used to save login information of user
     * @param array $loginInfo : This is users login information
     */
    function loginsert($logInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_log', $logInfo);
        $this->db->trans_complete();
    }


}
