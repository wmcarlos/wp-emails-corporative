<?php


class wpemails_cpve_settings{
	function __construct()
	{
		//create menu in settings
		add_action('admin_menu',  array(__CLASS__, 'wpemails_cpve_options_submenu_settings'));
	}
	public static function wpemails_cpve_options_submenu_settings()
	{
		add_submenu_page(
			'options-general.php',          // admin page slug
			__( 'Settings WP Emails Corporative Hosting', 'wp_emails_corporative' ), // page title
		    __( 'Settings WP Emails Corporative Hosting', 'wp_emails_corporative' ), // menu title
				'manage_options',               // capability required to see the page
				'wpemails_cpve_settings',                // admin page slug, e.g. options-general.php?page=wpemails_cpve_settings
				  array(__CLASS__,'wpemails_cpve_settings_fn')           // callback function to display the options page
			);
	}//close wpmapirest_options_submenu_settings
	//create view menu settings callback function
	public static function wpemails_cpve_settings_fn(){

		echo "<h1>Aqui comienzo a crear los campos que iran en la  configuracion de la api</h1>";
	}

}
new wpemails_cpve_settings();	
