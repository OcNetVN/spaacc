<ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
    <li><a href="index.html">Quản lý Spa</a></li>
    <li class="active">Quản lý Giá</li>            
</ol>
<h2>Quản Lý Giá Dịch Vụ</h2>


<table class="table table-striped content_table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên dịch vụ</th>
                <th>Thông tin dịch vụ</th>
                <th>Thông tin số chỗ</th>
                <th>Giá hiện tại</th>
                <th>Giá trước đó</th>
                <th>TTin khởi tạo</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($spa_products as $key => $value) {?>
            <tr>
              <td><?php echo $key+1?></td>
              <td><span class="name"><?php echo $value->Name?></span><br /><br />
                  Mã : <?php echo $value->ProductID?><br>
              </td>
              <td>
                  Loại : <?php echo $value->StrValue2?><br /><br />
                  Thời lượng : <?php echo $value->Duration?> phút<br /><br />
                  <?php 
                        $str_title = "Không hoạt động"; 
                        if($value->Status==1){$str_title = "Hoạt động";} 
                  ?>
                  Trạng thái: <img src="../resources/images/active_<?php echo $value->Status?>.png" title="<?php echo $str_title?>" /><br />
              </td>
              <td>
                  Số chỗ còn lại: <?php echo $value->CurrentVouchers?> <br /><br />
                  Số chỗ tối đa trong 1 thời điểm: <?php echo $value->MaxProductatOnce?> <br /><br />
                  Giá trị từ ngày: <?php echo $value->ValidTimeFrom?> <br /><br />
                  Giá trị đến ngày: <?php echo $value->ValidTimeTo?> <br />
              </td>
              <td>
                  <?php 
                    $product_id = $value->ProductID;
                    echo $product_price_today              =   $this->m_common->get_product_price_today($product_id)->Price;
                  ?>
              </td>
              <td>
                  <?php 
                    echo $product_price_edit              =   $this->m_common->get_product_price_edit($product_id)->Price;
                  ?>
              </td>
              <td>
                  Người tạo: <?php echo $value->CreatedBy?> <br /><br />
                  Ngày tạo : <?php echo $value->CreatedDate?>
              </td>
              <td>                                        
                   <a href="javascript:void(0);" onclick="themgia('${ProductID}','${Name}');" title="Thêm giá"><img src="http://localhost:899/Spa/resources/images/icons/pencil.png" alt="Thêm giá" /></a>
                   <a href="javascript:void(0);" onclick="ViewGia('${ProductID}','${Name}',1);"  title="Danh sách giá"><img src="http://localhost:899/Spa/resources/images/icons/show.png" alt="Danh sách giá" />
              </td>
          </tr>
        <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">
                    <div>
                        Trang số: 
                        <select id="cboPageNoPRO1">
                        </select>
                    </div>
                </td>
            </tr>
        </tfoot>

        
    </table>

    <nav>
  <ul class="pagination">
    <li>
      <a href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li>
      <a href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>