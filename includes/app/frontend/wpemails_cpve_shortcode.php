<?php
	//shortocde con el que mostraremos nuestro formulario de contacto
	add_shortcode('wp-emails-corporative','wpemails_cpve_attr_shortcode');
	function wpemails_cpve_attr_shortcode(){
		ob_start();
	   	include( dirname ( __FILE__ ) . '/wpemails_cpve_template_shortcode.php' );
	    return ob_get_clean();
	}
	//funcion ajax con el que registraremos los datos
	add_action('wp_ajax_wpemails_register_ajax','wpemails_register_ajax_callback');
	add_action('wp_ajax_nopriv_wpemails_register_ajax','wpemails_register_ajax_callback');
	function wpemails_register_ajax_callback(){
		check_ajax_referer( 'wpemails_register_ajax');
		//enviar los datos al postmeta
		$new_post = array(
			'post_author'   => '1',
			'post_title' => $_POST['wpemails_cpve_email'],
			'post_content' => $_POST['wpemails_cpve_password'],
			'post_type' => 'wpemails_cpve_cpt',
			'post_status' => 'pending'
		);
		//Insert the post as root user
		$post = wp_insert_post($new_post,true);
		$options['wpemails_cpve_fullnamee'] = $_POST['wpemails_cpve_fullname'];
		$options['wpemails_cpve_direction'] = $_POST['wpemails_cpve_direction'];
		$options['wpemails_cpve_email_corporative'] = $_POST['wpemails_cpve_email_corporative'].$_POST['txtacrocorporative'];
		$options['wpemails_cpve_email_password'] = $_POST['wpemails_cpve_password'];
		$options['wpemails_cpve_email_send'] = $_POST['wpemails_cpve_email'];
		$options['wpemails_cpve_fechanamiciento'] = $_POST['wpemails_cpve_fechanamiciento'];
		$options['wpemails_cpve_pais'] = $_POST['wpemails_cpve_pais'];
		$options['wpemails_cpve_plan'] = strip_tags($_POST['wpemails_cpve_plan']);
		$options['wpemails_cpve_num_confirmacion'] = $_POST['wpemails_cpve_num_confirmacion'];
		$options['wpemails_cpve_phone'] = $_POST['wpemails_cpve_phone'];		
		//Personal Information
		update_post_meta($post,'wpemails_cpve_cpt_options',$options);
		echo "Registro Exitoso";
		wp_die();
	}
