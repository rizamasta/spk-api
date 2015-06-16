<?php
/**
 * Created by PhpStorm.
 * User: rizamasta
 * Date: 6/16/15
 * Time: 9:37 PM
 */
class Seleksi extends CI_Controller{
    public function __construct(){
        parent ::__construct();
        $this->load->model('Db_models');
    }
    public function index(){
        $result['message']="Access Forbidden";
        echo json_encode($result);
    }
    public function proses(){
        $result['message']="success";
        echo json_encode($result);
    }

}