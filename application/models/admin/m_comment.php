<?php 
class M_comment extends CI_Model{
    public function __construct()
    { 
        parent::__construct();
    }
    /*
    |----------------------------
    | function search comment
    |----------------------------
    */
    public function btnsearch()
    {
        /*
        | 2: khong cho phep
        | 1 + ApprovedBy == null: chua duyet
        | 1 + ApprovedBy != null: cho phep duyet
        */
        if(isset($_POST["page"]))
        {
            $page               =   $_POST["page"];
            $txtsearch          =   $_POST["txtsearch"];
            $datefrom           =   $_POST["datefrom"]; //mm/dd/yyyy
            $dateto             =   $_POST["dateto"];   //mm/dd/yyyy
            $status             =   $_POST["status"];
            
            if($datefrom != "")
                $strdatefrom    =   substr($datefrom,-4)."-".substr($datefrom,0,2)."-".substr($datefrom,3,2);
            else
                $strdatefrom    =   "2014-01-01";
            if($dateto  != "")
                $strdateto      =   substr($dateto,-4)."-".substr($dateto,0,2)."-".substr($dateto,3,2);
            else
                $strdateto      =   date("Y-m-d");
            
            $RecordOnePage          =   $this->m_common->getSetting("RecordOnePageListComment");
            $totalrow_listcmt       =   $this->get_totalrow_list_comment($txtsearch,$strdatefrom,$strdateto,$status);
            $totalrow               =   $totalrow_listcmt->total;
            $page                   =   $this->m_common->check_page_invalid($totalrow,$page,$RecordOnePage);
            if($page    ==  1 || $page  <   1 || $page  ==  "")
                $start              =   0;
            else
                $start              =   $RecordOnePage*($page-1);
            $limit                  =   $RecordOnePage;
            
            $list_cmt               =   $this->get_list_cmt($start,$limit,$txtsearch,$strdatefrom,$strdateto,$status);
            
            $str_list="";
            $str_numpage="";
            $notfound="<strong style=\"margin:10px;\">Không tìm thấy</strong>";
            if(count($list_cmt)>0)
            {
                $notfound="";
                $stt=$start+1;
                foreach($list_cmt as $row)
                {
                    $str_list .= '<tr>';
                        $str_list       .= '<td>'.$stt.'</td>';
                        $str_list       .= '<td>'.$row->Content.'</td>';
                    
                    if($row->Status     == 2 || $row->Status == "2")
                        $str_list       .= '<td>
                                                <select id="sestatusedit_'.$row->id.'" onchange="changestatus(\''.$row->id.'\');" class="form-control">
                                                    <option value="3">Chưa duyệt</option>
                                                    <option value="1">Cho phép</option>
                                                    <option value="2" selected="selected">Không cho phép</option>
                                                </select>
                                            </td>';
                    if($row->Status     == 1 || $row->Status == "1")
                        if($row->ApprovedBy == "")
                            $str_list   .= '<td>
                                                <select id="sestatusedit_'.$row->id.'" onchange="changestatus(\''.$row->id.'\');" class="form-control">
                                                    <option value="3" selected="selected">Chưa duyệt</option>
                                                    <option value="1">Cho phép</option>
                                                    <option value="2">Không cho phép</option>
                                                </select>
                                            </td>';
                        else
                            $str_list   .= '<td>
                                                <select id="sestatusedit_'.$row->id.'" onchange="changestatus(\''.$row->id.'\');" class="form-control">
                                                    <option value="3">Chưa duyệt</option>
                                                    <option value="1" selected="selected">Cho phép</option>
                                                    <option value="2">Không cho phép</option>
                                                </select>
                                            </td>';
                    
                    if($row->ParentID   != "")
                        $parentcmt      =   $this->get_comment_by_id($row->ParentID);
                    if(count($parentcmt) > 0)
                        $str_list       .= '<td>'.$parentcmt->id.'</td>';
                    else
                        $str_list       .= '<td></td>';
                    
                    if($row->ObjectIDD  != "")
                        $product        =   $this->get_product_by_productid($row->ObjectIDD);
                    if(count($product) > 0)
                        $str_list       .= '<td>'.$product->Name.'</td>';
                    else
                        $str_list       .= '<td></td>';
                        
                    $str_list           .= '<td>Ngày tạo: '.$row->CreatedDate.' <br />Người tạo: '.$row->CreatedBy.'</td>';
                    $str_list           .= '<td>Ngày duyệt: '.$row->ApprovedDate.' <br />Người duyệt: '.$row->ApprovedBy.'</td>';
                    
                    $str_list       .= '<td>
                                           <a href="javascript:void(0);" onclick="deletecomment(\''.$row->id.'\');" title="Xoá">
                                                <img src="'.base_url("resources/images/icons/cross.png").'" alt="Xoá">
                                            </a>
                                        </td>';
                    
                    
                    $str_list .= '</tr>';
                    $stt++;
                }
                //tinh so trang
                $num_page=ceil($totalrow/$limit);
    
                //set previous page of current page
                if($page<=3)
                    $limitprecurrentpage=1;
                else
                    $limitprecurrentpage=$page-2;
                //set next page of current page
                if($page>=($num_page -2))
                    $limitnextcurrentpage=$num_page;
                else
                    $limitnextcurrentpage=$page+2;
                
                if($num_page>0)
                {
                    $str_numpage .= '<ul class="pagination">';
                        if($page==1)
                            $str_numpage .= '<li class="disabled"><a href="javascript:void(0);" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                        else
                            $str_numpage .= '<li ><a href="javascript:void(0);" onclick="btnsearch('.($page-1).',\''.$txtsearch.'\',\''.$datefrom.'\',\''.$dateto.'\',\''.$status.'\');" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                        $runpre=0;
                        $runnext=0;
                        $flag=0;
                        for($i=1;$i<=$num_page;$i++)
                        {
                            if($i>=$limitprecurrentpage && $i<=$limitnextcurrentpage)
                            {
                                if($page == $i)
                                    $str_numpage .= '<li class="active"><a href="javascript:void(0);" >'.$i.'</a></li>';
                                else
                                    $str_numpage .= '<li><a href="javascript:void(0);" onclick="btnsearch('.$i.',\''.$txtsearch.'\',\''.$datefrom.'\',\''.$dateto.'\',\''.$status.'\');" >'.$i.'</a></li>';
                            }
                            else
                            {
                                if($i<=$page)
                                {
                                    if($runpre==0)
                                    {
                                        $str_numpage .= '<li><span>..</span></li>'; 
                                        $runpre++;
                                    }
                                } 
                                if($i>=$page)
                                {
                                    if($runnext==0)
                                    {
                                        $str_numpage .= '<li><span>..</span></li>'; 
                                        $runnext++;
                                    }
                                }
                            }
                        }
                        if($page==$num_page)
                            $str_numpage .= '<li class="disabled"><a href="javascript:void(0);" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
                        else
                            $str_numpage .= '<li ><a href="javascript:void(0);" onclick="btnsearch('.($page+1).',\''.$txtsearch.'\',\''.$datefrom.'\',\''.$dateto.'\',\''.$status.'\');" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
                      $str_numpage .='</ul>';
                }
            }
            $arr = array("totalrow"=>$totalrow,"str_list"=>$str_list,"str_numpage"=>$str_numpage,"notfound"=>$notfound);
            return $arr;
        }
    }
    /*
    |----------------------------
    | function change status
    |----------------------------
    */
    public function changestatus()
    {
        /*
        | 2: khong cho phep
        | 1 + ApprovedBy == null: chua duyet
        | 1 + ApprovedBy != null: cho phep duyet
        */
        if(isset($_POST["id"]))
        {
            $id             =   $_POST["id"];
            $value          =   $_POST["value"];
            $error          =   "Có lỗi xảy ra";
            $success        =   "Thành công";
            $CreatedBy      =   $_SESSION['AccUser']['User']->UserId;
            
            if($value   ==  3 || $value   ==  "3") //chua duyet
                $sql="UPDATE `".DATABASE_1."`.`comments` SET `Status` = '1', `ApprovedBy` = (NULL),`ApprovedDate` = (NULL) WHERE `id` = '$id'";
            else
                if($value   ==  1 || $value   ==  "1") //cho phep
                    $sql="UPDATE `".DATABASE_1."`.`comments` SET `Status` = '1', `ApprovedBy` = '$CreatedBy',`ApprovedDate` = NOW() WHERE `id` = '$id'";
                else
                    if($value   ==  2 || $value   ==  "2") //cho phep
                        $sql="UPDATE `".DATABASE_1."`.`comments` SET `Status` = '2' WHERE `id` = '$id'";
            //echo $sql;die;
            $query=$this->db->query($sql);
            if($query)
                $arr=array("status"=>1,"notify"=>$success);
            else
                $arr=array("status"=>0,"notify"=>$error);
            return $arr;
        }
    }
    /*
    |----------------------------------------------------------------
    |function click button delete comment
    |----------------------------------------------------------------
    */
    public function deletecomment()
    {
        if(isset($_POST['id']))
        {
            $id         =   $_POST['id'];
            $error      =   "Có lỗi xảy ra";
            $success    =   "Thành công";
            
            $sql        =   "DELETE FROM `".DATABASE_1."`.`comments` WHERE `id` = $id";
            $query      =   $this->db->query($sql);
            if($query)
                $arr    =   array("status"  =>  1, "notify"  =>    $success);
            else
                $arr    =   array("status"  =>  0, "notify"  =>  $error);
            return $arr;
        }
    }
    
