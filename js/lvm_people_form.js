(function($){

	jQuery.fn.selectText = function(){
    var doc = document, 
	    element = this[0], 
	    range, selection
    ;
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

})(jQuery);

