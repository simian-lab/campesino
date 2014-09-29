<h4 class="alert_info">Usuarios</h4>

<?php 
foreach($output->css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($output->js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

<?php if($message){?><h4 class="alert_success"><?php echo $message;?></h4><?php }?>

<article class="module width_full">

        <header><h3>Listado de usuarios</h3></header>
        <table class="tablesorter" cellspacing="0"> 
        <thead> 
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Grupos</th>
                <th>&nbsp;</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody> 
	<?php foreach ($users as $user):?>
		<tr>
			<td><?php echo $user->first_name;?></td>
			<td><?php echo $user->last_name;?></td>
			<td><?php echo $user->email;?></td>
			<td>
				<?php foreach ($user->groups as $group):?>
					<?php echo $group->name;?><br />
                <?php endforeach?>
			</td>
			<td><a href="<?php echo site_url('auth_ion/edit_user/'.$user->id.'');?>">
                <img src="<?php echo base_url();?>/theme/images/icn_edit.png" />
            </a></td>
			<td><?php echo ($user->active) ? anchor("auth_ion/deactivate/".$user->id, 'Activo') : anchor("auth_ion/activate/". $user->id, 'Inactivo');?></td>
		</tr>
	<?php endforeach;?>
    </tbody>
</table>
</article>