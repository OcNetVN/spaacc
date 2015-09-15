  <ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
    <li><a href="index.html">Quản lý Spa</a></li>
    <li class="active" style="min-width: 50px;">Giờ mở cửa</li>            
  </ol>
  <h1>OPENING HOURS</h1>
  <p class="margin-bottom-15">Giờ làm việc.</p>
    <ul class="week">
        <?php
            $arr_dayofweek          =   array(
                                        2   =>  "Monday",
                                        3   =>  "Tuesday",
                                        4   =>  "Wednesday",
                                        5   =>  "Thursday",
                                        6   =>  "Friday",
                                        7   =>  "Saturday",
                                        8   =>  "Sunday",
                                        9   =>  "Holidays",
                                        );
            $str_res                =   '';
            if(isset($spa_hour) && count($spa_hour) != 0)
            {
                foreach($spa_hour as $row_hour)
                {
                    if($row_hour->AvailableHourFrom !=  0 && $row_hour->AvailableHourFrom !=  "0")
                        $str_check  =   "checked=\"checked\"";
                    else
                        $str_check  =   "";
                        
                    if(strlen($row_hour->AvailableHourFrom) == 1)
                        $hour_from  =   "0".$row_hour->AvailableHourFrom;
                    else
                        $hour_from  =   $row_hour->AvailableHourFrom;
                    if(strlen($row_hour->AvailableHourTo) == 1)
                        $hour_to    =   "0".$row_hour->AvailableHourTo;
                    else
                        $hour_to    =   $row_hour->AvailableHourTo;
                
                    $str_res        .=  '<li class="on">
                                            <div>
                                	            <input type="checkbox" name="cbdayofweek" value="'.$row_hour->DayOfWeek.'" '.$str_check.'>
                                	            <label for="'.$arr_dayofweek[$row_hour->DayOfWeek].'">'.$arr_dayofweek[$row_hour->DayOfWeek].'</label>
                                	            <select id="time_from_'.$row_hour->DayOfWeek.'">';
                                                
                                                    for($i = 0; $i < 25; $i ++)
                                                    {
                                                        if(strlen($i) == 1)
                                                            $str_hour_from      =   "0".$i;
                                                        else
                                                            $str_hour_from      =   $i;
                                                        
                                                        if($hour_from   == $str_hour_from)    
                                                            $str_res            .=  '<option value="'.$str_hour_from.':00" selected="selected">'.$str_hour_from.':00</option>';
                                                        else
                                                            $str_res            .=  '<option value="'.$str_hour_from.':00">'.$str_hour_from.':00</option>';
                                                    }
                                                $str_res        .=  '</select>-';
                           	                    
                           	                    $str_res        .=  ' <select id="time_to_'.$row_hour->DayOfWeek.'">';
                                                    for($i = 0; $i < 25; $i ++)
                                                    {
                                                        if(strlen($i) == 1)
                                                            $str_hour_to        =   "0".$i;
                                                        else
                                                            $str_hour_to        =   $i;
                                                        
                                                        if($hour_to   == $str_hour_to)    
                                                            $str_res            .=  '<option value="'.$str_hour_to.':00" selected="selected">'.$str_hour_to.':00</option>';
                                                        else
                                                            $str_res            .=  '<option value="'.$str_hour_to.':00">'.$str_hour_to.':00</option>';
                                                    }
                                                $str_res        .=  '</select>
                                             </div>
                                        </li>';    
                }
            }
            echo $str_res;
        ?>
    </ul>

    <div class="row templatemo-form-buttons">
        <div class="col-md-8 col-md-offset-2">
            <span style="color: red; display: none;" id="notifyerr">Sửa không thành công</span>
            <span style="color: blue; display: none;" id="notifysuccess">Sửa thành công</span>
        </div>
        <div class="col-md-12">
          <button type="button" id="btnsave" class="btn btn-primary">Cập nhật</button>
        </div>
      </div>