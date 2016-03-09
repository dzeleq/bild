
$(".like").click(function(e){
	var komentarId = $(this).data('id');
 	var that = $(this);
	$.get( "ajax.php?like="+komentarId, function( data ) {
		that.parent().find('.badge').text(data+'%');
	});
});



$(".dislike").click(function(e){
	var komentarId = $(this).data('id');
	var that = $(this);

	$.get( "ajax.php?dislike="+komentarId, function( data ) {
	 	that.parent().find('.badge').text(data+'%');
	});
});

