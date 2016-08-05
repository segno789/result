<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    /**
    * Index Page for this controller.
    *
    * Maps to the following URL
    * 		http://example.com/index.php/welcome
    *	- or -
    * 		http://example.com/index.php/welcome/index
    *	- or -
    * Since this controller is set as the default controller in
    * config/routes.php, it's displayed at http://example.com/
    *
    * So any other public methods not prefixed with an underscore will
    * map to /index.php/welcome/<method_name>
    * @see http://codeigniter.com/user_guide/general/urls.html
    */
    public function index()
    {
        $this->load->helper('url');
        $data = array(
            'user_status' => ''                     

        );


        if(@$_POST['username'] != '' && @$_POST['password'] != '')
        {   

            $this->load->model('login_model'); 
            $logedIn = $this->login_model->auth($_POST['username'],$_POST['password']);
//DebugBreak();
            if($logedIn != false)
            {  
                $grp =  $logedIn['tbl_inst']['allowed_mGrp'];
               /* if($logedIn['flusers']['edu_lvl'] == 2)
                {
                    $data = array(
                        'user_status' => 1                     
                    );
                    $this->load->view('login/login.php',$data);
                }
                else*/
                 if($logedIn['flusers']['status'] == 0)
                {
                    $data = array(
                        'user_status' => 3                     
                    );
                    $this->load->view('login/login.php',$data);
                }
               
                else
                {
                    $isdeaf = 0;

                    
                    $sess_array = array(
                        'Inst_Id' => $logedIn['flusers']['inst_cd'] ,
                        'edu_lvl' => $logedIn['tbl_inst']['edu_lvl'],
                        'inst_Name' => $logedIn['flusers']['inst_name'],
                        'gender' => $logedIn['tbl_inst']['Gender'],
                        'isrural' => $logedIn['tbl_inst']['IsRural'],
                        'grp_cd' => $logedIn['tbl_inst']['allowed_mGrp'],
                        'isgovt' => $logedIn['tbl_inst']['IsGovernment'],
                        'email' => $logedIn['tbl_inst']['email'],
                        'phone' => $logedIn['tbl_inst']['LandLine'],
                        'cell' => $logedIn['tbl_inst']['MobNo'],
                        'dist' => $logedIn['tbl_inst']['dist_cd'],
                        'teh' => $logedIn['tbl_inst']['teh_cd'],
                        'zone' => $logedIn['tbl_inst']['zone_cd'],
                        'emis' => $logedIn['tbl_inst']['emis_code'],
                        'isdeaf' => $isdeaf,
                        'isboardoperator' => 0
                    );
                    $this->load->library('session');

                    $this->session->set_userdata('logged_in', $sess_array); 
                    
                    if($logedIn['tbl_inst']['edu_lvl'] == 1 || $logedIn['tbl_inst']['edu_lvl'] == 3)
                    redirect('result/dashboard9th','refresh');
                    else if($logedIn['tbl_inst']['edu_lvl'] == 2 || $logedIn['tbl_inst']['edu_lvl']==3)
                    {
                         redirect('result/dashboard12th','refresh'); 
                    }


                }




            }
            else
            {  
                $data = array(
                    'user_status' => 1                     
                );
                $this->load->view('login/login.php',$data);

            }
        }
        else
        {
            $this->load->view('login/login.php',$data);
        }

    }
    function logout()
    {
        $this->load->helper('url');
       
       // DebugBreak();
       $this->load->library('session');
       $Logged_In_Array = $this->session->all_userdata();
       $userinfo = @$Logged_In_Array['logged_in'];
       if($userinfo['isboardoperator']==1){
           $this->session->unset_userdata('logged_in');
           $this->session->unset_userdata('user_id');
           $this->session->unset_userdata('username');
           $this->session->unset_userdata('logged_in_front');
           $this->session->unset_userdata('user_id_front');
           $this->session->unset_userdata('username_front');
           
           $this->session->sess_destroy();    
           redirect('login/biselogin','refresh');
       }
       else{
             $this->session->unset_userdata('logged_in');
           $this->session->unset_userdata('user_id');
           $this->session->unset_userdata('username');
           $this->session->unset_userdata('logged_in_front');
           $this->session->unset_userdata('user_id_front');
           $this->session->unset_userdata('username_front');
         
           $this->session->sess_destroy();
           redirect('login','refresh');
       }
        
        
       
    }
}
/*'Inst_Id' => $logedIn->Inst_cd,
'edu_lvl' => $logedIn->edu_lvl,
'Name' => $logedIn->name,*/