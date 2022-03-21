<?php 

class StudentsNoteModel extends CI_Model{
    public function __constructor(){
        parent::__constructor();
    }
    public function noteAdd($data = array()){
        return $this->db->insert("studentNotes", $data);
    }
    public function getNotes($studentNumber,$lessonCode){
        return $this->db->where("studentNumber",$studentNumber)->where("lessonCode",$lessonCode)->get("studentNotes")->result();
    }
    public function noteEdit($studentNumber,$lessonCode,$data = array()){
        return $this->db->where("studentNumber",$studentNumber)->where("lessonCode",$lessonCode)->update("studentNotes",$data);
    }
}
?>