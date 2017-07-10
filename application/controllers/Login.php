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

            if($logedIn != false)
            {  
              
               if( $logedIn['isactive'] == 1)
                {
                    $data = array(
                        'user_status' => 4,                     
                        'remarks' => $logedIn['flusers']['Remarks']                     
                    );
                    
                    if(($logedIn['tbl_inst']['edu_lvl'] == 1 && $logedIn['flusers']['class'] ==9 ) || ($logedIn['tbl_inst']['edu_lvl'] == 2 && $logedIn['flusers']['class'] ==12))
                    {
                        $this->load->view('login/login.php',$data);
                        return ;
                    }
                    
                           
                }
               
                if($logedIn['tbl_inst']['edu_lvl'] == 3)
                {       
                    if($logedIn['flusers']['class'] ==9)
                    {
                        $logedIn['tbl_inst']['edu_lvl'] = 2;
                    }
                    else  if($logedIn['flusers']['class'] ==12)
                    {
                        $logedIn['tbl_inst']['edu_lvl'] = 1;
                    }

                }

                $grp =  $logedIn['tbl_inst']['allowed_mGrp'];
                    $isdeaf = 0;

                    
                    $sess_array = array(
                        'Inst_Id' => $logedIn['tbl_inst']['Inst_cd'] ,
                        'edu_lvl' => $logedIn['tbl_inst']['edu_lvl'],
                        'inst_Name' => $logedIn['tbl_inst']['Name'],
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
                    
                    if($logedIn['tbl_inst']['edu_lvl'] == 2 || $logedIn['tbl_inst']['edu_lvl']==3)
                    {
                         redirect('result/dashboard11th'); 
                    }
                   else  if($logedIn['tbl_inst']['edu_lvl'] == 1 || $logedIn['tbl_inst']['edu_lvl'] == 3)
                    redirect('result/dashboard9th');


            }
            else
            {  
                $data = array(
                    'user_status' => 1,                     
                                  
                );
                $this->load->view('login/login.php',$data);

            }
        }
        else
        {
            $this->load->view('login/login.php',$data);
        }

    }
     public function biselogin()
    {
        // DebugBreak();
        $this->load->helper('url');
        $data = array(
            'user_status' => ''                     

        );


        if(@$_POST['username'] != '' && @$_POST['password'] != '')
        {   
            if(@$_POST['username'] == 2222 || @$_POST['username'] == 2303 || @$_POST['username'] == 2229)
            {



                $this->load->model('login_model'); 
                $logedIn = $this->login_model->biseauth($_POST['username'],$_POST['password']);
                if($logedIn != false)
                {  
                    $sess_array = array(
                        'Inst_Id' => $logedIn['Emp_cd'] ,
                        'edu_lvl' => $logedIn['BS'],
                        'inst_Name' => $logedIn['Name'],
                        'isdeaf' => 0,
                        'isboardoperator' => 1,
                    );
                    $this->load->library('session');
                    $this->session->set_userdata('logged_in', $sess_array); 
                    redirect('result/resultcards'); 
                }
                else
                {  
                    $data = array(
                        'user_status' => 1                     
                    );
                    $this->load->view('login/biselogin.php',$data);

                }
            }
            else
            {
                $data = array(
                    'user_status' => '7'                     

                );
                $this->load->view('login/biselogin.php',$data);
            }

        }
        else
        {

            $this->load->view('login/biselogin.php',$data);
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