<?php 
class M_showproducts extends CI_Model
{
    public function lay_products_theo_id($id)
    {
        $sql="select * from products, spa, price 
                where products.SpaID=spa.SpaID 
                and products.ProductID=price.ProductID 
                and products.ProductID=$id";
        $results=$this->db->query($sql);
        if($results->num_rows()>0)
            return $results->row();
        else
            return false;
    }
     public function lay_hinh_theo_id($id)
    {
        $this->db->where('ObjectIDD',$id);
        $results=$this->db->get('links');
        if($results->num_rows()>0)
            return $results->result();
        else
            return false;
    }
    /*public function danh_sach_user()
    {
        $results=$this->db->get('users');
        if($results->num_rows()>0)
            return $results->result();
        return false;
    }
    public function danh_sach_user_phan_trang($limits,$start)
    {
        $this->db->limit($limits,$start);
        $results=$this->db->get('users');
        if($results->num_rows()>0)
            return $results->result();
        return false;
    }
    public function them_user($UserId,$Pwd,$ObjectId,$Status,$CreatedBy,$CreateDate,$RoleId,$ScoreBalance)
    {
        $data = array(
           'UserId' => $UserId ,
           'Pwd' => $Pwd ,
           'ObjectId' => $ObjectId ,
           'Status' => $Status ,
           'CreatedBy' => $CreatedBy ,
           'CreatedDate' => $CreateDate ,
           'RoleId' => $RoleId ,
           'ScoreBalance' => $ScoreBalance ,
           
        );
        $resutls=$this->db->insert('users',$data);
        return $resutls;
    }
    public function update_user($UserId,$Pwd,$ObjectId,$Status,$RoleId,$ScoreBalance,$ModifiedBy,$ModifiedDate)
    {
        $data = array(
           'Pwd' => $Pwd ,
           'ObjectId' => $ObjectId ,
           'Status' => $Status ,
           'RoleId' => $RoleId ,
           'ScoreBalance' => $ScoreBalance ,
           'ModifiedBy' => $ModifiedBy ,
           'ModifiedDate' => $ModifiedDate ,
        );
         $this->db->where('UserId',$UserId);
        $resutls=$this->db->update('users',$data);
        return $resutls;
    }
    public function update_lastlogin_user($UserId,$LastLogin)
    {
        $data = array(
           'LastLogin' => $LastLogin ,
        );
         $this->db->where('UserId',$UserId);
        $resutls=$this->db->update('users',$data);
        return $resutls;
    }
    public function danh_sach_role()
    {
        $ds_loai=$this->db->get('roles');
        $mang_loai=array();
        foreach($ds_loai->result() as $loai)
        {
            $mang_loai[$loai->RoleId]=$loai->RoleName;
        }
        return $mang_loai;
    }
    public function lay_danh_ObjectGroup()
    {
        $this->db->select('StrValue1,StrValue1');
        $this->db->where('CommonTypeId','ObjectGroup');
        $ds_loai=$this->db->get('commoncode');
        $mang_loai=array();
        foreach($ds_loai->result() as $loai)
        {
            $mang_loai[$loai->StrValue1]=$loai->StrValue1;
        }
        return $mang_loai;
    }
    
    public function xoa_user($id)
    {
        $results=$this->db->delete('users', array('UserId' => $id));
        return $results; 
    }
    public function xoa_nhieu_user($str_id)
    {
        $results=$this->db->query('delete from users where UserId in '.'('.$str_id.')');
        return $results; 
    }
    public function lay_nhieu_object($str_id)
    {
        $results=$this->db->query('select ObjectId from users where UserId in '.'('.$str_id.')');
        if($results->num_rows()>0)
            return $results->result();
        return false;
    }
    public function lay_user_theo_id($id)
    {
        $this->db->where('UserId',$id);
        $results=$this->db->get('users');
        if($results->num_rows()>0)
            return $results->row();
        return false;
    }*/
    
}

?>