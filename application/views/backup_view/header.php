<div class="col-md-6 top-bar-left">
                            <ul class="nav navbar-nav top-menu-left">
                            <?php
                                 if(isset($_SESSION['AccUser']))
                                    {
                             ?>
                             <li id="TabUserMenu" class="dropdown DaLogin" >                          
                                      <a class="dropdown-toggle user-link" href="#" data-toggle="dropdown" id="navLogin"><div class="wrap-thumb small-avatar" style="background-image:url(<?php echo base_url('resources/front/images/avatar-female.png'); ?>)"></div> <span class="caret"></span></a>
                                      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Edit Profile</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="DoThoat();" >Thoát</a></li>
                                        <?php
                                            $LstModule = $_SESSION['AccUser']['CacModule'];
                                             for($i=0;$i<count($LstModule);$i++)
                                             {
                                                 echo "<li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"". $LstModule[$i]->url ."\">" . $LstModule[$i]->Description . "</a></li>";
                                             }
                                         ?>
                                      </ul>                    
                               </li>
                               <li class="DaLogin" >
                                    <a href="javascript:void(0);">Xin chào <span id="spanUIDLogBanner" style="font-weight: bold;">
                                    <?php
                                         echo $_SESSION['AccUser']['Object']->FullName;
                                     ?>
                                    </span>  !! 
                                    Lần cuối bạn đăng nhập: <span id="spanLastLoginBanner" style="font-weight: bold;">
                                    <?php
                                         echo $_SESSION['AccUser']['User']->LastLogin;
                                     ?>
                                    </span> 
                                    </a>
                               </li> 
                             <?php           
                                    }
                                 else
                                    {
                             ?>
                                <li id="TabUserMenu" class="dropdown DaLogin" style="display: none;">                          
                                      <a class="dropdown-toggle user-link" href="#" data-toggle="dropdown" id="navLogin"><div class="wrap-thumb small-avatar" style="background-image:url(<?php echo base_url('resources/front/images/avatar-female.png'); ?>)"></div> <span class="caret"></span></a>
                                      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="index-user.html">Edit Profile</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1"  href="javascript:void(0);" onclick="DoThoat();" >Thoát</a></li>
                                      </ul>                    
                               </li>
                               <li class="DaLogin" style="display: none;">
                                    <a href="javascript:void(0);">Xin chào <span id="spanUIDLogBanner" style="font-weight: bold;"></span>  !! 
                                    Lần cuối bạn đăng nhập: <span id="spanLastLoginBanner" style="font-weight: bold;"></span> 
                                    </a>
                               </li> 
                               
                               <li id="menuLogin" class="ChuaLogin">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#loginModal">Đăng nhập</a>                                   
                               </li>
                               <li class="ChuaLogin">                          
                                    <a href="javascript:void(0);" onclick="register();">Đăng ký thành viên</a>   
                               </li>                                 
                               <li class="ChuaLogin">
                                    <a href="javascript:void(0);">Đăng ký dành cho Spa</a>
                               </li>
                               <?php                                    
                                    }
                                ?>
                               
                            </ul>
                        </div>
                        <div class="col-md-6 top-bar-right">
                            <ul class="nav navbar-nav navbar-right top-menu-right">
                                <li>                          
                                      <a href="#" onClick="parent.location='checkout1'"><span class="glyphicon glyphicon-shopping-cart"></span> Your Cart <span id="spanCardTotalList" class="badge">
                                      <?php
                                           $arrCart = null;
                                           if(isset($_SESSION['Cart']))
                                           {
                                               $arrCart = (array) $_SESSION['Cart'];
                                           }
                                           if($arrCart != null)
                                           {
                                               echo count($arrCart);
                                           }
                                           else
                                           {
                                               echo 0;
                                           }
                                       ?>
                                      </span></a>                   
                                </li>
                                
                                  <li class="dropdown menu-flag">                          
                                      <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin"><img src="<?php echo base_url('resources/front/images/flag-vn.png'); ?>" width="27" height="18" alt="Tiếng Việt" /> <span class="caret"></span></a>
                                      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><img src="<?php echo base_url('resources/front/images/flag-en.png'); ?>" width="27" height="18" alt="Tiếng Việt" /></a></li>
                                      </ul>                    
                                  </li>
                                  <li class="dropdown menu-flag menu-currency">                          
                                      <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin">VND <span class="caret"></span></a>
                                      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">USD</a></li>
                                      </ul>                    
                                  </li>
                              </ul>
                        </div>



<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button id="btnCloseloginModal" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Đăng nhập</h4>
      </div>
      <div class="modal-body">
          <div class="row">            
            <div class="col-md-12">
            
                <form class="form" role="form">
                  <div class="form-group">
                    <button type="button" class="btn btn-default btn-google" style="width:100%;">Google Account</button>
                  </div>
                      <div class="form-group DaLogin">
                    <button type="button" class="btn btn-default btn-facebook" style="width:100%;" href="javascript:void(0)" onclick="singupfacebook();">Facebook Account</button>
                  </div>
                  <hr />
                  
                  <div class="form-group">
                    Email đăng nhập
                    <div class="input-group">
                      <div class="input-group-addon">@</div>
                      <input id="txtUserIDEmail" class="form-control" type="email" placeholder="Enter email">
                    </div>
                  </div>
                  <div class="form-group">
                    Mật mã
                    <label class="sr-only" for="exampleInputPassword2">Password</label>
                    <input id="txtPass" type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"> Nhớ cho lần đăng nhập sau
                    </label>
                  </div>
                  <div class="form-group">
                    <button type="button" class="btn btn-success" onClick="DoLogin();">Đăng nhập</button> 
                      
                  </div>
                    <div class="form-group">
                    <a href="#" onClick="">Quên mật mã?</a>
                  </div>
                  <div >
                    <span id="spanTBLogin" class="informationNote" style="display: none; color: red;" > Lỗi đăng nhập!!!</span>
                  </div>
                </form>                
            </div>
        </div>
      </div>
</div>
 </div>
</div>
<!-- End Modal -->                       
<script type="text/javascript">
function DoThoat()
{
    parent.location="admin/user/logout";    
}

</script>