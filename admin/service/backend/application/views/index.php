<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Panel Administrativo</title>

	<link rel="stylesheet" href="<?php echo base_url().'theme/';?>css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="<?php echo base_url().'theme/';?>js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url().'theme/';?>js/hideshow.js" type="text/javascript"></script>
	<script src="<?php echo base_url().'theme/';?>js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo base_url().'theme/';?>js/jquery.equalHeight.js"></script>
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>


<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="index.html">Website Admin</a></h1>
			<h2 class="section_title">Dashboard</h2>	
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>John Doe (<a href="#">3 Messages</a>)</p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs">
            	<a href="index.html">Website Admin</a> <div class="breadcrumb_divider"></div> 
                <a class="current" href="<?php echo site_url('/');?>">Dashboard</a> <div class="breadcrumb_divider"></div> 
                <a class="current" href="<?php echo site_url('auth_ion/');?>">Usuarios</a> <div class="breadcrumb_divider"></div> 
                <a class="current" href="<?php echo site_url('auth_ion/create_user');?>">Agregar</a> 
            </article>
		</div>
	</section><!-- end of secondary bar -->

	<aside id="sidebar" class="column">
	

		<form class="quick_search">
			<input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>
		

		<h3>Usuarios</h3>
		<ul class="toggle">	
            <li class="icn_add_user"><a href="<?php echo site_url('auth_ion/create_user');?>">Agregar</a> </li>
            <li class="icn_view_users"><a href="<?php echo site_url('auth_ion/');?>">Listado</a> </li>
        </ul>

		<h3>Procesos</h3>
		<ul class="toggle">	
            <li class="icn_new_article"><a href="<?php echo site_url('auth_ion/list_process');?>">Agregar</a> </li>
            <li class="icn_categories"><a href="<?php echo site_url('auth_ion/list_process');?>">Listado</a> </li>
        </ul>
		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_jump_back"><a href="<?php echo site_url('auth_ion/logout');?>">Salir </a> </li>
        </ul>
            
       	

<!--		<h3>Content</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="#">New Article</a></li>
			<li class="icn_edit_article"><a href="#">Edit Articles</a></li>
			<li class="icn_categories"><a href="#">Categories</a></li>
			<li class="icn_tags"><a href="#">Tags</a></li>
		</ul>
		<h3>Users</h3>
		<ul class="toggle">
			<li class="icn_add_user"><a href="#">Add New User</a></li>
			<li class="icn_view_users"><a href="#">View Users</a></li>
			<li class="icn_profile"><a href="#">Your Profile</a></li>
		</ul>
		<h3>Media</h3>
		<ul class="toggle">
			<li class="icn_folder"><a href="#">File Manager</a></li>
			<li class="icn_photo"><a href="#">Gallery</a></li>
			<li class="icn_audio"><a href="#">Audio</a></li>
			<li class="icn_video"><a href="#">Video</a></li>
		</ul>
		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_settings"><a href="#">Options</a></li>
			<li class="icn_security"><a href="#">Security</a></li>
			<li class="icn_jump_back"><a href="#">Logout</a></li>
		</ul>
		-->
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2011 Website Admin</strong></p>
			<p>Theme by <a href="http://www.medialoot.com">MediaLoot</a></p>
		</footer>
	</aside><!-- end of sidebar -->
	<section id="main" class="column">
    
    
