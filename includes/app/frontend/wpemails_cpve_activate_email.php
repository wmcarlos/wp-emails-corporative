<?php
	
	add_action( 'wp_loaded', 'loaded_front_end_function2');

	function loaded_front_end_function2() {
	    if ( !is_admin() ) { 
	      if(isset($_GET['post'])){
	      	wpemails_cpve_function_register_email_front();
	      }
	      if(isset($_GET['post_ppaypal'])){
	      	//paypal action
	      	wpmails_cpve_paypal_option();
	      }
	   }
	
	}
	function wpemails_cpve_function_register_email_front(){
		$get_settings = new wpemails_cpve_settings();
		$wpemailscpve_front_options = $get_settings->wpemails_cpve_checkoptions();
		$wpemails_cpve_front_estatuspost = get_post_status($_GET['post']);
		$wpemails_cpve_front_data = get_post_meta($_GET['post'],'wpemails_cpve_cpt_options');
		if($wpemails_cpve_front_estatuspost=='pending'){
			//condicion para saber si aceptamos el email
			$cpmm_front = new cPanelMailManager($wpemailscpve_front_options['user'], $wpemailscpve_front_options['pass'], $wpemailscpve_front_options['host']);
			if($cpmm_front->createEmail($wpemails_cpve_front_data[0]['wpemails_cpve_email_corporative'],$wpemails_cpve_front_data[0]['wpemails_cpve_email_password'],$wpemails_cpve_front_data[0]['wpemails_cpve_plan'])){
					echo 'CORREO ACTIVADO SATISFACTORIAMENTE';
					 $my_post = array(
					 	'ID' => $_GET['post'],
					    'post_status' => 'publish'
					  );
					wp_update_post($my_post);
			}else{
				echo 'OCURRIO UN ERROR AL ACTIVAR CORREO';
			}
		}
	}
	function wpmails_cpve_paypal_option()
	{
			$url_act = home_url();
			//obtener los datos del template
			$wpemails_cpve_template = get_option('wpemails_cpve_template');
			$wpemails_cpve_front_data = get_post_meta($_GET['post_ppaypal'],'wpemails_cpve_cpt_options');
			//vamos a transformar nuestro template email
			$wpemails_cpve_template['wpemails_cpve_template'] = str_replace('{{fullname}}', $wpemails_cpve_front_data['wpemails_cpve_fullname'], $wpemails_cpve_template['wpemails_cpve_template']);
			$wpemails_cpve_template['wpemails_cpve_template'] = str_replace('{{email}}', $wpemails_cpve_front_data['wpemails_cpve_email_send'], $wpemails_cpve_template['wpemails_cpve_template']);
			$wpemails_cpve_template['wpemails_cpve_template'] = str_replace('{{email_corporative}}', $wpemails_cpve_front_data['wpemails_cpve_email_corporative'], $wpemails_cpve_template['wpemails_cpve_template']);
			$wpemails_cpve_template['wpemails_cpve_template'] = str_replace('{{plan}}', $wpemails_cpve_front_data['wpemails_cpve_plan'], $wpemails_cpve_template['wpemails_cpve_template']);
			$wpemails_cpve_template['wpemails_cpve_template'] = str_replace('{{city}}', $wpemails_cpve_front_data['wpemails_cpve_full_direction'], $wpemails_cpve_template['wpemails_cpve_template']);
			//enviar correo
			$to = $wpemails_cpve_front_data[0]['wpemails_cpve_email_send'];																																																																																																																																																																																																																																																																																																																																										
			$subject = 'Estatus del correo corporativo '.$wpemails_cpve_front_data[0]['wpemails_cpve_email_corporative'];
			$body = $wpemails_cpve_template['wpemails_cpve_template'].' \n Active el correo en el siguiente enlace: <a href="'.$url_act.'/active-email?post='.$_GET['post_ppaypal'].'">'.$url_act.'/active-email</a>';
			$headers = array('Content-Type: text/html; charset=UTF-8');
			wp_mail($to, $subject, $body, $headers);
			$data_messaje = 'SE HA ENVIADO  UN MENSAJE A SU CORREO ELECTRONICO';
			echo $data_messaje;
	}