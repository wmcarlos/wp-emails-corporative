<?php


class wpemails_cpve_settings{

	/*********************************/
	function __construct()
	{
		//creamos el menu en el panel de configuracion
		add_action('admin_menu',  array(__CLASS__, 'wpemails_cpve_options_submenu_settings'));
		//se ejecuta en el admin
		add_action( 'admin_enqueue_scripts', array(__CLASS__, 'wpemails_cpve_admin_enqueue_scripts'), 999 );
		//se ejecuta en el front
		add_action( 'wp_enqueue_scripts',  array(__CLASS__, 'wpemails_cpve_admin_enqueue_scripts'), 999 );
		//guardar la configuracion de cuenta
		add_action( 'admin_post_wpemails_cpve_importdata', array(__CLASS__,'wpemails_cpve_importdata_callback'));	
		//guardar el testing de correo es decir probar registrando correo desde el admin
		add_action( 'admin_post_wpemails_cpve_testingdata', array(__CLASS__,'wpemails_cpve_testingdata_callback'));	
		//guardar la configuracion del newsletter
		add_action( 'admin_post_wpemails_cpve_newsletter', array(__CLASS__,'wpemails_cpve_newsletter_callback'));	
		//guardar los terminos de condiciones
		add_action( 'admin_post_wpemails_cpve_terminos', array(__CLASS__,'wpemails_cpve_terminos_callback'));	
		//guardar las plantilla de correo
		add_action( 'admin_post_wpemails_cpve_template', array(__CLASS__,'wpemails_cpve_template_callback'));	


	}

	function wpemails_cpve_checkoptions(){
		$wpemails_cpve_options = get_option('wpemails_cpve_options',true);
		$wpemails['host'] = isset($wpemails_cpve_options['txtdomain']) ? $wpemails_cpve_options['txtdomain'] : '';
		$wpemails['user'] = isset($wpemails_cpve_options['txtuser']) ? $wpemails_cpve_options['txtuser'] : '';
		$wpemails['pass']  = isset($wpemails_cpve_options['txtpassword']) ? $wpemails_cpve_options['txtpassword'] : '';
		$wpemails['txtacrocorporative']  = isset($wpemails_cpve_options['txtacrocorporative']) ? $wpemails_cpve_options['txtacrocorporative'] : '';
		return $wpemails;
	}

