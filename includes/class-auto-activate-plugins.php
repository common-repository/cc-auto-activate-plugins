<?php

/*
	Copyright (C) 2019 by Clearcode <https://clearcode.cc>
	and associates (see AUTHORS.txt file).

	This file is part of CC-Auto-Activate-Plugins plugin.

	CC-Auto-Activate-Plugins plugin is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	CC-Auto-Activate-Plugins plugin is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with CC-Auto-Activate-Plugins plugin; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

namespace Clearcode;

use Clearcode\Auto_Activate_Plugins\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( __NAMESPACE__ . '\Auto_Activate_Plugins' ) ) {
    class Auto_Activate_Plugins extends Plugin {
        protected $plugins = [];

        public function __construct() {
            parent::__construct();

            $this->plugins = get_plugins();
        }

        protected function get_plugins() {
            $plugins = $this->plugins;
            $plugin  = plugin_basename( self::get( 'file' ) );
            if ( isset( $plugins[ $plugin ] ) ) unset( $plugins[ $plugin ] );
            return apply_filters( self::get( 'slug' ), $plugins );
        }

        public function action_after_setup_theme() {
            foreach( $this->get_plugins() as $plugin => $data )
                if ( in_array( $plugin, array_keys( $this->plugins ) ) )
                    if ( is_wp_error( $result = activate_plugin( $plugin, ! empty( $data['Network'] ) ) ) )
                        error_log( self::get( 'slug' ) . ': ' . $result->get_error_message() );
        }

        public function filter_network_admin_plugin_action_links( $actions, $plugin ) {
            if ( plugin_basename( self::get( 'file' ) ) !== $plugin &&
                 array_key_exists( 'deactivate', $actions ) &&
                 array_key_exists( $plugin, $this->get_plugins() ) )
                unset( $actions['deactivate'] );

            return $actions;
        }

        public function filter_plugin_action_links( $actions, $plugin ) {
            if ( plugin_basename( self::get( 'file' ) ) !== $plugin &&
                 array_key_exists( 'deactivate', $actions ) &&
                 array_key_exists( $plugin, $this->get_plugins() ) )
                unset( $actions['deactivate'] );

            return $actions;
        }
    }
}
