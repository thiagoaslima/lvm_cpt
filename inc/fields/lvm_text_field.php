<?php
/**
 * @param string 	dataName         	Name of the metadata
 * @param string 	fieldClass       	css class of the input field
 * @param string    fieldId             id of the element
 * @param string 	fieldType        	radio (type of input field)
 * @param string 	fieldName        	name of the input field
 * @param string 	fieldLabel       	text of label
 * @param boolean   fieldRequired       is the field required?
 * @param string 	fieldPlaceholder 	text of placeholder
 * 
 * @param string 	otherAtts        	html code of other attributes
**/

	// organize data
	$output = "<p>";
	$expectedArgs = [ 'dataName', 'fieldType', 'fieldClass', 'fieldId', 'fieldName', 'fieldLabel', 'fieldRequired', 'fieldPlaceholder', 'otherAtts', 'breakAfterLabel' ];


	foreach ( $expectedArgs as $key ) {
		$tmp = strtolower( str_replace( "field", "", $key ) );
		$$tmp = ( isset( $args[$key] ) ) ? $args[$key] : '';
	}


	if( $required ) { 
		$required = "required='required'";
		$label_required = "required";
	} else { 
		$required = ''; 
	}


	//start the field
	if( $label ) { 
		$output .=  "<label class=\"label-$name $label_required\" for=\"$dataname\">$label</label>\n";
	}

	if( $breakafterlabel == "true" ) $output .= '<br />';

	$output .= "<input type='text' id='$id' name='$name' class='$class $name' value='$retData' placeholder='$placeholder' $required $otheratts />\n";

	$output .= '</p>';

	echo $output;

?>