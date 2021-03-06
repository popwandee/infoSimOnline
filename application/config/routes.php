<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = "login";
$route['404_override'] = 'login/error';

/*********** PROJECT DEFINED ROUTES *******************/

$route['project'] = 'project/index';
$route['propose'] = 'project/propose';
$route['HOWTO'] = 'project/howto';

/*********** USER DEFINED ROUTES *******************/

$route['loginMe'] = 'login/loginMe';
$route['dashboard'] = 'user';
$route['logout'] = 'user/logout';

/*********** ADMIN CONTROLLER ROUTES *******************/
$route['noaccess'] = 'login/noaccess';
$route['userListing'] = 'admin/userListing';
$route['userListing/(:num)'] = "admin/userListing/$1";
$route['addNew'] = "admin/addNew";
$route['addNewUser'] = "admin/addNewUser";
$route['editOld'] = "admin/editOld";
$route['editOld/(:num)'] = "admin/editOld/$1";
$route['editUser'] = "admin/editUser";
$route['deleteUser'] = "admin/deleteUser";
$route['log-history'] = "admin/logHistory";
$route['log-history-backup'] = "admin/logHistoryBackup";
$route['log-history/(:num)'] = "admin/logHistorysingle/$1";
$route['log-history/(:num)/(:num)'] = "admin/logHistorysingle/$1/$2";
$route['backupLogTable'] = "admin/backupLogTable";
$route['backupLogTableDelete'] = "admin/backupLogTableDelete";
$route['log-history-upload'] = "admin/logHistoryUpload";
$route['logHistoryUploadFile'] = "admin/logHistoryUploadFile";

/*********** MANAGER CONTROLLER ROUTES *******************/
$route['tasks'] = "manager/tasks";
$route['addNewTask'] = "manager/addNewTask";
$route['addNewTasks'] = "manager/addNewTasks";
$route['editOldTask/(:num)'] = "manager/editOldTask/$1";
$route['editTask'] = "manager/editTask";
$route['deleteTask/(:num)'] = "manager/deleteTask/$1";

$route['metls'] = "manager/metls";
$route['addNewMetlForm'] = "manager/addNewMetlForm";
$route['addNewMetl'] = "manager/addNewMetl";
$route['editOldMetl/(:num)'] = "manager/editOldMetl/$1";
$route['editMetl'] = "manager/editMetl";
$route['deleteMetl/(:num)'] = "manager/deleteMetl/$1";

$route['manageInfo'] = "manager/manageInfo";
$route['userViewInfo'] = "manager/userViewInfo";
$route['mInfoDetail/(:num)'] = "manager/mInfoDetail/$1";
$route['mAddNewInfo'] = "manager/mAddNewInfoForm";
$route['mAddNewInfos'] = "manager/mAddNewInfoToDB";
$route['mOperateInfo/(:num)'] = "manager/mOperateInfo/$1";
$route['mChecker'] = "manager/mChecker";
$route['mEditOldInfo/(:num)'] = "manager/mEditOldInfo/$1";
$route['mDeleteInfo/(:num)'] = "manager/mDeleteInfo/$1";
$route['mHardDeleteInfo/(:num)'] = "manager/mHardDeleteInfo/$1";

/*********** USER CONTROLLER ROUTES *******************/
$route['loadChangePass'] = "user/loadChangePass";
$route['changePassword'] = "user/changePassword";
$route['pageNotFound'] = "user/pageNotFound";
$route['checkEmailExists'] = "user/checkEmailExists";
$route['endTask/(:num)'] = "user/endTask/$1";
$route['etasks'] = "user/etasks";
$route['userEdit'] = "user/loadUserEdit";
$route['updateUser'] = "user/updateUser";

$route['einfo'] = "info/index";
$route['allInfos'] = "info/allInfos";
$route['infoDetail/(:num)'] = "info/infoDetail/$1";
$route['checker'] = "info/checker";

$route['addNewInfo'] = "info/addNewInfoForm";
$route['addNewInfos'] = "info/addNewInfoToDB";
$route['uploadFile'] = "info/uploadFile";
$route['operateInfo/(:num)'] = "info/operateInfo/$1";
$route['editOldInfo/(:num)'] = "info/editOldInfo/$1";
$route['deleteInfo/(:num)'] = "info/deleteInfo/$1";

/*********** LOGIN CONTROLLER ROUTES *******************/
$route['forgotPassword'] = "login/forgotPassword";
$route['resetPasswordUser'] = "login/resetPasswordUser";
$route['resetPasswordConfirmUser'] = "login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "login/resetPasswordConfirmUser/$1";
$route['resetPasswordConfirmUser/(:any)/(:any)'] = "login/resetPasswordConfirmUser/$1/$2";
$route['createPasswordUser'] = "login/createPasswordUser";

/* End of file routes.php */
/* Location: ./application/config/routes.php */
