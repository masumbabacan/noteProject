<?php 

class LessonModel extends CI_Model{
    public function __constructor(){
        parent::__constructor();
    }

    public function getLessons($teacherNumber){
        $result = $this->db->select("lessonNumber,lessonName,lessonPeriod")
        ->from("teacherLessons")
        ->join("teachers","teachers.teacherNumber = teacherLessons.teacherNumber")
        ->join("lessons","lessons.lessonCode = teacherLessons.lessonNumber")
        ->where("teacherLessons.teacherNumber",$teacherNumber)
        ->get()->result();
        return $result;
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