
  <ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
    <li><a href="index.html">Quản lý Spa</a></li>
    <li class="active">Tiện ích của SPA</li>            
  </ol>
  <h1>Tiện ích của SPa</h1>
 
  <div class="row">
      <div class="col-md-12 col-sm-6">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist" id="templatemo-tabs">
          <li class="active"><a href="#facilities" role="tab" data-toggle="tab">Tiện ích</a></li>
          <li><a href="#spatypes" role="tab" data-toggle="tab">Loại hình spa</a></li>
          <li><a href="#producttypes" role="tab" data-toggle="tab">Các nhóm sản phẩm</a></li>
          <li><a href="#settings" role="tab" data-toggle="tab">Settings</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane fade in active" id="facilities">
            <ul class="list-group">
                <?php 
                    $str_util                   =   "";
                    if(isset($list_util) && count($list_util) > 0)
                    {
                        foreach($list_util as $row_util)
                        {
                            $flag               =   array_search ($row_util->CommonId,$spa_util);
                            if($flag            === false)
                            {
                                $str_check      =   "";
                            }
                            else
                            {
                                $str_check      =   "checked=\"checked\"";
                            }
                            $str_util           .=  '<li class="list-group-item"><input type="checkbox" name="cbutil" '.$str_check.' value="'.$row_util->CommonId.'"> '.$row_util->StrValue1.'</li>';
                        }
                    }
                    echo $str_util;
                ?>
                <!--<input type="radio" name="checkall_util" value="1"> Chọn tất cả
                <input type="radio" name="checkall_util" value="0"> Bỏ tất cả-->
            </ul>
          </div>
          <div class="tab-pane fade" id="spatypes">
            <ul class="list-group">
                <?php 
                    $str_type                   =   "";
                    if(isset($list_type) && count($list_type) > 0)
                    {
                        foreach($list_type as $row_type)
                        {
                            $flag               =   array_search ($row_type->CommonId,$spa_type);
                            if($flag            === false)
                            {
                                $str_check      =   "";
                            }
                            else
                            {
                                $str_check      =   "checked=\"checked\"";
                            }
                            $str_type           .=  '<li class="list-group-item"><input type="radio" name="cbtype" '.$str_check.' value="'.$row_type->CommonId.'"> '.$row_type->StrValue1.'</li>';
                        }
                    }
                    echo $str_type;
                ?>
            </ul>
          </div>
          <div class="tab-pane fade" id="producttypes">
            <ul class="list-group">
                <?php 
                    $str_producttype                   =   "";
                    if(isset($list_producttype) && count($list_producttype) > 0)
                    {
                        /*echo "<pre>";
                        print_r($list_producttype);
                        echo "</pre>";die;*/
                        foreach($list_producttype as $row_producttype)
                        {
                            $flag               =   array_search ($row_producttype->CommonId,$spa_producttype);
                            if($flag            === false)
                            {
                                $str_check      =   "";
                            }
                            else
                            {
                                $str_check      =   "checked=\"checked\"";
                            }
                            $str_producttype           .=  '<li class="list-group-item"><input type="checkbox" name="cbproducttype" '.$str_check.' value="'.$row_producttype->CommonId.'"> '.$row_producttype->StrValue2.'</li>';
                        }
                    }
                    echo $str_producttype;
                ?>
            </ul>
          </div>
          <div class="tab-pane fade" id="settings">
            <div class="list-group">
              <a href="#" class="list-group-item disabled">
                Vivamus dictum posuere odio
              </a>
              <a href="#" class="list-group-item">Porta ac consectetur ac</a>
              <a href="#" class="list-group-item">Vestibulum at eros</a>
              <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
              <a href="#" class="list-group-item">Morbi leo risus</a>
            </div>
          </div>
        </div> <!-- tab-content --> 
      </div>
  </div>

  <div class="row templatemo-form-buttons">
    <div class="col-md-8 col-md-offset-2">
        <span style="color: red; display: none;" id="notifyerr">Sửa không thành công</span>
        <span style="color: blue; display: none;" id="notifysuccess">Sửa thành công</span>
    </div>
    <div class="col-md-12">
        <button type="button" id="btnsave" class="btn btn-primary">Cập nhật</button>
    </div>
  </div>