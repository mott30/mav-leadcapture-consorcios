<?php
/**
 * @package MAV Lead Capture - Consórcios
 * @version 0.1
 */
/*
Plugin Name: MAV Lead Capture - Consórcios
Plugin URI: https://github.com/MAVResultadosOnline/mav-leadcapture-consorcios
Description: Plugin para simulação de consórcios e captura de contatos.
Author: Luciano Tonet
Version: 0.1
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


define('USER_KEY', '81dc9bdb52d04dc20036dbd8313ed055');
define('MLC_DEBUG', true);


include( plugin_dir_path( __FILE__ ) . 'MLC_Simulador.php');
include( plugin_dir_path( __FILE__ ) . 'MLC_Debugger.php');
include( plugin_dir_path( __FILE__ ) . 'MLC_Connector.php');

// SHOTRCODE [simulador]
add_shortcode( 'simulador', array( 'MLC_Simulador' , 'showForm') );


/**
 *    CONSÓRCIO
 *    Custom Post Type
 */
if ( ! function_exists('MLC_consorcio_cpt') ) {
   
   /**
    * CONSÓRCIO custom post type
    */
   function MLC_consorcio_cpt() {
      $labels = array(
         'name'                => 'Consórcios',
         'singular_name'       => 'Consórcio',
         'menu_name'           => 'Consórcios',
         'parent_item_colon'   => 'Item pai:',
         'all_items'           => 'Todos',
         'view_item'           => 'Ver item',
         'add_new_item'        => 'Adicionar novo Consórcio',
         'add_new'             => 'Adicionar novo',
         'edit_item'           => 'Editar Consórcio',
         'update_item'         => 'Atualizar item',
         'search_items'        => 'Buscar consórcio',
         'not_found'           => 'Nada encontrado',
         'not_found_in_trash'  => 'Nada na lixeira.',
      );

      /**
       *       Get Categorias of Consorcio Post
       */
      $categorias = wp_get_object_terms($post->ID, 'categoria');
      $cats = '';
      if(!empty($categorias)){
        if(!is_wp_error( $categorias )){         
          foreach($categorias as $term){
            $cats .= $term->slug; 
          }
        }
      };
      $rewrite = array(
         'slug'                => 'consorcio'.$cats,
         'with_front'          => true,
         'pages'               => true,
         'feeds'               => true,
      );
      $args = array(
         'label'               => 'consorcio',
         'description'         => 'Descrição do post_type consórcio...',
         'labels'              => $labels,
         'supports'            => array( 'page-attributes' ),
         'taxonomies'          => array( 'categoria' ),
         'hierarchical'        => false,
         'public'              => true,
         'show_ui'             => true,
         'show_in_menu'        => true,
         'show_in_nav_menus'   => true,
         'show_in_admin_bar'   => true,
         'menu_position'       => 5,
         'menu_icon'           => '',
         'can_export'          => true,
         'has_archive'         => false,
         'exclude_from_search' => false,
         'publicly_queryable'  => true,
         'rewrite'             => $rewrite,
         'capability_type'     => 'post',
      );
      register_post_type( 'consorcio', $args );

   }
   add_action( 'init', 'MLC_consorcio_cpt', 0 );
}



/**
 *       CATEGORIA
 *       para consórcio
 */
if ( ! function_exists( 'categoria_taxonomy' ) ) {
   
   /**
    * CATEGORIA Taxonomy
    * 
    * Registra a taxonomia categoria
    * para o CPT "consorcio"
    */
   function categoria_taxonomy() {
      $labels = array(
         'name'                       => 'Categoria',
         'singular_name'              => 'Categoria',
         'menu_name'                  => 'Categoria',
         'all_items'                  => 'Todas',
         'parent_item'                => 'Categoria pai:',
         'parent_item_colon'          => 'Categoria pai:',
         'new_item_name'              => 'Nova Categoria',
         'add_new_item'               => 'Adicionar nova categoria',
         'edit_item'                  => 'Editar categoria',
         'update_item'                => 'Atualizar categoria',
         'separate_items_with_commas' => 'Separe as categorias por vírgula',
         'search_items'               => 'Buscar categoria',
         'add_or_remove_items'        => 'Adicionar ou remover categoria',
         'choose_from_most_used'      => 'Mais usadas',
         'not_found'                  => 'Nada encontrado',
      );
      $args = array(
         'labels'                     => $labels,
         'hierarchical'               => true,
         'public'                     => true,
         'show_ui'                    => true,
         'show_admin_column'          => true,
         'show_in_nav_menus'          => true,
         'show_tagcloud'              => true,
         'rewrite'                    => false,
      );
      register_taxonomy( 'categoria', 'consorcio', $args );
   }
   add_action( 'init', 'categoria_taxonomy', 0 );
}



// Include the meta box definition (the file where you define meta boxes, see `demo/demo.php`)
//include 'extra-fields.php';
include( plugin_dir_path( __FILE__ ) . 'extra-fields.php');



