<?php
  class Commontypemodel extends CI_Model{
      
      protected  $_tbspa = 'commontype';
      public function __construct()
      {
            parent::__construct();
      }
        
       // function fGetcmtype( $perpage, $offset ){
//            $a_cmtype    =    $this->db->select()
//                                ->limit($perpage, $offset)
//                                ->order_by('CommonTypeId', 'ASC')
//                                ->get($this->_tbspa)
//                                ->result();
//            return $a_cmtype;
//        }
//    
//        public function fGetcmtype()
//        {
//            return $this->db->select()->get($this->_tbspa)->num_rows();
//        }
        public function get_commontype() 
        {
               $query = $this->db->get('commontype');
               return $query->result();
        }
        //nghia viet them
        public function danh_sach_commontype_phan_trang($limits,$start)
        {
            $this->db->limit($limits,$start);
            $results=$this->db->get('commontype');
            if($results->num_rows()>0)
                return $results->result();
            return false;
        }
        
        public function danh_sach_commontype()
        {
            $results=$this->db->get('commontype');
            if($results->num_rows()>0)
                return $results->result();
            return false;
        }
        //end nghia viet them
        public function insert_commontype($arr){                        
            $this->db->insert('commontype', $arr);
        }
        
        public function edit_commontype($id){
            $query = $this->db->get_where('commontype',array('CommonTypeId' => $id));
            return $query->result();
        }
        
        public function update_commontype($id,$data){
            $this->db->where('CommonTypeId', $id);
            $this->db->update('commontype',$data);  

        }
        public function delete_commontype($id){
            
            $this->db->delete('commontype',array('CommonTypeId' => $id));
            
        }
      
  }
?>
