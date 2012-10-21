<?php
/**
 * @param string 	dataName         	Name of the metadata
 * @param string 	fieldClass       	css class of the input field
 * 
 * @param string 	fieldType        	radio (type of input field)
 * @param string 	fieldName        	name of the input field
 * @param string 	fieldLabel       	text of label
 * @param boolean   fieldRequired       is the field required?
 * 
 * @param string 	otherAtts        	html code of other attributes
**/

	// organize data
	$output = "<p>";
	$expectedArgs = [ 'dataName', 'fieldType', 'fieldClass', 'fieldName', 'fieldLabel', 'fieldRequired', 'otherAtts', 'breakAfterLabel' ];

	foreach ( $expectedArgs as $key ) {
		$tmp = strtolower( str_replace( "field", "", $key ) );
		$$tmp = ( isset( $args[$key] ) ) ? $args[$key] : '';
	}

	if ( $retData == 'sim') { 
		$sim = "checked='checked'"; 
		$nao = ""; 
	} elseif ( $retData == 'nao' ) { 
		$sim = ""; 
		$nao = "checked='checked'"; 
	} else {
		$sim = ''; $nao = '';
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

	$output .= "<input type='radio' name='$name' value='sim' class='$class sim $name' $sim $required $otheratts /> Sim\n";
	$output .= "<input type='radio' name='$name' value='nao' class='$class nao $name' $nao $required $otheratts /> Não\n";

	$output .= '</p>';

	echo $output;

?>