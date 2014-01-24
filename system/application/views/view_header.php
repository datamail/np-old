<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml"
        xmlns:og="http://ogp.me/ns#"
        xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>js/colorbox/colorbox.css" />
<link rel="stylesheet" href="<?php echo $base_url; ?>js/orbit-1.2.3.css" />
<script type="text/javascript" src="<?php echo $base_url; ?>js/jquery-1.4.3.min.js"></script>  
<script type="text/javascript" src="<?php echo $base_url; ?>js/processing-1.1.0.js" ></script>
<script type="text/javascript" src="<?php echo $base_url; ?>js/init.js"></script>
<link href='http://fonts.googleapis.com/css?family=Geo' rel='stylesheet' type='text/css' />
<script type="text/javascript" src="<?php echo $base_url; ?>js/colorbox/jquery.colorbox-min.js"></script>

<title>Number Picture - Crowd-Sourcing New Ways For People To Visualize Data</title>
<meta name="description" content="Number Picture is a web application that enables you to come up with, easily create, and share fresh and interesting tools for visualizing data - that others can then use to visualize their own data." />
<meta name="keywords" content="data visualization visualizing visualising infographic new fresh creative original different" />
<meta name="copyright" content="&copy; 2009-2019 Finn Fitzsimons" />
<meta http-equiv="MSThemeCompatible" content="No" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="pics-label" content="SafeSurf/RASC" />

<meta property="og:title" content="<?php  echo $fb_title;  ?>"/>
<meta property="og:type" content="website"/>
<meta property="og:url" content="<?php echo 'http://' . $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; ?>"/>
<meta property="og:image" content="<?php echo $fb_image;  ?>"/>
<meta property="og:site_name" content="Number Picture" />
<meta property="og:description" content="<?php echo $fb_description;  ?>" />
<meta property="fb:admins" content="701765316" />

<link rel="icon" 
      type="image/png" 
      href="<?php echo $base_url; ?>img/favicon.png" />
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-15172783-5']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>


<body>
    <div id="top"></div>
    
    <div id='login_and_search'>
        <?php echo form_open($base_url . 'search'); ?>
           <input id="search_input" name="search_words" />
        </form>
        <?php
        if(isset($this->session->userdata['logged_in'])){
           if ($this->session->userdata['logged_in'] == TRUE)
           {
              ?>
              <a class="psuedo_button" href="<?php echo ($base_url . "user/logout"); ?>">Log Out</a>
              <a class="psuedo_button" href="<?php echo ($base_url . "user/dashboard"); ?>">Dashboard</a>
              <?php
           }
           else {
               ?>
               <a class="psuedo_button" href="<?php echo ($base_url . "user/login"); ?>">Log In</a>
               <a class="psuedo_button" href="<?php echo ($base_url . "user/register"); ?>">Register</a>
               <?php
           }
        }
        else {
               ?>
               <a class="psuedo_button" href="<?php echo ($base_url . "user/login"); ?>">Log In</a>
               <a class="psuedo_button" href="<?php echo ($base_url . "user/register"); ?>">Register</a>
               <?php
           }
           ?>
           <br />
        
                      
   </div>
    
    <div id='content_wrap'>
        
        <div id='header'>
            <a href='<?php echo ($base_url); ?>' id="header_banner"></a><a href="http://www.commetric.com" target="_blank" title="Commetric"><img src="http://numberpicture.com/img/commetric.png" id="commetric_header" /></a>
        
        </div>
        
         <div id='menu' >
                <a class="visualize" href="<?php echo ($base_url . 'template/search'); ?>" >VISUALIZE</a>                
                <a class="gallery" href="<?php echo ($base_url . "picture/search"); ?>" >GALLERY</a>                
                <a class="make_a_template" href="<?php echo ($base_url . "template/new_template"); ?>" >NEW TEMPLATE</a>
                <a class="learn" href="<?php echo ($base_url . 'user/learn'); ?>" >LEARN</a>               
            </div>
        
        <div id="inner_content">
    
