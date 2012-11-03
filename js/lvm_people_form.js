(function ($, window, document) {

    "use strict";

    /*
     * amplia a biblioteca jQuery 
     * adiciona a função de selecionar determinado texto 
     * função usada na interface dos Contatos
    */
    $.fn.selectText = function () {
        var doc = document,
            element = this[0],
            range,
            selection;

        if (doc.body.createTextRange) {
            range = doc.body.createTextRange();
            range.moveToElementText(element);
            range.select();
        } else if (window.getSelection) {
            selection = window.getSelection();
            range = doc.createRange();
            range.selectNodeContents(element);
            selection.removeAllRanges();
            selection.addRange(range);
        }
    };

    // preenche automaticamente os campos title (hidden) e Citação
    // a partir dos dados inseridos nos campos Nome e Sobrenome
    $("#cpt_lvm_people_dados_pessoais")
        .on("change", "#lvm_people_nome, #lvm_people_sobrenome", function () {

            var $title = $("#title"),
                $citacao = $("#lvm_people_citacao"),
                $nome = $("#lvm_people_nome"),
                nome = $.trim($nome.val()),
                $sobre = $("#lvm_people_sobrenome"),
                sobre = $.trim($sobre.val()),
                title = nome + " " + sobre,

                //citacao
                nomeSep = nome.split(" "),
                sobreSep = sobre.split(" "),
                citacao = (sobre !== "") ? sobreSep.pop() + ", " : "",

                //nome e sobrenome
                nomeIn,
                sobreIn,
                sobreSep_lastElem = sobreSep.length - 1,
                preposicao;

            //title
            $title.val(title);
            $("#title-prompt-text").css("visibility", "hidden");

            function getIniciais(elem) {

                if (!elem.length) {
                    return "";
                }

                var i,
                    len = elem.length,
                    iniciais = "",
                    parte,
                    inicial;

                for (i = 0; i < len; i += 1) {
                    parte = elem[i];

                    if (parte !== "de" && parte !== "da" &&
                            parte !== "do" && parte !== "das" &&
                            parte !== "dos" && parte !== "" &&
                            parte !== " ") {
                        inicial = parte.charAt(0).toUpperCase() + ". ";
                        iniciais += inicial;
                    }
                }
                return iniciais;
            }

            // definindo as iniciais do nome
            nomeIn = getIniciais(nomeSep);

            // definindo as iniciais do sobrenome

            // caso haja preposicao antes do último sobrenome
            // ela é passada para a parte extensa da citação 
            if (sobreSep[sobreSep_lastElem] === "de" ||
                    sobreSep[sobreSep_lastElem] === "da" ||
                    sobreSep[sobreSep_lastElem] === "do" ||
                    sobreSep[sobreSep_lastElem] === "das" ||
                    sobreSep[sobreSep_lastElem] === "dos") {

                preposicao = sobreSep.pop();
                citacao = preposicao + " " + citacao;

            }

            sobreIn = getIniciais(sobreSep);
            citacao = citacao + nomeIn + sobreIn;

            $citacao.val(citacao);
        });


    // controla a escolha da opção de tipo de contato
    $("#cpt_lvm_people_contatos")
        .on("click", ".lvm_options span", function () {
            var $this = $(this),
                $opt = $this.parent(),
                $termo = $opt.siblings(".termo"),
                termo;

            if ($this.html() === "Personalizar") {
                $termo.focus().selectText();
            } else {
                termo = $this.html();
                $termo.html(termo).focus();
            }

            // some com a div de opções de tipo
            // para o caso do usuário apertar enter quando fizer a alteração
            // a div é controlada via css e portanto continuaria aparecendo 
            // enquanto o mouse não for movido
            $opt.css("display", "none");

            // volta com a div de opções de tipo assim que o usuário 
            // conclui a decisão do tipo
            $termo.on("blur", function () {
                $opt.css("display", "block");
            });
        });

    // atualiza o campo hidden do formulário que será passado no submit
    $("#cpt_lvm_people_contatos").on("blur", ".termo", function () {
        var $this = $(this),
            id = $this.attr("id"),
            val = $this.html(),
            $input = $("input[name='" + id + "']");

        $input.val(val);
    });


    // adicionar novo campo (email, telefone ou endereço)
    $("#cpt_lvm_people_contatos").on("click", ".add", function (evt) {
        evt.preventDefault();

        function getContato($obj) {
            var contato;

            if ($obj.hasClass("tel")) {
                contato = "tel";
            } else if ($obj.hasClass("email")) {
                contato = "email";
            } else if ($obj.hasClass("end")) {
                contato = "end";
            }

            return contato;
        }

        var $this = $(this),
            $obj = $this.parent(".lvm_separador"),
            contato = getContato($obj),

            $qtde_contato = $("#lvm_people_" + contato + "_n"),
            qtde_contato = Number($qtde_contato.val()) + 1,
            $tmp = $("#" + contato + "-tmp").html(),
            $tmpUpdated = $tmp.replace(/{{n}}/g, qtde_contato);

        $qtde_contato.val(qtde_contato);
        $this.before($tmpUpdated);

        if (qtde_contato === 2) {
            $obj.find(".lixeira").css("visibility", "visible");
        }
    });

    //remover campo (email, telefone ou endereço)
    $("#cpt_lvm_people_contatos").on("click", ".lixeira", function () {

        function getContato($obj) {
            var contato;

            if ($obj.hasClass("tel")) {
                contato = "tel";
            } else if ($obj.hasClass("email")) {
                contato = "email";
            } else if ($obj.hasClass("end")) {
                contato = "end";
            }

            return contato;
        }

        var $this = $(this),
            $line = $this.parents(".line"),
            $obj = $this.parents(".lvm_separador"),
            $qtde_contato = $obj.children("input[type='hidden']"),
            qtde = $qtde_contato.val(),
            contato = getContato($obj),
            $container = (document.createElement("div")) ?
                    $(document.createElement("div")) : $("div");

        // havendo apenas um grupo de contato
        // esconde os botoes lixeira
        if (qtde <= 2) {
            $obj.find(".lixeira").css("visibility", "hidden");
        }

        $qtde_contato.val(Number(qtde) - 1);
        $line.remove();

        $obj.find(".line").each(function (index) {
            var $this = $(this),
                i = index + 1,
                expression = new RegExp(contato + "_[0-9]{1,}", "gi"),
                newText = contato + "_" + i,
                update = $this.html().replace(expression, newText),
                $div = (document.createElement("div")) ?
                        $(document.createElement("div")) : $("div"),
                classes = contato + "_" + i +  " line";

            $div.addClass(classes);
            $div.append(update);
            $container.append($div);
        }).remove();

        $obj.children("input[type=\"hidden\"]").after($container.html());
    });

    // some com os botoes lixeira assim que o DOM carrega
    (function () {
        $(".lixeira").css("visibility", "hidden");
    }());


}(jQuery, window, document));

