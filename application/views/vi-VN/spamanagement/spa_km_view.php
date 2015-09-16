<ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
    <li><a href="index.html">Quản lý Spa</a></li>
    <li class="active">Khuyến mãi</li>            
  </ol>
<html>
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

<h2>Quản lý khuyến mãi SPA</h2>
<p><?php echo anchor('log-in/doanh-thu/sua-tin-tuc','Thêm Khuyến Mãi') ?></p>

<table width="100%" >
    <tr>
        <td>
            <label>Mã dịch vụ :</label>              
            <input id="txtProductIDTab2" type="text" readonly="readonly" value="<?php echo $product[0]->ProductID ;?>" class="text-input medium-input" />
        </td>
        <td>
            <label>Tên dịch vụ</label>
            <input class="text-input medium-input" type="text" value="<?php echo $product[0]->Name ;?>" id="txtNameTab2" name="txtNameTab2" />
        </td>
    </tr>


<tr>
    <td>
      <label>Mã khuyến mãi</label>
      <select class="combobox">
        <option></option>
        <option value="PA">Theo ngày</option>
        <option value="CT">Theo tháng</option>
        <option value="NY">Theo năm</option>
        <option value="MD">Theo tuần</option>
        <option value="VA">Theo quý</option>
      </select>
    </td>
</tr>

</table>
<script type="text/javascript">
  $(document).ready(function(){
    $('.combobox').combobox();
  });
</script>



<button type="button" class="btn btn-info">Search</button>
<button type="button" class="btn btn-default">Reset</button>

<table class="table table-striped">
        <thead>
            <tr>
                <th>STT</th>
                <th>Thông tin khuyến mãi</th>
                <th>Thông tin sản phẩm</th>
                <th>Thông tin chung</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        
    </table>
</html>