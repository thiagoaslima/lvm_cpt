<?php
$campos = [
        'categoria' =>  'lvm_pub_category',

        'titulo'    =>  'post_title',
        'data'      =>  'lvm_pub_date',
        'ano'       =>  'lvm_pub_year',
        'mes'       =>  'lvm_pub_month',
        'dia'       =>  'lvm_pub_day',
        'previsao'  =>  'lvm_pub_isprev',
        'idioma'    =>  'lvm_pub_lang',
        'meio'      =>  'lvm_pub_media',
        'host'       =>  'lvm_pub_host',

        'tituloPer' =>  'lvm_pub_per_title',
        'codigo'    =>  'lvm_pub_per_code',
        'volume'    =>  'lvm_pub_per_volume',
        'serie'     =>  'lvm_pub_per_serie',
        'pgInicial' =>  'lvm_pub_per_pgini',
        'pgFinal'   =>  'lvm_pub_per_pgend'
    ];

foreach ($metadatas as $k => $v) { $$k = $v; }
foreach ($campos as $k => $v) {
    $$k = (isset($$v)) ? $$v : "";
}

function leadingZeros($num,$numDigits) {
   return sprintf("%0".$numDigits."d",$num);
}

function label ($campo, $lab, $labCl) {
    $classe = isset($labCl) ? 'class='.$labCl : '';
    echo '<label ' . $classe . ' for="'. $campo . '">' . $lab .'</label>';
}

// DADOS GERAIS

function titulo ($lab = "Título da Publicação", $labCl = false, $cl = false) {
    global $titulo;

    echo '<p>';

    if( isset($lab) ) label('titulo', $lab, $labCl);
    $classe = ($cl && $trim($cl) != "") ? 'class='.$cl : '';
    
    echo '<input '. $classe .' type="text" name="post_title" value="'. $titulo.'"></p>';
}

function dataPub ($dadosData, $lab = 'Data da publicação', $labCl = false, $cl = false) {
    global $ano, $mes, $dia;

    echo '<p>';

    if( isset($lab) ) label('data', $lab, $labCl);
    $classe = ($cl && $trim($cl) != "") ? 'class='.$cl : '';

    switch($dadosData){
        case 3:
            ?>
            <select name="lvm_pub_day" class="day">
                <option value=""></option>
                <?php
                for ($i=1; $i < 32; $i++) {
                    $sel = selected($dia, $i, false); 
                    echo "<option {$sel} value=\"{$i}\">".leadingZeros($i,2)."</option>";
                }
            echo '</select><span> / </span>';
            // no break;

        case 2:
            ?>
            <select name="lvm_pub_month" class="month">
                <option value=""></option>
                <?php
                $meses = ['janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'];
                for ($i=0; $i < 12; $i++) { 
                    $a = $i+1; $sel = selected($dia, $a, false);
                    echo "<option {$sel} value=\"{$a}\">{$meses[$i]}</option>";
                }
            echo '</select><span> / </span>';
            // no break;

        default:
            ?>
            <span class="preAno">20</span>
            <input type="number" class="ano" min="0" max="99" maxlength="2" name="lvm_pub_year" value="<?php echo $ano; ?>">
            <?php
    }

    echo '</p>';
}

function previsao ($lab = false, $labCl = false, $cl = false) {
    global $previsao;

    echo '<p>';

    if( isset($lab) ) label('previsao', $lab, $labCl);
    $classe = ($cl && $trim($cl) != "") ? 'class='.$cl : ''; 
    ?>

    <input <?php echo $classe; ?> type="checkbox" name="lvm_pub_isPrev" value="<?php echo $previsao; ?>"> Data é de previsão para publicação?
    <?php
    echo '</p>';
}

function idioma ($lab = "Idioma da publicação", $labCl = false, $cl = false) {
    global $idioma;

    echo '<p>';

    if( isset($lab) ) label('idioma', $lab, $labCl);
    $classe = ($cl && $trim($cl) != "") ? 'class='.$cl : ''; 
    ?>
        <!-- idioma da publicação -->
    <select <?php echo $classe; ?> name="lvm_pub_lang" class="lvm_pub_lang">
        <option value=""></option>
        <option <?php selected($idioma, "pt"); ?> value="pt">Português</option>
        <option <?php selected($idioma, "en"); ?> value="en">Inglês</option>
        <option <?php selected($idioma, "es"); ?> value="es">Espanhol</option>
        <option <?php selected($idioma, "fr"); ?> value="fr">Francês</option>
        <option <?php selected($idioma, "de"); ?> value="de">Alemão</option>
        <option <?php selected($idioma, "it"); ?> value="it">Italiano</option>
    </select>
    <?php

    echo '</p>';
}

