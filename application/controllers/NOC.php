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

        $info = $info[0][0];
        $Session= 'ANNUAL';  
        //$info['iyear'] = 2016;     

        $filepath = $this->generatepath($info['Rno'],$info['class'],$info['iyear'],$info['sess']);





        //$filepath = base_url().'assets/img/download.jpg';
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
        $pdf->Image(base_url()."assets/img/border.png",5,3, 122,205, "PNG");
        $pdf->Image(base_url()."assets/img/dots.png",$dotx,7.5, 30,40, "PNG");
        $pdf->Image(base_url()."assets/img/dots.png",$dotx,47.5, 30,40, "PNG");
        $pdf->Image(base_url()."assets/img/dots.png",$dotx,87.5, 30,40, "PNG");
        $pdf->Image(base_url()."assets/img/dots.png",$dotx,127.5, 30,40, "PNG");
        $pdf->Image(base_url()."assets/img/dots.png",$dotx,167.5, 30,40, "PNG");

        $pdf->SetTextColor(0 ,0,0);
        $pdf->SetFont('Arial','U',14);
        $pdf->SetXY(.1,18);
        $pdf->MultiCell(130, 5,"BOARD OF INTERMEDIATE & SECONDARY EDUCATION, GUJRANWALA", '', "C",0);
        $pdf->Image(base_url()."assets/img/icon2.png",6,30, 38,36, "PNG");

        $pdf->SetFont('Arial','B',11);
        $pdf->SetXY(38.2,40);
        $pdf->Cell(0, 0.2, "MIGRATION CERTIFICATE", 0.25, "C");


        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(56.2,45);
        $pdf->Cell(0, 0.2, "(NOC)", 0.25, "C");
        $pdf->Image($filepath,90,33, 30,35, "jpg"); 
        
        /*   if( $decodedImg!==false )
        {
        //  Save image to a temporary location
        if( file_put_contents(TEMPIMGLOC,$decodedImg)!==false )
        {
        //  Open new PDF document and print image


        //  Delete image from server
        unlink(TEMPIMGLOC);
        }
        }*/



        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(10.2,70);
        $pdf->Cell(0, 0.2, "App.No.", 0.25, "C");

        $pdf->SetFont('Arial','BU',10);
        $pdf->SetXY(25.2,70);
        $pdf->Cell(0, 0.2, $info['app_No'], 0.25, "C");

        //barcode
        $mybar = $info['Rno']."@".$info['class']."@".$info['sess']."@".$info['iyear'];
        $Barcode = $mybar;

        $bardata = Barcode::fpdf($pdf, $black, $bx, $by, $angle, $type, array('code'=>$Barcode), $width, $height);

        $len = $pdf->GetStringWidth($bardata['hri']);
        Barcode::rotate(-$len / 2, ($bardata['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);

        $pdf->SetFillColor(255,0,0);
        // $pdf->SetLineWidth(.005);
        $pdf->SetAlpha(.2);
        $pdf->Image(base_url()."assets/img/icon2.png",18,80, 100,100, "PNG");
        $pdf->SetAlpha(1);



        $rx = 14.2;

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,85);
        $pdf->Cell(0, 0.2, "Name:", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+30,82.8);
        $pdf->MultiCell(100, 5,$info["name"], '', "L",0);

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,95);
        $pdf->Cell(0, 0.2, "Father's Name:", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+30,92.8);
        $pdf->MultiCell(100, 5,$info['fname'], '', "L",0);


        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,105);
        $pdf->Cell(0, 0.2, "Enrolment No:", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+30,102.8);
        $pdf->MultiCell(100, 5,$info['strregno'], '', "L",0);

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,115);
        $pdf->Cell(0, 0.2, "Roll No:", 0.25, "C");

        $class_ = $info['class'];
        $sess_  = $info['sess'];

        $sess_name = "";
        $class_name = "";
        $status_name = "";
        Switch($sess_)
        {
            case 1:
                $sess_name = "Annual";
                break;
            case 2:
                $sess_name = "Supplementary";
                break;
            default:
            $sess_name = "No Session Selected!";
            break;

        }
        Switch($class_)
        {
            case 9:
                $class_name = "SSC-I";
                break;
            case 10:
                $class_name = "SSC-II";
                break;
            case 11:
                $class_name = "HSSC-I";
                break;
            case 12:
                $class_name = "HSSC-II";
                break;
            default:
            $class_name = "No Class Selected!";
            break;

        }
        Switch($info['status'])
        {
            case 1:
                $status_name = "Pass";
                break;
            case 2:
                $status_name = "Fail";
                break;
            case 3:
                $status_name = "Fail";
                break;

            default:
                $status_name = "";
                break;

        }
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+30,112.8);
        $pdf->MultiCell(100, 5,$info['Rno']."  ".$class_name."  ".$sess_name." ".$info['iyear']." ".$status_name, '', "L",0); //158745 SSC-I Annual 2016 Pass

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,125);
        $pdf->Cell(0, 0.2, "Issued For:", 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY($rx+30,122.8);
        $pdf->MultiCell(90, 5,$info['MigTo'], '', "L",0);

        $pdf->SetFont('Arial','B',11);
        $pdf->SetXY($rx,140);
        $pdf->Cell(0, 0.2, "Fee Details", 0.25, "C");

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,150);
        $pdf->Cell(0, 0.2, "Challan No:", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+30,147.8);
        $pdf->MultiCell(100, 5,$info['Challan_No'], '', "L",0);

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,155);
        $pdf->Cell(0, 0.2, "Date:", 0.25, "C");

        $pdf->SetFont('Arial','B',9);
        $pdf->SetXY($rx+30,152.8);
        $pdf->MultiCell(100, 5,date('d-M-Y h:i A'), '', "L",0);     //09 September, 2016

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,160);
        $pdf->Cell(0, 0.2, "Amount:", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+30,157.8);
        $pdf->MultiCell(100, 5,"Rs. 1600/-", '', "L",0);

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY(10.2,190);

        $pdf->Cell(0, 0.2, date('d-M-Y h:i A'), 0.25, "C");
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(10.2,190);
        $pdf->Cell(0, 0.2, "_______________", 0.25, "C");
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(20.2,195);
        $pdf->Cell(0, 0.2, "Dated", 0.25, "C");


        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(48.2,190);
        $pdf->Cell(0, 0.2, "_______________", 0.25, "C");
          $pdf->Image('assets/img/SignOfficial.jpg',49.2,166, 25,25, "jpg"); 
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(58.2,195);
        $pdf->Cell(0, 0.2, "Official", 0.25, "C");

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(86.2,190);
        $pdf->Cell(0, 0.2, "______________", 0.25, "C");
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(88.2,195);
        $pdf->Cell(0, 0.2, "Superintendent", 0.25, "C");
          $pdf->Image('assets/img/SignSup.jpg',89.2,165.5, 25,25, "jpg"); 


        //Right Side
        $pdf->Image(base_url()."assets/img/border.png",130,3, 163,205, "PNG");
        $pdf->SetTextColor(0 ,0,0);
        $pdf->SetFont('Arial','U',14);
        $pdf->SetXY(134.2,18);
        $pdf->MultiCell(160, 5,"BOARD OF INTERMEDIATE & SECONDARY EDUCATION, GUJRANWALA", '', "C",0);
        $pdf->Image(base_url()."assets/img/icon2.png",135,30, 38,36, "PNG");
        $pdf->SetFont('Arial','B',11);
        $pdf->SetXY(185.2,40);
        $pdf->Cell(0, 0.2, "MIGRATION CERTIFICATE", 0.25, "C");

        $pdf->Image($filepath,250,30, 30,35, "jpg");  
        $pdf->Image('assets/img/Stamp.jpg',248,86, 35,35, "jpg"); 
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(205.2,44);
        $pdf->Cell(0, 0.2, "(NOC)", 0.25, "C");


        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(140.2,70);
        $pdf->Cell(0, 0.2, "App.No.", 0.25, "C");

        $pdf->SetFont('Arial','BU',10);
        $pdf->SetXY(155.2,70);
        $pdf->Cell(0, 0.2, $info['app_No'], 0.25, "C");

        $bx        = 240.6;  // barcode center

        $bardata = Barcode::fpdf($pdf, $black, $bx, $by, $angle, $type, array('code'=>$Barcode), $width, $height);

        $len = $pdf->GetStringWidth($bardata['hri']);
        Barcode::rotate(-$len / 2, ($bardata['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);



        $pdf->SetAlpha(.2);
        $pdf->Image(base_url()."assets/img/icon2.png",158,80, 100,100, "PNG");
        $pdf->SetAlpha(1);

        $rx = 150.2;
        $ry = 100;
        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,$ry);
        $pdf->Cell(0, 0.2, "Name of Candidate:", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+40,$ry-2.8);
        $pdf->MultiCell(100, 5,$info['name'], '', "L",0);

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,$ry+10);
        $pdf->Cell(0, 0.2, "Father's Name:", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+40,$ry+10-2.8);
        $pdf->MultiCell(100, 5,$info['fname'], '', "L",0);


        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,$ry+20);
        $pdf->Cell(0, 0.2, "Enrolment No:", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+40,$ry+20-2.8);
        $pdf->MultiCell(100, 5,$info['strregno'], '', "L",0);

        $pdf->SetFont('Arial','',10);
        $pdf->SetXY($rx,$ry+30);
        $pdf->Cell(0, 0.2, "Roll No:", 0.25, "C");

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx+40,$ry+30-2.8);
        $pdf->MultiCell(100, 5,$info['Rno']."  ".$class_name."  ".$sess_name." ".$info['iyear']." ".$status_name, '', "L",0);     //158745 SSC-I Annual 2016 Pass


        $pdf->SetFont('Arial','',12);
        $pdf->SetXY($rx,$ry+40);
        $pdf->MultiCell(118, 5,"The Candidate is permitted to migrate from the Jurisdiction of the Board for Studies or apperance in an examination from", '', "J",0);

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY($rx,$ry+50);
        $pdf->MultiCell(125, 5,$info['MigTo'], '', "L",0);




        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(136.2,192);
        $pdf->Cell(0, 0.2, "Dated", 0.25, "C");
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(147.2,192);
        $pdf->Cell(0, 0.2," ".date('d-M-Y h:i A'), 0.25, "C");
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(147.2,192);
        $pdf->Cell(0, 0.2, "_____________", 0.25, "C");



        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(178.2,192);
        $pdf->Cell(0, 0.2, "Official", 0.25, "C");

        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(191.2,192);
        $pdf->Cell(0, 0.2, "_____________", 0.25, "C");
        
          $pdf->Image('assets/img/SignOfficial.jpg',191.2,168, 25,25, "jpg"); 


        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(225.2,192);
        $pdf->Cell(0, 0.2, "Superintendent", 0.25, "C");
        $pdf->SetFont('Arial','',12);
        $pdf->SetXY(254.2,192);
        $pdf->Cell(0, 0.2, "_____________", 0.25, "C"); 
           $pdf->Image('assets/img/SignSup.jpg',255.2,168, 25,25, "jpg"); 



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
        $pdf->MultiCell(100, 5,"Rs. 1600/-", '', "L",0);



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



    public function get_ssc_data()

    {
        //  debugBreak();
        $rno= $_POST['rno'];
        $year= $_POST['year'];
        $sess=  $_POST['sess'];
        $dob = $_POST['dob'];
        $migto = $_POST['brd'];

        if($rno == "" || $rno == 0 || strlen($rno) < 5)
        {
            $value[0][0]['Mesg_server']  = "Please Provide Correct Roll No. ";
            echo json_encode($value);
        }
        else
            if($year == "" || $year == 0)
            {
                $value[0][0]['Mesg_server']  = "Please Select Year. If you do so, Refresh the Web Page.";
                echo json_encode($value);  
            }
            else
                if($sess == "" || $sess == 0)
                {
                    $value[0][0]['Mesg_server']  = "Please Select Session.";  
                    echo json_encode($value);  
                }
                else
                    if($dob == "" || $dob == 0)
                    {
                        $value[0][0]['Mesg_server']  = "Please Select DOB. ";
                        echo json_encode($value);  
                    }
                    else
                        if($migto == "" || $migto == 0)
                        {
                            $value[0][0]['Mesg_server']  = "Please Select Migrated Board.";
                            echo json_encode($value);  
                        }

                        else
                        {
                            $this->load->model('Verification_model');
                            $displaydob =  $dob;
                            $dob = date('d-m-Y',strtotime($dob));
                            $value = array($this->Verification_model->getresult_matric($rno,$year,$sess,$dob)) ;
                            if($value[0] != -1)
                            {
                                $value[0][0]['Mesg_server'] = '';
                                if(@$value[0][0]['Mesg'] == '')
                                {
                                    $path = $this->generatepath($value[0][0]['SSC_RNo'],$value[0][0]['SSC_CLASS'],$value[0][0]['SSC_Year'],$value[0][0]['SSC_Sess']);
                                    $isexit = file_exists($path);
                                    if(!file_exists($path))
                                    {
                                        $temp[0][0]['Mesg_server']  = 'Your Picture is missing' ;
                                        echo json_encode($temp);   
                                    }
                                    else
                                    {
                                        $type = pathinfo($path, PATHINFO_EXTENSION);
                                        $data = file_get_contents($path);
                                        $value[0][0]['PicPath'] = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                        $value[0][0]['dob'] = $displaydob;
                                        echo json_encode($value);   
                                    }

                                }
                                else
                                {
                                    $temp[0][0]['Mesg_server']  = $value[0][0]['Mesg'] ;
                                    echo json_encode($temp);    
                                }


                            }
                            else
                            {
                                $temp[0][0]['Mesg_server']  = "Record Not Found.";
                                echo json_encode($temp);    
                            }

        }


    }

    public function get_hssc_data()

    {
        // debugBreak();
        $rno= $_POST['rno'];
        $year= $_POST['year'];
        $sess=  $_POST['sess'];
        $matrno = $_POST['matrno'];
        $migto = $_POST['brd'];
        $intclass = $_POST['int_class'];

        if($rno == "" || $rno == 0 || strlen($rno) < 5)
        {
            $value[0][0]['Mesg_server']  = "Please Provide Correct Inter Roll No. ";
            echo json_encode($value);
        }
        else if($matrno == "" || $matrno == 0 || strlen($matrno) < 5)
        {
            $value[0][0]['Mesg_server']  = "Please Provide Correct Matric Roll No. ";
            echo json_encode($value);
        }
        else
            if($year == "" || $year == 0)
            {
                $value[0][0]['Mesg_server']  = "Please Select Year. If you do so, Refresh the Web Page.";
                echo json_encode($value);  
            }
            else
                if($sess == "" || $sess == 0)
                {
                    $value[0][0]['Mesg_server']  = "Please Select Session.";  
                    echo json_encode($value);  
                }
                else
                    if($intclass == "" || $intclass == 0)
                    {
                        $value[0][0]['Mesg_server']  = "Please Select Inter Class.";  
                        echo json_encode($value);  
                    }

                    else
                        if($migto == "" || $migto == 0)
                        {
                            $value[0][0]['Mesg_server']  = "Please Select Migrated Board.";
                            echo json_encode($value);  
                        }

                        else
                        {
                            $this->load->model('Verification_model');

                            $value = array($this->Verification_model->Pre_Matric_data($rno,$year,$sess,$matrno,$intclass)) ;
                            if($value[0] == false)
                            {
                                $value[0][0]['Mesg_server'] = 'No Record Found Against Your Given Information.';
                            }
                            else
                            {
                                // DebugBreak();
                                $path = $this->generatepath($value[0][0]['rno'],$value[0][0]['class'],$value[0][0]['iyear'],$value[0][0]['sess']);
                                $isexit = file_exists($path);
                                if(!file_exists($path))
                                {
                                    $temp[0][0]['Mesg_server']  = 'Your Picture is missing' ;
                                    echo json_encode($temp);   
                                }
                                else
                                {
                                    $type = pathinfo($path, PATHINFO_EXTENSION);
                                    $data = file_get_contents($path);
                                    $value[0][0]['PicPath'] = 'data:image/' . $type . ';base64,' . base64_encode($data);

                                }  
                                $value[0][0]['Mesg_server'] = '';
                            }


                            echo json_encode($value);

        }


    }

    public function Insert_ssc_data()
    {  

        $rno= $_POST['rno'];
        $year= $_POST['year'];
        $sess=  $_POST['sess'];
        $dob = $_POST['dob'];
        $migto = $_POST['migto'];
        $this->load->model('Verification_model');
        $info = array($this->Verification_model->insert_DATA_matric($rno,$year,$sess,date('Y-m-d',strtotime($dob)),$migto)) ;
        echo json_encode($info);



    }
    public function Insert_hssc_data()
    {
        $rno= $_POST['rno'];
        $year= $_POST['year'];
        $sess=  $_POST['sess'];
        $matrno = $_POST['matrno'];
        $intclass = $_POST['intclass'];
        $migto = $_POST['migto'];
        $this->load->model('Verification_model');
        $info = array($this->Verification_model->insert_DATA_inter($rno,$year,$sess,$matrno,$intclass,$migto)) ;
        echo json_encode($info);



    }
    public function downloadPage()
    {
        $info['app_No'] = $appno = $this->uri->segment(3);
        $this->load->view('common/commonheader_Verification.php');
        $this->load->view('NOC/FormDownloaded.php',$info);
        $this->load->view('common/verfooter.php');    
    }
    public function statusPage()
    {
        // DebugBreak();
        $this->load->library('session');
        if($this->session->flashdata('noc_status'))
        {
            $alldata = $this->session->flashdata('noc_status'); 
            $alldata = $alldata[0][0];
        }
        else{
            $alldata = "";
        }

        $this->load->view('common/commonheader_Verification.php',$alldata);
        $this->load->view('NOC/default.php',$alldata);
        $this->load->view('common/verfooter.php');    
    }
    public function statusPage_server()
    {
        //DebugBreak();
        $appno = @$_POST['appNo'];
        if(!isset($appno))
        {
            return ;
        }
        $this->load->model('Verification_model');
        if(isset($_POST['btnchk']))
        {
            $this->load->library('session');  

            $info = array($this->Verification_model->check_status($appno)) ; 
            if($info[0][0]['ismigrated'] == 1)
            {
                redirect('noc/Download_NOC/'.$appno);
                return;  
            }
            else
            {
                $this->session->set_flashdata('noc_status',$info);
                redirect('noc/statusPage');
                return;    
            }

        }
        if(isset($_POST['btnDownloadForm']))
        {
            redirect('noc/Print_challan_Form/'.$appno);
            return;   
        }






    }
    public function Download_NOC()
    {
        // DebugBreak();
        $appno = $this->uri->segment(3);
        $this->load->model('Verification_model');
        $info = array($this->Verification_model->Downolad_data($appno)) ;
        $this->load->library('PDFFWithOutPage');
        $pdf=new PDFFWithOutPage();   
        $pdf->SetAutoPageBreak(true,2);
        $pdf->AddPage('L',"A4");
        $this->makeNoc($pdf,$info);
        $pdf->Output('Result.pdf', 'I');  
        return;  
    }
    public function Print_challan_Form()
    {


        // DebugBreak();
        $formno = $this->uri->segment(3);

        $this->load->model('Verification_model');
        //$this->load->library('session');
        $this->load->library('NumbertoWord');
        //DebugBreak();
        $result = array($this->Verification_model->Downolad_data($formno)) ;
        $result = $result[0] ;
        //$Logged_In_Array = $this->session->all_userdata();
        //$user = $Logged_In_Array['logged_in'];
        // $this->load->model('NinthCorrection_model');
        //$grp_cd = $this->uri->segment(3);
        // $fetch_data = array('Inst_cd'=>$user['Inst_Id'],'formno'=>$formno);
        //  DebugBreak();
        //$result = $this->NinthCorrection_model->Print_challan_Form($fetch_data);
        //   $result = array('data'=>$this->NinthCorrection_model->Print_challan_Form($fetch_data));

        $this->load->library('pdf_rotate');
        //   $pdf = new PDF_Rotate('P','in',"A4"); 
        // $this->load->library('PDFFWithOutPage'); 
        //$pdf=new PDFFWithOutPage();   
        // $pdf->SetAutoPageBreak(true,2);
        //$pdf->AddPage('L',"A4");
        //for each type of correction total 7 types of corrections are now
        $ctid=1;  //correction type of id starts from one and multiples by 2 for next type of correction id
        //   $displayfeetitle=array(1=>'Name Correction', 2=>'Father Name Correction', 3=>'DOB Correction', 4=>'FNIC Correction', 5=>'B-Form Correction', 6=>'Picture Change', 7=>'Group Change', 8=>'Subject Change');
        // $feestructure = array();
        //  for($i=1;$i<=8;$i++){
        //$feetitle =  $result = array('data'=>$this->NinthCorrection_model->Print_challan_Form($fetch_data));
        // DebugBreak();
        if($result[0]['isother'] ==1)
        {
            $feestructure[]    =  "1600";    
            $displayfeetitle[] =  'NOC For Other Board';    
        }

        /*$feestructure[16]=$result[0]['BFormFee'];
        $feestructure[32]=$result[0]['PicFee'];
        $feestructure[64]=$result[0]['GroupFee'];
        $feestructure[128]=$result[0]['SubjectFee'];*/
        //  $ctid *= 2;
        // }
        //$totalfee
        $turn=1;     
        $pdf=new PDF_Rotate("P","in","A4");
        $pdf->AliasNbPages();
        $pdf->SetTitle("Challan Form | Application NOC Form");
        $pdf->SetMargins(0.5,0.5,0.5);
        $pdf->AddPage();
        $generatingpdf=false;
        $challanCopy=array(1=>"Depositor Copy",  2=>"OWO Branch Copy",3=>"Bank Copy", 4=>"Board Copy",);
        $challanMSG=array(1=>"(May be deposited in any HBL Branch)",2=>"(To be sent to the OWO Branch Via BISE One Window)", 3=>"(To be retained with HBL)", 4=>"(To be sent to the Board via HBL Branch aloongwith scroll)"  );
        $challanNo = $result[0]['Challan_No']; 

        /* if(date('Y-m-d',strtotime(Correction_Last_Date))>=date('Y-m-d'))
        {
        $rule_fee   =  $this->NinthCorrection_model->getreulefee(1); 
        $challanDueDate  = date('d-m-Y',strtotime($rule_fee[0]['End_Date'] )) ;
        }
        else
        {
        $rule_fee   =  $this->NinthCorrection_model->getreulefee(2); 
        $challanDueDate  = date('d-m-Y',strtotime($rule_fee[0]['End_Date'] )) ;
        }
        */
        //  DebugBreak();
        $obj    = new NumbertoWord();
        $obj->toWords($feestructure[0],"Only.","");
        // $pdf->Cell( 0.5,0.5,ucwords($obj->words),0,'L');
        $feeInWords = ucwords($obj->words);//strtoupper(cNum2Words($totalfee)); 

        //-------------------- PRINT BARCODE
        //  $pdf->SetDrawColor(0,0,0);
        $temp = $challanNo.'@'.$result[0]['Formno'].'@09@2016@1';
        //  $image =  $this->set_barcode($temp);
        //DebugBreak();
        $bx        = 240.6;  // barcode center


        $Barcode = $temp;

        // $bardata = Barcode::fpdf($pdf, $black, $bx, $by, $angle, $type, array('code'=>$Barcode), $width, $height);

        //$len = $pdf->GetStringWidth($bardata['hri']);
        // Barcode::rotate(-$len / 2, ($bardata['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
        // $temp =  $this->set_barcode($temp);

        $yy = 0.05;
        $dyy = 0.1;
        $corcnt = 0;
        for ($j=1;$j<=4;$j++) 
        {




            $yy = 0.04;
            if($turn==1){$dyy=0.1;} 
            else {
                if($turn==2){$dyy=2.65;} else  if($turn==3) {$dyy=5.2; } else {$dyy=7.75 ; $turn=0;}
            }
            $corcnt = 0;
            $pdf->SetFont('Arial','BI',11);
            $pdf->SetXY(1.0,$yy+$dyy);
            //   DebugBreak();
            $pdf->Cell(2.45, 0.4, "BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA", 0.25, "L");
            $pdf->Image(base_url()."assets/img/logo2.PNG",0.30,$yy+$dyy, 0.50,0.50, "PNG", "http://www.bisegrw.com");
            //  $pdf->Image(BARCODE_PATH.$Barcode,3.2, 1.15+$yy ,1.8,0.20,"PNG");
            //$pdf->Image(BARCODE_PATH.$temp,5.8, $yy+$dyy+0.30 ,1.8,0.20,"PNG");
            $challanTitle = $challanCopy[$j];
            $generatingpdf=true;


            if($turn==1){$dy=0.4;} else {
                if($turn==2){$dy=2.9;} else  if($turn==3) {$dy=5.5; }else {$dy=8.1 ; $turn=0;}
            }
            $turn++;
            $y = 0.08;

            //$pdf->SetFont('Arial','BI',14);
            //$pdf->SetXY(5.5,$y+$dy);
            //$pdf->Image(BARCODE_PATH.$image,3.2, 0.61  ,1.8,0.20,"PNG");
            //$pdf->Cell(0.5, $y, $challanCopy[$j], 0.25, "L");

            $pdf->SetFont('Arial','BI',9);
            $pdf->SetXY(1.0,$y+$dy);
            $pdf->Cell(0.5, $y, $challanCopy[$j], 0.25, "L");
            $w = $pdf->GetStringWidth($challanCopy[$j]);
            $pdf->SetXY($w+1.2,$y+$dy);
            $pdf->SetFont('Arial','I',7);
            $pdf->Cell(0, $y, $challanMSG[$j], 0.25, "L");

            $pdf->SetXY($w+1.4,$y+$dy+0.15);
            $pdf->SetFont('Arial','I',7);
            $pdf->Cell(0, $y, 'NOC', 0.25, "L");

            $y += 0.25;
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(0.5,$y+$dy-0.01);
            $pdf->SetFillColor(0,0,0);
            $pdf->Cell(1.5,0.2,'',1,0,'C',1);
            $pdf->SetFillColor(255,255,255);
            $pdf->SetTextColor(255,255,255);
            $pdf->SetXY(0.5,$y+$dy-0.01);
            $pdf->Cell(0, 0.25, "Due Date: ".date("d/m/y",time()), 0.25, "C");
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','BI',8);
            $pdf->SetXY(2.0,$y+$dy-0.04);
            $pdf->Cell(0, 0.25, "Printing Date: ".date("d/m/y",time())."  Account Title: BISE, GUJRANWALA   CMD Account No. 00427900072103", 0.25, "C");
            //CMD Account No. 00427900072103
            //--------------------------- Fee Description
            $pdf->SetXY(2.8,$y+$dy);
            $pdf->SetFont('Arial','U',8);
            $pdf->Cell(0.5,0.5,"Fee Description",0,'L');

            //  DebugBreak();
            //--------------------------- Challan Depositor Information
            $pdf->SetXY(4,$y+0.1+$dy);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell( 0.5,0.3,"Bank Challan No:".$challanNo."           Application No.".$result[0]['app_No'],0,2,'L');
            $pdf->SetFont('Arial','U',9);
            $pdf->Cell(0.5,0.25, "Particulars Of Depositor",0,2,'L');
            $pdf->SetX(4.0);
            $pdf->SetFont('Arial','B',8);
            //DebugBreak();
            if(intval($result[0]['sex'])==1){$sodo="S/O ";}else{$sodo="D/O ";}
            $pdf->Cell(0.5,0.25,$result[0]['name'].'    '.$sodo.$result[0]['fname'],0,2,'L');
            // $pdf->Cell(0.5,0.25,,0,2,'L');
            $pdf->SetX(4);
            $pdf->SetFont('Arial','I',6.5);
            // DebugBreak();
            //$pdf->Cell(0.5,0.3,"Institute Code: ".$user['Inst_Id'].'-'.$user['inst_Name'],0,2,'L');
            $pdf->MultiCell(4, .1, "",0);
            $pdf->SetXY(4,$y+1.15+$dy);
            $pdf->SetFont('Arial','B',9);
            $pdf->Cell(0.5,0.3,"Amount in Words: ".$feeInWords,0,2,'L');

            $x = 0.55;
            $y += 0.2;

            //------------- Fee Statement
            //  DebugBreak();
            $ctid=1;
            $multiply=1;

            /*    foreach ($feestructure as $value) {
            //  $value = $value * 2;

            $pdf->SetFont('Arial','',9);
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->Cell( 0.5,0.5,$displayfeetitle[$ctid],0,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(3,$y+$dy);
            $pdf->Cell(0.8,0.5,$feestructure[$ctid],0,'C');
            $ctid *= 2;
            $y += 0.18;
            }*/
            //             DebugBreak();
            $total =  count($feestructure);
            for ($k = 0; $k<count($feestructure); $k++){


                $pdf->SetFont('Arial','',9);
                $pdf->SetXY(0.5,$y+$dy);

                //$feestructure = array(1=>0, 2=>0, 4=>0, 8=>0, 16=>0, 32=>0, 64=>0, 128=>0);
                $pdf->Cell( 0.5,0.5,$displayfeetitle[$k],0,'L');
                $pdf->SetFont('Arial','B',10);
                $pdf->SetXY(3,$y+$dy);
                $pdf->Cell(0.8,0.5,$feestructure[$k],0,'C');
                $y += 0.18;
                $corcnt = $k;




            }

            //------------- Total Amount


            if($corcnt ==0){
                $y += 1.0;
            }
            else if($corcnt ==1){
                $y += .7;
            }
            else if($corcnt ==2){
                $y += .6;
            }
            else if($corcnt ==3){
                $y += .4;
            }
            else if($corcnt ==4){
                $y += .3;
            }
            else if($corcnt ==5){
                $y += .2;
            }

            else if($corcnt ==6){
                $y += .16;
            }
            $y += -0.2;
            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY(0.5,($y)+$dy);
            $pdf->Cell( 0.5,0.5,"Total Amount: ",0,'L');
            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY(3,$y+$dy);
            $pdf->Cell(0.8,0.5,'1600/-',0,'C');

            //------------- Signature
            $y += 0.2;
            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(0.5,$y+$dy);
            $pdf->Cell(0.5,0.5, 'Cashier: ___________________',0,'L');
            $pdf->SetXY(5.6,$y+$dy);
            $pdf->Cell(0.5,0.5, 'Manager: _________________',0,'L');    

            if ($turn>1){
                $y += 0.4;
                $pdf->Image( base_url().'assets/img/cut_line.png' ,0.3,$y+$dy, 7.5,0.15, "PNG");   
                // $pdf->Image("images/cut_line.png",0.3,$y+$dy, 7.5,0.15, "PNG");
            }
            // break;             
        }  
        if ($generatingpdf==true)
        {
            $pdf->Output('challanform.pdf','I');
        } else {
            $containsError=true;
            $errorMessage = "<br />Your Application is not found in accordance with given Application No.";
        }  

        //======================================================================================
        //  }

        //  $pdf->Output($data["Sch_cd"].'.pdf', 'I');
    }

    private function generatepath($rno,$class,$year,$sess)
    {
        $basepath = DIRPATH;
        $clsvr = '';
        $picyear= substr($year, -2);
        $folderno = '';
        if($class == 10  OR $class == 9)
        {
            $clsvr = 'MA'; 

        }
        else if($class == 12  OR $class == 11)
        {
            $clsvr = 'IA';
        }

        if($rno>=100001 && $rno<=150000)
        {
            $folderno = '1st';
        }
        else if($rno>=150001 && $rno<=200000)
        {
            $folderno = '2nd';
        }
        else if($rno>=200001 && $rno<=250000)
        {
            $folderno = '3rd';
        }
        else if($rno>=250001 && $rno<=300000)
        {
            $folderno = '4th';
        }
        else if($rno>=300001 && $rno<=350000)
        {
            if($class ==  10 OR $class ==  9)
            $folderno = '5th';
            else if($class ==  12 OR $class ==  11)
            $folderno = '6th';
        }
        else if($rno>=350001 && $rno<400000)
        {
             if($class ==  10 OR $class ==  9)
            $folderno = '6th';
            else if($class ==  12 OR $class ==  11)
            $folderno = '7th';
        }
        else if($rno>=400001 && $rno<=450000)
        {
            if($class ==  10 OR $class ==  9)
            $folderno = '7th';
            else if($class ==  12 OR $class ==  11)
            $folderno = '8th';
           
        }
        else if($rno>=450001 && $rno<=500000)
        {
             if($class ==  10 OR $class ==  9)
            $folderno = '8th';
            else if($class ==  12 OR $class ==  11)
            $folderno = '9th';
        }
        else if($rno>=500001 && $rno<550000)
        {
            $folderno = '9th';
        }
        else if($rno>=550001 && $rno<600000)
        {
            $folderno = '10th';
        }
         else if($rno>=600001 && $rno<650000)
        {
            $folderno = '11th';
        }


        $pic = 'Pic'.$picyear.'-'.$clsvr ;

        $foldername =   $clsvr.  $folderno .$picyear;
        $basepath =  $basepath.'\\'.$pic.'\\'. $foldername.'\\';
        return  $basepath.$rno.".jpg";
    }









}