//Muda o TÍTULO do post ao salvar para o valor em R$
function MLC_save_title($title_to_ignore) {  
   if ($_POST['post_type'] == 'consorcio') {
      
      //$date = date('m-d-y',strtotime($_POST['_date']));
      // $my_post_title = strip_tags( $_POST['tipo_contemplado'] ) . ' - ' . strip_tags( $_POST['valor_contemplado'] ) ;
      if( isset($_POST['consorcio_credito']) ) {
         if(empty($_POST['consorcio_credito'])){
            $credito = '0,00';            
         }else{
            $credito = strip_tags( $_POST['consorcio_credito'] );          
         }
         $my_post_title = "R$ ".$credito;
      };
      return $my_post_title;
   }else{
      return $title_to_ignore;
   };
}
add_filter('title_save_pre', 'MLC_save_title');


   
//Muda o NOME (slug) do post ao salvar

function MLC_save_name($name_to_ignore) {
   if ($_POST['post_type'] == 'consorcio') { 
      /**
       *       Get Categorias of Consorcio Post
       */
      $categorias = get_the_terms( $post->ID, 'categoria' );
      if ( $categorias && ! is_wp_error( $categorias ) ){
         $cats = array();
         foreach ( $categorias as $term ) {
            $cats[] = $term->slug;
         };
         $cats = join( "-", $cats );
      };
      
      if( isset($_POST['consorcio_credito'])) { 
         if( empty($_POST['consorcio_credito']) ){
            $credito = '000';
         }else{
            $credito = strip_tags( $_POST['consorcio_credito'] );
            $credito = preg_replace('/[^\p{L}\p{N}\s]/u', '', $credito);
         }
         
         $my_post_name = $cats."-".$credito;
      }
      return $my_post_name;
   }else{
      return $name_to_ignore;
   };
}
add_filter('name_save_pre', 'MLC_save_name');


/**
 *       MENSAGENS 
 */
add_filter( 'post_updated_messages', 'MLC_updated_messages' );
/**
 * Consórcio update messages.
 *
 * See /wp-admin/edit-form-advanced.php
 *
 * @param array $messages Existing post update messages.
 *
 * @return array Amended post update messages with new CPT update messages.
 */
function MLC_updated_messages( $messages ) {
   $post             = get_post();
   $post_type        = get_post_type( $post );
   $post_type_object = get_post_type_object( $post_type );

   $messages['consorcio'] = array(
      0  => '', // Unused. Messages start at index 1.
      1  => __( 'Atualizado com sucesso!', 'mavlc' ),
      2  => __( 'Custom field updated.', 'mavlc' ),
      3  => __( 'Custom field deleted.', 'mavlc' ),
      4  => __( 'Atualizado com sucesso!', 'mavlc' ),
      /* translators: %s: date and time of the revision */
      5  => isset( $_GET['revision'] ) ? sprintf( __( 'Book restored to revision from %s', 'mavlc' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
      6  => __( 'Publicado com sucesso!', 'mavlc' ),
      7  => __( 'Salvo com sucesso!', 'mavlc' ),
      8  => __( 'Enviada com sucesso!', 'mavlc' ),
      9  => sprintf(
         __( 'Agendado para: <strong>%1$s</strong>.', 'mavlc' ),
         // translators: Publish box date format, see http://php.net/date
         date_i18n( __( 'M j, Y @ G:i', 'mavlc' ), strtotime( $post->post_date ) )
      ),
      10 => __( 'Rascunho atualizado!', 'mavlc' ),
   );

   if ( $post_type_object->publicly_queryable ) {
      $permalink = get_permalink( $post->ID );

      $view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'Ver', 'mavlc' ) );
      $messages[ $post_type ][1] .= $view_link;
      $messages[ $post_type ][6] .= $view_link;
      $messages[ $post_type ][9] .= $view_link;

      $preview_permalink = add_query_arg( 'preview', 'true', $permalink );
      $preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Visualizar', 'mavlc' ) );
      $messages[ $post_type ][8]  .= $preview_link;
      $messages[ $post_type ][10] .= $preview_link;
   }

   return $messages;
}

 
/**
 * Remover links Editar
 * @param  array $actions ['view', 'edit', etc]
 * @return array $actions Retorna a mesma array sem o 'view' e 'edit'
 */
function MLC_remove_row_actions( $actions )
{
    if( get_post_type() === 'consorcio' )
        unset( $actions['view'] );
      unset( $actions['edit'] );
    return $actions;
}
add_filter( 'post_row_actions', 'MLC_remove_row_actions', 10, 1 );


/**
 * Register STYLE and SCRIPTS for wp-admin 
 */
function MLC_load_consorcio_admin_scripts() {

   //jQuery Mask
   wp_register_script('consorcio_admin_jquery-mask', plugin_dir_url( __FILE__ ) . 'js/jquery.mask.min.js', 'jQuery', '1.0', true );
   wp_enqueue_script( 'consorcio_admin_jquery-mask' );

    //Custom SCRIPTS
   wp_register_script('consorcio_admin_scripts_js', plugin_dir_url( __FILE__ ) . 'js/script.js', 'jQuery', '1.0', true );
   wp_enqueue_script( 'consorcio_admin_scripts_js' );

   //Custom STYLES
   wp_register_style( 'consorcio_admin_css', plugin_dir_url( __FILE__ ) . 'admin/style.css', false, '1.0.0' );
   wp_enqueue_style( 'consorcio_admin_css' );

}
add_action( 'admin_enqueue_scripts', 'MLC_load_consorcio_admin_scripts' );


