<?php
  $wpemails_cpve_dataoptions = get_option('wpemails_cpve_options');

?>

<script type="text/javascript">
           var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script> 
<link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/css/prism.css">
<link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/css/intlTelInput.css">
<link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/css/demo.css">
<link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/css/isValidNumber.css">


<div class="card-form" style="margin-left:20px;">
  <form class="signup" method="post" action="" autocomplete="off">
   <!-- <div class="form-title">Registrar Correo Electronico</div>-->
    <div class="form-body">
      <div class="row">
         <span style="margin-rigth:15px; width:45%;"><strong style="color:#707070;">Tu Correo:</strong>
         <input type="text" class="validate" name="wpemails_cpve_email" id="wpemails_cpve_email" placeholder="Tu Email" value="">
        </span>
        <span style="margin-left:15px; width:45%;">
          <strong style="color:#707070;">Nombre Completo:</strong>
          <br>          
         <input type="text" class="validate" name="wpemails_cpve_fullname" id="wpemails_cpve_fullname" placeholder="Nombres Completos" value="">
        </span>
      </div>

      <strong style="color:#707070; margin-left:15px;">Fecha Nacimiento:</strong>
      <div class="row" id="wpemails_cpve_fechanamiciento_general">
        <select id="days">
          <option value="">Dia</option>
        </select>
        <select id="months">
          <option value="">Mes</option> 
        </select>
        <select id="years">
          <option value="">Año</option>
        </select>
       <input type="hidden" class="validate" name="wpemails_cpve_fechanamiciento" id="wpemails_cpve_fechanamiciento" placeholder="00/00/0000" value="">
      </div>


      <strong style="color:#707070; margin-left:28px;">Seleccione su país e ingrese su número de telefono:</strong>
      <div class="row">
        <input id="phone" type="tel">
        <br>
        <span id="valid-msg" class="hide">✓ Valido</span>
        <span id="error-msg" class="hide">Numero Invalido</span>
      </div>

      <strong style="color:#707070; margin-left:28px;">Ciudad:</strong>
      <div class="row">
          <!--<textarea placeholder="Direccion"  class="validate" name="wpemails_cpve_direction"  id="wpemails_cpve_direction" style="height:100px;"></textarea>-->
          <input type="text" placeholder="Ingrese ciudad de residencia" class="validate" name="wpemails_cpve_direction"  id="wpemails_cpve_direction">
      </div>
      <strong style="color:#707070; margin-left:28px;">Correo Corporativo:</strong>
      <div class="row">
        <input type="text" class="validate" name="wpemails_cpve_email_corporative" id="wpemails_cpve_email_corporative" placeholder="Ingresa la cuenta de correo corporativo" value="">
        <input type="text" readonly="readonly" name="txtacrocorporative" id="txtacrocorporative" value="<?php echo $wpemails_cpve_dataoptions['txtacrocorporative']; ?>">
      </div>

      <strong style="color:#707070; margin-left:28px;">Contraseña:</strong>
      <div class="row">
        <input type="password" name="wpemails_cpve_password" class="validate" id="wpemails_cpve_password" placeholder="Contraseña*" value="">
      </div>
      <div class="row">
          <p style="color:#707070 !important; display:block; font-size:10px !important; margin-left:-250px;">
          Minimo 12 caracteres
          <br>
          Maximo 18 caracteres
          <br>
          Al menos una letra minucula
          <br>
          Al menos un dígito
          <br>
          <strong style="color:red;">No espacios en blanco</strong>
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
        <select name="wpemails_cpve_plan" id="wpemails_cpve_plan" class="validate">
          <option value="">Seleccionar plan</option>
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <option value='<?php echo strip_tags(get_the_content()); ?>'><?php echo strip_tags(the_title()).' - '.strip_tags(get_the_content());?></option>
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
        <div class="g-recaptcha" data-sitekey="6LcwiigUAAAAAGcEsTIA7AD9oiqmS0O_PDqMukrr" data-callback="correctCaptcha"></div>
        <br>
        <input  class="fa fa-thumbs-o-up" style="display:none;" id="wpemails_register" type="button" value="Registrarme">
        </center>
    </div>
  </form>
</div>


