$(".newImg").click(function(e){
	var enlaceImg = e.target.src;
	console(enlaceImg);
	var ligthbox = '<div class="ligthbox">'+
	'<img src="'+enlaceImg+'" alt="">' +
	 '<div class="btn-close">X</div>' + 
	 '</div>';

    $("body").append(ligthbox)
    $(".btn-close").click(function(){
	    $(".ligthbox").remove();
    })


})