<?php

class CommonCodeObject {   
   public   $CommonId;
   public   $CommonTypeId ;
   public   $StrValue1;
   public   $StrValue2;
   public   $NumValue1;
   public   $NumValue2;
   public   $CreatedBy;
   public   $CreatedDate;
   public   $ModifiedBy;
   public   $ModifiedDate;
}

  class Commoncodemodel extends CI_Model{
        public $errorStr;  
        public $cmObj;   
        public function get_commoncode() 
        {
           $lst_cm = array();
           $query = $this->db->get_where('commoncode',array('CommonTypeId' => 'ProductTypeID'));
           try{  
           
           $res = json_decode(json_encode($query->result()),true);
           for($i= 0;$i<count($res);$i++){   
               $cm = new  CommonCodeObject();
               $cm->CommonId = $res[$i]['CommonId'] ;
               $cm->CommonTypeId = $res[$i]['CommonTypeId'] ;
               $cm->StrValue1 = $res[$i]['StrValue1'] ;
               $cm->StrValue2 = $res[$i]['StrValue2'] ;
               $cm->NumValue1 = $res[$i]['NumValue1'] ;
               $cm->NumValue2 = $res[$i]['NumValue2'] ;
               $cm->CreatedBy = $res[$i]['CreatedBy'] ;
               $cm->CreatedDate = $res[$i]['CreatedDate'] ;
               $cm->ModifiedBy = $res[$i]['ModifiedBy'] ;
               $cm->ModifiedDate = $res[$i]['ModifiedDate'] ;
               array_push($lst_cm,$cm);
           }
          
           $errorStr =null;
           return $lst_cm;
           }catch(Exception $e){
               $errorStr =  $e;
               return null;                    
           }
        }
        
        public function get_productype(){
            
            $sql = "SELECT * FROM `commoncode` WHERE `CommonTypeId`='ProductType' AND LENGTH(`CommonId`)=4 AND `NumValue1`=1"; //lấy cấp 2
            $ListProductTypes = $this->db->query($sql)->result();
            return $ListProductTypes;
        }
        //nghia viet them
        public function danh_sach_cmcode_phan_trang($limits,$start)
        {
            $lst_cm = array();
            $this->db->limit($limits,$start);
            $query=$this->db->get('commoncode');
            try{
                $res = json_decode(json_encode($query->result()),true);
                for($i= 0;$i<count($res);$i++){   
               $cm = new  CommonCodeObject();
               $cm->CommonId = $res[$i]['CommonId'] ;
               $cm->CommonTypeId = $res[$i]['CommonTypeId'] ;
               $cm->StrValue1 = $res[$i]['StrValue1'] ;
               $cm->StrValue2 = $res[$i]['StrValue2'] ;
               $cm->NumValue1 = $res[$i]['NumValue1'] ;
               $cm->NumValue2 = $res[$i]['NumValue2'] ;
               $cm->CreatedBy = $res[$i]['CreatedBy'] ;
               $cm->CreatedDate = $res[$i]['CreatedDate'] ;
               $cm->ModifiedBy = $res[$i]['ModifiedBy'] ;
               $cm->ModifiedDate = $res[$i]['ModifiedDate'] ;
               array_push($lst_cm,$cm);
           }
          
           $errorStr =null;
           return $lst_cm;
           }catch(Exception $e){
               $errorStr =  $e;
               return null;                    
           }
        }
        
        public function danh_sach_cmcode()
        {
            $results=$this->db->get('commoncode');
            if($results->num_rows()>0)
                return $results->result();
            return false;
        }
        //end nghia viet them
        public function insert_commoncode( $CommonCodeObject){ 
            $arr = get_object_vars($CommonCodeObject);
            try{               
                $this->db->insert('commoncode', $arr);
                $errorStr =null;
                return 1;
            }catch(Exception $e){
                $errorStr =  $e;
               return 0; 
            }
            
        }
        public function insert_commoncode2( $cm){ 
            //$arr = get_object_vars($CommonCodeObject);
            try{               
                $sql=  " call spInsert_Commoncode('".$cm->CommonTypeId."',".
                                                           "'".$cm->CommonId."',".
                                                           "'".$cm->StrValue1."',".
                                                           "'".$cm->StrValue2."',".
                                                            (($cm->NumValue1)!=''?$cm->NumValue1:0).",".
                                                            (($cm->NumValue2)!=''?$cm->NumValue2:0).",".
                                                            "'".$cm->CreatedBy."')";
                $this->db->query($sql);
                $errorStr =null;
                return 1;
                
            }catch(Exception $e){
                $errorStr = $e;
               return 0; 
            }
            
        }
        public function update2($cm){
            
            try{               
                $sql=  " call spUpdate_Commoncode('".$cm->CommonTypeId."',".
                                                           "'".$cm->CommonId."',".
                                                           "'".$cm->StrValue1."',".
                                                           "'".$cm->StrValue2."',".
                                                            (($cm->NumValue1)!=''?$cm->NumValue1:0).",".
                                                            (($cm->NumValue2)!=''?$cm->NumValue2:0).",".
                                                            "'".$cm->ModifiedBy."')";
                $this->db->query($sql);
                $errorStr =null;
                return 1;
                
            }catch(Exception $e){
                $errorStr = $e;
               return 0; 
            }
            
        }
        public function edit_commoncode($commontypeID,$commID){
            $query = $this->db->get_where('commoncode',array('CommonTypeId' => $commontypeID,'CommonId' => $commID));
            return $query->result();
        }
        
        public function update_commoncode($commontypeID,$commID,$data){
            try{
                $this->db->get_where('commoncode',array('CommonTypeId' => $commontypeID,'CommonId' => $commID));
                $sql = $this->db->update('commoncode',$data); 
                
                $errorStr = null;
                return 1;
            }
            catch(Exception $e){
                $errorStr = $e;
                return 0;
            }
        }
        
        public function delete_commoncode($commontype,$commonId){
            
            $this->db->delete('commoncode',array('CommonTypeId' => $commontype,'CommonId'=>$commonId));
            
        }
        
        
        
      
  }
?>
