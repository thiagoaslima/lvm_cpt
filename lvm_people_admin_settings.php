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

    $post_type = $_GET["post_type"];

    $check = "post-new.php";
    $cur_page = $_SERVER['REQUEST_URI'];
    $pos = strpos($cur_page, $check);

    if ( is_admin() and $pos !== false and $post_type == "lvm_people" ){

        wp_enqueue_style( 'lvm_cpt', plugins_url( 'css/lvm_cpt_styles.css', __FILE__ ) );

        add_meta_box( 
            'cpt_lvm_people_dados_pessoais',         //html id that will be applied to this metabox
            'Dados Pessoais',                                //appears at the top of the new metabox when displayed
            'cpt_lvm_people_dados_pessoais_html_def', //callback >  the function which will load the html into the metabox
            'lvm_people',                                //name of our custom post type
            'normal',                                                 //where the box will appear. can be "normal", "advanced" or "side"
            'high',                                                   //priority within the context where the boxes should show ('high', 'core', 'default' or 'low') );
            ''                                                        //(optional) Arguments to pass into your callback function. The callback will receive the  object and whatever parameters are passed through this variable
        );
    }
}

// Function to display Dados Pessoais meta box contents
function cpt_lvm_people_dados_pessoais_html_def( $post_type ) {

    require_once( "inc/lvm_admin_fields.php" );

    /**
     * \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
     * HERE IS THE SPACE TO INCLUDE THE HTML OF METABOXES
     * //////////////////////////////////////////////////
     */
    
    // Use the fields snippets to add the metaboxes
    // Sublime text 2 lvm snippets

    ?>

    <div class="lvm_separador">

        <p>
            <label id="label-lattes" class="required" for="lvm_people_lattes">Endereço web do Currículo Lattes</label>
            <input type="url" id="lattes" name="lvm_people_lattes" class="required" value="" placeholder="http://" required="required">
        </p>

    </div>


    <div class="lvm_separador">

        <p>
            <label for="lvm_people_nome">Nome:</label><br>
            <input type="text" required="required" class="required all-long" id="nome" name="lvm_people_nome" value="" >
            <br>
            Preencha com a primeira parte do nome.<br>
            <small>Ex.: Se o nome completo for 'João Carlos da Silva Souza', preencha o campo com 'João Carlos'</small>
        </p>

        <p>
            <label for="lvm_people_sobrenome">Sobrenome:</label><br>
            <input type="text" required="required" class="required all-long" id="nome" name="lvm_people_sobrenome" value="" >
            <br>
            Preencha com a segunda parte do nome.<br>
            <small>Ex.: Se o nome completo for 'João Carlos da Silva Souza', preencha o campo com da 'Siva Souza'</small>
        </p>

        <p>
            <label for="lvm_people_sobrenome">Sobrenome:</label><br>
            <input type="text" id="nome" class="all-long" name="lvm_people_sobrenome" value="" >
            <br>
            Preencha como deve constar nas bibliografias e citações.<br>
            <small>Ex.: Se o nome completo for 'João Carlos da Silva Souza', uma forma poderia ser 'Souza, J. C. S.'</small>
        </p>

    </div>

    <div class="lvm_separador_last">

        <p>
            <label for="lvm_people-sexo">Sexo</label>
            <input type="radio" name="lvm_people_sexo" value="masculino" required="required">Masculino
            <input type="radio" name="lvm_people_sexo" value="feminino" required="required">Feminino
        </p>

        <p>
            <label for="lvm_people_nasc">Data de Nascimento</label>
            <select name="lvm_people_nasc_dia" id="nasc_dia">
            <?php 
                $i=1; $ii=31;
                while ( $i<=$ii ){
                    $i = str_pad( $i, 2, 0, STR_PAD_LEFT);
                    echo "<option value='$i'>$i</option>";
                    $i++;
                }
            ?>
            </select>
            /
            <select name="lvm_people_nasc_mes" id="nasc_mes">
            <?php
                $meses = ['janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro' ];
                $i=0; $ii=11;
                while( $i<=$ii ){
                    echo "<option value='". str_pad( $i+1, 2, 0, STR_PAD_LEFT) . "'>$meses[$i]</option>";
                    $i++;
                }
            ?>
            </select>   
            /
            <select name="lvm_people_ano" id="nasc_ano">
            <?php
                $ii = date('Y'); $i = $ii - 100;
                while( $i<= $ii ) {
                    if( $i!=$ii-20 ){
                        echo "<option value='". str_pad( $i, 2, 0, STR_PAD_LEFT) . "'>$i</option>";
                    } else {
                        echo "<option value='". str_pad( $i, 2, 0, STR_PAD_LEFT) . "' selected='selected'>$i</option>";
                    }
                    $i++;
                }
            ?>
            </select>
        </p>

    </div>

    <?php
    
    
    /**
     * ///////////////////////////////////////////
     * END OF THE SPACE TO INCLUDE THE METABOXES
     * ///////////////////////////////////////////
     */
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
     * PASTE HERE THE SAVE_DATA_CODE GENERATED WITH THE METABOX INSTANCE
     * /////////////////////////////////////////////////////////////////
     */

        // Store data in post meta table if present in post data
        if ( isset( $_POST['lvm_people_lattes'] ) && $_POST['lvm_people_lattes'] != '' ) {
            update_post_meta( $post_id, 'lvm_people_lattes', $_POST['lvm_people_lattes'] );
        } elseif ( get_post_meta( $post_id, 'lvm_people_lattes', true) ) {
            update_post_meta( $post_id, 'lvm_people_lattes', '' );
        }

        // Store data in post meta table if present in post data
        if ( isset( $_POST['is_member'] ) && $_POST['is_member'] != '' ) {

            update_post_meta( $post_id, 'is_member', $_POST['is_member'] );
        
        } elseif ( isset( $_POST['is_member']) ) {
        
            $old_value = get_post_meta( $post_id, 'is_member', true );
            delete_post_meta( $post_id, 'is_member', $old_value);
        
        }

  
        // Store data in post meta table if present in post data
        if ( isset( $_POST['nome'] ) && $_POST['nome'] != '' ) {
    
            update_post_meta( $post_id, 'nome_people', $_POST['nome'] );
        
        } elseif ( isset( $_POST['nome']) ) {
        
            $old_value = get_post_meta( $post_id, 'nome_people', true );
            delete_post_meta( $post_id, 'nome_people', $old_value);
        
        }


    /**
     * /////////////////////////////////////////////////////////////////
     * END OF PASTE AREA
     * /////////////////////////////////////////////////////////////////
     */
        
    }
}


?>