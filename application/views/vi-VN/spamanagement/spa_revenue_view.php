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
<p><?php echo anchor('log-in/doanh-thu/xuat-ban-doanh-thu','Xuất Bản Báo Cáo Doanh Thu') ?></p>
<br>

<tr>
<label for="loai">Loại dịch vụ</label>
<select class="combobox">
  <option></option>
  <option value="PA">Dịch vụ A</option>
  <option value="CT">Dịch vụ B</option>
  <option value="NY">Dịch vụ C</option>
  <option value="MD">Dịch vụ D</option>
  <option value="VA">Dịch vụ E</option>
</select>

<select name="dichvu" size="5" >
<option>Dịch vụ A</option>
<option>Dịch vụ B</option>
<option>Dịch vụ C</option>
</select>


</tr>
<br>
<tr>
  <td>
      <label for="ten">Tên dịch vụ</label>
      <select class="combobox">
        <option></option>
        <option value="PA">Tên Dịch vụ A</option>
        <option value="CT">Tên Dịch vụ B</option>
        <option value="NY">Tên Dịch vụ C</option>
        <option value="MD">Tên Dịch vụ D</option>
        <option value="VA">Tên Dịch vụ E</option>
      </select>
  </td>
</tr>
<br>

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



<label for="to">Ðến ngày</label>
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


<button type="button" class="btn btn-info">Search</button>
<table class="table table-striped">
        <thead>
            <tr>
                <th>STT</th>
                <th>Thời gian</th>
                <th>Tên dịch vụ</th>
                <th>Tổng hóa đơn</th>
                <th>Thành tiền(VNÐ)</th>
                <th>Số điểm</th>
            </tr>
        </thead>
        <tbody>
        
    </table>
</html>