    /*
    |----------------------------
    | function get total row list comment
    |----------------------------
    */
    public function get_totalrow_list_comment($txtsearch,$strdatefrom,$strdateto,$status)
    {
        /*
        | 2: khong cho phep
        | 1 + ApprovedBy == null: chua duyet
        | 1 + ApprovedBy != null: cho phep duyet
        */
        $sql_plus           =   "";
        if($status  ==  3)  //chua duyet
            $sql_plus       =   " AND a.`Status` = '1' AND a.`ApprovedBy` IS NULL ";
        if($status  ==  1)  //da duyet, cho show
            $sql_plus       =   " AND a.`Status` = '1' AND a.`ApprovedBy` IS NOT NULL ";
        if($status  ==  2)  //khong cho phep
            $sql_plus       =   " AND a.`Status` = '2' ";
            
        $sql="SELECT COUNT(*) AS total FROM `".DATABASE_1."`.`comments` a, `".DATABASE_1."`.`products` b
                WHERE a.`ObjectIDD` = b.`ProductID` AND (a.`ObjectIDD` LIKE '%$txtsearch%' 
                	OR b.`Name` LIKE '%$txtsearch%') AND a.`CreatedDate` BETWEEN '$strdatefrom 00:00:01' AND '$strdateto 23:59:59' 
                	$sql_plus ORDER BY a.`CreatedDate` DESC";
        $query=$this->db->query($sql)->row();
        return $query;
    }
    
