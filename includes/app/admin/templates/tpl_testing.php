<?php
	
//obtenemos los datos en caso de que ya esten guardados o los dejamos en blanco para evitar las noticias
$wpemails_cpve_options['txtdomain'] = isset($wpemails_cpve_options['txtdomain']) ? $wpemails_cpve_options['txtdomain'] : '';

?>

<div class="card-form" style="margin-left:20px;">
  <form class="signup" method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>">
	<input type="hidden" name="action" value="wpemails_cpve_testingdata">
    <div class="form-title">Probando Registro de Correo</div>
    <div class="form-body">
      <div class="row">
        <input type="text" name="wpemails_cpve_email" placeholder="Usuario*" value="">@<?php echo $wpemails_cpve_options['txtdomain']; ?><
        <input type="password" name="wpemails_cpve_password" placeholder="Contraseña*" value="">
      </div>
      <div class="row">
        <input type="text" name="wpemails_cpve_quota" placeholder="Quota*" value="">
      </div>
    </div>
    <div class="rule"></div>
    <div class="form-footer">
    	<center>
    		<input  class="fa fa-thumbs-o-up" type="submit" value="guardar">
      	</center>
    </div>
  </form>
</div>

<style type="text/css">
@import url(https://fonts.googleapis.com/css?family=Raleway:400,700);
</style>