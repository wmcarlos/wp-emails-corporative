<?php
	
//obtenemos los datos en caso de que ya esten guardados o los dejamos en blanco para evitar las noticias
$wpemails_cpve_options['txtdomain'] = isset($wpemails_cpve_options['txtdomain']) ? $wpemails_cpve_options['txtdomain'] : '';

?>

<div class="panel panel-default">
	<div class="panel-heading"><h2>New Email</h2></div>
	<div class="panel-body">
		<form name="femail" id="femail" method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>">
			<input type="hidden" name="action" value="wpemails_cpve_testingdata">
			<div class="form-group">
				<label for="wpemails_cpve_email">Name:</label>
				<div class="input-group">
					<input type="text" class="form-control" name="wpemails_cpve_email">
				     <span>
				        <strong>@<?php echo $wpemails_cpve_options['txtdomain']; ?></strong>
			    	</span>			
			    </div>
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<br>
				<input type="password" name="wpemails_cpve_password" class="form-control">
			</div>
			<div class="form-group">
				<label for="quota">Quota:</label>
				<br>
				<input type="text" name="wpemails_cpve_quota" class="form-control">
				<input type="hidden" name="txtoperation" value="add">
			</div>
			<br>
			<button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Save</button>
			<a href="all.php" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
		</form>
	</div>
</div>