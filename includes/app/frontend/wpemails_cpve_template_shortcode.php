<?php
  $wpemails_cpve_dataoptions = get_option('wpemails_cpve_options');

?>

<div class="card-form">
<!-- Modal Term-->
<div id="dialog" style="display: none;" title="Terminos y Condiciones">
    <?php 
      $wpemails_cpve_terminos = get_option('wpemails_cpve_terminos');
     ?>
     <p>
    <?php echo $wpemails_cpve_terminos['wpemails_cpve_terminos']; ?>
    </p>

</div>

<!-- Facebook login or logout button -->
<a href="javascript:void(0);" onclick="fbLogin()" id="fbLink"><img src="https://drmqjozm1bc8u.cloudfront.net/images/responsive/fb_login_button.png"/></a>

  <form class="signup" method="post" action="" autocomplete="off">

    <!--dialogo de ofertas-->
       <!--Modal Oferts-->
<div id="dialog-oferts" style="display: none;" title="Ofertas de Empleo">
     <p>
        <?php
          $d = get_option("wpemails_cpve_newsletter");
          $group_ids = $d['wpemails_cpve_group_id'];
          $group_names = $d['wpemails_cpve_group_name'];
          $group_types = $d['wpemails_cpve_group_type'];
        ?>

        <div class="row">
          <table >
            <?php for($i=0; $i < count($group_ids); $i++) { 
                if($group_types[$i] == "Ofertas de Trabajo"){
            ?>
              <tr>
                <td>
                  <strong style="font-size:30px;"><?php echo $group_names[$i]; ?></strong>
                </td>
                <td>
                  <input type="checkbox" class="wpemails_group_empelo" name="wpemails_group_empleo[]" value="<?php echo $group_ids[$i]; ?>"> 
                </td>
              </tr>
            <?php 
                  }
              } ?>
          </table>
        </div>

    </p>
