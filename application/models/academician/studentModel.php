<?php 

class StudentModel extends CI_Model{
    public function __constructor(){
        parent::__constructor();
    }

    public function studentLessons($lessonCode){
        $result = $this->db->select("*")
        ->from("studentLessons")
        ->join("students","students.studentNumber = studentLessons.studentNumber")
        ->join("lessons","lessons.lessonCode = studentLessons.lessonCode")
        ->join("studentNotes","studentNotes.studentNumber = studentLessons.studentNumber AND studentNotes.lessonCode = studentLessons.lessonCode")
        ->where("studentLessons.lessonCode",$lessonCode)
        ->get()->result();
        return $result;
    }
}
?>