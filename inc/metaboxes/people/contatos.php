<div class="lvm_separador email">

    <input type="hidden" id="lvm_people_email_n" name="lvm_people_email_n" value="1">

    <?php
        $value = get_post_meta($post_id, '_lvm_people_emails');
        $len = count( $value );
    ?>

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