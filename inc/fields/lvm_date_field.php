<?php
/**
 * @param string 	dataName         	Name of the metadata
 * @param string 	fieldType        	date (type of input field)
 * @param string 	fieldClass       	css class of the input field
 * @param string 	fieldName        	name of the input field
 * @param string 	fieldLabel       	text of label
 * @param string 	fieldPlaceholder 	text of placeholder
 * @param string 	otherAtts        	html code of other attributes
**/

	$expectedArgs = [ 'fieldClass', 'fieldName', 'fieldLabel', 'fieldPlaceholder', 'otherAtts' ];
	$output = "";

	foreach ( $expectedArgs as $key ) {

		$tmp = strtolower( str_replace( "field", "", $key ) );

		if( $key != 'otherAtts' && $key != 'fieldLabel'  ) {
			$$tmp =  ( isset( $args[$key] ) ) ? $tmp . '="' . $args[$key] . '"' : '';
		} else {
			$$tmp = ( isset( $args[$key] ) ) ? $args[$key] : '';
		}

	}

	if( $label ) { 
		$output .=  "<label for=\"". $args['dataName'] . "\">$label</label>\n";
	}

	$output .= "<input type='date' $name $class $value $placeholder $otheratts />\n";

	echo $output;

?>