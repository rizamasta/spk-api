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
        if(!empty($_POST['semester']) && !empty($_POST['quota'])) {
            $sql    ="SELECT * FROM tbl_kandidat where status='NEW' AND tbl_kandidat.action='0'";
            $query  = $this->db->query($sql);
            if($query){
                $result['message'] = "success";
                $kandidat = $query->result();
            }
            else{
                $result['message'] = "Failed to process data!";
            }

        }
        else{
            $result['message'] = "Invalid Request";
        }
        echo json_encode($result);
    }

}