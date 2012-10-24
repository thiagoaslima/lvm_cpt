<div class="lvm_separador">

    <p>
        <?php
            $value = get_post_meta($post_id, '_lvm_people_emails');
            $len = count( $value );
        ?>

        <span contenteditable="true" class="tipo_email_1 lvm_contatos label">Email</span>
        <input type="text" class="lvm_contatos mezzo" name="lvm_people_email_1" placeholder="example@ufrj.br">
        <input type="checkbox" name="lvm_people_email_boolean_1" value="true"> <span class="msg">Visível para todos.</span>
    </p>

    <p>
        <?php
            $value = get_post_meta($post_id, '_lvm_people_telefones');
            $len = count( $value );
        ?>

        <span contenteditable="true" class="tipo_tel_1 lvm_contatos label">Telefone</span>
        <input type="text" class="lvm_contatos mezzo" name="lvm_people_tel_1" placeholder="example@ufrj.br">
        <input type="checkbox" name="lvm_people_tel_boolean_1" value="true"> Visível para todos.
    </p>

    <p>
        <?php
            $value = get_post_meta($post_id, '_lvm_people_enderecos');
            $len = count( $value );
        ?>

        <span contenteditable="true" class="tipo_tel_1 lvm_contatos label">Endereço</span>
        <input type="text" class="lvm_contatos mezzo" name="lvm_people_end_1" placeholder="example@ufrj.br">
        <input type="checkbox" name="lvm_people_end_boolean_1" value="true"> Visível para todos.
    </p>

</div>