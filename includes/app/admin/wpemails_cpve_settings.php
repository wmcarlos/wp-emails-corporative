<?php


class wpemails_cpve_settings{
	/*********************************/
	function __construct()
	{
		//creamos el menu en el panel de configuracion
		add_action('admin_menu',  array(__CLASS__, 'wpemails_cpve_options_submenu_settings'));
		add_action( 'admin_enqueue_scripts', array(__CLASS__, 'wpemails_cpve_admin_enqueue_scripts'), 999 );
		add_action( 'admin_post_wpemails_cpve_importdata', array(__CLASS__,'wpemails_cpve_importdata_callback'));	
	}
	/************************************/

	
	/*******************************/
	/*Css y javascript que usaremos en el panel admin*/
	public static function wpemails_cpve_admin_enqueue_scripts(){
		//estilos
		wp_enqueue_style( 'wpemails_cpve_style',plugin_dir_url( __FILE__ ).'../public/css/style.css');
	}
	/**********************************/


	/**************************************/
	//creacion del submenu dentro del menu configuracion
	public static function wpemails_cpve_options_submenu_settings()
	{
		add_submenu_page(
			'options-general.php',          // el slug en donde mostraremos el submenu
			__( 'Settings WP Emails Corporative Hosting', 'wp_emails_corporative' ), // titulo de la pagina
		    __( 'Settings WP Emails Corporative Hosting', 'wp_emails_corporative' ), //  titulo del menu
				'manage_options',               // capacidad requerida para ver esta pagina 
				'wpemails_cpve_settings',                //  nombre de la pagina o su slug, e.g. options-general.php?page=wpemails_cpve_settings
				  array(__CLASS__,'wpemails_cpve_settings_fn')           // funcion callback en donde  colocaremos o que va dentro de la pagina
			);
	}
	/******************************************/
	

	//recibir los datos de configuracion via post
	public static function wpemails_cpve_importdata_callback(){
		$wpemails_cpve_options['txtdomain'] = $_POST['txtdomain'];
		$wpemails_cpve_options['txtuser'] = $_POST['txtuser'];
		$wpemails_cpve_options['txtpassword'] = $_POST['txtpassword'];
		//guardamos los datos
		update_option('wpemails_cpve_options',$wpemails_cpve_options);
		//derireccionamos a la pagina nuevamente
		wp_redirect(admin_url('options-general.php?page=wpemails_cpve_settings'));
		
	}


	/***************************************************/
	//creacion de la vista callback de la pagina de settings email
	public static function wpemails_cpve_settings_fn(){
		$wpemails_cpve_urldata = '';
		$wpemails_cpve_options = get_option('wpemails_cpve_options',true);
		echo '
		<ol class="wpemails_cpve_listmenu">
			<a href="options-general.php?page=wpemails_cpve_settings&section=config"><li class="">Configuración</li></a>
			<a href="options-general.php?page=wpemails_cpve_settings&section=emails"><li class="">Lista de correos</li></a>
		</ol>';
		//get templates
		//template configuracion
		if($_GET['section']!='emails' or !isset($_GET['section'])){
			include_once('templates/tpl_configure.php');
		}
		//template listado de emails
		if(isset($_GET['section']) && $_GET['section']=='emails'){
			include_once('templates/tpl_listemails.php');
		}

	}
	/***********************************************************/
}
new wpemails_cpve_settings();	
