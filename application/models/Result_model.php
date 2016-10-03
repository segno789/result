<?php
    class Result_model extends CI_Model 
    {
        public function __construct()    {

            $this->load->database(); 
        }

         public function getresult($keyword,$isrno)
        {
            //$query = $this->db->query("Registration..Current_Matric_Result_Announcement '$keyword',9,2016,1,$isrno");
            $query = $this->db->query("Registration..Current_Inter_Result_Announcement '$keyword',12,2016,1,$isrno");
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
            $query = $this->db->query("matric_new..getRes9thStdData '$keyword',2016,9,1,1");
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
          public function getresult12std($keyword,$class,$iyear)
        {
            $query = $this->db->query("matric_new..getRes12thStdData '$keyword',$iyear,$class,1,1");
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
        public function getResultCardByRNO($keyword,$class,$iyear)
        {
            if($class ==  9)
            {
                $query = $this->db->query("matric_new..spResCard9th $keyword,$iyear,$class,1,1");
            }
            else if($class ==  12 || $class == 11)
            {
                $query = $this->db->query("matric_new..spResCard12th $keyword,$iyear,$class,1,1");
            }


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
        public function getResultCardByGroupWise($keyword,$Inst_Id)
        {
            //  DebugBreak();

            $where = "grp_cd = $keyword AND sch_cd = $Inst_Id";
            if($keyword == 7)
            {
                $where = "grp_cd = 1 AND sub8=78 AND sch_cd = $Inst_Id"; 
            }
             else if($keyword ==  1)
            {
                $where = "grp_cd = 1 AND sub8 = 8 AND sch_cd = $Inst_Id";  
            }
            else if($keyword ==  8)
            {
                $where = "grp_cd = 1 AND sub8 = 43 AND sch_cd = $Inst_Id";  
            }

            $query = $this->db->query("SELECT * FROM matric_new..tbl9thresultcards where $where");
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
        public function get12thResultCardByGroupWise($keyword,$Inst_Id)
        {
            // DebugBreak();

            $where = "grp_cd = $keyword AND coll_cd = $Inst_Id";


            $query = $this->db->query("SELECT * FROM matric_new..tbl12thresultcards where $where");
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
