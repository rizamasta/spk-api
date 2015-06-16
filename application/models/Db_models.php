<?php
/**
 * Created by PhpStorm.
 * User: rizamasta
 * Date: 5/23/15
 * Time: 9:10 PM
 */

class Db_models extends CI_Model{
    public function __construct(){
        $this->load->database();
    }
    public function login($slug=FALSE){
        if($slug){

        }
    }

}