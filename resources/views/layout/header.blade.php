<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Business Website Template</title> 
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <script type="text/javascript" src="<?php echo PUB ?>js/jquery-3.1.1.min.js"></script>
    <link href="<?php echo PUB ?>css/tooplate_style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo PUB ?>plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script src="<?php echo PUB ?>plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo PUB ?>js/common.js"></script>
</head>
<body> 
<div id="tooplate_header_wrapper">
    <div id="tooplate_header">
        <div id="site_title">
        	<h1><a href="#"><img src="<?php echo PUB ?>images/site/tooplate_logo.png" alt="business template" /><span>Free HTML Template</span></a></h1>
        </div> 
        <div id="header_phone_no">
			<!-- Toll Free: <span>08 324 552 409</span> -->
            <!-- <a href="javascript:void(0);" onclick="showloginpopup();">Login</a> | <a href="javascript:void(0);" onclick="logoutfunc();">Logout</a> -->
            <a href="world/loginpopup">Login</a> | <a href="world/logout">Logout</a>
        </div>
        
        <div class="cleaner_h10"></div>
        
        <div id="tooplate_menu">
        	
            <div id="home_menu"><a href="#"></a></div>
            <?php echo $this->menu_lib->menu_navigation(); ?>
            <ul>
                <!-- <li><a href="">About Us</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="solutions.html">Solutions</a></li>
                <li><a href="contact.html">Contact</a></li> -->
            </ul>    	
        </div> 
    </div>	  
</div>

<div id="tooplate_middle_wrapper1">
	<div id="tooplate_middle_wrapper2">
		<div id="tooplate_middle">
			<h1>BE ACTIVE<span>with the best coffee</span></h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut lorem id mauris cursus pellentesque. Donec lobortis magna at orci blandit ac lobortis ipsum vestibulum.</p>	
			<a href="#"><span>+</span> More</a>
		</div>
	</div>
</div>
<div class="modal fade tg-user-modal" id="login_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="tg-modal-content tg-haslayout">
        <div class="logindiv"></div>
    </div>
</div>
<script>
var showloginpopup = function(){
    // alert(1);
    $.ajax({
        type:"GET",
        url:"world/loginpopup",
        success: function(html){
            console.log(html);
            if(html){
                $('#login_modal .logindiv').html(html);
                $('#login_modal').modal('show');
            }
        }
    });
}
function closemodal() {
    $('#login_modal').modal('hide');
    $('#login_modal').css("display", "none");
    $(".logindiv").html("");
} 
</script>  