<?php
/** Enable W3 Total Cache Edge Mode */
define('W3TC_EDGE_MODE', true); // Added by W3 Total Cache


if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {
    include( dirname( __FILE__ ) . '/local-config.php' );
}

// ** MySQL settings ** //
define('DB_NAME', getenv('RDS_DB_NAME'));    // The name of the database
define('DB_USER', getenv('RDS_USERNAME'));     // Your MySQL username
define('DB_PASSWORD', getenv('RDS_PASSWORD')); // ...and password
define('DB_HOST', getenv('RDS_HOSTNAME') . ':' . getenv('RDS_PORT'));    // 99% chance you won't need to change this value

// You can have multiple installations in one database if you give each a unique prefix
$table_prefix  = '';   // Only numbers, letters, and underscores please!

// Change this to localize WordPress.  A corresponding MO file for the
// chosen language must be installed to wp-includes/languages.
// For example, install de.mo to wp-includes/languages and set WPLANG to 'de'
// to enable German language support.
define ('WPLANG', 'de');
setlocale(LC_TIME, array('de_DE.utf8', 'de_DE', 'de'));

define('WP_CACHE', true);

/* That's all, stop editing! Happy blogging. */

define('ABSPATH', dirname(__FILE__).'/');
require_once(ABSPATH.'wp-settings.php');
