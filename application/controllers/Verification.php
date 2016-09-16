<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
class Verification extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');   
    }
    
    public function index()
    {
         $data = array(
            'isselected' => '3',
        );
     //   $this->load->model('Admission_model');
        $this->load->library('session');

        $error ="";

        if($this->session->flashdata('downerror'))
        {
            $error = $this->session->flashdata('downerror');
        }
        else{
            $error = "";
        }
         debugbreak();
        $this->load->view('common/commonheader_Verification.php');
        $mydata = array('error'=>$error);

        $this->load->view('Verification/default.php',$mydata);

       $this->load->view('common/verfooter.php');
    }
    
    public function VerifyRollNo()
    {       
       //  DebugBreak();
        //$data = array(
          //  'tehCode' => $this->input->post('tehCode'),
        //);
        //echo json_encode($data);
        //$tehCode = $data['tehCode'];
        //$this->load->model('Admission_model');
        //$value = "Yasir";
        //echo json_encode($value);
        
        
        $data = array(
            'vClass' => $this->input->post('vClass'),
            'RollNO' => $this->input->post('RollNO'),
            'vYear' => $this->input->post('vYear'),
            'sess' => $this->input->post('sess'),
        );
        //echo json_encode($data);
        //$tehCode = $data['tehCode'];
        $this->load->model('Verification_model');
        $value = array('retData'=> $this->Verification_model->VerifyRollNo($this->input->post('vClass'),$this->input->post('RollNO'),$this->input->post('vYear'),$this->input->post('sess') )) ;
        echo json_encode($value);
    }

    
    
}
?>
