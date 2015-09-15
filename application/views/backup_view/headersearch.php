<div class="full-bar">
    <div class="container">
        <div class="row">
                <div class="col-md-3 col-md-offset-9">
                    <div class="input-group search-box">
                    <form id="form1" name="form1" method="post" action="">
                      <input type="text" class="form-control" name="txtsearchhead" id="txtsearchhead" placeholder="What are you looking for?" <?php if(isset($_SESSION['searchspaname'])) echo 'value="'.$_SESSION['searchspaname'].'"'; ?>>
                      <span class="input-group-btn">
                        <button class="btn btn-default" name="btnsearchhead" id="btnsearchhead" type="submit">&nbsp;<span class="glyphicon glyphicon-search"></span></button>
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
            $_SESSION['searchspaname']=$_POST['txtsearchhead'];
        header("Location: ".base_url('category'));
    }
?>