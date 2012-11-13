<?php
/*
Plugin Name: LVM People Custom Post Type
Plugin URI:  http://lvm.syn8.com
Description: Cria a seção de Pesquisadores no site do LVM
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
add_action('init', 'register_my_script');
add_action('admin_footer', 'print_my_script');
 
function register_my_script() {
    wp_register_script('autosize', plugins_url('js/autosize/jquery.autosize-min.js', __FILE__), array('jquery'), '1.0', true);
    wp_register_script('lvm_people_form', plugins_url('js/lvm_people_form.js', __FILE__), array('jquery'), '1.0', true);
}
 
function print_my_script() {
    global $post;
 
    if( $post && $post->post_type != "lvm_people" ) return;
 
    wp_print_scripts('autosize');
    wp_print_scripts('lvm_people_form');
}


// Cria o espaço de registro do plugin na tabela wp_options
register_activation_hook( __FILE__, 'cpt_lvm_people_default_options' );

function cpt_lvm_people_default_options() {

    /***
     * \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
     * UPDATE THE VERSION WHEN IMPROVEMENTS ARE MADE
     * \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
     */

    $version = 0.1;

    if ( get_option( 'cpt_lvm_people_version' ) === false ) {
        add_option( 'cpt_lvm_people_version', "0.1" );
    } else if ( get_option( 'cpt_lvm_people_version' ) < $version ) {
        update_option( 'cpt_lvm_people_version', $version );
    }
}


/****************************************************************************
 * REGISTER THE CPT
 ****************************************************************************/

add_action( 'init', 'register_cpt_lvm_people' );

function register_cpt_lvm_people() {

    $labels = array( 
        'name'               => _x( 'Pesquisadores', 'lvm_people' ),
        'singular_name'      => _x( 'Pesquisador', 'lvm_people' ),
        'add_new'            => _x( 'Adicionar Novo Pesquisador', 'lvm_people' ),
        'add_new_item'       => _x( 'Adicionar Novo Pesquisador', 'lvm_people' ),
        'edit_item'          => _x( 'Editar Pesquisador', 'lvm_people' ),
        'new_item'           => _x( 'Novo Pesquisador', 'lvm_people' ),
        'view_item'          => _x( 'Ver Pesquisador', 'lvm_people' ),
        'search_items'       => _x( 'Buscar Pesquisadores', 'lvm_people' ),
        'not_found'          => _x( 'Nenhum Pesquisadores encontrado', 'lvm_people' ),
        'not_found_in_trash' => _x( 'Nenhum Pesquisadores encontrado', 'lvm_people' ),
        'parent_item_colon'  => _x( 'Subordinado a Pesquisador:', 'lvm_people' ),
        'menu_name'          => _x( 'Pesquisadores', 'lvm_people' ),
    );

    $args = array( 
        'labels'              => $labels,
        'hierarchical'        => false,
        'description'         => 'description',
        'taxonomies'          => array(),
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
                                       'title', 
                                       'editor', 
                                       // 'author', 
                                       'thumbnail', 
                                       // 'custom-fields', 
                                       // 'trackbacks', 
                                       // 'comments', 
                                       // 'revisions', 
                                       // 'page-attributes', 
                                       // 'post-formats' 
                                       ),
    );

    register_post_type( 'lvm_people', $args );

}


/****************************************************************************
 * ADD METABOXES
 ****************************************************************************/

// Register function to be called when admin interface is visited
add_action( 'admin_init', 'cpt_lvm_people_admin_interface_init' );

// Function to register new Dados Pessoais meta box for book review post editor
function cpt_lvm_people_admin_interface_init() {

    if ( is_admin() ){

        wp_enqueue_style( 'lvm_cpt', plugins_url( 'css/lvm_people_styles.css', __FILE__ ) );
        add_action('admin_footer', "add_templates" );
        function add_templates(){
            $url = plugins_url( 'inc/metaboxes/people/contatos-tmp.html', __FILE__ );
            $tmp = file_get_contents($url);
            print $tmp;
        }

        add_meta_box( 
            'cpt_lvm_people_dados_pessoais',          //html id that will be applied to this metabox
            'Dados Pessoais',                         //appears at the top of the new metabox when displayed
            'cpt_lvm_people_dados_pessoais_html_def', //callback >  the function which will load the html into the metabox
            'lvm_people',                             //name of our custom post type
            'normal',                                 //where the box will appear. can be "normal", "advanced" or "side"
            'high',                                   //priority within the context where the boxes should show ('high', 'core', 'default' or 'low') );
            ''                                        //(optional) Arguments to pass into your callback function. The callback will receive the object and whatever parameters are passed through this variable
        );

      
        add_meta_box( 
            'cpt_lvm_people_contatos',               //html id that will be applied to this metabox
            'Contatos',                              //appears at the top of the new metabox when displayed
            'cpt_lvm_people_contatos_html_def',      //callback >  the function which will load the html into the metabox
            'lvm_people',                            //name of our custom post type
            'normal',                                //where the box will appear. can be "normal", "advanced" or "side"
            'high',                                  //priority within the context where the boxes should show ('high', 'core', 'default' or 'low') );
            ''                                       //(optional) Arguments to pass into your callback function. The callback will receive the  object and whatever parameters are passed through this variable
        );

    }
        
}