    /*
    |----------------------------
    | function search comment
    |----------------------------
    */
    public function get_list_cmt($start,$limit,$txtsearch,$strdatefrom,$strdateto,$status)
    {
        /*
        | 2: khong cho phep
        | 1 + ApprovedBy == null: chua duyet
        | 1 + ApprovedBy != null: cho phep duyet
        */
        $sql_plus           =   "";
        if($status  ==  3)  //chua duyet
            $sql_plus       =   " AND a.`Status` = '1' AND a.`ApprovedBy` IS NULL ";
        if($status  ==  1)  //da duyet, cho show
            $sql_plus       =   " AND a.`Status` = '1' AND a.`ApprovedBy` IS NOT NULL ";
        if($status  ==  2)  //khong cho phep
            $sql_plus       =   " AND a.`Status` = '2' ";
            
        $sql                =   "SELECT a.*,b.`Name` FROM `".DATABASE_1."`.`comments` a, `".DATABASE_1."`.`products` b
                                WHERE a.`ObjectIDD` = b.`ProductID` AND (a.`ObjectIDD` LIKE '%$txtsearch%' 
                                	OR b.`Name` LIKE '%$txtsearch%') AND a.`CreatedDate` BETWEEN '$strdatefrom 00:00:01' AND '$strdateto 23:59:59' 
                                	$sql_plus ORDER BY a.`CreatedDate` DESC limit $start,$limit";
                                 //echo $sql;die;
        $query              =   $this->db->query($sql)->result();
        return $query;
    }
    /*
    |----------------------------
    | function get comment by commentid
    |----------------------------
    */
    public function get_comment_by_id($commentid)
    {
        $sql        =   "SELECT * FROM `".DATABASE_1."`.`comments` WHERE `id` = '$commentid'";
        $query      =   $this->db->query($sql)->row();
        return $query;
    }
    /*
    |----------------------------
    | function get product by productid
    |----------------------------
    */
    public function get_product_by_productid($productid)
    {
        $sql        =   "SELECT * FROM `".DATABASE_1."`.`products` WHERE `ProductID` = '$productid'";
        $query      =   $this->db->query($sql)->row();
        return $query;
    }
}
?>