<?php 
class HomePage extends CI_Controller{
    public function __constructor(){
        parent::__constructor();
    }

    public function index(){
        $this->load->view("homePage");
    }
}
?>