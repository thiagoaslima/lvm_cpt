<?php

    $formas_contato   = ["email", "tel", "end"];
    $contato_extenso  = ["Email", "Telefone", "Endereço"];
    $placeholder_array = ["example@ufrj.br", "+55 21 9876 5432", "Av. Pedro Calmon, n° 550, Prédio da Reitoria, 2° andar, Cidade Universitária, Rio de Janeiro, RJ"];

    $options = [];
    $options["email"] = ["Residencial", "Comercial", "Personalizar"];
    $options["tel"]   = ["Celular", "Comercial", "Residencial", "Principal", "Fax", "Skype", "Personalizar"];
    $options["end"]   = ["Residencial", "Comercial", "Personalizar"];


    foreach ($formas_contato as $contato) {

        // grava a forma por extendo do contato atual
        $cont_extenso   = array_shift($contato_extenso);
        $placeholder = array_shift($placeholder_array);

        // recupera o numero de contatos do tipo em questão já gravado na base de dados
        $marcador_qtde  = '_lvm_people_'. $contato . '_n';
        $qtde_gravada   = ( get_post_meta( $post_id, $marcador_qtde, true ) != "" )
                                ? (int)( get_post_meta( $post_id, $marcador_qtde, true ) )
                                : 0;
        $i = 0;


        // constrói os campos de formulário
        do{
            // nome dos campos do formulário e dos campos de metadados
            $fields            = [];
            $fields["tipo"]    = "lvm_people_tipo_" . $contato . "_" . $i;
            $fields["contato"] = "lvm_people_" . $contato . "_" . $i;
            $fields["visivel"] = "lvm_people_boolean_" . $contato . "_" . $i;

            // valor dos metadados
            $metadata            = [];
            $metadata["tipo"]    = ( get_post_meta( $post_id, $fields["tipo"], true) != "" )
                                        ? get_post_meta( $post_id, $fields["tipo"], true)
                                        : $cont_extenso;
            $metadata["contato"] = get_post_meta( $post_id, $fields["contato"], true);
            $metadata["visivel"] = get_post_meta( $post_id, $fields["visivel"], true);

            //html do formulário
            ?>

            <div class="lvm_separador <?php echo $contato; if(count($contato_extenso) == 0){ echo " sep_last"; } ?>">

                <input type="hidden" id="<?php echo $marcador_qtde; ?>" name="<?php echo $marcador_qtde; ?>" value="<?php echo $qtde_gravada; ?>">

                <div class="<?php echo $contato . '_' . $i; ?>  line">
                    <div class="label mini dropdown">
                    <span contenteditable="true" class="termo" id="<?php echo $fields["tipo"]; ?>"><?php echo $metadata["tipo"]; ?></span>
                    <div class="lvm_options">
                        <span class="contatos arrow-down"></span>
                        <?php
                            for( $j=0, $len = count($options[$contato]); $j < $len; $j++ ){
                                printf('<span>%s</span>', $options[$contato][$j]);
                            }
                        ?>
                    </div>
                </div>
            
                <input type="hidden" name="<?php echo $fields["tipo"]; ?>" value="<?php echo $metadata["tipo"]; ?>">

                <?php 
                if( $contato != "end" ) {
                ?>
                    <input type="text" class="large" name="<?php echo $fields["contato"]; ?>" <?php if($metadata["contato"] != "") { echo 'value="' . $metadata["contato"] . '"'; } ?> placeholder="<?php echo $placeholder; ?>">
                <?php
                }else{
                ?>
                    <textarea class="textarea large" name="<?php echo $fields["contato"]; ?>" placeholder="<?php echo $placeholder; ?>"><?php //if($metadata["contato"] != "") { echo 'value="' . $metadata["contato"] . '"'; } ?></textarea>
                <?php
                }
                ?>

                <span class="mini">
                    <input type="checkbox" name="<?php echo $fields["visivel"]; ?>" if($metadata["visivel"]){ echo "checked"; } value="<?php echo $metadata["visivel"]; ?>"> Público
                </span>
                <span class="mini">
                    <span class="lixeira">Apagar</span>
                </span>
            </div>
            <a href=# class="add shift-mini">+ Adicionar outro <?php echo strtolower($cont_extenso); ?></a>

        </div>

            <?php

            $i++;
        } while ($i < $qtde_gravada);
    }

/*
<div class="lvm_separador email">

    <input type="hidden" id="lvm_people_email_n" name="lvm_people_email_n" value="1">

    <div class="email_1 line">
        <div class="label mini dropdown">
            <span contenteditable="true" class="termo" id="tipo_email_1">Email</span>
            <div class="lvm_options">
                <span class="contatos arrow-down"></span>
                <span>Residencial</span>
                <span>Comercial</span>
                <span>Personalizar</span>
            </div>
        </div>
        <input type="hidden" name="tipo_email_1" value="Email">
        <input type="text" class="large" name="lvm_people_email_1" placeholder="example@ufrj.br">
        <span class="mini">
            <input type="checkbox" name="lvm_people_email_boolean_1" value="true"> Público
        </span>
        <span class="mini">
            <span class="lixeira">Apagar</span>
        </span>
    </div>

    <a href=# class="add shift-mini">+ Adicionar outro email</a>

</div>

<div class="lvm_separador tel">

    <input type="hidden" id="lvm_people_tel_n" name="lvm_people_tel_n" value="1">

    <?php
        $value = get_post_meta( $post_id, '_lvm_people_telefones' );
        $len = count( $value );
    ?>

    <div class="tel_1 line">
        <div class="label mini dropdown">
            <span contenteditable="true" class="termo" id="tipo_tel_1">Telefone</span>
            <div class="lvm_options">
                <span class="contatos arrow-down"></span>
                <span>Celular</span>
                <span>Comercial</span>
                <span>Residencial</span>
                <span>Pricipal</span>
                <span>Fax</span>
                <span>Skype</span>
                <span>Personalizar</span>
            </div>
        </div>
        <input type="hidden" name="tipo_tel_1" value="Telefone">
        <input type="text" class="large" name="lvm_people_tel_1" placeholder="example@ufrj.br">
        <span class="mini">
            <input type="checkbox" class="shift-mini" name="lvm_people_tel_boolean_1" value="true"> Público
        </span>
        <span class="mini">
            <span class="lixeira">Apagar</span>
        </span>
    </div>

    <a href=# class="add shift-mini">+ Adicionar outro telefone</a>

</div>

<div class="lvm_separador sep_last end">

    <input type="hidden" id="lvm_people_end_n" name="lvm_people_end_n" value="1">
    
    <?php
        $value = get_post_meta($post_id, '_lvm_people_enderecos');
        $len = count( $value );
    ?>

    <div class="end_1 line">
        <div class="label mini dropdown">
            <span contenteditable="true" class="termo" id="tipo_end_1">Endereço</span>
            <div class="lvm_options">
                <span class="contatos arrow-down"></span>
                <span>Residencial</span>
                <span>Comercial</span>
                <span>Personalizar</span>
            </div>
        </div>
        <input type="hidden" name="tipo_end_1" value="Endereço">
        <input type="text" class="large" name="lvm_people_end_1" placeholder="example@ufrj.br">
        <span class="mini">
            <input type="checkbox" class="shift-mini" name="lvm_people_end_boolean_1" value="true"> Público
        </span>
        <span class="mini">
            <span class="lixeira">Apagar</span>
        </span>
    </div>

    <a href=# class="add shift-mini">+ Adicionar outro endereço</a>

</div>
*/
?>