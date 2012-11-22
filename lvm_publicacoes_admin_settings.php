<?php
/*
Plugin Name: LVM Publications Custom Post Type
Plugin URI:  http://lvm.syn8.com
Description: Cria a seção de Publicações no site do LVM
Version:     0.1 
Author:      Thiago Lima
Author URI:  mailto:thiagoaslima@gmail.com
License:     GPL2


/*  

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// GLOSSÁRIO
// cpt -> custom post type


// i18n function
// add_action( 'init', 'lvm_i18n' );
// Initialize this plugin. Called by 'init' hook.
// function lvm_i18n() {
//   load_plugin_textdomain( 'lvm_cpt', 'wp-content/plugins/lvm_cpt_people/languages' );
// }


// Controls the javascript load
// http://scribu.net/wordpress/optimal-script-loading.html
add_action('init', 'LVM_pub_scripts');
add_action('admin_footer', 'LVM_pub_print_scripts');
 
function LVM_pub_scripts() {
    wp_register_script('autosize', plugins_url('js/autosize/jquery.autosize-min.js', __FILE__), array('jquery'), '1.0', true);
    wp_register_script('lvm_people_form', plugins_url('js/lvm_people_form.js', __FILE__), array('jquery'), '1.0', true);
}
 
function LVM_pub_print_scripts() {
    global $post;
 
    if( $post && $post->post_type != "lvm_people" ) return;
 
    wp_print_scripts('autosize');
    wp_print_scripts('lvm_people_form');
}



// Cria o espaço de registro do plugin na tabela wp_options
register_activation_hook( __FILE__, 'cpt_publicacoes_default_options' );

function cpt_publicacoes_default_options() {
    
    /***
     * \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
     * UPDATE THE VERSION WHEN IMPROVEMENTS ARE MADE
     * ////////////////////////////////////////////////////////////////
     **/
    
    $version = 0.1;

    if ( get_option( 'cpt_publicacoes_version' ) === false ) {
        add_option( 'cpt_publicacoes_version', "0.1" );
    } else if ( get_option( 'cpt_publicacoes_version' ) < $version ) {
        update_option( 'cpt_publicacoes_version', $version );
    }
}


/****************************************************************************
 * REGISTER THE CPT
 ****************************************************************************/

add_action( 'init', 'register_cpt_publicacoes' );

function register_cpt_publicacoes() {

    $labels = array( 
        'name'               => _x( 'Publicações', 'publicacoes' ),
        'singular_name'      => _x( 'Publicação', 'publicacoes' ),
        'add_new'            => _x( 'Adicionar Nova Publicação', 'publicacoes' ),
        'add_new_item'       => _x( 'Adicionar Nova Publicação', 'publicacoes' ),
        'edit_item'          => _x( 'Editar Publicação', 'publicacoes' ),
        'new_item'           => _x( 'Nova Publicação', 'publicacoes' ),
        'view_item'          => _x( 'Ver Publicação', 'publicacoes' ),
        'search_items'       => _x( 'Buscar Publicações', 'publicacoes' ),
        'not_found'          => _x( 'Nenhuma Publicações encontrado', 'publicacoes' ),
        'not_found_in_trash' => _x( 'Nenhuma Publicações encontrado', 'publicacoes' ),
        'parent_item_colon'  => _x( 'Subordinado a Publicação:', 'publicacoes' ),
        'menu_name'          => _x( 'Publicações', 'publicacoes' ),
    );

    $args = array( 
        'labels'              => $labels,
        'hierarchical'        => true,
        'description'         => 'description',
        'taxonomies'          => array( 'category' ),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        //'menu_icon'         => '',
        'show_in_nav_menus'   => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => true,
        'capability_type'     => 'post', 
        'supports'            => array( 'title',
                                        'editor',
                                        'thumbnail', 
                                        'revisions'),
    );

    register_post_type( 'publicacoes', $args );

}


/****************************************************************************
 * ADD METABOXES
 ****************************************************************************/

// Register function to be called when admin interface is visited
add_action( 'admin_init', 'cpt_publicacoes_admin_interface_init' );

function cpt_publicacoes_admin_interface_init() {

// Function to register new Autores meta box 
    add_meta_box( 
        'cpt_publicacoes_autores',               //html id that will be applied to this metabox
        'Autores',                                      //appears at the top of the new metabox when displayed
        'cpt_publicacoes_autores_html_def',      //callback >  the function which will load the html into the metabox
        'publicacoes',                                      //name of our custom post type
        'normal',                                                       //where the box will appear. can be "normal", "advanced" or "side"
        'high',                                                         //priority within the context where the boxes should show ('high', 'core', 'default' or 'low') );
        ''                                                              //(optional) Arguments to pass into your callback function. The callback will receive the  object and whatever parameters are passed through this variable
    );

// Function to register new Citação meta box 
    add_meta_box( 
        'cpt_publicacoes_citacao',               //html id that will be applied to this metabox
        'Citação',                                      //appears at the top of the new metabox when displayed
        'cpt_publicacoes_citacao_html_def',      //callback >  the function which will load the html into the metabox
        'publicacoes',                                      //name of our custom post type
        'normal',                                                       //where the box will appear. can be "normal", "advanced" or "side"
        'high',                                                         //priority within the context where the boxes should show ('high', 'core', 'default' or 'low') );
        ''                                                              //(optional) Arguments to pass into your callback function. The callback will receive the  object and whatever parameters are passed through this variable
    );
}

// Function to display Autores meta box contents
function cpt_publicacoes_autores_html_def( $post_type ) {
    
    global $post;
    $post_id = $post->ID;

    require ("inc/metaboxes/publicacoes/autores.php");
    
}

// Function to display Citação meta box contents
function cpt_publicacoes_citacao_html_def( $post_type ) {
    
    global $post;
    $post_id = $post->ID;

    require ("inc/metaboxes/publicacoes/citacao.php");

}


function cpt_publicacoes_save_data( $post_id = false, $post = false ) {
    
    // Check post type for book reviews
    if ( $post->post_type == 'publicacoes' ) {
        
    }
}

?>