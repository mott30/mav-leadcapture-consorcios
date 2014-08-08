<?php
/**
 * @package MAV Lead Capture - Consórcios
 * @version 1.0
 */
/*
Plugin Name: MAV Lead Capture - Consórcios
Plugin URI: https://github.com/MAVResultadosOnline/mav-leadcapture-consorcios
Description: Plugin para simulação de consórcios e captura de contatos.
Author: Luciano Tonet
Version: 1.0
Author URI: http://lucianotonet.com
*/
/*
 *      Copyright 2014 Luciano Tonet <contato@lucianotonet.com>
 *
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 3 of the License, or
 *      (at your option) any later version.
 *
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */


define('MLC_USERKEY', '81dc9bdb52d04dc20036dbd8313ed055');
define('MLC_SANDBOX', true);

include( plugin_dir_path( __FILE__ ) . 'MLC_Simulador.php' );
include( plugin_dir_path( __FILE__ ) . 'MLC_Debugger.php' );
include( plugin_dir_path( __FILE__ ) . 'MLC_Connector.php' );

// SHOTRCODE [simulador]
add_shortcode( 'simulador', array( 'MLC_Simulador' , 'showForm') );


// Inclui o Bootstrap (js e css) 
// No formulário e tabela 
function simulador_bootstrap() {  
   wp_enqueue_script( 'bootstrapJs', '//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js', array( 'jquery' ) );   
   wp_enqueue_style( 'bootstrapCss', '//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css' );

   // Bootstrap Slider
   // --> http://www.eyecon.ro/bootstrap-slider/
   // --> http://seiyria.github.io/bootstrap-slider/

   //Bootstrap Slider CSS
   wp_enqueue_style( 'bootstrapSliderCss', plugins_url( '/css/bootstrap-slider.css' , __FILE__ ) );
   //Bootstrap Slider JS
   wp_enqueue_script( 'bootstrapSliderJs', plugins_url( '/js/bootstrap-slider.js' , __FILE__ ), 'bootstrapJs' );
}
add_action( 'wp_enqueue_scripts', 'simulador_bootstrap' );


add_action( 'init', 'github_plugin_updater_test_init' );
function github_plugin_updater_test_init() {

   //include_once 'updater.php';
   include( plugin_dir_path( __FILE__ ) . 'MLC_Updater.php' ); //https://github.com/jkudish/WordPress-GitHub-Plugin-Updater

   define( 'WP_GITHUB_FORCE_UPDATE', true );

   if ( is_admin() ) { // note the use of is_admin() to double check that this is happening in the admin

      $config = array(
         'slug' => plugin_basename( __FILE__ ),
         'proper_folder_name' => 'mav-leadcapture-consorcios',
         'api_url' => 'https://api.github.com/repos/MAVResultadosOnline/mav-leadcapture-consorcios',
         'raw_url' => 'https://raw.github.com/MAVResultadosOnline/mav-leadcapture-consorcios',
         'github_url' => 'https://github.com/MAVResultadosOnline/mav-leadcapture-consorcios',
         'zip_url' => 'https://github.com/MAVResultadosOnline/mav-leadcapture-consorcios/archive/master.zip',
         'sslverify' => true,
         'requires' => '3.0',
         'tested' => '3.3',
         'readme' => 'README.md',
         'access_token' => '',
      );

      new WP_GitHub_Updater( $config );

   }

}