function meio ($lab = "Meio de divulgação", $labCl = false, $cl = false) {
    global $meio;

    echo '<p>';

    if( isset($lab) ) label('meio', $lab, $labCl);
    $classe = ($cl && $trim($cl) != "") ? 'class='.$cl : ''; 
    ?>

    <select <?php echo $classe; ?> name="lvm_pub_media" class="lvm_pub_media">
        <option value=""></option > 
        <option <?php selected($meio, "Impresso"); ?>value="Impresso">Impresso</option>
        <option <?php selected($meio, "Meio magnético"); ?> value="Meio magnético">Meio magnético</option>
        <option <?php selected($meio, "Meio digital"); ?> value="Meio digital">Meio digital</option>
        <option <?php selected($meio, "Filme"); ?> value="Filme">Filme</option>
        <option <?php selected($meio, "Hipertexto"); ?> value="Hipertexto">Hipertexto</option>
        <option <?php selected($meio, "Impresso e mídia eletrônica"); ?> value="Impresso e mídia eletrônica">Impresso e mídia eletrônica</option>
        <option <?php selected($meio, "Outro"); ?> value="Outro">Outro</option>
    </select>
    <?php
    echo '</p>';
}

function host ($lab = "Home page do trabalho (url)", $labCl = false, $cl = false) {
    global $host;

    echo '<p>';

    if( isset($lab) ) label('host', $lab, $labCl);
    $classe = ($cl && $trim($cl) != "") ? 'class='.$cl : ''; 
    ?>

    <input <?php echo $classe; ?> type="text" name="lvm_pub_host" value="<?php echo $host; ?>">
    <?php
    echo '</p>';
}


// DETALHAMENTO


function tituloPer ($lab = "Título do Periódico", $labCl = false, $cl = false) {
    global $tituloPer;

    echo '<p>';

    if( isset($lab) ) label('tituloPer', $lab, $labCl);
    $classe = ($cl && $trim($cl) != "") ? 'class='.$cl : '';
    
    echo '<input '. $classe .' type="text" name="lvm_pub_per_title" value="'. $tituloPer.'"></p>'; 
}

function codigo ($lab = "ISSN", $labCl = false, $cl = false) {
    global $codigo;

    echo '<p>';

    if( isset($lab) ) label('codigo', $lab, $labCl);
    $classe = ($cl && $trim($cl) != "") ? 'class='.$cl : ''; 
    ?>

    <input <?php echo $classe; ?> type="text" name="lvm_pub_code" value="<?php echo $codigo; ?>">
    <?php
    echo '</p>';
}

function volume ($lab = "Volume", $labCl = false, $cl = false) {
 global $volume;

 echo '<p>';

 if( isset($lab) ) label('volume', $lab, $labCl);
 $classe = ($cl && $trim($cl) != "") ? 'class='.$cl : ''; 
 ?>

 <input <?php echo $classe; ?> type="text" name="lvm_pub_volume" value="<?php echo $volume; ?>">
 <?php
 echo '</p>';
} 

function serie ($lab = "Série", $labCl = false, $cl = false) {
    global $serie;

    echo '<p>';

    if( isset($lab) ) label('serie', $lab, $labCl);
    $classe = ($cl && $trim($cl) != "") ? 'class='.$cl : ''; 
    ?>

    <input <?php echo $classe; ?> type="text" name="lvm_pub_serie" value="<?php echo $serie; ?>">
    <?php
    echo '</p>';
}

function pgInicial ($lab = "Página Inicial", $labCl = false, $cl = false) {
    global $pgInicial;

    echo '<p>';

    if( isset($lab) ) label('pgInicial', $lab, $labCl);
    $classe = ($cl && $trim($cl) != "") ? 'class='.$cl : ''; 
    ?>

    <input <?php echo $classe; ?> type="text" name="lvm_pub_pgini" value="<?php echo $pgInicial; ?>">
    <?php
    echo '</p>';
}

function pgFinal ($lab = "Página Final", $labCl = false, $cl = false) {
 global $pgFinal;

 echo '<p>';

 if( isset($lab) ) label('pgFinal', $lab, $labCl);
 $classe = ($cl && $trim($cl) != "") ? 'class='.$cl : ''; 
 ?>

 <input <?php echo $classe; ?> type="text" name="lvm_pub_pgend" value="<?php echo $pgFinal; ?>">
 <?php
 echo '</p>';
}