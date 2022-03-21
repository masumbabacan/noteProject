<?php 

class NoteModel extends CI_Model{
    public function __constructor(){
        parent::__constructor();
    }

    public function getNotes($studentNumber){
        $result = $this->db->select("*")
        ->from("studentNotes")
        ->join("students","students.studentNumber = studentNotes.studentNumber")
        ->join("lessons","lessons.lessonCode = studentNotes.lessonCode")
        ->where("studentNotes.studentNumber",$studentNumber)
        ->get()->result();
        return $result;
    }

    public function noteAdd($data = array()){
        return $this->db->insert("studentNotes", $data);
    }

}
?>