(function($){

	// amplia a biblioteca jQuery adicionando a função de selecionar determinado texto
	// função usada na interface dos Contatos
	jQuery.fn.selectText = function(){
    var doc = document, 
	    element = this[0], 
	    range, selection;

	    if (doc.body.createTextRange) {
	        range = document.body.createTextRange();
	        range.moveToElementText(element);
	        range.select();
	    } else if (window.getSelection) {
	        selection = window.getSelection();        
	        range = document.createRange();
	        range.selectNodeContents(element);
	        selection.removeAllRanges();
	        selection.addRange(range);
	    }
	};


	// preenche automaticamente os campos title (hidden) e Citação
	// a partir dos dados inseridos nos campos Nome e Sobrenome
	$("#cpt_lvm_people_dados_pessoais").on("change", "#lvm_people_nome, #lvm_people_sobrenome", function (e) {
		var $title = $("#title"),
			$citacao = $("#lvm_people_citacao"),
			$nome = $("#lvm_people_nome"),
			nome = $.trim($nome.val()),
			$sobre = $("#lvm_people_sobrenome"),
			sobre = $.trim($sobre.val()),
			title = nome + " " + sobre;

		//title
		$title.val(title)
		$("#title-prompt-text").css("visibility", "hidden");

		//citacao
		var nomeSep = nome.split(" "),
			sobreSep = sobre.split(" "),
			cit = ( sobre != "" ) ? sobreSep.pop() + ", " : "";		

		function iniciais (elem){

			if( !elem.length ) return "";

			var i = 0,
				len = elem.length,
				iniciais = "";
			
				console.log( len + " : " + elem)

			while( i < len ){
				var parte = elem[i];

				if ( parte != "de" && parte != "da" && parte != "do" && parte != "das" && parte != "dos" && parte != "" && parte != " " ) {
					var inicial = parte.charAt(0).toUpperCase() + ". ";
					iniciais += inicial;
				}

				i++;
			}

			return iniciais;
		}

		// nome
		nomeIn = iniciais(nomeSep); 

		//sobrenome		
		if ( sobreSep[sobreSep.length-1] == "de" || sobreSep[sobreSep.length-1] == "da" || sobreSep[sobreSep.length-1] == "do" || sobreSep[sobreSep.length-1] == "das" || sobreSep[sobreSep.length-1] == "dos" ) {
			var prep = sobreSep.pop();
			console.log("prep: " + prep);
			cit = prep + " " + cit;
		}
		sobreIn = iniciais(sobreSep);
		cit = cit + nomeIn + sobreIn;

		$citacao.val(cit);
	})


	// controla a escolha da opção de tipo de contato
	$(".lvm_options span").on("click", function (e) {
		var $this = $(this),
			$opt = $this.parent();
			$termo = $opt.siblings(".termo");

		if ($this.html() == "Personalizar"){
			$termo.focus().selectText();
		} else {
			var termo = $this.html();
			$termo.html(termo).focus();
		}

		// some com a div de opções de tipo
		// para o caso do usuário apertar enter quando fizer a alteração
		// a div é controlada via css e portanto continuaria aparecendo 
		// enquanto o mouse não for movido
		$opt.css("display","none");

		// volta com a div de opções de tipo assim que o usuário conclui a decisão do tipo
		$termo.on("blur", function (e) {
			$opt.css("display", "block");
		})
	})

    // atualiza o campo hidden do formulário que será passado no submit
	$(".termo").on( "blur", function (e){
		var $this = $(this),
			id = $this.attr("id"),
			val = $this.html(),
			$input = $("input[name='" + id + "']");

		console.log( val + " : " + id );
		$input.val(val);
	})


	// adicionar novo campo (email, telefone ou endereço)
	$(".add").on("click", function (evt){
		evt.preventDefault();

		var $this = $(this),
			$obj = $this.parent(".lvm_separador"),
		    contato, n;

		if($obj.hasClass("tel")){
			contato = "tel";
		}else if ($obj.hasClass("email")){
			contato = "email";
		}else if ($obj.hasClass("end")){
			contato = "end";
		}

		var $n = $("#lvm_people_" + contato + "_n"),
			n = parseInt($n.val()) + 1,
			$tmp = $("#" + contato + "-tmp").html(),
			$tmp = $tmp.replace(/{{n}}/g, n);

		$n.val(n);
		$this.insertBefore($tmp);
	})


})(jQuery);

