<?php

    // Controls the javascript load
    // http://scribu.net/wordpress/optimal-script-loading.html
    add_action('init', 'register_my_script');
    function register_my_script() {

        if ( is_admin() ){
            wp_register_script('autosize', plugins_url('js/autosize/jquery.autosize-min.js', __FILE__), array('jquery'), '1.0', true);
        }

        if ( is_admin() && $_GET["post_type"] == "lvm_people" ){
            wp_register_script('lvm_people_form', plugins_url('js/lvm_people_form.js', __FILE__), array('jquery'), '1.0', true);
        }
    }


    add_action('admin_footer', 'print_my_script');
    function print_my_script() {

        if ( is_admin() ){
            wp_print_scripts('autosize');
        }

        if ( is_admin() && $_GET["post_type"] == "lvm_people" ){
            wp_print_scripts('lvm_people_form');
        }

    }


if ( is_admin() && $_GET["post_type"] == "lvm_people" ){

    add_action('admin_footer', "add_templates" );
    wp_enqueue_style( 'lvm_cpt', plugins_url( 'css/lvm_people_styles.css', __FILE__ ) );

    function add_templates(){
        $url = plugins_url( 'inc/metaboxes/people/contatos-tmp.html', __FILE__ );
        $tmp = file_get_contents($url);
        print $tmp;
    }

}
?>