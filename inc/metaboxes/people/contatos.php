<div class="lvm_separador">

    <p> <?php
            $value = get_post_meta($post_id, '_lvm_people_emails');
            $len = count( $value );
        ?>

        <div class="label mini dropdown">
            <span contenteditable="true" class="termo">Email</span>
            <div class="lvm_options">
                <span class="contatos arrow-down"></span>
                <span>Residencial</span>
                <span>Comercial</span>
                <span>Personalizar</span>
            </div>
        </div>
        <input type="text" class="xlarge" name="lvm_people_email_1" placeholder="example@ufrj.br">
        <span class="mini">
            <input type="checkbox" name="lvm_people_email_boolean_1" value="true"> Público
        </span>
    </p>
    <a href=# class="add shift-mini">+ Adicionar outro email</a>

</div>

<div class="lvm_separador">

    <p> <?php
            $value = get_post_meta($post_id, '_lvm_people_telefones');
            $len = count( $value );
        ?>

        <span contenteditable="true" id="tipo_tel_1" class="label mini">Telefone</span>
        <input type="text" class="xlarge" name="lvm_people_tel_1" placeholder="example@ufrj.br">
        <span class="mini">
            <input type="checkbox" class="shift-mini" name="lvm_people_tel_boolean_1" value="true"> Público
        </span>
    </p>
    <a href=# class="add shift-mini">+ Adicionar outro telefone</a>

</div>

<div class="lvm_separador_last">
    
    <p> <?php
            $value = get_post_meta($post_id, '_lvm_people_enderecos');
            $len = count( $value );
        ?>

        <span contenteditable="true" id="tipo_end_1" class="label mini">Endereço</span>
        <input type="text" class="xlarge" name="lvm_people_end_1" placeholder="example@ufrj.br">
        <span class="mini">
            <input type="checkbox" class="shift-mini" name="lvm_people_end_boolean_1" value="true"> Público
        </span>
    </p>
    <a href=# class="add shift-mini">+ Adicionar outro endereço</a>

</div>