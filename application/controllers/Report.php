<?php
/**
 * Created by PhpStorm.
 * User: rizamasta
 * Date: 6/20/15
 * Time: 2:44 PM
 */
if(!empty($_SERVER['HTTP_ORIGIN']))
{
    $http_origin = $_SERVER['HTTP_ORIGIN'];
}
else{
    $http_origin = '*';
}
header("Access-Control-Allow-Origin:$http_origin");
header("Access-Control-Allow-Credentials:true");
defined('BASEPATH') OR exit('No script Allowed');

Class Report extends CI_Controller{
    public function __construct(){
        parent :: __construct();
        $this->load->model('Db_models');
    }
    public function index(){
        $result['message']="Sorry this page not Available, contact Support";
        echo json_encode($result);
    }

    public function periode(){
        if(!empty($_POST['username'])){

            $sql    = "SELECT * FROM tbl_periode";
            $query  = $this->db->query($sql);
            if($query){
                $result['message']  = 'success';
                $result['data']     = $query->result();
            }
        }
        else{
            $result['message'] = "Invalid Request";
        }

        echo json_encode($result);
    }

    public function periodeDetail(){
        if(!empty($_POST['username'])&&!empty($_POST['id_periode'])){

            $sql    = "SELECT tbl_hasil.semester,
                              tbl_hasil.usia,
                              tbl_hasil.s,
                              tbl_hasil.hasil_s,
                              tbl_hasil.v,
                              tbl_kandidat.nim,
                              tbl_kandidat.nama,
                              tbl_kandidat.ipk,
                              tbl_kandidat.kompetensi,
                              tbl_kandidat.keg_mhs,
                              tbl_kandidat.prestasi,
                              tbl_kandidat.status

                              FROM tbl_periode,tbl_kandidat,tbl_hasil WHERE
                              tbl_hasil.id_kandidat = tbl_kandidat.id_kandidat AND
                              tbl_hasil.id_periode = tbl_periode.id_periode AND
                              tbl_periode.id_periode='".$_POST['id_periode']."'";

            $query  = $this->db->query($sql);
            if($query){
                $result['message']  = 'success';
                $result['data']     = $query->result();
            }
        }
        else{
            $result['message'] = "Invalid Request";
        }

        echo json_encode($result);
    }


    public function cetak(){

    }
}