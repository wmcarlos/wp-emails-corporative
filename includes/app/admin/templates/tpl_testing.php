<?php
//obtenemos los datos en caso de que ya esten guardados o los dejamos en blanco para evitar las noticias
$wpemails_cpve_options['txtdomain'] = isset($wpemails_cpve_options['txtdomain']) ? $wpemails_cpve_options['txtdomain'] : '';

//conexion con la api del cpanel
$d = get_option("wpemails_cpve_options");
$options = $d['txtacrocorporative'];
?>
<center>
<div class="card-form" style="margin-left:20px;">
  <form class="signup" method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>">
	<input type="hidden" name="action" value="wpemails_cpve_testingdata">
    <div class="form-title">Correos de Respuesta Automatica</div>
    <div class="form-body">
      <div class="row">
        <input type="text" name="wpemails_cpve_email" id="wpemails_cpve_email" placeholder="no-reply" value="">
        <select style="height: 45px;" name="wpemails_cpve_domain" id="wpemails_cpve_domain">
          <option>-</option>
        <?php 
          for($i=0;$i<count($options);$i++){
            print "<option value='".$options[$i]."'>".$options[$i]."</option>";
          }
        ?>
        </select>
        
      </div>
      <div class="row">
        <input type="text" name="wp_email_asunto" id="wp_email_asunto" placeholder="Asunto">
        <button type="button" id="wp_button_add_nr_email">+</button>
      </div>
      <table border="1" width="100%">
        <thead>
          <th>Asunto</th>
          <th>Email</th>
          <th>-</th>
        </thead>
        <tbody id="load_nr_data">
          <?php

            $d = get_option('wpemails_cpve_emails');

            $emails = $d['wpemails_cpve_emails'];
            $asuntos = $d['wpemails_cpve_asuntos'];

            for($i=0;$i<count($emails);$i++){
              $cad.="<tr>";
                  $cad.="<td><input type='hidden' name='wpemails_cpve_asuntos[]' value='".$asuntos[$i]."'/>".$asuntos[$i]."</td><td><input type='hidden' name='wpemails_cpve_emails[]' value='".$emails[$i]."'/>".$emails[$i]."</td><td><button type='button' class='wp_email_delete_domain'>X</button></td>";
              $cad.="</tr>";
            }
            print $cad;
          ?>
        </tbody>
      </table>
    </div>
    <div class="rule"></div>
    <div class="form-footer">
    	<center>
    		<input  class="fa fa-thumbs-o-up" type="submit" value="Registrar Correo">
      	</center>
    </div>
  </form>
</div>
</center>
<style type="text/css">
@import url(https://fonts.googleapis.com/css?family=Raleway:400,700);
</style>
<script type="text/javascript">
  jQuery(document).ready(function(){
      jQuery("#wp_button_add_nr_email").click(function(){
        var n = jQuery("#wpemails_cpve_email").val();
        var d = jQuery("#wpemails_cpve_domain option:selected").text();
        var a = jQuery("#wp_email_asunto").val();

        var email = n+d;

        var cad = "<tr>";
                cad+="<td><input type='hidden' name='wpemails_cpve_asuntos[]' value='"+a+"'/>"+a+"</td><td><input type='hidden' name='wpemails_cpve_emails[]' value='"+email+"'/>"+email+"</td><td><button type='button' class='wp_email_delete_domain'>X</button></td>";
            cad+="</tr>";

          jQuery("#load_nr_data").append(cad);

      });

      jQuery("body").on('click','.wp_email_delete_domain',function(){
          jQuery(this).parent().parent().remove();
      });
  });
</script>