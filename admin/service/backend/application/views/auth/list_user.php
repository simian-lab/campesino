<h4 class="alert_info">Usuarios</h4>

<?php if($message){?><h4 class="alert_success"><?php echo $message;?></h4><?php }?>
<article class="module width_full">
    <header><h3>Listado de usuarios</h3></header>
    <?php 
    $user_group_id = $this->data['user_group_id'];
    if($this->data['state'] == 'list') {
      echo "<a href='' onclick='activateAll(event, " . $user_group_id . ");' style='color: blue;'>Activar todos</a>";
      echo " - ";
      echo "<a href='' onclick='deactivateAll(event, " . $user_group_id . ");' style='color: blue;'>Desactivar todos</a>";
    }
	echo $output->output;
	?>
</article>

<script type="text/javascript">
	function activate(event, userId) {
		event.preventDefault();
		$.ajax({
          type: 'POST',
          url: '<?php echo base_url('index.php/promociones_procesos/activateUser') ?>',
          data: {user_id: userId},
          success: function(data){
            location.reload(); 
          }
        });
	}
	function deactivate(event, userId) {
		event.preventDefault();
		$.ajax({
          type: 'POST',
          url: '<?php echo base_url('index.php/promociones_procesos/deactivateUser') ?>',
          data: {user_id: userId},
          success: function(data){
            location.reload(); 
          }
        });
	}
  function activateAll(event, userGroupId) {
    event.preventDefault();
    $.ajax({
          type: 'POST',
          url: '<?php echo base_url('index.php/promociones_procesos/activateAll') ?>',
          data: {user_group_id: userGroupId},
          success: function(data){
            location.reload(); 
          }
        });
  }
  function deactivateAll(event, userGroupId) {
    event.preventDefault();
    $.ajax({
          type: 'POST',
          url: '<?php echo base_url('index.php/promociones_procesos/deactivateAll') ?>',
          data: {user_group_id: userGroupId},
          success: function(data){
            location.reload(); 
          }
        });
  }
</script>