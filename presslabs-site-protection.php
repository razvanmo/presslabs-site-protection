<?php
/*
 * Plugin Name: Site Protection
 * Plugin URI: http://wordpress.org/extend/plugins/presslabs-site-protection/
 * Description: Site protection plugin for dev instances to avoid indexing by search engines. Doesn't allow access to the site without being logged-in.
 * Version: 1.0
 * Author: Presslabs
 * Author URI: http://www.presslabs.com/
 */

//--------------------------------------------------------------------

function presslabs_site_protection_walled_garden()
{
	if ( ! is_user_logged_in() ) {
		header( 'HTTP/1.1 403 Forbidden' );
		?><html>
		<head>
			<title>Login protection</title>
			<meta http-equiv="refresh" content="2; URL=/wp-login.php">
			<meta name="keywords" content="automatic redirection">
			<?php wp_head();?>
		</head>
		<body>
		<?php echo __( "If your browser doesn't automatically go there within a few seconds, you may want to click", 'presslabs-site-protection' ) . ' <a href="/wp-login.php">' . __( 'to login', 'presslabs-site-protection' ) . '</a> ' . __( 'manually.', 'presslabs-site-protection' );
		wp_footer();?>
		</body>
		</html><?php
		exit;
	}
}
add_action( 'template_redirect', 'presslabs_site_protection_walled_garden' );

function presslabs_site_protection_load_textdomain()
{
	// Localization
	load_plugin_textdomain( 'presslabs-site-protection', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

// Add actions
add_action( 'plugins_loaded', 'presslabs_site_protection_load_textdomain' );
