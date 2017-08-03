<?php
	//obtenemos los datos en caso de que ya esten guardados o los dejamos en blanco para evitar las noticias
	$wpemailscpve_options = self::wpemails_cpve_checkoptions();

  //eliminaremos todos los archivos temporales basuras que se generan
  $files = glob(WPEMAILS_CPVE_PLUGIN_DIR.'/includes/app/admin/api/cpmm/*'); // obtiene todos los archivos
  foreach($files as $file){
    if(is_file($file)) // si se trata de un archivo
      unlink($file); // lo elimina
  }


  //conexion con la api del cpanel
  $cpmm = new cPanelMailManager($wpemailscpve_options['user'], $wpemailscpve_options['pass'], $wpemailscpve_options['host']);
  $domains = $cpmm->getDomains();
  $cad = "";

?>
<center>
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
        <?php 
          print "<select id='select_email_corporative'  name='txtacrocorporative[]'>";
          for($i = 0; $i < count($domains); $i++){
            $cad.= "<option value='@".$domains[$i]['basedir']."'>@".$domains[$i]['basedir']."</option>";
          }
          print $cad;
          print "</select>";
        ?>
      </div>
      <div class="details_correo">
          <?php for($i=1; $i<count($wpemailscpve_options['txtacrocorporative']);$i++){ ?>
            <div class="row">
              <input type="button" value="-" class="delete_correos_corporativos">
              <input type="text" name="txtacrocorporative[]" readonly="readonly" placeholder="Valor del correo corporativo ej. @tucompañia.com" value="<?php echo $wpemailscpve_options['txtacrocorporative'][$i];  ?>">
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
</center>
<style type="text/css">
@import url(https://fonts.googleapis.com/css?family=Raleway:400,700);
</style>
<script type="text/javascript">
  jQuery(document).ready(function($){
    $(".click_correos_corporativos").click(function(){
      var cad = $("#select_email_corporative option:selected").text();
      $(".details_correo").append('<div class="row"><input type="button" value="-" class="delete_correos_corporativos"><input type="text" name="txtacrocorporative[]" value="'+cad+'"></div>');
    });
    $(document).on('click','.delete_correos_corporativos',function(){
      $(this).parent().remove();
    });
  });
</script>