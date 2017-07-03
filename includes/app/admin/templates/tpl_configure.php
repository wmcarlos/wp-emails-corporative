<?php
	//obtenemos los datos en caso de que ya esten guardados o los dejamos en blanco para evitar las noticias
	$wpemailscpve_options = self::wpemails_cpve_checkoptions();
?>

<div class="card-form" style="margin-left:20px;">
  <form class="signup" method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>">
	<input type="hidden" name="action" value="wpemails_cpve_importdata">
    <div class="form-title">Configuración de cuenta!</div>
    <div class="form-body">
      <div class="row">
        <input type="text" name="txtdomain" placeholder="Dominio*" value="<?php echo $wpemailscpve_options['host'];  ?>">
        <input type="text" name="txtuser" placeholder="Usuario*" value="<?php echo $wpemailscpve_options['user'];  ?>">
      </div>
      <div class="row">
        <input type="password" name="txtpassword" placeholder="Password*" value="<?php echo $wpemailscpve_options['pass'];  ?>">
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