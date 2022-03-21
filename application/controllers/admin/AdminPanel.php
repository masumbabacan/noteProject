<?php 

class AdminPanel extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->security();
        $this->load->model("admin/facultyModel");
        $this->load->model("admin/departmentModel");
        $this->load->model("admin/lessonModel");
        $this->load->model("admin/teacherModel");
        $this->load->model("admin/teacherLessonModel");
        $this->load->model("admin/studentModel");
    }

    function security(){
        $control = $this->session->userdata("control");
        if (!isset($control) || $control != true) {
            redirect("admin/admin");
        }
    }

    public function index(){
        $this->load->view("admin/homePage");
    }

    public function faculties(){
        $items = $this->facultyModel->getFaculties();
        $viewData = array("faculties" => $items);
        $this->load->view("admin/faculties",$viewData);
    }
    public function getAjaxFaculty(){
        if (isset($_POST["data"])) {
            $id = $_POST["data"];
            $items = $this->facultyModel->facultyById($id);
            echo json_encode($items);
        }
    }

    public function facultyAdd(){
        if (isset($_POST["data"])) {
            $code = rand(1000000,9999999);
            $insert = $this->facultyModel->facultyAdd(
                array(
                    "facultyCode" => $code,
                    "facultyname" => $_POST["data"]["name"]
                )
            );
            if ($insert) {
                echo 1;
            }else {
                echo 0;
            }
        }
    }

    public function facultyDelete(){
        if (isset($_POST["data"])) {
            $id = $_POST["data"];
            $result = $this->facultyModel->facultyDelete($id,array(
                "status" => "0"
            ));
            if ($result) {
                echo 1;
            }else {
                echo $result;
            }
        }
    }

    public function facultyEdit(){
        if (isset($_POST["data"])) {
            $id = $_POST["data"]["code"];
            $result = $this->facultyModel->facultyEdit($id,array(
                "facultyName" => $_POST["data"]["name"]
            ));
            if ($result) {
                echo 1;
            }else {
                echo 0;
            }
        }
    }


    public function departments(){
        $items = $this->departmentModel->getDepartments();
        $faculties = $this->facultyModel->getFaculties();
        $viewData = array(
            "departments" => $items,
            "faculties" => $faculties
        );
        $this->load->view("admin/departments",$viewData);
    }

    public function departmentAdd(){
        if (isset($_POST["data"])) {
            $code = rand(1000000,9999999);
            $insert = $this->departmentModel->departmentAdd(
                array(
                    "departmentCode" => $code,
                    "facultyCode" => $_POST["data"]["facultyCode"],
                    "departmentName" => $_POST["data"]["name"],
                )
            );
            if ($insert) {
                echo 1;
            }else {
                echo 0;
            }
        }
    }
    public function departmentDelete(){
        if (isset($_POST["data"])) {
            $id = $_POST["data"];
            $result = $this->departmentModel->departmentDelete($id,array(
                "status" => "0"
            ));
            if ($result) {
                echo 1;
            }else {
                echo $result;
            }
        }
    }

    public function lessons(){
        $items = $this->lessonModel->getLessons();
        $departments = $this->departmentModel->getDepartments();
        $viewData = array(
            "lessons" => $items,
            "departments" => $departments
        );
        $this->load->view("admin/lessons",$viewData);
    }
    public function lessonAdd(){
        if (isset($_POST["data"])) {
            $code = rand(1000000,9999999);
            $insert = $this->lessonModel->lessonAdd(
                array(
                    "lessonCode" => $code,
                    "lessonDepartmentCode" => $_POST["data"]["departmentCode"],
                    "lessonName" => $_POST["data"]["name"],
                    "lessonPeriod" => $_POST["data"]["period"]
                )
            );
            if ($insert) {
                echo 1;
            }else {
                echo 0;
            }
        }
    }
    public function lessonDelete(){
        if (isset($_POST["data"])) {
            $id = $_POST["data"];
            $result = $this->lessonModel->lessonDelete($id,array(
                "status" => "0"
            ));
            if ($result) {
                echo 1;
            }else {
                echo $result;
            }
        }
    }

    public function teachers(){
        $items = $this->teacherModel->getTeachers();
        $lessons = $this->lessonModel->getLessons();
        $viewData = array(
            "teachers" => $items,
            "lessons" => $lessons
        );
        $this->load->view("admin/teachers",$viewData);
    }
    public function teacherAdd(){
        if (isset($_POST["data"])) {
            $code = rand(1000000,9999999);
            $insert = $this->teacherModel->teacherAdd(
                array(
                    "teacherNumber" => $code,
                    "firstName" => $_POST["data"]["name"],
                    "lastName" => $_POST["data"]["lastName"],
                    "title" => $_POST["data"]["title"],
                    "email" => $_POST["data"]["email"],
                    "password" => sha1($_POST["data"]["password"]),
                )
            );
            if ($insert) {
                echo 1;
            }else {
                echo 0;
            }
        }
    }
    public function teacherDelete(){
        if (isset($_POST["data"])) {
            $id = $_POST["data"];
            $result = $this->teacherModel->teacherDelete($id,array(
                "status" => "0"
            ));
            if ($result) {
                echo 1;
            }else {
                echo $result;
            }
        }
    }
    public function teacherLessonAdd(){
        if (isset($_POST["data"])) {
            $insert = $this->teacherLessonModel->teacherLessonAdd(
                array(
                    "teacherNumber" => $_POST["data"]["teacherNumber"],
                    "lessonNumber" => $_POST["data"]["lessonNumber"],
                )
            );
            if ($insert) {
                echo 1;
            }else {
                echo 0;
            }
        }
    }
   
    public function students(){
        $items = $this->studentModel->getStudents();
        $viewData = array(
            "students" => $items
        );
        $this->load->view("admin/students",$viewData);
    }

    public function studentAdd(){
        if (isset($_POST["data"])) {
            $code = rand(1000000,9999999);
            $insert = $this->studentModel->studentAdd(
                array(
                    "studentNumber" => $code,
                    "firstName" => $_POST["data"]["name"],
                    "lastName" => $_POST["data"]["lastName"],
                    "phoneNumber" => $_POST["data"]["phone"],
                    "email" => $_POST["data"]["email"],
                    "password" => sha1($_POST["data"]["password"]),
                )
            );
            if ($insert) {
                echo 1;
            }else {
                echo 0;
            }
        }
    }
    public function studentDelete(){
        if (isset($_POST["data"])) {
            $id = $_POST["data"];
            $result = $this->studentModel->studentDelete($id,array(
                "status" => "0"
            ));
            if ($result) {
                echo 1;
            }else {
                echo $result;
            }
        }
    }
    
}

?>