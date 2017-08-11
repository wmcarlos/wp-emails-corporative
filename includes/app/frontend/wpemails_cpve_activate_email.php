<?php
	
	add_action( 'wp_loaded', 'loaded_front_end_function');
	function loaded_front_end_function() {
	    if ( !is_admin() ) { 
	      if(isset($_GET['post'])){
	      	wpemails_cpve_function_register_email();
	      }

	   }
	
	}
	function wpemails_cpve_function_register_email(){
		$get_settings = new wpemails_cpve_settings();
		$wpemailscpve_front_options = $get_settings->wpemails_cpve_checkoptions();
		$wpemails_cpve_front_estatuspost = get_post_status($_GET['post']);
		$wpemails_cpve_front_data = get_post_meta($_GET['post'],'wpemails_cpve_cpt_options');
		print_r($wpemails_cpve_front_data);

		/*if($wpemails_cpve_front_estatuspost=='pending'){
			//condicion para saber si aceptamos el email
			$cpmm_front = new cPanelMailManager($wpemailscpve_front_options['user'], $wpemailscpve_front_options['pass'], $wpemailscpve_front_options['host']);
			if($cpmm_front->createEmail($wpemails_cpve_front_data['wpemails_cpve_email_corporative'],$wpemails_cpve_front_data['wpemails_cpve_email_password'],$wpemails_cpve_front_data['wpemails_cpve_plan'])){
					echo 'CORREO ACTIVADO SATISFACTORIAMENTE';
					 $my_post = array(
					 	'ID' => $_GET['post'],
					    'post_status' => 'publish'
					  );
					wp_update_post($my_post);
			}else{
				echo 'OCURRIO UN ERROR AL ACTIVAR CORREO';
			}
		}*/
	}