</div>

  <!--Modal Discount-->
  <div id="dialog-discount" style="display: none;" title="Recibir los mejores descuentos y promociones">
       <p>
        <div class="row">
          <table >
            <?php for($i=0; $i < count($group_ids); $i++) { 
                if($group_types[$i] == "Descuentos y Promociones"){
            ?>
              <tr>
                <td>
                  <strong style="font-size:30px;"><?php echo $group_names[$i]; ?></strong>
                </td>
                <td>
                  <input type="checkbox" class="wpemails_group_descuentos" name="wpemails_group_descuentos[]" value="<?php echo $group_ids[$i]; ?>"> 
                </td>
              </tr>
            <?php 
                  }
              } ?>
          </table>
        </div>
      </p>
  </div>



   <!-- <div class="form-title">Registrar Correo Electronico</div>-->
    <div class="form-body">
      <strong style="color:#707070;" class="title-strong">Tu Correo:</strong><span class=" wpemails_helps" titlehelp="Digite su correo electrónico personal. Ej. minombre@gmail.com">(?)</span>
      <div class="row">
        <input type="text" class="validate" style="height:45px !important;" name="wpemails_cpve_email" id="wpemails_cpve_email" placeholder="Tu Email" value="">
      </div>

      <strong style="color:#707070;" class="title-strong">Nombre Completo:</strong><span class=" wpemails_helps" titlehelp="Ingrese su Nombre y Apellidos.">(?)</span>
      <div class="row">
         <input type="text" class="validate"  style="height:45px !important;" name="wpemails_cpve_fullname" id="wpemails_cpve_fullname" placeholder="Nombres Completos" value="">
      </div>

      <strong style="color:#707070;" class="title-strong">Fecha Nacimiento:</strong><span class=" wpemails_helps" titlehelp="Selecione el día, mes y año de su nacimiento.">(?)</span>
      <div class="row" id="wpemails_cpve_fechanamiciento_general">
        <select id="days" class="select_validate" style="height:45px !important;">
          <option value="">Dia</option>
        </select>
        <select id="months" class="select_validate" style="height:45px !important;">
          <option value="">Mes</option> 
        </select>
        <select id="years" class="select_validate" style="height:45px !important;">
          <option value="">Año</option>
        </select>
       <input type="hidden" class="validate" name="wpemails_cpve_fechanamiciento" id="wpemails_cpve_fechanamiciento" placeholder="00/00/0000" value="">
      </div>

      <strong style="color:#707070;" class="title-strong">Seleccione su país e ingrese su número de telefono:</strong><span class=" wpemails_helps" titlehelp="Primero seleccione su país y luego digite su número de teléfono.">(?)</span>
      <div class="row">
        <input id="phone" type="tel" name="wpemails_cpve_phone" style="height:45px !important;">
        <br>
        <span id="valid-msg" class="hide">✓</span>
        <span id="error-msg" class="hide">X</span>
      </div>

      <strong style="color:#707070;" class="title-strong">Ciudad:</strong><span class=" wpemails_helps" titlehelp="Ingrese la Ciudad de su residencia.">(?)</span>
      <div class="row">
          <!--<textarea placeholder="Direccion"  class="validate" name="wpemails_cpve_direction"  id="wpemails_cpve_direction" style="height:100px;"></textarea>-->
          <input type="text" style="height:45px !important;" placeholder="Ingrese ciudad de residencia" class="validate" name="wpemails_cpve_direction"  id="wpemails_cpve_direction">
      </div>
      <strong style="color:#707070;" class="title-strong">Correo Corporativo:</strong><span class=" wpemails_helps" titlehelp="Si elegiste el Plan Free, Ingresa tu nombre y apellido paterno, debe ser en el siguiente formato: Ej. jose.caceres@club-profesionales.com">(?)</span>
      <div class="row">
        <input type="text" class="validate" style="height:45px !important;" name="wpemails_cpve_email_corporative" id="wpemails_cpve_email_corporative" placeholder="Ingresa la cuenta de correo corporativo" value="">
        <!--<input type="text" readonly="readonly" name="txtacrocorporative" id="txtacrocorporative" value="<?php?>">-->
        <select name="txtacrocorporative" id="txtacrocorporative" style="height:45px !important;">
          <?php for($i=0; $i<count($wpemails_cpve_dataoptions['txtacrocorporative']); $i++){ ?>
              <option value="<?php echo $wpemails_cpve_dataoptions['txtacrocorporative'][$i]; ?>"><?php echo $wpemails_cpve_dataoptions['txtacrocorporative'][$i];  ?></option>
          <?php } ?>
        </select>
      </div>

       <div class="row wpemails_help_password" style="display:none; padding:0px !important; padding-top:20px !important;width:100%;max-width:270px;">
          <br>
          <br>
          <p style="color:#707070 !important; display:block; font-size:12px !important;">
          <span class="12-minimo" style="padding-left: 20px;">Minimo 12 caracteres</span>
          <br>
          <span class="1-minuscula" style="padding-left: 20px;">Al menos una letra minucula</span>
          <br>
          <span class="1-digito" style="padding-left: 20px;">Al menos un dígito</span>
          <br>
          <span class="1-espacio" style="padding-left: 20px;">No espacios en blanco</span>
          <br>
          <span class="1-caracterespecial" style="padding-left: 20px;">Al menos 1 caracter especial</span>
        </p>
      </div>

      <strong style="color:#707070;" class="title-strong">Contraseña:</strong><span class=" wpemails_helps" titlehelp="Genere su clave. Para mayor seguridad debe contener letras alfanuméricas y caracteres.">(?)</span>
      <div class="row">
        <input autocomplete="off" type="password" style="height:45px !important;" name="wpemails_cpve_password" class="validate" id="wpemails_cpve_password" placeholder="Contraseña*" value="">
      </div>
    
      <!--crear planes-->
      <?php
          $args = array(
              'post_type' => 'wpemails_cpve_planes',
              'orderby' => 'asc'
          );
          $the_query = new WP_Query( $args );
      ?>
      <strong style="color:#707070;" class="title-strong">Seleccione Plan:</strong><span class=" wpemails_helps" titlehelp="Seleccione el plan de su preferencia.">(?)</span>
      <div class="row">
        <select name="wpemails_cpve_plan" id="wpemails_cpve_plan" class="validate" style="height:45px !important;">
          <option value="">Seleccionar plan</option>
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <option value='<?php echo strip_tags(get_the_content()); ?>'><?php echo strip_tags(the_title()).' - '.strip_tags(get_the_content());?></option>
        <?php endwhile; ?>
        </select>
      </div>


      <!--reglas de planes-->
      <?php while ($the_query->have_posts()) : $the_query->the_post(); 
          $wpemails_dataplan = get_post_meta(get_the_id(),'wpemails_cpve_cpt_plan');
         // print_r($wpemails_dataplan);
          ?>

           <div class="<?php echo strip_tags(get_the_content()); ?>">
              <input type="hidden" class="wpemails_cpve_email" value="<?php echo $wpemails_dataplan[0]['wpemails_cpve_email_check']; ?>">

              <input type="hidden" class="wpemails_cpve_fullname" value="<?php echo $wpemails_dataplan[0]['wpemails_cpve_fullname_check']; ?>">
              
              <input type="hidden" class="wpemails_cpve_fechanamiciento" value="<?php echo $wpemails_dataplan[0]['wpemails_cpve_fechanamiciento_check']; ?>">

              <input type="hidden" class="wpemails_cpve_phone" value="<?php echo $wpemails_dataplan[0]['wpemails_cpve_phone_check']; ?>">

              <input type="hidden" class="wpemails_cpve_direction" value="<?php echo $wpemails_dataplan[0]['wpemails_cpve_ciudad_check']; ?>">

              <input type="hidden" class="wpemails_cpve_email_corporative" value="<?php echo $wpemails_dataplan[0]['wpemails_cpve_corporative_check']; ?>">

              <input type="hidden" class="wpemails_cpve_password" value="<?php echo $wpemails_dataplan[0]['wpemails_cpve_clave_check']; ?>">

              <input type="hidden" class="wpmails_cpve_terminos" value="<?php echo $wpemails_dataplan[0]['wpmails_cpve_terminos_check']; ?>">

              <input type="hidden" class="wpmails_cpve_ofertas" value="<?php echo $wpemails_dataplan[0]['wpemails_cpve_recibir_ofertas_check']; ?>">

              <input type="hidden" class="wpmails_cpve_mejoras" value="<?php echo $wpemails_dataplan[0]['wpemails_cpve_recibir_mejoras_check']; ?>">

           </div>
    
      <?php endwhile; ?>

      <strong style="color:#707070;" class="title-strong">Numero de confirmacion Paypal:</strong><span class=" wpemails_helps" titlehelp="Si elegiste un Plan de Pago, ingrese aquí el Código de Confirmación de pago.">(?)</span>
      <div class="row">
        <input type="text" style="height:45px !important;" name="wpemails_cpve_num_confirmacion" id="wpemails_cpve_num_confirmacion" placeholder="Ingrese el numero de confirmacion del deposito paypal" value="">
      </div>
     
      <!--terminos y condiciones,ofertas de subscripcion-->
      <div class="row">
          <input style="width:50px;" type="checkbox"  name="wpmails_cpve_terminos" id="wpmails_cpve_terminos" value="Y"><span style="position:relative; width:400px;"><b><span style="text-decoration: underline; cursor: pointer;" class="poput_terms">Términos y Condiciones</span></b></span>
      </div>

      <!--Recibir Ofertas de subscripcion-->
      <div class="row">
          <input style="width:50px;" type="checkbox" name="wpmails_cpve_ofertas" id="wpmails_cpve_ofertas" value="Y"><span style="position:relative; width:400px;"><b><span style="text-decoration: underline; cursor: pointer;" class="poput_oferts">Recibir las mejores ofertas de trabajo</span></b></span> 
      </div>

      <!--recibir mejoras-->
      <div class="row">
          <input style="width:50px;" type="checkbox" name="wpmails_cpve_mejoras" id="wpmails_cpve_mejoras" value="Y"><span style="position:relative; width:400px;"><b><span style="text-decoration: underline; cursor: pointer;" class="poput_discount">Recibir los mejores descuentos y promociones</span></b></span>
      </div>


    </div><!--cierre de la clase completa de filas-->
    <p>
      <center><strong id="wpemails_cpve_alert" style="color:#707070; display:none;">Enviando....</strong></center>
    </p>
    <div class="rule"></div>
    <div class="form-footer">
       <center> <div class="g-recaptcha" data-sitekey="6LcwiigUAAAAAGcEsTIA7AD9oiqmS0O_PDqMukrr" data-callback="correctCaptcha"></div></center>
        <br>
        <center><input  class="fa fa-thumbs-o-up" style="display:none;" id="wpemails_register" type="button" value="Registrarme"></center>
    </div>
  </form>
