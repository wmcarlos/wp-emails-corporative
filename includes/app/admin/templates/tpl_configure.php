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

      <br>
      <strong>Correos Corporativos</strong>
      <div class="row" class="add_correos">
        <input type="button" value="+" class="click_correos_corporativos">
        <input type="text" name="txtacrocorporative[]" placeholder="Valor del correo corporativo ej. @tucompañia.com" value="<?php echo $wpemailscpve_options['txtacrocorporative'][0];  ?>">
      </div>
      <div class="details_correo">
          <?php for($i=1; $i<count($wpemailscpve_options['txtacrocorporative']);$i++){ ?>
            <div class="row">
              <input type="button" value="-" class="delete_correos_corporativos">
              <input type="text" name="txtacrocorporative[]" placeholder="Valor del correo corporativo ej. @tucompañia.com" value="<?php echo $wpemailscpve_options['txtacrocorporative'][$i];  ?>">
            </div>
          <?php  } ?>
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
<script type="text/javascript">
  jQuery(document).ready(function($){
    $(".click_correos_corporativos").click(function(){
        $(".details_correo").append('<div class="row"><input type="button" value="-" class="delete_correos_corporativos"><input type="text" name="txtacrocorporative[]" placeholder="Valor del correo corporativo ej. @tucompañia.com" value=""></div>');
    });
    $(document).on('click','.delete_correos_corporativos',function(){
      $(this).parent().remove();
    });
  });
</script>