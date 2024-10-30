=== CC-Auto-Activate-Plugins ===
Contributors: ClearcodeHQ, PiotrPress
Tags: plugin, activate, activated, auto activate, muplugin, mu-plugins, must use plugins, MU Plugins, Plugins, loader, load, autoload, autoloading, clearcode, piotrpress
Requires PHP: 7.2
Requires at least: 4.9.1
Tested up to: 5.1
Stable tag: trunk
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.txt

This plugin automatically activate all Plugins from WP_PLUGIN_DIR.

== Description ==

This plugin automatically activate all Plugins from WP_PLUGIN_DIR.

= Tips & Tricks =

1. You can use plugin as Must Use Plugin (you can also use [CC-MU-Plugins-Loader](https://wordpress.org/plugins/cc-mu-plugins-loader) to load it).
2. You can exclude plugins from auto activate by using `Clearcode\Auto_Activate_Plugins` filter.

`add_filter( 'Clearcode\Auto_Activate_Plugins', function( $plugins ) {
    foreach ( [
        'example/plugin.php'
    ] as $plugin ) if ( isset( $plugins[ $plugin ] ) ) unset( $plugins[ $plugin ] );
    return $plugins;
} );`

== Installation ==

= From your WordPress Dashboard =

1. Go to 'Plugins > Add New'
2. Search for 'CC-Auto-Activate-Plugins'
3. Activate the plugin from the Plugin section on your WordPress Dashboard.

= From WordPress.org =

1. Download 'CC-Auto-Activate-Plugins'.
2. Upload the 'cc-auto-activate-plugins' directory to '/wp-content/mu-plugins/' directory using your favorite method (ftp, sftp, scp, etc...)
3. Activate the plugin from the Plugin section on your WordPress Dashboard.

== Screenshots ==

1. **CC-Auto-Activate-Plugins** - Visit the 'Plugins' to activate the plugin.

== Changelog ==

= 1.1.3 =
*Release date: 25.02.2019*

* Changed composer name to: wpackagist-plugin/cc-auto-activate-plugins.

= 1.1.2 =
*Release date: 25.02.2019*

* Changed composer type to: wordpress-muplugin.
* Tested plugin to newest WordPress v5.1

= 1.1.1 =
*Release date: 05.01.2018*

* Added support for composer.

= 1.1.0 =
*Release date: 04.01.2018*

* Added support for WordPress core 'activate_plugin' function.

= 1.0.0 =
*Release date: 02.01.2018*

* First stable version of the plugin.