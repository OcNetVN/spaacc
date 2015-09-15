<div class="full-bar">
    <div class="container">
        <div class="row">
                <div class="col-md-3 col-md-offset-9">
                    <div class="input-group search-box">
                    <form id="form1" name="form1" method="post" action="">
                      <input type="text" class="form-control" name="txtsearchhead" id="txtsearchhead" placeholder="Tìm kiếm" <?php if(isset($_SESSION['indexsearch']) && isset($_SESSION['indexsearch']['searchspaname'])) echo 'value="'.$_SESSION['indexsearch']['searchspaname'].'"'; ?>>
                      <span class="input-group-btn">
                        <?php 
                            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            $arr_control = explode("#",$actual_link);
                            $arr_control = explode("/",$arr_control[0]);
                            $control = $arr_control[count($arr_control)-1];
                            echo $control;
                            if($control == "category")
                                echo '<button class="btn btn-default" name="btnsearchhead" id="btnsearchhead" type="button">&nbsp;<span class="glyphicon glyphicon-search"></span></button>';
                            else
                                echo '<button class="btn btn-default" name="btnsearchhead" id="btnsearchhead" type="submit">&nbsp;<span class="glyphicon glyphicon-search"></span></button>';
                        ?>
                      </span>
                    </form>
                    </div><!-- /input-group --> 
                </div>
      </div>
    </div>
</div>     
<?php         
    if(isset($_POST['btnsearchhead']))
    {  
        if(isset($_POST['txtsearchhead']))
            $_SESSION['indexsearch']['searchspaname'] = $_POST['txtsearchhead'];  
			//print_r($_SESSION['indexsearch']['searchspaname']);  
        header("Location: ".base_url('category'));
    }
?>