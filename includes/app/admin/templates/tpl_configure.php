<?php
	//obtenemos los datos en caso de que ya esten guardados o los dejamos en blanco para evitar las noticias
	$wpemails_cpve_options['txtdomain'] = isset($wpemails_cpve_options['txtdomain']) ? $wpemails_cpve_options['txtdomain'] : '';

	$wpemails_cpve_options['txtuser'] = isset($wpemails_cpve_options['txtuser']) ? $wpemails_cpve_options['txtuser'] : '';
	
	$wpemails_cpve_options['txtpassword'] = isset($wpemails_cpve_options['txtpassword']) ? $wpemails_cpve_options['txtpassword'] : '';
?>
<!--formulario de configuracion-->
<div class="panel panel-default">
	<div class="panel-heading"><h2>Configuración de cuenta</h2></div>
	<hr>
		<div class="panel-body">
			<form name="fsetting" id="fsetting" method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>">
				<input type="hidden" name="action" value="wpemails_cpve_importdata">
				<div class="form-group">
					<label for="txtdomain">Dominio:</label>
					<input type="text" class="form-control" value="<?php echo $wpemails_cpve_options['txtdomain'];  ?>" name="txtdomain" id="txtdomain">
				</div>
				<div class="form-group">
					<label for="txtuser">Usuario:</label>
					<input type="text" class="form-control" value="<?php echo $wpemails_cpve_options['txtuser'];  ?>" name="txtuser" id="txtuser">
				</div>
				<div class="form-group">
					<label for="txtpassword">Contraseña:</label>
					<input type="password" class="form-control" value="<?php echo $wpemails_cpve_options['txtpassword'];  ?>" name="txtpassword" id="txtpassword">
					<input type="hidden" name="txtoperation" value="save_setting">
				</div>
				<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Save</button>
			</form>
	</div>
</div>
