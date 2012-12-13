
(function ($) { 
    console.log(Date());

    $("#categorias").change(function () {
        var cat = $(this).val();

        $("#response").load("/wp-content/plugins/lvm_cpt/inc/metaboxes/publicacoes/artigos.php");
    })
})(jQuery);