<?php

$post_id = $post->ID || false;

// recuperar metadados do servidor
$metadatas = get_post_meta($post_id); //recebe um array com todos os metadados da publicação
$categoria = isset( $metadatas['lvm_pub_category']) ? $metadatas['lvm_pub_category'] : ""; 

// o título é salvo diretamente na tabela wp_post 
// ao invés da wp_postmeta
$titulo = isset($post_id) ? 
            the_title("","",false) : "";


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
    <select id="categorias" class="large" name="lvm_pub_category">';
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

<div id="response">

<?php
/* esquema dos argumentos para 
 * funções de montagem dos campos
 *
 * $arg=[
 *   label => 'string',
 *   labCl => 'string'
 *   classe => 'string',
 * ];
 */

// puxa o arquivo com as funções que constróem
require_once('campos.php');

require 'artigos.php';
?>
</div>