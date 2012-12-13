<?php

$post_id = $post->ID || false;

require 'artigos.php';
// // o título é salvo diretamente na tabela wp_post 
// // ao invés da wp_postmeta
// $titulo = isset($post_id) ? 
//             the_title("","",false) : "";

// // recuperar metadados do servidor

// $metadata = get_post_meta($post_id); //recebe um array com todos os metadados da publicação

// $metadataFields = [
//     //Campos dos Dados Gerais da publicação
//     "categoria" => "lvm_pub_category",
//     "data"      => "lvm_pub_date",
//     "isPrev"    => "lvm_pub_date_isPrev",
//     "idioma"    => "lvm_pub_lang",
//     "midia"     => "lvm_pub_media",
//     "url"       => "lvm_pub_host",

//     //Campos de detalhamento da publicação
//     "tituloSuporte" =>  "lvm_pub_sup_title",
//     "codigo"        =>  "lvm_pub_sup_code",
//     "volume"        =>  "lvm_pub_sup_volume",
//     "totalVolumes"  =>  "lvm_pub_sup_volQty",
//     "serie"         =>  "lvm_pub_sup_serie",
//     "edicao"        =>  "lvm_pub_sup_edition",
//     "totalPaginas"  =>  "lvm_pub_sup_pgQty",
//     "pagInicial"    =>  "lvm_pub_sup_pgIn",
//     "pagFinal"      =>  "lvm_pub_sup_pgEnd",
//     "editora"       =>  "lvm_pub_sup_editora",
//     "cidade"        =>  "lvm_pub_sup_city"
// ];

// foreach ($metadataFields as $k => $v) {
//     $$k = isset($metadata[$v]) ? $metadata[$v] : "";
// }

// $dia = ""; $mes = ""; $ano = "";

// if (isset($data) && $data && $data != "") {
//     $date_parts = explode("/", $data);
//     switch (count($date_parts)) {
//         case '3':
//             $dia = $date_parts[0];
//             $mes = $date_parts[1];
//             $ano = $date_parts[2];
//             break;
        
//         case '2':
//             $mes = $date_parts[0];
//             $ano = $date_parts[1];

//         default:
//             $ano = $date_parts[0];
//             break;
//     }
// };

// opções de categorias
$categorias = [
    "Artigo completo para publicação em periódico",
    "Livro",
    "Capítulo de livro",
    "Texto em jornal ou revista (magazine)",
    "Trabalho publicado em anais de eventos",
    "Apresentação de trabalho e palestra"
];
$len = count($categorias); $i = 0;
?>

<div class="lvm_separador">
    <p>
    <label class="small" for="lvm_pub_category">Escolha o tipo de publicação</label>
    <select class="large" name="lvm_pub_category">';
<?php
while($i < $len){
    ?>
    <option value="<?php echo($i+1); ?>"  <?php selected( $categoria, $i+1 ); ?>><?php 
        echo $categorias[$i]; ?></option>
    <?php
    $i++;
};
?>
    </select>
    </p>
</div>

<div class="lvm_separador dados_gerais">
    <p>
        <h4>Dados gerais da publicação</h4>
    </p>
    
    <p>
        <label for="lvm_pub_title">Título da publicação</label>
        <input type="text" name="post_title" value="<?php echo $titulo; ?>" placeholder="Título da publicação">
    </p>

    <p>
        <label for="lvm_pub_date">Data da publicação</label>
        <select name="lvm_pub_day">
            <option value=""></option>
        <?php
            $i = 1; 
            while($i < 32){
                ?>
                <option value="<?php echo $i; ?>" <?php selected( $dia, $i+1 ); ?>><?php echo $i; ?></option>
                <?php
                $i++;
            };
        ?>
        </select>
        <span> / </span>
        <select name="lvm_pub_month">
            <option value=""></option>
        <?php
            $i = 0; 
            $meses = ["janeiro", "fevereiro", "março", "abril", "maio", "junho", "julho", "agosto", "setembro", "outubro", "novembro", "dezembro"];

            while( isset($meses[$i]) ) {
                ?>
                <option value="<?php echo $i+1; ?>"><?php echo $meses[$i]; ?></option>
                <?php
                $i++;
            };
        ?>
        </select>
        <span>/</span>
        <span class="yearIni">20</span>
        <input type="number" name="lvm_pub_ano"><br>
        <input type="checkbox" <?php checked($isPrev); ?> name="lvm_pub_date_isPrev"> A data é de previsão de publicação
    </p>

    <p>
        <label for="lvm_pub_lang">Idioma</label>
        <select name="lvm_pub_lang">
            <?php require("idiomas.php"); ?>
        </select>
    </p>

    <p>
        <label for="lvm_pub_media">Mídia de Divulgação</label>
        <select name="lvm_pub_media">
            <option value=""></option>  
            <option value="Impresso" <?php selected($idioma, "Impresso"); ?>>Impresso</option>
            <option value="Meio magnético" <?php selected($idioma, "Meio magnético"); ?>>Meio magnético</option>
            <option value="Meio digital" <?php selected($idioma, "Meio digital"); ?>>Meio digital</option>
            <option value="Filme" <?php selected($idioma, "Filme"); ?>>Filme</option>
            <option value="Hipertexto" <?php selected($idioma, "Hipertexto"); ?>>Hipertexto</option>
            <option value="Impresso e mídia eletrônica" <?php selected($idioma, "Impresso e mídia eletrônica"); ?>>Impresso e mídia eletrônica</option>
            <option value="Outro" <?php selected($idioma, "Outro"); ?>>Outro</option>
        </select>
    </p>

    <p>
        <label for="lvm_pub_host">Home page do trabalho (url)</label>
        <input type="text" name="lvm_pub_host" value="<?php echo $url; ?>">
    </p>
</div>


<div class="lvm_separador detalhamento">
    <p>
        <h4>Detalhamento</h4>
    </p>
    <p>
        <label for="lvm_pub_sup_title">Título do periódico</label>
        <input type="text" name="lvm_pub_sup_title" value="<?php echo $tituloSuporte; ?>">
    </p>
</div>