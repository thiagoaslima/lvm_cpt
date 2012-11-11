<?php

    $formas_contato = ["email", "tel", "end"];

    foreach ($formas_contato as $contato) {
        
        // recupera o numero de contatos do tipo em questão já gravado na base de dados
        $qtde_gravada = ( get_post_meta( $post_id, '_lvm_people_'. $contato . '_n', true ) != "" ) 
                            ? (int)( get_post_meta( $post_id, '_lvm_people_'. $contato . '_n', true )
                            : 0;

        // registra a nova quantidade
        $qtde_nova = isset( $_POST['lvm_people_' . $contato . '_n'] ) 
                            ? $_POST['lvm_people_' . $contato . '_n']
                            : 0

        // atualiza a quantidade de contatos gravados
        update_post_meta( $post_id, '_lvm_people_' . $contato . '_n', $qtde_nova );


        // atualiza os dados passados
        for( $i = 0; $i < $qtde_nova; $i++ ){

            $tipo_field = 'tipo_'. $contato . '_' . $i;
            $contato_field = 'lvm_people_' . $contato . '_' . $i;

            if ( isset($_POST[$tipo_field]) && isset($_POST[$contato_field]) &&
                 $_POST[$tipo_field] != "" && $_POST[$contato_field] != "" ) {
                
                update_post_meta( $post_id, $tipo_field, $_POST[$tipo_field] );
                update_post_meta( $post_id, $contato_field, $_POST[$contato_field] );

            } else {
                
                delete_post_meta($post_id, $tipo_field );
                delete_post_meta($post_id, $contato_field );
            }
        
        }

        if( $qtde_nova < $qtde_gravada ){

            for( $qtde_nova; $qtde_nova < $qtde_gravada; $qtde_nova++ ){

                $tipo_field = 'tipo_'. $contato . '_' . $i;
                $contato_field = 'lvm_people_' . $contato . '_' . $i;

                delete_post_meta($post_id, $tipo_field );
                delete_post_meta($post_id, $contato_field );
            }

        }

    }
    
    
?>