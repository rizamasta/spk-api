<?php
/**
 * Created by PhpStorm.
 * User: rizamasta
 * Date: 6/16/15
 * Time: 9:37 PM
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
        if(!empty($_POST['semester']) && !empty($_POST['quota'])&& !empty($_POST['username'])) {
            $id_periode     = strtoupper(substr(uniqid(),8));
            $tgl_periode    = date('Y-m-d');
            $nama_periode   = $_POST['semester'];
            $create_by      = $_POST['username'];

            $_POST['semester']==='genap'?$smst=0:$smst=1;
            $sql_periode    = "INSERT INTO tbl_periode VALUES ('$id_periode','$nama_periode','$tgl_periode','$create_by')";
            $this->db->query($sql_periode);
            $sql            ="SELECT * FROM tbl_kandidat where status='NEW' AND tbl_kandidat.action='0'";
            $query          = $this->db->query($sql);
            if($query){
                $result['message'] = "success";
                $kandidat = $query->result();
                $x=0;
                $hasil_s=0;
                foreach($kandidat as $row ){
                    $umur       = date('Y') - substr($row->tgl_lahir,0,4);
                    $smstr      = (date('Y')-substr($row->nim,0,4))*2;
                    $semester   = $smstr + $smst;
                    if($umur<20 || $umur>25||$semester<3 || $semester>6){
                        $sql    = "UPDATE tbl_kandidat SET status='REJECTED',tbl_kandidat.action='1' WHERE id_kandidat='".$row->id_kandidat."'";
                        $this->db->query($sql);
                    }
                    else{
                        $id_kandidat[$x]= $row->id_kandidat;
                        $usia[$x]       = $umur;
                        $sms[$x]        = $semester;
                        $s[$x]          = exp(0.25*log($row->ipk))*exp(0.2*log($row->kompetensi))*exp(-0.2*log($semester))*exp(0.15*log($umur))*exp(0.1*log($row->keg_mhs))*exp(0.1*log($row->prestasi));
                        $hasil_s        = $hasil_s+$s[$x];
                        $x++;
                    }
                };
                //insert table hasil
                for($y=0;$y<$x;$y++){
                    $v[$y]      = $s[$y]/$hasil_s;
                    $sql_hasil  = "INSERT INTO tbl_hasil VALUES (NULL,'".$id_kandidat[$y]."',
                                                                      '".$sms[$y]."',
                                                                      '".$usia[$y]."',
                                                                      '".$s[$y]."',
                                                                      '".$hasil_s."',
                                                                      '".$v[$y]."',
                                                                      '".$id_periode."')";
                    $this->db->query($sql_hasil);
                };
                //penentuan hasil diterima
                $sql_eksekusi   = "SELECT tbl_kandidat.* FROM tbl_kandidat,tbl_hasil WHERE
                                    tbl_kandidat.id_kandidat = tbl_hasil.id_kandidat AND
                                    tbl_kandidat.status      = 'NEW' AND
                                    tbl_kandidat.action      = '0' ORDER BY tbl_hasil.v DESC LIMIT ".$_POST['quota'];
                $query_eksekusi = $this->db->query($sql_eksekusi);
                $hasil_eksekusi = $query_eksekusi->result();
                foreach($hasil_eksekusi as $row){
                    $sql_up     = "UPDATE tbl_kandidat SET status='ACCEPTED',tbl_kandidat.action='2' WHERE tbl_kandidat.id_kandidat='".$row->id_kandidat."'";
                    $this->db->query($sql_up);
                }
                //penentuan hasil ditolak
                $sql_eksekusi   = "SELECT tbl_kandidat.* FROM tbl_kandidat,tbl_hasil WHERE
                                    tbl_kandidat.id_kandidat = tbl_hasil.id_kandidat AND
                                    tbl_kandidat.status      = 'NEW' AND
                                    tbl_kandidat.action      = '0'";
                $query_eksekusi = $this->db->query($sql_eksekusi);
                $hasil_eksekusi = $query_eksekusi->result();
                foreach($hasil_eksekusi as $row){
                    $sql_up     = "UPDATE tbl_kandidat SET status='NA',tbl_kandidat.action='2' WHERE tbl_kandidat.id_kandidat='".$row->id_kandidat."'";
                    $this->db->query($sql_up);
                }
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