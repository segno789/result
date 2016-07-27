<?php
    class Result_model extends CI_Model 
    {
        public function __construct()    {

            $this->load->database(); 
        }
        
        public function getresult($keyword,$isrno)
        {
            $query = $this->db->query("Registration..Current_Matric_Result_Announcement '$keyword',10,2016,1,$isrno");
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
         public function getresultstd($keyword)
        {
            $query = $this->db->query("matric_new..getRes9thStdData '$keyword',2015,9,1,1");
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
      
  }
?>
