<script type="text/javascript">
           var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script> 
<div class="card-form" style="margin-left:20px;">
  <form class="signup" method="post" action="">
    <div class="form-title">Registrar Correo Electronico</div>
    <div class="form-body">
      <div class="row">
        <input type="text" name="wpemails_cpve_email" id="wpemails_cpve_email" placeholder="Tu Email" value="">
        <input type="password" name="wpemails_cpve_password" id="wpemails_cpve_password" placeholder="Contraseña*" value="">
      </div>
      <div class="row">
        <input type="text" name="wpemails_cpve_fullname" id="wpemails_cpve_fullname" placeholder="Nombres Completos" value="">
      </div>
      <div class="row">
        <input type="text" name="wpemails_cpve_email_corporative" id="wpemails_cpve_email_corporative" placeholder="Correo corporativo" value="">
      </div>
      <div class="row">
          <textarea placeholder="Direccion"  name="wpemails_cpve_direction"  id="wpemails_cpve_direction" style="height:100px;"></textarea>
      </div>
    </div>
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
</style>
<?php 
  $nonce = wp_create_nonce('wpemails_register_ajax');
?>
<script type="text/javascript">
  var wpemails_pattern = /^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$/
  var wpemails_pattern_email = /^[a-z]+[a-z-0-9_]+@[a-z]+\.[a-z]{2,4}/

  jQuery(document).ready(function($){
      $("#wpemails_register").on('click',function(){
        var data = {
          'action': 'wpemails_register_ajax',
          _ajax_nonce : "<?php echo $nonce; ?>",
          'wpemails_cpve_email':$("#wpemails_cpve_email").val(),
          'wpemails_cpve_password':$("#wpemails_cpve_password").val(),
          'wpemails_cpve_fullname':$("#wpemails_cpve_fullname").val(),
          'wpemails_cpve_direction':$("#wpemails_cpve_direction").val(),
          'wpemails_cpve_email_corporative':$("#wpemails_cpve_email_corporative").val()
       };
        jQuery.post(ajaxurl, data, function(response) {
              //response
              alert(response);
        });

      });
  });

</script>