<?php
  class Spausermodel extends CI_Model{
      
      protected  $_tbspa = 'spauser';
      public function __construct()
      {
            parent::__construct();
      }

        public function get_spauser() 
        {
               $query = $this->db->get('spauser');
               return $query->result();
        }
        //nghia viet them
        public function danh_sach_spauser()
        {
            $results=$this->db->get('spauser');
            if($results->num_rows()>0)
                return $results->result();
            return false;
        }
        public function danh_sach_spauser_phan_trang($limits,$start)
        {
            $this->db->limit($limits,$start);
            $results=$this->db->get('spauser');
            if($results->num_rows()>0)
                return $results->result();
            return false;
        }
        //end nghia viet them
        public function insert_spauser($arr){                        
            $this->db->insert('spauser', $arr);
        }
        
        public function edit_spauser($spaid,$userid){
            $query = $this->db->get_where('spauser',array('SpaID' => $spaid,'UserID' =>$userid));
            return $query->result();
        }
        
        public function update_spa($id,$data){
            $this->db->where('spaID', $id);
            $this->db->update('spauser',$data);  

        }
        public function delete_spauser($spaid,$userid){
            
            $this->db->delete('spauser',array('SpaID' => $spaid,'UserID' =>$userid));
            
        }
      
  }
?>
