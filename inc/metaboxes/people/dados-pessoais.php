    <div class="lvm_separador">

        <p>
            <?php $value = get_post_meta($post_id, '_lvm_people_lattes', true);  ?>
            <label id="label-lattes" class="required label mini" for="lvm_people_lattes">Currículo Lattes</label>
            <input type="url" id="lvm_people_lattes" name="lvm_people_lattes" class="required xxlarge" value="<?php echo $value; ?>" placeholder="http://" required="required">
        </p>

    </div>


    <div class="lvm_separador">

        <p>
            <?php $value = get_post_meta($post_id, '_lvm_people_nome', true);  ?>
            <label for="lvm_people_nome" class="required label mini">Nome</label>
            <input type="text" required="required" class="required xxlarge" id="lvm_people_nome" name="lvm_people_nome" value="<?php echo $value; ?>" placeholder="Preencha com a primeira parte do nome.">
            <br>
            <small class="shift-mini">Ex.: para 'João Carlos da Silva Souza', escreva 'João Carlos'.</small>
        </p>

        <p>
            <?php $value = get_post_meta($post_id, '_lvm_people_sobrenome', true);  ?>
            <label for="lvm_people_sobrenome" class="required label mini">Sobrenome</label>
            <input type="text" required="required" class="required xxlarge" id="lvm_people_sobrenome" name="lvm_people_sobrenome" value="<?php echo $value; ?>"  placeholder="Preencha com a segunda parte do nome.">
            <br>
            <small class="shift-mini">Ex.: para 'João Carlos da Silva Souza', escreva 'Silva Souza'.</small>
        </p>

        <p>
            <?php $value = get_post_meta($post_id, '_lvm_people_citacao', true);  ?>
            <label for="lvm_people_citacao" class="required label mini">Citação</label>
            <input type="text" id="lvm_people_citacao" class="required xxlarge" name="lvm_people_citacao" value="<?php echo $value; ?>" placeholder="Preencha como deve constar nas bibliografias e citações.">
            <br>
            <small class="shift-mini">Ex.: para 'João Carlos da Silva Souza', escreva algo como 'Souza, J. C. S.'.</small>
        </p>

    </div>

    <div class="lvm_separador sep_last">

        <p>
            <?php $value = get_post_meta($post_id, '_lvm_people_sexo', true);  ?>
            <label for="lvm_people_sexo" class="required label mini">Sexo</label>
            <input type="radio" class="required" name="lvm_people_sexo" <?php checked( $value, "masculino")?>value="masculino" required="required">
            <span class="radio mini">Masculino</span>
            <input type="radio" class="required" name="lvm_people_sexo" <?php checked( $value, "feminino")?>value="feminino" required="required">
            <span class="radio mini">Feminino</span>
        </p>

        <p>
            <?php 
                $value = get_post_meta($post_id, '_lvm_people_nasc', true);
                $value = explode("/", $value);
                $dia = isset ( $value[0] ) ? (int)$value[0] : ""; 
                $mes = isset ( $value[1] ) ? (int)$value[1] : ""; 
                $ano = isset ( $value[2] ) ? (int)$value[2] : ""; 
            ?>

            <label for="lvm_people_nasc" class="label mini">Nascimento</label>
            <select name="lvm_people_dia" id="lvm_people_nasc_dia">
            <?php 
                $i=1; $ii=31;
                while ( $i<=$ii ){
                    $i = str_pad( $i, 2, 0, STR_PAD_LEFT);
                    echo "<option ". selected($dia, $i, false) . "value='$i'>$i</option>";
                    $i++;
                }
            ?>
            </select>
            /
            <select name="lvm_people_mes" id="lvm_people_nasc_mes">
            <?php
                $meses = ['janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro' ];
                $i=0; $ii=11;
                while( $i<=$ii ){
                    // temos que comparar $mes-1 com pq estamos gravando a data com janeiro = 1
                    // mas no array janeiro é posição 0
                    // ou seja, se $mes = 1, enato temos janeiro, que está em $i=0
                    echo "<option " . selected($mes-1, $i, false) . "value='". str_pad( $i+1, 2, 0, STR_PAD_LEFT) . "'>$meses[$i]</option>";
                    $i++;
                }
            ?>
            </select>   
            /
            <select name="lvm_people_ano" id="lvm_people_nasc_ano">
            <?php
                $ii = date('Y'); $i = $ii - 100;
                while( $i<= $ii ) {
                    echo "<option " . selected($ano, $i, false) . "value='". str_pad( $i, 2, 0, STR_PAD_LEFT) . "'>$i</option>";
                    $i++;
                }
            ?>
            </select>
        </p>

    </div>