	/*******************************/
	/*Css y javascript que usaremos en el panel admin*/
	public static function wpemails_cpve_admin_enqueue_scripts(){
		//estilos
		wp_enqueue_style('jquery-ui','//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
		wp_enqueue_style( 'wpemails_cpve_style',plugin_dir_url( __FILE__ ).'../public/css/style.css');
		wp_enqueue_script( 'wpemails_cpve_utils',plugin_dir_url(__FILE__ ).'../frontend/validateTel/js/utils.js', array( 'jquery') );
		wp_enqueue_script("jquery-ui-core");
		wp_enqueue_script("jquery-ui","https://code.jquery.com/ui/1.12.1/jquery-ui.js",array("jquery"));
		

	}


	/**************************************/
	//creacion del submenu dentro del menu configuracion
	public static function wpemails_cpve_options_submenu_settings()
	{	
		//Agregamos menu de configuracion
		add_submenu_page(
			'edit.php?post_type=wpemails_cpve_cpt',          // el slug en donde mostraremos el submenu
			__( 'Configuracion', 'wp_emails_corporative' ), // titulo de la pagina
		    __( 'Configuracion', 'wp_emails_corporative' ), //  titulo del menu
				'manage_options',               // capacidad requerida para ver esta pagina 
				'wpemails_cpve_settings',                //  nombre de la pagina o su slug, e.g. options-general.php?page=wpemails_cpve_settings
				  array(__CLASS__,'wpemails_cpve_settings_fn')           // funcion callback en donde  colocaremos o que va dentro de la pagina
		);
		
		//Agregamos menu de configuracion de correos electronicos
				add_submenu_page(
			'edit.php?post_type=wpemails_cpve_cpt',          // el slug en donde mostraremos el submenu
			__( 'Plantillas de correo', 'wp_emails_corporative' ), // titulo de la pagina
		    __( 'Plantillas de correo', 'wp_emails_corporative' ), //  titulo del menu
				'manage_options',               // capacidad requerida para ver esta pagina 
				'wpemails_cpve_template',                //  nombre de la pagina o su slug, e.g. options-general.php?page=wpemails_cpve_settings
				  array(__CLASS__,'wpemails_cpve_template_fn')           // funcion callback en donde  colocaremos o que va dentro de la pagina
		);
		
	}	


	/*Recibir los datos de terminos y condiciones*/
	public static function wpemails_cpve_terminos_callback(){
		$wpemailscpve_options['wpemails_cpve_terminos'] = $_POST['wpemails_cpve_terminos'];
		update_option('wpemails_cpve_terminos',$wpemailscpve_options);
		wp_redirect(admin_url('edit.php?post_type=wpemails_cpve_cpt&page=wpemails_cpve_settings&section=terminos'));

	}
	//**Recibir los datos de plantillas de correo
	public static function wpemails_cpve_template_callback(){
		$wpemailscpve_options['wpemails_cpve_template'] = $_POST['wpemails_cpve_template'];
		update_option('wpemails_cpve_template',$wpemailscpve_options);
		wp_redirect(admin_url('edit.php?post_type=wpemails_cpve_cpt&page=wpemails_cpve_template'));
	}


	/**************************************************/
	//Recibir lo datos de configuracion del newsletter via post
	public static function wpemails_cpve_newsletter_callback(){
		$wpemailscpve_options['wpemails_cpve_hostnamerelay'] = $_POST['wpemails_cpve_hostnamerelay'];

		$wpemailscpve_options['wpemails_cpve_apikeyrelay'] = $_POST['wpemails_cpve_apikeyrelay'];
		
		$wpemailscpve_options['wpemails_cpve_group_id'] = $_POST['wpemails_cpve_group_id'];

		$wpemailscpve_options['wpemails_cpve_group_name'] = $_POST['wpemails_cpve_group_name'];

		$wpemailscpve_options['wpemails_cpve_group_type'] = $_POST['wpemails_cpve_group_type'];

		update_option('wpemails_cpve_newsletter',$wpemailscpve_options);

		wp_redirect(admin_url('edit.php?post_type=wpemails_cpve_cpt&page=wpemails_cpve_settings&section=newsletter'));

	}

	/*************************************************/
	//recibir los datos de configuracion via post
	public static function wpemails_cpve_importdata_callback(){
		$wpemails_cpve_options['txtdomain'] = $_POST['txtdomain'];
		$wpemails_cpve_options['txtuser'] = $_POST['txtuser'];
		$wpemails_cpve_options['txtpassword'] = $_POST['txtpassword'];
		$wpemails_cpve_options['txtacrocorporative'] = $_POST['txtacrocorporative'];
		//guardamos los datos
		update_option('wpemails_cpve_options',$wpemails_cpve_options);
		//derireccionamos a la pagina nuevamente
		wp_redirect(admin_url('edit.php?post_type=wpemails_cpve_cpt&page=wpemails_cpve_settings'));
		
	}


	/**************************************************/
	//recibir los datos via post para el testing de correos
	public static function wpemails_cpve_testingdata_callback(){

		/*$wpemailscpve_options = self::wpemails_cpve_checkoptions();
		$cpmm = new cPanelMailManager($wpemailscpve_options['user'], $wpemailscpve_options['pass'], $wpemailscpve_options['host']);
		if($cpmm->createEmail($_POST['wpemails_cpve_email'],$_POST['wpemails_cpve_password'],$_POST['wpemails_cpve_quota'])){
				$wpemails_cpve_estatus = 'success';
			}else{
				$wpemails_cpve_estatus = 'error';
		}*/

		$wpemails_cpve_options['wpemails_cpve_emails'] = $_POST['wpemails_cpve_emails'];
		$wpemails_cpve_options['wpemails_cpve_asuntos'] = $_POST['wpemails_cpve_asuntos'];

		update_option('wpemails_cpve_emails',$wpemails_cpve_options);

		wp_redirect(admin_url('edit.php?post_type=wpemails_cpve_cpt&page=wpemails_cpve_settings&section=testing&estatus='.$wpemails_cpve_estatus));
	}


	/***************************************************/
	//creacion de la vista callback de la pagina de settings email
	public static function wpemails_cpve_settings_fn(){

		//estilo css para la opcion esto solo lo usaremos para dejar el boton activo dependiendo de la opcion
		if(!isset($_GET["section"])){
			$wpemails_cpve_section = 'config';
		}else{
			$wpemails_cpve_section = $_GET["section"];
		}
		echo '
		<style>
			.class_'.$wpemails_cpve_section.'{background-color: #0073AA !important; color:white !important;}
		</style>
		<ol class="wpemails_cpve_listmenu">
			<a style="color:white !important;" href="edit.php?post_type=wpemails_cpve_cpt&page=wpemails_cpve_settings&section=config"><li class="class_config">Configuración</li></a>
			<a style="color:white !important;" href="edit.php?post_type=wpemails_cpve_cpt&page=wpemails_cpve_settings&section=emails"><li class="class_emails">Lista de correos</li></a>
			<a style="color:white !important;" href="edit.php?post_type=wpemails_cpve_cpt&page=wpemails_cpve_settings&section=testing"><li class="class_testing">Auto Respuestas</li></a>
			<a style="color:white !important;" href="edit.php?post_type=wpemails_cpve_cpt&page=wpemails_cpve_settings&section=newsletter"><li class="class_newsletter">Newsletter</li></a>
			<a style="color:white !important;" href="edit.php?post_type=wpemails_cpve_cpt&page=wpemails_cpve_settings&section=terminos"><li class="class_terminos">Terminos y Condiciones</li></a>
		</ol>';
		//get templates
		//template configuracion
		if($_GET['section']=='config' or !isset($_GET['section'])){
			$wpemails_cpve_urldata = '';
			include_once('templates/tpl_configure.php');
		}
		//template listado de emails
		if(isset($_GET['section']) && $_GET['section']=='emails'){
			include_once('templates/tpl_listemails.php');
		}
		//probar el registro de correos
		if(isset($_GET['section']) && $_GET['section']=='testing'){
			include_once('templates/tpl_testing.php');
		}
		//registrar newsletter
		if(isset($_GET['section']) && $_GET['section']=='newsletter'){
			include_once('templates/tpl_newsletter.php');
		}
		//Terminos y condiciones
		if(isset($_GET['section']) && $_GET['section']=='terminos'){
			include_once('templates/tpl_terminos.php');
		}

	}


	/*******************************PAGINA PARA EL TEMPLATES DE EMAIL******************************/
	public static function wpemails_cpve_template_fn(){
		include_once('templates/tpl_email_template.php');
	}
}
new wpemails_cpve_settings();	
