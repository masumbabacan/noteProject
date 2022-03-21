<?php 

class Academician extends CI_Controller{
    public function index(){
        $this->load->view("academician/login");
    }

    public function login(){
        $this->form_validation->set_rules("email","Email","required|trim");
        $this->form_validation->set_rules("password","Şifre","required|trim");
        $this->form_validation->set_message("required","<div class='alert alert-danger text-center' role='alert'>%s boş bırakılamaz</div>");

        if ($this->form_validation->run() == TRUE) {
            $email    = $this->input->post("email");
            $password = sha1($this->input->post("password"));
            $this->load->model("academician/login");
            $result   = $this->login->loginControl($email,$password);
            if ($result) {
                $this->session->set_userdata("control",true);
                $this->session->set_userdata("info",$result);
                redirect("academician/academicianPanel");
                
            }else {
                $this->session->set_flashdata("hata","<div class='alert alert-danger text-center' role='alert'>Kullanıcı adı veya şifre yanlış</div>");
                redirect("academician/academician/login");
            }
        }else {
            $this->load->view("academician/login");
        }
    }

    public function logOut(){
        $this->session->sess_destroy();
        redirect("academician/academician/login");
    }
}

?>