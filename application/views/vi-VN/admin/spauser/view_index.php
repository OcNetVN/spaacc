<?php
if(!isset($_SESSION['AccUser']['user_name']))
{
    redirect('login');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        <title>Spa Booking Admin</title>
        <link rel="stylesheet" href="<?php echo base_url('resources/css/reset.css'); ?>" type="text/css" media="screen" />
      
        <link rel="stylesheet" href="<?php echo base_url('resources/css/style.css'); ?>" type="text/css" media="screen" />
        
        <link rel="stylesheet" href="<?php echo base_url('resources/css/invalid.css'); ?>" type="text/css" media="screen" />    
        
        <!-- jQuery -->
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/jquery-1.3.2.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('resources/scripts/admin/menu.js'); ?>"></script>
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
            
            <div id="messages" style="display: none"> <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->
                
                <h3>3 Messages</h3>
             
                <p>
                    <strong>17th May 2009</strong> by Admin<br />
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue.
                    <small><a href="#" class="remove-link" title="Remove message">Remove</a></small>
                </p>
             
                <p>
                    <strong>2nd May 2009</strong> by Jane Doe<br />
                    Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.
                    <small><a href="#" class="remove-link" title="Remove message">Remove</a></small>
                </p>
             
                <p>
                    <strong>25th April 2009</strong> by Admin<br />
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue.
                    <small><a href="#" class="remove-link" title="Remove message">Remove</a></small>
                </p>
                
                <form action="#" method="post">
                    
                    <h4>New Message</h4>
                    
                    <fieldset>
                        <textarea class="textarea" name="textfield" cols="79" rows="5"></textarea>
                    </fieldset>
                    
                    <fieldset>
                    
                        <select name="dropdown" class="small-input">
                            <option value="option1">Send to...</option>
                            <option value="option2">Everyone</option>
                            <option value="option3">Admin</option>
                            <option value="option4">Jane Doe</option>
                        </select>
                        
                        <input class="button" type="submit" value="Send" />
                        
                    </fieldset>
                    
                </form>
                
            </div> <!-- End #messages -->
            
        </div></div> <!-- End #sidebar -->
        
        <div id="main-content"> <!-- Main Content Section with everything -->
            
            <noscript> <!-- Show a notification if the user has disabled javascript -->
                <div class="notification error png_bg">
                    <div>
                        Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
                    Download From <a href="http://www.exet.tk">exet.tk</a></div>
                </div>
            </noscript>          
            
            <!-- user -->
            <h2>Welcome Nguyen Ngoc Kim Thuan</h2>
            <!-- end user -->           
            <div class="clear"></div> <!-- End .clear -->
            
            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <h3>Người quản lý spa</h3>
                    
                    <ul class="content-box-tabs">
                        <li><a href="#tab1" class="default-tab">Danh sách</a></li> 
                        <!-- href must be unique and match the id of target div -->
                        <li><a href="#tab2">Add new spa user</a></li>
                    </ul>
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> 
                    <!-- This is the target div. id must match the href of this div's tab -->                                  
                        <table>
                            
                            <thead>
                                <tr>
                                   <th><input class="check-all" type="checkbox" /></th>
                                   <th>Tên Spa</th>
                                   <th>Người dùng</th>
                                   <th>Ngày tạo</th>
                                   <th>Người tạo</th>                                  
                                   <th>Thao tác</th>
                                </tr>    
                            </thead> 
                                                  
                            <tfoot>
                                <tr>
                                    <td colspan="6">                                      
                                        <div class="pagination">
                                            <?php 
                                                if(isset($links)) // phan trang
                                                    echo $links;
                                            ?>
                                        </div> <!-- End .pagination -->
                                        <div class="clear"></div>
                                    </td>
                                </tr>
                            </tfoot>
                         
                            <tbody>
                            <?php 
                            foreach($query as $row) {
                            ?>
                                <tr>                                
                                    <td><input type="checkbox" /></td>
                                    <td><?php echo $row->SpaID; ?></td>
                                    <td><?php echo $row->UserID;?></td>
                                    <td><?php echo $row->CreatedDate;?></td>
                                    <td><?php echo $row->CreatedBy;?></td>
                                    <td>
                                        <!-- Icons -->
                                         <a href="spauser/delete/<?php echo $row->SpaID; ?>/<?php echo $row->UserID; ?>" title="Delete"><img src="<?php echo base_url('resources/images/icons/cross.png'); ?>" alt="Delete" /></a> 
                                                                                           
                                    </td>
                                </tr>
                                <?php  }?>
                            </tbody>                           
                        </table>                       
                    </div> <!-- End #tab1 -->
                
                    <div class="tab-content" id="tab2">                   
                        <form action="spauser/insert" method="post">                            
                            <fieldset> 
                <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->    
                                <p>
                                    <label>Tên Spa</label>              
                                    <select name="spaID" class="small-input">
                                        <?php 
                                            foreach($spa as $row) {
                                        ?>
                                        <option value="<?php echo $row->spaID;?>"><?php echo $row->spaName;?> </option>
                                        
                                        <?php } ?>
                                    </select> 
                                </p>
                                
                                <p>
                                    <label>Người quản lý</label>
                                    <input class="text-input small-input" type="text" id="small-input" name="userID" /> 
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
            
            
            
           
            <div class="clear"></div>         
           
            
        </div> <!-- End #main-content -->
        
    </div></body>
  

</html>
