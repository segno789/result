<?php
class Login_model extends CI_Model {
    public function __construct() {
        $this->load->database(); 
    }
    public function auth($username,$password) 
    {
      //  //DebugBreak();
        
		$query = $this->db->get_where('Admission_online..fl_users', array('inst_cd' => $username,'pass' => $password));
		$rowcount = $query->num_rows();
		if($rowcount >0)
		{
            $query_1 = $this->db->get_where('Admission_online..tblInstitutes_all', array('Inst_cd' => $username));
            
            
            
               $allinfo = array('flusers'=>$query->row_array(), 'tbl_inst'=>$query_1->row_array());
			 return $allinfo;
		}
		else
		{
		   return  false;; 
		}
    }
     
}
?>
