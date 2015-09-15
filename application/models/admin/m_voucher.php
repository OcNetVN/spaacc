<?php 
class M_voucher extends CI_Model{
    public function __construct()
    { 
        parent::__construct();
        $this->db2 = $this->load->database('thebooking', TRUE);
    }
    public function layloaithe()
    {
        $sql = "SELECT * FROM `vouchertype` ORDER BY `VourcherType`";
        $query=$this->db2->query($sql)->result();
        $str='<option value="0">Tất cả</option>';
        if(count($query)>0)
        {
            foreach($query as $row)
            {
                $str .= '<option value="'.$row->VourcherType.'">'.$row->VourcherType.'</option>';
            }
        }
        return $str;
    }       
    public function layloaithethem()
    {
        $sql = "SELECT * FROM `vouchertype` ORDER BY `VourcherType`";
        $query=$this->db2->query($sql)->result();
        $str="";
        if(count($query)>0)
        {
            foreach($query as $row)
            {
                $str .= '<option value="'.$row->VourcherType.'">'.$row->VourcherType.'</option>';
            }
        }
        return $str;
    }        
    public function clickbtnsearch()
    {
        if(isset($_POST['timcardno']))
        {
            $str="";
            $page=1;
            $timcardno=$_POST['timcardno'];
            $timloaithe=$_POST['timloaithe'];
            //echo $timloaithe;die;
            $timngaybd=$_POST['timngaybd'];
            if($timngaybd!="")
            {
                $arrngbd=explode("/",$timngaybd);
                $timngaybd=$arrngbd[2]."-".$arrngbd[1]."-".$arrngbd[0];
            }
            $timngayhethan=$_POST['timngayhethan'];
            if($timngayhethan!="")
            {
                $arrnghh=explode("/",$timngayhethan);
                $timngayhethan=$arrnghh[2]."-".$arrnghh[0]."-".$arrnghh[1];
            }
            $timgiatienthe=$_POST['timgiatienthe'];
            $timuerid=$_POST['timuerid'];
            $timtrangthai=$_POST['timtrangthai'];
            $timapdung=$_POST['timapdung'];
            
            $sql="SELECT * FROM `voucher` WHERE 1=1";
            if($timcardno!="")
               $sql.=" AND `VoucherID` LIKE '%$timcardno%'"; 
            if($timloaithe!="0")
               $sql.=" AND `VoucherType` = '$timloaithe'"; 
            if($timngaybd!="")
               $sql.=" AND `ValidForm` LIKE '%$timngaybd%'"; 
            if($timngayhethan!="")
               $sql.=" AND `ValidTo` LIKE '%$timngayhethan%'"; 
            if($timgiatienthe!="")
               $sql.=" AND `Discount` = '$timgiatienthe'"; 
            if($timuerid!="")
               $sql.=" AND `RefUserID` LIKE '%$timuerid%'";
            if($timtrangthai!="9" && $timtrangthai!=9)
               $sql.=" AND `Status` = '$timtrangthai'"; 
            if($timapdung!="9" && $timapdung!=9)
               $sql.=" AND `AppliedForAll` = '$timapdung'";  
            //echo $sql;die;
            $sql.=" ORDER BY `ValidTo`"; 
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            //export excel
            $sql_export=$sql;
            $query_export = $this->db2->query($sql_export)->result();
            if(count($query_export)>0)
                $_SESSION['sql_export_voucher']=$sql_export;
            //end export excel
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            //echo $sql;die;
            $Listbooking = $this->db2->query($sql)->result();
            
            $_arrSpa = $this->AddSTT($Listbooking,$page); 
            /// duyet cho stt zo
                   
            $TotalRecord = count($query_export);
            //$TotalRecord = 0;
            $TotalPage = 1;
            if($TotalRecord % 10 !=0)
            {
                $TotalPage = floor($TotalRecord /10) + 1;
            }
            else
            {
                $TotalPage = floor($TotalRecord /10) ;
            }
            //echo $TotalPage;die;
            //print_r($_arrSpa);die;
            if(count($_arrSpa)>0)
            {
                foreach($_arrSpa as $rowarr)
                {
                    $str .= '<tr>';
                    $str .= '<td>'.$rowarr->STT.'</td>';
                    $ngaybd=explode(" ",$rowarr->ValidForm);
                    $ngaybd=explode("-",$ngaybd[0]);
                    $ngaybd=$ngaybd[2]."-".$ngaybd[1]."-".$ngaybd[0];
                    $ngaykt=explode(" ",$rowarr->ValidTo);
                    $ngaykt=explode("-",$ngaykt[0]);
                    $ngaykt=$ngaykt[2]."-".$ngaykt[1]."-".$ngaykt[0];
                    $str .= '<td>Mã thẻ: '.$rowarr->VoucherID.'<br />Ngày bắt đầu: '.$ngaybd.'<br />Ngày kết thúc: '.$ngaykt.'<br />Loại voucher: '.$rowarr->VoucherType.'</td>';
                    $str .= '<td>UserID: '.$rowarr->RefUserID.'<br />Giá trị thẻ:'.number_format($rowarr->Discount).' VNĐ</td>';
                    $str .= '<td>Trang thái: ';
                    if($rowarr->Status==1 || $rowarr->Status=="1")
                        $str .= 'Đang dùng';
                    else
                        $str .= 'Đã huỷ';
                    $str .= '<br />Áp dụng: ';
                    if($rowarr->AppliedForAll==1 || $rowarr->AppliedForAll=="1")
                        $str .= 'Tất cả';
                    else
                        $str .= 'Một số sản phẩm';
                    $str .= '</td>';
                    $str .= '<td>'.$rowarr->GeneratedID.'</td>';
                    $str .= '<td>';
                        $str .= '<a href="javascript:void(0);" onclick="sua('.$rowarr->VoucherID.')" title="Sửa"><img src="'.base_url('resources/images/icons/pencil.png').'" alt="Sửa" /></a> ';
                        $str .= ' <a href="javascript:void(0);" onclick="xoa('.$rowarr->VoucherID.');"  title="Xóa"><img src="'.base_url('resources/images/icons/cross.png').'" alt="Xóa" /></a>';
                    $str .= '</td>';
                    $str .= '</tr>';
                }
            }
            $res = array("TotalRecord"=>$TotalRecord,"TotalPage"=>$TotalPage,"CurPage"=>$page,"lst"=>$_arrSpa,"str"=>$str);
            return $res;
        }
    }
    //phat sinh ma tu dong
     public function phatsinhma($table,$col,$int)
    {
        $ma=0;
        $sql="select * from $table where $col like '".$int."%'";
        $results=$this->db2->query($sql)->result();
        if(count($results)>0) //co ton tai ma like $int trong csdl
        {
            for($i=0;$i<count($results);$i++)
            {
                $id=$results[$i]->$col;
                $id=(int)substr($id,-6); //lay kieu int 6 so cuoi
                if(($id-$i)>1)
                {
                    $ma=$i+1;
                    break;
                }
            }
            if($ma==0) //ma lien tiep nhau thi them ma lon 1
            {
                $vitri = count($results)-1; //vi tri cuoi cung cua mang chuoi
                $id=$results[$vitri]->$col;
                $id=(int)substr($id,-6);
                $ma=$id+1;
            }
        }
        else
        {
            $ma=1;
        }
        $arr_str=array(
            "1"=>"00000",
            "2"=>"0000",
            "3"=>"000",
            "4"=>"00",
            "5"=>"0",
            "6"=>"",
        );
        $ma=(string)$int.(string)$arr_str[strlen($ma)].(string)$ma;
        return $ma;
    }
    //
    public function searchpro()
    {
        if(isset($_POST['ProName']))  
        {
           $ProName    = $_POST['ProName'];            
            $page       = $_POST["Page"];
            $spanSpaChonTab2 = $_POST['spanSpaChonTab2'];
            $sql="SELECT a.*, b.`spaName` FROM `products` a,`spa` b WHERE 1=1 AND a.`SpaID`=b.`spaID` and b.`SpaID`='$spanSpaChonTab2'";
            $sql1 = "SELECT count(*) as Total FROM `products` a,`spa` b WHERE 1=1 AND a.`SpaID`=b.`spaID` and b.`SpaID`='$spanSpaChonTab2'";
            if($ProName!="")
            {
                $sql.=" AND `Name` LIKE '%$ProName%'";
                $sql1.=" AND `Name` LIKE '%$ProName%'"; 
            }
            $sql.=" ORDER BY `Name`"; 
            $sql1.=" ORDER BY `Name`"; 
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            //echo $sql;die;
            $Listbooking = $this->db->query($sql)->result();
            
            $_arrSpa = $this->AddSTT($Listbooking,$page); 
            /// duyet cho stt zo
                   
            $ResTotalPage = $this->db->query($sql1)->result();
            $TotalRecord = ( $ResTotalPage[0]->Total);
            //$TotalRecord = 0;
            $TotalPage = 1;
            if($TotalRecord % 10 !=0)
            {
                $TotalPage = floor($TotalRecord /10) + 1;
            }
            else
            {
                $TotalPage = floor($TotalRecord /10) ;
            }
                
            $res = array("TotalRecord"=>$TotalRecord,"TotalPage"=>$TotalPage,"CurPage"=>$page,"lst"=>$_arrSpa,"Toto"=>$ResTotalPage);
        return $res; 
        }  
    }
    //
    public function clickbtnthem()
    {
        if(isset($_POST['themloaithe']))
        {
            $userid=$_SESSION['AccUser']['User']->UserId;
            $int=(string)"68".date("Y").date("m").date("d");
            
            $themloaithe=$_POST['themloaithe'];
            $themngaybd=$_POST['themngaybd'];
            $arrngaybd=explode("/",$themngaybd);
            $themngaybd=$arrngaybd[2]."-".$arrngaybd[0]."-".$arrngaybd[1];
            $themngayhethan=$_POST['themngayhethan'];
            $arrngayhh=explode("/",$themngayhethan);
            $themngayhethan=$arrngayhh[2]."-".$arrngayhh[0]."-".$arrngayhh[1];
            $themgiatienthe=$_POST['themgiatienthe'];
            $themuerid=$_POST['themuerid'];
            $themtrangthai=$_POST['themtrangthai'];
            $themapdung=$_POST['themapdung'];
            $minprice=$_POST['minprice'];
            $totalvoucher=$_POST['totalvoucher'];
            $_SESSION['totalvoucher'] = $totalvoucher;
            for($i=1;$i<=$totalvoucher;$i++)
            {
                $CardNo=$this->phatsinhma('voucher','VoucherID',$int);
                $generatedID=rand(6124, 9720);
                $generatedID=md5(md5(md5(md5($generatedID))));
                $generatedID=substr($generatedID,9,5);
                $sql="INSERT INTO `voucher` (`VoucherID`, `RefUserID`, `ValidForm`, `ValidTo`, `Status`, `Discount`, `AppliedForAll`, `CreatedDate`, `CreatedBy`, `VoucherType`, `GeneratedID`, `PriceMin`) 
                    VALUES ('$CardNo', '$themuerid', '$themngaybd', '$themngayhethan', '$themtrangthai', '$themgiatienthe', '$themapdung', NOW(), '$userid', '$themloaithe', '$generatedID', '$minprice')";
                $query=$this->db2->query($sql);
                if(isset($_POST['tatcaspspa']) && ($_POST['tatcaspspa']==1 || $_POST['tatcaspspa']=="1"))
                {
                    $spaid=$_POST['spanSpaChonTab2'];
                    $listsp=$this->laytatcasp_theospaid($spaid);
                    foreach($listsp as $rowlissp)
                    {
                        $proid=$rowlissp->ProductID;
                        $sql_voucherdetail="INSERT INTO `voucherdetail` (`id`, `VoucherID`, `ProductID`, `CreateBy`, `CreateDate`, `ModifiedBy`, `ModifiedDate`) 
                                    VALUES (NULL, '$CardNo', '$proid', '$userid', NOW(), NULL, NULL)";
                        $query=$this->db2->query($sql_voucherdetail);
                    }
                }
                else
                {
                    if(isset($_POST['tatcaspspa']) && ($_POST['tatcaspspa']==0 || $_POST['tatcaspspa']=="0"))
                    {
                        if(isset($_POST['spanProList']))
                        {
                            $spanProList=$_POST['spanProList'];
                            $spanProList=substr($spanProList,0,(strlen($spanProList)-1));
                            $arrprolist=explode(";",$spanProList);
                            foreach($arrprolist as $rowpro)
                            {
                                $sql_voucherdetail="INSERT INTO `voucherdetail` (`id`, `VoucherID`, `ProductID`, `CreateBy`, `CreateDate`, `ModifiedBy`, `ModifiedDate`) 
                                            VALUES (NULL, '$CardNo', '$rowpro', '$userid', NOW(), NULL, NULL)";
                                $query=$this->db2->query($sql_voucherdetail);
                            }
                        }
                    }
                }
            }
            if($query)
                $arr=array(
                            "sd"=>1,
                            "tb"=>"Thêm thành công",
                            "cardno"=>$CardNo,
                            "generatedID"=>$generatedID
                            );
            else
                $arr=array(
                            "sd"=>0,
                            "tb"=>"Thêm không thành công",
                            "cardno"=>"",
                            "generatedID"=>""
                            );
            return $arr;
        }
    } 
    public function searchvoucher()
    {
        //0: chua thanh toan ma huy
        //1:chua thanh toan
        //2:da thanh toan
        //3:member da thanh toan ma huy nhung cho xet duyet cua admin
        //4:xac nhan huy cua admin
        $str="";
        if(isset($_POST['Page']) && $_POST['Page']!="")
        {
            $page=$_POST['Page'];
            if(isset($_SESSION['sql_export_voucher']))
                $sql = $_SESSION['sql_export_voucher'];
            else
                $sql = "SELECT * FROM `voucher` ORDER BY `CreatedDate` DESC";
                
            $arrvoucher = $this->db2->query($sql)->result();
            
            $StartPos =1;
            $StartPos = ($page - 1)*10;
            $EndPos =  10;
            
            if($page != '' ){
                $sql = $sql." LIMIT " . $StartPos . "," . $EndPos ;
            }
            
            $Listbooking = $this->db2->query($sql)->result();
            //print_r($Listbooking);die;
            $_arrSpa = $this->AddSTT($Listbooking,$page); 
            /// duyet cho stt zo
                   
            $TotalRecord = (count($arrvoucher));
            //$TotalRecord = 0;
            $TotalPage = 1;
            if($TotalRecord % 10 !=0)
            {
                $TotalPage = floor($TotalRecord /10) + 1;
            }
            else
            {
                $TotalPage = floor($TotalRecord /10) ;
            }
            //echo $TotalPage;die;
            //print_r($_arrSpa);die;
            if(count($_arrSpa)>0)
            {
                foreach($_arrSpa as $rowarr)
                {
                    $str .= '<tr>';
                    $str .= '<td>'.$rowarr->STT.'</td>';
                    $ngaybd=explode(" ",$rowarr->ValidForm);
                    $ngaybd=explode("-",$ngaybd[0]);
                    $ngaybd=$ngaybd[2]."-".$ngaybd[1]."-".$ngaybd[0];
                    $ngaykt=explode(" ",$rowarr->ValidTo);
                    $ngaykt=explode("-",$ngaykt[0]);
                    $ngaykt=$ngaykt[2]."-".$ngaykt[1]."-".$ngaykt[0];
                    $str .= '<td>Mã thẻ: '.$rowarr->VoucherID.'<br />Ngày bắt đầu: '.$ngaybd.'<br />Ngày kết thúc: '.$ngaykt.'<br />Loại voucher: '.$rowarr->VoucherType.'</td>';
                    $str .= '<td>UserID: '.$rowarr->RefUserID.'<br />Giá trị thẻ:'.number_format($rowarr->Discount).' VNĐ</td>';
                    $str .= '<td>Trang thái: ';
                    if($rowarr->Status==1 || $rowarr->Status=="1")
                        $str .= 'Đang dùng';
                    else
                        $str .= 'Đã huỷ';
                    $str .= '<br />Áp dụng: ';
                    if($rowarr->AppliedForAll==2 || $rowarr->AppliedForAll=="2")
                        $str .= 'Tất cả, cả khuyến mãi';
                    else
                    {
                        if($rowarr->AppliedForAll==1 || $rowarr->AppliedForAll=="1")
                            $str .= 'Tất cả';
                        else
                            $str .= 'Một số sản phẩm';
                    }
                    $str .= '</td>';
                    $str .= '<td>'.$rowarr->GeneratedID.'</td>';
                    $str .= '<td>';
                        $str .= '<a href="javascript:void(0);" onclick="sua('.$rowarr->VoucherID.')" title="Sửa"><img src="'.base_url('resources/images/icons/pencil.png').'" alt="Sửa" /></a> ';
                        $str .= ' <a href="javascript:void(0);" onclick="xoa('.$rowarr->VoucherID.');"  title="Xóa"><img src="'.base_url('resources/images/icons/cross.png').'" alt="Xóa" /></a>';
                    $str .= '</td>';
                    $str .= '</tr>';
                }
            }
            $res = array("TotalRecord"=>$TotalRecord,"TotalPage"=>$TotalPage,"CurPage"=>$page,"str"=>$str);
            return $res;
        }
    }
    public function AddSTT($arr,$page)
    {
        $arr1 = (array) $arr;
        for($i=0;$i<count($arr1);$i++)
        {
            $arr1[$i]->STT = (($page-1)*10+($i+1));
        }
        return $arr1;
    }
    public function sua()
    {
        if(isset($_POST['id']))
        {
            $strsp="";
            $strspid="";
            $tatcaspspa=2; // khong ton tai
            $spaid="";
            $spaname="";
            $id=$_POST['id'];
            $sql = "SELECT * FROM `voucher` WHERE `VoucherID`='$id'";
            $query=$this->db2->query($sql)->row();
            
            $sql_loai="SELECT * FROM `vouchertype` ORDER BY `VourcherType`";
            $query_loai=$this->db2->query($sql_loai)->result();
            $str="";
            foreach($query_loai as $row_loai)
            {
                if($query->VoucherType==$row_loai->VourcherType)
                {
                    $str .= '<option value="'.$row_loai->VourcherType.'" selected="selected">'.$row_loai->VourcherType.'</option>';
                }
                else
                {
                    $str .= '<option value="'.$row_loai->VourcherType.'">'.$row_loai->VourcherType.'</option>';
                }
            }
            $strtt="";
            if($query->Status=="1" || $query->Status==1)
            {
                $strtt .= '<option value="1" selected="selected">Đang dùng</option>';
                $strtt .= '<option value="0">Đã huỷ</option>';
            }
            else
            {
                $strtt .= '<option value="1">Đang dùng</option>';
                $strtt .= '<option value="0" selected="selected">Đã huỷ</option>';
            }
            $strad="";
            if($query->AppliedForAll=="2" || $query->AppliedForAll==2)
            {
                $strad .= '<option value="1">Tất cả</option>';
                $strad .= '<option value="2" selected="selected">Tất cả, cả khuyến mãi</option>';
                $strad .= '<option value="0">Một số sản phẩm</option>';
            }
            else
            {
                if($query->AppliedForAll=="1" || $query->AppliedForAll==1)
                {
                    $strad .= '<option value="1" selected="selected">Tất cả</option>';
                    $strad .= '<option value="2">Tất cả, cả khuyến mãi</option>';
                    $strad .= '<option value="0">Một số sản phẩm</option>';
                }
                else
                {
                    $strad .= '<option value="1">Tất cả</option>';
                    $strad .= '<option value="2">Tất cả, cả khuyến mãi</option>';
                    $strad .= '<option value="0" selected="selected">Một số sản phẩm</option>';
                }
            }
            if($query->AppliedForAll=="0" || $query->AppliedForAll==0) //chi ap dung 1 so sp thoi
            {
                $sql_voucherdetail="SELECT * FROM `voucherdetail` WHERE `VoucherID`='$id'";
                $query_voucherdetail=$this->db2->query($sql_voucherdetail)->result();
                if(count($query_voucherdetail)>0)
                {
                    $chay=0;
                    foreach($query_voucherdetail as $row_voucherdetail)
                    {
                        if($chay==0)
                        {
                            $ttspa=$this->layspa_theoproid($row_voucherdetail->ProductID);
                            $spaid=$ttspa->spaID;
                            $spaname=$ttspa->spaName;
                            $sospcuaspa = $this->countsp_theospaid($spaid)->total;
                        }
                        $strsp.= "<div id=\"Prosua".$row_voucherdetail->ProductID."\" class=\"doituongDIVsua\">";
                        $product=$this->laysp_theomasp($row_voucherdetail->ProductID);
                        $tensp=$product->Name;
                        $strspid.=$row_voucherdetail->ProductID.";";
                        $strsp.="<span>".$row_voucherdetail->ProductID." - ".$tensp."</span>";
                        $strsp.="<a href=\"javascript:void(0);\" onclick=\"XoaProsua('Prosua".$row_voucherdetail->ProductID."');\"><img src=\"resources/images/icons/cross_grey_small.png\" height=\"10\" /></a></div>";
                        $chay++;
                    }
                    if($sospcuaspa == count($query_voucherdetail))
                        $tatcaspspa=1;
                    else
                        $tatcaspspa=0;
                }
            }
            
            $arr=array("card"=>$query,"strloai"=>$str,"strtt"=>$strtt,"strad"=>$strad,"strsp"=>$strsp,"strspid"=>$strspid,"spaid"=>$spaid,"spaname"=>$spaname,"tatcaspspa"=>$tatcaspspa);
            return $arr;
        }
    }
    public function countsp_theospaid($spaid)
    {
        $sql="SELECT COUNT(*) AS total FROM `products` a, `spa` b WHERE a.`SpaID`=b.`spaID` AND b.`spaID`='$spaid'";
        $query=$this->db->query($sql)->row();
        return $query;
    }
    public function layspa_theoproid($proid)
    {
        $sql="SELECT b.* FROM `products` a, `spa` b WHERE a.`SpaID`=b.`spaID` AND a.`ProductID`='$proid'";
        $query=$this->db->query($sql)->row();
        return $query;
    }
    public function laysp_theomasp($masp)
    {
        $sql="SELECT * FROM `products` WHERE `ProductID`='$masp'";
        $query=$this->db->query($sql)->row();
        return $query;
    }
    public function clickbtnsua()
    {
        if(isset($_POST['sualoaithe']))
        {
            $userid=$_SESSION['AccUser']['User']->UserId;
            $CardNo=$_POST['suacardno'];
            $sualoaithe=$_POST['sualoaithe'];
            $suangaybd=$_POST['suangaybd'];
            $arrngaybd=explode("/",$suangaybd);
            $suangaybd=$arrngaybd[2]."-".$arrngaybd[0]."-".$arrngaybd[1];
            $suangayhethan=$_POST['suangayhethan'];
            $arrngayhh=explode("/",$suangayhethan);
            $suangayhethan=$arrngayhh[2]."-".$arrngayhh[0]."-".$arrngayhh[1];
            $suagiatienthe=$_POST['suagiatienthe'];
            $suauerid=$_POST['suauerid'];
            $suatrangthai=$_POST['suatrangthai'];
            $suaapdung=$_POST['suaapdung'];
            $minprice=$_POST['suaminprice'];
            
            $sqldelete="DELETE FROM `voucherdetail` WHERE `VoucherID` = '$CardNo'";
            $sqldelete=$this->db2->query($sqldelete);
            $sql="UPDATE `voucher` SET `RefUserID` = '$suauerid', `ValidForm` = '$suangaybd', `ValidTo` = '$suangayhethan', 
                `Status` = '$suatrangthai', `Discount` = '$suagiatienthe', `AppliedForAll` = '$suaapdung', 
                `VoucherType` = '$sualoaithe' WHERE `VoucherID` = '$CardNo'";
            $query=$this->db2->query($sql);
           
           
            if(isset($_POST['tatcaspspa']) && ($_POST['tatcaspspa']==1 || $_POST['tatcaspspa']=="1"))
            {
                $spaid=$_POST['spanSpaChonsua'];
                $listsp=$this->laytatcasp_theospaid($spaid);
                foreach($listsp as $rowlissp)
                {
                    $proid=$rowlissp->ProductID;
                    $sql_voucherdetail="INSERT INTO `voucherdetail` (`id`, `VoucherID`, `ProductID`, `CreateBy`, `CreateDate`, `ModifiedBy`, `ModifiedDate`) 
                                VALUES (NULL, '$CardNo', '$proid', NULL, NULL, '$userid', NOW())";
                    $query=$this->db2->query($sql_voucherdetail);
                }
            }
            else
            {
                if(isset($_POST['tatcaspspa']) && ($_POST['tatcaspspa']==0 || $_POST['tatcaspspa']=="0"))
                {
                    if(isset($_POST['spanProList']))
                    {
                        $spanProList=$_POST['spanProList'];
                        $spanProList=substr($spanProList,0,(strlen($spanProList)-1));
                        $arrprolist=explode(";",$spanProList);
                        foreach($arrprolist as $rowpro)
                        {
                            $sql_voucherdetail="INSERT INTO `voucherdetail` (`id`, `VoucherID`, `ProductID`, `CreateBy`, `CreateDate`, `ModifiedBy`, `ModifiedDate`) 
                                        VALUES (NULL, '$CardNo', '$rowpro', NULL, NULL, '$userid', NOW())";
                            $query=$this->db2->query($sql_voucherdetail);
                        }
                    }
                }
            }
            if($query)
                $arr=array(
                            "sd"=>1,
                            "tb"=>"Sửa thành công"
                            );
            else
                $arr=array(
                            "sd"=>0,
                            "tb"=>"Sửa không thành công"
                            );
            return $arr;
        }
    } 
    
