<?php 

class PasswordModel extends CI_Model{
    public function __constructor(){
        parent::__constructor();
    }

    public function getStudent($studentNumber){
        return $this->db->where("studentNumber",$studentNumber)->get("students")->result();
    }

    public function passwordEdit($id,$data = array()){
        return $this->db->where('studentNumber',$id)->update("students",$data);
    }
}
?>