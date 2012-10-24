(function($){

	$(".contatos.arrow-down").on("click", function (e) {
		$this = $(this);
		$this.siblings(".options").removeClass("hide").removeClass("zeroheight");
	})

	$(".options span").on("click", function (e) {
		$this = $(this);
		$this.parent(".options").addClass("zeroheight").delay(100000).addClass("hide");
	})

})(jQuery);

