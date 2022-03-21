<?php 

class StudentModel extends CI_Model{
    public function __constructor(){
        parent::__constructor();
    }

    public function getStudents(){
        return $this->db->where("status","1")->get("students")->result();
    }

    public function studentAdd($data = array()){
        return $this->db->insert("students", $data);
    }

    public function studentDelete($id,$data = array()){
        return $this->db->where('studentNumber',$id)->update("students",$data);
    }
}
?>