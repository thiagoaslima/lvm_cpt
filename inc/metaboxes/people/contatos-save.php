<?php

    $formas_contato = ["email", "tel", "end"];

    foreach ($formas_contato as $contato) {
        
        // recupera o numero de contatos do tipo em questão já gravado na base de dados
        $qtde_gravada = ( get_post_meta( $post_id, '_lvm_people_'. $contato . '_n', true ) != "" ) 
                            ? (int)(get_post_meta($post_id, '_lvm_people_'. $contato . '_n', true)) : 0;

        // marcador para o loop
        $i = 0;
        $verificador = 'lvm_people_' . $contato . '_';

        // testa a existência de dados passados e grava-os no servidor sequencialmente
        while( isset($_POST[$verificador . $i]) ){

            $tipo_field    = 'lvm_people_tipo_'. $contato . '_' . $i;
            $contato_field = $verificador . $i;
            $boolean_field = 'lvm_people_boolean_' . $contato . '_' . $i;
            $bool          = (isset($_POST[$boolean_field])) ? true : false;

            update_post_meta( $post_id, $tipo_field, $_POST[$tipo_field] );
            update_post_meta( $post_id, $contato_field, $_POST[$contato_field] );
            update_post_meta( $post_id, $boolean_field, $bool );

            $i++;
        }

        // grava na base de dados a quantidade atualizada de campos 
        update_post_meta( $post_id, '_lvm_people_'. $contato . '_n', $i );

        // caso tenhamos menos dados do que antes,
        // ou seja, o usuário deletou algum contato previamente gravado,
        // fazemos o loop para deletar as entradas adicionais
        for( $i; $i < $qtde_gravada; $i++ ){

            $tipo_field    = 'lvm_people_tipo_'. $contato . '_' . $i;
            $contato_field = 'lvm_people_' . $contato . '_' . $i;
            $boolean_field = 'lvm_people_boolean_' . $contato . '_' . $i;

            delete_post_meta($post_id, $tipo_field );
            delete_post_meta($post_id, $contato_field );
            delete_post_meta($post_id, $boolean_field );
        }
    }
    
?>