<style>
h1, h2, h3{
	font-size:20px;
	border-bottom:3px solid #555;
}

a{ color:#336; font-weight:bold; text-decoration:none;}
a:hover{ color:#00F; font-weight:bold; text-decoration:none;}

body, table, th, tr, td{
	font-size:14px;
	color:#555;
	background-color:#E1E1E1;
	margin:0;
}
table{
	width:950px;
}
th, td{	
	margin:10px 0;
	padding:5px;
}
th{	
	text-align:left !important;
	background-color:#999;
}
#contenedor{
	width:1000px;
	margin:0 auto;	
	padding:0 10px 10px 0;
	background-color:#FFF;
}
#menu{
	width:1000px;
	padding:15px 10px 10px 0;
	background-color:#000;
}
#menu a{
	color:#FFF;
	padding-left:15px;	
	text-decoration:none;
	font-weight:normal;
}
#menu a:hover{
	color:#d6d6d6;
}

#central{
	width:980px;
	margin:0 auto;	
	padding:10px;
	background-color:#FFF;
}
#infoMessage{
	color:#B30000;
	line-height:10px;
	margin:0 0 5px 50px;
}
</style>
<div id="contenedor">
	<div id="menu">
    	<?php if(isset($activa_menu)){?>
            <a href="<?php echo site_url('auth_ion/');?>">Inicio</a> 
            <a href="<?php echo site_url('auth_ion/list_process');?>">Listado de Procesos</a> 
            <a href="<?php echo site_url('auth_ion/logout');?>">Salir </a> 
       	<?php }?>
    </div>
    <div id="central">
        