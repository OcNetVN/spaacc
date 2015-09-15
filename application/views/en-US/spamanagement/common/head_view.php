<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="keywords" content="" />
        <meta name="author" content="" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width">
        <title><?php echo (isset($title) ? $title : ""); ?></title>
        
        <link rel="shortcut icon" href="<?php //echo base_url("assets/img/favicon.png"); ?>" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url("resources/spamanagement/css/templatemo_main.css"); ?>">
        <link href="<?php echo base_url("resources/spamanagement/assets/font-awesome/css/font-awesome.css"); ?>" rel="stylesheet" />
        <?php echo isset($p_custom_css) ? $p_custom_css : ""; ?>
        
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
        <script src="<?php echo base_url("resources/spamanagement/js/html5shiv.js"); ?>"></script>
        <script src="<?php echo base_url("resources/spamanagement/js/respond.min.js"); ?>"></script>
        <![endif]-->
    </head>
    <body>
        