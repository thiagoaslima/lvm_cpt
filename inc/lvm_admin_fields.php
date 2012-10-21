<?php

function addField ( array $args ) {

	global $post;

	if( !isset( $args["fieldType"] ) || !isset( $args["dataName"] ) ) die;

	// Retrieve data from cpt
	$retData = esc_html( get_post_meta( $post->ID, $args['dataName'], true ) );
	
	switch( $args["fieldType"] ){

		case 'boolean':
			require( 'fields/lvm_boolean_field.php' );
			break;

		case 'text':
			require( 'fields/lvm_text_field.php' );
			break;

		case 'url':
			require( 'fields/lvm_url_field.php' );
			break;

		case 'date':
			require( 'fields/lvm_date_field.php' );
			break;
	}
}

?>