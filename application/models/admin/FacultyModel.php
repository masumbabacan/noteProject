<?php 

class FacultyModel extends CI_Model{
    public function __constructor(){
        parent::__constructor();
    }

    public function getFaculties(){
        return $this->db->where("status","1")->get("faculties")->result();
    }

    public function facultyById($id){
        return $this->db->where("facultyCode",$id)->get("faculties")->result();
    }

    public function facultyAdd($data = array()){
        return $this->db->insert("faculties", $data);
    }

    public function facultyDelete($id,$data = array()){
        return $this->db->where('facultyCode',$id)->update("faculties",$data);
    }
    public function facultyEdit($id,$data = array()){
        return $this->db->where('facultyCode',$id)->update("faculties",$data);
    }
}
?>