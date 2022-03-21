<?php 

class Login extends CI_Model{
    public function __constructor(){
        parent::__constructor();
    }

    public function loginControl($email,$password){
        $result = $this->db->select("*")
        ->from("students")
        ->where("email",$email)
        ->where("password",$password)
        ->get()
        ->row();

        if(is_countable($result) && count($result) != 1){
            return false;
        }else{
            return $result;
        }
    }

    public function forgotPassword($email){
        return $this->db->select("*")
        ->from("students")
        ->where("email",$email)
        ->get()
        ->row();
    }

    public function studentPasswordAdd($email,$data = array()){
        return $this->db->where('email',$email)->update("students",$data);
    }

}
?>