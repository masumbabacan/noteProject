<?php 

class LessonModel extends CI_Model{
    public function __constructor(){
        parent::__constructor();
    }

    public function getLessons(){
        $result = $this->db->select("*")
        ->from("lessons")
        ->get()->result();
        return $result;
    }

    public function getStudentLessons($studentNumber,$lessonNumber){
        $result = $this->db->select("*")
        ->from("studentLessons")
        ->where("lessonCode",$lessonNumber)
        ->where("studentNumber",$studentNumber)
        ->get()->result();
        return $result;
    }

    public function addStudentLesson($data = array()){
        return $this->db->insert("studentLessons", $data);
    }

}
?>