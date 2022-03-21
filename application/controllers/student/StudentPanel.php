<?php 

class StudentPanel extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->security();
        $this->load->model("student/noteModel");
        $this->load->model("student/passwordModel");
        $this->load->model("student/lessonModel");
    }

    function security(){
        $control = $this->session->userdata("control");
        if (!isset($control) || $control != true) {
            redirect("student/student");
        }
    }

    public function index(){
        $this->load->view("student/homePage");
    }

    public function notes($studentNumber){
        $items = $this->noteModel->getNotes($studentNumber);
        $viewData = array("notes" => $items);
        $this->load->view("student/notes",$viewData);
    }

    public function passwordChange($studentNumber){
        $this->load->view("student/passwordChange");
    }

    public function passwordChangeAdd($studentNumber){
        $items = $this->passwordModel->getStudent($studentNumber);
        $oldPassword = sha1($_POST["data"]["oldPassword"]);
        $newPassword = sha1($_POST["data"]["newPassword"]);
        if ($items[0]->password == $oldPassword){
            $result = $this->passwordModel->passwordEdit($studentNumber,array(
                "password" => $newPassword
            ));
            echo 1;
        }else {
            echo 0;
        }
    }

    public function lessons(){
        $items = $this->lessonModel->getLessons();
        $viewData = array("lessons" => $items);
        $this->load->view("student/lessons",$viewData);
    }
    public function lessonSelection(){
        $studentNumber = $_POST["data"]["studentNumber"];
        $lessonNumber = $_POST["data"]["lessonNumber"];
        $items = $this->lessonModel->getStudentLessons($studentNumber,$lessonNumber);
        if (empty($items)) {
            $result = $this->lessonModel->addStudentLesson(array(
                "studentNumber" => $studentNumber,
                "lessonCode" => $lessonNumber
            ));
            $this->noteModel->noteAdd(array(
                "studentNumber" => $studentNumber,
                "lessonCode" => $lessonNumber
            ));
            echo 1;
        }else {
            echo 0;
        }
    }


    

}

?>