<?php
  $wpemails_cpve_dataoptions = get_option('wpemails_cpve_options');
?>

<script type="text/javascript">
           var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script> 
<div class="card-form" style="margin-left:20px;">
  <form class="signup" method="post" action="">
    <div class="form-title">Registrar Correo Electronico</div>
    <div class="form-body">
      <strong style="color:#707070; margin-left:28px;">Tu Correo:</strong>
      <div class="row">
        <input type="text" name="wpemails_cpve_email" id="wpemails_cpve_email" placeholder="Tu Email" value="">
      </div>

      <strong style="color:#707070; margin-left:28px;">Nombre Completo:</strong>
      <div class="row">
        <input type="text" name="wpemails_cpve_fullname" id="wpemails_cpve_fullname" placeholder="Nombres Completos" value="">
      </div>

      <strong style="color:#707070; margin-left:28px;">Fecha Nacimiento:</strong>
      <div class="row">
        <input type="date" name="wpemails_cpve_fechanamiciento" id="wpemails_cpve_fechanamiciento" placeholder="Fecha de nacimiento" value="">
      </div>


      <strong style="color:#707070; margin-left:28px;">Pais:</strong>
      <div class="row">
          <input type="text" placeholder=""  name="wpemails_cpve_pais"  id="wpemails_cpve_pais">
      </div>

      <strong style="color:#707070; margin-left:28px;">Ciudad:</strong>
      <div class="row">
          <textarea placeholder="Direccion"  name="wpemails_cpve_direction"  id="wpemails_cpve_direction" style="height:100px;"></textarea>
      </div>
      <strong style="color:#707070; margin-left:28px;">Correo Corporativo:</strong>
      <div class="row">
        <input type="text" name="wpemails_cpve_email_corporative" id="wpemails_cpve_email_corporative" placeholder="Ingresa la cuenta de correo corporativo" value="">
        <input type="text" readonly="readonly" name="txtacrocorporative" id="txtacrocorporative" value="<?php echo $wpemails_cpve_dataoptions['txtacrocorporative']; ?>">
      </div>

      <strong style="color:#707070; margin-left:28px;">Contraseña:</strong>
      <div class="row">
        <input type="password" name="wpemails_cpve_password" id="wpemails_cpve_password" placeholder="Contraseña*" value="">
      </div>
      <div class="row">
          <p style="color:#707070 !important; display:block; font-size:10px !important; margin-left:-250px;">
          Minimo 8 caracteres
          <br>
          Maximo 15 caracteres
          <br>
          Al menos una letra mayúscula
          <br>
          Al menos una letra minucula
          <br>
          Al menos un dígito
          <br>
          No espacios en blanco
          <br>
          Al menos 1 caracter especial
        </p>
      </div>
      <!--crear planes-->
      <?php
          $args = array(
              'post_type' => 'wpemails_cpve_planes',
              'orderby' => 'asc'
          );
          $the_query = new WP_Query( $args );
      ?>
      <strong style="color:#707070; margin-left:28px;">Seleccione Plan:</strong>
      <div class="row">
        <select name="wpemails_cpve_plan" id="wpemails_cpve_plan">
          <option value="">Seleccionar plan</option>
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <option value="<?php echo the_content(); ?>"><?php echo the_title()." - ".get_the_content();?></option>
        <?php endwhile; ?>
        </select>
      </div>

      <strong style="color:#707070; margin-left:28px;">Numero de confirmacion Paypal:</strong>
      <div class="row">
        <input type="text" name="wpemails_cpve_num_confirmacion" id="wpemails_cpve_num_confirmacion" placeholder="Ingrese el numero de confirmacion del deposito paypal" value="">
      </div>

    </div>
    <p>
      <center><strong id="wpemails_cpve_alert" style="color:#707070; display:none;">Enviando....</strong></center>
    </p>
    <div class="rule"></div>
    <div class="form-footer">
      <center>
        <input  class="fa fa-thumbs-o-up" id="wpemails_register" type="button" value="Registrarme">
        </center>
    </div>
  </form>
</div>

