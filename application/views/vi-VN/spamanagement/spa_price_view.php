<div id="main-content"> <!-- Main Content Section with everything -->
            <div class="clear"></div> <!-- End .clear -->
<div class="content-box" style="display:block;"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <h3>Quản lý dịch vụ giá sản phẩm</h3>
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        
                        <div id="phuongthuc">
                            <input type="button" class="button" id="phuongthucdanhsach" value="Danh sách"/>
                            <input type="button" class="button" id="phuongthuctim" value="Khung tìm kiếm"/>
                        </div>
                        <div class="cpbody" id="khungtim" style="display: none;">
                            <!-- khung tim kiem --->
                            <form id="form1" name="form1" method="post" action="">
                                  <table width="100%" border="0">
                                    <tr>
                                      <td  width="18%">Dịch vục cấp 1</td>
                                      <td  width="38%"><select id="loaicha" class="text-input medium-input">
                                        <option value="0">Tất cả</option>
                                      </select>
                                      </td>
                                      <td rowspan="2" valign="top"  width="11%">Thuộc SPA</td>
                                      <td rowspan="2" valign="top"  width="33%">
                                          <select id="listspa" class="text-input medium-input">
                                                <option value="0">Tất cả</option>
                                          </select>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Dịch vụ cấp 2</td>
                                      <td>
                                          <select id="loaicon" class="text-input medium-input">
                                                <option value="0">Tất cả</option>
                                          </select>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Tên sản phẩm</td>
                                      <td><input type="text" id="timten" class="text-input medium-input"/></td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td><input class="button" type="button" id="button" value="Tim" onclick="searchProducts(1);"/>
                                      <input class="button" type="button" id="reset" onclick="Resettim();" value="Reset" /></td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                  </table>
                            </form>
                            <!-- end khung tim kiem --->                            
                        </div>
                        <div id="khongtimthaygia" style="display: none; color: red; font-weight: bold;">Không tìm thấy kết quả nào của sản phẩm <span id="tensanphamtheogia"></span></div>
                <div id="khongtimthay" style="display: none; color: red; font-weight: bold;">Không tìm thấy kết quả nào</div>
                <div id="divTBKQTim" style="margin-top: 10px; display: none;" class="notification success png_bg">
                    <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                    <div>
                       Tìm được 0 mẫu tin!!!
                    </div>
                </div>        
                        <table id="panelDataPRO" style="display: none;" class="tableborder">                            
                            <thead>
                                <tr>
                                   <th>STT</th>
                                   <th>Mã dịch vụ</th>
                                   <th>Thông tin dịch vụ</th>
                                   <th>Thông tin số chỗ</th>
                                   <th>TTin khời tạo</th>
                                   <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div>
                                            Trang số: 
                                            <select id="cboPageNoPRO">
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                            
                        </table>
                        <!--danh sach gia san pham-->
                        <div id="divTBKQTim1" style="margin-top: 10px; display: none;" class="notification success png_bg">
                            <a href="#" class="close"><img src="<?php echo base_url('resources/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" /></a>
                            <div>
                               Tìm được 0 loại sản phẩm con!!!
                            </div>
                        </div>  
                        <table id="panelDataPRO1" style="display: none;" class="tableborder">                            
                            <thead>
                                <tr>
                                    <th>STT</th>
                                   <th>Tên sản phẩm</th>
                                   <th>Giá</th>
                                   <th>Người tạo</th>
								   <th>Ngày tạo</th>
                                   <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                
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
                        <!--end danh sach gia san pham-->
                        
                    </div> <!-- End #tab1 -->
                    
                   
                    <!-------------THEM gia SAN PHAM--------------->
                    <div class="cpbody" id="khungthemgia" style="display: none;">
                        <form id="themgia">
                            
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                <p>
                                    <label>Tên sản phẩm</label>              
                                    <input class="text-input medium-input" type="text" disabled="disabled" id="tensanphamthem" />
                                    <input type="hidden" id="masanphamgia" />
                                </p>
                                <p>
                                    <label>Giá</label>
                                    <input class="text-input medium-input" type="text" id="giathem"/>
                                </p>
                                <p>
                                    <input class="button" id="btngiathem" onclick="submitthemgia();" type="button" value="Submit" />
                                </p>
                            </fieldset>
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                        </form>
                    </div>
                    <!-------------END gia THEM SAN PHAM--------------->
                </div> <!-- End .content-box-content -->
                </div>
                
             
           
                
            <?php
                $this->load->view($lang.'/admin/footer.php');
            ?>    
            
            
        </div> <!-- End #main-content -->