    public function xoa()
    {
        if(isset($_POST['id']))
        {
            $id=$_POST['id'];
            $page=$_POST['page'];
            //echo $_POST['page'];die;
            
            $del=$this->xoavoucher_theovoucherid($id);
            if($del)
                $arr=array("tt"=>1,"page"=>$page);
            else
                $arr=array("tt"=>0,"page"=>$page);
            return $arr;
        }
    }
    public function xoavoucher_theovoucherid($id)
    {
        $sql = "DELETE FROM `voucher` WHERE `VoucherID` = $id";
        $query=$this->db2->query($sql);
        return $query;
    }
    public function laytatcasp_theospaid($spaid)
    {
        $sql = "SELECT * FROM `products` WHERE `SpaID`='$spaid'";
        $query=$this->db->query($sql)->result();
        return $query;
    }
    public function export_excel_voucher()
    {
        $result=array();
        if(isset($_SESSION['sql_export_voucher']) && $_SESSION['sql_export_voucher']!="")
        {
            $sql_ex=$_SESSION['sql_export_voucher'];
            //echo $sql_ex;die;
            $result=$this->db2->query($sql_ex)->result();
        }
        //print_r($result);die;
        return $result;
    }
    public function export_excel_them()
    {
        $result=array();
        if(isset($_SESSION['totalvoucher']) && $_SESSION['totalvoucher']!="")
        {
            $totalvoucher = $_SESSION['totalvoucher'];
            $sql="SELECT * FROM `voucher` ORDER BY `CreatedDate` DESC LIMIT 0, $totalvoucher";
            $result=$this->db2->query($sql)->result();
        }
        //print_r($result);die;
        return $result;
            
    }        
}
?>