<style type="text/css">
@import url(https://fonts.googleapis.com/css?family=Raleway:400,700);
/*-------------------estilos para el formulario de configure y test---------------*/
.wpem_user_screen_input_failed{
    border:1px solid red !important;
  }
</style>
<?php 
  $nonce = wp_create_nonce('wpemails_register_ajax');
?>
<script type="text/javascript">
  var wpemails_pattern_email = /^[a-z]+[a-z-0-9_]+@[a-z]+\.[a-z]{2,4}/
  var wpemails_pattern = /^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$/
  var wpemails_pattern_letters  = /^[a-zA-Z-0-9]+$/
  var wpmails_pattern_password = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/;


  jQuery(document).ready(function($){
      $("#wpemails_register").on('click',function(){
        wpemails_cpve_email = $("#wpemails_cpve_email").val();
        wpemails_cpve_password =  $("#wpemails_cpve_password").val();
        wpemails_cpve_fullname = $("#wpemails_cpve_fullname").val();
        wpemails_cpve_direction =  $("#wpemails_cpve_direction").val();
        wpemails_cpve_email_corporative=  $("#wpemails_cpve_email_corporative").val();
        wpemails_nosubmit = 0;

        //valitate required fields
        if(!wpemails_pattern.test(wpemails_cpve_fullname)){
           $("#wpemails_cpve_fullname").addClass('wpem_user_screen_input_failed');
              wpemails_nosubmit=1;
        }else{
           $("#wpemails_cpve_fullname").removeClass('wpem_user_screen_input_failed');
        }
        if(!wpemails_pattern_email.test(wpemails_cpve_email)){
           $("#wpemails_cpve_email").addClass('wpem_user_screen_input_failed');
              wpemails_nosubmit=1;
        }else{
           $("#wpemails_cpve_email").removeClass('wpem_user_screen_input_failed');
        }

        if(!wpemails_pattern_letters.test(wpemails_cpve_email_corporative)){
           $("#wpemails_cpve_email_corporative").addClass('wpem_user_screen_input_failed');
              wpemails_nosubmit=1;
        }else{
           $("#wpemails_cpve_email_corporative").removeClass('wpem_user_screen_input_failed');
        }

        if(!wpmails_pattern_password.test(wpemails_cpve_password)){
           $("#wpemails_cpve_password").addClass('wpem_user_screen_input_failed');
              wpemails_nosubmit=1;
        }else{
           $("#wpemails_cpve_password").removeClass('wpem_user_screen_input_failed');
        }
  
        if(wpemails_nosubmit==0){
            $("#wpemails_cpve_alert").text("Enviando...").fadeIn(10);
            var data = {
              'action': 'wpemails_register_ajax',
              _ajax_nonce : "<?php echo $nonce; ?>",
              'wpemails_cpve_email':$("#wpemails_cpve_email").val(),
              'wpemails_cpve_password':$("#wpemails_cpve_password").val(),
              'wpemails_cpve_fullname':$("#wpemails_cpve_fullname").val(),
              'wpemails_cpve_direction':$("#wpemails_cpve_direction").val(),
              'wpemails_cpve_email_corporative':$("#wpemails_cpve_email_corporative").val(),
              'wpemails_cpve_fechanamiciento':$("#wpemails_cpve_fechanamiciento").val(),
              'wpemails_cpve_pais':$("#wpemails_cpve_pais").val(),
              'wpemails_cpve_plan':$("#wpemails_cpve_plan").val(),
              'wpemails_cpve_num_confirmacion':$("#wpemails_cpve_num_confirmacion").val(),
              'txtacrocorporative':$("#txtacrocorporative").val()

           };
            jQuery.post(ajaxurl, data, function(response) {
                  //response
                  $("#wpemails_cpve_alert").text(""+response+"").delay(1000).fadeOut(600);
                  $("#wpemails_cpve_email").val("");
                  $("#wpemails_cpve_password").val("");
                  $("#wpemails_cpve_fullname").val("");
                  $("#wpemails_cpve_direction").val("");
                  $("#wpemails_cpve_email_corporative").val("");
                  $("#wpemails_cpve_fechanamiciento").val("");
                  $("#wpemails_cpve_pais").val("");
                  $("#wpemails_cpve_plan").val("");
                  $("#wpemails_cpve_num_confirmacion").val("");
                  
            });
        }
        
      });
  });

</script>