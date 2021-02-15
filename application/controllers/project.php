<?php

require APPPATH . '/libraries/BaseController.php';
// Cloudinary
require 'assets/plugins/cloudinary/cloudinary_php/src/Cloudinary.php';
require 'assets/plugins/cloudinary/cloudinary_php/src/Uploader.php';
require 'assets/plugins/cloudinary/cloudinary_php/src/Api.php';
\Cloudinary::config(array(
    'cloud_name' => 'infosimonline',
    'api_key' => '662235653456635',
    'api_secret' => 'lAf4YxDOyfGrYR2BV8NlUpn50cQ'

));
/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Samet Aydın / sametay153@gmail.com
 * @version : 1.0
 * @since : 27.02.2018
 */
class project extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $data['infoRecords'] = '';

        $this->global['pageTitle'] = 'InfoSim : Project InfoSim';

        $this->loadViews("project/index", $this->global, $data, NULL);
    }

    public function propose()
    {
        $data['infoRecords'] = '';

        $this->global['pageTitle'] = 'InfoSim : Project InfoSim';

        $this->loadViews("project/index", $this->global, $data, NULL);
    }

}

?>
