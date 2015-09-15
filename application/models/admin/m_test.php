<?php
  class M_test extends CI_Model{
      
      protected  $_tbspa = 'commontype';
      private $db2;
      public function __construct()
      {
            parent::__construct();
            $this->db2 = $this->load->database('thebooking', TRUE);
            
      }
        
      public function MulitiDB(){
          $sql = "SELECT * FROM `rating`";
          //$DB2 = $this->load->database('thebooking', TRUE);
          $results = $this->db2->query($sql)->result();
          $id = $results[0]->RatePoint;
          return $id;
      } 
       
        
      
  }
?>
