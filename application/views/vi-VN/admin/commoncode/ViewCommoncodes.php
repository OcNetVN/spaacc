<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        
        <title>Spa Booking Admin</title>
        <link rel="stylesheet" href="<?php echo base_url('resources/css/reset.css'); ?>" type="text/css" media="screen" />
      
        <link rel="stylesheet" href="<?php echo base_url('resources/css/style.css'); ?>" type="text/css" media="screen" />
        
        <link rel="stylesheet" href="<?php echo base_url('resources/css/invalid.css'); ?>" type="text/css" media="screen" />    
        
        <!-- jQuery -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery-1.3.2.min.js'); ?>"></script>
        
        <!-- jQuery Configuration -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/simpla.jquery.configuration.js'); ?>"></script>
        
        <!-- Facebox jQuery Plugin -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/facebox.js'); ?>"></script>
        
        <!-- jQuery WYSIWYG Plugin -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.wysiwyg.js'); ?>"></script>
        
        <!-- jQuery Datepicker Plugin -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.datePicker.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery.date.js'); ?>"></script>
        <!--[if IE]><script type="text/javascript" src="resources/scripts/jquery.bgiframe.js"></script><![endif]-->
        
    </head>
  
    <body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
        <div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
            
            <h1 id="sidebar-title"><a href="#">Spa Booking Nhập Liệu</a></h1>
          
            <!-- Logo (221px wide) -->
            <a href="#"><img id="logo" src="<?php echo base_url('resources/images/logo.png'); ?>" alt="Simpla Admin logo" /></a>
          
            <!-- Sidebar Profile links -->
                         
            <?php
                require($_SERVER['DOCUMENT_ROOT'].'/nhaplieuspa/application/views/admin/menu.php');
            ?>
            
        </div></div> <!-- End #sidebar -->
        
        <div id="main-content"> <!-- Main Content Section with everything -->
            
            <!-- Page Head -->
            <!-- user -->
            <h2>Welcome John</h2>
            <!-- end user -->     
            
            <div class="clear"></div> <!-- End .clear -->
            
            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <h3>Content box</h3>
                    
                    <ul class="content-box-tabs">
                        <li><a href="#tab1" class="default-tab">Danh sách common code</a></li> <!-- href must be unique and match the id of target div -->
                        <li><a href="#tab2">Add new common code</a></li>
                    </ul>
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        
                        <table>
                            
                            <thead>
                                <tr>
                                   <th><input class="check-all" type="checkbox" /></th>
                                   <th>STT</th>
                                   <th>Mã loại</th>
                                   <th>Mã Common</th>
                                   <th>Giá trị</th>
                                   <th>Thông tin</th>
                                   <th>Thao tác</th>
                                </tr>
                                
                            </thead>
                         
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div class="pagination">
                                            <a href="#" title="First Page">&laquo; First</a><a href="#" title="Previous Page">&laquo; Previous</a>
                                            <a href="#" class="number" title="1">1</a>
                                            <a href="#" class="number" title="2">2</a>
                                            <a href="#" class="number current" title="3">3</a>
                                            <a href="#" class="number" title="4">4</a>
                                            <a href="#" title="Next Page">Next &raquo;</a><a href="#" title="Last Page">Last &raquo;</a>
                                        </div> <!-- End .pagination -->
                                        <div class="clear"></div>
                                    </td>
                                </tr>
                            </tfoot>
                         
                            <tbody>
                                <?php    $key=1;
                                 foreach ($list_commoncode as $cm) { ?>
                                    <tr>
                                        <td><input type="checkbox" /></td>
                                        <td><?php echo $key;?></td>
                                        <td><?php echo $cm->CommonTypeId;?></td>
                                        <td><?php echo $cm->CommonId;?></td>
                                        <td>
                                            <span>Giá trị chuỗi 1:<?php echo $cm->StrValue1;?></span><br>
                                            <span>Giá trị chuỗi 2:<?php echo $cm->StrValue2;?></span><br>
                                            <span>Giá trị số 3:<?php echo $cm->NumValue1;?></span><br>
                                            <span>Giá trị số 4:<?php echo $cm->NumValue2;?></span>
                                        </td>
                                        <td>
                                           <span>Người tạo:<?php echo $cm->CreatedBy;?></span><br>
                                           <span>Ngày tạo:<?php echo $cm->CreatedDate;?></span>
                                        </td>
                                        <td>
                                            <!-- Icons -->
                                             <a href="commoncode/edit/<?php echo $cm->CommonTypeId;?>/<?php echo $cm->CommonId;?>" title="Edit"><img src="<?php echo base_url('resources/images/icons/pencil.png'); ?>" alt="Edit" /></a>
                                             <a href="commoncode/delete/<?php echo $cm->CommonTypeId;?>/<?php echo $cm->CommonId;?>" title="Delete"><img src="<?php echo base_url('resources/images/icons/cross.png'); ?>" alt="Delete" /></a> 
                                             
                                        </td>
                                    </tr>
                                <?php $key++;} ?>
                            </tbody>
                            
                        </table>
                        
                    </div> <!-- End #tab1 -->
                    
                    <div class="tab-content" id="tab2">
                    
                        <form action="commoncode/insert" method="post">
                            
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                
                                <p>
                                    <label>Tên loại</label>
                                    <select name="commontypeID" class="small-input">
                                        <option value="">-- Chọn tên loại ---</option>
                                        <?php 
                                            foreach($commontype as $row) {
                                        ?>
                                        <option value="<?php echo $row->CommonTypeId;?>"><?php echo $row->Description;?> </option>
                                        
                                        <?php } ?>
                                    </select> 
                                </p>
                                </p>

                                
                                <p>
                                    <label>Mã common</label>
                                    <input class="text-input small-input" type="text" id="small-input" name="commonID" /> 
                                </p>
                                
                                <p>
                                    <label>Giá trị chuổi 1</label>
                                    <input class="text-input small-input" type="text" id="small-input" name="StringValue1" /> 
                                </p>

                                <p>
                                    <label>Giá trị chuổi 2</label>
                                    <input class="text-input small-input" type="text" id="small-input" name="StringValue2" /> 
                                </p>

                                <p>
                                    <label>Giá trị số 1</label>
                                    <input class="text-input small-input" type="text" id="small-input" name="NumberValue1" /> 
                                </p>

                                <p>
                                    <label>Giá trị số 2</label>
                                    <input class="text-input small-input" type="text" id="small-input" name="NumberValue2" /> 
                                </p>
                                
                                <p>
                                    <input class="button" type="submit" value="Submit" />
                                </p>
                                
                            </fieldset>
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                        </form>
                        
                    </div> <!-- End #tab2 -->        
                    
                </div> <!-- End .content-box-content -->
                
            </div> <!-- End .content-box -->
            
           
          
            
            
            <!-- Start Notifications -->         
            
        </div> <!-- End #main-content -->
        
    </div></body>
  

<!-- Download From www.exet.tk-->
</html>
