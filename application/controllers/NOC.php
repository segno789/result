<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NOC extends CI_Controller {

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
        /*$this->load->library('session');
        if( !$this->session->userdata('logged_in') && $this->router->method != 'login' ) {
            redirect('login');
        }*/
    }
    public function index()
    {
       // DebugBreak();
      /* // 
        $this->load->helper('url');

        $data = array(); 
        $info = array(); 

        $this->load->library('PDFFWithOutPage');
        $pdf=new PDFFWithOutPage();   
        $pdf->SetAutoPageBreak(true,2);
        $pdf->AddPage('L',"A4");
        $this->makeNoc($pdf,$info);
         $pdf->Output('Result.pdf', 'I');  
         */
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

        $this->load->view('common/commonheader_Verification.php');
        $mydata = array('error'=>$error);

        $this->load->view('NOC/default.php',$mydata);

       $this->load->view('common/verfooter.php');
    }
      private function makeNoc($pdf,$info)
    {

        $Session= 'ANNUAL';  
        $info['Year'] = 2016;     



        $filepath = 'assets/img/download.jpg';


        $fontSize = 10; 
        $marge    = .95;   // between barcode and hri in pixel
        $bx        = 90.6;  // barcode center
        $by        = 77.75;  // barcode center
        $height   = 5.7;   // barcode height in 1D ; module size in 2D
        $width    = .26;  // barcode height in 1D ; not use in 2D
        $angle    = 0;   // rotation in degrees

        $code     = '222020';     // barcode (CP852 encoding for Polish and other Central European languages)
        $type     = 'code128';
        $black    = '000000'; // color in hex
        $Y = 3;
        $x = 5;
        
        //Left Side
        $dotx= 113.8;
        $pdf->Image("assets/img/border.png",5,3, 122,205, "PNG");
        $pdf->Image("assets/img/dots.png",$dotx,7.5, 30,40, "PNG");
        $pdf->Image("assets/img/dots.png",$dotx,47.5, 30,40, "PNG");
        $pdf->Image("assets/img/dots.png",$dotx,87.5, 30,40, "PNG");
        $pdf->Image("assets/img/dots.png",$dotx,127.5, 30,40, "PNG");
        $pdf->Image("assets/img/dots.png",$dotx,167.5, 30,40, "PNG");
        
        $pdf->SetTextColor(0 ,0,0);
        $pdf->SetFont('Arial','U',14);
        $pdf->SetXY(.1,18);
        $pdf->MultiCell(130, 5,"BOARD OF INTERMEDIATE & SECONDARY EDUCATION, GUJRANWALA", '', "C",0);
        $pdf->Image("assets/img/icon2.png",6,30, 38,36, "PNG");
        
        $pdf->SetFont('Arial','B',11);
        $pdf->SetXY(38.2,40);
        $pdf->Cell(0, 0.2, "MIGRATION CERTIFICATE", 0.25, "C");
        
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(56.2,45);
        $pdf->Cell(0, 0.2, "(NOC)", 0.25, "C");
        $pdf->Image($filepath,90,33, 30,35, "jpg");
        
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(10.2,70);
        $pdf->Cell(0, 0.2, "Sr.No.", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(20.2,70);
        $pdf->Cell(0, 0.2, "____________________", 0.25, "C");
        
        //barcode
        
        $Barcode = "125865@9@1@2016";

        $bardata = Barcode::fpdf($pdf, $black, $bx, $by, $angle, $type, array('code'=>$Barcode), $width, $height);

        $len = $pdf->GetStringWidth($bardata['hri']);
        Barcode::rotate(-$len / 2, ($bardata['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
        
        $pdf->SetFillColor(255,0,0);
        // $pdf->SetLineWidth(.005);
        $pdf->SetAlpha(.2);
        $pdf->Image("assets/img/icon2.png",18,80, 100,100, "PNG");
        $pdf->SetAlpha(1);
        
        
        
        $rx = 14.2;
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,85);
        $pdf->Cell(0, 0.2, "Name:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+30,82.8);
        $pdf->MultiCell(100, 5,"Shahid Nadeem", '', "L",0);
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,95);
        $pdf->Cell(0, 0.2, "Father's Name:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+30,92.8);
        $pdf->MultiCell(100, 5,"Mohammad Akram", '', "L",0);
        
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,105);
        $pdf->Cell(0, 0.2, "Enrolment No:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+30,102.8);
        $pdf->MultiCell(100, 5,"2-1-134526-16", '', "L",0);
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,115);
        $pdf->Cell(0, 0.2, "Roll No:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+30,112.8);
        $pdf->MultiCell(100, 5,"158745 SSC-I Annual 2016 Pass", '', "L",0);
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,125);
        $pdf->Cell(0, 0.2, "Issued For:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+30,122.8);
        $pdf->MultiCell(90, 5,"BOARD OF INTERMEDIATE & SECONDARY EDUCATION, LAHORE", '', "L",0);
        
        $pdf->SetFont('Arial','B',11);
        $pdf->SetXY($rx,140);
        $pdf->Cell(0, 0.2, "Fee Details", 0.25, "C");
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,150);
        $pdf->Cell(0, 0.2, "Challan No:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+30,147.8);
        $pdf->MultiCell(100, 5,"1254621", '', "L",0);
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,155);
        $pdf->Cell(0, 0.2, "Date:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+30,152.8);
        $pdf->MultiCell(100, 5,"09 September, 2016", '', "L",0);
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,160);
        $pdf->Cell(0, 0.2, "Amount:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+30,157.8);
        $pdf->MultiCell(100, 5,"Rs. 1650/-", '', "L",0);
        
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(10.2,190);
        $pdf->Cell(0, 0.2, "_______________", 0.25, "C");
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(20.2,195);
        $pdf->Cell(0, 0.2, "Dated", 0.25, "C");
        
        
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(48.2,190);
        $pdf->Cell(0, 0.2, "_______________", 0.25, "C");
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(58.2,195);
        $pdf->Cell(0, 0.2, "Official", 0.25, "C");
        
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(86.2,190);
        $pdf->Cell(0, 0.2, "______________", 0.25, "C");
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(88.2,195);
        $pdf->Cell(0, 0.2, "Superintendent", 0.25, "C");
        
          
        
        //Right Side
        $pdf->Image("assets/img/border.png",130,3, 163,205, "PNG");
        $pdf->SetTextColor(0 ,0,0);
        $pdf->SetFont('Arial','U',14);
        $pdf->SetXY(134.2,18);
        $pdf->MultiCell(160, 5,"BOARD OF INTERMEDIATE & SECONDARY EDUCATION, GUJRANWALA", '', "C",0);
        $pdf->Image("assets/img/icon2.png",135,30, 38,36, "PNG");
        $pdf->SetFont('Arial','B',11);
        $pdf->SetXY(185.2,40);
        $pdf->Cell(0, 0.2, "MIGRATION CERTIFICATE", 0.25, "C");

        $pdf->Image($filepath,250,30, 30,35, "jpg");
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(205.2,44);
        $pdf->Cell(0, 0.2, "(NOC)", 0.25, "C");
        
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(140.2,70);
        $pdf->Cell(0, 0.2, "Sr.No.", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(150.2,70);
        $pdf->Cell(0, 0.2, "_______________________", 0.25, "C");
        
         $bx        = 240.6;  // barcode center
      
         $bardata = Barcode::fpdf($pdf, $black, $bx, $by, $angle, $type, array('code'=>$Barcode), $width, $height);

        $len = $pdf->GetStringWidth($bardata['hri']);
        Barcode::rotate(-$len / 2, ($bardata['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
        
        
        
        $pdf->SetAlpha(.2);
        $pdf->Image("assets/img/icon2.png",158,80, 100,100, "PNG");
        $pdf->SetAlpha(1);
        
        $rx = 150.2;
        $ry = 100;
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,$ry);
        $pdf->Cell(0, 0.2, "Name of Candidate:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+40,$ry-2.8);
        $pdf->MultiCell(100, 5,"Shahid Nadeem", '', "L",0);
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,$ry+10);
        $pdf->Cell(0, 0.2, "Father's Name:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+40,$ry+10-2.8);
        $pdf->MultiCell(100, 5,"Mohammad Akram", '', "L",0);
        
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,$ry+20);
        $pdf->Cell(0, 0.2, "Enrolment No:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+40,$ry+20-2.8);
        $pdf->MultiCell(100, 5,"2-1-134526-16", '', "L",0);
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,$ry+30);
        $pdf->Cell(0, 0.2, "Roll No:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+40,$ry+30-2.8);
        $pdf->MultiCell(100, 5,"158745 SSC-I Annual 2016 Pass", '', "L",0);
        

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY($rx,$ry+40);
        $pdf->MultiCell(118, 5,"The Candidate is permitted to migrate from the Jurisdiction of the Board for Studies or apperance in an examination from", '', "J",0);
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx,$ry+50);
        $pdf->MultiCell(125, 5,"BOARD OF INTERMEDIDATE AND SECONDARY EDUCATION, LAHORE.", '', "L",0);
        
        
        
        
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(136.2,192);
        $pdf->Cell(0, 0.2, "Dated", 0.25, "C");
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(147.2,192);
        $pdf->Cell(0, 0.2, "___________", 0.25, "C");



        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(178.2,192);
        $pdf->Cell(0, 0.2, "Official", 0.25, "C");

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(191.2,192);
        $pdf->Cell(0, 0.2, "_____________", 0.25, "C");


        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(225.2,192);
        $pdf->Cell(0, 0.2, "Superintendent", 0.25, "C");
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(254.2,192);
        $pdf->Cell(0, 0.2, "_____________", 0.25, "C"); 

        
        
      
    }
    private function makeNocLegal($pdf,$info)
    {

        $Session= 'ANNUAL';  
        $info['Year'] = 2016;     



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
        
        //Left Side
        $pdf->Image("assets/img/border.png",2,3, 155,210, "PNG");
        $pdf->Image("assets/img/dots.png",143.8,7.5, 30,40, "PNG");
        $pdf->Image("assets/img/dots.png",143.8,47.5, 30,40, "PNG");
        $pdf->Image("assets/img/dots.png",143.8,87.5, 30,40, "PNG");
        $pdf->Image("assets/img/dots.png",143.8,127.5, 30,40, "PNG");
        $pdf->Image("assets/img/dots.png",143.8,167.5, 30,40, "PNG");
        $pdf->SetTextColor(0 ,0,0);
        $pdf->SetFont('Arial','U',15);
        $pdf->SetXY(.1,18);
        $pdf->MultiCell(160, 5,"BOARD OF INTERMEDIATE & SECONDARY EDUCATION, GUJRANWALA", '', "C",0);
        $pdf->Image("assets/img/icon2.png",4,30, 38,40, "PNG");
       
        
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(52.2,44);
        $pdf->Cell(0, 0.2, "MIGRATION CERTIFICATE", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(72.2,54);
        $pdf->Cell(0, 0.2, "(NOC)", 0.25, "C");
        $pdf->Image($filepath,120,30, 28,35, "jpg");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(10.2,70);
        $pdf->Cell(0, 0.2, "Sr.No.", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(20.2,70);
        $pdf->Cell(0, 0.2, "__________________________", 0.25, "C");
        
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(20.2,85);
        $pdf->Cell(0, 0.2, "Name:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(50.2,82.8);
        $pdf->MultiCell(100, 5,"Shahid Nadeem", '', "L",0);
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(20.2,95);
        $pdf->Cell(0, 0.2, "Father's Name:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(50.2,92.8);
        $pdf->MultiCell(100, 5,"Mohammad Akram", '', "L",0);
        
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(20.2,105);
        $pdf->Cell(0, 0.2, "Enrolment No:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(50.2,102.8);
        $pdf->MultiCell(100, 5,"2-1-134526-16", '', "L",0);
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(20.2,115);
        $pdf->Cell(0, 0.2, "Roll No:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(50.2,112.8);
        $pdf->MultiCell(100, 5,"158745 SSC-I Annual 2016 Pass", '', "L",0);
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(20.2,125);
        $pdf->Cell(0, 0.2, "Issued For:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(50.2,122.8);
        $pdf->MultiCell(100, 5,"BOARD OF INTERMEDIATE & SECONDARY EDUCATION, LAHORE", '', "L",0);
        
        $pdf->SetFont('Arial','B',11);
        $pdf->SetXY(20.2,140);
        $pdf->Cell(0, 0.2, "Fee Details", 0.25, "C");
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(20.2,150);
        $pdf->Cell(0, 0.2, "Challan No:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(50.2,147.8);
        $pdf->MultiCell(100, 5,"1254621", '', "L",0);
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(20.2,155);
        $pdf->Cell(0, 0.2, "Date:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(50.2,152.8);
        $pdf->MultiCell(100, 5,"09 September, 2016", '', "L",0);
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(20.2,160);
        $pdf->Cell(0, 0.2, "Amount:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(50.2,157.8);
        $pdf->MultiCell(100, 5,"Rs. 1650/-", '', "L",0);
        
        
        
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(8.2,193);
        $pdf->Cell(0, 0.2, "_______________", 0.25, "C");
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(20.2,198);
        $pdf->Cell(0, 0.2, "Dated", 0.25, "C");
        
        
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(55.2,193);
        $pdf->Cell(0, 0.2, "_______________", 0.25, "C");
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(65.2,198);
        $pdf->Cell(0, 0.2, "Official", 0.25, "C");
        
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(108.2,193);
        $pdf->Cell(0, 0.2, "_______________", 0.25, "C");
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(112.2,198);
        $pdf->Cell(0, 0.2, "Superintendent", 0.25, "C");
        
        
        
        //Right Side
        $pdf->Image("assets/img/border.png",160,3, 195,210, "PNG");
        $pdf->SetTextColor(0 ,0,0);
        $pdf->SetFont('Arial','U',15);
        $pdf->SetXY(178.2,18);
        $pdf->MultiCell(160, 5,"BOARD OF INTERMEDIATE & SECONDARY EDUCATION, GUJRANWALA", '', "C",0);
        $pdf->Image("assets/img/icon2.png",164,30, 38,40, "PNG");
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(230.2,44);
        $pdf->Cell(0, 0.2, "MIGRATION CERTIFICATE", 0.25, "C");
        $pdf->Image($filepath,300,30, 28,35, "jpg");
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(252.2,54);
        $pdf->Cell(0, 0.2, "(NOC)", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(170.2,70);
        $pdf->Cell(0, 0.2, "Sr.No.", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(180.2,70);
        $pdf->Cell(0, 0.2, "__________________________", 0.25, "C");
        
        
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(190.2,85);
        $pdf->Cell(0, 0.2, "Name of Candidate:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(240.2,82.8);
        $pdf->MultiCell(100, 5,"Shahid Nadeem", '', "L",0);
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(190.2,95);
        $pdf->Cell(0, 0.2, "Father's Name:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(240.2,92.8);
        $pdf->MultiCell(100, 5,"Mohammad Akram", '', "L",0);
        
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(190.2,105);
        $pdf->Cell(0, 0.2, "Enrolment No:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(240.2,102.8);
        $pdf->MultiCell(100, 5,"2-1-134526-16", '', "L",0);
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(190.2,115);
        $pdf->Cell(0, 0.2, "Roll No:", 0.25, "C");
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(240.2,112.8);
        $pdf->MultiCell(100, 5,"158745 SSC-I Annual 2016 Pass", '', "L",0);
        
       
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(168.2,198);
        $pdf->Cell(0, 0.2, "Dated", 0.25, "C");
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(179.2,198);
        $pdf->Cell(0, 0.2, "_______________", 0.25, "C");
        
        
        
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(222.2,198);
        $pdf->Cell(0, 0.2, "Official", 0.25, "C");
        
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(235.2,198);
        $pdf->Cell(0, 0.2, "_______________", 0.25, "C");
        
       
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(279.2,198);
        $pdf->Cell(0, 0.2, "Superintendent", 0.25, "C");
         $pdf->SetFont('Arial','',12);
        $pdf->SetXY(308.2,198);
        $pdf->Cell(0, 0.2, "_______________", 0.25, "C");


    }
    private function makeNocform($pdf,$info)
    {

        $Session= 'ANNUAL';  
        $info['Year'] = 2016;     



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




    }
    private function makeResultCard9th($pdf,$info)
    {
        //
        //DebugBreak();
        // if($info['Session'] ==1) $Session= 'ANNUAL'; else $Session='SUPPLY';
        $Session= 'ANNUAL';  
        $info['Year'] = 2016;     

        if($info['grp_cd'] == 1)  
        $grp_cd = 'SCIENCE'; 
        else if($info['grp_cd'] == 2) 
        $grp_cd='GENERAL';
        else if($info['grp_cd'] == 5) 
        $grp_cd='DEAF & DEFECTIVE';
        
       /* if($info['Gender']==1) $Gender= 'MALE'; 
        else if($info['Gender']==2) $Gender= 'FEMALE';*/
         //   $filepath = $info['picpath'];
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
        $pdf->Cell(0, 0.2, "     ".$info['rno'], 0.25, "C"); 

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(30.2,15.9);
        $pdf->Cell(0, 0.2, "____________", 0.25, "C"); 
        //Enrolment
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(134.2,15.9);
        $pdf->Cell(0, 0.2, "Enrolment No. ", 0.25, "C"); 

        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(163.2,15.4);
        $pdf->Cell(0, 0.2, "     ".$info['strRegNo'], 0.25, "C"); 

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(163.2,15.9);
        $pdf->Cell(0, 0.2, "_________________", 0.25, "C"); 

        //barcode

        $Barcode = $info['rno']."@9@1@".$info['Year'];

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
        $pdf->Cell(0, 0.2, "Secondary School Part-1 (9th - Class) Annual Examination, ".$info['Year'], 0.25, "C"); 

        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(73,64);
        $pdf->Cell(0, 0.2, "Group", 0.25, "C"); 

        $pdf->SetFont('Arial','U',12);
        $pdf->SetXY(87,63.6);
        $pdf->Cell(0, 0.2, "                ".$grp_cd, 0.25, "C"); 

        $pdf->SetFont('Arial','U',12);
        $pdf->SetXY(87,63.6);
        $pdf->Cell(0, 0.2, "_______________________", 0.25, "C"); 



        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,71);
        $pdf->Cell(0, 0.2, "NAME:", 0.25, "C");

        $fontsize = 10;

        $pdf->SetFont('Arial','',$fontsize);
        $pdf->SetXY(20.2,71);
        $pdf->Cell(0, 0.2,"____________________________________________________________________________________________", 0.25, "C");
        $pdf->SetXY(50,71);
        $pdf->Cell(0, 0.2,"".$info['name'], 0.25, "C");


        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,79);
        $pdf->Cell(0, 0.2, "FATHER'S NAME:", 0.25, "C");

        $pdf->SetFont('Arial','',$fontsize);
        $pdf->SetXY(36.2,79);
        $pdf->Cell(0, 0.2, "____________________________________________________________________________________", 0.25, "C");

        $pdf->SetXY(50,79);
        $pdf->Cell(0, 0.2, "".$info['Fname'], 0.25, "C");


        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,87);
        $pdf->Cell(0, 0.2, "DATE OF BIRTH:", 0.25, "C");

        $pdf->SetFont('Arial','',$fontsize);
        $pdf->SetXY(36.2,87);
        $pdf->Cell(0, 0.2, "____________________________________________________________________________________", 0.25, "C");

      
        
        $day = date("d", strtotime($info['Dob']));
        $year = date("Y", strtotime($info['Dob']));
     //   DebugBreak();
        $this->load->library('NumbertoWord');
        $obj    = new NumbertoWord();
         $obj->toWords($day,"",""); 
         
        $day = ucwords($obj->words);
        
        $year = $obj->toWords($year,"",""); 
        
        $year = ucwords($obj->words);
        
        $pdf->SetXY(50,87);
        $pdf->Cell(0, 0.2, "".date('d-m-Y',strtotime($info['Dob']))." ( ".$day."".date("F", strtotime($info['Dob']))." ".$year." )", 0.25, "C");

       


      
        //$pdf->Cell(0, 0.2, "".$info['Sch_cd'].' - '.$info['sch_name'], 0.25, "L");
        
        $instnfo =  $info['Sch_cd'].' - '.$info['sch_name'];
        $valig = 94;
        if(strlen($instnfo)>80)
        {
            $fontsize = $fontsize -1;
        }
        if(strlen($instnfo)>95)
        {
            $valig =  90;
            
        }
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,97);
        $pdf->Cell(0, 0.2, "INSTITUTION:", 0.25, "C");

        $pdf->SetFont('Arial','',$fontsize);
        $pdf->SetXY(30,97);
        if($fontsize>=10)
        $pdf->Cell(0, 0.2, "_______________________________________________________________________________________", 0.25, "C");
        else
        {
        $pdf->Cell(0, 0.2, "_________________________________________________________________________________________________", 0.25, "C");
        }
        
        
        
        $pdf->SetXY(34,$valig);
        
        $pdf->MultiCell(175, 4,$instnfo.'', 0, "L",0);

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,103);
        $pdf->Cell(0, 0.2, "Has secured the marks as detailed below against each subject.", 0.25, "C");

        $countter = 0;
        $countter9 = 0;
        $noteimageheight =62; 
      //  DebugBreak();
       $pdf->SetFillColor(255,0,0);
      // $pdf->SetLineWidth(.005);
        $pdf->SetAlpha(.6);
        $pdf->Image("assets/img/icon2.png",55,105, 120,100, "PNG");
      $pdf->SetAlpha(.9);
      $pdf->SetTextColor(0,0,0);
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
            $pdf->Cell(78,$cellheight,'Name of Subjects(S)',1,0,'L',1);

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(100,55.2+ $Y);
            $pdf->Cell(20,$cellheight,'Total Marks',1,0,'C',1);

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(120.1,55.2+ $Y);
            $pdf->Cell(27,$cellheight,'Marks Obtained',1,0,'C',1);

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(147,55.2+ $Y);
            $pdf->Cell(58,$cellheight,'Remarks',1,0,'C',1);

            $subctn = 1;
            $totalmarks = '';
            for($l = 0; $l<8; $l++) { 
                $Y = $Y + $cellheight;
                $subcd = $info['sub'.$subctn];
                $submarks = $info['sub'.$subctn.'mt1'];
                $subremarks = $info['sub'.$subctn.'remarks'];

                if($subremarks == NULL)
                {
                    $subremarks = ' ';
                }
                 if($subremarks == 'Absent')
                {
                  $submarks = 'A';  
                }
                $subname = $this->GetSubNameHere($subcd) ;
                $subtoltal = $this->Get9thSubMarks($subcd) ;
                $totalmarks = $totalmarks + $subtoltal;
                $pdf->SetFont('Arial','',$font);
                $pdf->SetXY(10.2,55.2+ $Y);
                $pdf->Cell(12,$cellheight,$l+1,1,0,'C',1);

                $pdf->SetFont('Arial','',$font);
                $pdf->SetXY(22.2,55.2+ $Y);
                $pdf->Cell(78,$cellheight,$subname,1,0,'L',1);

                $pdf->SetFont('Arial','',$font);
                $pdf->SetXY(100,55.2+ $Y);
                $pdf->Cell(20,$cellheight,$subtoltal,1,0,'C',1);

                $pdf->SetFont('Arial','',$font);
                $pdf->SetXY(120.1,55.2+ $Y);
                $pdf->Cell(27,$cellheight,$submarks,1,0,'C',1);

                $pdf->SetFont('Arial','',$font);
                $pdf->SetXY(147,55.2+ $Y);
                $pdf->Cell(58,$cellheight, $subremarks,1,0,'C',1);
                $subctn++;
            }



        }

        $Y = $Y + $cellheight;

        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(10.2,55.2+ $Y);
        $pdf->Cell(90,$cellheight,'Total:',1,0,'R',1);

        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(100,55.2+ $Y);
        $pdf->Cell(20,$cellheight,$totalmarks,1,0,'C',1);
        $result1 ='';
        if($info['status'] == 1)
        {
           $result1 = $info['result1']; 
        }
        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(120.1,55.2+ $Y);
        $pdf->Cell(27,$cellheight,$result1,1,0,'C',1);

        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(147,55.2+ $Y);
        $pdf->Cell(58,$cellheight,'',1,0,'C',1);

        
        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(10.2,63.2+ $Y);
        $pdf->Cell(90,$cellheight,'Notification:',1,0,'R',1);
        
        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(100.1,63.2+ $Y);
        $pdf->Cell(105,$cellheight,"       ".$info['result1'],1,0,'L',1);
         $pdf->SetAlpha(1);
        $nextyear= $info["Year"] +1;

        $pdf->SetFont('Arial','',11);
        $pdf->SetXY(9.2,196);
        $pdf->MultiCell(195, 5, 'The candidate may appear in subject(s) having less than pass marks along with Secondary School Part-II (Annual) Examination, '.$nextyear.' otherwise his/her final result (Pass/Fail) in subjects(s) will be determined on the basis of total marks obtained by him/her  Secondary School Part-I & Part-II.', 0, "J",0);

        $pdf->Image("assets/img/result_note.jpg",45.2,211, 153,10, "jpg"); 

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,223);
        $pdf->Cell(0, 0.2, "Dealing Official:", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(32.2,223);
        $pdf->Cell(0, 0.2, "_______________________________________________________________________________________", 0.25, "C");
        
           $pdf->SetFont('Arial','',10);
        $pdf->SetXY(32.2,222.8);
        $pdf->Cell(0, 0.2, "            ".$info['Emp_Rslt'].'-'.$info['emp_name'], 0.25, "C") ;

        
         $pdf->SetFont('Arial','',9);
        $pdf->SetXY(100.2,233);
        $pdf->Cell(0, 0.2, "Printing Date:", 0.25, "C");
        
        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(120.2,233);
        $pdf->Cell(0, 0.2, "_____________________________________", 0.25, "C");
        
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(120.2,232.8);
        $pdf->Cell(0, 0.2, "               ".date('d-m-Y h:i a'), 0.25, "C");
        
        /*$pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,233);
        $pdf->Cell(0, 0.2, "Checked By:", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(29.2,233);
        $pdf->Cell(0, 0.2, "_____________________________________", 0.25, "C");*/

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,233);
        $pdf->Cell(0, 0.2, "Result Date:", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(27,233);
        $pdf->Cell(0, 0.2, "_____________________________________", 0.25, "C");
        
        $pdf->SetFont('Arial','',10);
         $pdf->SetXY(20.2,232.8);
        $pdf->Cell(0, 0.2, '                    20-08-2016', 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(35.2,238);
        $pdf->Cell(0, 0.2, "(Errors & Omissions are excepted)", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(10.2,248);
        $pdf->Cell(0, 0.2, " HOME ADDRESS:", 0.25, "C");

        $pdf->SetFont('Arial','u',10);
        $pdf->SetXY(41.6,245);
        $pdf->MultiCell(125, 5, $info['addr'], 0, "L",0);


        $pdf->Image("assets/img/CE_Signature.png",163.0,247, 38,36, "JPG"); 

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(145,284);
        $pdf->Cell(0, 0.2, "CONTROLLER OF EXAMINATIONS", 0.25, "C");
        
          $pdf->Image("assets/img/headsign.jpg",28.0,255, 72,24, "JPG"); 


    }

    private function makeResultCard12th($pdf,$info)
    {
        //
        // if($info['Session'] ==1) $Session= 'ANNUAL'; else $Session='SUPPLY';
        $Session= 'ANNUAL';  
        $info['Year'] = 2016;     

       if($info['grp_cd'] == 1)  $grp_cd = 'PRE-MEDICAL';
        else if($info['grp_cd'] == 2) $grp_cd='PRE-ENGINEERING';
        else if($info['grp_cd'] == 3) $grp_cd='HUMANITIES';
        else if($info['grp_cd'] == 4) $grp_cd='GENERAL SCIENCE';
        else if($info['grp_cd'] == 5) $grp_cd='COMMERCE';
        else if($info['grp_cd'] == 6) $grp_cd='ISLAMIC STUDIES';
        else if($info['grp_cd'] == 7) $grp_cd='HOME ECONOMICS';
        else if($info['grp_cd'] == 8) $grp_cd='MEDICAL TECHNOLGY';
        else if($info['grp_cd'] == 9) $grp_cd='ALOOM-E-SHARQIA';
        else if($info['grp_cd'] == 10) $grp_cd='KHASA';
        else if($info['grp_cd'] == 11) $grp_cd='FAZAL';
        $filepath = $info['picpath'];
        //$filepath = 'assets/img/download.jpg';
        $ispass = '';
        if($info['status'] ==  1)
        {
           $ispass = 'Pass'; 
        }
        else if($info['status'] ==  2 || $info['status'] ==  3 )
        {
             $ispass = 'Fail'; 
        } 
        
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
        $pdf->Cell(0, 0.2, "Form No. ", 0.25, "C"); 

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(28.8,15.4);
        $pdf->Cell(0, 0.2, "   ".$info['formNo'], 0.25, "C"); 

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(28.8,15.9);
        $pdf->Cell(0, 0.2, "_______________", 0.25, "C"); 
        //Result
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(10.8,21.9);
        $pdf->Cell(0, 0.2, "Result. ", 0.25, "C"); 

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(24.2,21.4);
        $pdf->Cell(0, 0.2, "       ".$ispass, 0.25, "C"); 

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(24.2,21.9);
        $pdf->Cell(0, 0.2, "_________________", 0.25, "C"); 

        //Roll Number
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(130.2,15.9);
        $pdf->Cell(0, 0.2, "Roll No. ", 0.25, "C"); 

        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(146.2,15.4);
        $pdf->Cell(0, 0.2, "                     ".$info['rno'], 0.25, "C"); 

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(146.2,15.9);
        $pdf->Cell(0, 0.2, "________________________", 0.25, "C");  


        //Enrolment
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(130.2,21.9);
        $pdf->Cell(0, 0.2, "Registration No. ", 0.25, "C"); 

        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(163.2,21.4);
        $pdf->Cell(0, 0.2, "     ".$info['strRegNo'], 0.25, "C"); 

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(163.2,21.9);
        $pdf->Cell(0, 0.2, "_________________", 0.25, "C"); 

        //barcode

        $Barcode = $info['rno']."@12@1@2016";

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
        $pdf->Cell(0, 0.2, "INTERMEDIATE Part (I/II) (   Annual   )  Examination, ". $info['Year'], 0.25, "C"); 

        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(73,64);
        $pdf->Cell(0, 0.2, "Group", 0.25, "C"); 

        $pdf->SetFont('Arial','U',12);
        $pdf->SetXY(87,63.6);
        $pdf->Cell(0, 0.2, "     ".$grp_cd, 0.25, "C"); 

        $pdf->SetFont('Arial','U',12);
        $pdf->SetXY(87,63.6);
        $pdf->Cell(0, 0.2, "_______________________", 0.25, "C"); 



        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,71);
        $pdf->Cell(0, 0.2, "NAME:", 0.25, "C");


        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(20.2,71);
        $pdf->Cell(0, 0.2,"_______________________________________________________________________________________________________", 0.25, "C");
        $pdf->SetXY(50,71);
        $pdf->Cell(0, 0.2,"".$info['name'], 0.25, "C");


        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,78);
        $pdf->Cell(0, 0.2, "FATHER'S NAME:", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(36.2,78);
        $pdf->Cell(0, 0.2, "______________________________________________________________________________________________", 0.25, "C");

        $pdf->SetXY(50,78);
        $pdf->Cell(0, 0.2, "".$info['Fname'], 0.25, "C");


      /*  $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,89);
        $pdf->Cell(0, 0.2, "INSTITUTION/DISTRICT:", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(46.2,89);
        $pdf->Cell(0, 0.2, "________________________________________________________________________________________", 0.25, "C");

        $pdf->SetXY(50,89);
        $pdf->Cell(0, 0.2, "".$info['sch_name'], 0.25, "C");*/

       $fontsize = 10;
       //DebugBreak();
        $instnfo =  $info['coll_cd'].' - '.$info['sch_name'];
       
             
        $valig = 83;
        if(strlen($instnfo)>80)
        {
            $fontsize = $fontsize-1;
        }
        if(strlen($instnfo)>95)
        {
            $valig =  80;
            
        }
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,86);
        $pdf->Cell(0, 0.2, "INSTITUTION:", 0.25, "C");

        $pdf->SetFont('Arial','',$fontsize);
        $pdf->SetXY(30.2,86);
        if($fontsize>=10)
        $pdf->Cell(0, 0.2, "________________________________________________________________________________________", 0.25, "C");
        else
        {
        $pdf->Cell(0, 0.2, "_________________________________________________________________________________________________", 0.25, "C");
        }
        
        
        
        $pdf->SetXY(33,$valig);
        
        $pdf->MultiCell(170, 4,$instnfo.'', 0, "L",0);

     
        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY(10.2,91);
        $pdf->Cell(0, 0.2, "Has secured the marks as detailed below against each subject.", 0.25, "C");

        $countter = 0;
        $countter9 = 0;
        $noteimageheight =62; 

        // $pdf->SetFillColor(255,0,0);
        // $pdf->SetLineWidth(.005);
        $pdf->SetAlpha(.1);
        $pdf->Image("assets/img/icon2.png",55,92, 120,100, "PNG");
        $pdf->SetAlpha(1);
     // $pdf->SetTextColor(0,0,0);
        
        // THEOROR PART I SUBJECT TABLE
        if(1)
        {
            $boxWidth = 150.0;

            $pdf->SetFillColor(255,255,255);
            //Table cell Global varibales;
            $Y = 39;
            $cellheight = 10;
            $font = 9;

            $floatwidth = 15;

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(10.2,55.2+ $Y);
            $pdf->Cell(12,$cellheight,'Sr. No.',1,0,'C',1);

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(22.2,55.2+ $Y);
            //$pdf->Cell(70.6,$cellheight,'',1,0,'L',1);
            $pdf->MultiCell(70.6,$cellheight,'Name of Subjects(S)',1,'L');

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

            $subctn = 0;
            $totalmarks = '';
            $obtainmarkstotal = '';
            $subtotal = '';
            $subjectstaus1 = '';
            $subjectstaus2 = '';
            $subinduTotal = '';
            $subprst = '';
            $count = 7;
            $subP1 = '';
            $subP2 = '';
            $cellheightnew = '';
            if($info['grp_cd'] == 5)
            {
                $count = 8;
            }
            for($l = 0; $l<$count; $l++) {

                $subNo = '';
                $subinduTotal = '';
                $Y = $Y + $cellheight;
                if($l == 0 )
                {
                    $subcd = $info['sub3'];
                    if($info['sub3st1'] == 2)
                    {
                        $submarks = 'A';  
                    }
                    else
                    {
                        $submarks = $info['sub3mt1'];
                    }

                    $subjectstaus1 = $this->subStatus($info['sub3pf1']);

                    if($info['sub3pf1'] == 1 || $info['sub3pf1'] == 2)
                    {
                        $subinduTotal =  $submarks;
                    }
                    $subjectstaus2 = '';


                    $submarks2 = '';//$info['sub'.$subctn.'mt2']; 
                    $subtotal = 50;
                }
                else if($l == 1 )
                {
                    //  DebugBreak();
                    $subcd = $info['sub8'];

                    if($info['sub8st2'] == 2)
                    {
                        $submarks = 'A';  
                    }
                    else
                    {
                        $submarks2 = $info['sub8mt2'];  
                    }


                    $subjectstaus2 = $this->subStatus($info['sub8pf2']);
                    if($info['sub8pf2'] == 1 || $info['sub8pf2'] == 2)
                    {
                        $subinduTotal =  $submarks2;
                    }

                    $subjectstaus1 = '';
                    $submarks = '';//$info['sub'.$subctn.'mt2']; 
                    $subtotal = 50;
                }
                else 
                {  

                    $subctn++;
                    if($subctn == 3)
                    {
                        $subctn++;
                    } 
                    $subNo = 'sub'.$subctn;
                    $subcd = $info['sub'.$subctn];

                    if($info['sub'.$subctn.'st1'] == 2)
                    {
                        $submarks = 'A';  
                    }
                    else
                    {
                        $submarks  = $info['sub'.$subctn.'mt1'];  
                    }

                    if($info['sub'.$subctn.'st2'] == 2)
                    {
                        $submarks2 = 'A';  
                    }
                    else
                    {
                        $submarks2 = $info['sub'.$subctn.'mt2']; 
                    }
                    $subjectstaus1 = $this->subStatus($info['sub'.$subctn.'pf1']);
                    $subjectstaus2 = $this->subStatus($info['sub'.$subctn.'pf2']);

                    if(($info['sub'.$subctn.'pf1'] == 1 && $info['sub'.$subctn.'pf2'] == 1) || ($info['sub'.$subctn.'pf1'] == 2 || $info['sub'.$subctn.'pf2'] == 2))
                    {
                        $subinduTotal = $submarks+ $submarks2;
                    }
                    
                   
                    if($subNo == 'sub5' || $subNo == 'sub6' || $subNo == 'sub7' || $subNo == 'sub4')
                    {
                        // DebugBreak();
                        $subprst = $this->Get_gradePrac_Inter($subcd,$info['sub'.$subctn.'mp2'],$info['sub'.$subctn.'prpf']) ;
                    }
                    else 
                    {
                        $subprst = '';
                    }



                    $subtotal  = 200;
                }

                //  $subremarks = $info['sub'.$subctn.'remarks'];
                if($l >0)
                 $Y = $Y  -2;
                 
               
                 
                 
                $subname = '';
                $subname = $this->GetiSubNameHere($subcd) ;

                $sety = $cellheight-2;
                $sety1 = $sety;
                $subname1 = '';
                $isborder = 'B';
                
                 $pdf->SetFont('Arial','',$font);
                $pdf->SetXY(10.2,55.2+ $Y);
                $pdf->Cell(12,$sety,$l+1,'1',0,'C',1);
                
                
                
                if($info['grp_cd'] == 5 && ($subNo == 'sub6' || $subNo == 'sub7' || $subNo == 'sub5'))
                {
                    // DebugBreak();
                    $subcd = $info[$subNo.'a'];
                      $subprst = $this->Get_gradePrac_Inter($subcd,$info['sub'.$subctn.'mp2'],$info['sub'.$subctn.'prpf']) ;
                    $subname1 = $this->GetiSubNameHere($subcd) ;
                    $isborder ='';
                    $sety = $sety1-4;
                    $subtotal= 150;
                }
                else  if($info['grp_cd'] == 5 && $subNo == 'sub4')
                {
                    $subtotal= 150;  
                }

                $totalmarks       =  $totalmarks +$subtotal; 
                $obtainmarkstotal = $obtainmarkstotal +$subinduTotal;

                if($subjectstaus1 == 'F' && $subP1 == '')
                {
                    $subP1 = ' (i) '.$subname;
                }
                else if($subjectstaus1 == 'F' && $subP1 != '')
                {
                    $subP1.= '  (ii) '.$subname;
                }

                if($subjectstaus2 == 'F' && $subP2 == '' && $subname1 == '')
                {
                    $subP2 = ' (i) '.$subname;
                }
                else if($subjectstaus2 == 'F' && $subP2 != '' && $subname1 == '')
                {
                    $subP2.= '  (ii) '.$subname;
                }


              

                $pdf->SetFont('Arial','',$font);
                $pdf->SetXY(22.2,55.2+ $Y);
                //$pdf->MultiCell(70.6,$cellheight,'',1,'L');
                $pdf->MultiCell(70.6,$sety,$subname,$isborder,'L');

                if($subname1 != '')
                {

                    if($subjectstaus2 == 'F' && $subP2 == '')
                    {
                        $subP2 = '(i) '.$subname1;
                    }
                    else if($subjectstaus2 == 'F' && $subP2 != '')
                    {
                        $subP2.= '  (ii) '.$subname1;
                    } 


                    $pdf->SetFont('Arial','',$font);
                    $pdf->SetXY(22.2,59.2+ $Y);
                    $pdf->MultiCell(70.6,$sety,$subname1,'B','L');  
                }


                $sety = $sety1;
                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(93,55.2+ $Y);
                $pdf->MultiCell($floatwidth,$sety,$subtotal,1,'C');

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(108,55.2+ $Y);
                $pdf->MultiCell($floatwidth,$sety,$submarks,1,'C');

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(123,55.2+ $Y);
                $pdf->MultiCell($floatwidth,$sety,$submarks2,1,'C');

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(138,55.2+ $Y);
                $pdf->MultiCell($floatwidth+1,$sety,$subprst,1,'C');

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(154,55.2+ $Y);
                $pdf->MultiCell($floatwidth+1,$sety,$subinduTotal,1,'C');

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(170,55.2+ $Y);
                $pdf->Cell(16.5,$sety,$subjectstaus1,1,0,'C',1);

                $pdf->SetFont('Arial','B',$font);
                $pdf->SetXY(186.5,55.2+ $Y);
                $pdf->Cell(16.5,$sety,$subjectstaus2,1,0,'C',1);
                
                 
                
                
            }         
        }
        //DebugBreak();
             $grade = '';
        $msg = '';
        $chancestr = '';
        $Cat11 = $info['cat11'];
        $cat12 = $info['cat12'];
        $notification = '';
        if($info['status'] == 1)
        {
            $percent = ($obtainmarkstotal/1100)*100;
            $grade = 'Grade   '.$this->get_grade($percent);
            $obtainmarkstotal = $obtainmarkstotal;
            $this->load->library('NumbertoWord');
            $obj    = new NumbertoWord();
            $obj->toWords($obtainmarkstotal,"",""); 

            
            if ($Cat11=="1" or $Cat11=="2" or $cat12=="1" or $cat12=="2")
            {
                $msg = 'The candidate has passed and obtained marks '.ucwords(trim($obj->words)).'.'; 
            }
            else if ($Cat11=="3" or $cat12=="3")
            {
                $msg = 'The candidate has Improved his/her marks '.ucwords(trim($obj->words)).'.';
            }
            else if ($Cat11=="4" or $cat12=="4")
            {
                $msg = 'Candidate has Passed Khasa Subjects '.ucwords(trim($obj->words)).'.';
            }

            else if ($Cat11=="5" or $cat12=="5")
            {
                $msg = 'Candidate has Passed Additional Subject '.ucwords(trim($obj->words)).'.';
            }

            else if ($Cat11=="6" or $cat12=="6")
            {
                $msg = 'Candidate has Passed after Passing Fazal Examination '.ucwords(trim($obj->words)).'.';
            }
            
            $notification = $info['result2'];
            
            
        }
        else
        {
            $obtainmarkstotal = '';
            
            if($info['status'] == 2)
            {
                if ($Cat11=="1" or $Cat11=="2" or $cat12=="1" or $cat12=="2")
                {
                    $msg = 'The Candidate has failed in subject(s) and eligible to reappear till'; 
                }
               $chancestr = $this->calchance($info['chance']);
               
               if($info['result1'] != '')
               {
                   $notification = 'P-I: '.$info['result1'].' ';
                   
               }
               if($notification != '' && $info['result2'] != '')
               {
                  $notification.=  '  P-II: '.$info['result2'].' ';
               }
               else if($info['result2'] != '')
               {
                   $notification =  ' P-II: '.$info['result2'].' ';
               }
               
            }
            else if($info['status'] == 3)
            {
               if ($Cat11=="1" or $Cat11=="2" or $cat12=="1" or $cat12=="2")
               {
                   $msg = 'The candidate has failed in both parts. THEREFORE, he/she should appear in full subjects next time.'; 
               }

               else if ($Cat11=="3" or $cat12=="3")
               {
                   $msg = 'The Candidate could not Improve his/her marks.'; 
               }
               else if ($Cat11=="4" or $cat12=="4")
               {
                   $msg = 'The Candidate has Failed after Passing Aama/Khasa Examination.'; 
               }
               else if ($Cat11=="5" or $cat12=="5")
               {
                   $msg = 'The Candidate has Failed in Additional Subject.'; 
               }             
               else if ($Cat11=="6" or $cat12=="6")
               {
                   $msg = 'The Candidate has Failed after Passing Fazal Examination.'; 
               }                      

            
            }
            
        }
       
        
        $Y = $Y + $cellheight-2;

        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(10.2,55.2+ $Y);
        $pdf->MultiCell(82.8,$cellheight-2,'Total/OVERALL GRADE:',1,'R');

        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(93,55.2+ $Y);
        $pdf->MultiCell($floatwidth,$cellheight-2,$totalmarks,1,'C');

        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(108,55.2+ $Y);
        $pdf->MultiCell(46,$cellheight-2,'',1,'C');
        
        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(154,55.2+ $Y);
        $pdf->MultiCell($floatwidth+1,$cellheight-2,$obtainmarkstotal,1,'C');
        
        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(170,55.2+ $Y);
        $pdf->MultiCell($floatwidth+18,$cellheight-2,$grade,1,'C');

        
        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(10.2,63.2+ $Y);
        $pdf->Cell(82.8,$cellheight-2,'Notification:',1,0,'R',1);

        $pdf->SetFont('Arial','B',$font);
        $pdf->SetXY(93,63.2+ $Y);
        $pdf->MultiCell(110,$cellheight-2,'    '.$notification,1,'L');
        
        
       
        
        if($chancestr != '')
        {
          
            $pdf->SetFont('Arial','',$font+1);
            $pdf->SetXY(10,72.2+ $Y);
            $pdf->MultiCell(195,6,$msg,0,'L');

            $pdf->SetFont('Arial','B',$font);
            $pdf->SetXY(112,72.2+ $Y);
            $pdf->MultiCell(195,6,$chancestr.'.',0,'L'); 
           
           
            if($subP1 != '')
            {
                $Y = $Y+3;
                $pdf->SetFont('Arial','',$font);
                $pdf->SetXY(10,74.2+ $Y);
                $pdf->MultiCell(140,6,'Part I:  '.$subP1,0,'L');  
              
            }
            if($subP2 != '' && $subP1 =='')
            {
               $Y = $Y+3;
                $pdf->SetFont('Arial','',$font);
                $pdf->SetXY(10,74.2+ $Y);
                $pdf->MultiCell(195,6,'Part II: '.$subP2,0,'L');    
               
            }

           else if($subP2 != '' && $subP1 !='')
            {
               $Y = $Y +4;
                $pdf->SetFont('Arial','',$font);
                $pdf->SetXY(10,74.2+ $Y);
                $pdf->MultiCell(140,6,'Part II: '.$subP2,0,'L');    
                
            }
               
            
        }
        else
        {
            $pdf->SetFont('Arial','',$font+2);
            $pdf->SetXY(10,72.2+ $Y);
            $pdf->MultiCell(195,6,$msg,0,'L');
        }
         $Y = $Y+3;
        $pdf->SetFont('Arial','B',$font+2);
        $pdf->SetXY(10,76.2+ $Y);
        $pdf->MultiCell(195,6,'Note:-',0,'L');
        
        $pdf->SetFont('Arial','',$font+.5);
        $pdf->SetXY(10,81.2+ $Y);
        $pdf->MultiCell(196,4,'(I) This provisional result intimation is issued as notice only. Errors and omissions are excepted. Any entry appearing in it does not itself confer any right or privilege independently for the grant of proper certificate which will be issued under the rule.',0,'J');
        
        $pdf->SetFont('Arial','',$font+.5);
        $pdf->SetXY(10,89.2+ $Y);
        $pdf->MultiCell(196,4,"(II) The Star (*) indicates the candidate has passed the subject/s with concessional mark under Rule 1.21 of the Board's Calendar. In case he/she is not willing to accept the concessional marks, necessary permission to reappear in the subject/s may be obtained 30 days before the commencement of the next examination. The candidate will have to attach the attested copy of revised result intimation with the Admission Form.  ",0,'J');
        
         $pdf->SetFont('Arial','',$font+.5);
        $pdf->SetXY(10,105.2+ $Y);
        $pdf->MultiCell(196,4,'(III) If the result intimation is lost, an interim result intimation may be obtained by the candidate on payment of prescribed fee. ',0,'j');

        $Y+=1;
        $pdf->Image("assets/img/result_note.jpg",45.2,108+ $Y, 150,10, "jpg"); 

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,120.2+ $Y);
        $pdf->Cell(0, 0.2, "Dealing Official:", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(32.2,120.2+ $Y);
        $pdf->Cell(0, 0.2, "________________________________________________________________________", 0.25, "C") ;
        
         $pdf->SetFont('Arial','',10);
        $pdf->SetXY(32.2,120.2+ $Y);
        $pdf->Cell(0, 0.2, "   ".$info['Emp_Rslt'].'-'.$info['emp_name'], 0.25, "C") ;
        
       
        
        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(10.2,127.2+ $Y);
        $pdf->Cell(0, 0.2, "Result Date:", 0.25, "C");

         $pdf->SetFont('Arial','',10);
        $pdf->SetXY(27.8,127+ $Y);
        $pdf->Cell(0, 0.2, "   12th September, 2016", 0.25, "C") ;
        
        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(27.8,127.2+ $Y);
        $pdf->Cell(0, 0.2, "______________________________", 0.25, "C") ;

        
        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(85.2,127.2+ $Y);
        $pdf->Cell(0, 0.2, "Printing Date:", 0.25, "C");

        $pdf->SetFont('Arial','',9);
        $pdf->SetXY(104.2,127.2+ $Y);
        $pdf->Cell(0, 0.2, "_______________________________", 0.25, "C");

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(104.2,127+ $Y);
        $pdf->Cell(0, 0.2, "     ".date('d-m-Y h:i a'), 0.25, "C");
      
        $pdf->Image("assets/img/CE_Signature.png",163.0,252, 38,36, "jpg"); 
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(145,288);
        $pdf->Cell(0, 0.2, "CONTROLLER OF EXAMINATIONS", 0.25, "C");
        $pdf->Image("assets/img/headsign.jpg",28.0,135+$Y, 72,24, "JPG"); 
    }


    function subStatus($mVar){
        if ($mVar == "1")
            return "P";
        else if ($mVar == "2")
            return "P*";
            else if ($mVar == "3")
                return "F";
                else
                    return "";
    }
private function subStatus_New($pf, $prPf)
{
    if($prPf == 2)
        return "P*";
    //----------------------------        
    else if ($pf == "1")
        return "P";
        else if ($pf == "2")
            return "P*";
            else if ($pf == "3")
                return "F";
                else
                    return "";
}


private function Get_gradePrac_Inter($Sub_Cd,$Marks,$PrPf) 
{
    $formula = ""; 
    if ($PrPf == 1) 
    {
        if ($Sub_Cd == 8 || $Sub_Cd == 12 || $Sub_Cd == 16 || $Sub_Cd == 18 || $Sub_Cd == 21 || $Sub_Cd == 42 || $Sub_Cd == 46 || $Sub_Cd == 47 || $Sub_Cd == 48 || $Sub_Cd == 79 || $Sub_Cd == 75 || $Sub_Cd == 76 || $Sub_Cd == 73 || $Sub_Cd == 72 || $Sub_Cd == 59 || $Sub_Cd == 60 || $Sub_Cd == 61) 
        {
            //echo 'here is prPf= '. $PrPf . '-->sub = '. $Sub_Cd . '--Marks-> = '. $Marks ; die();
            if ($Marks >= 27 && $Marks <= 30) {
                $formula = "(A+)";
            } else if ($Marks >= 24 && $Marks <= 26) {
                $formula = "(A)";
            } else if ($Marks >= 21 && $Marks <= 23) {
                $formula = "(B)";
            } else if ($Marks >= 18 && $Marks <= 20) {
                $formula = "(C)";
            } else if ($Marks >= 15 && $Marks <= 17) {
                $formula = "(D)";
            } else if ($Marks >= 12 && $Marks <= 14) {
                $formula = "(E)";
            }


        } else if ($Sub_Cd == 83) {
            if ($Marks >= 45 && $Marks <= 50) {
                $formula = "(A+)";
            } else if ($Marks >= 40 && $Marks <= 44) {
                $formula = "(A)";
            } else if ($Marks >= 35 && $Marks <= 39) {
                $formula = "(B)";
            } else if ($Marks >= 30 && $Marks <= 34) {
                $formula = "(C)";
            } else if ($Marks >= 25 && $Marks <= 29) {
                $formula = "(D)";
            } else if ($Marks >= 20 && $Marks <= 24) {
                $formula = "(E)";
            }

        } 
        //===================================
        else if ($Sub_Cd == 98) 
        {
            if ( $Marks>=23  && $Marks<=25 ) 
                $formula="(A+)";
            else if ( $Marks >=20 && $Marks<=22 ) 
                $formula="(A)";
                else if ( $Marks >=18 && $Marks<=19 ) 
                    $formula="(B)";
                    else if ( $Marks >=15 && $Marks<=17 ) 
                        $formula="(C)" ;       
                        else if ( $Marks >=13 && $Marks<=14 ) 
                            $formula="(D)";
                            else if ( $Marks >=10 && $Marks<=12 ) 
                                $formula="(E)";
        }
        //===================================
        else if ($Sub_Cd == 23) 
        {
            if ($Marks >= 108 && $Marks <= 120) {
                $formula = "(A+)";
            } else if ($Marks >= 96 && $Marks <= 107) {
                $formula = "(A)";
            } else if ($Marks >= 84 && $Marks <= 95) {
                $formula = "(B)";
            } else if ($Marks >= 72 && $Marks <= 83) {
                $formula = "(C)";
            } else if ($Marks >= 60 && $Marks <= 71) {
                $formula = "(D)";
            } else if ($Marks >= 48 && $Marks <= 59) {
                $formula = "(E)";
            }
        }


    } else if ($PrPf == 2) {
        $formula = "(E*)";

    } else if ($PrPf == 3) {
        $formula = "(F)";
    }

    // echo ' formula = '. $formula; die();

    return $formula;
}
private function get_grade($percentage) {
    $grade = '';
    if($percentage >= 80.00) {
        $grade = "A+";
    }else if($percentage <= 79.99 and $percentage >=70.00 ) {
        $grade = "A";
    }else if($percentage <= 69.99 and $percentage >=60.00 ) {
         $grade = "B";
    }else if($percentage <= 59.99 and $percentage >=50.00 ) {
         $grade = "C";
    }else if($percentage <= 49.99 and $percentage >=40.00 ) {
         $grade = "D";
    }else if($percentage <= 39.99 and $percentage >=33.00 ) {
         $grade = "E";
    }
    else  $grade = "F";
    
    return  $grade ;
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
    
    private function calchance($chance)
    {
        $ret = '';
        if($chance == 1)
        {
            $ret = 'Supplementary Examination, 2017';
        }
        else if($chance == 2)
        {
            $ret = 'Annual Examination, 2017';
        }
        else if($chance == 3)
        {
            $ret = 'Supplementary Examination, 2016';
        }
        return $ret;
    }
    
    private function Get9thSubMarks($_sub_cd)
    {
    $ret_val = '';
if($_sub_cd ==1)  $ret_val = "75";
else if($_sub_cd ==2)  $ret_val = "75";
else if($_sub_cd ==3)  $ret_val = "50";
else if($_sub_cd ==4)  $ret_val = "50";
else if($_sub_cd ==5)  $ret_val = "75";
else if($_sub_cd ==6)  $ret_val = "60";
else if($_sub_cd ==7)  $ret_val = "60";
else if($_sub_cd ==8)  $ret_val = "60";
else if($_sub_cd ==9)  $ret_val = "75";
else if($_sub_cd ==10)  $ret_val = "50";
else if($_sub_cd ==11)  $ret_val = "75";
else if($_sub_cd ==12)  $ret_val = "75";
else if($_sub_cd ==13)  $ret_val = "75";
else if($_sub_cd ==14)  $ret_val = "75";
else if($_sub_cd ==15)  $ret_val = "75";
else if($_sub_cd ==16)  $ret_val = "75";
else if($_sub_cd ==17)  $ret_val = "75";
else if($_sub_cd ==18)  $ret_val = "40";
else if($_sub_cd ==19)  $ret_val = "75";
else if($_sub_cd ==20)  $ret_val = "75";
else if($_sub_cd ==21)  $ret_val = "75";
else if($_sub_cd ==22)  $ret_val = "75";
else if($_sub_cd ==23)  $ret_val = "75";
else if($_sub_cd ==24)  $ret_val = "75";
else if($_sub_cd ==25)  $ret_val = "75";
else if($_sub_cd ==26)  $ret_val = "75";
else if($_sub_cd ==27)  $ret_val = "60";
else if($_sub_cd ==29)  $ret_val = "75";
else if($_sub_cd ==30)  $ret_val = "60";
else if($_sub_cd ==31)  $ret_val = "75";
else if($_sub_cd ==32)  $ret_val = "75";
else if($_sub_cd ==33)  $ret_val = "75";
else if($_sub_cd ==34)  $ret_val = "75";
else if($_sub_cd ==35)  $ret_val = "75";
else if($_sub_cd ==36)  $ret_val = "75";
else if($_sub_cd ==37)  $ret_val = "75";
else if($_sub_cd ==40)  $ret_val = "60";
else if($_sub_cd ==43)  $ret_val = "40";
else if($_sub_cd ==48)  $ret_val = "40";
else if($_sub_cd ==51)  $ret_val = "50";
else if($_sub_cd ==66)  $ret_val = "75";
else if($_sub_cd ==69)  $ret_val = "30";
else if($_sub_cd ==70)  $ret_val = "30";
else if($_sub_cd ==72)  $ret_val = "30";
else if($_sub_cd ==73)  $ret_val = "75";
else if($_sub_cd ==78)  $ret_val = "50";
else if($_sub_cd ==79)  $ret_val = "40";
else if($_sub_cd ==81)  $ret_val = "75";
else if($_sub_cd ==82)  $ret_val = "75";
else if($_sub_cd ==83)  $ret_val = "40";
else if($_sub_cd ==84)  $ret_val = "75";
else if($_sub_cd ==85)  $ret_val = "75";
else if($_sub_cd ==86)  $ret_val = "75";
else if($_sub_cd ==87)  $ret_val = "75";
else if($_sub_cd ==89)  $ret_val = "40";
else if($_sub_cd ==90)  $ret_val = "40";
else if($_sub_cd ==92)  $ret_val = "75";
else if($_sub_cd ==93)  $ret_val = "30";
else if($_sub_cd ==94)  $ret_val = "30";
return $ret_val;
    }
   function  GetSubNameHere($_sub_cd)
    {
$ret_val = "";
if($_sub_cd == 1)  $ret_val = "URDU";
else if($_sub_cd == 2)  $ret_val = "ENGLISH";
else if($_sub_cd == 3)  $ret_val = "ISLAMIYAT (COMPULSORY)";
else if($_sub_cd == 4)  $ret_val = "PAKISTAN STUDIES";
else if($_sub_cd == 5)  $ret_val = "MATHEMATICS";
else if($_sub_cd == 6)  $ret_val = "PHYSICS";
else if($_sub_cd == 7)  $ret_val = "CHEMISTRY";
else if($_sub_cd == 8)  $ret_val = "BIOLOGY";
else if($_sub_cd == 9)  $ret_val = "GENERAL SCIENCE";
else if($_sub_cd == 11)  $ret_val = "GEOGRAPHY OF PAKISTAN";
else if($_sub_cd == 18)  $ret_val = "ART/ART & MODEL DRAWING";
else if($_sub_cd == 22)  $ret_val = "ARABIC";
else if($_sub_cd == 23)  $ret_val = "PERSIAN";
else if($_sub_cd == 36)  $ret_val = "PUNJABI";
else if($_sub_cd == 20)  $ret_val = "ISLAMIC HISTORY";
else if($_sub_cd == 21)  $ret_val = "HISTORY OF PAKISTAN/ HISTORY OF INDO PAK";
else if($_sub_cd == 78)  $ret_val = "COMPUTER SCIENCE";
else if($_sub_cd == 12)  $ret_val = "HOUSE HOLD ACCOUNTS & ITS RELATED PROBLEMS";
else if($_sub_cd == 13)  $ret_val = "ELEMENTS OF HOME ECONOMICS";
else if($_sub_cd == 14)  $ret_val = "PHYSIOLOGY & HYGIENE";
else if($_sub_cd == 15)  $ret_val = "GEOMETRICAL & TECHNICAL DRAWING";
else if($_sub_cd == 16)  $ret_val = "GEOLOGY";
else if($_sub_cd == 17)  $ret_val = "ASTRONOMY & SPACE SCIENCE";
else if($_sub_cd == 19)  $ret_val = "ISLAMIC STUDIES";
else if($_sub_cd == 27)  $ret_val = "FOOD AND NUTRITION";
else if($_sub_cd == 28)  $ret_val = "ART IN HOME ECONOMICS";
else if($_sub_cd == 29)  $ret_val = "MANAGEMENT FOR BETTER HOME";
else if($_sub_cd == 30)  $ret_val = "CLOTHING & TEXTILES";
else if($_sub_cd == 31)  $ret_val = "CHILD DEVELOPMENT AND FAMILY LIVING";
else if($_sub_cd == 32)  $ret_val = "MILITARY SCIENCE";
else if($_sub_cd == 33)  $ret_val = "COMMERCIAL GEOGRAPHY";
else if($_sub_cd == 34)  $ret_val = "URDU LITERATURE";
else if($_sub_cd == 35)  $ret_val = "ENGLISH LITERATURE";
else if($_sub_cd == 37)  $ret_val = "EDUCATION";
else if($_sub_cd == 38)  $ret_val = "ELEMENTARY NURSING & FIRST AID";
else if($_sub_cd == 39)  $ret_val = "PHOTOGRAPHY";
else if($_sub_cd == 40)  $ret_val = "HEALTH & PHYSICAL EDUCATION";
else if($_sub_cd == 41)  $ret_val = "CALIGRAPHY";
else if($_sub_cd == 42)  $ret_val = "LOCAL (COMMUNITY) CRAFTS";
else if($_sub_cd == 43)  $ret_val = "ELECTRICAL WIRING";
else if($_sub_cd == 44)  $ret_val = "RADIO ELECTRONICS";
else if($_sub_cd == 45)  $ret_val = "COMMERCE";
else if($_sub_cd == 46)  $ret_val = "AGRICULTURE";
else if($_sub_cd == 53)  $ret_val = "ANIMAL PRODUCTION";
else if($_sub_cd == 54)  $ret_val = "PRODUCTIVE INSECTS AND FISH CULTURE";
else if($_sub_cd == 55)  $ret_val = "HORTICULTURE";
else if($_sub_cd == 56)  $ret_val = "PRINCIPLES OF HOME ECONOMICS";
else if($_sub_cd == 57)  $ret_val = "RELATED ACT";
else if($_sub_cd == 58)  $ret_val = "HAND AND MACHINE EMBROIDERY";
else if($_sub_cd == 59)  $ret_val = "DRAFTING AND GARMENT MAKING";
else if($_sub_cd == 60)  $ret_val = "HAND & MACHINE KNITTING & CROCHEING";
else if($_sub_cd == 61)  $ret_val = "STUFFED TOYS AND DOLL MAKING";
else if($_sub_cd == 62)  $ret_val = "CONFECTIONERY AND BAKERY";
else if($_sub_cd == 63)  $ret_val = "PRESERVATION OF FRUITS,VEGETABLES & OTHER FOODS";
else if($_sub_cd == 64)  $ret_val = "CARE AND GUIDENCE OF CHILDREN";
else if($_sub_cd == 65)  $ret_val = "FARM HOUSE HOLD MANAGEMENT";
else if($_sub_cd == 66)  $ret_val = "ARITHEMATIC";
else if($_sub_cd == 67)  $ret_val = "BAKERY";
else if($_sub_cd == 68)  $ret_val = "CARPET MAKING";
else if($_sub_cd == 69)  $ret_val = "DRAWING";
else if($_sub_cd == 70)  $ret_val = "EMBORIDERY";
else if($_sub_cd == 71)  $ret_val = "HISTORY";
else if($_sub_cd == 72)  $ret_val = "TAILORING";
else if($_sub_cd == 24)  $ret_val = "GEOGRAPHY";
else if($_sub_cd == 25)  $ret_val = "ECONOMICS";
else if($_sub_cd == 26)  $ret_val = "CIVICS";
else if($_sub_cd == 47)  $ret_val = "BOOK KEEPING & ACCOUNTANCY";
else if($_sub_cd == 48)  $ret_val = "WOOD WORK (FURNITURE MAKING)";
else if($_sub_cd == 49)  $ret_val = "GENERAL AGRICULTURE";
else if($_sub_cd == 50)  $ret_val = "FARM ECONOMICS";
else if($_sub_cd == 52)  $ret_val = "LIVE STOCK FARMING";
else if($_sub_cd == 73)  $ret_val = "TYPE WRITING";
else if($_sub_cd == 74)  $ret_val = "WEAVING";
else if($_sub_cd == 75)  $ret_val = "SECRETARIAL PRACTICE";
else if($_sub_cd == 76)  $ret_val = "CANDLE MAKING";
else if($_sub_cd == 77)  $ret_val = "SECRETARIAL PRACTICE AND CORRESPONDANCE";
else if($_sub_cd == 10)  $ret_val = "FOUNDATION OF EDUCATION";
else if($_sub_cd == 51)  $ret_val = "ETHICS";
else if($_sub_cd == 79)  $ret_val = "WOOD WORK (BOAT MAKING)";
else if($_sub_cd == 80)  $ret_val = "PRINCIPLES OF ARITHMATIC";
else if($_sub_cd == 81)  $ret_val = "SEERAT-E-RASOOL";
else if($_sub_cd == 82)  $ret_val = "AL-QURAAN";
else if($_sub_cd == 83)  $ret_val = "POULTRY FARMING";
else if($_sub_cd == 84)  $ret_val = "ART & MODEL DRAWING";
else if($_sub_cd == 85)  $ret_val = "BUSINESS STUDIES";
else if($_sub_cd == 86)  $ret_val = "HADEES & FIQAH";
else if($_sub_cd == 87)  $ret_val = "ENVIRONMENTAL STUDIES";
else if($_sub_cd == 88)  $ret_val = "REFRIGERATION AND AIR CONDITIONING";
else if($_sub_cd == 89)  $ret_val = "FISH FARMING";
else if($_sub_cd == 90)  $ret_val = "COMPUTER HARDWARE";
else if($_sub_cd == 91)  $ret_val = "BEAUTICIAN";
else if($_sub_cd == 92)  $ret_val = "GENERAL MATH"; 
else if($_sub_cd == 93)  $ret_val = "COMPUTER SCIENCES_DFD";    
else if($_sub_cd == 94)  $ret_val = "HEALTH & PHYSICAL EDUCATION_DFD";   
                                                                                                                                                                                                                                                                                                                return $ret_val ;             
    }
 function  GetiSubNameHere($_sub_cd) {
$ret_val = "";
if($_sub_cd == 1)  $ret_val = "ENGLISH";
else if($_sub_cd == 2)  $ret_val = "URDU";
else if($_sub_cd == 3)  $ret_val = "BANGALI";
else if($_sub_cd == 4)  $ret_val = "URDU(ALTERNATIVE EASY COURSE)";
else if($_sub_cd == 5)  $ret_val = "BENGALI(ALTERNATE EASY COURSE)";
else if($_sub_cd == 6)  $ret_val = "PAKISTANI CULTURE";
else if($_sub_cd == 7)  $ret_val = "HISTORY";
else if($_sub_cd == 8)  $ret_val = "LIBRARY SCIENCE";
else if($_sub_cd == 9)  $ret_val = "ISLAMIC HISTORY & CULTURE";
else if($_sub_cd == 10)  $ret_val = "FAZAL ARABIC";
else if($_sub_cd == 11)  $ret_val = "ECONOMICS";
else if($_sub_cd == 12)  $ret_val = "GEOGRAPHY";
else if($_sub_cd == 13)  $ret_val = "MILITARY SCIENCE";
else if($_sub_cd == 14)  $ret_val = "PHILOSOPHY";
else if($_sub_cd == 15)  $ret_val = "ISLAMIC STUDIES(ISL-ST. GROUP)";
else if($_sub_cd == 16)  $ret_val = "PSYCHOLOGY";
else if($_sub_cd == 17)  $ret_val = "CIVICS";
else if($_sub_cd == 18)  $ret_val = "STATISTICS";
else if($_sub_cd == 19)  $ret_val = "MATHEMATICS";
else if($_sub_cd == 20)  $ret_val = "ISLAMIC STUDIES";
else if($_sub_cd == 21)  $ret_val = "OUTLINES OF HOME ECONOMICS";
else if($_sub_cd == 22)  $ret_val = "MUSIC";
else if($_sub_cd == 23)  $ret_val = "FINE ARTS";
else if($_sub_cd == 24)  $ret_val = "ARABIC";
else if($_sub_cd == 25)  $ret_val = "BENGALI";
else if($_sub_cd == 26)  $ret_val = "BENGALI(ADVANCE)";
else if($_sub_cd == 27)  $ret_val = "ENGLISH ELECTIVE";
else if($_sub_cd == 28)  $ret_val = "FRENCH";
else if($_sub_cd == 29)  $ret_val = "GERMAN";
else if($_sub_cd == 30)  $ret_val = "LATIN";
else if($_sub_cd == 32)  $ret_val = "PUNJABI";
else if($_sub_cd == 33)  $ret_val = "PASHTO";
else if($_sub_cd == 34)  $ret_val = "PERSIAN";
else if($_sub_cd == 35)  $ret_val = "SANSKRIT";
else if($_sub_cd == 36)  $ret_val = "SINDHI";
else if($_sub_cd == 37)  $ret_val = "URDU (ADVANCE)";
else if($_sub_cd == 38)  $ret_val = "COMMERCIAL PRACTICE";
else if($_sub_cd == 39)  $ret_val = "PRINCIPLES OF COMMERCE";
else if($_sub_cd == 42)  $ret_val = "HEALTH & PHYSICAL EDUCATION";
else if($_sub_cd == 43)  $ret_val = "EDUCATION";
else if($_sub_cd == 44)  $ret_val = "GEOLOGY";
else if($_sub_cd == 45)  $ret_val = "SOCIOLOGY";
else if($_sub_cd == 46)  $ret_val = "BIOLOGY";
else if($_sub_cd == 47)  $ret_val = "PHYSICS";
else if($_sub_cd == 48)  $ret_val = "CHEMISTRY";
else if($_sub_cd == 52)  $ret_val = "ADEEB ARBI";
else if($_sub_cd == 53)  $ret_val = "ADEEB URDU";
else if($_sub_cd == 54)  $ret_val = "FAZAL URDU";
else if($_sub_cd == 55)  $ret_val = "HISTORY OF PAKISTAN";
else if($_sub_cd == 56)  $ret_val = "HISTORY OF ISLAM";
else if($_sub_cd == 57)  $ret_val = "HISTORY OF INDO-PAK";
else if($_sub_cd == 58)  $ret_val = "HISTORY OF MODREN WORLD";
else if($_sub_cd == 59)  $ret_val = "APPLIED ART  (H-Eco Group)";
else if($_sub_cd == 60)  $ret_val = "FOOD & NUTRITION (H-Eco Group)";
else if($_sub_cd == 61)  $ret_val = "CHILD DEVELOPMENT AND FAMILY LIVING (H-Eco Group)";
else if($_sub_cd == 70)  $ret_val = "PRINCIPLES OF ACCOUNTING";
else if($_sub_cd == 71)  $ret_val = "PRINCIPLES OF ECONOMICS";
else if($_sub_cd == 72)  $ret_val = "BIOLOGY (H-Eco Group)";
else if($_sub_cd == 73)  $ret_val = "CHEMISTRY (H-Eco Group)";
else if($_sub_cd == 75)  $ret_val = "CLOTHING & TEXTILE (H-Eco Group)";
else if($_sub_cd == 76)  $ret_val = "HOME MANAGEMNET  (H-Eco Group)";
else if($_sub_cd == 79)  $ret_val = "NURSING";
else if($_sub_cd == 80)  $ret_val = "BUSINESS MATH";
else if($_sub_cd == 83)  $ret_val = "COMPUTER SCIENCE";
else if($_sub_cd == 90)  $ret_val = "AGRICULTURE";
else if($_sub_cd == 91)  $ret_val = "PAKISTAN STUDIES";
else if($_sub_cd == 92)  $ret_val = "ISLAMIC EDUCATION";
else if($_sub_cd == 93)  $ret_val = "CIVICS FOR NON MUSLIM";
else if($_sub_cd == 94)  $ret_val = "COMMERCIAL GEOGRAPHY";
else if($_sub_cd == 95)  $ret_val = "BANKING";
else if($_sub_cd == 96)  $ret_val = "TYPING";
else if($_sub_cd == 97)  $ret_val = "BUSINESS STATISTICS";
else if($_sub_cd == 98)  $ret_val = "COMPUTER STUDIES";
else if($_sub_cd == 99)  $ret_val = "BOOK KEEPING & ACCOUNTANCY";
return $ret_val ;         
    }
 //'else if($_sub_cd =='+CONVERT(VARCHAR(2), SUB_CD)+')  $ret_val = "'+CONVERT(VARCHAR(2), MRK09)+'";' 
}