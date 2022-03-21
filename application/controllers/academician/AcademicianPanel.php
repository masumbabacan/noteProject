<?php 

class AcademicianPanel extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->security();
        $this->load->model("academician/studentModel");
        $this->load->model("academician/lessonModel");
        $this->load->model("academician/studentsNoteModel");
    }

    function security(){
        $control = $this->session->userdata("control");
        if (!isset($control) || $control != true) {
            redirect("academician/academician");
        }
    }

    public function index(){
        $this->load->view("academician/homePage");
    }

    public function lessons($teacherId){
        $items = $this->lessonModel->getLessons($teacherId);
        $viewData = array("lessons" => $items);
        $this->load->view("academician/lessons",$viewData);
    }

    public function studentLessons(){
        $lessonCode = $_POST["data"];
        $items = $this->studentModel->studentLessons($lessonCode);
        echo json_encode($items);
    }

    public function studentNotesAdd(){
        $students = $_POST["students"];
        foreach ($students as $student) {
            $average = ($student["vize"] * 0.4) + ($student["final"] * 0.6);
            $notes = $this->studentsNoteModel->getNotes($student["studentCode"],$student["lessonCode"]);
            if (!empty($notes)) {
                $edit = $this->studentsNoteModel->noteEdit($student["studentCode"],$student["lessonCode"],array(
                    "vize" => $student["vize"],
                    "final" => $student["final"],
                    "average" => $average,
                ));
                if ($edit) {
                    echo 1;
                }else {
                    echo 0;
                }
            }else {
                $insert = $this->studentsNoteModel->noteAdd(
                    array(
                        "studentNumber" => $student["studentCode"],
                        "lessonCode" => $student["lessonCode"],
                        "vize" => $student["vize"],
                        "final" => $student["final"],
                        "average" => $average,
                    )
                );
                if ($insert) {
                    echo 1;
                }else {
                    echo 0;
                }
            }
        }
    }

}

?>