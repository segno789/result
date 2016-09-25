<?php
class Verification_model extends CI_Model 
{
public function __construct()    {

    $this->load->database(); 
}

public function getresult_matric($rno,$year,$sess,$dob)
{

     
    
    
    
    $query = $this->db->query("Registration..NOC_GET_STD_MATRIC $rno,$sess,$year,'$dob'");
    $rowcount = $query->num_rows();
    if($rowcount > 0)
    {
        return $query->result_array();
       

    }
    else
    {
        return  -1;
    }
}
public function Pre_Matric_data($rno,$year,$sess,$matrno)
{

DebugBreak();
      $query = $this->db->query("Registration..NOC_GET_Inter_STD_MAINFO $rno,12,$year,$sess");
      
      $rowcount = $query->num_rows();
      if($rowcount > 0)
      {
          $info =  $query->result_array();
          
             $matrno =    $info[0]['matrno'];
             $sscsess =    $info[0]['sessofpass'];
             $ssiyear =    $info[0]['yearofpass'];
          $query = $this->db->query("Registration..NOC_GET_STD_INTER 0,$matrno,$ssiyear,$sscsess,$rno,$year,$sess");

          $rowcount = $query->num_rows();
          if($rowcount > 0)
          {
              return $query->result_array();
          }
          else
          {
              return  false;
          }
          
      }
      else
      {
          return  false;
      }
      
      
    // DebugBreak();
    
}
public function insert_DATA_matric($rno,$year,$sess,$dob,$migratedto)
{

     //debugBreak();
    // $reg=$this->load->database('Registration',TRUE);
  //  $this->db = $this->load->database('Registration', true);
    //$query = $this->db->query("Registration..Prev_Get_Student_Matric $rno,$year,$sess,0");
    //  $query = $this->db->query("Registration..NOC_GET_STD_MATRIC 447058,1,2014,'12-08-1998'"); //Already appeared candidated.
    $query = $this->db->query("Registration..NOC_GET_STD_MATRIC $rno,$sess,$year,'$dob'");

    $rowcount = $query->num_rows();
    if($rowcount > 0)
    {
        $myresult =  $query->result_array();
        $multiquery = $myresult;  
        $this->db->select('app_No');
        $this->db->order_by("app_No", "DESC");
        $formno = $this->db->get_where('Registration..tblMig_testing_purpose');
        $rowcount = $formno->num_rows();
        //  DebugBreak();
        if($rowcount == 0 )
        {
            $formno =  (NOC_APP_NO.'1' );
           // return $formno;
        }
        else
        {
            $row  = $formno->result_array();
            
            $formno = $row[0]['app_No']+1;
           // return $formno;
        }
       // DebugBreak();
        $app_no =   $formno;
        $formno = $myresult[0]['formno'];
        $rno =    $myresult[0]['SSC_RNo'];
        $sess = $myresult[0]['SSC_Sess'];
        $iyear = $myresult[0]['SSC_Year'];
        $class = $myresult[0]['SSC_CLASS'];
        $name = $myresult[0]['name'];
        $Fname = $myresult[0]['Fname'];
        $fnic = $myresult[0]['FNIC'];
        $gender = $myresult[0]['Gender'];
        $strregno = $myresult[0]['strregno'];
        
        $status = $myresult[0]['status'];
        $result1 = $myresult[0]['result1'];
        $result2 = $myresult[0]['result2'];
        
        if(!isset($status))
        {
          $status = 0;  
        }
        if(!isset($result1))
        {
            $result1 = 0;
        }
        if(!isset($result2))
        {
            $result2 = 0;
        }
        
        
        
        $picpath = '';
        
       // debugbreak();
        $query_2 = $this->db->query("Registration..Insert_NOC_RECORD $app_no,'$formno',$rno,$sess,$iyear,$class,'$name','$Fname','$fnic',$gender,'$strregno',$migratedto,'$picpath',$status,$result1");
        $rowcount = $query_2->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {   
          $query = $this->db->query("Registration..NOC_GET_INFO $app_no");
            $rowcount = $query->num_rows();
             if($rowcount > 0)
             {
                   return $query->result_array();
             }
            
        }
        

        }
        else
        {
            return  -1;
        }
    }
    public function Downolad_data ($app_no)
    {
      $query = $this->db->query("Registration..NOC_GET_INFO $app_no");
      $rowcount = $query->num_rows();
             if($rowcount > 0)
             {
                   return $query->result_array();
             }   
    }
    
    public function check_status ($appNo)
    {
        $this->db->select('ismigrated, BiseAdminMsg');
        //$this->db->order_by("app_No", "DESC");
        $formno = $this->db->get_where('Registration..tblMig_testing_purpose',array('app_No'=>$appNo));
        $rowcount = $formno->num_rows();
        //  DebugBreak();
        if($rowcount > 0 )
        {
            return $formno->result_array();
           // return $formno;
        }
        else
        {
            return false;
        }
    }
    


}
?>
