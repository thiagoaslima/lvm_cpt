(function($){

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


	$(".lvm_options span").on("click", function (e) {
		var $this = $(this),
			$opt = $this.parent();
			$termo = $opt.siblings(".termo");

		if ($this.html() == "Personalizar" ){
			
			$termo.focus().selectText();
		} else {
			var termo = $this.html();
			$termo.html(termo).focus();
		}

		$opt.css("display","none");
		$termo.on("blur", function (e) {
			$opt.css("display", "block");
		})
	})

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

})(jQuery);

