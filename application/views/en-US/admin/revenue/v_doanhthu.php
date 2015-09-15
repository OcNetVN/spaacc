<ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
    <li><a href="index.html">Tài chính</a></li>
    <li class="active">Quản lý doanh thu</li>            
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

<h2>Danh Sách Doanh Thu</h2>
<p><?php echo anchor('log-in/doanh-thu/sua-tin-tuc','Thêm Sửa Doanh Thu') ?></p>
<label for="loai">Loại</label>
<select class="combobox">
  <option></option>
  <option value="PA">Theo ngày</option>
  <option value="CT">Theo tháng</option>
  <option value="NY">Theo năm</option>
  <option value="MD">Theo tuần</option>
  <option value="VA">Theo quý</option>
</select>

<script type="text/javascript">
  $(document).ready(function(){
    $('.combobox').combobox();
  });
</script>

<label for="from">Từ ngày</label>
<head>
    <link href="jquery-ui-1.10.1.min.css" rel="stylesheet" />
    <script src="modernizr-2.6.2.min.js"></script>
    <script src="jquery-1.9.1.min.js"></script>
    <script src="jquery-ui-1.10.1.min.js"></script>
    <script>
        $(function() {
            if (!Modernizr.inputtypes['date']) {
                $('input[type=date]').datepicker({
                    dateFormat: 'yy-mm-dd'
                });
            }
        });
    </script>
</head>
<body>
    <input type="date">
</body>



<label for="to">Đến ngày</label>
<head>
    <link href="jquery-ui-1.10.1.min.css" rel="stylesheet" />
    <script src="modernizr-2.6.2.min.js"></script>
    <script src="jquery-1.9.1.min.js"></script>
    <script src="jquery-ui-1.10.1.min.js"></script>
    <script>
        $(function() {
            if (!Modernizr.inputtypes['date']) {
                $('input[type=date]').datepicker({
                    dateFormat: 'yy-mm-dd'
                });
            }
        });
    </script>
</head>
<body>
    <input type="date">
</body>

<button type="baocao">Báo Cáo</button>

<table class="table table-striped">
        <thead>
            <tr>
                <th>STT</th>
                <th>Thời gian</th>
                <th>Tổng hóa đơn</th>
                <th>Tổng tiền(VNĐ)</th>
                <th>Trung bình(VNĐ)</th>
            </tr>
        </thead>
        <tbody>
        
    </table>
</html>