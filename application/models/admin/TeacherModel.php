<?php 

class TeacherModel extends CI_Model{
    public function __constructor(){
        parent::__constructor();
    }

    public function getTeachers(){
        return $this->db->where("status","1")->get("teachers")->result();
    }

    public function teacherAdd($data = array()){
        return $this->db->insert("teachers", $data);
    }

    public function teacherDelete($id,$data = array()){
        return $this->db->where('teacherNumber',$id)->update("teachers",$data);
    }
}
?>