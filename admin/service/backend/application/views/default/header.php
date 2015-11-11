<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Administrador :: Especiales LoEncontraste.com</title>

	<link rel="stylesheet" href="<?php echo base_url();?>css/layout.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>css/styles.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<script src="<?php echo base_url();?>js/jquery-1.5.2.min.js" type="text/javascript"></script>
<!-- GROCERY CRUD -->
	<?php if(isset($output)){?>
		<?php foreach($output->css_files as $file): ?>
			<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
		<?php endforeach; ?>
    <?php }?>
	<?php if(isset($output->js_files)){?>
		<?php foreach($output->js_files as $file): ?>
            <script src="<?php echo $file; ?>"></script>
        <?php endforeach; 
		?>
    <script src="<?php echo base_url();?>/service/backend/assets/grocery_crud/themes/datatables/js/datatables-extras.js"></script>
    <?php }?>
<!-- GROCERY CRUD -->
	<?php if($this->uri->segment(2)=='login'): ?>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<?php endif; ?>
	<script src="<?php echo base_url();?>js/hideshow.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.equalHeight.js"></script>
	<script type="text/javascript">
	$(document).ready(function() { 
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

<style type="text/css">
#popup {
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 1001;
}

.content-popup {
    margin:0px auto;
    margin-top:30%;
    padding:10px;
    width:470px;
    min-height:350px;
    border-radius:4px;
    background-color:#FFFFFF;
    box-shadow: 0 2px 5px #666666;
}

.close {
    position:relative;
    left:458px;
    font-weight:bold;
    font-size: 18px;
}
</style>
</head>
<body>

	<header id="header">
		<hgroup>
			<?php //if($activa_menu){?>
				<h1 class="site_title"><a href="main">
                Administrador<strong></strong></a></h1>
			<?php //}?>
			<h2 class="section_title">&nbsp;</h2>	
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<?php if($activa_menu){?>
            <div class="user">
                <p><?php echo strtoupper($user);?> (<?php echo $email;?>)</p>
                 <a class="logout_user" href="<?php echo site_url('main/logout');?>" title="Logout">Logout</a>
            </div>
		<?php }?>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs">
	            <a href="<?php echo site_url('main/index');?>">Administrador</a> <div class="breadcrumb_divider"></div>
            	<?php echo $breadcrumbs;?>
            </article>
		</div>
	</section><!-- end of secondary bar -->
    <!-- TIENE PERMISO PARA PODER OBSERVAR EL MENU, LO MUESTRO. -->
	<?php if($activa_menu){?>
        <aside id="sidebar" class="column">
        
            <!--<form class="quick_search">
                <input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
            </form>-->
            <hr/>
            <!-- IMPRIMO EL MENU DEPENDIENDO EL USUARIO INGRESADO. -->
            <?php echo $menu_usuario;?>
        
            <footer>
                <hr />
            </footer>
        </aside><!-- end of sidebar -->
	<?php }?>       	
    
	<section id="main" class="column">
    
    
