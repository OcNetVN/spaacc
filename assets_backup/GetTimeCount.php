<?php
  //$start_date = date('Y-m-d H:m:s');
  //$end_date = date('2015-01-15 00:00:00');
  
    $date1 = strtotime('2015-01-15 00:00:00');
    $date2 = time();
    $subTime = $date1 - $date2;
    $y = ($subTime/(60*60*24*365));
    $d = ($subTime/(60*60*24))%365;
    $h = ($subTime/(60*60))%24;
    $m = ($subTime/60)%60;
    $sec = ($subTime)%60;

    $array =  array('valid'=>1,'Years'=> $y,'Days'=>$d ,'Hours'=>$h,'Mins'=>$m,'Secs'=>$sec);
    
    //echo "Difference between ".date('Y-m-d H:i:s',$date1)." and ".date('Y-m-d H:i:s',$date2)." is:\n";
//    echo $y." years\n";
//    echo $d." days\n";
//    echo $h." hours\n";
//    echo $m." minutes\n";
//    echo $sec." seconds\n";
    
     echo json_encode($array);
?>