// Function to display Dados Pessoais meta box contents
function cpt_lvm_people_dados_pessoais_html_def() {

    global $post;
    $post_id = $post->ID;

    require ("inc/metaboxes/people/dados-pessoais.php");
    
}

// Function to display Contatos meta box contents
function cpt_lvm_people_contatos_html_def() {

    global $post;
    $post_id = $post->ID;

    require ("inc/metaboxes/people/contatos.php");
    
}


// Register function to be called when posts are saved
// The function will receive 2 arguments
add_action( 
        'save_post', 
        'cpt_lvm_people_save_data', 
        10, 
        2 
);

function cpt_lvm_people_save_data( $post_id = false, $post = false ) {
    
    // Check post type for book reviews
    if ( $post->post_type == 'lvm_people' ) {
        
    /**
     * /////////////////////////////////////////////////////////////////
     * DADOS PESSOAIS
     * /////////////////////////////////////////////////////////////////
     */
    
    if ( isset( $_POST['lvm_people_lattes'] ) ) {
        update_post_meta( $post_id, '_lvm_people_lattes', $_POST['lvm_people_lattes'] );
    } elseif ( get_post_meta( $post_id, '_lvm_people_lattes', true) ) {
        update_post_meta( $post_id, '_lvm_people_lattes', '' );
    }
    

    if ( isset( $_POST['lvm_people_nome'] ) ) {
        update_post_meta( $post_id, '_lvm_people_nome', $_POST['lvm_people_nome'] );
    } elseif ( get_post_meta( $post_id, '_lvm_people_nome', true) ) {
        update_post_meta( $post_id, '_lvm_people_nome', '' );
    }

    if ( isset( $_POST['lvm_people_sobrenome'] ) ) {
        update_post_meta( $post_id, '_lvm_people_sobrenome', $_POST['lvm_people_sobrenome'] );
    } elseif ( get_post_meta( $post_id, '_lvm_people_sobrenome', true) ) {
        update_post_meta( $post_id, '_lvm_people_sobrenome', '' );
    }
    
    if ( isset( $_POST['lvm_people_citacao'] ) ) {
        update_post_meta( $post_id, '_lvm_people_citacao', $_POST['lvm_people_citacao'] );
    } elseif ( get_post_meta( $post_id, '_lvm_people_citacao', true) ) {
        update_post_meta( $post_id, '_lvm_people_citacao', '' );
    }
    
    if ( isset( $_POST['lvm_people_sexo'] ) ) {
        update_post_meta( $post_id, '_lvm_people_sexo', $_POST['lvm_people_sexo'] );
    } elseif ( get_post_meta( $post_id, '_lvm_people_sexo', true) ) {
        update_post_meta( $post_id, '_lvm_people_sexo', '' );
    }
    
    if ( isset( $_POST['lvm_people_dia'] ) && isset( $_POST['lvm_people_mes'] ) && isset( $_POST['lvm_people_ano'] ) ) {
        update_post_meta( $post_id, '_lvm_people_nasc', $_POST['lvm_people_dia']."/".$_POST['lvm_people_mes']."/".$_POST['lvm_people_ano'] );
    } elseif ( get_post_meta( $post_id, '_lvm_people_nasc', true) ) {
        update_post_meta( $post_id, '_lvm_people_nasc', '' );
    }
    
    /**
     * /////////////////////////////////////////////////////////////////
     * CONTATOS
     * /////////////////////////////////////////////////////////////////
     */
    
    if ( isset( $_POST['nome do campo'] ) ) {
        update_post_meta( $post_id, '_nome do campo', $_POST['nome do campo'] );
    } elseif ( get_post_meta( $post_id, '_nome do campo', true) ) {
        update_post_meta( $post_id, '_nome do campo', '' );
    }
    
    }
}


?>