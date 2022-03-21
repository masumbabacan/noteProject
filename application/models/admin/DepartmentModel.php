<?php 

class DepartmentModel extends CI_Model{
    public function __constructor(){
        parent::__constructor();
    }

    public function getDepartments(){
      $result = $this->db->select("departmentCode,facultyName,departmentName")
      ->from("departments")
      ->join("faculties","faculties.facultyCode = departments.facultyCode")
      ->where("departments.status","1")
      ->get()->result();

      return $result;

      
    }

    public function departmentAdd($data = array()){
        return $this->db->insert("departments", $data);
    }

    public function departmentDelete($id,$data = array()){
        return $this->db->where('departmentCode',$id)->update("departments",$data);
    }
}
?>