</div>




<!--###################################ESTILOS Y LIBRERIAS JAVASCRIPT########################-->
<link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/css/prism.css">
<link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/css/intlTelInput.css">
<link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/css/demo.css">
<link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/css/isValidNumber.css">
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
  .span-classic{
    background-color: black;
    color: white;
    position: absolute;
    padding: 10px 15px;
    margin-top: 45px !important;
    z-index: 999999;
  }
  .wpemails_help_password{
    position: absolute;
    background-color: #DDDCDB;
    color: black;
    margin-top: -230px;
    margin-left: 170px;
  }
  .wpemails_help_password span{
    font-size: 12px !important;
    display: block;
    font-weight: bold;
    color: black !important;
  }
  </style>
  <?php 
    $nonce = wp_create_nonce('wpemails_register_ajax');
  ?>




<!--- ##############################FUNCIONES JAVASCRIPT##############################-->
<script type="text/javascript">
  var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
  var ajaxurl2 = "<?php echo admin_url('admin-ajax.php'); ?>";
  
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
      var text_plan = '';
      var exists_email = false;

      function popupwindow(url, title, w, h) {
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
      } 

          $( "#dialog" ).dialog({
            autoOpen: false,
            modal : true,
            my : 'center',
            at : 'center',
            of : window,
            buttons: {
              Ok: function() {
                $( this ).dialog( "close" );
              }
            },
            width : 500,
            height : 500,
            scrollable : true,
            show: {
              effect: "blind",
              duration: 1000
            },
            hide: {
              effect: "explode",
              duration: 1000
            }
          });
       
          $( ".poput_terms" ).on( "click", function() {
              $( "#dialog" ).dialog( "open" );
          });

          /*Dialog Oferts*/
          $( "#dialog-oferts" ).dialog({
            autoOpen: false,
            modal : true,
            my : 'center',
            at : 'center',
            of : window,
            buttons: {
              Ok: function() {
                $( this ).dialog( "close" );
              }
            },
            width : 500,
            height : 500,
            scrollable : true,
            show: {
              effect: "blind",
              duration: 1000
            },
            hide: {
              effect: "explode",
              duration: 1000
            }
          });

      $( ".poput_oferts" ).on( "click", function() {
              $( "#dialog-oferts" ).dialog( "open" );
              $( "#dialog-oferts" ).closest('div.ui-dialog').appendTo('.signup');
      });

      /*Dialog Discounts*/
      $( "#dialog-discount" ).dialog({
          autoOpen: false,
          modal : true,
          my : 'center',
          at : 'center',
          of : window,
          buttons: {
            Ok: function() {
              $( this ).dialog( "close" );
            }
          },
          width : 500,
          height : 500,
          scrollable : true,
          show: {
            effect: "blind",
            duration: 1000
          },
          hide: {
            effect: "explode",
            duration: 1000
          }
        });

        $( ".poput_discount" ).on( "click", function() {
              $( "#dialog-discount" ).dialog( "open" );
              $( "#dialog-discount" ).closest('div.ui-dialog').appendTo('.signup');
        });

      //Load default style from images
     $(".12-minimo, .1-minuscula, .1-digito, .1-caracterespecial, .1-espacio").css({
        'background-image' : 'url("<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/img/sprite_tips.png")',
        'background-repeat' : 'no-repeat',
        'background-position-y' : '-25px'
     });


      //validacion por teclado
      $('.validate').keyup(function(){  
          validate($(this));

          //validar campos de contraseña
          if($(this).attr('id')=='wpemails_cpve_password'){
              //saber si tiene minimo 12 caracteres
              if($(this).val().length>=12){

                 $(".12-minimo").css({
                    'background-image' : 'url("<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/img/sprite_tips.png")',
                    'background-repeat' : 'no-repeat',
                    'background-position-y' : '0px',
                    'color':'#37D937 !important'
                 });

              }else{

                $(".12-minimo").css({
                    'background-image' : 'url("<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/img/sprite_tips.png")',
                    'background-repeat' : 'no-repeat',
                    'background-position-y' : '-25px',
                    'color':'#FF0000 !important'
                 });

              } 
              //si posee al menos una minuscula
              patron = /[a-z]/g
              if(patron.test($(this).val())){

                $(".1-minuscula").css({
                    'background-image' : 'url("<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/img/sprite_tips.png")',
                    'background-repeat' : 'no-repeat',
                    'background-position-y' : '0px',
                    'color':'#37D937 !important'
                 });

              }else{

                $(".1-minuscula").css({
                    'background-image' : 'url("<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/img/sprite_tips.png")',
                    'background-repeat' : 'no-repeat',
                    'background-position-y' : '-25px',
                    'color':'#FF0000 !important'
                 });

              }
              //si posee un digito
              patron = /[0-9]/g
              if(patron.test($(this).val())){

                $(".1-digito").css({
                    'background-image' : 'url("<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/img/sprite_tips.png")',
                    'background-repeat' : 'no-repeat',
                    'background-position-y' : '0px',
                    'color':'#37D937 !important'
                 });

              }else{
                $(".1-digito").css({
                    'background-image' : 'url("<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/img/sprite_tips.png")',
                    'background-repeat' : 'no-repeat',
                    'background-position-y' : '-25px',
                    'color':'#FF0000 !important'
                 });
              }
              //si posee al menus un caracter especial
              patron = /[$@$!%*?&\-]/
              if(patron.test($(this).val())){

                $(".1-caracterespecial").css({
                    'background-image' : 'url("<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/img/sprite_tips.png")',
                    'background-repeat' : 'no-repeat',
                    'background-position-y' : '0px',
                    'color':'#37D937 !important'
                 });

              }else{

                $(".1-caracterespecial").css({
                    'background-image' : 'url("<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/img/sprite_tips.png")',
                    'background-repeat' : 'no-repeat',
                    'background-position-y' : '-25px',
                    'color':'#FF0000 !important'
                 });

              }
              //si posee un espacio en blanco
              patron = /\s/
               if(patron.test($(this).val())){        

                 $(".1-espacio").css({
                    'background-image' : 'url("<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/img/sprite_tips.png")',
                    'background-repeat' : 'no-repeat',
                    'background-position-y' : '-25px',
                    'color':'#FF0000 !important'
                 });   

              }else{

                $(".1-espacio").css({
                    'background-image' : 'url("<?php echo plugin_dir_url( __FILE__ ); ?>validateTel/img/sprite_tips.png")',
                    'background-repeat' : 'no-repeat',
                    'background-position-y' : '0px',
                    'color':'#37D937 !important'
                 });  

              }

          }//cierre del if

      });
       $('.validate,.select_validate').change(function(){  
           validate($(this));
      });

      //abrir ventana de ayuda password
      $("#wpemails_cpve_password").focus(function(event) {
        $('.wpemails_help_password').show(400);
      });
      $("#wpemails_cpve_password").blur(function(){
        $('.wpemails_help_password').hide(0);

      });

       //ajax keyup email
       $("#wpemails_cpve_email").blur(function() {
          text_plan = $("#wpemails_cpve_plan option:selected").text();
          if(wpemails_pattern_email.test($(this).val()) && $("#wpemails_cpve_plan").val()!=''){
             var data = {
              'action': 'wpemails_verify_email',
              'text_plan':text_plan,
              'wpemails_cpve_email':$("#wpemails_cpve_email").val()
             };
             jQuery.post(ajaxurl2, data, function(response) {
                if(response=='yes'){
                    exists_email = true;  
                    $(".span-classic").remove();
                    $("#wpemails_cpve_email").after('<span class="span-classic">El correo ingresado ya posee una cuenta free</span>');
                }else{
                    $(".span-classic").remove();
                    exists_email = false; 
                }
             });
          }
       });

       $("#wpemails_cpve_plan").change(function(){
          class_rule = $(this).val();
          text_plan = $("#wpemails_cpve_plan option:selected").text();
          //verificar el correo electronico
           var data = {
              'action': 'wpemails_verify_email',
              'text_plan':text_plan,
              'wpemails_cpve_email':$("#wpemails_cpve_email").val()
           };
           jQuery.post(ajaxurl2, data, function(response) {
               if(response=='yes'){
                    exists_email = true; 
                    $(".span-classic").remove();
                    $("#wpemails_cpve_plan").after('<span class="span-classic">El correo ingresado ya posee una cuenta free</span>'); 
                }else{
                  $(".span-classic").remove();
                  exists_email = false; 
                }
           });

          /*escogerlas reglas de campos*/
          $("."+class_rule).find('input[type="hidden"]').each(function(){
              name_element = $(this).attr("class");
            //  alert(name_element);
              if($(this).val()=='y'){
                $("input[name='"+name_element+"']").attr("estatus_required","obligatorio");
              }else{
                $("input[name='"+name_element+"']").attr("estatus_required","nobligatorio");
              }
          });
       });
  

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
        if($("#wpmails_cpve_terminos").is(":checked")){
            $("#wpmails_cpve_terminos").parent().find('span').removeClass('wpem_user_screen_input_failed');
            $("#wpmails_cpve_terminos").val("Y"); 
        }else{
            $("#wpmails_cpve_terminos").parent().find('span').addClass('wpem_user_screen_input_failed');
            $("#wpmails_cpve_terminos").val(""); 
            wpemails_nosubmit+=1;
            if($('#wpmails_cpve_terminos').attr("estatus_required")=='nobligatorio'){
              $("#wpmails_cpve_terminos").parent().find('span').removeClass('wpem_user_screen_input_failed');
                wpemails_nosubmit-=1;
              }
        }

         if($("#wpmails_cpve_ofertas").is(":checked")){
            $("#wpmails_cpve_ofertas").parent().find('span').removeClass('wpem_user_screen_input_failed');
            $("#wpmails_cpve_ofertas").val("Y");
        }else{
            $("#wpmails_cpve_ofertas").parent().find('span').addClass('wpem_user_screen_input_failed');
            wpemails_nosubmit+=1;
            if($('#wpmails_cpve_ofertas').attr("estatus_required")=='nobligatorio'){
              $("#wpmails_cpve_ofertas").val("");
              $("#wpmails_cpve_ofertas").parent().find('span').removeClass('wpem_user_screen_input_failed');
                wpemails_nosubmit-=1;
              }
        }

         if($("#wpmails_cpve_mejoras").is(":checked")){
          $("#wpmails_cpve_mejoras").val("Y");
            $("#wpmails_cpve_mejoras").parent().find('span').removeClass('wpem_user_screen_input_failed');
        }else{
            $("#wpmails_cpve_mejoras").parent().find('span').addClass('wpem_user_screen_input_failed');
            $("#wpmails_cpve_mejoras").val("");
            wpemails_nosubmit+=1;
            if($('#wpmails_cpve_mejoras').attr("estatus_required")=='nobligatorio'){
              $("#wpmails_cpve_mejoras").parent().find('span').removeClass('wpem_user_screen_input_failed');
                wpemails_nosubmit-=1;
              }
        }


        if($("#valid-msg").is(":visible")){
            $(".intl-tel-input.allow-dropdown").removeClass('wpem_user_screen_input_failed');
        }else{
            $(".intl-tel-input.allow-dropdown").addClass('wpem_user_screen_input_failed');
            wpemails_nosubmit+=1;
             if(($('#phone').val().length<=0) &&  $('#phone').attr("estatus_required")=='nobligatorio'){
              $(".intl-tel-input.allow-dropdown").removeClass('wpem_user_screen_input_failed'); 
              wpemails_nosubmit-=1;
            }
        }

        if(!wpemails_pattern_vacio.test(wpemails_cpve_num_confirmacion)){
           $("#wpemails_cpve_num_confirmacion").addClass('wpem_user_screen_input_failed');
              wpemails_nosubmit+=1;
        }else{
           $("#wpemails_cpve_num_confirmacion").removeClass('wpem_user_screen_input_failed');
        }
        if(!wpemails_pattern_vacio.test(wpemails_cpve_pais)){
           $("#wpemails_cpve_pais").addClass('wpem_user_screen_input_failed');
              wpemails_nosubmit+=1;
        }else{
           $("#wpemails_cpve_pais").removeClass('wpem_user_screen_input_failed');
        }

        if(!wpemails_pattern_vacio.test(wpemails_cpve_plan)){
           $("#wpemails_cpve_plan").addClass('wpem_user_screen_input_failed');
              wpemails_nosubmit+=1;
        }else{
           $("#wpemails_cpve_plan").removeClass('wpem_user_screen_input_failed');
        }
        if(!wpemails_pattern_fecha.test(wpemails_cpve_fechanamiciento)){
            $("#wpemails_cpve_fechanamiciento").addClass('wpem_user_screen_input_failed');
            $("#wpemails_cpve_fechanamiciento_general").addClass('wpem_user_screen_input_failed');
            wpemails_nosubmit+=1;
      
          if(($('#wpemails_cpve_fechanamiciento').val()=='//') &&  $('#wpemails_cpve_fechanamiciento').attr("estatus_required")=='nobligatorio'){
               $("#wpemails_cpve_fechanamiciento").removeClass('wpem_user_screen_input_failed');
               $("#wpemails_cpve_fechanamiciento_general").removeClass('wpem_user_screen_input_failed');
              wpemails_nosubmit-=1;
          }

        }else{
           $("#wpemails_cpve_fechanamiciento").removeClass('wpem_user_screen_input_failed');
           $("#wpemails_cpve_fechanamiciento_general").removeClass('wpem_user_screen_input_failed');
        }

        if(!wpemails_pattern.test(wpemails_cpve_fullname)){
           $("#wpemails_cpve_fullname").addClass('wpem_user_screen_input_failed');
              wpemails_nosubmit+=1;
              $('span.wpemails_cpve_fullname').remove();
              //nobligatorio
          if(($('#wpemails_cpve_fullname').val().length<=0) &&  $('#wpemails_cpve_fullname').attr("estatus_required")=='nobligatorio'){
              $("#wpemails_cpve_fullname").removeClass('wpem_user_screen_input_failed');
               wpemails_nosubmit-=1;
              $('span.wpemails_cpve_fullname').remove();
          }
        }else{
            $("#wpemails_cpve_fullname").removeClass('wpem_user_screen_input_failed');
            $('span.wpemails_cpve_fullname').remove();
            $("#wpemails_cpve_fullname").after('<span class="'+$("#wpemails_cpve_fullname").attr('id')+'">✓</span>');

        }


        if(!wpemails_pattern_email.test(wpemails_cpve_email)){
           $("#wpemails_cpve_email").addClass('wpem_user_screen_input_failed');
              wpemails_nosubmit+=1;
            if(($('#wpemails_cpve_email').val().length<=0) &&  $('#wpemails_cpve_email').attr("estatus_required")=='nobligatorio'){
               $("#wpemails_cpve_email").removeClass('wpem_user_screen_input_failed');
              wpemails_nosubmit-=1;
            }
        }else{
           $("#wpemails_cpve_email").removeClass('wpem_user_screen_input_failed');
        }

        if(!wpemails_pattern_letters.test(wpemails_cpve_email_corporative)){
           $("#wpemails_cpve_email_corporative").addClass('wpem_user_screen_input_failed');
              wpemails_nosubmit+=1;
            if(($('#wpemails_cpve_email_corporative').val().length<=0) &&  $('#wpemails_cpve_email_corporative').attr("estatus_required")=='nobligatorio'){
               $("#wpemails_cpve_email_corporative").removeClass('wpem_user_screen_input_failed');
              wpemails_nosubmit-=1;
            }
        }else{
           $("#wpemails_cpve_email_corporative").removeClass('wpem_user_screen_input_failed');
        }

        if(!wpmails_pattern_password.test(wpemails_cpve_password)){
           $("#wpemails_cpve_password").addClass('wpem_user_screen_input_failed');
              wpemails_nosubmit+=1;
            if(($('#wpemails_cpve_password').val().length<=0) &&  $('#wpemails_cpve_password').attr("estatus_required")=='nobligatorio'){
               $("#wpemails_cpve_password").removeClass('wpem_user_screen_input_failed');
              wpemails_nosubmit-=1;
            }
        }else{
           $("#wpemails_cpve_password").removeClass('wpem_user_screen_input_failed');
        }

        /*=================================VALIDACIONES CLOSED==============================*/
  
        if(wpemails_nosubmit==0 &&  exists_email!=true){
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
              'txtacrocorporative':$("#txtacrocorporative").val(),
              'wpmails_cpve_ofertas':$("#wpmails_cpve_ofertas").val(),
              'wpmails_cpve_mejoras':$("#wpmails_cpve_mejoras").val(),
              'wpemails_group_empleo':converArrayInString('wpemails_group_empleo[]'),
              'wpemails_group_descuentos':converArrayInString('wpemails_group_descuentos[]'),
              'text_plan':text_plan


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
                  $("#wpmails_cpve_terminos").attr('checked',false);
                  $("#wpmails_cpve_mejoras").attr('checked',false);
                  $("#wpmails_cpve_ofertas").attr('checked',false);
                  $("#phone").val("");
                  location.reload();
                  
            });
        }
      });

  function converArrayInString(name){

    var element = document.getElementsByName(name);
    var count = element.length;
    var cad = "";

    for(var i = 0; i < count; i++){
      if(count == (i+1)){
        cad+= element[i].value;
      }else{
        cad+= element[i].value+",";
      }
    }

    return cad;

  }

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



        /*VALIDACION POR KEYUP O CHANGE*/
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
               $('span.wpemails_cpve_plan').remove();

            }else{
               $("#wpemails_cpve_plan").removeClass('wpem_user_screen_input_failed');
               $('span.wpemails_cpve_plan').remove();
               $("#wpemails_cpve_plan").after('<span class="'+$("#wpemails_cpve_plan").attr('id')+'">✓</span>');
            }
          }

          if(data.parent().attr("id") == 'wpemails_cpve_fechanamiciento_general'){
            wpemails_cpve_fechanamiciento = $("#days").val()+"/"+$("#months").val()+"/"+$("#years").val();
            $('span.wpemails_cpve_fechanamiciento_general').remove();
            if(!wpemails_pattern_fecha.test(wpemails_cpve_fechanamiciento)){
               $("#wpemails_cpve_fechanamiciento").addClass('wpem_user_screen_input_failed');
               $("#wpemails_cpve_fechanamiciento_general").addClass('wpem_user_screen_input_failed');
            }else{
              
               $("#wpemails_cpve_fechanamiciento").removeClass('wpem_user_screen_input_failed');
               $("#wpemails_cpve_fechanamiciento_general").removeClass('wpem_user_screen_input_failed');
               $("#wpemails_cpve_fechanamiciento_general").append('<span class="'+$("#wpemails_cpve_fechanamiciento_general").attr('id')+'">✓</span>');
                
            }
          }

          if(wpemails_data=='wpemails_cpve_fullname'){
            if(!wpemails_pattern.test(wpemails_value)){
               $('span.wpemails_cpve_fullname').remove();
               $("#wpemails_cpve_fullname").addClass('wpem_user_screen_input_failed');
            }else{
               $("#wpemails_cpve_fullname").removeClass('wpem_user_screen_input_failed');
               $('span.wpemails_cpve_fullname').remove();
               $("#wpemails_cpve_fullname").after('<span class="'+$("#wpemails_cpve_fullname").attr('id')+'">✓</span>');
            }
          }

          if(wpemails_data=='wpemails_cpve_email'){
            if(!wpemails_pattern_email.test(wpemails_value)){
               $("#wpemails_cpve_email").addClass('wpem_user_screen_input_failed');
               $('span.wpemails_cpve_email').remove();
            }else{
               $("#wpemails_cpve_email").removeClass('wpem_user_screen_input_failed');
               $('span.wpemails_cpve_email').remove();
               $("#wpemails_cpve_email").after('<span class="'+$("#wpemails_cpve_email").attr('id')+'">✓</span>');
            }
          }

          if(wpemails_data=='wpemails_cpve_email_corporative'){
            if(!wpemails_pattern_letters.test(wpemails_value)){
               $("#wpemails_cpve_email_corporative").addClass('wpem_user_screen_input_failed');
               $("span.txtacrocorporative").remove();
            }else{
               $("#wpemails_cpve_email_corporative").removeClass('wpem_user_screen_input_failed');
               $("span.txtacrocorporative").remove();
               $("#txtacrocorporative").after('<span class="'+$("#txtacrocorporative").attr('id')+'">✓</span>');
            }
          }

          if(wpemails_data=='wpemails_cpve_password'){

            if(!wpmails_pattern_password.test(wpemails_value)){
               $("#wpemails_cpve_password").addClass('wpem_user_screen_input_failed');
               $("span.wpemails_cpve_password").remove();

            }else{
               $("#wpemails_cpve_password").removeClass('wpem_user_screen_input_failed');
               $("span.wpemails_cpve_password").remove();
               $("#wpemails_cpve_password").after('<span class="'+$("#wpemails_cpve_password").attr('id')+'">✓</span>');

                
            }
          }
          


        }

        jQuery(".wpemails_group_empelo").click(function(){
            var count = 0;
              jQuery(".wpemails_group_empelo").each(function(index){
                if($(this).is(":checked")){
                  count++;
                }
              });

              if(count > 0){
                $( "#wpmails_cpve_ofertas" ).prop( "checked", true );
              }else{
                $( "#wpmails_cpve_ofertas" ).prop( "checked", false );
              }
        });

        jQuery(".wpemails_group_descuentos").click(function(){
            var count = 0;
              jQuery(".wpemails_group_descuentos").each(function(index){
                if($(this).is(":checked")){
                  count++;
                }
              });

              if(count > 0){
                $( "#wpmails_cpve_mejoras" ).prop( "checked", true );
              }else{
                $( "#wpmails_cpve_mejoras" ).prop( "checked", false );
              }
        });

});  

