<?php
	//shortocde con el que mostraremos nuestro formulario de contacto
	add_shortcode('wp-emails-corporative','wpemails_cpve_attr_shortcode');
	//abrir ventana poput de terminos
	add_action('admin_post_wpemails_terminos','wpemails_terminos_callback');
 	add_action('admin_post_nopriv_wpemails_terminos','wpemails_terminos_callback');

  	function wpemails_terminos_callback(){
    	include_once 'wpemails_cpve_terms.php';
 	}


	function wpemails_cpve_attr_shortcode(){
		ob_start();
	   	include( dirname ( __FILE__ ) . '/wpemails_cpve_template_shortcode.php' );
	    return ob_get_clean();
	}


	//funcion ajax para verificar que el correo  personal no tenga registrado una cuenta free 
	add_action('wp_ajax_wpemails_verify_email','wpemails_verify_email_callback');
	add_action('wp_ajax_nopriv_wpemails_verify_email','wpemails_verify_email_callback');
	function wpemails_verify_email_callback(){
		//echo $_POST['text_plan']. " ".$_POST['wpemails_cpve_email'];
		  query_posts(array( 
		        'post_type' => 'wpemails_cpve_cpt',
		        'post_status' => 'publish'
		  )); 
		  $exist = 'no';
		   while (have_posts()) : the_post(); 
		   		$data_temp  = get_post_meta(get_the_id(),'wpemails_cpve_cpt_options');
		   		//echo $data_temp[0]['wpmails_cpve_text_plan'];
		      	//echo get_the_id();
		      	if($data_temp[0]['wpemails_cpve_email_send']==$_POST['wpemails_cpve_email']){
		      		if(strpos($data_temp[0]['wpmails_cpve_text_plan'],'Free')>0 || (strpos($data_temp[0]['wpmails_cpve_text_plan'],'FREE')>0) ){
						if($_POST['text_plan'] == $data_temp[0]['wpmails_cpve_text_plan']){
							$exist = 'yes';		
						}
		      		}
		      	}
		   endwhile;
		   echo $exist;
		wp_die();
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
		$options['wpmails_cpve_ofertas'] = $_POST['wpmails_cpve_ofertas'];
		$options['wpmails_cpve_mejoras'] = $_POST['wpmails_cpve_mejoras'];
		$options['wpmails_cpve_text_plan'] = $_POST['text_plan'];
		$options['wpemails_group_empleo'] = $_POST['wpemails_group_empleo'];
		$options['wpemails_group_descuentos'] = $_POST['wpemails_group_descuentos'];
		//Personal Information


		update_post_meta($post,'wpemails_cpve_cpt_options',$options);
		echo $post;
		
		wp_die();
	}