/**
 * Register STYLES for front-end
 */
function MLC_load_consorcio_styles() {
   //Register the style of simulator forms
    wp_register_style( 'consorcio_form_style', plugin_dir_url( __FILE__ ) . 'css/form-styles/default.css', false, '1.0.0' );
    wp_enqueue_style( 'consorcio_form_style' );
}

add_action( 'wp_enqueue_scripts', 'MLC_load_consorcio_styles' );



/**
 * 
 *       SHORTCODE [SIMULATOR_FORM]
 * 
 * */

// Add Shortcode
function simulator_form_shortcode( $atts ) {

   // Attributes
   extract( shortcode_atts(
      array(
         'style' => 'red',
         'type' => 'credito',
      ), $atts )
   );

   $simulatorFormStyle = 'nada';
   $simulatorForm = new Form_simulator();
   return $simulatorForm->buildForm($simulatorFormStyle);

}
add_shortcode( 'simulator_form', 'simulator_form_shortcode' );


/**
* 
*/
class Form_simulator{
   
   public function buildForm($style)
   {
      if(!empty($style)){
         $style = (string)$style;
      }

      // EXIBE O NINJA FORM
      if( function_exists( 'ninja_forms_display_form' ) ){ ninja_forms_display_form( 2 ); }

      // MANUAL FORM
      $form = '<div id="tru-simulator-form" class="'.@$style.'">
               <form class="form-container" action="resultado" method="post">
                  <div class="form-title">
                     <h2>Título</h2>
                  </div>
                  <div class="form-title">Name</div>
                  <input class="form-field" type="text" name="firstname" />
                     <br />
                  <div class="form-title">Email</div>
                  <input class="form-field" type="text" name="email" />
                     <br />
                  <div class="submit-container">
                     <input class="submit-button" type="submit" value="Submit" />
                  </div>
               </form>
            </div>';

      return $form; 
   }
}


/**
* 
*/
// class ManagePages{   
//    public function createPages()
//    {  
//          /**
//            *      CRIA Page Simulator
//            */
//           $pageSimulator   = get_page_by_title( 'simulacao' );          
//          if ( !is_page($pageSimulator->ID) ){
//             // Create page simulator
//             $simulatorPage = array(
//               'post_title'    => 'Simulação',
//               'post_content'  => '[simulador]',
//               'post_status'   => 'publish',
//               'post_type'    => 'page'
//             );
//             // Insert the post into the database
//             wp_insert_post( $simulatorPage );
//           }else{
//              echo "<br />SIMULATOR exists. ID ".$pageSimulator->ID;
//           }

//           /**
//            *      Page Results
//            */
//           $pageResults  = get_page_by_title( 'resultado' );
//           if ($pageSimulator and $pageResults ){
                     
//           }else{
//             // Create page Results
//             $resultsPage = array(
//               'post_title'    => 'Resultado',
//               'post_content'  => '[resultado]',
//               'post_status'   => 'publish',
//               'post_type'    => 'page',
//               'post_parent'   => $pageSimulator->ID,
//             );
//             // Insert the post into the database
//             wp_insert_post( $resultsPage );
//           }
//    }
// }



// INICIA CRIANDO AS PÁGINAS
// function MLC_init(){
//    //$init = new ManagePages();
//    //$init->createPages();
// }
// add_action('init', 'MLC_init');

// Add Shortcode
function MLC_form() {
   // Code
   $form = new Form_simulator();
   $formStyle = 'cracha';
   $form = $form->buildForm($formStyle);
   return $form;
}
add_shortcode( 'simulador_form', 'MLC_form' );






// INCLUDE BOOTSTRAP JS & CSS 
// ON SIMULATOR FORMS AND RESULTS TABLE
//
function simulador_bootstrap() {
   
   wp_enqueue_script( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js', array( 'jquery' ) );//plugins_url( '/js/bootstrap.min.js' , __FILE__ ),

   // Bootstrap CSS
   wp_enqueue_style( 'bootstrapCss', '//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css' );

   // Bootstrap Slider
   // --> http://www.eyecon.ro/bootstrap-slider/
   // --> http://seiyria.github.io/bootstrap-slider/

   //Bootstrap Slider CSS
   wp_enqueue_style( 'bootstrapSliderCss', plugins_url( '/css/bootstrap-slider.css' , __FILE__ ) );
   //Bootstrap Slider JS
   wp_enqueue_script( 'bootstrapSliderJs', plugins_url( '/js/bootstrap-slider.js' , __FILE__ ), 'bootstrap' );
}
add_action( 'wp_enqueue_scripts', 'simulador_bootstrap' );

