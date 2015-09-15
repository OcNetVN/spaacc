<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Export extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the Library
        $this->load->library("excel");
        // Load the Model
        //$this->load->model("Your_model_name");
    }

    public function index() {
        $this->excel->setActiveSheetIndex(0);
        // Gets all the data using MY_Model.php
        //$data = $this->Your_model_name->get_all();
        $data = "Xuat ra file excel thu xem";

        $this->excel->stream('name_of_file.xls', $data);
    }

}