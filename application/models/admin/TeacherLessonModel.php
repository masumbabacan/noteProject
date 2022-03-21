<?php 

class TeacherLessonModel extends CI_Model{
    public function __constructor(){
        parent::__constructor();
    }
    public function teacherLessonAdd($data = array()){
        return $this->db->insert("teacherLessons", $data);
    }

    public function lessonDelete($id,$data = array()){
        return $this->db->where('id',$id)->update("teacherLessons",$data);
    }

    // public function getTeacherLessons($teacherNumber){
    //     $result = $this->db->select("lessonCode,lessonName,firstName,lastName")
    //     ->from("teacherLessons")
    //     ->join("lessons","lessons.lessonCode = teacherLessons.lessonNumber")
    //     ->join("teachers","teachers.teacherNumber = teacherLessons.teacherNumber")
    //     ->where("teacherLessons.teacherNumber",$teacherNumber)
    //     ->get()->result();
    //     return $result;
    // }

    // public function getStudents($lessonCode){
    //     $result = $this->db->select("students.studentNumber,students.firstName,students.lastName")
    //     ->from("studentLessons")
    //     ->join("students","students.studentNumber = studentLessons.studentNumber")
    //     ->where("studentLessons.lessonCode",$lessonCode)
    //     ->get()->result();
    //     return $result;
    // }


}
?>