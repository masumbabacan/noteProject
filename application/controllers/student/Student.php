<?php 

class Student extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("student/login");
    }
    public function index(){
        $this->load->view("student/login");
    }

    public function login(){
        $this->form_validation->set_rules("email","Email","required|trim");
        $this->form_validation->set_rules("password","Şifre","required|trim");
        $this->form_validation->set_message("required","<div class='alert alert-danger text-center' role='alert'>%s boş bırakılamaz</div>");

        if ($this->form_validation->run() == TRUE) {
            $email    = $this->input->post("email");
            $password = sha1($this->input->post("password"));
            $this->load->model("student/login");
            $result   = $this->login->loginControl($email,$password);
            if ($result) {
                $this->session->set_userdata("control",true);
                $this->session->set_userdata("info",$result);
                redirect("student/studentPanel");
                
            }else {
                $this->session->set_flashdata("hata","<div class='alert alert-danger text-center' role='alert'>Kullanıcı adı veya şifre yanlış</div>");
                redirect("student/student/login");
            }
        }else {
            $this->load->view("student/login");
        }
    }

    public function logOut(){
        $this->session->sess_destroy();
        redirect("student/student/login");
    }

    public function forgotPassword(){
        $config = array(
            "protocol" => "smtp",
            "smtp_host" => "ssl://smtp.gmail.com",
            "smtp_port" => "465",
            "smtp_user" => "masum1cocuxx@gmail.com",
            "smtp_pass" => "masumbabacan27590",
            "smtp_starttls" => true,
            "charset" => "utf-8",
            "mailtype" => "text",
            "wordWrap" => true,
            "starttsl" => true,
            "newline" => "\r\n"
        );

        if (isset($_POST["data"])) {
            $email = $_POST["data"];
            $items = $this->login->forgotPassword($email);
            if (!empty($items)) {
                $randomPassword = rand("11111111","99999999");
                $this->login->studentPasswordAdd($email,array(
                    "password" => sha1($randomPassword)
                ));
                $this->load->library("email");
                $this->email->initialize($config); 
                $this->email->from("masum1cocuxx@gmail.com","Masum Babacan");
                $this->email->to($email);
                $this->email->subject("şifre değişikliği");
                $this->email->message("Yeni Şifreniz : " . $randomPassword);
                $send = $this->email->send();
                if ($send) {
                    echo 1;
                }else {
                    echo $this->email->print_debugger();
                }
            }else {
                echo 0;
            }
        }
    }
}

?>