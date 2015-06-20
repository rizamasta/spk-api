<?php
/**
 * Created by PhpStorm.
 * User: rizamasta
 * Date: 6/9/15
 * Time: 9:09 PM
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
class Kandidat extends CI_Controller{
    public function __construct(){
        parent :: __construct();
        $this->load->model('Db_models');
    }
    public function index(){
        $result['message']="Sorry this page not Available, contact Support";
        echo json_encode($result);
    }
    public function input(){

        if($_SERVER['REQUEST_METHOD']=="POST"){
            if(
                !empty($_POST['nim'])    &&  !empty($_POST['nama']) &&
                !empty($_POST['tgl_lahir']) && !empty($_POST['kompetensi']) &&
                !empty($_POST['ipk'])   && !empty($_POST['alamat']) &&
                !empty($_POST['keg_mhs']) && !empty($_POST['prestasi'])
                ) {
                $result['message']="success";
                $nim        = $_POST['nim'];
                $nama       = $_POST['nama'];
                $tgl_lahir  = $_POST['tgl_lahir'];
                $kompetensi = $_POST['kompetensi'];
                $ipk        = $_POST['ipk'];
                $alamat     = $_POST['alamat'];
                $keg_mhs    = $_POST['keg_mhs'];
                $prestasi   = $_POST['prestasi'];
                $status     = 'NEW';
                $action     = 0;

                $sql        ="INSERT INTO tbl_kandidat
                              VALUE (null,'$nim','$nama','$tgl_lahir','$alamat','$ipk','$kompetensi','$keg_mhs','$prestasi','$status','$action')";
                $query= $this->db->query($sql);
                if($query){
                    $result['message']="success";
                }
                else{
                    $result['message']="Failed Insert!";
                }
            }
            else{
                $result['message']="Invalid Request!";
            }
        }
        else{
            $result['message']="Just post method";
        }

        echo json_encode($result);
    }
    public function view(){
        if($_SERVER['REQUEST_METHOD']=='POST'){

                $sql    ="SELECT * FROM tbl_kandidat";
                !empty($_POST['action'])?$sql.=" WHERE tbl_kandidat.action='".$_POST['action']."'":$sql .=" ";
                $query  =$this->db->query($sql);
                if($query){
                    $result['message']='success';
                    $result['data']   = $query->result();
                }
                else{
                    $result['message']='Failed query';
                }

        }
        else{
            $result['message']='Method not allowed!';
        }
        echo json_encode($result);
    }


}