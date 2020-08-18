<?php
/*
Plugin Name: Woo-Zap
Plugin URI: http://dropall.github.io
Description: Adicao de multi atendimento via Zap. License: Que licenca?
Version: Beta 0.07
Author: Henry Jr
Author URI: http://dropall.github.io
License: Que licenca?
*/

require_once('woo-zap.php');

/* TEAM ZAP */
 
// Hook init action
add_action( 'init', 'lc_custom_post_woozap' );
 
// The custom function to register a movie post type
function lc_custom_post_woozap() {
 
  // Set the labels, this variable is used in the $args array
  $labels = array(
    'name'               => __( 'Woo-Zap' ),
    'singular_name'      => __( 'Woo-Zap' ),
    'add_new'            => __( 'Novo' ),
    'add_new_item'       => __( 'Adicionar' ),
    'edit_item'          => __( 'Editar' ),
    'new_item'           => __( 'Novo' ),
    'all_items'          => __( 'Colaboradores' ),
    'view_item'          => __( 'Ver' ),
    'search_items'       => __( 'Buscar' ),
    'featured_image'     => 'Enviar Foto',
    'set_featured_image' => 'Salvar foto'
  );
 
  $args = array(
    'labels'            => $labels,
    'description'       => 'Dados específicos',
    'public'            => true,
    'menu_position'     => 5,
    'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
    'has_archive'       => true,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'has_archive'       => true,
    'query_var'         => 'woozap'
  );
 
  // Call the actual WordPress function
  // Parameter 1 is a name for the post type
  // Parameter 2 is the $args array
  register_post_type( 'Woo-Zap', $args);
}


add_filter( 'single_template', 'override_single_template' );
function override_single_template( $single_template ){
    global $post;
    $file = dirname(__FILE__) .'/templates/single-'. $post->post_type .'.php';
    if( file_exists( $file ) ) $single_template = $file;
    return $single_template;
}