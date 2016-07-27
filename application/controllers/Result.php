<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Result extends CI_Controller {

    /**
    * Index Page for this controller.
    *
    * Maps to the following URL
    *         http://example.com/index.php/welcome
    *    - or -
    *         http://example.com/index.php/welcome/index
    *    - or -
    * Since this controller is set as the default controller in
    * config/routes.php, it's displayed at http://example.com/
    *
    * So any other public methods not prefixed with an underscore will
    * map to /index.php/welcome/<method_name>
    * @see http://codeigniter.com/user_guide/general/urls.html
    */
     function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        //this condition checks the existence of session if user is not accessing  
        //login method as it can be accessed without user session
        $this->load->library('session');
        if( !$this->session->userdata('logged_in') && $this->router->method != 'login' ) {
            redirect('login');
        }
    }
    public function index()
    {
        $this->load->helper('url');

        $data = array(); 
        $info = array(); 

        if(!empty($_POST) )
        {
            $this->load->model('Result_model');
            $data = $this->Result_model->getresult($_POST['keyword'],$_POST['check']); 
            if($data == -1)
            {
                $info['isfound'] =-1;
            }
            else 
            {   
                $info['result'] = $data;
                //  $info['callback'] =   $_POST;
            }

        }




        $info['callback']= $_POST;
        $this->load->view('Result/maresult.php',$info); 




    }

    public function dashboard9th()
    {
         $this->load->helper('url');
        $data = array(
            'isselected' => '4',
        );
       //  DebugBreak();
        
        
        
        $this->load->library('session');
        $Logged_In_Array = $this->session->all_userdata();
        $userinfo = $Logged_In_Array['logged_in'];
        $Inst_Id = $userinfo['Inst_Id'];
        $this->load->model('Result_model');
        $info['data'] = $this->Result_model->getresultstd($Inst_Id);

        $this->load->view('common/header.php',$userinfo);
        $this->load->view('common/menu.php',$data);
        $this->load->view('result/dashboard9th.php',$info);
        $this->load->view('common/footer.php'); 
    }
    
    public function resultcard9th()
    {
        $this->load->helper('url');

        $data = array(
            'isselected' => '4',

        );        

        /* $this->load->view('common/header.php');
        $this->load->view('common/menu.php',$data);
        $this->load->view('Result/Result.php');
        $this->load->view('common/footer.php');  */

        $this->load->library('PDFFWithOutPage');
        $pdf=new PDFFWithOutPage('P','in',"A4");   
        $pdf->SetAutoPageBreak(true,2);
        $pdf->AddPage();
        $this->makeResultCard9th($pdf,'');
        $pdf->Output('Result.pdf', 'I');    
    }

    public function resultcard12th()
    {
        $this->load->helper('url');

        $data = array(
            'isselected' => '4',

        );        

        /* $this->load->view('common/header.php');
        $this->load->view('common/menu.php',$data);
        $this->load->view('Result/Result.php');
        $this->load->view('common/footer.php');  */

        $this->load->library('PDFFWithOutPage');
        $pdf=new PDFFWithOutPage('P','in',"A4");   
        $pdf->SetAutoPageBreak(true,2);
        $pdf->AddPage();
        $this->makeResultCard12th($pdf,'');
        $pdf->Output('Result.pdf', 'I');    
    }


    private function makeResultCard9th($pdf,$info)
    {
        //
        // if($info['Session'] ==1) $Session= 'ANNUAL'; else $Session='SUPPLY';
        $Session= 'ANNUAL';  
        $info['Year'] = 2016;     

        // if($info['grp_cd'] == 1)  $grp_cd = 'SCIENCE'; else if($info['grp_cd'] == 2) $grp_cd='GENERAL';else if($info['grp_cd'] == 5) $grp_cd='DEAF & DEFECTIVE';
        //  if($info['Gender']==1) $Gender= 'MALE'; else if($info['Gender']==2) $Gender= 'FEMALE';
        //$filepath = 'assets/'.$info['picpath'];
        $filepath = 'assets/img/download.jpg';


        $fontSize = 10; 
        $marge    = .95;   // between barcode and hri in pixel
        $bx        = 35.6;  // barcode center
        $by        = 23.75;  // barcode center
        $height   = 5.7;   // barcode height in 1D ; module size in 2D
        $width    = .26;  // barcode height in 1D ; not use in 2D
        $angle    = 0;   // rotation in degrees

        $code     = '222020';     // barcode (CP852 encoding for Polish and other Central European languages)
        $type     = 'code128';
        $black    = '000000'; // color in hex
        $Y = 3;
        $x = 5;
        $pdf->SetTextColor(0 ,0,0);
        $pdf->SetFont('Arial','B',14);
        $pdf->SetXY(18.2,8);
        $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE & SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");
        //Roll Number
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(10.8,15.9);
        $pdf->Cell(0, 0.2, "ROLL No. ", 0.25, "C"); 

        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(30.2,15.4);
        $pdf->Cell(0, 0.2, "     124568", 0.25, "C"); 

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(30.2,15.9);
        $pdf->Cell(0, 0.2, "____________", 0.25, "C"); 
        //Enrolment
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(134.2,15.9);
        $pdf->Cell(0, 0.2, "Enrolment No. ", 0.25, "C"); 

        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(163.2,15.4);
        $pdf->Cell(0, 0.2, "     2-1-654372-16", 0.25, "C"); 

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(163.2,15.9);
        $pdf->Cell(0, 0.2, "_________________", 0.25, "C"); 

        //barcode

        $Barcode = "123436@9@1@2016";

        $bardata = Barcode::fpdf($pdf, $black, $bx, $by, $angle, $type, array('code'=>$Barcode), $width, $height);

        $len = $pdf->GetStringWidth($bardata['hri']);
        Barcode::rotate(-$len / 2, ($bardata['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);


        //Logo

        $pdf->Image("assets/img/icon2.png",75,10, 53,45, "PNG");

        //Picture
        $pdf->Image($filepath,170.0,21.1, 30.65,30.65, "jpg");  


        $pdf->SetFont('Arial','B',14);
        $pdf->SetXY(63,50);
        $pdf->Cell(0, 0.2, "PROVISIONAL RESULT INTIMIATION", 0.25, "C"); 

        $pdf->SetFont('Arial','',14);
        $pdf->SetXY(63,50);
        $pdf->Cell(0, 0.2, "________________________________", 0.25, "C"); 


        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(41,57);
        $pdf->Cell(0, 0.2, "Secondary School Part-1 (9th - Class) Annual Examination, 2016", 0.25, "C"); 

        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(73,64);
        $pdf->Cell(0, 0.2, "Group", 0.25, "C"); 

        $pdf->SetFont('Arial','U',12);
        $pdf->SetXY(87,63.6);
        $pdf->Cell(0, 0.2, "                SCIENCE", 0.25, "C"); 

        $pdf->SetFont('Arial','U',12);
        $pdf->SetXY(87,63.6);
        $pdf->Cell(0, 0.2, "_______________________", 0.25, "C"); 



        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,73);
        $pdf->Cell(0, 0.2, "NAME:", 0.25, "C");


        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(20.2,73);
        $pdf->Cell(0, 0.2,"_______________________________________________________________________________________________________", 0.25, "C");
        $pdf->SetXY(50,73);
        $pdf->Cell(0, 0.2,"SHAHID NADEEM", 0.25, "C");


        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,81);
        $pdf->Cell(0, 0.2, "FATHER'S NAME:", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(36.2,81);
        $pdf->Cell(0, 0.2, "______________________________________________________________________________________________", 0.25, "C");

        $pdf->SetXY(50,81);
        $pdf->Cell(0, 0.2, "MUHAMMAD AKRAM", 0.25, "C");


        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,89);
        $pdf->Cell(0, 0.2, "DATE OF BIRTH:", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(36.2,89);
        $pdf->Cell(0, 0.2, "______________________________________________________________________________________________", 0.25, "C");

        $pdf->SetXY(50,89);
        $pdf->Cell(0, 0.2, "15-06-1985", 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,97);
        $pdf->Cell(0, 0.2, "INSTITUTION/DISTRICT:", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(47,97);
        $pdf->Cell(0, 0.2, "________________________________________________________________________________________", 0.25, "C");


        $pdf->SetXY(50,97);
        $pdf->Cell(0, 0.2, "Gujranwala", 0.25, "C");

        $pdf->SetFont('Arial','b',9);
        $pdf->SetXY(10.2,103);
        $pdf->Cell(0, 0.2, "Has secured the marks as detailed below against each subject.", 0.25, "C");

        $countter = 0;
        $countter9 = 0;
        $noteimageheight =62; 
        // THEOROR PART I SUBJECT TABLE
        if(1)
        {
            $boxWidth = 150.0;

            $pdf->SetFillColor(255,255,255);
            //Table cell Global varibales;
            $Y = 51;
            $cellheight = 8;
            $font = 9;

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(10.2,55.2+ $Y);
            $pdf->Cell(12,$cellheight,'Sr. No.',1,0,'C',1);

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(22.2,55.2+ $Y);
            $pdf->Cell(85,$cellheight,'Name of Subjects(S)',1,0,'L',1);

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(100,55.2+ $Y);
            $pdf->Cell(20,$cellheight,'Total Marks',1,0,'C',1);

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(120.1,55.2+ $Y);
            $pdf->Cell(27,$cellheight,'Marks Obtained',1,0,'C',1);

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(147,55.2+ $Y);
            $pdf->Cell(58,$cellheight,'Remarks',1,0,'C',1);


            for($l = 0; $l<8; $l++) { 
                $Y = $Y + $cellheight;

                $pdf->SetFont('Arial','',$font);
                $pdf->SetXY(10.2,55.2+ $Y);
                $pdf->Cell(12,$cellheight,$l+1,1,0,'C',1);

                $pdf->SetFont('Arial','',$font);
                $pdf->SetXY(22.2,55.2+ $Y);
                $pdf->Cell(85,$cellheight,"Health & Physical Education",1,0,'L',1);

                $pdf->SetFont('Arial','',$font);
                $pdf->SetXY(100,55.2+ $Y);
                $pdf->Cell(20,$cellheight,'75',1,0,'C',1);

                $pdf->SetFont('Arial','',$font);
                $pdf->SetXY(120.1,55.2+ $Y);
                $pdf->Cell(27,$cellheight,'25',1,0,'C',1);

                $pdf->SetFont('Arial','',$font);
                $pdf->SetXY(147,55.2+ $Y);
                $pdf->Cell(58,$cellheight, "Less than Pass marks",1,0,'C',1);
            }




            /*   if(@$info['slips'][$countter]['subp1count'] >4)
            $noteimageheight = $noteimageheight+13;
            */
        }

        $Y = $Y + $cellheight;

        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(10.2,55.2+ $Y);
        $pdf->Cell(90,$cellheight,'Total',1,0,'C',1);

        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(100,55.2+ $Y);
        $pdf->Cell(20,$cellheight,'75',1,0,'C',1);

        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(120.1,55.2+ $Y);
        $pdf->Cell(27,$cellheight,'25',1,0,'C',1);

        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(147,55.2+ $Y);
        $pdf->Cell(58,$cellheight,'',1,0,'C',1);


        $pdf->SetFont('Arial','',11);
        $pdf->SetXY(9.2,188);
        $pdf->MultiCell(195, 5, 'The candidate may appear in subject(s) having less than pass marks along with Secondary School Part-II (Annual) Examination, 2017 otherwise his/her final result (Pass/Fail) in subjects(s) will be determined on the basis of total marks obtained by him/her  Secondary School Part-I & Part-II.', 0, "J",0);

        $pdf->Image("assets/img/result_note.jpg",45.2,203, 153,10, "jpg"); 

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,215);
        $pdf->Cell(0, 0.2, "Prepared By:", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(29.2,215);
        $pdf->Cell(0, 0.2, "_____________________________________", 0.25, "C");


        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,225);
        $pdf->Cell(0, 0.2, "Checked By:", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(29.2,225);
        $pdf->Cell(0, 0.2, "_____________________________________", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,235);
        $pdf->Cell(0, 0.2, " Dated:", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(29.2,235);
        $pdf->Cell(0, 0.2, "_____________________________________", 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(35.2,240);
        $pdf->Cell(0, 0.2, "(Errors & Omissions are excepted)", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(10.2,250);
        $pdf->Cell(0, 0.2, " HOME ADDRESS:", 0.25, "C");

        $pdf->SetFont('Arial','u',10);
        $pdf->SetXY(41.6,247);
        $pdf->MultiCell(125, 5, 'address dfsdfsdf  sd f sd fsd fs df   sdf sd f sd f sd fsd f sd fs df s df sdf sd fs df sd f sd fs df s df sd f .', 0, "L",0);


        $pdf->Image("assets/img/CE_Signature.png",163.0,247, 35,35, "PNG"); 

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(147,284);
        $pdf->Cell(0, 0.2, "CONTROLLER OF EXAMINATIONS", 0.25, "C");


    }

    private function makeResultCard12th($pdf,$info)
    {
        //
        // if($info['Session'] ==1) $Session= 'ANNUAL'; else $Session='SUPPLY';
        $Session= 'ANNUAL';  
        $info['Year'] = 2016;     

        // if($info['grp_cd'] == 1)  $grp_cd = 'SCIENCE'; else if($info['grp_cd'] == 2) $grp_cd='GENERAL';else if($info['grp_cd'] == 5) $grp_cd='DEAF & DEFECTIVE';
        //  if($info['Gender']==1) $Gender= 'MALE'; else if($info['Gender']==2) $Gender= 'FEMALE';
        //$filepath = 'assets/'.$info['picpath'];
        $filepath = 'assets/img/download.jpg';


        $fontSize = 10; 
        $marge    = .95;   // between barcode and hri in pixel
        $bx        = 36.6;  // barcode center
        $by        = 28.75;  // barcode center
        $height   = 5.7;   // barcode height in 1D ; module size in 2D
        $width    = .26;  // barcode height in 1D ; not use in 2D
        $angle    = 0;   // rotation in degrees

        $code     = '222020';     // barcode (CP852 encoding for Polish and other Central European languages)
        $type     = 'code128';
        $black    = '000000'; // color in hex
        $Y = 3;
        $x = 5;
        $pdf->SetTextColor(0 ,0,0);
        $pdf->SetFont('Arial','B',14);
        $pdf->SetXY(18.2,8);
        $pdf->Cell(0, 0.2, "BOARD OF INTERMEDIATE & SECONDARY EDUCATION, GUJRANWALA", 0.25, "C");

        //Sr.No
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(10.8,15.9);
        $pdf->Cell(0, 0.2, "Sr.No. ", 0.25, "C"); 

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(26.2,15.4);
        $pdf->Cell(0, 0.2, "54623354441125452", 0.25, "C"); 

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(26.2,15.9);
        $pdf->Cell(0, 0.2, "_________________", 0.25, "C"); 
        //Result
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(10.8,21.9);
        $pdf->Cell(0, 0.2, "Result. ", 0.25, "C"); 

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(26.2,21.4);
        $pdf->Cell(0, 0.2, "  Pass", 0.25, "C"); 

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(26.2,21.9);
        $pdf->Cell(0, 0.2, "_________________", 0.25, "C"); 

        //Roll Number
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(130.2,15.9);
        $pdf->Cell(0, 0.2, "Roll No. ", 0.25, "C"); 

        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(146.2,15.4);
        $pdf->Cell(0, 0.2, "                     145265", 0.25, "C"); 

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(146.2,15.9);
        $pdf->Cell(0, 0.2, "________________________", 0.25, "C");  


        //Enrolment
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(130.2,21.9);
        $pdf->Cell(0, 0.2, "Registration No. ", 0.25, "C"); 

        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(163.2,21.4);
        $pdf->Cell(0, 0.2, "     2-1-654372-16", 0.25, "C"); 

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(163.2,21.9);
        $pdf->Cell(0, 0.2, "_________________", 0.25, "C"); 

        //barcode

        $Barcode = "123436@12@1@2016";

        $bardata = Barcode::fpdf($pdf, $black, $bx, $by, $angle, $type, array('code'=>$Barcode), $width, $height);

        $len = $pdf->GetStringWidth($bardata['hri']);
        Barcode::rotate(-$len / 2, ($bardata['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);


        //Logo

        $pdf->Image("assets/img/icon2.png",75,10, 53,45, "PNG");

        //Picture
        $pdf->Image($filepath,170.0,27.1, 30.65,30.65, "jpg");  


        $pdf->SetFont('Arial','B',14);
        $pdf->SetXY(63,50);
        $pdf->Cell(0, 0.2, "PROVISIONAL RESULT INTIMIATION", 0.25, "C"); 

        $pdf->SetFont('Arial','',14);
        $pdf->SetXY(63,50);
        $pdf->Cell(0, 0.2, "________________________________", 0.25, "C"); 


        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(47,57);
        $pdf->Cell(0, 0.2, "INTERMEDIATE Part (I/II) (   Annual   )  Examination, 2016", 0.25, "C"); 

        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(73,64);
        $pdf->Cell(0, 0.2, "Group", 0.25, "C"); 

        $pdf->SetFont('Arial','U',12);
        $pdf->SetXY(87,63.6);
        $pdf->Cell(0, 0.2, "                SCIENCE", 0.25, "C"); 

        $pdf->SetFont('Arial','U',12);
        $pdf->SetXY(87,63.6);
        $pdf->Cell(0, 0.2, "_______________________", 0.25, "C"); 



        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,73);
        $pdf->Cell(0, 0.2, "NAME:", 0.25, "C");


        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(20.2,73);
        $pdf->Cell(0, 0.2,"_______________________________________________________________________________________________________", 0.25, "C");
        $pdf->SetXY(50,73);
        $pdf->Cell(0, 0.2,"SHAHID NADEEM", 0.25, "C");


        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,81);
        $pdf->Cell(0, 0.2, "FATHER'S NAME:", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(36.2,81);
        $pdf->Cell(0, 0.2, "______________________________________________________________________________________________", 0.25, "C");

        $pdf->SetXY(50,81);
        $pdf->Cell(0, 0.2, "MUHAMMAD AKRAM", 0.25, "C");


        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,89);
        $pdf->Cell(0, 0.2, "DATE OF BIRTH:", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(36.2,89);
        $pdf->Cell(0, 0.2, "______________________________________________________________________________________________", 0.25, "C");

        $pdf->SetXY(50,89);
        $pdf->Cell(0, 0.2, "15-06-1985", 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,97);
        $pdf->Cell(0, 0.2, "INSTITUTION/DISTRICT:", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(47,97);
        $pdf->Cell(0, 0.2, "________________________________________________________________________________________", 0.25, "C");


        $pdf->SetXY(50,97);
        $pdf->Cell(0, 0.2, "Gujranwala", 0.25, "C");

        $pdf->SetFont('Arial','b',9);
        $pdf->SetXY(10.2,103);
        $pdf->Cell(0, 0.2, "Has secured the marks as detailed below against each subject.", 0.25, "C");

        $countter = 0;
        $countter9 = 0;
        $noteimageheight =62; 
        // THEOROR PART I SUBJECT TABLE
        if(1)
        {
            $boxWidth = 150.0;

            $pdf->SetFillColor(255,255,255);
            //Table cell Global varibales;
            $Y = 51;
            $cellheight = 10;
            $font = 9;

            $floatwidth = 15;

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(10.2,55.2+ $Y);
            $pdf->Cell(12,$cellheight,'Sr. No.',1,0,'C',1);

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(22.2,55.2+ $Y);
            $pdf->Cell(70.6,$cellheight,'Name of Subjects(S)',1,0,'L',1);

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(93,55.2+ $Y);
            $pdf->MultiCell($floatwidth,$cellheight/2,'Total Marks',1,'C');

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(108,55.2+ $Y);
            $pdf->MultiCell($floatwidth,$cellheight/2,'Part-I Theory',1,'C');

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(123,55.2+ $Y);
            $pdf->MultiCell($floatwidth,$cellheight/2,'Part-II Theory',1,'C');

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(138,55.2+ $Y);
            $pdf->MultiCell($floatwidth+1,$cellheight,'Practical',1,'C');

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(154,55.2+ $Y);
            $pdf->MultiCell($floatwidth+1,$cellheight,'Total',1,'C');

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(170,55.2+ $Y);
            $pdf->MultiCell($floatwidth+18,$cellheight/2,'Status',1,'C');

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(170,60.2+ $Y);
            $pdf->Cell(16.5,$cellheight/2,'I',1,0,'C',1);

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(186.5,60.2+ $Y);
            $pdf->Cell(16.5,$cellheight/2,'II',1,0,'C',1);




            for($l = 0; $l<7; $l++) { 
                $Y = $Y + $cellheight;

                $pdf->SetFont('Arial','',$font);
                $pdf->SetXY(10.2,55.2+ $Y);
                $pdf->Cell(12,$cellheight,$l+1,1,0,'C',1);

                $pdf->SetFont('Arial','',$font);
                $pdf->SetXY(22.2,55.2+ $Y);
                $pdf->Cell(70.6,$cellheight,"Health & Physical Education",1,0,'L',1);

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(93,55.2+ $Y);
                $pdf->MultiCell($floatwidth,$cellheight,'50',1,'C');

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(108,55.2+ $Y);
                $pdf->MultiCell($floatwidth,$cellheight,'38',1,'C');

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(123,55.2+ $Y);
                $pdf->MultiCell($floatwidth,$cellheight,'',1,'C');

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(138,55.2+ $Y);
                $pdf->MultiCell($floatwidth+1,$cellheight,'',1,'C');

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(154,55.2+ $Y);
                $pdf->MultiCell($floatwidth+1,$cellheight,'38',1,'C');

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(170,55.2+ $Y);
                $pdf->Cell(16.5,$cellheight,'P',1,0,'C',1);

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(186.5,55.2+ $Y);
                $pdf->Cell(16.5,$cellheight,'',1,0,'C',1);


            }         




           
        }

        $Y = $Y + $cellheight;

        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(10.2,55.2+ $Y);
        $pdf->Cell(82.8,$cellheight,'Total/OVERALL GRADE',1,0,'C',1);

        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(93,55.2+ $Y);
        $pdf->MultiCell($floatwidth,$cellheight,'1100',1,'C');

        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(108,55.2+ $Y);
        $pdf->MultiCell(46,$cellheight,'',1,'C');
        
        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(154,55.2+ $Y);
        $pdf->MultiCell($floatwidth+1,$cellheight,'657',1,'C');
        
        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(170,55.2+ $Y);
        $pdf->MultiCell($floatwidth+18,$cellheight,'Grade     A',1,'C');

        $pdf->SetFont('Arial','',$font+2);
        $pdf->SetXY(10,66.2+ $Y);
        $pdf->MultiCell(195,6,'ssdsfsd sd f sd f sdf sd fs df sdf ssdsfsd sd f sd f sdf sd fs df sdf ssdsfsd sd f sd f sdf sd fs df sdf ssdsfsd sd f sd f sdf sd fs df sdf ssdsfsd sd f sd f sdf sd fs df sdf',0,'L');
        
       
        
        $pdf->SetFont('Arial','B',$font+2);
        $pdf->SetXY(10,77.2+ $Y);
        $pdf->MultiCell(195,6,'Note:-',0,'L');
        
        $pdf->SetFont('Arial','',$font);
        $pdf->SetXY(10,81.2+ $Y);
        $pdf->MultiCell(195,4,'(I) ssdfsdfsdfsdfsd dsdgdgdfg  dfg d fgdf g df g fd gd f g dfg  fdg df g df g dfg d fg fdgdfgdffffffffffffffffffffg  dfg df g df g fd g dfg dfg fd g df g fdg df g dfg df g dfg ',0,'L');
        
        $pdf->SetFont('Arial','',$font);
        $pdf->SetXY(10,90.2+ $Y);
        $pdf->MultiCell(195,4,'(II) ssdfsdfsdfsdfsd dsdgdgdfg  dfg d fgdf g df g fd gd f g dfg  fdg df g df g dfg d fg fdgdfgdffffffffffffffffffffg  dfg df g df g fd g dfg dfg fd g df g fdg df g dfg df g dfg ',0,'L');
        
         $pdf->SetFont('Arial','',$font);
        $pdf->SetXY(10,99.2+ $Y);
        $pdf->MultiCell(195,4,'(III) ssdfsdfsdfsdfsd dsdgdgdfg  dfg d fgdf g df g fd gd f g dfg  fdg df g df g dfg d fg fdgdfgdffffffffffffffffffffg  dfg df g df g fd g dfg dfg fd g df g fdg df g dfg df g dfg ',0,'L');

        
        $pdf->Image("assets/img/result_note.jpg",45.2,105.2+ $Y, 153,10, "jpg"); 

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,120.2+ $Y);
        $pdf->Cell(0, 0.2, "Prepared By:", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(29.2,120.2+ $Y);
        $pdf->Cell(0, 0.2, "_____________________________________", 0.25, "C") ;
        
        
        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(100.2,120.2+ $Y);
        $pdf->Cell(0, 0.2, " Dated:", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(110.8,120.2+ $Y);
        $pdf->Cell(0, 0.2, "______________________", 0.25, "C") ;

         $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,130.2+ $Y);
        $pdf->Cell(0, 0.2, "Checked By:", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(29.2,130.2+ $Y);
        $pdf->Cell(0, 0.2, "_____________________________________", 0.25, "C") ;
      
      

        

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(10.2,140.2+ $Y);
        $pdf->Cell(0, 0.2, " HOME ADDRESS:", 0.25, "C");    

         $pdf->SetFont('Arial','u',10);
        $pdf->SetXY(41.6,137.2+ $Y);
        $pdf->MultiCell(120, 5, 'address dfsdfsdf  sd f sd fsd fs df   sdf sd f sd f sd fsd f sd fs df s df sdf sd fs df sd f sd fs df s df sd f .', 0, "L",0);
        

        $pdf->Image("assets/img/CE_Signature.png",163.0,247, 35,35, "PNG"); 

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(147,284);
        $pdf->Cell(0, 0.2, "CONTROLLER OF EXAMINATIONS", 0.25, "C");


    }



    public function maresult()
    {
        // DebugBreak();
        $this->load->helper('url');

        $data = array(); 
        $info = array(); 

        if(!empty($_POST) )
        {
            $this->load->model('Result_model');
            $data = $this->Result_model->getresult($_POST['keyword'],$_POST['check']); 
            if($data == -1)
            {
                $info['isfound'] =-1;
            }
            else 
            {
                $info['result'] = $data;
            }

        }




        $info['callback']= $_POST;
        $this->load->view('Result/maresult.php',$info); 

    }
    public function Result_Print_datagrid()
    {
        //DebugBreak();
        $this->load->helper('url');
        $rno = $this->uri->segment(3);
        $this->load->model('Result_model');
        $data = $this->Result_model->getresult($rno,2); 
        if($data == -1)
        {
            $info['isfound'] =-1;
        }
        else 
        {

            $info['result'] = $data;
            $info['isfound'] =1;


        }
        $this->load->view('Result/singleres.php',$info);
    }
    public function showresult()
    {

        $this->load->helper('url');

        $this->load->view('Result/showresult.php');
        //$_POST
    }

}