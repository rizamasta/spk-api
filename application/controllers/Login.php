<?php
/**
 * Created by PhpStorm.
 * User: rizamasta
 * Date: 5/23/15
 * Time: 9:05 PM
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

class Login extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Db_models');
    }
    public function index(){
        if($_SERVER['REQUEST_METHOD']==='POST'){

            $result['message']  = 'success';
            $username           = $_POST['username'];
            $password           = sha1($_POST['password']);
            $sql                = "SELECT username,tbl_user.name as nama,email FROM tbl_user
                                                                   WHERE (username = '$username' OR email = '$username')
                                                                   AND password = '$password'";
            $query  = $this->db->query($sql);
            if($query)
            {
                $result['result'] =$query->result();
                if(count($query->result())>0){
                    $result['message']     = 'success';
                }
                else{
                    $result['message']     = 'User login salah';
                };

            }
            else{
                $result['message']="terjadi kesalahan";
            }

            $this->db->close();
        }
        else{
            $result['message']='Just Post Method Allow';

        }
        echo json_encode($result);
       // print_r($result);
    }
    /*public function change(){
        if($_SERVER['REQUEST_METHOD']==='POST'){

            $result['message']  = 'success';
            $username           = $_POST['user_name'];
            $realname           = $_POST['real_name'];
            !empty($_POST['password'])?$password = sha1($_POST['password']):$password="";
            $email              = $_POST['email'];
            $sql                = "UPDATE tbl_user SET real_name='$realname'";
            !empty($password)?$sql.=",password='$password'":$sql.=" ";
            !empty($email)?$sql.=",email='$email'":$sql.=" ";
            $sql                .=" WHERE user_name = '$username'";
            $query  = $this->db->query($sql);
            if($query)
            {

                    $result['message']     = 'success';


            }
            else{
                $result['message']="terjadi kesalahan";
            }

            $this->db->close();
        }
        else{
            $result['message']='Just Post Method Allow';

        }
        echo json_encode($result);
    }
    public function register(){
        if($_SERVER['REQUEST_METHOD']==='POST'){
            if(
                    !empty($_POST['user_name']) &&
                    !empty($_POST['real_name']) &&
                    !empty($_POST['password']) &&
                    !empty($_POST['email'])

            ) {
                $result['message'] = 'success';
                $username = $_POST['user_name'];
                $realname = $_POST['real_name'];
                $password = sha1($_POST['password']);
                $email    = $_POST['email'];
                $sign_date = date('Y/m/d');
                $last_up    = date('Y/m/d H:i:s');
                $sql = "INSERT INTO tbl_user VALUE ('$username','$realname','$sign_date','$email','$password','$last_up',1)";
                $query = $this->db->query($sql);
                if ($query) {

                    $result['message'] = 'success';


                } else {
                    $result['message'] = "terjadi kesalahan";
                }

                $this->db->close();
            }
        }
        else{
            $result['message']='Just Post Method Allow';

        }
        echo json_encode($result);
    }*/

}