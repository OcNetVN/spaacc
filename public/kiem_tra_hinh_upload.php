<?php
function kiem_tra_hinh($file)
{
    $kq='';
    $type = array('image/jpg','image/jpeg','image/png','image/gif');
    if(array_search($file['type'],$type)===false)
        $kq = "Hình upload không hợp lệ <br>";
    if($file['size']>=5000000)
        $kq .= "Hình upload có kích thước lớn";
    return $kq;
}
?>