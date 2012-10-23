<div class="lvm_separador">

        <p>
            <?php $value = get_post_meta($post_id, '_lvm_people_lattes', true);  ?>
            <label id="label-lattes" class="required" for="lvm_people_lattes">Endereço web do Currículo Lattes</label>
            <input type="url" id="lattes" name="lvm_people_lattes" class="required" value="<?php echo $value; ?>" placeholder="http://" required="required">
        </p>

    </div>


    <div class="lvm_separador">

        <p>
            <?php $value = get_post_meta($post_id, '_lvm_people_nome', true);  ?>
            <label for="lvm_people_nome">Nome:</label><br>
            <input type="text" required="required" class="required all-long" id="nome" name="lvm_people_nome" value="<?php echo $value; ?>" placeholder="Preencha com a primeira parte do nome.">
            <br>
            <small>Ex.: Se o nome completo for 'João Carlos da Silva Souza', preencha o campo com 'João Carlos'.</small>
        </p>

        <p>
            <?php $value = get_post_meta($post_id, '_lvm_people_sobrenome', true);  ?>
            <label for="lvm_people_sobrenome">Sobrenome:</label><br>
            <input type="text" required="required" class="required all-long" id="nome" name="lvm_people_sobrenome" value="<?php echo $value; ?>"  placeholder="Preencha com a segunda parte do nome.">
            <br>
            <small>Ex.: Se o nome completo for 'João Carlos da Silva Souza', preencha o campo com da 'Siva Souza'.</small>
        </p>

        <p>
            <?php $value = get_post_meta($post_id, '_lvm_people_citacao', true);  ?>
            <label for="lvm_people_citacao">Citação:</label><br>
            <input type="text" id="nome" class="all-long" name="lvm_people_citacao" value="<?php echo $value; ?>" placeholder="Preencha como deve constar nas bibliografias e citações." >
            <br>
            <small>Ex.: Se o nome completo for 'João Carlos da Silva Souza', uma forma poderia ser 'Souza, J. C. S.'.</small>
        </p>

    </div>

    <div class="lvm_separador_last">

        <p>
            <?php $value = get_post_meta($post_id, '_lvm_people_sexo', true);  ?>
            <label for="lvm_people_sexo">Sexo</label>
            <input type="radio" name="lvm_people_sexo" <?php checked( $value, "masculino")?>value="masculino" required="required">Masculino
            <input type="radio" name="lvm_people_sexo" <?php checked( $value, "feminino")?>value="feminino" required="required">Feminino
        </p>

        <p>
            <?php 
                $value = get_post_meta($post_id, '_lvm_people_nasc', true);
                $value = explode("/", $value);
                $dia = isset ( $value[0] ) ? $value[0] : ""; 
                $mes = isset ( $value[1] ) ? $value[1] : ""; 
                $ano = isset ( $value[2] ) ? $value[2] : ""; 
            ?>

            <label for="lvm_people_nasc">Data de Nascimento</label>
            <select name="lvm_people_dia" id="nasc_dia">
            <?php 
                $i=1; $ii=31;
                while ( $i<=$ii ){
                    $i = str_pad( $i, 2, 0, STR_PAD_LEFT);
                    echo "<option ". selected($dia, $i) . "value='$i'>$i</option>";
                    $i++;
                }
            ?>
            </select>
            /
            <select name="lvm_people_mes" id="nasc_mes">
            <?php
                $meses = ['janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro' ];
                $i=0; $ii=11;
                while( $i<=$ii ){
                    echo "<option " . selected($mes, $i) . "value='". str_pad( $i+1, 2, 0, STR_PAD_LEFT) . "'>$meses[$i]</option>";
                    $i++;
                }
            ?>
            </select>   
            /
            <select name="lvm_people_ano" id="nasc_ano">
            <?php
                $ii = date('Y'); $i = $ii - 100;
                while( $i<= $ii ) {
                    echo "<option " . selected($ano, $i) . "value='". str_pad( $i, 2, 0, STR_PAD_LEFT) . "'>$i</option>";
                    $i++;
                }
            ?>
            </select>
        </p>

    </div>