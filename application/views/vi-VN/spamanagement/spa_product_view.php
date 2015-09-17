<ol class="breadcrumb">
    <li><a href="#">FCSE Spa</a></li>
    <li><a href="index.html">Quản lý Spa</a></li>
    <li class="active">Sản phẩm & Dịch vụ</li>            
</ol>

<div class="content-box" style="display:block;"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <h3>Quản lý dịch vụ SPA</h3>                     
                       <!--  <a href="#tab2" id="prlist" class="default-tab">Cập nhật SP &  dịch vụ</a> -->
                       <li>
                            <a href="<?php echo site_url('thao-tac/sua-dich-vu-spa') ?>">
                                <span class="glyphicon glyphicon-shopping-cart"></span>
                                <span id="spSLTT">&nbsp;
                                    Thao tác sửa dịch vụ Spa 
                                </span>
                            </a>
                        </li>
                    <body>
                                   <div id="custom-search-input">
                                                    <div class="input-group col-md-3">
                                                        <input type="text" class="  search-query form-control" placeholder="Search">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-danger" type="button">
                                                                <span class=" glyphicon glyphicon-search"></span>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                           
                        <script type="text/javascript">                        
                        </script>
                    </body>
                    <br>
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    <!-------------THEM SAN PHAM--------------->
                    <div class="tab-content default-tab" id="tab2">
                    
                        <form id="form_insert">
                            
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                            <table width="100%" >
                                <tr> 
                                    <td>
                                        <label>Tên dịch vụ</label>
                                        <input class="text-input medium-input" type="text" value="<?php echo $product[0]->Name ;?>" id="txtNameTab2" name="txtNameTab2" />
                                    </td>
                                    <td>
                                        <label>Loại dịch vụ :</label>              
                                        <input id="txtProductIDTab2" type="text" readonly="readonly" value="<?php echo $product[0]->ProductID ;?>" class="text-input medium-input" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                         <label>Chọn SPA cung cấp<span style="color: red;">(*)</span></label>
                                         <a href="javascript:void(0);" class="button" onclick="ChonSpaThemMoi();" >Chọn spa</a>
                                         </td>
                                         <td>
                                            Mã spa: <input id="txtProductIDTab2" type="text" readonly="readonly" value="<?php echo $product[0]->ProductID ;?>" class="text-input medium-input" />
                                         <br />
                                        </td>
                                </tr>

                                <td>
                                    <div class="row templatemo-form-buttons">
                                        <div class="col-md-12">
                                          <button type="button" id="btnsave" class="btn btn-primary">Tìm</button>
                                          <button type="button" id="btnreset" class="btn btn-default">Đặt lại</button>    
                                        </div>
                                    </div>
                                </td>
                                <!--<tr>
                                    <td colspan="2"><label>Chọn nhóm khuyến mãi</label>
                                      
                                        <input type="checkbox"  id="checkpromotion" <?php //echo (substr($product[0]->ProductID, 0, 2)== "12")? "checked":""; ?> readonly="readonly"/>
                                    </td>
                                </tr> -->
                                </table>

                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên dịch vụ</th>
                                            <th>Thông tin số chỗ</th>
                                            <th>Ngày update</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                </table>

                    </div>  
                    <!-------------END THEM SAN PHAM--------------->
                    <!-------------END THEM SAN PHAM--------------->
                </div> <!-- End .content-box-content -->