<?php
/**
 * Plugin Name:     WP Emails Corporative
 * Plugin URI:      
 * Description:     Integrates the corporate mail register of your web page to the visitors of your blog
 * Version:         1.0.0
 * Author:          frontuari C.A
 * Author URI:      frontuari.com
 * Text Domain:     wp_emails_corporative
 *
 * @package        	frontuari\WP Emails Corporative
 * @author          Alberto Vargas
 * @copyright       Copyright (c) 2017
 *
 *
 * - Find all instances of @todo in the plugin and update the relevant
 *   areas as necessary.
 *
 * - All functions that are not class methods MUST be prefixed with the
 *   plugin name, replacing spaces with underscores. NOT PREFIXING YOUR
 *   FUNCTIONS CAN CAUSE PLUGIN CONFLICTS!
 */


// Plugin version
if ( ! defined('WPEMAILS_CPVE_VERSION' ) ) define('WPEMAILS_CPVE_VERSION', '1.0' ); 

if ( ! class_exists( 'WPEMAILS_CPVE' ) ) :

class WPEMAILS_CPVE {
	
	private static $instance = null;
	
	public static function getInstance() {
		if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
	}
	function __construct() {
		$this->setupGlobals();
		$this->includes();
		$this->loadTextDomain();
		
	}
	private function includes() {
		//API REST CPANEL
		require_once WPEMAILS_CPVE_PLUGIN_DIR.'includes/app/admin/api/class.cpmm.php';
		//Settings
		require_once WPEMAILS_CPVE_PLUGIN_DIR.'includes/app/admin/wpemails_cpve_settings.php';
		do_action('wpemails_cpve_include_files');
	}
	
	private function setupGlobals() {
		// Plugin Folder Path
		if (!defined('WPEMAILS_CPVE_PLUGIN_DIR')) {
			define('WPEMAILS_CPVE_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
		}

		// Plugin Folder URL
		if (!defined('WPEMAILS_CPVE_PLUGIN_URL')) {
			define('WPEMAILS_CPVE_PLUGIN_URL', plugin_dir_url(__FILE__));
		}

		// Plugin Root File
		if (!defined('WPEMAILS_CPVE_PLUGIN_FILE')) {
			define('WPEMAILS_CPVE_PLUGIN_FILE', __FILE__ );
		}
		
		// Plugin text domain
		if (!defined('WPEMAILS_CPVE_TEXT_DOMAIN')) {
			define('WPEMAILS_CPVE_TEXT_DOMAIN', 'wp_emails_corporative' );
		}

	}
	public function loadTextDomain() {
		// Set filter for plugin's languages directory
		$lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
		$lang_dir = apply_filters('wpemails_cpve_languages_directory', $lang_dir );

		// Traditional WordPress plugin locale filter
		$locale        = apply_filters( 'plugin_locale',  get_locale(), 'WPEMAILS_CPVE' );
		$mofile        = sprintf( '%1$s-%2$s.mo', 'WPEMAILS_CPVE', $locale );

		// Setup paths to current locale file
		$mofile_local  = $lang_dir . $mofile;
		$mofile_global = WP_LANG_DIR . '/WPEMAILS_CPVE/' . $mofile;

		if ( file_exists( $mofile_global ) ) {
			// Look in global /wp-content/languages/TESTPRO/ folder
			load_textdomain( 'WPEMAILS_CPVE', $mofile_global );
		} elseif ( file_exists( $mofile_local ) ) {
			// Look in local /wp-content/plugins/TESTPRO/languages/ folder
			load_textdomain( 'WPEMAILS_CPVE', $mofile_local );
		} else {
			// Load the default language files
			load_plugin_textdomain( 'WPEMAILS_CPVE', false, $lang_dir );
		}
		
	}
}

endif; // End if class_exists check

$wpemail_cpve = null;
function getClasswpemail_cpve() {
	global $wpemail_cpve;
	if (is_null($wpemail_cpve)) {
		$wpemail_cpve = WPEMAILS_CPVE::getInstance();
	}
	return $wpemail_cpve;
}
getClasswpemail_cpve();