<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/js/prism.js"></script>
<script src="<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/js/intlTelInput.js"></script>
<script src="<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/js/isValidNumber.js"></script>


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
  var wpmails_pattern_password = /^(?=.*[a-z])(?=.*[a-z])(?=.*\d)(?=.*[$@$!%*?&\-])([a-z\d$@$!%*?&\-]|[^ ]){12,18}$/;
  var wpemails_pattern_vacio =  /^[^]+$/
  var wpemails_pattern_fecha =  /^([0][1-9]|[12][0-9]|3[01])(\/|-)([0][1-9]|[1][0-2])\2(\d{4})$/

  //response callback
  var correctCaptcha = function(response) {
      document.getElementById("wpemails_register").style = 'display:block';
  }

  jQuery(document).ready(function($){
    //validacion por teclado
      $('.validate').keyup(function(){  
        validate($(this));
      });
       $('.validate').change(function(){  
        validate($(this));
      });

  
      function validate(data){
          wpemails_data = data.attr("id");
          wpemails_value = data.val();

          if(wpemails_data=='wpemails_cpve_num_confirmacion'){
            if(!wpemails_pattern_vacio.test(wpemails_value)){
               $("#wpemails_cpve_num_confirmacion").addClass('wpem_user_screen_input_failed');
            }else{
               $("#wpemails_cpve_num_confirmacion").removeClass('wpem_user_screen_input_failed');
            }
          }

          if(wpemails_data=='wpemails_cpve_pais'){
            if(!wpemails_pattern_vacio.test(wpemails_value)){
               $("#wpemails_cpve_pais").addClass('wpem_user_screen_input_failed');
            }else{
               $("#wpemails_cpve_pais").removeClass('wpem_user_screen_input_failed');
            }
          }


          if(wpemails_data=='wpemails_cpve_plan'){
            if(!wpemails_pattern_vacio.test(wpemails_value)){
               $("#wpemails_cpve_plan").addClass('wpem_user_screen_input_failed');
            }else{
               $("#wpemails_cpve_plan").removeClass('wpem_user_screen_input_failed');
            }
          }

          if(wpemails_data=='wpemails_cpve_fechanamiciento'){
            if(!wpemails_pattern_fecha.test(wpemails_value)){
               $("#wpemails_cpve_fechanamiciento").addClass('wpem_user_screen_input_failed');
               $("#wpemails_cpve_fechanamiciento_general").addClass('wpem_user_screen_input_failed');
            }else{
               $("#wpemails_cpve_fechanamiciento").removeClass('wpem_user_screen_input_failed');
               $("#wpemails_cpve_fechanamiciento_general").addClass('wpem_user_screen_input_failed');
            }
          }

          if(wpemails_data=='wpemails_cpve_fullname'){
            if(!wpemails_pattern.test(wpemails_value)){
               $("#wpemails_cpve_fullname").addClass('wpem_user_screen_input_failed');
            }else{
               $("#wpemails_cpve_fullname").removeClass('wpem_user_screen_input_failed');
            }
          }

          if(wpemails_data=='wpemails_cpve_email'){
            if(!wpemails_pattern_email.test(wpemails_value)){
               $("#wpemails_cpve_email").addClass('wpem_user_screen_input_failed');
            }else{
               $("#wpemails_cpve_email").removeClass('wpem_user_screen_input_failed');
            }
          }

          if(wpemails_data=='wpemails_cpve_email_corporative'){
            if(!wpemails_pattern_letters.test(wpemails_value)){
               $("#wpemails_cpve_email_corporative").addClass('wpem_user_screen_input_failed');
            }else{
               $("#wpemails_cpve_email_corporative").removeClass('wpem_user_screen_input_failed');
            }
          }

          if(wpemails_data=='wpemails_cpve_password'){

            if(!wpmails_pattern_password.test(wpemails_value)){
               $("#wpemails_cpve_password").addClass('wpem_user_screen_input_failed');
            }else{
               $("#wpemails_cpve_password").removeClass('wpem_user_screen_input_failed');
            }
          }
        }

  

      //click al momento de registrar
      $("#wpemails_register").on('click',function(){
       
        wpemails_cpve_email = $("#wpemails_cpve_email").val();
        wpemails_cpve_password =  $("#wpemails_cpve_password").val();
        wpemails_cpve_fullname = $("#wpemails_cpve_fullname").val();
        wpemails_cpve_direction =  $("#wpemails_cpve_direction").val();
        wpemails_cpve_email_corporative=  $("#wpemails_cpve_email_corporative").val();
        wpemails_cpve_fechanamiciento = $("#days").val()+"/"+$("#months").val()+"/"+$("#years").val();
        $("#wpemails_cpve_fechanamiciento").val(wpemails_cpve_fechanamiciento);
        wpemails_cpve_pais = $("#wpemails_cpve_pais").val();
        wpemails_cpve_plan = $("#wpemails_cpve_plan").val();
        wpemails_cpve_num_confirmacion = $("#wpemails_cpve_num_confirmacion").val();
        wpemails_nosubmit = 0;

        //vamos a guardar el pais
        wpemails_cpve_paistext = $(".selected-flag").attr("title").split(":");
        wpemails_cpve_paistext = wpemails_cpve_paistext[0];
        wpemails_cpve_phone = $("#phone").val();


        //============================valitate required fields============================
        if($("#valid-msg").is(":visible")){
            $(".intl-tel-input.allow-dropdown").removeClass('wpem_user_screen_input_failed');
        }else{
            $(".intl-tel-input.allow-dropdown").addClass('wpem_user_screen_input_failed');
            wpemails_nosubmit=1;
        }

        if(!wpemails_pattern_vacio.test(wpemails_cpve_num_confirmacion)){
           $("#wpemails_cpve_num_confirmacion").addClass('wpem_user_screen_input_failed');
              wpemails_nosubmit=1;
        }else{
           $("#wpemails_cpve_num_confirmacion").removeClass('wpem_user_screen_input_failed');
        }

        if(!wpemails_pattern_vacio.test(wpemails_cpve_pais)){
           $("#wpemails_cpve_pais").addClass('wpem_user_screen_input_failed');
              wpemails_nosubmit=1;
        }else{
           $("#wpemails_cpve_pais").removeClass('wpem_user_screen_input_failed');
        }

        if(!wpemails_pattern_vacio.test(wpemails_cpve_plan)){
           $("#wpemails_cpve_plan").addClass('wpem_user_screen_input_failed');
              wpemails_nosubmit=1;
        }else{
           $("#wpemails_cpve_plan").removeClass('wpem_user_screen_input_failed');
        }
        if(!wpemails_pattern_fecha.test(wpemails_cpve_fechanamiciento)){
           $("#wpemails_cpve_fechanamiciento").addClass('wpem_user_screen_input_failed');
          $("#wpemails_cpve_fechanamiciento_general").addClass('wpem_user_screen_input_failed');
              wpemails_nosubmit=1;
        }else{
           $("#wpemails_cpve_fechanamiciento").removeClass('wpem_user_screen_input_failed');
           $("#wpemails_cpve_fechanamiciento_general").removeClass('wpem_user_screen_input_failed');
        }

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

        /*=================================VALIDACIONES CLOSED==============================*/
  
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
              'wpemails_cpve_fechanamiciento':$("#days").val()+"/"+$("#months").val()+"/"+$("#years").val(),
              'wpemails_cpve_pais':wpemails_cpve_paistext,
              'wpemails_cpve_phone':wpemails_cpve_phone,
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

      //FUNCIONES PARA LAS FECHAS
      var monthNames = ["","Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ];
    for (i = new Date().getFullYear(); i > 1900; i--){
            $('#years').append($('<option />').val(i).html(i));
        }
            
        for (i = 1; i < 13; i++){
            if(i<10){
               $('#months').append($('<option />').val('0'+i).html(monthNames[i]));

            }else{
               $('#months').append($('<option />').val(i).html(monthNames[i]));

            }
        }
         updateNumberOfDays(); 
            
        $('#years, #months').on("change", function(){
            updateNumberOfDays(); 
        });



        function updateNumberOfDays(){
           // $('#days').html('');
            month=$('#months').val();
            year=$('#years').val();
            days=daysInMonth(month, year);

            //for(i=1; i < days+1 ; i++){
            for(i=1; i < 32 ; i++){
                  if(i<10){
                    $('#days').append($('<option />').val('0'+i).html('0'+i));
                  }else{
                    $('#days').append($('<option />').val(i).html(i));

                  }
            }
            //$('#message').html(monthNames[month-1]+" in the year "+year+" has <b>"+days+"</b> days");
        }

        function daysInMonth(month, year) {
            return new Date(year, month, 0).getDate();
        }



});  
</script>
