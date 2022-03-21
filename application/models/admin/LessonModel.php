<?php 

class LessonModel extends CI_Model{
    public function __constructor(){
        parent::__constructor();
    }

    public function getLessons(){
      $result = $this->db->select("lessonCode,departmentName,lessonName,lessonPeriod")
      ->from("lessons")
      ->join("departments","departments.departmentCode = lessons.lessonDepartmentCode")
      ->where("lessons.status","1")
      ->get()->result();

      return $result;

      
    }

    public function lessonAdd($data = array()){
        return $this->db->insert("lessons", $data);
    }

    public function lessonDelete($id,$data = array()){
        return $this->db->where('lessonCode',$id)->update("lessons",$data);
    }
}
?>