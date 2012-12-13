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
    wp_register_script('lvm_pub_ajax', plugins_url('js/lvm_pub_ajax.js', __FILE__), array('jquery'), '1.0', true);
}
 
function LVM_pub_print_scripts() {
    global $post;
 
    if( $post && $post->post_type != "lvm_publicacoes" ) return;
 
    wp_print_scripts('autosize');
    wp_print_scripts('lvm_pub_ajax');
}



// Cria o espaço de registro do plugin na tabela wp_options
register_activation_hook( __FILE__, 'cpt_lvm_publicacoes_default_options' );

function cpt_lvm_publicacoes_default_options() {
    
    /***
     * \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
     * UPDATE THE VERSION WHEN IMPROVEMENTS ARE MADE
     * ////////////////////////////////////////////////////////////////
     **/
    
    $version = 0.1;

    if ( get_option( 'cpt_lvm_publicacoes_version' ) === false ) {
        add_option( 'cpt_lvm_publicacoes_version', "0.1" );
    } else if ( get_option( 'cpt_lvm_publicacoes_version' ) < $version ) {
        update_option( 'cpt_lvm_publicacoes_version', $version );
    }
}


/****************************************************************************
 * REGISTER THE CPT
 ****************************************************************************/

add_action( 'init', 'register_cpt_lvm_publicacoes' );

function register_cpt_lvm_publicacoes() {

    $labels = array( 
        'name'               => _x( 'Publicações', 'lvm_publicacoes' ),
        'singular_name'      => _x( 'Publicação', 'lvm_publicacoes' ),
        'add_new'            => _x( 'Adicionar Nova Publicação', 'lvm_publicacoes' ),
        'add_new_item'       => _x( 'Adicionar Nova Publicação', 'lvm_publicacoes' ),
        'edit_item'          => _x( 'Editar Publicação', 'lvm_publicacoes' ),
        'new_item'           => _x( 'Nova Publicação', 'lvm_publicacoes' ),
        'view_item'          => _x( 'Ver Publicação', 'lvm_publicacoes' ),
        'search_items'       => _x( 'Buscar Publicações', 'lvm_publicacoes' ),
        'not_found'          => _x( 'Nenhuma Publicações encontrado', 'lvm_publicacoes' ),
        'not_found_in_trash' => _x( 'Nenhuma Publicações encontrado', 'lvm_publicacoes' ),
        'parent_item_colon'  => _x( 'Subordinado a Publicação:', 'lvm_publicacoes' ),
        'menu_name'          => _x( 'Publicações', 'lvm_publicacoes' ),
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
        'supports'            => array( 
                                        'editor',
                                        'thumbnail', 
                                        'revisions'),
    );

    register_post_type( 'lvm_publicacoes', $args );

}


/****************************************************************************
 * ADD METABOXES
 ****************************************************************************/

// Register function to be called when admin interface is visited
add_action( 'admin_init', 'cpt_lvm_publicacoes_admin_interface_init' );

function cpt_lvm_publicacoes_admin_interface_init() {

    if ( is_admin() && isset($_GET["post_type"]) && $_GET["post_type"] == "lvm_publicacoes" ){

        wp_enqueue_style( 'lvm_cpt', plugins_url( 'css/lvm_people_styles.css', __FILE__ ) );

    }

// Function to register new Dados do trabalho meta box 
    add_meta_box( 
        'cpt_lvm_publicacoes_dados_trabalho',               //html id that will be applied to this metabox
        'Dados da publicação',                                      //appears at the top of the new metabox when displayed
        'cpt_lvm_publicacoes_dados_trabalho_html_def',      //callback >  the function which will load the html into the metabox
        'lvm_publicacoes',                                      //name of our custom post type
        'normal',                                                       //where the box will appear. can be "normal", "advanced" or "side"
        'high',                                                         //priority within the context where the boxes should show ('high', 'core', 'default' or 'low') );
        ''                                                              //(optional) Arguments to pass into your callback function. The callback will receive the  object and whatever parameters are passed through this variable
    );

// Function to register new Autores meta box 
    add_meta_box( 
        'cpt_lvm_publicacoes_autores',               //html id that will be applied to this metabox
        'Autores',                                      //appears at the top of the new metabox when displayed
        'cpt_lvm_publicacoes_autores_html_def',      //callback >  the function which will load the html into the metabox
        'lvm_publicacoes',                                      //name of our custom post type
        'normal',                                                       //where the box will appear. can be "normal", "advanced" or "side"
        'high',                                                         //priority within the context where the boxes should show ('high', 'core', 'default' or 'low') );
        ''                                                              //(optional) Arguments to pass into your callback function. The callback will receive the  object and whatever parameters are passed through this variable
    );

// Function to register new Citação meta box 
    add_meta_box( 
        'cpt_lvm_publicacoes_citacao',               //html id that will be applied to this metabox
        'Citação',                                      //appears at the top of the new metabox when displayed
        'cpt_lvm_publicacoes_citacao_html_def',      //callback >  the function which will load the html into the metabox
        'lvm_publicacoes',                                      //name of our custom post type
        'normal',                                                       //where the box will appear. can be "normal", "advanced" or "side"
        'high',                                                         //priority within the context where the boxes should show ('high', 'core', 'default' or 'low') );
        ''                                                              //(optional) Arguments to pass into your callback function. The callback will receive the  object and whatever parameters are passed through this variable
    );
}

// Function to display Citação meta box contents
function cpt_lvm_publicacoes_dados_trabalho_html_def( $post_type ) {
    
    global $post;
    $post_id = $post->ID;
    
    require ("inc/metaboxes/publicacoes/dadosPub.php");
    // require ("inc/metaboxes/publicacoes/pubFields.php");
}

// Function to display Autores meta box contents
function cpt_lvm_publicacoes_autores_html_def( $post_type ) {
    
    global $post;
    $post_id = $post->ID;

    require ("inc/metaboxes/publicacoes/autores.php");
    
}

// Function to display Citação meta box contents
function cpt_lvm_publicacoes_citacao_html_def( $post_type ) {
    
    global $post;
    $post_id = $post->ID;

    require ("inc/metaboxes/publicacoes/citacao.php");

}


function cpt_lvm_publicacoes_save_data( $post_id = false, $post = false ) {
    
    // Check post type for book reviews
    if ( $post->post_type == 'lvm_publicacoes' ) {
        
    }
}

?>