window.fbAsyncInit = function() {
    // FB JavaScript SDK configuration and setup
    FB.init({
      appId      : '341820379543254', // FB App ID
      cookie     : true,  // enable cookies to allow the server to access the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.8' // use graph api version 2.8
    });
};

// Load the JavaScript SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Facebook login with JavaScript SDK
function fbLogin() {
    FB.login(function (response) {
        if (response.authResponse) {
            // Get and display the user profile data
            getFbUserData();
        } else {
            alert('El usuario ha Cancelado el Inicio de Sesion!!');
        }
    }, {scope: 'email,user_birthday,user_location'});
}

// Fetch the user profile data from facebook
function getFbUserData(){
    FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,birthday,location'},
    function (response) {
        jQuery("#fbLink").hide();

        document.getElementById("wpemails_cpve_email").value = response.email;
        document.getElementById("wpemails_cpve_fullname").value = response.first_name+" "+response.last_name;

        if(response.birthday){
          var birthday = response.birthday.split("/");
          document.getElementById("days").value = birthday[1];
          document.getElementById("months").value = birthday[0];
          document.getElementById("years").value = birthday[2];
        }
        
        if(response.location.name){
          document.getElementById("wpemails_cpve_direction").value = response.location.name;
        }
        
    });
}

</script>
